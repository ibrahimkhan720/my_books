<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'user_image',
        'password',
        'role_id',
        'designation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

      public function role(){
        return $this->belongsTo(Role::class , 'role_id');
    }

     // 🔄 modules() renamed to getModules()
    public function getModules()
    {
        $roles = $this->role()->with('Rolepermission')->first();

        if ($roles) {
            $permissions = $roles->Rolepermission()->where('pview', 1)->get();

            $id = [];

            foreach ($permissions as $permission) {
                $id[] = $permission->module_id; // 🛠 fixed: use module_id not permission id
            }

            $modules = Module::where('parent_id', 0)->whereIn('id', $id) 
                ->with(['childs' => function($allowed) use ($id){
                    $allowed -> whereIn('id' , $id);
                }])
                ->orderBy('sorting')
                ->get();

            return $modules;
        }
        return collect(); 
    }
    

    public function hasper($name = null)
    {
        if (!$name) {
            return false;
        }

        $module = Module::where('name', $name)->first();

        if (!$module) {
            return [];
        }

        $roles = $this->role;
        $perm = $roles->Rolepermission()->where('module_id', $module->id)->first();

        return $perm ? [
            'pview' => $perm->pview,
            'pcreate' => $perm->pcreate,
            'pedit' => $perm->pedit,
            'pdelete' => $perm->pdelete,
        ] : [];
    }
}
