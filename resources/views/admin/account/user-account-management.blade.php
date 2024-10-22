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
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $item->user_id }}">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>

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
                                                    </td>

                                                </tr>
                                                @endforeach
                                                <!-- Thêm các dòng khác nếu cần -->
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
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
{{-- no ko buton dc  --}}
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.getElementById('btnBrowse').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('fileInput');
        const previewImg = document.getElementById('preview_img');

        input.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                previewImg.classList.add('hidden');
            }
        });
    });
</script>
<script>
  new DataTable('#example');
</script>

            @if (session('alert'))
            <script>
            const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "{{ session('alert')['type'] }}",
            title: "{{ session('alert')['message'] }}"
            });
            </script>
            @endif


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
