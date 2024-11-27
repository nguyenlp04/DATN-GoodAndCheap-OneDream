
@extends('layouts.client_layout')

     @section('content')
        <main class="main">
			
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Wishlist<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="container">
					<table class="table table-wishlist table-mobile">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Stock Status</th>
								<th></th>
								<th></th>
							</tr>
						</thead>

						<tbody>
						

							@foreach($wishlist as $item)
							<tr>
								<td class="product-col">
									<div class="product">
										<figure class="product-media">
										@if ($item->saleNews->images->isNotEmpty())
												<img src="{{ $item->saleNews->images->first()->image_name }}" alt="Image">
											@endif

										</figure>

										<h3 class="product-title">
											<a href="#">{{$item->saleNews->title}}</a>
										</h3><!-- End .product-title -->
									</div><!-- End .product -->
								</td>
								<td class="price-col">${{$item->saleNews -> price}}</td>
								
								<td class="stock-col"><span class=" {{ $item->saleNews ->status == 1 ? 'in-stock' : 'out-of-stock' }}"> {{ $item->saleNews ->status == 1 ? 'in-stock' : 'Out of stock' }}</span></td>
								<td class="action-col">
								<button class="btn btn-block btn-outline-primary-2 {{ $item->saleNews ->status == 1 ? '' : 'disabled' }}">
									<i class="fa fa-comments"></i> Messenger
								</button>

								</td>
								
								<td class="remove-col">
								<form action="{{ route('wishlist.destroy', $item->like_id) }}" method="POST" class="cdelete-form">
									@csrf
									@method('DELETE')
									<input type="hidden" name="like_id" value="{{ $item->like_id }}">
									<button type="button" class="btn-remove">
										<i class="icon-close"></i>
									</button>
								</form>






							</td>



								</td>

							</td>

								




							</tr>
							@endforeach
							
							
						</tbody>
					</table><!-- End .table table-wishlist -->
	            	<div class="wishlist-share">
	            		<div class="social-icons social-icons-sm mb-2">
	            			<label class="social-label">Share on:</label>
	    					<a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	    					<a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
	    					<a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	    					<a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	    					<a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
	    				</div><!-- End .soial-icons -->
	            	</div><!-- End .wishlist-share -->
            	</div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

		
       @endsection

	   @section('script-link-css')
	   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    // Lắng nghe sự kiện click vào nút xóa trong danh sách yêu thích
    $(document).on('click', '.btn-remove', function (e) {
        e.preventDefault();  // Ngừng hành động mặc định của nút

        // Lấy like_id từ input hidden trong form chứa nút
        var likeId = $(this).closest('form').find('input[name="like_id"]').val(); 
        var row = $(this).closest('tr');  // Lấy dòng (row) chứa mục cần xóa

        $.ajax({
            url: '/wishlist/' + likeId,  // URL của route destroy
            type: 'DELETE',  // Phương thức gửi yêu cầu là DELETE
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token
            },
            success: function(response) {
                if (response.success) {
                    // Hiển thị thông báo thành công với SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    // Xóa dòng khỏi bảng
                    row.remove();  
                } else {
                    // Thông báo lỗi khi không thể xóa
                    Swal.fire({
                        icon: 'error',
                        title: 'This item cannot be deleted.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);  // In ra lỗi trên console nếu có
                Swal.fire({
                    icon: 'error',
                    title: 'Error has occurred.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    });
</script>

@endsection




	