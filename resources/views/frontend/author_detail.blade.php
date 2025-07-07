@extends('frontend.master')

@section('title')
 {{ 'author_detail-page' }}   
@endsection

@section('main-content')
	<main class="main-content">

		<!-- Arthor Detail -->
		<div class="single-aurthor-detail tc-padding">
			<div class="container">
				<div class="row">
					
					<!-- Aside -->
					<aside class="col-lg-4 col-md-5">
						<div class="arthor-detail-column">
							<div class="arthor-img">
								@if( $author && $author->author_img )
								<img src="{{  asset('admin/uploads/author_img/' . $author->author_img) }}" alt="">
								@else
								{{ 'no found image' }}
								@endif
							</div>
							<div class="arthor-detail">
								 
									<h6>{{ $author->title }}</h6>
									<span>{{ $author->designation }}</span>
								
							</div>
							<div class="social-activity">
								<div>
									@if( $author->facebook_id || $author->youtube_id || $author->twitter_id || $author->pinterest_id)
									<ul class="social-icons">
										@if($author->facebook_id)
					                	<li><a class="facebook" href="{{ $author->facebook_id }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
					                    @endif

										@if($author->twitter_id)
										<li><a class="twitter" href="{{ $author->twitter_id }}"><i class="fa fa-twitter"></i></a></li>
					                   @endif

									   @if($author->youtube_id)
										<li><a class="youtube" href="{{ $author->youtube_id }}"><i class="fa fa-youtube-play"></i></a></li>
										@endif
										
					                   
										@if($author->pinterest_id)
										<li><a class="pinterest" href="{{ $author->pinterest_id }}"><i class="fa fa-pinterest-p"></i></a></li>
										@endif
									</ul>
									@endif
				                </div>
				         	</div>
						</div>
					</aside>
					<!-- Aside -->

					<!-- Content -->
					<div class="col-lg-8 col-md-7">
						<div class="single-arthor-detail">

							<!-- Widget -->
							<div class="single-arthor-widget">
								<h5>Author Overview</h5>
								<div class="author-overview">
									<p>{{ $author->description }}</p>
								</div>
							</div>
							<!-- Widget -->

							<!-- Widget -->
							<div class="single-arthor-widget">
    <h5>Recommended Muriel Barbery Titles</h5>

    <!-- Recommended -->
    <div id="filter-masonry" class="gallery-masonry row">
        <!-- LOOP STARTS HERE -->
        @php
            use Illuminate\Support\Str;
        @endphp
        @foreach ($recommended->books->take(4) as $book)
            <div class="col-lg-3 col-xs-6 r-full-width masonry-grid most-popular">
                <div class="recommended-book text-center">
                    <div class="recommended-book-img mb-2">
                        <img src="{{ asset('admin/uploads/book_img/' . $book->book_img) }}" alt="{{ $book->title }}" width="125">
                    </div>
                    <div class="recommended-book-detail">
                        <h6 class="mb-1">{{ $book->title }}</h6>
                        <span>{{ Str::limit($book->description, 20) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


					    			<!-- Product Box -->

							  	</div>
							  	<!-- Recommended -->

							</div>
							<!-- Widget -->
						</div>
					</div>
					<!-- Content -->
				</div>
			</div>
		</div>
		<!-- Arthor Detail -->
	</main>
@endsection