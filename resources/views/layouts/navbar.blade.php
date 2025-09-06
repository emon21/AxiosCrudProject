<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
        <!-- Logo + Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <img src="https://dummyimage.com/32x32/000/fff.png&text=L" alt="Logo" width="32" height="32"
                class="rounded">
            <span class="fw-semibold">Laravel Application</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            </ul>

            <!-- Search -->
            {{-- <form class="d-flex me-3" role="search" action="#" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search…"
                        aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form> --}}

            <!-- Auth (Guest) -->
            <!-- guest অবস্থায় দেখান -->
            {{-- <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-secondary">Login</a>
                    <a href="#" class="btn btn-primary">Register</a>
                </div> --}}

            <!-- Auth (Logged-in) -->
            <!-- লগইন থাকলে উপরকার দুইটা বাটনের জায়গায় এটা দেখান -->

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://i.pravatar.cc/100?img=12" alt="User" class="avatar me-2">
                    <span>John Doe</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2">
                    <li><a class="dropdown-item" href="#">Dashboard</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="#">
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
