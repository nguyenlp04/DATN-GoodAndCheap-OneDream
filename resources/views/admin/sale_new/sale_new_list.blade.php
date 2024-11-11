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
    <div class="app-ecommerce">

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
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#ative">Active</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " data-bs-toggle="tab" href="#rejected">Rejected</a>
        </li>
        <li class="nav-item position-relative">
          <a class="nav-link" data-bs-toggle="tab" href="#waiting">Waiting for approval</a>
          <div class="position-absolute top-0 start-100 translate-middle text-center bg-danger d-inline-block rounded-circle" style="width: 20px; height: 20px;">
            <span class="text-white d-flex justify-content-center align-items-center" style="line-height: 20px; font-size:10px;">10</span>
          </div>
        </li>
       
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
                     
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Vinh</span>
                          <span class="text-muted"> &#8594; </span>
                          <span class="badge bg-secondary">áo</span>
                        </td>
                        <td>2024-01-01</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal">
                            <i class="fas fa-eye"></i>
                            <span class="tooltip-text eye">View</span>
                            </button>
                            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3 mx-2">
                                <img src="" alt="Blog Image" style="width: 100px;">
                              </div>
                              <div class="col-md-7 mx-2">
                                vi
                              
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                          
                        </td>
                        <td>
                        <div class="d-flex justify-content-start align-items-center">
                                <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-times-circle text-danger" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:6.5em;width: 60px;">Not Agree</span>
                                </button>
                                <!-- <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-check-circle text-success" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:5.5em;width:50px;">Agree</span>
                                </button> -->
                                <button type="button" class="delete-btn  btn " data-blog-id="" style="position: relative;">
                                <i class="fas fa-trash text-danger" style="left:6em;font-size:20px"></i>
                                <span class="tooltip-text" style="left:6em;" >Delete</span>
                                </button>
                            </div>
                        </td>
                      </tr>
                      <!-- end item -->
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Hoa</span>
                          <span class="text-muted"> &#8594; </span>
                          <span class="badge bg-secondary">áo</span>        
                        </td>
                        <td>2024-03-10</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-danger">Rejected</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modala">
                            <i class="fas fa-eye"></i>
                            <span class="tooltip-text eye">View</span>  </button>
                            <div class="modal fade" id="modala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div>
                                          <div class="col-md-7 mx-2">
                                            viđ
                                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center">
                                <!-- <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-times-circle text-danger" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:5.5em;width: 60px;">Not Agree</span>
                                </button> -->
                                <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-check-circle text-success" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:6.5em;width:50px;">Agree</span>
                                </button>
                                <button type="button" class="delete-btn  btn " data-blog-id="" style="position: relative;">
                                <i class="fas fa-trash text-danger" style="left:6em;font-size:20px"></i>
                                <span class="tooltip-text" style="left:6em;" >Delete</span>
                                </button>
                            </div>
                            </td>

                      </tr>
                      <!-- end item -->
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Nam</span>
                          <span class="text-muted"> → </span>
                          <span class="badge bg-secondary">quần</span>
                        </td>
                        <td>2024-02-15</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-warning">Waiting</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal1">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                            <span class="tooltip-text eye">View</span>
                          </button>
                          <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div>
                                          <div class="col-md-7 mx-2">
                                            viđd
                                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            
                        </td>
                        <td>
                        <!-- Chưa duyệt (Waiting) -->
                        <div class="d-flex justify-content-start align-items-center">
                            <!-- Nút từ chối và đồng ý -->
                            <button type="button" class="btn btn-sm" style="position: relative;">
                            <i class="fas fa-times-circle text-danger" style="font-size:20px" aria-hidden="true"></i>
                            <span class="tooltip-text" style="left:6.5em;width: 60px;">Not Agree</span>
                            </button>
                            <button type="button" class="btn btn-sm" style="position: relative;">
                            <i class="fas fa-check-circle text-success" style="font-size:20px" aria-hidden="true"></i>
                            <span class="tooltip-text" style="left:6em;width:50px;">Agree</span>
                            </button>
                        </div>
                      </td></tr>
                      <!-- end item -->
                    </tbody>
                  </table>
                </div>

                <!-- Active Tab -->
                <div id="ative" class="container-fluid p-0 tab-pane fade">
                  <h2>Active</h2>
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
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Vinh</span>
                          <span class="text-muted"> &#8594; </span>
                          <span class="badge bg-secondary">áo</span>
                        </td>
                        <td>2024-01-01</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal4">
                            <i class="fas fa-eye"></i>
                            <span class="tooltip-text eye">View</span>
                          </button>
                          <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div>
                                          <div class="col-md-7 mx-2">
                                            viđ
                                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            
                        </td>
                        <td>
                        <div class="d-flex justify-content-start align-items-center">
                                <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-times-circle text-danger" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:6.5em;width: 60px;">Not Agree</span>
                                </button>
                                <!-- <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-check-circle text-success" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:5.5em;width:50px;">Agree</span>
                                </button> -->
                                <button type="button" class="delete-btn  btn " data-blog-id="" style="position: relative;">
                                <i class="fas fa-trash text-danger" style="left:6em;font-size:20px"></i>
                                <span class="tooltip-text" style="left:6em;" >Delete</span>
                                </button>
                            </div>
                        </td>
                      </tr>
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
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Nam</span>
                          <span class="text-muted"> &#8594; </span>
                          <span class="badge bg-secondary">quần</span>
                        </td>
                        <td>2024-02-15</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-warning">Waiting</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal2">
                            <i class="fas fa-eye"></i>
                            <span class="tooltip-text eye">View</span>
                          </button>
                          <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div>
                                          <div class="col-md-7 mx-2">
                                            viđ
                                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            
                        </td>
                        <td>
                      
                        <!-- Chưa duyệt (Waiting) -->
                        <div class="d-flex justify-content-start align-items-center">
                            <!-- Nút từ chối và đồng ý -->
                            <button type="button" class="btn btn-sm" style="position: relative;">
                            <i class="fas fa-times-circle text-danger" style="font-size:20px"></i>
                            <span class="tooltip-text" style="left:6.5em;width: 60px;">Not Agree</span>
                            </button>
                            <button type="button" class="btn btn-sm" style="position: relative;">
                            <i class="fas fa-check-circle text-success" style="font-size:20px"></i>
                            <span class="tooltip-text" style="left:5em;width:50px;">Agree</span>
                            </button>
                        </div>
                      </tr>
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
                      <tr>
                        <td>
                          <div><span class="badge bg-info my-1">id:</span></div>
                          <div class="mb-1"><span class="p-1 rounded-1 text-white bg-info my-1">User:</span></div>
                          <div><span class="p-1 rounded-1 text-white bg-info my-1">Price:</span></div>
                        </td>
                        <td class="bg-light rounded">
                          <span class="badge bg-primary">Hoa</span>
                          <span class="text-muted"> &#8594; </span>
                          <span class="badge bg-secondary">áo</span>        
                        </td>
                        <td>2024-03-10</td>
                        <td class="bg-light rounded">
                          <span class="badge bg-danger">Rejected</span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm text-center" style="position: relative;" data-bs-toggle="modal" data-bs-target="#modal3">
                            <i class="fas fa-eye"></i>
                            <span class="tooltip-text eye">View</span>
                          </button>
                          <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Content News </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-3 mx-2">
                                            <img src="" alt="Blog Image" style="width: 100px;">
                                          </div>
                                          <div class="col-md-7 mx-2">
                                            viđ
                                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            
                        </td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center">
                                <!-- <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-times-circle text-danger" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:5.5em;width: 60px;">Not Agree</span>
                                </button> -->
                                <button type="button" class="btn btn-sm" style="position: relative;">
                                <i class="fas fa-check-circle text-success" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:5em;width:50px;">Agree</span>
                                </button>
                                <button type="button" class="delete-btn  btn " data-blog-id="" style="position: relative;">
                                <i class="fas fa-trash text-danger" style="font-size:20px"></i>
                                <span class="tooltip-text" style="left:6em;" >Delete</span>
                                </button>
                            </div>
                            </td>

                      </tr>
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
</div>

@endsection
