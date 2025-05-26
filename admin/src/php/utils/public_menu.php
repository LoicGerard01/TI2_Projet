<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index_.php?page=accueil.php">
            🎭 Théâtre Condorcet
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Liens principaux -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index_.php?page=accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=programmes.php">Nos programmes</a>
                </li>
            </ul>

            <!-- Barre de recherche -->
            <form class="d-flex me-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">OK</button>
            </form>

            <!-- Zone connexion / compte -->
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['client'])) { ?>
                    <a href="index_.php?page=disconnect.php" class="btn btn-outline-light me-2">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                <?php } else { ?>
                    <a href="index_.php?page=login.php" class="btn btn-outline-light me-2">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    <a href="index_.php?page=register.php" class="btn btn-warning">
                        <i class="fas fa-user-plus"></i> S’inscrire
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
