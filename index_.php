<?php
session_start();
include('./admin/src/php/utils/header.php');
include('./admin/src/php/utils/all_includes.php');
?>

<!doctype html>
<html>
<head>
    <title><?php print $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
    <script src="./admin/assets/js/fonctionsJqueryRepresentation.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body class="bg-theatre text-light">
<div id="page" class="container">
    <header class="bg-dark text-white text-center py-5 mb-4 " style="background: url('./admin/assets/images/theatre.jpg') no-repeat center center / cover;">
        <div class="container">
            <h1 class="display-5 fw-bold">Bienvenue sur notre plateforme de réservation</h1>
            <p class="lead">Spectacles, théâtre, concerts... Réservez facilement en ligne</p>
        </div>
    </header>

    <section id=" ">
        <nav>
            <?php
            if (isset($_SESSION['client'])) {
                if (file_exists('admin/src/php/utils/client_menu.php')) {
                    include('admin/src/php/utils/client_menu.php');
                }
            } else {
                if (file_exists('admin/src/php/utils/public_menu.php')) {
                    include('admin/src/php/utils/public_menu.php');
                }
            }
            ?>
        </nav>

    </section>

    <section id="contenu">
        <div class="container">
            <?php
            // print "sess : ".$_SESSION['page'];
            if(file_exists('./content/'.$_SESSION['page'])){
                $path = './content/'.$_SESSION['page'];
                include($path);
            }
            ?>
        </div>
    </section>

</div>

<?php
    if(file_exists('admin/src/php/utils/footer.php')){
        include('admin/src/php/utils/footer.php');
    }

?>

</body>
</html>

