<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-lightblue">
    <!-- Brand Logo -->
    <a href="{{ route('panel.show') }}" class="brand-link">
        <img src="{{ url('public/dist/img/logoAutomation.png') }}" alt="Automation Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Automation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent"
                data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('panel.show') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Painel</p>
                    </a>
                </li>
                <li class="nav-header">AUTOMAÇÃO</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-whatsapp text-green"></i>
                        <p>Whatsapp
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('campaigns.index') }}" class="nav-link">
                                <i class="fas fa-funnel-dollar nav-icon"></i>
                                <p>Campanhas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="3" class="nav-link">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>Segmentação</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>{{ __('Grupos') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">{{ __('AJUDA') }}</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>{{ __('Documentação') }}</p>
                    </a>
                </li>
                <li class="nav-header">{{ __('USUÁRIO') }}</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-address-card text-primary"></i>
                        <p>{{ __('Perfil') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text">{{ __('Sair') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
