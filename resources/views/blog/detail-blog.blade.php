@extends('layouts.client_layout')

@section('content')
<main class="main">
   
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
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


                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->


                    </article><!-- End .entry -->



                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->

                        <div class="owl-carousel owl-simple" data-toggle="owl">
                            @if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
                            @foreach($relatedBlogs as $blog)
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="{{ route('blogs.detail', $blog->blog_id) }}">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blogs Image"
                                            style="max-height:130px">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a
                                            href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->created_at ->format('M d, Y')}}</a>


                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->title}}</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        @if($blogs->category)
                                        in
                                        <a href="{{ route('blogs.detail', $blogs->blog_id) }}">
                                            {{ strtoupper($blogs->category->name_category) }}
                                        </a>
                                        @else
                                        <p>Not empty blog category!</p>
                                        @endif

                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                            @endforeach
                            @else
                            <p>Not empty related blogs!</p>
                            @endif

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