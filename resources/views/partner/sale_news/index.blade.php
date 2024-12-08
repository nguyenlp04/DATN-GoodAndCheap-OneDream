@extends('layouts.partner_layout')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="app-ecommerce">

                <!-- Add Blogs Header -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Sale news My Channels</h4>
                    </div>

                </div>
                {{-- {{ dd($data) }}; --}}

                <!-- Blog Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-6">
                            <div class="card-body">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID News</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Approved</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-label-secondary my-1">#{{ $item->sale_new_id }}
                                                        <span><i class="fa-solid text-warning fa-star me-1"></i></span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="row d-flex justify-content-start text-truncate-3">

                                                        {{ $item->title }}
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-label-primary">
                                                        {{ $item->sub_category->category->name_category }} </span>
                                                    <span class="text-muted"> &#8594; </span>
                                                    <span class="badge text-secondary">
                                                        {{ $item->sub_category->name_sub_category }}</span>
                                                </td>


                                                <td>
                                                    @if ($item->approved == 0)
                                                        <span class="badge bg-label-warning">Waiting</span>
                                                    @elseif($item->approved == 1)
                                                        <span class="badge bg-label-success">Approved</span>
                                                    @elseif($item->approved == 2)
                                                        <span class="badge bg-label-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{route('channel.toggleStatus',$item->sale_new_id)}}"
                                                        method="POST" class="toggle-status-form"
                                                        data-blog-id="{{ $item->sale_new_id }}">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm {{ $item->status == 1 ? 'text-primary' : 'text-secondary' }}"
                                                            style="position: relative;">
                                                            <i
                                                                class="fas {{ $item->status == 1 ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                                            <span
                                                                class="tooltip-text eye">{{ $item->status == 1 ? 'Show' : 'Hide' }}</span>
                                                        </button>
                                                    </form>
                                                </td>
            

                                               
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- JavaScript -->

                                <script>
                                    @if (session('message'))
                                        <
                                        div class = "alert alert-success" >
                                        <
                                        strong > Success! < /strong> {{ session('message') }} < /
                                        div >
                                    @endif

                                    @if (session('alert'))
                                        <
                                        div class = "alert alert-{{ session('alert')['type'] }}" >
                                        <
                                        strong > {
                                            {
                                                ucfirst(session('alert')['type'])
                                            }
                                        }! < /strong> {{ session('alert')['message'] }} < /
                                        div >
                                    @endif
                                </script>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                                <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
                                <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
@endsection
