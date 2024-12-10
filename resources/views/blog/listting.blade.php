@extends('layouts.client_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blogs Us<span>Blogs</span></h1>
        </div><!-- End .container -->
    </div><!-- End .pagessets/css/bootstrap.min.css-header --> 
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                </ol>

                <!-- Filter Button -->
                <ol class="breadcrumb mb-0">

                    <div class="widget widget-search search-blogs">


                        <form action="{{ route('blog.search') }}" method="GET">
                            <label for="ws" class="sr-only">Search in blog</label>
                            <input type="search" class="form-control" name="ws" placeholder="Search in blog" value="{{ request('ws') }}">
                            <button type="submit" class="btn"><i class="icon-search"></i><span
                                    class="sr-only">Search</span></button>
                        </form>
                    </div><!-- End .widget -->
                    <!-- Collapse Section for Filter -->
                    <div class="collapse position-absolute right-0 mt-5" id="filter-collapse">
                        <div class="widget widget-collapsible">
                            <div class="widget-body">
                                <select name="filter" class="form-control" id="filter-collapse">
                                    <option value="" disabled selected>Please select a time period</option>
                                    <option value="option1">Option 1</option>
                                    <option value="option2">Option 2</option>
                                    <option value="option3">Option 3</option>
                                    <option value="option4">Option 4</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <!-- Search Form -->



                </ol>

            </div>

            <!-- Collapse Section (Filter Input) -->

        </div>


        <!-- End .container -->
        <!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <nav class="blog-nav">
                <ul class="menu-cat entry-filter justify-content-center">
                    <li class="active"><a href="#" data-filter="*">All Blog Posts<span>{{ $blogs->count() }}</span></a>
                    </li>
                    @if($category->isNotEmpty())
                    @foreach($category as $cat)
                    @if($cat->blogs_count > 0)
                    <li>
                        <a href="#" data-filter=".cat{{$cat->category_id}}">
                            {{ $cat->name_category }} <span>{{ $cat->blogs_count }}</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    @else
                    <p>Not empty blog category!</p>
                    @endif

                </ul><!-- End .blog-menu -->
            </nav><!-- End .blog-nav -->

            <div class="entry-container max-col-4">
                @if($blogs->isNotEmpty())
                @foreach($blogs as $blog)
                <div class="entry-item cat{{$blog->category_id}} shopping col-sm-6 col-md-4 col-lg-3">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                            <a href="{{ route('blogs.detail', $blog->blog_id) }}">
                                <img style="height:200px" src="{{ asset('storage/' . $blog->image) }}"
                                    alt="Blogs Image">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta ">
                                <a
                                    href="{{ route('blogs.detail', $blog->blog_id) }}">{{ $blog->created_at->format('M d, Y') }}</a>
                                <span class="meta-separator">|</span>


                                @if($blog->category)
                                in
                                <a class="ml-2" href="{{ route('blogs.detail', $blog->blog_id) }}">
                                    {{$blog->category->name_category}}
                                </a>
                                @else
                                <p>Not empty blog category!</p>
                                @endif

                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{ route('blogs.detail', $blog->blog_id) }}">{{$blog->title}}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">

                                <a href="{{ route('blogs.detail', $blog->blog_id) }}" class="read-more">Continue
                                    Reading</a>
                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
                @endforeach

            </div><!-- End .entry-container -->

           
            @else
            <p class="text-danger ">Not empty blogs!</p>
            @endif
            @if ($blogs->hasPages())
            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
            {{-- Nút Previous --}}
            @if ($blogs->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-prev" href="{{ $blogs->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                    </a>
                </li>
            @endif

            {{-- Các số trang --}}
            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                @if ($page == $blogs->currentPage())
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Nút Next --}}
            @if ($blogs->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-next" href="{{ $blogs->nextPageUrl() }}" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link page-link-next" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection

@section('script-link-css')
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
@endsection