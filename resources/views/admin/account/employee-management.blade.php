@extends('layouts.admin')
@section('content')



<div class="content-wrapper">


    <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


        <div class="app-ecommerce" data-select2-id="21">

            <!-- tieeu de -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                <div class="d-flex flex-column justify-content-center">

                    @isset($dataStaffID)
                    <h4 class="mb-1">Edit staff account {{ $dataStaffID->full_name }}</h4>
                    @else
                    <h4 class="mb-1">Add staff account</h4>
                    @endisset

                </div>

                <form
                    @isset($dataStaffID)
                    action="{{ route('updateStaff',$dataStaffID->staff_id)}}"
                    @else
                    action="{{ route('addStaff')}}"
                    @endisset


                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($dataStaffID)
                    @method('PUT')
                    @endisset

                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4">
                            {{-- <button class="btn btn-label-secondary">Discard</button>    --}}
                            <div class="btn btn-label-primary">Discard</div>
                        </div>
                        <input type="submit" class="btn btn-primary" id="btn-publish-product" value="Publish staff">
                    </div>

            </div>

            <div class="row" data-select2-id="20">
                <!-- First column-->
                <div class="col-12 col-lg-8">
                    <!-- Product Information -->
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Staff information</h5>
                        </div>


                        {{-- noi dung1  --}}



                        <div class="card-body">
                            <div class="row">
                                <div class="mb-6 col-md-6">
                                    <label class="form-label" for="full_name">Full name</label>
                                    <input type="text" class="form-control" id="full_name" placeholder="Full name" name="full_name" aria-label="Full name"
                                        @isset($dataStaffID)
                                        value="{{ $dataStaffID->full_name }}"
                                        @endisset>
                                    <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                </div>
                                <div class="mb-6 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" aria-label="Email"
                                        @isset($dataStaffID)
                                        value="{{ $dataStaffID->email }}" disabled
                                        @endisset>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="mb-6 col-md-6 >
                                            <label class=" form-label" for="address">address</label>
                                    <input type="text" class="form-control" id="address" placeholder="address" name="address" aria-label="address"
                                        @isset($dataStaffID)
                                        value="{{ $dataStaffID->address }}"
                                        @endisset>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-danger" />
                                </div>
                                <div class="mb-6 col-md-6">


                                    @isset($dataStaffID)
                                    <label for="status" class="text-black font-semibold pb-1 capitalize">Status:</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="1" {{ $dataStaffID->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="0" {{ $dataStaffID->status == 0 ? 'selected' : '' }}>Khóa</option>
                                    </select>
                                    @else
                                    <label class="form-label" for="password">Pass word</label>
                                    <input type="password" class="form-control" id="password" placeholder="Pass word" name="password" aria-label="password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                    @endisset

                                </div>
                            </div>

                        </div>




                        {{-- end noi dung1 --}}
                        <div>
                        </div>
                        <!-- end First column-->



                    </div>
                </div>
                <div class="col-12 col-lg-4" data-select2-id="19">

                    <div class="card mb-6" data-select2-id="18">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Upload avata</h5>
                        </div>

                        <div class="card-body">
                            <div class="dropzone p-0 dz-clickable" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 11.5rem;">
                                @isset($dataStaffID)
                                @if($dataStaffID->avata == null)
                                <img id="preview_img" class=" mt-3 rounded" style="width: 100px; height: auto;">
                                @else
                                <img id="preview_img" src="{{ asset($dataStaffID->avata) }}" class="mt-3 border rounded" style="width: 100px; height: auto;">
                                @endif
                                @endisset
                                <img id="preview_img" class=" mt-3 rounded" style="width: 100px; height: auto;">
                                <div style="font-weight: 500; text-align: center; width: 300px; height: 2.5rem;">
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="btnBrowse">Browse image</button>
                                    <input type="file" id="fileInput" name="avata" style="display: none">
                                </div>
                            </div>
                            </form>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">List Staff</h5>
                    </div>
                    <div class="row" data-select2-id="20">

                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Product Information -->
                            <div class="card mb-6">
                                <div class="card-body">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID-Staff</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Trạng thái</th>
                                                <th>Xem</th>
                                                <th>Chức năng </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item )


                                            <tr>
                                                <td>{{ $item -> staff_id }}</td>
                                                <td>{{ $item -> full_name }}</td>
                                                <td>{{ $item ->email }}</td>
                                                <td>
                                                    @if($item->status == 0)
                                                    Khóa
                                                    @else
                                                    Hoạt động
                                                    @endif
                                                </td>

                                                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
                                                <div class="modal fade" id="modal{{ $item->staff_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->staff_id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel{{ $item->staff_id }}">Info Staff</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class=" col-md-5 mx-2 ">

                                                                            @if (is_null($item->avata) || $item->avata === '')
                                                                            <img src="https://img.lovepik.com/png/20231019/customer-login-avatar-client-gray-head-portrait_269373_wh860.png" alt="" class="" width="100px">
                                                                            @else
                                                                            <img src="{{ asset($item->avata) }}" alt="" width="100px">
                                                                            @endif
                                                                            {{-- <img src="http://127.0.0.1:8000/storage/avata/avata_staff1729105812.jpg" alt="" srcset=""> --}}
                                                                        </div>
                                                                        <div class="col-md-5 mx-2">

                                                                            <p><strong>Tên:</strong><br>{{ $item -> full_name }}</p>
                                                                            <p><strong>Email:</strong><br>{{ $item ->email }}</p>
                                                                            <p><strong>Địa chỉ:</strong><br>{{ $item ->address }}</p>
                                                                            <p><strong>Chức vụ:</strong><br>{{ $item -> role }}</p>
                                                                            <p><strong>Trạng thái:</strong><br>
                                                                                @if($item->status == 0)
                                                                                Khóa
                                                                                @else
                                                                                Hoạt động
                                                                                @endif </p>
                                                                            <p><strong>Hoạt động từ ngày:</strong><br>{{ $item -> created_at }}</p>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $item->staff_id }}"><i class="fa-solid fa-eye"></i></button>
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class=" col-5"><a href="{{ route('editStaff',$item->staff_id) }}" class="text-black"><i class="fa-solid fa-pen-to-square"></i></a> </div>
                                                        <div class="col-5">
                                                            <button style="border: none; background: none; color: red; cursor: pointer;" onclick="confirmDelete(event,{{ $item->staff_id }})">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                            <form id="delete-form-{{ $item->staff_id }}" action="{{ route('deleteStaff', $item->staff_id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endforeach

                                            </tr>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

               <!-- First column-->
               <div class="col-12 col-lg-12">
                 <!-- Product Information -->
                 <div class="card mb-6">
                   <div class="card-body">
                       <table id="example" class="table table-striped" style="width:100%">
                           <thead>
                             <tr>
                               <th>ID-Staff</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Status</th>
                               <th>View</th>
                               <th> </th>

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
                document.addEventListener('DOMContentLoaded', function() {
                    const input = document.getElementById('fileInput');
                    const previewImg = document.getElementById('preview_img');

                    input.addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
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
                function confirmDelete(event, staffID) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Bạn chắc chứ?",
                        text: "Nếu đồng ý sẽ không thể khôi phục! - Các sản phẩm thuộc danh mục này cũng sẽ bị xoá!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            document.getElementById(`delete-form-${staffID}`).submit();
                        }
                    });
                }
            </script>

            @endsection