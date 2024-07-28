<aside class="d-flex flex-column p-3 text-bg-dark vh-100-min" style="width: 220px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Videoteka Admin</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/" class="nav-link text-white link-primary <?= setActiveCalss("/") ?>" <?= setAriaCurent("/") ?>>
                <i class="bi bi-house me-2"></i>Home
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard" class="nav-link text-white link-primary <?= setActiveCalss("dashboard") ?>" <?= setAriaCurent("dashboard") ?>>
                <i class="bi bi-clipboard-pulse me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="/rentals" class="nav-link text-white link-primary <?= setActiveCalss("rentals") ?>" <?= setAriaCurent("rentals") ?>>
                <i class="bi bi-credit-card me-2"></i>Posudbe
            </a>
        </li>
        <li class="nav-item">
            <a href="/members" class="nav-link text-white link-primary <?= setActiveCalss("members") ?>" <?= setAriaCurent("members") ?>>
                <i class="bi bi-person-circle me-2"></i>Clanovi
            </a>
        </li>
        <li class="nav-item">
            <a href="/genres" class="nav-link text-white link-primary <?= setActiveCalss("genres") ?>" <?= setAriaCurent("genres") ?>>
                <i class="bi bi-camera-reels me-2"></i>Zanrovi
            </a>
        </li>
        <li class="nav-item">
            <a href="/movies" class="nav-link text-white link-primary <?= setActiveCalss("movies") ?>" <?= setAriaCurent("movies") ?>>
                <i class="bi bi-film me-2"></i>Filmovi
            </a>
        </li>
        <li class="nav-item">
            <a href="/prices" class="nav-link text-white link-primary <?= setActiveCalss("prices") ?>" <?= setAriaCurent("prices") ?>>
                <i class="bi bi-currency-euro me-2"></i>Cjenik
            </a>
        </li>
        <li class="nav-item">
            <a href="/formats" class="nav-link text-white link-primary <?= setActiveCalss("formats") ?>" <?= setAriaCurent("formats") ?>>
                <i class="bi bi-disc me-2"></i>Mediji
            </a>
        </li>
    </ul>

    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex p-1 align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>Korisnik</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</aside>