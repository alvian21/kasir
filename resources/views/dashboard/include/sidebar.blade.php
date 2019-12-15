<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./index.html">
        <img src="{{ asset('/assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
      </a>

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="./assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item  class=" active" ">
          <a class=" nav-link active " href="{{ url('/admin/dashboard') }}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
            @if(Auth()->user()->role == 'admin')
            <li class="nav-item">
                    <a class="nav-link " href="{{ route('karyawan') }}">
                    <i class="ni ni-single-02 text-yellow"></i>Data Karyawan
                    </a>
                </li>
            @endif
            @if(Auth()->user()->role == 'karyawan')
            <li class="nav-item">
                    <a class="nav-link " href="{{ route('member') }}">
                    <i class="ni ni-single-02 text-yellow"></i>Member
                    </a>
                </li>
            @endif
          <li class="nav-item">
            <a class="nav-link " href="{{ route('barang') }}">
              <i class="ni ni-bullet-list-67 text-red"></i> Barang
            </a>
          </li>
        </ul>
        <!-- Divider -->

      </div>
    </div>
  </nav>
