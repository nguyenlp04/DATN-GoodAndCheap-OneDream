@extends('layouts.client_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{$blogs->title}}<span>Detail Post</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="{{Route('blogs.listting')}}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$blogs->title}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{ asset('storage/' . $blogs->image) }}" alt="image desc">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">{{$blogs->staff->full_name}}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#">{{$blogs->created_at ->format('M d, Y')}}</a>

                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                {{$blogs->title}}
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                @if($blogs->category)
                                in
                                <a href="{{ route('blogs.detail', $blogs->blog_id) }}">
                                    {{ strtoupper($blogs->category->name_category) }}
                                </a>
                                @else
                                <span>Không có danh mục</span>
                                @endif

                            </div><!-- End .entry-cats -->

                            <div class="entry-content editor-content">
                                {!!$blogs->content!!}
                            </div><!-- End .entry-content -->

                            <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    <div class="entry-tags">
                                        <span>Tags:</span> <a
                                            href="{{ route('blogs.detail',$blogs->blog_id)}}">{{ strtoupper($blogs->tags) }}</a>

                                    </div><!-- End .entry-tags -->
                                </div><!-- End .col -->

                                <div class="col-md-auto mt-2 mt-md-0">
                                    <div class="social-icons social-icons-color">
                                        <span class="social-label">Share this post:</span>
                                        <a href="#" class="social-icon social-facebook" title="Facebook"
                                            target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon social-twitter" title="Twitter"
                                            target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon social-pinterest" title="Pinterest"
                                            target="_blank"><i class="icon-pinterest"></i></a>
                                        <a href="#" class="social-icon social-linkedin" title="Linkedin"
                                            target="_blank"><i class="icon-linkedin"></i></a>
                                    </div><!-- End .soial-icons -->
                                </div><!-- End .col-auto -->
                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->


                    </article><!-- End .entry -->



                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->

                        <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "dots": true,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":1
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            }
                                        }
                                    }'>

                            @foreach($relatedBlogs as $blog)
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/blog/grid/3cols/post-1.jpg') }}"
                                            alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">{{$blog->created_at ->format('M d, Y')}}</a>


                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">{{$blog->title}}</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        @if($blogs->category)
                                        in
                                        <a href="{{ route('blogs.detail', $blogs->blog_id) }}">
                                            {{ strtoupper($blogs->category->name_category) }}
                                        </a>
                                        @else
                                        <span>Không có danh mục</span>
                                        @endif

                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                            @endforeach

                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->



                </div><!-- End .col-lg-9 -->

                @include('blog.aside-blog')
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script-link-css')

<script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
@endsection