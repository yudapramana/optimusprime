<a href="index3.html" class="brand-link">
    <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">MONITORING</li>
            <li class="nav-item">
                <a href={{ url('/admin/home') }} class="nav-link @if (Request::segment(2) == 'home') active @endif">

                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item @if (Request::segment(2) == 'master') menu-open @endif">
                <a href="#" class="nav-link @if (Request::segment(2) == 'master') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/master/academic_semesters') }}" class="nav-link @if (Request::segment(2) == 'master' && Request::segment(3) == 'academic_semesters') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Akademik Semester</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/master/faculties') }}" class="nav-link @if (Request::segment(2) == 'master' && Request::segment(3) == 'faculties') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Biaya Fakultas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/master/banks') }}" class="nav-link @if (Request::segment(2) == 'master' && Request::segment(3) == 'banks') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Akun Bank</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/master/three_installment_criterias') }}" class="nav-link @if (Request::segment(2) == 'master' && Request::segment(3) == 'three_installment_criterias') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Cicilan</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item @if (Request::segment(2) == 'data') menu-open @endif">
                <a href="#" class="nav-link @if (Request::segment(2) == 'data') active @endif">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>
                        Daftar Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/data/students') }}" class="nav-link @if (Request::segment(2) == 'data' && Request::segment(3) == 'students') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mahasiswa</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">VERIFICATION</li>

            <li class="nav-item">
                <a href={{ url('/admin/verify/students') }} class="nav-link @if (Request::segment(2) == 'verify' && Request::segment(3) == 'students') active @endif">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href={{ url('/admin/verify/payments') }} class="nav-link @if (Request::segment(2) == 'verify' && Request::segment(3) == 'payments') active @endif">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>Pembayaran</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
