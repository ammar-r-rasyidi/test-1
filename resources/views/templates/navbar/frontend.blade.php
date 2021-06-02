  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ url('') }}" class="navbar-brand mt-3 px-2 py-2">
        <img src="{{ url('logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      </a>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="{{ url('dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="{{ url('login') }}" class="nav-link">Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
