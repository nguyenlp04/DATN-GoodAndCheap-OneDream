@extends('layouts.client_layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row justify-content-Start">
                    <div class="col col-md-9 col-lg-7 col-xl-5">
                        <div style="width:  fit-content;min-width:430px; ">
                            <div class="card-body" style="padding: 0.4rem 1.5rem 1.8rem 1.2rem;">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">

                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                            alt="Generic placeholder image" class="img-fluid" style="width: 120px;  border-radius: 10px;">

                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ Auth::user()->full_name }}</h5>

                                        <p style="color: #ff0000;"><i class="fa-solid fa-face-smile" style="color: #FFD43B;"></i> Become a partner for easier management </p>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary  " style="width: fit-content">
                                            <div>
                                                <p class="small text-muted"><i class="fa-solid fa-clock" style="color: #74C0FC;"></i>1282</p>
                                                {{-- <p class="small text-muted "><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> 56</p> --}}
                                                <p class="small text-muted "> <i class="fa-solid fa-file-invoice-dollar" style="color: #74C0FC;"></i> 30</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-xl-7 col-lg-10">
                        <div class="tabs-vertical">
                            <ul class="nav nav-tabs flex-column" id="tabs-8" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-29-tab" data-toggle="tab" href="#tab-29" role="tab" aria-controls="tab-29" aria-selected="true">Follow List</a>
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
                                    <div class="row">
                                        <div class="m-0 d-flex justify-content-between align-items-center">
                                            <h6>Watchlist ...</h6>
                                        </div>
                                        @if($followedChannels->isEmpty())
                                        <p class="text-center mt-4">watchlist is empty.</p>
                                        @else
                                        @foreach($followedChannels as $followedChannel)
                                        <div class="m-2 d-flex justify-content-between align-items-center" id="channel-{{ $followedChannel->channel->channel_id }}">
                                            <a href="{{ url('/channels/' . $followedChannel->channel->channel_id) }}" class="d-flex align-items-center text-decoration-none text-dark">
                                                <img src="{{ $followedChannel->channel->image_channel ? asset($followedChannel->channel->image_channel) : 'https://via.placeholder.com/50' }}"
                                                    alt="Avatar" class="rounded me-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <span>{{ $followedChannel->channel->name_channel }}</span>
                                            </a>
                                            <button class="btn btn-danger btn-sm btn-rounded unfollow-btn"
                                                data-channel-id="{{ $followedChannel->channel->channel_id }}"
                                                style="min-width: 100px;">
                                                <i class="fa-solid fa-user-minus me-2"></i> Unfollow
                                            </button>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
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
@section('script-link-css')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unfollowButtons = document.querySelectorAll('.unfollow-btn');

        unfollowButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn form submit mặc định
                const channelId = this.dataset.channelId;

                fetch(`/unfollow/${channelId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json(); // Phân tích JSON nếu API thành công
                        } else {
                            throw new Error('Server error: ' + response.status); // Thông báo lỗi cụ thể
                        }
                    })
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo thành công
                            Swal.fire({
                                icon: 'success',
                                title: 'Unfollowed successfully',
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });

                            // Xóa kênh khỏi giao diện
                            const channelElement = document.getElementById(`channel-${channelId}`);
                            channelElement.remove();
                        } else {
                            // Hiển thị thông báo lỗi từ server
                            Swal.fire({
                                icon: 'error',
                                title: data.message || 'An error occurred.',
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Hiển thị thông báo lỗi chung
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong. Please try again later.',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
            });
        });
    });
</script>

@endsection