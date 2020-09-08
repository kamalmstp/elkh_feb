<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> 
        </a>
        <a class="brand" href="index.html">
          <i style="font-size: 1.5em;">e</i> - LKH & SKP FEB
        </a>
      <div class="nav-collapse">

        <ul class="nav pull-right">          
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 1.2em; font-weight: bold;">
              <i class="icon-user"></i> {{ Auth::user()->name }} <b class="caret" style=""></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('password')}}">Ganti Password</a></li>
              <li><a href="{{ route('logout_user')}}">Logout</a></li>
            </ul>
          </li>
        </ul>        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="{{ request()->is('/') ? ' active' : '' }}">
          <a href="{{ route('dashboard') }}" title="Manajemen User">
            <i class="icon-dashboard"></i><span>Dashboard</span> 
          </a> 
        </li>

        @role('admin')
        <li class="{{ request()->is('users', 'users/*') ? ' active' : '' }}">
          <a href="{{ route('user_list') }}" title="Manajemen User">
            <i class="icon-user"></i><span>User</span> 
          </a> 
        </li>

        <li class="dropdown {{ request()->is('bagian', 'pangkat', 'satuan',  'tahun') ? ' active' : '' }}">
          <a href="" class="dropdown-toggle" data-toggle="dropdown"> 
            <i class="icon-list-alt"></i><span>User Input</span> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('tahun_list') }}">Tahun</a></li>
            <li><a href="{{ route('bagian_list') }}">Bagian</a></li>
            <li><a href="{{ route('pangkat_list') }}">Pangkat & Golongan</a></li>
            <li><a href="{{ route('satuan_list') }}">Satuan</a></li>
          </ul>
        </li>
        @endrole
        
        @if(Auth::user()->id > 1)
        @if(count(Auth::user()->bawahan) > 0)
        <li class="{{ request()->is('bawahan', 'bawahan/*') ? ' active' : '' }}">
          <a href="{{ route('bawahan_list') }}" title="Daftar Bawahan">
            <i class="icon-group"></i><span>Bawahan</span> 
          </a> 
        </li>
        @endif
        @if(Auth::user()->id > 5)
        <li class="{{ request()->is('lkh', 'lkh/*') ? ' active' : '' }}">
          <a href="{{ route('lkh_list') }}" title="Laporan Kerja Harian">
            <i class="icon-book"></i><span>LKH</span> 
          </a> 
        </li>
        <li class="{{ request()->is('skp', 'skp/*') ? ' active' : '' }}">
          <a href="{{ route('skp_list') }}" title="Sasaran Kerja Pegawai">
            <i class="icon-briefcase"></i><span>SKP</span> 
          </a> 
        </li>
        @endif
        @endif
        
        
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
