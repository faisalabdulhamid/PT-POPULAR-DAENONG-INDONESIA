<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <!--IE Compatibility modes-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile first-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>{{ (isset($title))? $title: config('app.name')  }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
  <meta name="author" content="">
  
  <meta name="msapplication-TileColor" content="#5bc0de" />
  <meta name="msapplication-TileImage" content="dist/img/metis-tile.png" />
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('dist/lib/bootstrap/css/bootstrap.css') }}" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  
  <!-- Metis core stylesheet -->
  <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
  
  <!-- metisMenu stylesheet -->
  <link rel="stylesheet" href="{{ asset('dist/lib/metismenu/metisMenu.css') }}">
  
  <!-- onoffcanvas stylesheet -->
  <link rel="stylesheet" href="{{ asset('dist/lib/onoffcanvas/onoffcanvas.css') }}">
  
  <!-- animate.css stylesheet -->
  <link rel="stylesheet" href="{{ asset('dist/lib/animate.css/animate.css') }}">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <link rel="stylesheet" href="{{ asset('dist/css/style-switcher.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/less/theme.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

</head>

<body class="">
  <div class="bg-dark dk" id="wrap">

    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">

              <!-- Brand and toggle get grouped for better mobile display -->
              <header class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a href="index.html" class="navbar-brand"><img src="{{ config('app.icon') }}" alt="{{ config('app.name') }}"></a>
              </header>

              <div class="topnav">
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                       class="btn btn-default btn-sm" id="toggleFullScreen">
                        <i class="glyphicon glyphicon-fullscreen"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                       class="btn btn-metis-1 btn-sm" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();localStorage.removeItem('token_popular');">
                        <i class="fa fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
                       class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
              </div>
        
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
    </div>
    <!-- /#top -->

    <div id="left">
      <div class="media user-media bg-dark dker">
          <div class="user-media-toggleHover">
              <span class="fa fa-user"></span>
          </div>
          <div class="user-wrapper bg-dark">
              <a class="user-link" href="">
                  <img class="media-object img-thumbnail user-img" alt="User Picture" src="dist/img/user.gif">
              </a>
      
              <div class="media-body">
                  <h5 class="media-heading">{{ Auth::user()->nama }}</h5>
                  <ul class="list-unstyled user-info">
                      <li><a href="">{{ Auth::user()->divisi }}</a></li>
                      <li>Last Access : <br>
                          <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                      </li>
                  </ul>
              </div>
          </div>
      </div>

      <!-- #menu -->
      <ul id="menu" class="bg-dark dker">
        <li class="nav-header">Menu</li>
        <li class="nav-divider"></li>
        <li class="">
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pegawai') }}">
            <i class="fa fa-table"></i>
            <span class="link-title">Pegawai</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pelanggan') }}">
            <i class="fa fa-font"></i>
            <span class="link-title">Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="{{ route('supplier') }}">
            <i class="fa fa fa-bar-chart-o"></i>
            <span class="link-title">Supplier</span>
          </a>
        </li>
        <li>
          <a href="{{ route('produk') }}">
            <i class="fa fa-calendar"></i>
            <span class="link-title">Produk</span>
          </a>
        </li>
        <li>
          <a href="{{ route('bahan-baku') }}">
            <i class="fa fa-columns"></i>
            <span class="link-title">Bahan Baku</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pesanan') }}">
            <i class="fa fa-columns"></i>
            <span class="link-title">Pesanan</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pembelian') }}">
            <i class="fa fa-columns"></i>
            <span class="link-title">Pembelian</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pengiriman') }}">
            <i class="fa fa-columns"></i>
            <span class="link-title">Pengiriman</span>
          </a>
        </li>
        <li>
          <a href="{{ route('produksi') }}">
            <i class="fa fa-columns"></i>
            <span class="link-title">Produksi</span>
          </a>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-pencil"></i>
            <span class="link-title">
          Forms
            </span>
            <span class="fa arrow"></span>
          </a>
          <ul class="collapse">
            <li>
              <a href="form-general.html">
                <i class="fa fa-angle-right"></i>&nbsp; Form General </a>
            </li>
            <li>
              <a href="form-validation.html">
                <i class="fa fa-angle-right"></i>&nbsp; Form Validation </a>
            </li>
            <li>
              <a href="form-wizard.html">
                <i class="fa fa-angle-right"></i>&nbsp; Form Wizard </a>
            </li>
            <li>
              <a href="form-wysiwyg.html">
                <i class="fa fa-angle-right"></i>&nbsp; Form WYSIWYG </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /#menu -->
    </div>
    <!-- /#left -->

    @yield('content')

  </div>
  <!-- /#wrap -->


  <footer class="Footer bg-dark dker">
      <p>2017 &copy; {{ config('app.name') }}</p>
  </footer>
  <!-- /#footer -->

  <!--jQuery -->
  <script src="{{ asset('dist/lib/jquery/jquery.js') }}"></script>

  <!--Bootstrap -->
  <script src="{{ asset('dist/lib/bootstrap/js/bootstrap.js') }}"></script>
  <!-- MetisMenu -->
  <script src="{{ asset('dist/lib/metismenu/metisMenu.js') }}"></script>
  <!-- onoffcanvas -->
  <script src="{{ asset('dist/lib/onoffcanvas/onoffcanvas.js') }}"></script>
  <!-- Screenfull -->
  <script src="{{ asset('dist/lib/screenfull/screenfull.js') }}"></script>

  <!-- Metis core scripts -->
  <script src="{{ asset('dist/js/core.js') }}"></script>
  <!-- Metis demo scripts -->
  <script src="{{ asset('dist/js/app.js') }}"></script>

  <script src="{{ asset('dist/js/style-switcher.js') }}"></script>

  @stack('script')
</body>

</html>
