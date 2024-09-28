
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold">E-Procurement VhiWEB</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt {{ (Request::is('dashboard') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
    
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MAIN</h6>
      </li>
    
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('users') ? 'active' : '') }}" href="{{ url('users') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-users {{ (Request::is('users') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Users</span>
        </a>
      </li>
    
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('vendors') ? 'active' : '') }}" href="{{ url('vendors') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-store {{ (Request::is('vendors') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Vendors</span>
        </a>
      </li>
    
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('products') ? 'active' : '') }}" href="{{ url('products') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-box-open {{ (Request::is('products') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Products</span>
        </a>
      </li>
    
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PROCUREMENT</h6>
      </li>
    
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('purchase-requests') ? 'active' : '') }}" href="{{ url('purchase-requests') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file-alt {{ (Request::is('purchase-requests') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Purchase Request</span>
        </a>
      </li>
    
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('purchase-orders') ? 'active' : '') }}" href="{{ url('purchase-orders') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file-invoice-dollar {{ (Request::is('purchase-orders') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Purchase Order</span>
        </a>
      </li>
    
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">SYSTEM</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-sign-out-alt {{ (Request::is('logout') ? 'text-white' : 'text-dark') }}"></i>
          </div>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
      </li>
      
    </ul>
    
  </div>
  <div class="sidenav-footer mx-3 ">
    <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
      <div class="full-background" style="background-image: url('{{ asset('assets/img/curved-images/white-curved.jpeg') }}')"></div>
      <div class="card-body text-center p-3 w-100">
        <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
          <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
        </div>
        <div class="docs-info">
          <h6 class="text-white up mb-0"></h6>
          <p class="text-xs font-weight-bold text-start">This is made by</p>
          <a href="https://adityaerlangga.my.id/" target="_blank" class="btn btn-white btn-sm w-100 mb-0">Aditya Erlangga</a>
        </div>
      </div>
    </div>
  </div>
</aside>
