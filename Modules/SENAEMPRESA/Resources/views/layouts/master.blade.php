<!DOCTYPE html>
<html lang="es">
@include('senaempresa::layouts.structure.head')

@section('stylesheet')
@show

<body class="hold-transition {{ Route::is('cefa.senaempresa.index') ? 'layout-top-nav' : 'sidebar-mini layout-fixed' }}">
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        @unless(Route::is('cefa.senaempresa.index'))
            <!-- Sidebar solo si NO es la ruta de inicio -->
            @include('senaempresa::layouts.structure.aside')
        @endunless

        <!-- Envoltorio de contenido. Contiene el contenido de la página. -->
        <div class="content-wrapper" style="{{ Route::is('cefa.senaempresa.index') ? 'margin-left: 0;' : '' }}">
            
            <!-- Encabezado de contenido (encabezado de página) -->
            @include('senaempresa::layouts.structure.breadcrumb')
         
            <!-- /.content-header -->

            <!-- Contenido principal -->
            @section('content')
            @show
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('senaempresa::layouts.structure.footer')
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('senaempresa::layouts.structure.scripts')

    @section('scripts')
    @show

    @section('dataTables')
    @show

</body>
</html>
