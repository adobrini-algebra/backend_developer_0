<?php
use Core\Session;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Videoteka</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="assets/styles.css">
    </head>
    <body>
        <header class="p-3 text-body-secondary">
            <div class="container">
                <div class="d-flex gap-2 flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                        <span class="fs-4">Videoteka</span>
                    </a>
                    
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 flex-grow-1">
                        <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                        <li><a href="/members" class="nav-link px-2 text-dark">Dashboard</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">Pricing</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">FAQs</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
                    </ul>
                    <div class="text-end">
                    <?php if ($user = Session::get('user')): ?>
                            <?= $user['email'] ?>
                            <form class="ml-2 d-inline" action="/logout" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-primary me-2">Logout</a>
                            </form>
                        <?php else: ?>    
                            <a href="/login" type="button" class="btn btn-primary me-2">Login</a>
                            <a href="/register" type="button" class="btn btn-warning">Sign-up</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container py-4">
                <div class="p-5 mb-4 bg-body-tertiary rounded-3" style="max-width: 520px; margin: auto">
                    <div class="container-fluid">
                        <form class="row g-3 mt-3" action="/login" method="POST">
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <span class="text-danger small"><?= $errors['email'] ?? '' ?></span>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Lozinka</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Lozinka" required>
                                <span class="text-danger small"><?= $errors['password'] ?? '' ?></span>
                            </div>
                            <div class="col-12 mt-5 d-flex justify-content-between">
                                <a href="/" class="btn btn-primary mb-3">Povratak</a>
                                <button type="submit" class="btn btn-primary mb-3">Ulogiraj se</button>
                            </div>
                        </form>
                    </div>
                </div>

                <footer class="py-3">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">About</a></li>
                    </ul>
                    <p class="text-center text-secondary">© 2024 Company, Inc</p>
                </footer>
            </div>
        </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="assets/main.js"></script>
</body>
</html>