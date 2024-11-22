@extends('layouts.client_layout')


@section('content')
<main class="main">

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">New</a></li>
                <li class="breadcrumb-item active" aria-current="page">View news status</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row d-flex justify-content-Start">
                    <div class="col col-md-9 col-lg-7 col-xl-6">
                      <div style="width:  fit-content;min-width:460px; ">
                        <div class="card-body">
                          <div class="d-flex">
                            <div class="flex-shrink-0">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                alt="Generic placeholder image" class="img-fluid" style="width: 120px;  border-radius: 10px;">

                            </div>
                            <div class="flex-grow-1 ms-3">
                              <h5 class="mb-1">jnoa nguyen</h5>

                              <p  style="color: #ff0000;"><i class="fa-solid fa-face-smile" style="color: #FFD43B;"></i> Become a partner for easier management </p>
                              <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary  " style="width: fit-content">
                                <div>
                                  <p class="small text-muted"><i class="fa-solid fa-clock" style="color: #74C0FC;"></i>1282</p>
                                  {{-- <p class="small text-muted "><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> 56</p> --}}
                                  <p class="small text-muted ">  <i class="fa-solid fa-file-invoice-dollar" style="color: #74C0FC;"></i> 30</p>

                                </div>


                              </div>


                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                        <div class="tabs-vertical">
                            <ul class="nav nav-tabs flex-column" id="tabs-8" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-29-tab" data-toggle="tab" href="#tab-29" role="tab" aria-controls="tab-29" aria-selected="true">Tab 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-30-tab" data-toggle="tab" href="#tab-30" role="tab" aria-controls="tab-30" aria-selected="false">Tab 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-31-tab" data-toggle="tab" href="#tab-31" role="tab" aria-controls="tab-31" aria-selected="false">Tab 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-32-tab" data-toggle="tab" href="#tab-32" role="tab" aria-controls="tab-32" aria-selected="false">Tab 4</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-border" id="tab-content-8">
                                <div class="tab-pane fade show active" id="tab-29" role="tabpanel" aria-labelledby="tab-29-tab">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum int dolore earum rerum tempora aspernatur numquam velit. </p>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="tab-30" role="tabpanel" aria-labelledby="tab-30-tab">
                                    <p>Nobis perspiciatis natus cum, sint dolore earum rerum tempora aspernatur numquam velit tempore omnis, delectus repellat facere voluptatibus nemo non fugiat consequatur repellendus! Enim, commodi, veniam ipsa voluptates quis amet.</p>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="tab-31" role="tabpanel" aria-labelledby="tab-31-tab">
                                    <p>Perspiciatis quis nobis, adipisci quae aspernatur, nulla suscipit eum. Dolorum, earum. Consectetur pariatur repellat distinctio atque alias excepturi aspernatur nisi accusamus sed molestias ipsa numquam eius, iusto, aliquid, quis aut.</p>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="tab-32" role="tabpanel" aria-labelledby="tab-32-tab">
                                    <p>Quis nobis, adipisci quae aspernatur, nulla suscipit eum. Dolorum, earum. Consectetur pariatur repellat distinctio atque alias excepturi aspernatur nisi accusamus sed molestias ipsa numquam eius, iusto, aliquid, quis aut.</p>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div>
                    </div>

                  </div>
            </div>
        </div>
    </div>
</main>
@endsection
