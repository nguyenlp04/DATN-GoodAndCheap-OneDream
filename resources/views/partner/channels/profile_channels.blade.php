@extends('layouts.client_layout')
@section('content')
<style>
   .channel-info {
   display: flex;
   align-items: center;
   padding: 20px;
   border: 1px solid #ddd;
   border-radius: 15px;
   background-color: #f9f9f9;
   margin: 20px auto;
   box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
   transition: all 0.3s ease;
   }
   .channel-info:hover {
   transform: translateY(-5px);
   box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
   }
   .channel-info img {
   width: 100px;
   height: 100px;
   border-radius: 50%;
   object-fit: cover;
   margin-right: 20px;
   transition: transform 0.3s ease;
   }
   .channel-info img:hover {
   transform: scale(1.1);
   }
   .channel-name {
   font-size: 22px;
   font-weight: bold;
   color: #333;
   margin-bottom: 5px;
   }
   .channel-username {
   font-size: 16px;
   color: #888;
   margin-bottom: 10px;
   }
   .channel-stats {
   color: #555;
   font-size: 14px;
   display: flex;
   align-items: center;
   justify-content: flex-start;
   flex-wrap: wrap;
   }
   .channel-stats span {
   margin-right: 15px;
   }
   .channel-actions {
   margin-left: auto;
   }
   .channel-actions a {
   border-radius: 25px;
   padding: 8px 20px;
   font-size: 14px;
   text-decoration: none;
   transition: background-color 0.3s ease;
   display: inline-block;
   }
   .channel-actions a:hover {
   background-color: #0056b3;
   }
   .channel-actions .btn-danger:hover {
   background-color: #d9534f;
   }
   .stats-info {
   font-size: 14px;
   color: #e84e40;
   display: flex;
   align-items: center;
   }
   .stats-info i {
   margin-right: 5px;
   }
   .heading .title {
   font-size: 24px;
   font-weight: bold;
   color: #333;
   }
   .heading-right .title-link {
   font-size: 16px;
   color: #007bff;
   text-decoration: none;
   font-weight: 500;
   }
   .heading-right .title-link:hover {
   text-decoration: underline;
   }
   .sale-card {
   border: 1px solid #ddd;
   border-radius: 15px;
   background-color: #f9f9f9;
   margin: 15px 0;
   padding: 15px;
   box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
   }
   .sale-card .title {
   font-size: 18px;
   font-weight: bold;
   }
   .sale-card .price {
   color: #e84e40;
   font-size: 16px;
   font-weight: bold;
   }
   .sale-card .description {
   color: #555;
   font-size: 14px;
   }
   .sale-card .status {
   font-size: 14px;
   color: #888;
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
<main class="container mb-5">
   <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
      <div class="container">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Channel</li>
         </ol>
      </div>
      <!-- End .container -->
   </nav>
   <!-- End .breadcrumb-nav -->
   <div class="row">
    <div class="row d-flex justify-content-start">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div style="width: fit-content; min-width:460px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            @if (auth()->user()->image_user)
                            <img src="{{ Storage('') }}"
                                alt="User image" class="img-fluid" style="width: 120px; border-radius: 10px;">
                            @else
                            <img src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg"
                                alt="Generic placeholder image" class="img-fluid" style="width: 120px; border-radius: 10px;">
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">{{ $channels->name_channel }}</h5>
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Phần bên trái -->
                                <div class="rounded-3 p-2 mb-2 bg-body-tertiary" style="width: fit-content;">
                                    <p class="small text-muted">
                                        <i class="fa-solid fa-file-invoice-dollar" style="color: #74C0FC;"></i>
                                        {{ $channels->address }}
                                    </p>
                                </div>

                                <!-- Phần bên phải -->
                                <div>
                                    <div class="d-flex flex-column align-items-start rounded-3 p-2 mb-2 bg-body-tertiary" style="width: fit-content;">
                                        <p class="small text-muted">
                                            <i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $channels->created_at }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="container for-you">
         <!-- Sales News -->
         <main class="main">
            <div class="page-content">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-9">
                        <div class="products mb-3">
                           @foreach ($sale_news as $sale_new)
                           <div class="product product-list">
                              <div class="row">
                                 <div class="col-6 col-lg-3">
                                    <figure class="product-media">
                                       @if($sale_new->vip_pakage_id != null)
                                       <span class="product-label label-new">
                                       On top
                                       </span>
                                       @endif
                                       <a href="product.html">
                                       <img src="/assets/images/products/product-4.jpg" alt="Product image1" class="product-image">
                                       </a>
                                    </figure>
                                    <!-- End .product-media -->
                                 </div>
                                 <!-- End .col-sm-6 col-lg-3 -->
                                 <div class="col-6 col-lg-3 order-lg-last">
                                    <div class="product-list-action">
                                       <div class="product-price">
                                          {{ $sale_new -> price  }} $
                                       </div>
                                       <!-- End .product-price -->
                                       <div class="product">
                                          <a href="#" class=" btn-product btn-wishlist" title="Compare"><span>wishlist</span></a>
                                       </div>
                                       <!-- End .product-action -->
                                       <a href="#" class="btn btn-primary"><span>Details</span></a>
                                    </div>
                                    <!-- End .product-list-action -->
                                 </div>
                                 <!-- End .col-sm-6 col-lg-3 -->
                                 <div class="col-lg-6">
                                    <div class="product-body product-action-inner">
                                       <div class="product-cat">
                                          <a href="#">{{ $sale_new->name_sub_category ?? 'Not allow'}}</a>
                                       </div>
                                       <!-- End .product-cat -->
                                       <h3 class="product-title"><a href="product.html">{{ $sale_new ->title }}</a></h3>
                                       <!-- End .product-title -->
                                       <div class="product-content wrap">
                                          <p>{{ $sale_new ->description }}</p>
                                       </div>
                                       <!-- End .product-content -->
                                       <div class="">
                                          <a href="#">
                                             <p>{{ $sale_new ->content }}</p>
                                          </a>
                                          <a href="#">
                                             <p>{{ $sale_new ->created_at }}</p>
                                          </a>
                                          <a href="#">
                                             <p>{{ $sale_new ->channel->address }}</p>
                                          </a>
                                       </div>
                                       <!-- End .product-nav -->
                                    </div>
                                    <!-- End .product-body -->
                                 </div>
                                 <!-- End .col-lg-6 -->
                              </div>
                              <!-- End .row -->
                           </div>
                           <!-- End .product -->
                           @endforeach
                        </div>
                        <!-- End .products mb-3 -->
                        @if($NewsCount == 0)
                        <ul class="pagination">
                           <p >No found sales news</p>
                        </ul>
                        @endif
                     </div>
                     <!-- End .col-lg-9 -->
                     <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                           <div class="widget widget-collapsible">
                              <h3 class="widget-title">
                                 <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                 Category
                                 </a>
                              </h3>
                              <!-- End .widget-title -->
                              <div class="collapse show" id="widget-1">
                                 <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                       @foreach($subcategory_count as $name => $count)
                                       <div class="filter-item">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="{{ Str::slug($name) }}" value="{{ $name }}">
                                             <label class="custom-control-label" for="{{ Str::slug($name) }}">
                                                <p>{{ $name }}</p>
                                             </label>
                                          </div>
                                          <!-- End .custom-checkbox -->
                                          <span class="item-count">{{ $count }}</span>
                                       </div>
                                       <!-- End .filter-item -->
                                       @endforeach
                                    </div>
                                    <!-- End .filter-items -->
                                 </div>
                                 <!-- End .widget-body -->
                              </div>
                              <!-- End .collapse -->
                           </div>
                           <!-- End .widget -->
                           <div class="widget widget-collapsible">
                              <h3 class="widget-title">
                                 <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                 Brand
                                 </a>
                              </h3>
                              <!-- End .widget-title -->
                              <div class="collapse show" id="widget-4">
                                 <div class="widget-body">
                                    <div class="filter-items">
                                       <div class="filter-item">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="brand-7">
                                             <label class="custom-control-label" for="brand-7">Nike</label>
                                          </div>
                                          <!-- End .custom-checkbox -->
                                       </div>
                                       <!-- End .filter-item -->
                                    </div>
                                    <!-- End .filter-items -->
                                 </div>
                                 <!-- End .widget-body -->
                              </div>
                              <!-- End .collapse -->
                           </div>
                           <!-- End .widget -->
                        </div>
                        <!-- End .sidebar sidebar-shop -->
                     </aside>
                     <!-- End .col-lg-3 -->
                  </div>
                  <!-- End .row -->
               </div>
               <!-- End .container -->
            </div>
            <!-- End .page-content -->
         </main>
         <!-- End .main -->
      </div>
   </div>
</main>
@endsection
