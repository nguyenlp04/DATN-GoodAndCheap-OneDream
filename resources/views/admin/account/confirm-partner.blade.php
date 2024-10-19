@extends('layouts.admin')
@section('content')



          <div class="content-wrapper">


            <div class="container-xxl flex-grow-1 container-p-y" data-select2-id="22">


                <div class="app-ecommerce" data-select2-id="21">

                  <!-- tieeu de -->
                  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                      <h4 class="mb-1">Add a new Product</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                      <div class="d-flex gap-4"><button class="btn btn-label-secondary">Discard</button>
                        <button class="btn btn-label-primary">Save draft</button></div>
                      <button type="submit" class="btn btn-primary" id="btn-publish-product">Publish product</button>
                    </div>

                  </div>

                    <div class="row" data-select2-id="20">


                    </div>
                </div>
            </div>
            <!-- / Content -->




          </div>
          <!-- Content wrapper -->

        @endsection
