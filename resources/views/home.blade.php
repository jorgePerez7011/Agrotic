@extends('layouts.app')

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
        <div class="wrapper">

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background: transparent;">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-success">Informaci&oacute;n</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#" class="text-success">Home</a></li>
                                    <li class="breadcrumb-item active text-success">Informaci&oacute;n</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Implementos -->
                            <div class="col-lg-3 col-6">
                                <a href="{{ route('products.index') }}" style="text-decoration:none;color:inherit;">
                                    <div class="small-box" style="background-color: #b8e994;">
                                        <div class="inner">
                                            <h3>{{ $productCount }}</h3>
                                            <p>Cantidad de Implementos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag text-success"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Usuarios -->
                            <div class="col-lg-3 col-6">
                                <a href="{{ route('clients.index') }}" style="text-decoration:none;color:inherit;">
                                    <div class="small-box" style="background-color: #a3d9a5;">
                                        <div class="inner">
                                            <h3>{{ $clientCount }}</h3>
                                            <p>Cantidad de Usuarios</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person text-success"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Préstamos diarios -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box" style="background-color: #f7e9b5;">
                                    <div class="inner">
                                        <h6>{{ $saleCountDay }} / {{ $saleTotalDay }}</h6>
                                        <p>Pr&eacute;stamos diarios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Préstamos mensuales -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box" style="background-color: #f5b7b1;">
                                    <div class="inner">
                                        <h6>{{ $saleCountMonth }} / {{ $saleTotalMonth }}</h6>
                                        <p>Pr&eacute;stamos mensuales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            
                <script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '68110456fc0247be2a7a6444' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production',
          voice: {
            url: "https://runtime-api.voiceflow.com"
          }
        });
      }
      v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>

            </footer>

            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
        </div>
    </body>
@endsection
