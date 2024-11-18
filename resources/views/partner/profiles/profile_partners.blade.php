@extends('layouts.partner_layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            @foreach($profiles as $profile)
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <!-- Channel Image -->
                            <img src="{{ asset('storage/' . $profile->image_channel) }}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="my-3">{{ $profile->name_channel }}</h5>
                            <p class="text-muted mb-1">{{ $profile->status }}</p>
                            <p class="text-muted mb-4">{{ $profile->address }}</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('channels.show', ['channel' => $profile->channel_id]) }}" class="btn btn-primary text-white ms-1">View Channel</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Form sửa thông tin kênh -->
                            <form id="update-profile-form" action="{{ route('partners.profile.update', $profile->channel_id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              
                              <!-- Name channel -->
                              @if(session('error'))
                                  <div class="alert alert-danger">
                                      {{ session('error') }}
                                  </div>
                              @endif

                              <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <label for="name_channel" class="mb-0">Name channel</label>
                                  </div>
                                  <div class="col-sm-9">
                                      <input type="text" id="name_channel" name="name_channel" value="{{ old('name_channel', $profile->name_channel) }}" class="form-control @error('name_channel') is-invalid @enderror" required>
                                      @error('name_channel')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                              <hr>

                              <!-- Email -->
                              <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <label for="email" class="mb-0">Email</label>
                                  </div>
                                  <div class="col-sm-9">
                                      <input type="email" id="email" name="email" value="{{ old('email', $profile->users->email ?? '') }}" class="form-control @error('email') is-invalid @enderror" required>
                                      @error('email')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                              <hr>

                              <!-- Phone -->
                              <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <label for="phone_number" class="mb-0">Phone</label>
                                  </div>
                                  <div class="col-sm-9">
                                      <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" class="form-control @error('phone_number') is-invalid @enderror" required>
                                      @error('phone_number')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                              <hr>

                              <!-- Address -->
                              <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <label for="address" class="mb-0">Address</label>
                                  </div>
                                  <div class="col-sm-9">
                                      <input type="text" id="address" name="address" value="{{ old('address', $profile->address) }}" class="form-control @error('address') is-invalid @enderror" required>
                                      @error('address')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                              <hr>

                              <!-- Image Channel (Avatar) -->
                              <div class="row mb-3">
                                  <div class="col-sm-3">
                                      <label for="image_channel" class="mb-0">Avatar</label>
                                  </div>
                                  <div class="col-sm-9">
                                      <input type="file" id="image_channel" name="image_channel" class="form-control @error('image_channel') is-invalid @enderror">
                                      @error('image_channel')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                              <hr>

                              <!-- Save button -->
                              <div class="row mb-3">
                                  <div class="col-sm-3"></div>
                                  <div class="col-sm-9">
                                      <button type="submit" class="btn btn-primary">Save Changes</button>
                                  </div>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
