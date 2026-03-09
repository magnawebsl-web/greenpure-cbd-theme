<?php
/*
Template Name: Politique de confidentialité
Description: Page de politique de confidentialité CBDBorea
*/
get_header(); 
?>

<div class="page-hero">
    <div class="container">
        <h1 class="page-hero__title">Politique de confidentialité</h1>
    </div>
</div>

<div class="container">
    <div class="page-content entry-content legal-content">
        <h2>Collecte des données personnelles</h2>
        <p>Nous collectons les données personnelles suivantes :</p>
        <ul>
            <li>Nom et prénom</li>
            <li>Adresse email</li>
            <li>Adresse de livraison</li>
            <li>Numéro de téléphone</li>
            <li>Données de paiement (sécurisées)</li>
        </ul>
        
        <h2>Utilisation des données</h2>
        <p>Vos données sont utilisées pour :</p>
        <ul>
            <li>Traitement de vos commandes</li>
            <li>Communication sur vos commandes</li>
            <li>Envoi de notre newsletter (avec votre consentement)</li>
            <li>Amélioration de nos services</li>
        </ul>
        
        <h2>Conservation des données</h2>
        <p>Vos données sont conservées pendant une durée de 3 ans à compter de votre dernière commande.</p>
        
        <h2>Vos droits</h2>
        <p>Conformément au RGPD, vous disposez des droits suivants :</p>
        <ul>
            <li>Droit d'accès à vos données</li>
            <li>Droit de rectification</li>
            <li>Droit à l'effacement</li>
            <li>Droit d'opposition</li>
            <li>Droit à la portabilité</li>
        </ul>
        
        <p>Pour exercer ces droits, contactez-nous à : contact@cbdborea.com</p>
        
        <p class="last-update">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>
    </div>
</div>

<?php get_footer(); ?>