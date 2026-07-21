<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light px-4">Agricultura</span>
    </a>

    <div style="height: 10px"></div>
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class -->
                
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('clients.index') }}" class="nav-link">
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <p>Implementos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">
                        <p>Registrar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <p>Prestamos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('evidences.index') }}" class="nav-link">
                        <p>Evidencias</p>
                    </a>
                </li>


                

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
