@extends('layouts.client_layout')

     @section('content')
        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Blog Listing<span>Blog</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                   
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                            

            
                        @foreach($blogs as $blog)
                            <article class="entry entry-list">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <figure class="entry-media">
                                            <a href="{{ route('blogs.detail', $blog->blog_id) }}">
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blogs Image" >
                                            </a>
                                        </figure><!-- End .entry-media -->
                                    </div><!-- End .col-md-5 -->

                                    <div class="col-md-7">
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->staff->full_name;
                                                    }}</a>
                                                </span>
                                                <span class="meta-separator">|</span>
                                                <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->created_at->format('M d, Y')}}</a>
                                                <span class="meta-separator">|</span>
                                                <!-- <a href="#">0 Comments</a> -->
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title">
                                                <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->title}}.</a>
                                            </h2><!-- End .entry-title -->

                                            <div class="entry-cats">    
                                                in
                                                <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{ strtoupper($blog->tags) }}</a>
                                            </div><!-- End .entry-cats -->

                                            <div class="entry-content">
                                                <p>{{$blog->short_description}}</p>
                                                <a href="{{ route('blogs.detail', $blog->blog_id) }}" class="read-more">Continue Reading</a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </div><!-- End .col-md-7 -->
                                </div><!-- End .row -->
                            </article><!-- End .entry -->
                            @endforeach

                			<nav aria-label="Page navigation">
							    <ul class="pagination">
							        <li class="page-item disabled">
							            <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
							                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
							            </a>
							        </li>
							        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
							        <li class="page-item"><a class="page-link" href="#">2</a></li>
							        <li class="page-item">
							            <a class="page-link page-link-next" href="#" aria-label="Next">
							                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
							            </a>
							        </li>
							    </ul>
							</nav>
                		</div><!-- End .col-lg-9 -->

                		@include('blocks.blog.aside-blog')
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

      
                                        @endsection
            
                                      
                                     