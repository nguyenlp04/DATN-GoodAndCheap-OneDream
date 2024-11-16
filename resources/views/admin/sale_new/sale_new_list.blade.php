@extends('layouts.admin')
@section('content')
<style>
  /* Đảm bảo bảng có chiều rộng cố định */
  .table td, .table th {
    word-wrap: break-word;  /* Tự động xuống dòng nếu từ quá dài */
    max-width: 150px;       /* Giới hạn chiều rộng tối đa */
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

            @if($data->where('status', 1)->count() > 0)
                 <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#approved">Approved</a>
                  </li>
             @else

            @endif
            @if($data->where('status', 2)->count() > 0)
                  <li class="nav-item ">
                    <a class="nav-link " data-bs-toggle="tab" href="#rejected">Rejected</a>
                  </li>
                  @else

              @endif
        @if($count>0)
        <li class="nav-item position-relative">
          <a class="nav-link" data-bs-toggle="tab" href="#waiting">Waiting for approval</a>
          
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
                        <th>Category</th>
                        <th>Start date</th>
                        <th>Status</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-primary my-1">id:  {{$item->sale_new_id}}</span></div>
                            <div class="mb-1"><span class="p-1 rounded-1 text-white bg-label-primary my-1"> {{$item->user->full_name}}</span></div>
                            <div><span class="p-1 rounded-1 text-white bg-label-primary my-1">${{$item->price}}</span></div>
                        </td>
                        <td class="bg-light rounded">
                            <span class="badge bg-primary"> {{ $item->sub_category->category->name_category }} </span>
                            <span class="text-muted"> &#8594; </span>
                            <span class="badge bg-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                        <td>
                        @if($item->status == 0)
                              <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif
                        </td>
                        <td class="bg-light rounded">
                            @if($item->status == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->status == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->status == 2)
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
                                        <div class="row">
                                          <!-- <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div> -->
                                          <div class="col-md-7 mx-2">
                                          {{$item->data}}
                                          
                                          </div>
                                        </div>
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
                                    <button type="submit" class="dropdown-item {{$item->status==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->status==1 ? 'text-white d-none':'d-block'}}">
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
                        <th>Category</th>
                        <th>Start date</th>
                        <th>Status</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->status==1)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-primary my-1">id:  {{$item->sale_new_id}}</span></div>
                            <div class="mb-1"><span class="p-1 rounded-1 text-white bg-label-primary my-1"> {{$item->user->full_name}}</span></div>
                            <div><span class="p-1 rounded-1 text-white bg-label-primary my-1">${{$item->price}}</span></div>
                        </td>
                        <td class="bg-light rounded">
                            <span class="badge bg-primary"> {{ $item->sub_category->category->name_category }} </span>
                            <span class="text-muted"> &#8594; </span>
                            <span class="badge bg-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                        <td>
                        @if($item->status == 0)
                              <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif
                        </td>
                        <td class="bg-light rounded">
                            @if($item->status == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->status == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->status == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal2{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal2{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <!-- <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div> -->
                                          <div class="col-md-7 mx-2">
                                          {{$item->data}}
                                          
                                          </div>
                                        </div>
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
                                    <button type="submit" class="dropdown-item {{$item->status==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->status==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                        
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event,)">
                                            <form id="delete-form" action="" method="POST" style="display:inline;">
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

                <!-- Waiting for approval Tab -->
                <div id="waiting" class="container-fluid p-0 tab-pane fade">
                  <h2>Waiting for approval</h2>
                  <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th>Id news</th>
                        <th>Category</th>
                        <th>Start date</th>
                        <th>Status</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->status==0)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-primary my-1">id:  {{$item->sale_new_id}}</span></div>
                            <div class="mb-1"><span class="p-1 rounded-1 text-white bg-label-primary my-1"> {{$item->user->full_name}}</span></div>
                            <div><span class="p-1 rounded-1 text-white bg-label-primary my-1">${{$item->price}}</span></div>
                        </td>
                        <td class="bg-light rounded">
                            <span class="badge bg-primary"> {{ $item->sub_category->category->name_category }} </span>
                            <span class="text-muted"> &#8594; </span>
                            <span class="badge bg-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                        <td>
                        @if($item->status == 0)
                              <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif
                        </td>
                        <td class="bg-light rounded">
                            @if($item->status == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->status == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->status == 2)
                                <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm text-center text-primary" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal0{{$item->sale_new_id}}">
                                <i class="fas fa-eye"></i>
                                <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal0{{$item->sale_new_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <!-- <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div> -->
                                          <div class="col-md-7 mx-2">
                                          {{$item->data}}
                                          
                                          </div>
                                        </div>
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
                                    <button type="submit" class="dropdown-item {{$item->status==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->status==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                        
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event,)">
                                            <form id="delete-form" action="" method="POST" style="display:inline;">
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
                        <th>Category</th>
                        <th>Start date</th>
                        <th>Status</th>
                        <th>Content</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                    @if($item->status==2)
                    <tr>
                        <td>
                            <div><span class="badge bg-label-primary my-1">id:  {{$item->sale_new_id}}</span></div>
                            <div class="mb-1"><span class="p-1 rounded-1 text-white bg-label-primary my-1"> {{$item->user->full_name}}</span></div>
                            <div><span class="p-1 rounded-1 text-white bg-label-primary my-1">${{$item->price}}</span></div>
                        </td>
                        <td class="bg-light rounded">
                            <span class="badge bg-primary"> {{ $item->sub_category->category->name_category }} </span>
                            <span class="text-muted"> &#8594; </span>
                            <span class="badge bg-secondary"> {{ $item->sub_category->name_sub_category }}</span>
                        </td>
                        <td>
                        @if($item->status == 0)
                              <span>{{ \Carbon\Carbon::parse($item->created_at)->addDays(7)->diffForHumans() }}</span>
                          @else
                              <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                          @endif
                        </td>
                        <td class="bg-light rounded">
                            @if($item->status == 0)
                                <span class="badge bg-label-warning">Waiting</span>
                            @elseif($item->status == 1)
                                <span class="badge bg-label-success">Approved</span>
                            @elseif($item->status == 2)
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
                                        <div class="row">
                                          <!-- <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div> -->
                                          <div class="col-md-7 mx-2">
                                          {{$item->data}}
                                          
                                          </div>
                                        </div>
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
                                    <button type="submit" class="dropdown-item {{$item->status==2 ? 'text-white d-none':'d-block'}}">
                                        <span><i class="fa-solid fas fa-times-circle me-1 "></i></span>Reject
                                    </button>
                                </form>
                                    </li>
                                    <li>
                                    <form action="{{ route('sale_news.approve', $item->sale_new_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item {{$item->status==1 ? 'text-white d-none':'d-block'}}">
                                     <span><i class="fa-solid fas fa-check-circle me-1"></i></span>Approve</a>
                                    </button>
                                        
                                    </li>
                                    <li>
                                        <a onclick="confirmDelete(event,)">
                                            <form id="delete-form" action="" method="POST" style="display:inline;">
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
