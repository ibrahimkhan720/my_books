@extends('frontend.master')
@section('title')
    {{ 'home-page' }}
@endsection

@section('main-content')
    	<!-- BEGIN MAIN CONTENT -->
		<main class="main-content">
		<div id="main-slider" class="main-slider">
		<!-- Item -->
		@foreach ($medias as $media)
        <div class="item">
            <img src="{{ asset('admin/uploads/media_img/' . $media->media_img) }}" alt="">
        </div>
    @endforeach
		
	</div>
	
		<section class="upcoming-release">
		<!-- Heading -->
		<div class="container-fluid p-0">
		  	<div class="release-heading pull-right h-white">
		  		<h5>New and Upcoming Release</h5>
		  	</div>
		</div>
		<!-- Heading -->

		<!-- Upcoming Release Slider -->
		<div class="upcoming-slider">
			<div class="container">
				<!-- Release Book Detail -->
				<div class="release-book-detail h-white p-white">
						<div class="release-book-slider">
							
							@foreach ($upcomings as $upcoming)
								<div class="item">
								<div class="detail">
									<h5><a href="{{ route('book.detail' , $upcoming->slug) }}">{{ Str::limit($upcoming->title , 12) }} </a></h5>
									<p>{{ Str::limit($upcoming->description , 50)}}</p>
									<span>{{ $upcoming->price }}.<sup>00</sup></span>
									<i class="fa fa-angle-double-right"></i>
								</div>
								<div class="detail-img">
									<img src="{{ asset('admin/uploads/book_img/' . $upcoming->book_img) }}" alt="">
								</div>
							</div>		
							@endforeach					
						</div>
					</div>
				<!-- Release Book Detail -->

				<!-- Thumbs -->
				<div class="release-thumb-holder">
                    @php
                        use Illuminate\Support\Str;
                    @endphp
						<ul id="release-thumb" class="release-thumb">
							@foreach ( $upcomings  as  $upcoming )
                                <li>
								<a data-slide-index="0" href="#">
									<span>{{ str::limit($upcoming->title , 12) }}</span>
									<img src="{{ asset('admin/uploads/book_img/' . $upcoming->book_img) }}" alt="" style=" width: 10rem;">
									<span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
								</a>
							</li>
                            @endforeach
						</ul>
					</div>
				<!-- Thumbs -->

			</div>
		</div>
		<!-- Upcoming Release Slider -->

		</section>
	
		<!-- Best Seller Products -->
		<section class="best-seller tc-padding">
		<div class="container">
			
			<!-- Main Heading -->
			<div class="main-heading-holder">
				<div class="main-heading style-1">
					<h2>Best <span class="theme-color">Downloaded</span> Books</h2>
				</div>
			</div>
			<!-- Main Heading -->

			<!-- Best sellers Tabs -->
			<div id="best-sellers-tabs" class="best-sellers-tabs">
			  	<!-- Tab panes -->
			  	<div class="tab-content">

			  		<!-- Best Seller Slider -->
			    	<div id="tab-1">
			    		<div class="best-seller-slider">
			    			<!-- Product Box -->
			    			@foreach ($downloads as $download)
								<div class="item">
			    				<div class="product-box">
			    					<div class="product-img">
			    						<img src="{{ asset('admin/uploads/book_img/' . $download->book_img) }}" alt="" width="109" height="164">
			    						<ul class="product-cart-option position-center-x">
			    							<li><a href="{{ $download->author->facebook_id}}"><i class="fa fa-facebook"></i></a></li>
			    							<li><a href="{{ $download->author->twitter_id}}"><i class="fa fa-twitter"></i></a></li>
			    							<li><a href="{{ $download->author->twitter_id}}"><i class="fa fa-linkedin"></i></a></li>
			    						</ul>
			    					</div>
			    					<div class="product-detail">
			    						<span>{{ $download->format }}</span>
			    						<h5><a href="{{ Route('book.detail', $download->slug) }}">{{ $download->title }}</a></h5>
			    						<p>{{ Str::limit($download->description , 20) }}</p>
			    						<div class="rating-nd-price">
			    							<strong>{{ $download->price }}</strong>
			    						</div>
			    						<div class="aurthor-detail">
			    							<span><img src="{{asset('admin/uploads/author_img/' . $download->author->author_img)}}" alt="" style=" width: 40px; height: 40px;">{{ $download->author->title }}</span>
			    							<a class="add-wish" href="#"><i class="fa fa-heart"></i></a>
			    						</div>
			    					</div>
			    				</div>
			    			</div>
							@endforeach
			    			<!-- Product Box -->
			    			
			    			
			    		</div>
			    	</div>
			    	<!-- Best Seller Slider -->
			  	</div>
			  	<!-- Tab panes -->

				</div>
			<!-- Best sellers Tabs -->
		</div>
	</section>
		<!-- Best Seller Products -->

		<!-- Recomend products -->
		<div class="recomended-products tc-padding">
			<div class="container">
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2>Staff <span class="theme-color">Recomended </span> Books</h2>
						<p>Whether you’re a large or small employer, enterpreneur, educational institution, professional</p>
					</div>
				</div>
				<!-- Main Heading -->

				<!-- Recomend products Slider -->
				<div class="recomend-slider">


					<!-- Item -->
					@foreach ($recomendes as $recomende)
						<div class="item">
						<a href="{{ Route('book.detail', $recomende->slug) }}"><img src="{{ asset('admin/uploads/book_img/' . $recomende->book_img) }}" alt="" width="109" height="164"></a>
					</div>
					@endforeach
					<!-- Item -->
				</div>
				<!-- Recomend products Slider -->
			</div>
		</div>
		<!-- Recomend products -->

		<!-- Book Collections -->
		<section class="book-collection">
			<div class="container">
				<div class="row">

					<!-- Book Collections Tabs -->
					<div>
						<!-- collection Name -->
						<div class="col-lg-3 col-sm-12">
							<div class="sidebar">
								<h4>Top Books Catagories</h4>
								<ul>
									@foreach ($categories as $category)
										
									<li><a href="{{ route('category_detail' , $category->slug) }}">{{ $category->title }}</a></li>
									@endforeach
									
								</ul>
							</div>
						</div>
						<!-- collection Name -->

						<!-- Collection Content -->
						<div class="col-lg-9 col-sm-12">
							<div class="collection">

								<!-- Secondary heading -->
								<div class="sec-heading">
									<h3>Shop <span class="theme-color">Books</span> Collection</h3>
									<a class="view-all" href="#">View All<i class="fa fa-angle-double-right"></i></a>
								</div>
								<!-- Secondary heading -->

								<!-- Collection Content -->
								<div class="collection-content">
									<ul>
										@foreach ($books as $book)
											<li>
											<div class="s-product">
												<div class="s-product-img">
													<img src="{{ asset('admin/uploads/book_img/'. $book->book_img) }}" alt="" width="145" height="185">
													<div class="s-product-hover"></div>
												</div>
												<h6><a href="{{ route('book.detail' , $book->slug) }}">{{ $book->title }}</a></h6>
												<span>{{ $book->author->title }}</span>
											</div>
										</li>
										@endforeach
										
									</ul>
								</div>
								<!-- Collection Content -->

								<!-- Pagination -->
								<div class="pagination-holder">
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
						</div>
						<!-- Collection Content -->
					</div>
					<!-- Book Collections Tabs -->
				</div>
			</div>
		</section>
		<!-- Book Collections Tabs -->

				</div>
			</div>
		</section>
		<!-- Book Collections --> 

		<!-- Services -->
		<section>&nbsp;</section>
		<!-- Services --> 

		<!-- Timeline -->
		<section class="timeline-area tc-padding">
			<div class="container">
				<div class="row">
					<!-- Aurthor -->
					<div class="row mb-5">
						<!-- Author Image -->
			
				<div class="col-lg-3 col-sm-12">
					<div class="author-img">
					@if($author_feature->author_img == 'No image found')
						<img src="/uploads/no-img.png" width="243" height="344" alt="No image found">
					@else
						<img src="{{ asset('admin/uploads/author_img/'. $author_feature->author_img) }}" width="243" height="344" alt="No image found">
					@endif
					</div>
				</div>

				<div class="col-lg-9 col-sm-12 h-white">
					<h2>{{ $author_feature->title }} <span class="theme-color">History</span> of Innovation</h2>
					<div class="text-box">
						<div class="left-box">
							<h5><span class="theme-color">{{ $author_feature->name }}</span></h5>
							<p>{{ $author_feature->description }}</p>
							<!-- Add more author-related content here -->
						</div>
					</div>
				</div>
			
					</div>

     
                <!-- Books of This Author -->
              
    				<ul class="s-related-products" style="margin-top: -19rem;">
						@foreach ($author_feature->books->take(3) as $book)  
							<li>
								<img src="{{ asset('admin/uploads/book_img/' . $book->book_img) }}" alt="{{ $book->title }}" width="145" >
								<h6 class="name">{{ $book->title }}</h6>
							</li>
						@endforeach
					</ul>
            </div>
        </div>
    </div>
	

					<!-- Aurthor History -->

				</div>
			</div>
		</section>
		<!-- Timeline --> 

		<!-- Blog Nd Gallery-->
		<section class="tc-padding">
			<div class="container">
		    <div class="row">
    <!-- Blog -->
    <div class="col-lg-4 col-xs-12">
        <!-- Secondary heading -->
        <div class="sec-heading">
            <h3>Latest <span class="theme-color">author</span> Post</h3>
        </div>
        <!-- Secondary heading -->

        <!-- Blog list -->
        <div class="blog-style-1">
            @foreach ($authors as $author)
                <div class="post-box">
                    <div class="thumb">
                        <img src="{{ asset('admin/uploads/author_img/' . $author->author_img) }}" alt="" width="139" height="106">
                    </div>
                    <div class="text-column">
                        <strong><i class="fa fa-user" aria-hidden="true"></i> {{ $author->title }}</strong>
                        <a href="blog-detail.html">{{ Str::limit($author->description, 35) }}</a>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Blog list -->

    </div>
    <!-- Blog -->

    <!-- Gallery -->
    <div class="col-lg-8 col-xs-12">
        <div class="gallery">

            <!-- Secondary heading -->
            <div class="sec-heading">
                <h3>Gallery <span class="theme-color">Bookshop</span></h3>
                <a class="view-all" href="#">View All<i class="fa fa-angle-double-right"></i></a>
            </div>
            <!-- Secondary heading -->

            <!-- Gallery List -->
            <ul>
                @foreach ($media_galleries as $media_gallery)
                    <li>
                        <div class="gallery-figure">
                            <img src="{{ asset('admin/uploads/media_img/' . $media_gallery->media_img) }}" alt="" width="242" height="242">
                            <div class="overlay">
                                <ul class="position-center-x">
                                    <li><a href="#"><i class="fa fa-heart"></i>Likes</a></li>
                                    <li>
                                        <a href="{{ asset('admin/uploads/media_img/' . $media_gallery->media_img) }}" data-rel="prettyPhoto[gallery]">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- Gallery List -->

        </div>
    </div>
    <!-- Gallery -->

</div>

		  	</div>
		</section>
		<!-- Blog Nd Gallery--> 
	</main>
@endsection