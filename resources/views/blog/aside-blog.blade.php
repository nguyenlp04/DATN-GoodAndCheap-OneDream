<aside class="col-lg-3">
    <div class="sidebar">
        <div class="widget widget-search">
            <h3 class="widget-title">Search</h3><!-- End .widget-title -->

            <form action="#">
                <label for="ws" class="sr-only">Search in blog</label>
                <input type="search" class="form-control" name="ws" id="ws" placeholder="Search in blog" required>
                <button type="submit" class="btn"><i class="icon-search"></i><span
                        class="sr-only">Search</span></button>
            </form>
        </div><!-- End .widget -->

        <div class="widget widget-cats">
            <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

            <ul>
                @if($category->isNotEmpty())
                <!-- Kiểm tra nếu $category không rỗng -->
                @foreach($category as $cat)
                @if($cat->blogs_count > 0)
                <li><a href="#">{{$cat->name_category}}<span>{{$cat->blogs_count}}</span></a></li>
                @endif
                @endforeach
                @else
                <p>No blog categories available!</p> <!-- Thông báo khi không có danh mục blog nào -->
                @endif



            </ul>
        </div><!-- End .widget -->

        <div class="widget">
            <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->

            <ul class="posts-list">
                @foreach($topBlogs as $topblog)
                <li>
                    <figure>
                        <a href="{{ route('blogs.detail',$topblog->blog_id)}}">
                            <img style="width:70px ;max-height: 50px" src="{{ asset('storage/' . $topblog->image) }}"
                                alt="Blogs Image">
                        </a>
                    </figure>

                    <div>
                        <span>{{$topblog->created_at->format('M d, Y')}}</span>
                        <h4><a
                                href="{{ route('blogs.detail',$topblog->blog_id)}}">{{ Str::limit($topblog->title, 15, '...') }}</a>
                        </h4>
                    </div>
                </li>
                @endforeach
            </ul><!-- End .posts-list -->
        </div><!-- End .widget -->
        <div class="widget widget-banner-sidebar">
            <div class="banner-sidebar-title">ad box 280 x 280</div><!-- End .ad-title -->

            <div class="banner-sidebar">
                <a href="#">
                    <img src="{{ asset('assets/images/blog/sidebar/banner.jpg') }}" alt="banner">
                </a>
            </div><!-- End .banner-ad -->
        </div><!-- End .widget -->

        <div class="widget">
            <h3 class="widget-title">Browse Tags</h3><!-- End .widget-title -->

            <div class="tagcloud">
                @foreach($alltags as $blog)
                <a href="{{ route('blogs.detail',$blog->blog_id)}}">{{ strtoupper($blog->tags) }}</a>

                @endforeach


            </div><!-- End .tagcloud -->
        </div><!-- End .widget -->


    </div><!-- End .sidebar -->
</aside><!-- End .col-lg-3 -->