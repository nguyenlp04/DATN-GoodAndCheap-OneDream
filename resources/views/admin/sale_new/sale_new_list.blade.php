@extends('layouts.admin')
@section('content')
<style>
  /* Đảm bảo bảng có chiều rộng cố định */
  .table td, .table th {
   
    white-space: normal;    /* Đảm bảo không có từ nào bị ẩn */
  }

  /* Đảm bảo bảng không thay đổi kích thước */
  .table { 
    table-layout: fixed;
    width: 100%;
  }
  /* Điều chỉnh cho các nút trong bảng */
.table .btn {
  width: 40px;  /* Chiều rộng cố định */
  height: 40px; /* Chiều cao cố định */
  padding: 0;   /* Xóa bỏ padding mặc định */
  margin: 0 5px; /* Khoảng cách giữa các nút */
  text-align: center; /* Canh giữa nội dung trong nút */
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Chỉnh sửa các nút có biểu tượng */
.table .btn i {
  font-size: 20px; /* Kích thước icon */
}

/* Đảm bảo khoảng cách đồng đều cho các nút */
.table td .btn {
  margin-right: 10px;
}

</style>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce" >

      <!-- Add Blogs Header -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Sale News</h4>
        </div>
      </div>

      <!-- Nav tabs -->
      <ul class="nav nav-tabs mb-2 " role="tablist">
  
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#all"> All news</a>
        </li>

            @if($data->where('approved', 1)->count() > 0)
                 <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#approved">Approved</a>
                  </li>
             @else

            @endif
            @if($data->where('approved', 2)->count() > 0)
                  <li class="nav-item ">
                    <a class="nav-link " data-bs-toggle="tab" href="#rejected">Rejected</a>
                  </li>
                  @else

              @endif
        @if($count>0)
        <li class="nav-item position-relative">
          <a class="nav-link" data-bs-toggle="tab" href="#waiting">Waiting for approved</a>
          
          <div class="position-absolute top-0 start-100 translate-middle text-center bg-danger d-inline-block rounded-circle" style="width: 20px; height: 20px;">
            <span class="text-white d-flex justify-content-center align-items-center" style="line-height: 20px; font-size:10px;">{{ $count}}</span>
          </div>
        </li>
       @else
       @endif
      </ul>

      <!-- Blog Table -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-6">
            <div class="card-body">

              <!-- Tab panes -->
              <div class="tab-content p-0">
                
                <!-- All news Tab -->
                <div id="all" class="container-fluid p-0 tab-pane active">
                  <h2>All news</h2>
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>Id news</th>
                        <th>user</th>
                        <th>Category</th>
                    
                        <th>approved</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-secondary my-1">#{{$item->sale_new_id}} 
                               @if($item->vip_package_id >0)
                              <span><i class="fa-solid text-warning fa-star me-1"></i></span> 
                              @else
                              @endif
                              <!-- Biểu tượng ngôi sao -->
                            </span>
                          </div>
                         

                        
                           
                        </td>
                        <td >
                        <!-- @if($item->approved == 0)
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif -->
                           {{$item->user->full_name}}

                        </td>
                        <td class="bg-light rounded">
                        <span class="badge bg-label-primary"> {{ $item->sub_category->category->name_category }} </span>
                        <span class="text-muted"> &#8594; </span>
                            <span class="badge text-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                       
                        <td class="bg-light rounded">
                            @if($item->approved == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->approved == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->approved == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Product:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="a" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $item->name_product }}</h6>
                                          <small class="text-truncate-1">{{ $item->description }}</small>
                                       
                            
                                      

                                        </div>
                                        <div >   
                                          @if($item->vip_package_id >0)
                                            <span class="badge text-warning"><i class="fa-solid text-warning fa-star me-1" style="margin-left:50px"></i> {{ $item->vippackage->name }}</span> 
                                            @else
                                            @endif</div>
                                     
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-label-secondary">{{ $item->sub_category->category->name_category }}</span>
                                      <span class="text-muted"> &#8594; </span>
                                      <span class="badge text-secondary">{{ $item->sub_category->name_sub_category }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($item->price, 2) }}</span></td>
                                  </tr>
                                 
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $item->user->full_name }}</span></td>
                                  </tr>
                                  
                                    
                                      @if($item->approved == 0)
                                      <tr data-dt-row="2" data-dt-column="8">
                                      <td class="col-3">Time remaining:</td>
                                    <td class="col-8 bg-light rounded">
                                    <div class="d-flex align-items-center" style="font-size: 15px; font-weight:700">
                                          <i class="fa-regular fa-clock text-danger me-1"></i> <!-- Thêm margin-right cho icon để cách ra với chữ -->
                                          
                                          <p class="text-danger mb-0"> <!-- Sử dụng mb-0 để loại bỏ margin-bottom của đoạn văn -->
                                              @php
                                                  // Tính số ngày và giờ còn lại đến hết 7 ngày
                                                  $endTime = \Carbon\Carbon::parse($item->created_at)->addDays(7);  // Thời gian kết thúc sau 7 ngày
                                                  $remainingDays = floor(\Carbon\Carbon::now()->diffInDays($endTime, false));  // Số ngày còn lại (làm tròn xuống số nguyên)
                                                  $remainingHours = floor(\Carbon\Carbon::now()->diffInHours($endTime, false) % 24);  // Số giờ còn lại (làm tròn xuống số nguyên)
                                              @endphp

                                              @if($remainingDays > 0)
                                                  {{ $remainingDays }} day
                                              @endif

                                              @if($remainingHours > 0)
                                                  {{ $remainingHours }} hours
                                              @endif
                                          </p>
                                          </td>
                                  </tr>
                                      @else
                                          <!-- Nếu approved không bằng 0, không hiển thị gì -->
                                      @endif
                                      
                                  </div>
                                    
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($item->created_at)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($item->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-secondary">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  
                                </tbody>
                              </table>

                            </div>
                                    </div>
                                  </div>
                                </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <form action="{{ route('sale_news.reject', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                    </form>
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event, {{ $item->sale_new_id }})">
                                        <form id="delete-form-{{ $item->sale_new_id }}" action="{{ route('sale_news.destroy', $item->sale_new_id) }}" method="POST" >
                                          @csrf
                                          @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                                </button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach





                      <!-- end item -->
                    </tbody>
                  </table>
                </div>

                <!-- Active Tab -->
                <div id="approved" class="container-fluid p-0 tab-pane fade">
                  <h2>Approved</h2>
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>Id news</th>
                        <th>Start date</th>
                        <th>Category</th>
                       
                        <th>approved</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->approved==1)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-secondary my-1">#{{$item->sale_new_id}} 
                               @if($item->vip_package_id >0)
                              <span><i class="fa-solid text-warning fa-star me-1"></i></span> 
                              @else
                              @endif
                              <!-- Biểu tượng ngôi sao -->
                            </span>
                          </div>
                         

                        
                           
                        </td>
                        <td >
                        <!-- @if($item->approved == 0)
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif -->
                           {{$item->user->full_name}}

                        </td>
                        <td class="bg-light rounded">
                        <span class="badge bg-label-primary"> {{ $item->sub_category->category->name_category }} </span>
                        <span class="text-muted"> &#8594; </span>
                            <span class="badge text-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                       
                        <td class="bg-light rounded">
                            @if($item->approved == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->approved == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->approved == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal1{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal1{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Product:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="a" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $item->name_product }}</h6>
                                          <small class="text-truncate-1">{{ $item->description }}</small>
                                       
                            
                                      

                                        </div>
                                        <div >   
                                          @if($item->vip_package_id >0)
                                            <span class="badge text-warning"><i class="fa-solid text-warning fa-star me-1" style="margin-left:50px"></i> {{ $item->vippackage->name }}</span> 
                                            @else
                                            @endif</div>
                                     
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-label-secondary">{{ $item->sub_category->category->name_category }}</span>
                                      <span class="text-muted"> &#8594; </span>
                                      <span class="badge text-secondary">{{ $item->sub_category->name_sub_category }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($item->price, 2) }}</span></td>
                                  </tr>
                                 
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $item->user->full_name }}</span></td>
                                  </tr>
                                  
                                    
                                      @if($item->approved == 0)
                                      <tr data-dt-row="2" data-dt-column="8">
                                      <td class="col-3">Time remaining:</td>
                                    <td class="col-8 bg-light rounded">
                                    <div class="d-flex align-items-center" style="font-size: 15px; font-weight:700">
                                          <i class="fa-regular fa-clock text-danger me-1"></i> <!-- Thêm margin-right cho icon để cách ra với chữ -->
                                          
                                          <p class="text-danger mb-0"> <!-- Sử dụng mb-0 để loại bỏ margin-bottom của đoạn văn -->
                                              @php
                                                  // Tính số ngày và giờ còn lại đến hết 7 ngày
                                                  $endTime = \Carbon\Carbon::parse($item->created_at)->addDays(7);  // Thời gian kết thúc sau 7 ngày
                                                  $remainingDays = floor(\Carbon\Carbon::now()->diffInDays($endTime, false));  // Số ngày còn lại (làm tròn xuống số nguyên)
                                                  $remainingHours = floor(\Carbon\Carbon::now()->diffInHours($endTime, false) % 24);  // Số giờ còn lại (làm tròn xuống số nguyên)
                                              @endphp

                                              @if($remainingDays > 0)
                                                  {{ $remainingDays }} day
                                              @endif

                                              @if($remainingHours > 0)
                                                  {{ $remainingHours }} hours
                                              @endif
                                          </p>
                                          </td>
                                  </tr>
                                      @else
                                          <!-- Nếu approved không bằng 0, không hiển thị gì -->
                                      @endif
                                      
                                  </div>
                                    
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($item->created_at)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($item->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-secondary">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  
                                </tbody>
                              </table>

                            </div>
                                    </div>
                                  </div>
                                </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <form action="{{ route('sale_news.reject', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                    </form>
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event, {{ $item->sale_new_id }})">
                                        <form id="delete-form-{{ $item->sale_new_id }}" action="{{ route('sale_news.destroy', $item->sale_new_id) }}" method="POST" >
                                          @csrf
                                          @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                                </button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                    </tbody>
                  </table>
                </div>

                <!-- Waiting for approved Tab -->
                <div id="waiting" class="container-fluid p-0 tab-pane fade">
                  <h2>Waiting for approved</h2>
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>Id news</th>
                        <th>Start date</th>
                        <th>Category</th>
                        
                        <th>approved</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->approved==0)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-secondary my-1">#{{$item->sale_new_id}} 
                               @if($item->vip_package_id >0)
                              <span><i class="fa-solid text-warning fa-star me-1"></i></span> 
                              @else
                              @endif
                              <!-- Biểu tượng ngôi sao -->
                            </span>
                          </div>
                         

                        
                           
                        </td>
                        <td >
                        <!-- @if($item->approved == 0)
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif -->
                           {{$item->user->full_name}}

                        </td>
                        <td class="bg-light rounded">
                        <span class="badge bg-label-primary"> {{ $item->sub_category->category->name_category }} </span>
                        <span class="text-muted"> &#8594; </span>
                            <span class="badge text-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                       
                        <td class="bg-light rounded">
                            @if($item->approved == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->approved == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->approved == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal3{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal3{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Product:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="a" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $item->name_product }}</h6>
                                          <small class="text-truncate-1">{{ $item->description }}</small>
                                       
                            
                                      

                                        </div>
                                        <div >   
                                          @if($item->vip_package_id >0)
                                            <span class="badge text-warning"><i class="fa-solid text-warning fa-star me-1" style="margin-left:50px"></i> {{ $item->vippackage->name }}</span> 
                                            @else
                                            @endif</div>
                                     
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-label-secondary">{{ $item->sub_category->category->name_category }}</span>
                                      <span class="text-muted"> &#8594; </span>
                                      <span class="badge text-secondary">{{ $item->sub_category->name_sub_category }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($item->price, 2) }}</span></td>
                                  </tr>
                                 
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $item->user->full_name }}</span></td>
                                  </tr>
                                  
                                    
                                      @if($item->approved == 0)
                                      <tr data-dt-row="2" data-dt-column="8">
                                      <td class="col-3">Time remaining:</td>
                                    <td class="col-8 bg-light rounded">
                                    <div class="d-flex align-items-center" style="font-size: 15px; font-weight:700">
                                          <i class="fa-regular fa-clock text-danger me-1"></i> <!-- Thêm margin-right cho icon để cách ra với chữ -->
                                          
                                          <p class="text-danger mb-0"> <!-- Sử dụng mb-0 để loại bỏ margin-bottom của đoạn văn -->
                                              @php
                                                  // Tính số ngày và giờ còn lại đến hết 7 ngày
                                                  $endTime = \Carbon\Carbon::parse($item->created_at)->addDays(7);  // Thời gian kết thúc sau 7 ngày
                                                  $remainingDays = floor(\Carbon\Carbon::now()->diffInDays($endTime, false));  // Số ngày còn lại (làm tròn xuống số nguyên)
                                                  $remainingHours = floor(\Carbon\Carbon::now()->diffInHours($endTime, false) % 24);  // Số giờ còn lại (làm tròn xuống số nguyên)
                                              @endphp

                                              @if($remainingDays > 0)
                                                  {{ $remainingDays }} day
                                              @endif

                                              @if($remainingHours > 0)
                                                  {{ $remainingHours }} hours
                                              @endif
                                          </p>
                                          </td>
                                  </tr>
                                      @else
                                          <!-- Nếu approved không bằng 0, không hiển thị gì -->
                                      @endif
                                      
                                  </div>
                                    
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($item->created_at)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($item->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-secondary">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  
                                </tbody>
                              </table>

                            </div>
                                    </div>
                                  </div>
                                </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <form action="{{ route('sale_news.reject', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                    </form>
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event, {{ $item->sale_new_id }})">
                                        <form id="delete-form-{{ $item->sale_new_id }}" action="{{ route('sale_news.destroy', $item->sale_new_id) }}" method="POST" >
                                          @csrf
                                          @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                                </button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                    </tbody>
                  </table>
                </div>

                <!-- Rejected Tab -->
                <div id="rejected" class="container-fluid p-0 tab-pane fade">
                  <h2>Rejected</h2>
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>Id news</th>
                        <th>Start date</th>
                        <th>Category</th>
                     
                        <th>approved</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->approved==2)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-secondary my-1">#{{$item->sale_new_id}} 
                               @if($item->vip_package_id >0)
                              <span><i class="fa-solid text-warning fa-star me-1"></i></span> 
                              @else
                              @endif
                              <!-- Biểu tượng ngôi sao -->
                            </span>
                          </div>
                         

                        
                           
                        </td>
                        <td >
                        <!-- @if($item->approved == 0)
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif -->
                           {{$item->user->full_name}}

                        </td>
                        <td class="bg-light rounded">
                        <span class="badge bg-label-primary"> {{ $item->sub_category->category->name_category }} </span>
                        <span class="text-muted"> &#8594; </span>
                            <span class="badge text-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                       
                        <td class="bg-light rounded">
                            @if($item->approved == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->approved == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->approved == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal4{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal4{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                              <table class="table">
                                <tbody>
                                  <tr data-dt-row="2" data-dt-column="2">
                                    <td class="col-3">Product:</td>
                                    <td class="col-9">
                                      <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper">
                                          <div class="avatar avatar me-4 rounded-2 bg-label-secondary">
                                            <img src="a" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $item->name_product }}</h6>
                                          <small class="text-truncate-1">{{ $item->description }}</small>
                                       
                            
                                      

                                        </div>
                                        <div >   
                                          @if($item->vip_package_id >0)
                                            <span class="badge text-warning"><i class="fa-solid text-warning fa-star me-1" style="margin-left:50px"></i> {{ $item->vippackage->name }}</span> 
                                            @else
                                            @endif</div>
                                     
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-label-secondary">{{ $item->sub_category->category->name_category }}</span>
                                      <span class="text-muted"> &#8594; </span>
                                      <span class="badge text-secondary">{{ $item->sub_category->name_sub_category }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($item->price, 2) }}</span></td>
                                  </tr>
                                 
                                  <tr data-dt-row="2" data-dt-column="10">
                                    <td class="col-3">Create By:</td>
                                    <td class="col-9"><span>{{ $item->user->full_name }}</span></td>
                                  </tr>
                                  
                                    
                                      @if($item->approved == 0)
                                      <tr data-dt-row="2" data-dt-column="8">
                                      <td class="col-3">Time remaining:</td>
                                    <td class="col-8 bg-light rounded">
                                    <div class="d-flex align-items-center" style="font-size: 15px; font-weight:700">
                                          <i class="fa-regular fa-clock text-danger me-1"></i> <!-- Thêm margin-right cho icon để cách ra với chữ -->
                                          
                                          <p class="text-danger mb-0"> <!-- Sử dụng mb-0 để loại bỏ margin-bottom của đoạn văn -->
                                              @php
                                                  // Tính số ngày và giờ còn lại đến hết 7 ngày
                                                  $endTime = \Carbon\Carbon::parse($item->created_at)->addDays(7);  // Thời gian kết thúc sau 7 ngày
                                                  $remainingDays = floor(\Carbon\Carbon::now()->diffInDays($endTime, false));  // Số ngày còn lại (làm tròn xuống số nguyên)
                                                  $remainingHours = floor(\Carbon\Carbon::now()->diffInHours($endTime, false) % 24);  // Số giờ còn lại (làm tròn xuống số nguyên)
                                              @endphp

                                              @if($remainingDays > 0)
                                                  {{ $remainingDays }} day
                                              @endif

                                              @if($remainingHours > 0)
                                                  {{ $remainingHours }} hours
                                              @endif
                                          </p>
                                          </td>
                                  </tr>
                                      @else
                                          <!-- Nếu approved không bằng 0, không hiển thị gì -->
                                      @endif
                                      
                                  </div>
                                    
                                  <tr data-dt-row="2" data-dt-column="9">
                                    <td class="col-3">Created At:</td>
                                    <td class="col-9"><span>{{ date('D, d M Y', strtotime($item->created_at)) }}</span></td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="7">
                                    <td class="col-3">Status:</td>
                                    <td class="col-8 bg-light rounded">
                                      @if ($item->status == 1)
                                      <span class="badge bg-label-success">Active</span>
                                      @else
                                      <span class="badge bg-label-secondary">Deactive</span>
                                      @endif
                                    </td>
                                  </tr>
                                  
                                </tbody>
                              </table>

                            </div>
                                    </div>
                                  </div>
                                </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                    <form action="{{ route('sale_news.reject', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->approved==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                    </form>
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event, {{ $item->sale_new_id }})">
                                        <form id="delete-form-{{ $item->sale_new_id }}" action="{{ route('sale_news.destroy', $item->sale_new_id) }}" method="POST" >
                                          @csrf
                                          @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <span><i class="fa-solid fa-trash me-1"></i></span>Delete
                                                </button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="content-backdrop fade"></div>
</div>

@endsection
<script>@if(session('message'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{ session('message') }}
    </div>
@endif

@if(session('alert'))
    <div class="alert alert-{{ session('alert')['type'] }}">
        <strong>{{ ucfirst(session('alert')['type']) }}!</strong> {{ session('alert')['message'] }}
    </div>
@endif
</script>