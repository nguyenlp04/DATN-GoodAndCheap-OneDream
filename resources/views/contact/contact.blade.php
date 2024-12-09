@extends('layouts.client_layout')

@section('content')

<main class="main mt-0">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Pages</a></li>
				<li class="breadcrumb-item active" aria-current="page">Contact us</li>
			</ol>
		</div><!-- End .container -->
	</nav><!-- End .breadcrumb-nav -->
	<hr>

	<div class="page-content pb-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-2 mb-lg-0">
					<h2 class="title mb-1">Contact Information</h2><!-- End .title mb-2 -->
					<p class="mb-3">Good & Cheap is a newly established second-hand shopping website, offering quality products at affordable prices. During operation, if there are any errors, we hope to receive your understanding and suggestions. Your contribution will help us improve every day.

Thank you for accompanying Good & Cheap!</p>
					<div class="row">
						<div class="col-sm-7">
							<div class="contact-info">
								<h3>The Office</h3>

								<ul class="contact-list">
									<li>
										<i class="icon-map-marker"></i>
										@isset($setting->address)
										{{ $setting->address }}
										@else
										<p>Address has not been set yet.</p>
										@endisset

									</li>
									<li>
										<i class="icon-phone"></i>
										<a href="tel:#">
											@isset($setting->contact_phone)
											{{ $setting->contact_phone }}
											@else
											<p>Phone has not been set yet.</p>
											@endisset
										</a>
									</li>
									<li>
										<i class="icon-envelope"></i>
										<a href="mailto:#">
											@isset($setting->contact_email)
											{{ $setting->contact_email }}
											@else
											<p>Phone has not been set yet.</p>
											@endisset
										</a>
									</li>
								</ul><!-- End .contact-list -->
							</div><!-- End .contact-info -->
						</div><!-- End .col-sm-7 -->

						<div class="col-sm-5">

						</div><!-- End .col-sm-5 -->
					</div><!-- End .row -->
				</div><!-- End .col-lg-6 -->
				<div class="col-lg-6">
					<h2 class="title mb-1">Questions and Comments ?</h2><!-- End .title mb-2 -->
					<p class="mb-2">Use the form below to send feedback to staff</p>

					<form action="#" class="contact-form mb-3">


						<div class="row">
							<div class="col-sm-6">
								<label for="cphone" class="sr-only">Phone</label>
								<input type="tel" class="form-control" id="cphone" placeholder="Phone">
							</div><!-- End .col-sm-6 -->

							<div class="col-sm-6">
								<label for="csubject" class="sr-only">Title</label>
								<input type="text" class="form-control" id="csubject" placeholder="Subject">
							</div><!-- End .col-sm-6 -->
						</div><!-- End .row -->

						<label for="cmessage" class="sr-only">Message</label>
						<textarea class="form-control" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>

						<button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
							<span>SUBMIT</span>
							<i class="icon-long-arrow-right"></i>
						</button>
					</form><!-- End .contact-form -->
				</div><!-- End .col-lg-6 -->
			</div><!-- End .row -->

			<hr class="mt-4 mb-5">


		</div><!-- End .container -->
		<div class="container"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.156314926798!2d108.16073527379636!3d16.057376239757783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142193cd2fc46a3%3A0x228ba88e812f65e6!2zVGjDrWNoIFF14bqjbmcgxJDhu6ljLCBIw7JhIE1pbmgsIExpw6puIENoaeG7g3UsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1733369657989!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div><!-- End #map -->
	</div><!-- End .page-content -->
</main><!-- End .main -->


@endsection
@section('script-link-css')
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
@endsection
