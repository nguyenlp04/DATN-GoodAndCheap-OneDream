@extends('layouts.client_layout') {{-- Giữ nguyên layout --}}
@section('content')
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<div class="container my-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-dark">Pricing Plans</h2>
    <p class="text-muted">Choose the plan that suits your needs</p>
  </div>

  <!-- Pricing Plans -->
  <div class="row g-4">
    <!-- Basic Plan -->
    <div class="col-lg-4 col-md-6">
      <div class="card border shadow-sm text-center h-100 rounded transition-shadow hover-shadow">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h3 class="fw-bold text-center mb-3">Basic Plan</h3>
            <h1 class="text-primary fw-bold mb-2">$0</h1>
            <p class="text-muted mb-4">/month</p>
            <ul class="list-unstyled text-start mb-4">
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>100 responses a month</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Unlimited forms and surveys</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Basic tools</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Up to 2 subdomains</li>
            </ul>
          </div>
          <button class="btn btn-primary w-100 rounded-pill">Current Plan</button>
        </div>
      </div>
    </div>

    <!-- Standard Plan -->
    <div class="col-lg-4 col-md-6">
      <div class="card border border-primary shadow-sm text-center h-100 rounded transition-shadow hover-shadow">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h3 class="fw-bold mb-3 ">Standard Plan</h3>
            <h1 class="text-primary fw-bold mb-2">$7</h1>
            <p class="text-muted mb-4">/month</p>
            <ul class="list-unstyled text-start mb-4">
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Unlimited responses</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Google Docs integration</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Custom "Thank you" page</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Instagram profile page</li>
            </ul>
          </div>
          <button class="btn btn-primary w-100 rounded-pill">Upgrade</button>
        </div>
      </div>
    </div>

    <!-- Enterprise Plan -->
    <div class="col-lg-4 col-md-6">
      <div class="card border border-2 shadow-sm text-center h-100 rounded transition-shadow hover-shadow">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h3 class="fw-bold mb-3">Enterprise Plan</h3>
            <h1 class="text-primary fw-bold mb-2">$16</h1>
            <p class="text-muted mb-4">/month</p>
            <ul class="list-unstyled text-start mb-4">
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>PayPal payments</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Logic Jumps</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>File upload (5GB storage)</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Custom domain support</li>
              <li class="d-flex align-items-center mb-3"><i class="bx bx-check-circle text-success me-2"></i>Stripe integration</li>
            </ul>
          </div>
          <button class="btn btn-primary w-100 rounded-pill">Upgrade</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<!-- Custom CSS to make the cards more friendly -->
<style>
.h4{
    font-family: var(--bs-body-font-family);
    color:light;
    font-weight: 500;
}
  .card {
    border-radius: 10px;
    border: 1px solid #ccc;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  /* Hover effect */
  .hover-shadow:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transform: translateY(-5px);
  }

  /* Button styling */
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }

  /* Align icon and text */
  .d-flex {
    display: flex;
    align-items: center; /* Ensure vertical alignment */
  }

  /* Adjust spacing between icon and text */
  .me-2 {
    margin-right: 0.5rem;
  }

  /* Spacing between list items */
  .mb-3 {
    margin-bottom: 1rem;
  }

  /* Color styling for primary text */
  .text-primary {
    color: #007bff !important;
  }

  /* Ensure consistency in border and spacing */


  /* Optional: Add some padding to the card */
  .card-body {
    padding: 2rem;
  }
</style>
