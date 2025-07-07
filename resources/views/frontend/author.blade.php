@extends('frontend.master')

@section('title')
{{ 'author-page' }}
@endsection

@section('main-content')
	<main class="main-content">

		<!-- Author Listing -->
		<div class="author-listing tc-padding">
			<div class="container">
				<div class="row">

					<!-- Content -->
					<div class="col-lg-9 col-md-8 col-xs-12">
													
						<!-- Author Filter -->
						<div class="authors-filter">
							<ul>
								@foreach (range('A' , 'Z') as $latter)
								<li><a href="/author?latter={{ Str::lower($latter) }}">{{ $latter }}</a></li>
								@endforeach
								
							</ul>
						</div>
						<!-- Author Filter -->

						<!-- Author List -->
						<ul class="author-list">
                            @foreach ($authors as $author)
							<li>
                                    <div class="author-list-widget">
									<div class="arthor-list-img">
										<img src="{{ asset('admin/uploads/author_img/' . $author->author_img) }}" alt="" width="178" height="178">
										<div class="overlay">
											<a class="position-center-center" href="#">+</a>
										</div>
									</div>
									<div class="author-list-detail">
										<h6>{{ $author->title }}</h6>
										<p>{{ Str::limit($author->description , 60) }}</p>
										<a href="{{ route('author_detail' , $author->slug) }}" class="btn-1 sm">Read more<i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</li>
                            @endforeach
						
						</ul>
						<!-- Author List -->

						<!-- Pagination -->
		           		<div class="pagination-holder" style="margin-top: 50px;">
		           			<ul class="pagination">
							    <li><a href="#" aria-label="Previous">Prev</a></li>
							    <li><a href="#">1</a></li>
							    <li class="active"><a href="#">2</a></li>
							    <li><a href="#">3</a></li>
							    <li><a href="#">4</a></li>
							    <li><a href="#">5</a></li>
							    <li><a href="#">6</a></li>
							    <li><a href="#">7</a></li>
							    <li><a href="#">...</a></li>
							    <li><a href="#">23</a></li>
							    <li><a href="#" aria-label="Next">Next</a></li>
							</ul>
		           		</div>
		           		<!-- Pagination -->

					</div>
					<!-- Content -->

					<!-- Aside -->
					<aside class="col-lg-3 col-md-4 col-xs-12">
						<!-- Aside Widget -->
					<div class="aside-widget">
    <h6>Feature Authors</h6>
    <ul class="s-arthor-list">
        @foreach ($author_features as $author_feature)
            <li>
                <div class="s-arthor-wighet">
                    <div class="s-arthor-img">
                        <img src="{{ asset('admin/uploads/author_img/' . $author_feature->author_img) }}" alt="" width="34" height="34">
                        <div class="overlay">
                            <a class="position-center-center" href="#">+</a>
                        </div>
                    </div>
                    <div class="s-arthor-detail">
                        <h6>{{ $author_feature->title }} <a href="mailto:{{ $author_feature->email }}" target="_blank">  @ {{Str::limit( $author_feature->email , 5) }} </a></h6>

                        @if ($author_feature->facebook_id || $author_feature->twitter_id || $author_feature->youtube_id || $author_feature->pinterest_id)
                            <div class="social-links" style="display:flex; gap:1.5rem;">
                                @if ($author_feature->facebook_id)
                                    <a href="{{ $author_feature->facebook_id }}" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                @endif

                                @if ($author_feature->twitter_id)
                                    <a href="{{ $author_feature->twitter_id }}" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                @endif

                                @if ($author_feature->youtube_id)
                                    <a href="{{ $author_feature->youtube_id }}" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                @endif

                                @if ($author_feature->pinterest_id)
                                    <a href="{{ $author_feature->pinterest_id }}" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

						<!-- Aside Widget -->

						<!-- Aside Widget -->
						<div class="aside-widget">
							<h6>Most Downloaded Books</h6>
							<ul class="books-year-list">
								@foreach ($downloads as $download)
                                    <li>
									<div class="books-post-widget">
										<img src="{{ asset('admin/uploads/book_img/' . $download->book_img) }}" alt="" width="60" height="80">
										<h6><a href="#">{{ Str::limit($download->description , 50) }}</a></h6>
										<span>{{ $download->author->title }}</span>
									</div>
								</li>
                                @endforeach
								
							</ul>
						</div>
						<!-- Aside Widget -->

					</aside>
					<!-- Aside -->

				</div>
			</div>
		</div>
		<!-- Author Listing -->

	</main>
@endsection