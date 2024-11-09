@extends('layouts.partner_layout')
@section('content')
  <div class="layout-page">
    <!-- Navbar -->
  
    <nav
      class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
      id="layout-navbar">
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="{{ url("javascript:void(0)") }}">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
  
      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex ali gn-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input
              type="text"
              class="form-control border-0 shadow-none"
              placeholder="Search..."
              aria-label="Search..." />
          </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="{{ url("javascript:void(0);") }}" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ url("#") }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset("/../admin/assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle" />
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">John Doe</span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url("profile.html") }}">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url("#") }}">
                  <i class="bx bx-cog me-2"></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url("#") }}">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url("auth-login-basic.html") }}">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>
    </nav>
    <div class="container py-5">
      <div class="row">
          @foreach($profiles as $profile)
              <div class="col-lg-4">
                  <div class="card mb-4">
                      <div class="card-body text-center">
                          <!-- Channel Image -->
                          <img src="{{ asset('storage/' . $profile->image_channel) }}" alt="avatar"
                               class="rounded-circle img-fluid"    style="width: 150px; height: 150px; object-fit: cover; text-align: center;">
                          <h5 class="my-3">{{ $profile->name_channel }}</h5>
                          <p class="text-muted mb-1">{{ $profile->status }}</p>
                          <p class="text-muted mb-4">{{ $profile->address }}</p>
                          <div class="d-flex justify-content-center mb-2">
                           
                            <a href="{{ route('channels.show', ['channel' => $profile->channel_id]) }}" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ">View Channel</a>
                              <a type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger text-white ms-1" >Delete</a>
                          </div>
                      </div>
                  </div>
                  <div class="card mb-4 mb-lg-0">
                      <div class="card-body p-0">
                          <ul class="list-group list-group-flush rounded-3">
                              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                  <i class="fas fa-globe fa-lg text-warning"></i>
                                  <p class="mb-0">{{ $profile->channel_id }}</p>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                  <i class="fas fa-phone fa-lg text-body"></i>
                                  <p class="mb-0">{{ $profile->phone_number }}</p>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-lg-8">
                  <div class="card mb-4">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0">Name channel</p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $profile->name_channel }}</p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0">Email</p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $profile->users->email ?? 'No email available' }}</p> <!-- Replace with user email if needed -->
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0">Phone</p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $profile->phone_number }}</p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0">Address</p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0">{{ $profile->address }}</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  </div>
  
  
  </div>
  </section>
  @endsection