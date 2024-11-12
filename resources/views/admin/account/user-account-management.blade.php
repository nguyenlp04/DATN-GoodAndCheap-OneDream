@extends('layouts.admin')
@section('content')



          <div class="content-wrapper">


            <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


                <div class="app-ecommerce" data-select2-id="21">

                  <!-- tieeu de -->
                  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                      <h4 class="mb-1">User management</h4>
                    </div>

                  </div>



                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">List User</h5>
                        </div>
                        <div class="row" data-select2-id="20">
                            <!-- First column-->
                            <div class="col-12 col-lg-12">
                                <!-- Product Information -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>

                                                <tr>
                                                    <th>ID-User</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>status</th>

                                                    <th>position</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item )
                                                <tr>
                                                    <td>UID-{{ $item->user_id }}</td>
                                                    <td>{{ $item->full_name }}</td>
                                                    <td>{{ $item->email }}</td>

                                                    @if ( $item -> status == 0)
                                                    <td>Lock</td>
                                                    @else
                                                    <td>Active</td>
                                                    @endif
                                                    <td>{{ $item -> role }}</td>


                                                    <td>
                                                         <div class="container">
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#modal{{ $item->user_id }}">
                                                                <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                                                            </li>
                                                             @if ( $item -> status == 0)
                                                                        <li onclick="confirmCheckLock(event, {{ $item->user_id }})">
                                                                            <a class="dropdown-item" href="#"><span style="padding-right: 10px"><i class="fa-solid fa-unlock"></i></span>Unlock</a>
                                                                    <form id="check-lock-form-{{ $item->user_id }}" action="{{ route('updateUnlock',$item->user_id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('PUT')
                                                                    </form>
                                                                    @else
                                                                     <li onclick="confirmCheckLock(event, {{ $item->user_id }})">
                                                                         <a class="dropdown-item" href="#"><span style="padding-right: 10px"><i class="fa-solid fa-lock"></i></span>Locked</a>
                                                                    <form id="check-lock-form-{{ $item->user_id }}" action="{{ route('updateLock',$item->user_id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('PUT')
                                                                    </form>

                                                            </li>
                                                            @endif
                                                            </ul>
                                                                        <div class="modal fade" id="modal{{ $item->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->user_id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel{{ $item->user_id }}">Info Staff</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-5 mx-2">
                                                                                            @if (is_null($item->image_user) || $item->image_user === '')
                                                                                            <img src="https://img.lovepik.com/png/20231019/customer-login-avatar-client-gray-head-portrait_269373_wh860.png" alt="" class="" width="100px">
                                                                                        @else
                                                                                            <img src="{{ asset($item->image_user) }}" alt=""  width="100px">
                                                                                        @endif
                                                                                        </div>
                                                                                        <div class="col-md-5 mx-2">
                                                                                            <p><strong>ID:</strong><br>{{ $item -> user_id }}</p>
                                                                                            <p><strong>Name:</strong><br>{{ $item -> full_name }}</p>
                                                                                            <p><strong>Email:</strong><br>{{ $item -> email }}</p>
                                                                                            <p><strong>Address:</strong><br>{{ $item -> address }}</p>
                                                                                            <p><strong>Phone Number:</strong><br>{{ $item -> phone_number }}</p>
                                                                                            <p><strong>Role:</strong><br>{{ $item -> role}}</p>

                                                                                            @if ( $item -> status == 0)
                                                                                            <p><strong>Status:</strong><br>lock</p>
                                                                                            @else
                                                                                            <p><strong>Status:</strong><br>Active</p>
                                                                                            @endif


                                                                                            <p><strong>Active since:</strong><br>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</p>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    {{-- <td>
                                                        @if ( $item -> status == 0)
                                                        <button  class="btn btn-primary" onclick="confirmCheckLock(event, {{ $item->user_id }})">
                                                            <i class="fa-solid fa-lock"></i>
                                                        </button>
                                                        <form id="check-lock-form-{{ $item->user_id }}" action="{{ route('updateUnlock',$item->user_id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                        </form>
                                                        @else
                                                        <button  class="btn btn-primary" onclick="confirmCheckLock(event, {{ $item->user_id }})">
                                                            <i class="fa-solid fa-unlock"></i>
                                                        </button>
                                                        <form id="check-lock-form-{{ $item->user_id }}" action="{{ route('updateLock',$item->user_id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                        </form>
                                                        @endif



                                                    </td> --}}

                                                </tr>
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
            <!-- / Content -->




          </div>


        @endsection
        @section('script-link-css')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>
{{-- <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css"> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
{{-- no ko buton dc  --}}




    <script>

        function confirmCheckLock(event,userID) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "If you agree, this account will be locked !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I agree!"
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById(`check-lock-form-${userID}`).submit();
                }
            });
        }
    </script>

@endsection
