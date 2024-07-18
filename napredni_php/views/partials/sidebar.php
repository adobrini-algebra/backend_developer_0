<aside class="d-flex flex-column p-3 text-bg-dark vh-100-min" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Videoteka Admin</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/" class="nav-link text-white link-primary" aria-current="page">
                <i class="bi bi-house me-2"></i>Home
            </a>
        </li>
        <li class="nav-item">
            <a href="/members" class="nav-link text-white link-primary <?= isCurrent("members") ?>" aria-current="<?= isCurrent("members", "page") ?>">
                <i class="bi bi-person-circle me-2"></i>Clanovi
            </a>
        </li>
        <li class="nav-item">
            <a href="/genres" class="nav-link text-white link-primary <?= isCurrent("genres") ?>" aria-current="<?= isCurrent("genres", "page") ?>">
                <i class="bi bi-camera-reels me-2"></i>Zanrovi
            </a>
        </li>
        <li class="nav-item">
            <a href="/movies" class="nav-link text-white link-primary <?= isCurrent("movies") ?>" aria-current="<?= isCurrent("movies", "page") ?>">
                <i class="bi bi-film me-2"></i>Filmovi
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