@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">


        <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


            <div class="app-ecommerce" data-select2-id="21">

                <!-- tieeu de -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">


                        <h4 class="mb-1">List vip package</h4>


                    </div>

                    <form action="{{ route('vip-packages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="d-flex align-content-center flex-wrap gap-4">
                            <div class="d-flex gap-4">
                                <div class="btn btn-label-primary">Discard</div>
                            </div>
                            <input type="submit" class="btn btn-primary" id="btn-publish-product" value="Publish Package">
                        </div>

                </div>

                <div class="row" data-select2-id="20">
                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- Product Information -->
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Add Vip Package</h5>
                            </div>


                            {{-- noi dung1  --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-6 col-md-4">
                                        <label class="form-label" for="package_name">Package name</label>
                                        <input type="text" class="form-control" id="package_name"
                                            placeholder="Package name" name="name" aria-label="Package name"
                                            {{-- @isset($dataStaffID)
                                        value="{{ $dataStaffID->package_name }}"
                                        @endisset --}}>
                                        <x-input-error :messages="$errors->get('package_name')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="mb-6 col-md-4">
                                        <label class="form-label" for="price">Price ($)</label>
                                        <input type="number" class="form-control" id="price" placeholder="price"
                                            name="price" aria-label="price" {{-- @isset($dataStaffID)
                                        value="{{ $dataStaffID->price }}" disabled
                                        @endisset --}}>
                                        <x-input-error :messages="$errors->get('price')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="mb-6 col-md-4">
                                        <label class="form-label" for="duration">duration (Day)</label>
                                        <input type="number" class="form-control" id="duration" placeholder="duration"
                                            name="duration" aria-label="duration" {{-- @isset($dataStaffID)
                                        value="{{ $dataStaffID->duration }}" disabled
                                        @endisset --}}>
                                        <x-input-error :messages="$errors->get('duration')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-6 col-md-4">
                                        <label class=" form-label" for="description">Description</label>
                                        <textarea type="text" class="form-control" id="description" placeholder="description" name="description"
                                            aria-label="description" {{-- @isset($dataStaffID)
                                        value="{{ $dataStaffID->description }}"
                                        @endisset --}}></textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="mb-6 mt-1 col-md-4">



                                        <label for="type" class="text-black font-semibold pb-1 capitalize">Type:</label>
                                        <select id="type" name="type" class="form-control" required>
                                            <option value="user">User</option>
                                            <option value="channel">Channel</option>
                                        </select>

                                        <x-input-error :messages="$errors->get('type')" class="mt-2 text-danger" />


                                    </div>
                                    <div class="mb-6 mt-1 col-md-4">



                                        <label for="status"
                                            class="text-black font-semibold pb-1 capitalize">Status:</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>

                                        <x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />


                                    </div>
                                </div>

                            </div>


                            {{-- end noi dung1 --}}
                            <div>
                            </div>
                            <!-- end First column-->



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
                                                    <th>package id </th>
                                                    <th>Name</th>
                                                    <th>duration</th>
                                                    <th>type</th>
                                                    <th>status</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vipPackages as $item)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <span class="badge bg-info my-1">ID:
                                                                    {{ $item->vip_package_id }}</span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="badge bg-info my-1">{{ date('D, d M Y', strtotime($item->created_at)) }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            {{ $item->duration }} - day
                                                        </td>
                                                        <td>{{ $item->type }}</td>
                                                        <td>
                                                            @if ($item->status == 1)
                                                                <span class="badge bg-label-success">Active</span>
                                                            @else
                                                                <span class="badge bg-label-danger">Deactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="container">
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li data-bs-toggle="modal" data-bs-toggle="modal"
                                                                            data-bs-target="#modal{{ $item->vip_package_id }}">
                                                                            <a class="dropdown-item"
                                                                                href="#"><span><i
                                                                                        class="fa-solid fa-eye me-1"></i></span>View</a>
                                                                        </li>
                                                                        @if ($item->status == 0)
                                                                            <li
                                                                                onclick="confirmCheckLock(event,{{ $item->vip_package_id }})">
                                                                                <a class="dropdown-item"><span
                                                                                        style="padding-right: 10px"><i
                                                                                            class="fa-solid fa-unlock"></i></span>Unlock</a>
                                                                                <form
                                                                                    id="check-lock-form-{{ $item->vip_package_id }}"
                                                                                    action="{{ route('upU.Vip', $item->vip_package_id) }}"
                                                                                    method="POST" style="display:none;">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                </form>
                                                                            </li>
                                                                        @else
                                                                            <li
                                                                                onclick="confirmCheckLock(event, {{ $item->vip_package_id }})">
                                                                                <a class="dropdown-item"><span
                                                                                        style="padding-right: 10px"><i
                                                                                            class="fa-solid fa-lock"></i></span>Locked</a>
                                                                                <form
                                                                                    id="check-lock-form-{{ $item->vip_package_id }}"
                                                                                    action="{{ route('upL.Vip', $item->vip_package_id) }}"
                                                                                    method="POST" style="display:none;">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                </form>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                    <div class="modal fade"
                                                                        id="modal{{ $item->vip_package_id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel{{ $item->vip_package_id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel{{ $item->vip_package_id }}">
                                                                                        package details</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">

                                                                                        <div class="col-md-5 mx-2">
                                                                                            <p>
                                                                                                <span
                                                                                                    class="badge bg-info my-1">ID:
                                                                                                    {{ $item->vip_package_id }}</span>
                                                                                                <span
                                                                                                    class="badge bg-info my-1">
                                                                                                    {{ date('D, d M Y', strtotime($item->created_at)) }}</span>
                                                                                            </p>



                                                                                            <p><strong>Name:</strong><br>{{ $item->name }}
                                                                                            </p>
                                                                                            <p><strong>Description:</strong><br>{{ $item->description }}
                                                                                            </p>
                                                                                            <p><strong>Duration:</strong><br>{{ $item->duration }}-Day
                                                                                            </p>
                                                                                            <p><strong>Price:</strong><br>${{ number_format($item->price, 2) }}
                                                                                            </p>


                                                                                            @if ($item->status == 1)
                                                                                                <span
                                                                                                    class="badge bg-label-success">Active</span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="badge bg-label-danger">Deactive</span>
                                                                                            @endif



                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
            @endsection
            @section('script-link-css')
                {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}

                <script
                    src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js">
                </script>
                <link rel="stylesheet"
                    href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">

                <script>
                    function confirmCheckLock(event, vipID) {
                        event.preventDefault();
                        Swal.fire({
                            title: "Are you sure?",
                            text: "If you agree, this package will be locked!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, I agree!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const form = document.getElementById(`check-lock-form-${vipID}`);

                                // Kiểm tra form có tồn tại không
                                if (form) {
                                    form.submit();
                                } else {
                                    console.error(`Form với ID 'check-lock-form-${vipID}' không tồn tại.`);
                                }
                            }
                        });
                    }
                </script>
            @endsection
