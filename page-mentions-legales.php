<?php
/*
Template Name: Mentions légales
Description: Page des mentions légales CBDBorea
*/
get_header(); 
?>

<div class="page-hero">
    <div class="container">
        <h1 class="page-hero__title">Mentions légales</h1>
    </div>
</div>

<div class="container">
    <div class="page-content entry-content legal-content">
        <h2>Informations légales</h2>
        
        <p>Le site cbdborea.com est exploité par :</p>
        
        <div class="legal-info">
            <p><strong>Raison sociale :</strong> CBD Borea</p>
            <p><strong>Adresse :</strong> [À compléter]</p>
            <p><strong>Email :</strong> contact@cbdborea.com</p>
            <p><strong>SIRET :</strong> [À compléter]</p>
            <p><strong>TVA intracommunautaire :</strong> [À compléter]</p>
        </div>
        
        <h2>Directeur de la publication</h2>
        <p>Le directeur de la publication est [À compléter].</p>
        
        <h2>Hébergement</h2>
        <p>Le site est hébergé par [À compléter].</p>
        
        <h2>Propriété intellectuelle</h2>
        <p>Tous les contenus présents sur ce site (textes, images, logos, vidéos) sont protégés par les droits de propriété intellectuelle.</p>
        
        <h2>Responsabilité</h2>
        <p>Les informations fournies sur ce site le sont à titre purement informatif. CBD Borea s'efforce d'assurer l'exactitude des informations présentes sur ce site.</p>
        
        <h2>Produits CBD</h2>
        <p>Tous nos produits CBD contiennent moins de 0,3% de THC conformément à la législation française en vigueur. Les produits CBD ne sont pas des médicaments et ne doivent pas être utilisés comme tels.</p>
        
        <p class="last-update">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>
    </div>
</div>

<?php get_footer(); ?>