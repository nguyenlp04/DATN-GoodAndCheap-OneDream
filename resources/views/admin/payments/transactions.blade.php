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
              {{-- <pre style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;"> --}}
            {{-- {{ dd($data) }} --}}
        {{-- </pre> --}}
              <table id="example" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>ID Transaction</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Upgrade</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $transaction)
                  <tr>
                    <td>
                      <div>
                        <span class="badge bg-info my-1">ID: {{ $transaction->transaction_id }}</span>
                      </div>
                      <div>
                        {{-- <span class="badge bg-info my-1">${{ number_format($transaction->price, 2) }}</span> --}}
                      </div>
                      <div>
                        <span class="badge bg-info my-1"> {{ date('D, d M Y', strtotime($transaction->transaction_date)) }}</span>
                      </div>
                    </td>
                    <td class="bg-light rounded">
                      @if ($transaction->user_id != NULL)
                      <span class="">{{ $transaction->user->full_name }}</span>
                      @else
                      <span class="">{{ $transaction->channel->name_channel }}</span>
                      @endif
                    </td>
                    <td class="bg-light rounded">
                      <span class="">${{ number_format($transaction->amount, 2) }}</span>
                    </td>

                    <td class="bg-light rounded">
                      <span class="">{{ $transaction->upgrade }}</span>
                    </td>

                    

                    
                    <td class="bg-light rounded">
                      <span class="badge bg-primary">{{ $transaction->payment_method }}</span> - 
                      <span class="badge bg-secondary">{{ $transaction->vnp_BankCode }}</span>
                    </td>
                    <td class="bg-light rounded">
                      @if ($transaction->status == "Success")
                      <span class="badge bg-label-success">Success</span>
                      @else
                      <span class="badge bg-label-danger">Incomplete</span>
                      @endif
                    </td>
                    <td>
                      <div data-bs-toggle="modal" data-bs-target="#modal{{ $transaction->transaction_id }}">
                        <a class="dropdown-item" href="#"><span><i class="fa-solid fa-eye me-1"></i></span>View</a>
                      </div>
                     
                      <div class="modal fade" id="modal{{ $transaction->transaction_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $transaction->transaction_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title text-truncate-1">Details of {{ $transaction->transaction_id }}</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <img src="{{ asset($transaction->transaction_id) }}" alt="Product-3" class="rounded" style="width: 100%; object-fit: cover;">
                                          </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-truncate-1">{{ $transaction->transaction_id }}</h6>
                                          <small class="text-truncate-1">{{ $transaction->transaction_id }}</small>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="3">
                                    <td class="col-3">Category:</td>
                                    <td class="col-9">
                                      <span class="badge bg-primary">{{ $transaction->payment_method }}</span> - 
                                      <span class="badge bg-secondary">{{ $transaction->vnp_BankCode }}</span>
                                    </td>
                                  </tr>
                                  <tr data-dt-row="2" data-dt-column="6">
                                    <td class="col-3">Price:</td>
                                    <td class="col-9"><span>${{ number_format($transaction->price, 2) }}</span></td>
                                  </tr>
                                  
                                </tbody>
                              </table>

                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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