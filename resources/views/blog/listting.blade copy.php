@extends('layouts.client_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog Masonry 4 Columns<span>Blog</span></h1>
        </div><!-- End .container -->
    </div><!-- End .pagessets/css/bootstrap.min.css-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                   
                   <li class="breadcrumb-item active" aria-current="page">Blog</li>
            
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <nav class="blog-nav">
                <ul class="menu-cat entry-filter ">
                    <li class="active"><a href="#" data-filter="*">All Blog Posts<span>{{$count}}</span></a></li>
                   
                </ul><!-- End .blog-menu -->
            </nav><!-- End .blog-nav -->

            <div class="entry-container max-col-4">
            @foreach($blogs as $blog)
                <div class="entry-item lifestyle shopping col-sm-6 col-md-4 col-lg-3">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                        <a href="{{ route('blogs.detail', $blog->blog_id) }}">
                        <img style="height:200px" src="{{ asset('storage/' . $blog->image) }}" alt="Blogs Image" >
                         </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta ">
                            <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->created_at->format('M d, Y')}}</a>
                                <span class="meta-separator">|</span>
                              
                                                in 
                                                <a class="ml-2" href="{{ route('blogs.detail', $blog->blog_id) }}">{{ strtoupper($blog->tags) }}</a>
                                 
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                            <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->title}}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">
                                           
                                                <a href="{{ route('blogs.detail', $blog->blog_id) }}" class="read-more">Continue Reading</a>
                                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
                @endforeach

                

                
            </div><!-- End .entry-container -->

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
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
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
{{-- 
@section('script-link-css')
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
@endsection --}}