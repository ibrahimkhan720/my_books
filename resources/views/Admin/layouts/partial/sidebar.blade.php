<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="display: flex; align-items: center; padding: 10px;">
      {{-- User Image --}}
      <div class="image" style="margin-right: 10px;">
        @if(Auth::user()->user_image != null)
          <img src="{{ asset('admin/uploads/user_image/' . Auth::user()->user_image) }}" class="img-circle" alt="User Image" style="width: 45px; height: 45px; border-radius: 50%;">
        @else
          <img src="{{ asset('admin/uploads/user_image/default.png') }}" class="img-circle" alt="Default Image" style="width: 45px; height: 45px; border-radius: 50%;">
        @endif
      </div>

      {{-- User Info --}}
      <div class="info" style="display: flex; flex-direction: column; justify-content: center;">
        <p style="margin: 0; font-weight: bold;">{{ Auth::user()->name }}</p>
        <span style="font-size: 12px; color: #888;">
          @if(Auth::user()->role)
            {{ Auth::user()->role->name }}
          @else
            No Role Assigned
          @endif
        </span>
      </div>
    </div>

    <!-- sidebar menu: style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    @foreach(Auth::user()->getmodules() as $module)
        @if($module->childs && $module->childs->count() > 0)
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ $module->name }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ request()->routeIs($module->route) ? 'display: block;' : 'display: none;' }}">
                    @foreach($module->childs as $child)
                        <li class="{{ request()->routeIs($child->route) ? 'active' : '' }}">
                            <a href="{{ ($child->route != '#') ? route($child->route) : $child->route }}">
                                <i class="fa fa-circle-o"></i> {{ $child->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{ request()->routeIs($module->route) ? 'active' : '' }}">
                <a href="{{ ($module->route != '#') ? route($module->route) : $module->route }}">
                    <i class="fa fa-circle-o"></i> {{ $module->name }}
                </a>
            </li>
        @endif
    @endforeach
</ul>


  </section>
  
  <!-- /.sidebar -->
</aside>
