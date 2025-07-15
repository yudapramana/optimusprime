<nav class="main-header navbar navbar-expand-md navbar-dark bg-primary">

    <div class="container">
        <a href="index.html" class="navbar-brand">
            <span class="brand-text font-weight-bold text-light">SIPRIMA</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="/" class="btn btn-primary ml-2">Home</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="/login" class="btn btn-primary ml-2">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary ml-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mx-2"></i>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
