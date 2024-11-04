@extends('layouts.admin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


    <div class="app-ecommerce" data-select2-id="21">

      <!-- Add Product -->
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1">Product</h4>
        </div>

      </div>

      <div class="row" data-select2-id="20">

        <!-- First column-->
        <div class="col-12 col-lg-12">
          <!-- Product Information -->
          <div class="card mb-6">
            <div class="card-body">
              <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
              <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"> -->

              <pre style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
            {{ json_encode($data, JSON_PRETTY_PRINT) }}
        </pre>
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>ID Product</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $product)
                  <tr>
                    <td>{{ $product->product_id }}</td>
                    
                    <td>
                    <div class="row">
                      <div class="col-md-7 d-flex">
                        <img src="{{ asset( $product->image_name) }}" alt="Image Product" class="rounded img-fluid me-2">
                        {{ $product->name_product }}
                      </div>
                    </div>  
                    <!-- <img src="https://autopro8.mediacdn.vn/2020/8/30/photo-1-1598770695329180553093.jpg" alt="Product Image" class="img-fluid rounded">{{ $product->name_product }}</td> -->
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td></td>
                    <!-- <td>
                      @if($product->image_name)
                      <img src="{{ asset('storage/' . $product->image_name) }}" alt="Product Image" style="width: 100px;">
                      @else
                      <span>No Image</span>
                      @endif
                    </td> -->
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
              <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
              <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
              <script>
                new DataTable('#example');
              </script>

            </div>
          </div>
        </div>
        <!-- /Second column -->
      </div>
    </div>
  </div>
  <!-- / Content -->


  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection