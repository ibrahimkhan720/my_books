<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Team;
class MainController extends Controller
{
   public function index(){
      $categories = Category::where('status' , 1)->get();
      $books = Book::with('author')->where('status' , 1)->paginate(10);
      $author_feature=Author::with('books')->where([['status' , 1] , ['author_feature' , 'yes']])->inRandomOrder()->first();
      $authors = Author::where('status' , 1)->latest()->limit(4)->get();
      $upcomings = Book::where('status' , 3)->get();
      $downloads = Book::where('downloaded' , '>' , 0)->get();
      $recomendes = Book::where('recommended' , 'yes')->get();
      $medias = Media::where([['media_type' , 'slider'], ['status' , 1]])->get();
      $media_galleries = Media::where([['media_type' , 'gallery'], ['status' , 1]])->limit(6)->get();
      return view('frontend.index' , compact('medias' , 'media_galleries' , 'books' ,'upcomings' , 'downloads' , 'recomendes' ,'author_feature' ,  'categories' , 'authors'));
   }


   public function about(){

      $teams = Team::where('status' , 1)->get();
      return view('frontend.about' , compact('teams'));
   }

   public function gallery(){
      $medias= Media::where([['status' , 1] , ['media_type' , 'gallery']])->latest()->get();
      return view('frontend.gallery' , compact('medias'));
   }

   public function author(){
      $searchTerm = request()->get('latter');
      $authors= Author::where([['status' , 1] , ['title' , 'like' , "$searchTerm%"]])->latest()->paginate(4);
      $author_features= Author::where([['author_feature' , 'yes'] , ['status' , 1]])->latest()->paginate(4);
      $downloads = Book::where('status' , 1)->orderBy('downloaded' , 'DESC')->limit(6)->get();
      return view('frontend.author' , compact('authors' , 'author_features' , 'downloads'));
   }

   public function author_detail($slug){
      $author=Author::where('slug' , $slug)->first();
      $recommended = Author::with('books') ->where('status', 1) ->inRandomOrder() ->first();
      return view('frontend.author_detail' , compact('author','recommended'));
   }

   public function category_detail($slug){
      $category = Category::where('slug' , $slug)->first();
      $books = Book::with('author')->where('category_id' , $category->id)->paginate(15);
       $categories = Category::where('status' , 1)->get();
      return view('frontend.category_detail' , compact('category' , 'books' , 'categories'));
   }

   public function book_detail($slug){
      $book= Book::where('slug',$slug)->first();  
      $recommended = Book::with('author')->where( 'recommended' , 'yes')->get(); 
      return view('frontend.book_detail',compact('book' , 'recommended'));
   }
}
