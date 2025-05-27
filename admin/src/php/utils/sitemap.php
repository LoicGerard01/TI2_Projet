<?php
header("Content-Type: application/xml; charset=utf-8");
$base_url = "http://localhost/projet/";

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $base_url ?></loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=accueil.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=accueil_client.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=disconnect.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=fiche_representation.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=generate_ticket.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=login.php</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=programmes.php</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=mes_reservations.php</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=profil_client.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?= $base_url ?>index_.php?page=register.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

</urlset>
