<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('account') ? 'active' : '' }}" href="{{ route('account') }}" role="tab">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('account.orders') ? 'active' : '' }}" href="{{ route('account.orders') }}" role="tab">Orders</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('account.manager') ? 'active' : '' }}" href="{{ route('account.manager') }}" role="tab">Manager</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('account.address') ? 'active' : '' }}" href="{{ route('account.address') }}" role="tab">Addresses</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Route::is('account.edit') ? 'active' : '' }}" href="{{ route('account.edit') }}" role="tab">Account Details</a>
        </li>
        <li class="nav-item"></li>
        <a class="nav-link" href="step-channel.html">Channel Upgrade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sign Out</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->