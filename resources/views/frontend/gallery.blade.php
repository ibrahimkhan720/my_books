@extends('frontend.master')

@section('title')
{{ 'gallery-page' }}
@endsection


@section('main-content')
<main class="main-content">

		<!-- Gallery -->
        <div class="gallery tc-padding">
      		<div class="container">
      			<div class="row no-gutters">
                      @foreach ($medias as $media)
      				<div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="gallery-figure style-2"> 
	                  		<img src="{{ asset('admin/uploads/media_img/' . $media->media_img) }}" alt="" width="283" height="283">
	                  		<div class="overlay">
	                  			<ul class="position-center-x">
	                  				<li><a href="#"><i class="fa fa-heart"></i>Likes</a></li>
	                  				<li><a href="{{ asset('admin/uploads/media_img/' . $media->media_img) }}" data-rel="prettyPhoto[gallery]"><i class="fa fa-plus"></i></a></li>
	                  			</ul>
	                  		</div>
	                  	</div>
                    </div>
                    @endforeach
      			</div>
            </div>
      	</div>
		<!-- Gallery -->

	</main>    
@endsection