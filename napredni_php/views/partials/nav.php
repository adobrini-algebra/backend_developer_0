<nav class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 <?= setActiveCalss('/') ?>" <?= setAriaCurent("/") ?>>Home</a></li>
                <li><a href="/dashboard" class="nav-link px-2 <?= setActiveCalss('dashboard') ?>" <?= setAriaCurent("dashboard") ?>>Dashboard</a></li>
                <li><a href="/rentals" class="nav-link px-2 <?= setActiveCalss('rentals') ?>" <?= setAriaCurent("rentals") ?>>Posudbe</a></li>
                <li><a href="/members" class="nav-link px-2 <?= setActiveCalss('members') ?>" <?= setAriaCurent("members") ?>>Clanovi</a></li>
                <li><a href="/genres" class="nav-link px-2 <?= setActiveCalss('genres') ?>" <?= setAriaCurent("genres") ?>>Zanrovi</a></li>
                <li><a href="/movies" class="nav-link px-2 <?= setActiveCalss('movies') ?>" <?= setAriaCurent("movies") ?>>Filmovi</a></li>
                <li><a href="/prices" class="nav-link px-2 <?= setActiveCalss('prices') ?>" <?= setAriaCurent("prices") ?>>Cjenik</a></li>
                <li><a href="/formats" class="nav-link px-2 <?= setActiveCalss('formats') ?>" <?= setAriaCurent("formats") ?>>Mediji</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
            </form>

            <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2">Login</button>
                <button type="button" class="btn btn-warning">Sign-up</button>
            </div>
        </div>
    </div>
</nav>
