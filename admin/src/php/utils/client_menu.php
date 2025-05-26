<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index_.php?page=accueil.php">
            🎟 Espace Client
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index_.php?page=accueil.php">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=programmes.php">
                        <i class="fas fa-theater-masks"></i> Programmes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=mes_reservations.php">
                        <i class="fas fa-ticket-alt"></i> Mes réservations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=profil_client.php">
                        <i class="fas fa-user"></i> Mon profil
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="index_.php?page=disconnect.php" class="btn btn-outline-light me-3">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Recherche..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">OK</button>
                </form>
            </div>
        </div>
    </div>
</nav>
