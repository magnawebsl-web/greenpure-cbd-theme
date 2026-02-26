<?php
/**
 * GreenPure CBD — Données démo
 * Crée automatiquement les catégories + produits de démonstration.
 *
 * Utilisation : ajouter ?greenpure_install_demo=1 dans l'URL une fois
 * connecté en admin, ou appeler greenpure_install_demo_products() directement.
 *
 * SUPPRIMER ce fichier en production si vous ne voulez plus les données démo.
 */
defined('ABSPATH') || exit;

/* ──────────────────────────────────────────────
   Déclencheur URL : ?greenpure_install_demo=1
────────────────────────────────────────────── */
add_action('init', function () {
    if (
        isset($_GET['greenpure_install_demo']) &&
        current_user_can('manage_woocommerce') &&
        class_exists('WooCommerce')
    ) {
        greenpure_install_demo_products();
        wp_redirect(admin_url('edit.php?post_type=product&greenpure_demo=ok'));
        exit;
    }
});

/* ──────────────────────────────────────────────
   FONCTION PRINCIPALE
────────────────────────────────────────────── */
function greenpure_install_demo_products() {
    if (! class_exists('WooCommerce')) return;

    /* ---- Catégories ---- */
    $cats = [
        'huiles-cbd'    => ['name' => 'Huiles CBD',         'desc' => 'Huiles CBD full et broad spectrum de haute qualité.'],
        'fleurs-cbd'    => ['name' => 'Fleurs CBD',          'desc' => 'Fleurs CBD bio, séchées à froid, < 0,2 % THC.'],
        'gummies-cbd'   => ['name' => 'Gummies CBD',         'desc' => 'Gommes CBD vegan, sans sucre ajouté.'],
        'cosmetiques'   => ['name' => 'Cosmétiques CBD',     'desc' => 'Crèmes, baumes et sérums au CBD.'],
        'infusions-cbd' => ['name' => 'Infusions CBD',       'desc' => 'Tisanes aux plantes enrichies en CBD.'],
        'capsules-cbd'  => ['name' => 'Capsules CBD',        'desc' => 'Capsules dosées avec précision pour la routine quotidienne.'],
        'e-liquides'    => ['name' => 'E-liquides CBD',      'desc' => 'E-liquides CBD pour cigarettes électroniques, bases 50/50.'],
    ];

    $cat_ids = [];
    foreach ($cats as $slug => $data) {
        $existing = get_term_by('slug', $slug, 'product_cat');
        if ($existing) {
            $cat_ids[$slug] = $existing->term_id;
        } else {
            $term = wp_insert_term($data['name'], 'product_cat', [
                'slug'        => $slug,
                'description' => $data['desc'],
            ]);
            $cat_ids[$slug] = is_wp_error($term) ? 0 : $term['term_id'];
        }
    }

    /* ---- Produits ---- */
    $products = [

        /* ══════════════ HUILES CBD ══════════════ */
        [
            'name'        => 'Huile CBD Full Spectrum 5% — 10ml',
            'sku'         => 'GP-HFS-05',
            'price'       => '19.90',
            'sale'        => '14.90',
            'cat'         => 'huiles-cbd',
            'featured'    => true,
            'short_desc'  => 'Idéale pour les débutants. Extraction CO₂ supercritique, huile MCT bio.',
            'description' => '<p>Notre huile CBD Full Spectrum 5% est le point d'entrée parfait pour découvrir les bienfaits du CBD. Formulée à partir de chanvre bio cultivé en France, extraite par CO₂ supercritique pour préserver tous les cannabinoïdes et terpènes naturels.</p><ul><li>Concentration : 500 mg CBD / 10 ml</li><li>Spectre : Full Spectrum (&lt; 0,2 % THC)</li><li>Base : Huile MCT de noix de coco bio</li><li>Origine chanvre : France</li></ul>',
            'cbd_concentration' => '5%',
            'cbd_spectrum'      => 'Full Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 150,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Huile CBD Full Spectrum 10% — 10ml',
            'sku'         => 'GP-HFS-10',
            'price'       => '34.90',
            'sale'        => '',
            'cat'         => 'huiles-cbd',
            'featured'    => true,
            'short_desc'  => 'Notre best-seller. 1000 mg CBD, spectre complet, base MCT bio.',
            'description' => '<p>La Huile CBD Full Spectrum 10% est notre produit phare. Avec 1000 mg de CBD par flacon, elle offre un excellent rapport qualité-prix pour une utilisation quotidienne.</p><ul><li>Concentration : 1000 mg CBD / 10 ml</li><li>Spectre : Full Spectrum (&lt; 0,2 % THC)</li><li>Base : Huile MCT de noix de coco bio</li><li>Certifié labo ISO 17025</li></ul>',
            'cbd_concentration' => '10%',
            'cbd_spectrum'      => 'Full Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 200,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Huile CBD Full Spectrum 20% — 10ml',
            'sku'         => 'GP-HFS-20',
            'price'       => '59.90',
            'sale'        => '54.90',
            'cat'         => 'huiles-cbd',
            'featured'    => false,
            'short_desc'  => 'Haute concentration pour utilisateurs avancés. 2000 mg CBD / 10 ml.',
            'description' => '<p>Notre formule haute concentration pour les utilisateurs expérimentés cherchant un effet puissant. 2000 mg de CBD pur par flacon, extraction premium.</p>',
            'cbd_concentration' => '20%',
            'cbd_spectrum'      => 'Full Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'Suisse',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 80,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Huile CBD Broad Spectrum 10% — 10ml',
            'sku'         => 'GP-HBS-10',
            'price'       => '29.90',
            'sale'        => '',
            'cat'         => 'huiles-cbd',
            'featured'    => false,
            'short_desc'  => 'Sans THC détectable. Idéale pour les sportifs soumis à des contrôles.',
            'description' => '<p>La Huile CBD Broad Spectrum 10% contient tous les cannabinoïdes bénéfiques sauf le THC, qui est rigoureusement éliminé par chromatographie. Parfaite pour les sportifs de haut niveau.</p>',
            'cbd_concentration' => '10%',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ + Chromatographie',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 120,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Huile CBD Sommeil 15% + Mélatonine — 10ml',
            'sku'         => 'GP-HSM-15',
            'price'       => '44.90',
            'sale'        => '39.90',
            'cat'         => 'huiles-cbd',
            'featured'    => true,
            'short_desc'  => 'CBD 15% + mélatonine + lavande. Formulée pour favoriser un endormissement rapide.',
            'description' => '<p>Notre formule Sommeil exclusive associe 1500 mg de CBD Full Spectrum à 1 mg de mélatonine par dose et de l'huile essentielle de lavande vraie. Idéale 30 min avant le coucher.</p>',
            'cbd_concentration' => '15%',
            'cbd_spectrum'      => 'Full Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 90,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Huile CBD Sport Recovery 10% — 10ml',
            'sku'         => 'GP-HSP-10',
            'price'       => '39.90',
            'sale'        => '',
            'cat'         => 'huiles-cbd',
            'featured'    => false,
            'short_desc'  => 'CBD + omega-3 + vitamine D. Spécialement formulée pour la récupération musculaire.',
            'description' => '<p>La formule Sport Recovery combine 1000 mg de CBD Broad Spectrum avec des oméga-3 issus de lin bio et de la vitamine D3. Conçue pour les sportifs qui souhaitent optimiser leur récupération.</p>',
            'cbd_concentration' => '10%',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 100,
            'weight'     => '0.05',
        ],

        /* ══════════════ FLEURS CBD ══════════════ */
        [
            'name'        => 'Fleurs CBD OG Kush Indoor — 3g',
            'sku'         => 'GP-FOG-3',
            'price'       => '12.90',
            'sale'        => '',
            'cat'         => 'fleurs-cbd',
            'featured'    => true,
            'short_desc'  => 'Arômes terreux et citronnés, effet relaxant. CBD ~18%, THC < 0,2%.',
            'description' => '<p>La OG Kush CBD Indoor est cultivée en intérieur sous LED à spectre complet. Arômes complexes de citron, de pin et de terre. Trichomes abondants, cure de 4 semaines minimale.</p>',
            'cbd_concentration' => '~18%',
            'cbd_spectrum'      => 'Fleur séchée',
            'cbd_extraction'    => 'N/A',
            'cbd_origin'        => 'Indoor France',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 300,
            'weight'     => '0.003',
        ],
        [
            'name'        => 'Fleurs CBD Amnesia Haze Indoor — 3g',
            'sku'         => 'GP-FAH-3',
            'price'       => '11.90',
            'sale'        => '',
            'cat'         => 'fleurs-cbd',
            'featured'    => false,
            'short_desc'  => 'Arômes citronnés et épicés, goût fruité, effet stimulant et créatif.',
            'description' => '<p>L\'Amnesia Haze CBD est une sativa à dominance qui offre des arômes citronnés et épicés remarquables. Parfaite pour la journée, elle favorise la concentration et la créativité.</p>',
            'cbd_concentration' => '~16%',
            'cbd_spectrum'      => 'Fleur séchée',
            'cbd_extraction'    => 'N/A',
            'cbd_origin'        => 'Indoor Espagne',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 250,
            'weight'     => '0.003',
        ],
        [
            'name'        => 'Fleurs CBD Critical+ Greenhouse — 5g',
            'sku'         => 'GP-FCG-5',
            'price'       => '15.90',
            'sale'        => '12.90',
            'cat'         => 'fleurs-cbd',
            'featured'    => true,
            'short_desc'  => 'Cultivée en serre bioclimatique. Arômes fruités et sucrés, CBD ~14%.',
            'description' => '<p>La Critical+ CBD Greenhouse est produite en serre bioclimatique, bénéficiant de la lumière naturelle. Arômes fruités, sucrés, légèrement épicés. Rendement élevé en CBD.</p>',
            'cbd_concentration' => '~14%',
            'cbd_spectrum'      => 'Fleur séchée',
            'cbd_extraction'    => 'N/A',
            'cbd_origin'        => 'Greenhouse Suisse',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 400,
            'weight'     => '0.005',
        ],
        [
            'name'        => 'Fleurs CBD Purple Haze Indoor — 3g',
            'sku'         => 'GP-FPH-3',
            'price'       => '13.90',
            'sale'        => '',
            'cat'         => 'fleurs-cbd',
            'featured'    => false,
            'short_desc'  => 'Teintes violettes, arômes de fruits rouges et raisin. CBD ~15%.',
            'description' => '<p>La Purple Haze CBD est une variété remarquable par ses teintes violettes et son profil aromatique unique de fruits rouges et de raisin. Cultivation indoor de qualité supérieure.</p>',
            'cbd_concentration' => '~15%',
            'cbd_spectrum'      => 'Fleur séchée',
            'cbd_extraction'    => 'N/A',
            'cbd_origin'        => 'Indoor Pays-Bas',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 180,
            'weight'     => '0.003',
        ],
        [
            'name'        => 'Fleurs CBD White Widow Outdoor Bio — 5g',
            'sku'         => 'GP-FWW-5',
            'price'       => '9.90',
            'sale'        => '',
            'cat'         => 'fleurs-cbd',
            'featured'    => false,
            'short_desc'  => 'Culture outdoor bio certifiée. Arômes de bois et d\'épices, très résineuse.',
            'description' => '<p>La White Widow CBD Outdoor Bio est certifiée agriculture biologique. Cultivée en plein air sans pesticides ni herbicides. Arômes de bois, de terre et d\'épices avec une résine abondante.</p>',
            'cbd_concentration' => '~12%',
            'cbd_spectrum'      => 'Fleur séchée',
            'cbd_extraction'    => 'N/A',
            'cbd_origin'        => 'Outdoor France Bio',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 500,
            'weight'     => '0.005',
        ],

        /* ══════════════ GUMMIES CBD ══════════════ */
        [
            'name'        => 'Gummies CBD Relaxation — 25mg x10',
            'sku'         => 'GP-GRX-10',
            'price'       => '24.90',
            'sale'        => '',
            'cat'         => 'gummies-cbd',
            'featured'    => true,
            'short_desc'  => 'Gommes vegan goût fruits tropicaux. 250mg CBD Broad Spectrum par boîte.',
            'description' => '<p>Nos Gummies CBD Relaxation sont formulées avec du CBD Broad Spectrum de qualité pharmaceutique. 100% vegan, sans gélatine animale, goût fruits tropicaux naturels. Sans sucre ajouté, sucrées à l'érythritol.</p><ul><li>25 mg CBD par gomme</li><li>Boîte de 10 gommes (250 mg total)</li><li>Vegan | Sans gluten | Sans sucre ajouté</li></ul>',
            'cbd_concentration' => '25mg/gomme',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 200,
            'weight'     => '0.08',
        ],
        [
            'name'        => 'Gummies CBD Sommeil + Mélatonine — 25mg x10',
            'sku'         => 'GP-GSM-10',
            'price'       => '27.90',
            'sale'        => '22.90',
            'cat'         => 'gummies-cbd',
            'featured'    => true,
            'short_desc'  => 'CBD 25mg + 1mg mélatonine + passiflore. Goût cerise-lavande.',
            'description' => '<p>Les Gummies Sommeil associent 25 mg de CBD Broad Spectrum à 1 mg de mélatonine et de l'extrait de passiflore par gomme. Saveur cerise-lavande apaisante. À prendre 30 min avant le coucher.</p>',
            'cbd_concentration' => '25mg/gomme',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 150,
            'weight'     => '0.08',
        ],
        [
            'name'        => 'Gummies CBD Multivitamines — 10mg x30',
            'sku'         => 'GP-GMV-30',
            'price'       => '34.90',
            'sale'        => '',
            'cat'         => 'gummies-cbd',
            'featured'    => false,
            'short_desc'  => 'CBD + vitamines B, C, D3, zinc. Pour le bien-être quotidien.',
            'description' => '<p>Les Gummies CBD Multivitamines combinent 10 mg de CBD Isolat avec un complexe vitaminique complet (B1, B6, B12, C, D3, E, zinc, magnésium). Goût orange naturel. Format 30 gommes pour un mois de cure.</p>',
            'cbd_concentration' => '10mg/gomme',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 %',
            'stock'      => 120,
            'weight'     => '0.15',
        ],
        [
            'name'        => 'Gummies CBD Anti-Stress Ashwagandha — 20mg x15',
            'sku'         => 'GP-GAS-15',
            'price'       => '29.90',
            'sale'        => '24.90',
            'cat'         => 'gummies-cbd',
            'featured'    => false,
            'short_desc'  => 'CBD 20mg + ashwagandha KSM-66 + L-théanine. Goût pomme verte.',
            'description' => '<p>Notre formule Anti-Stress associe 20 mg de CBD à 300 mg d'ashwagandha KSM-66 (breveté) et 100 mg de L-théanine pour un effet adaptogène maximal. Parfait pour les périodes de stress intense.</p>',
            'cbd_concentration' => '20mg/gomme',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 180,
            'weight'     => '0.10',
        ],

        /* ══════════════ COSMÉTIQUES ══════════════ */
        [
            'name'        => 'Crème CBD Anti-Douleur 500mg — 50ml',
            'sku'         => 'GP-CAD-50',
            'price'       => '28.90',
            'sale'        => '',
            'cat'         => 'cosmetiques',
            'featured'    => true,
            'short_desc'  => 'Crème chauffante au CBD, arnica et camphre. Soulage muscles et articulations.',
            'description' => '<p>Notre crème anti-douleur associe 500 mg de CBD Isolat à de l'arnica montana, du camphre naturel et de l'huile essentielle d'eucalyptus. Texture chauffante, absorption rapide.</p><ul><li>500 mg CBD Isolat / 50 ml</li><li>Arnica Montana BIO</li><li>Sans parabènes | Vegan | Testé dermatologiquement</li></ul>',
            'cbd_concentration' => '500mg/50ml',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 %',
            'stock'      => 90,
            'weight'     => '0.12',
        ],
        [
            'name'        => 'Baume CBD Muscles & Articulations 300mg — 60ml',
            'sku'         => 'GP-BMA-60',
            'price'       => '24.90',
            'sale'        => '19.90',
            'cat'         => 'cosmetiques',
            'featured'    => false,
            'short_desc'  => 'Baume solide CBD + beurre de karité + menthol. Idéal avant / après sport.',
            'description' => '<p>Le Baume Muscles & Articulations au CBD est formulé avec du beurre de karité bio, de l'huile de coco et du menthol naturel. Application ciblée sur les zones douloureuses.</p>',
            'cbd_concentration' => '300mg/60ml',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 %',
            'stock'      => 120,
            'weight'     => '0.10',
        ],
        [
            'name'        => 'Sérum CBD Anti-Âge 200mg — 30ml',
            'sku'         => 'GP-SAA-30',
            'price'       => '39.90',
            'sale'        => '',
            'cat'         => 'cosmetiques',
            'featured'    => true,
            'short_desc'  => 'CBD + acide hyaluronique + vitamine C. Texture légère, anti-rides.',
            'description' => '<p>Le Sérum Anti-Âge associe 200 mg de CBD à de l'acide hyaluronique pur (2 poids moléculaires), de la vitamine C stabilisée et du rétinol végétal. Texture sérum légère, absorption immédiate.</p>',
            'cbd_concentration' => '200mg/30ml',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 %',
            'stock'      => 70,
            'weight'     => '0.06',
        ],
        [
            'name'        => 'Masque Visage CBD Purifiant 100mg — 75ml',
            'sku'         => 'GP-MVC-75',
            'price'       => '19.90',
            'sale'        => '',
            'cat'         => 'cosmetiques',
            'featured'    => false,
            'short_desc'  => 'Masque argile + CBD + aloe vera. Purifie, resserre les pores, hydrate.',
            'description' => '<p>Le Masque Visage au CBD combine argile verte, aloe vera bio et 100 mg de CBD Isolat. Purifie en profondeur, resserre les pores dilatés et apporte une hydratation intense.</p>',
            'cbd_concentration' => '100mg/75ml',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 %',
            'stock'      => 100,
            'weight'     => '0.15',
        ],

        /* ══════════════ INFUSIONS ══════════════ */
        [
            'name'        => 'Infusion CBD Relaxante Camomille — 20 sachets',
            'sku'         => 'GP-IRC-20',
            'price'       => '16.90',
            'sale'        => '',
            'cat'         => 'infusions-cbd',
            'featured'    => false,
            'short_desc'  => 'Camomille, tilleul et fleurs de chanvre CBD. Apaisante et douce.',
            'description' => '<p>Notre infusion Relaxante associe de la camomille matricaire, du tilleul argenté et des fleurs de chanvre CBD broyées. Sans théine, à consommer le soir pour un effet relaxant optimal.</p>',
            'cbd_concentration' => '~50mg/sachet',
            'cbd_spectrum'      => 'Fleur chanvre',
            'cbd_extraction'    => 'Infusion',
            'cbd_origin'        => 'France Bio',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 200,
            'weight'     => '0.04',
        ],
        [
            'name'        => 'Infusion CBD Sommeil Lavande-Valériane — 20 sachets',
            'sku'         => 'GP-ISL-20',
            'price'       => '16.90',
            'sale'        => '13.90',
            'cat'         => 'infusions-cbd',
            'featured'    => false,
            'short_desc'  => 'Lavande, valériane et chanvre CBD. Favorise l'endormissement naturellement.',
            'description' => '<p>Cette infusion Sommeil associe lavande officinale, racine de valériane et fleurs de chanvre CBD pour un cocktail de plantes reconnu pour favoriser le sommeil. Sans accoutumance.</p>',
            'cbd_concentration' => '~50mg/sachet',
            'cbd_spectrum'      => 'Fleur chanvre',
            'cbd_extraction'    => 'Infusion',
            'cbd_origin'        => 'France Bio',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 180,
            'weight'     => '0.04',
        ],
        [
            'name'        => 'Infusion CBD Énergie Gingembre-Menthe — 20 sachets',
            'sku'         => 'GP-IEG-20',
            'price'       => '14.90',
            'sale'        => '',
            'cat'         => 'infusions-cbd',
            'featured'    => false,
            'short_desc'  => 'Gingembre, menthe poivrée et chanvre CBD. Tonifiante et stimulante.',
            'description' => '<p>L'infusion Énergie mêle gingembre frais, menthe poivrée et fleurs de chanvre CBD pour un réveil tout en douceur et une journée pleine d'énergie. Idéale le matin.</p>',
            'cbd_concentration' => '~50mg/sachet',
            'cbd_spectrum'      => 'Fleur chanvre',
            'cbd_extraction'    => 'Infusion',
            'cbd_origin'        => 'France Bio',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 160,
            'weight'     => '0.04',
        ],

        /* ══════════════ CAPSULES CBD ══════════════ */
        [
            'name'        => 'Capsules CBD 10mg — x30',
            'sku'         => 'GP-C10-30',
            'price'       => '29.90',
            'sale'        => '',
            'cat'         => 'capsules-cbd',
            'featured'    => false,
            'short_desc'  => 'Capsules CBD Isolat 10mg, enveloppe végétale. Dosage précis, discret.',
            'description' => '<p>Nos capsules CBD 10 mg offrent un dosage précis et une prise pratique. Enveloppe végétale HPMC (vegan), CBD Isolat dissous dans de l'huile d'olive extra-vierge bio.</p>',
            'cbd_concentration' => '10mg/capsule',
            'cbd_spectrum'      => 'Isolat',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 %',
            'stock'      => 130,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Capsules CBD 20mg — x30',
            'sku'         => 'GP-C20-30',
            'price'       => '44.90',
            'sale'        => '39.90',
            'cat'         => 'capsules-cbd',
            'featured'    => true,
            'short_desc'  => 'Capsules CBD Broad Spectrum 20mg. Effet entourage, sans THC.',
            'description' => '<p>Les capsules CBD 20 mg Broad Spectrum proposent un spectre élargi de cannabinoïdes (CBC, CBG, CBN) sans THC. Idéales pour une cure quotidienne efficace.</p>',
            'cbd_concentration' => '20mg/capsule',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'USA (chanvre)',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 100,
            'weight'     => '0.05',
        ],
        [
            'name'        => 'Capsules CBD 30mg Full Spectrum — x30',
            'sku'         => 'GP-C30-30',
            'price'       => '59.90',
            'sale'        => '',
            'cat'         => 'capsules-cbd',
            'featured'    => false,
            'short_desc'  => 'Haute dose Full Spectrum 30mg. Pour utilisateurs expérimentés.',
            'description' => '<p>Nos capsules haute dose 30 mg Full Spectrum sont destinées aux utilisateurs ayant déjà intégré le CBD dans leur routine. Maximum d'effet entourage avec tous les cannabinoïdes naturels.</p>',
            'cbd_concentration' => '30mg/capsule',
            'cbd_spectrum'      => 'Full Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '< 0,2 %',
            'stock'      => 60,
            'weight'     => '0.05',
        ],

        /* ══════════════ E-LIQUIDES ══════════════ */
        [
            'name'        => 'E-liquide CBD 300mg Natural — 10ml',
            'sku'         => 'GP-ELN-300',
            'price'       => '12.90',
            'sale'        => '',
            'cat'         => 'e-liquides',
            'featured'    => false,
            'short_desc'  => 'E-liquide CBD saveur naturelle chanvre. Base 50PG/50VG. Taux nicotine : 0mg.',
            'description' => '<p>Notre e-liquide CBD Natural 300 mg est formulé à base de CBD Broad Spectrum dans une base 50/50 PG/VG. Aucune nicotine, aucun additif. Saveur naturelle de chanvre, compatible tous atomiseurs.</p>',
            'cbd_concentration' => '300mg/10ml',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 200,
            'weight'     => '0.03',
        ],
        [
            'name'        => 'E-liquide CBD 600mg Fruits Rouges — 10ml',
            'sku'         => 'GP-ELF-600',
            'price'       => '17.90',
            'sale'        => '14.90',
            'cat'         => 'e-liquides',
            'featured'    => true,
            'short_desc'  => '600mg CBD, arôme fruits rouges naturel. Base 70VG/30PG. Vapeur dense.',
            'description' => '<p>L'e-liquide CBD Fruits Rouges 600 mg est notre best-seller vape. Arôme naturel de fraise, framboise et cassis. Base 70VG/30PG pour une vapeur dense et un hit doux.</p>',
            'cbd_concentration' => '600mg/10ml',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 250,
            'weight'     => '0.03',
        ],
        [
            'name'        => 'E-liquide CBD 600mg Menthe Glaciale — 10ml',
            'sku'         => 'GP-ELM-600',
            'price'       => '17.90',
            'sale'        => '',
            'cat'         => 'e-liquides',
            'featured'    => false,
            'short_desc'  => '600mg CBD, menthe glacier ultra-fraîche. Base 70VG/30PG.',
            'description' => '<p>L'e-liquide CBD Menthe Glaciale 600 mg offre une fraîcheur intense avec de la menthe naturelle et du cristal de menthol. Idéal pour les vapoteurs qui apprécient les saveurs fraîches et propres.</p>',
            'cbd_concentration' => '600mg/10ml',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 180,
            'weight'     => '0.03',
        ],
        [
            'name'        => 'E-liquide CBD 1000mg Mangue-Passion — 10ml',
            'sku'         => 'GP-ELH-1000',
            'price'       => '24.90',
            'sale'        => '19.90',
            'cat'         => 'e-liquides',
            'featured'    => true,
            'short_desc'  => 'Haute dose 1000mg CBD. Arôme mangue-passion exotique. Base 70VG/30PG.',
            'description' => '<p>Le e-liquide CBD Mangue-Passion 1000 mg est notre formule premium haute dose pour les vapoteurs expérimentés. Arôme exotique de mangue Alphonso et fruit de la passion.</p>',
            'cbd_concentration' => '1000mg/10ml',
            'cbd_spectrum'      => 'Broad Spectrum',
            'cbd_extraction'    => 'CO₂ Supercritique',
            'cbd_origin'        => 'France',
            'cbd_thc'           => '0,00 % (ND)',
            'stock'      => 120,
            'weight'     => '0.03',
        ],
    ];

    /* ---- Création des produits WooCommerce ---- */
    foreach ($products as $p) {
        // Éviter les doublons
        $existing_id = wc_get_product_id_by_sku($p['sku']);
        if ($existing_id) continue;

        $product = new WC_Product_Simple();
        $product->set_name($p['name']);
        $product->set_sku($p['sku']);
        $product->set_regular_price($p['price']);
        if (! empty($p['sale'])) {
            $product->set_sale_price($p['sale']);
        }
        $product->set_short_description(wp_kses_post($p['short_desc']));
        $product->set_description(wp_kses_post($p['description']));
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        $product->set_featured($p['featured']);
        $product->set_manage_stock(true);
        $product->set_stock_quantity($p['stock']);
        $product->set_stock_status('instock');
        $product->set_weight($p['weight']);
        $product->set_reviews_allowed(true);

        // Catégorie
        if (! empty($cat_ids[$p['cat']])) {
            $product->set_category_ids([$cat_ids[$p['cat']]]);
        }

        $product_id = $product->save();

        // Métas CBD
        if ($product_id) {
            update_post_meta($product_id, '_cbd_concentration', $p['cbd_concentration']);
            update_post_meta($product_id, '_cbd_spectrum',      $p['cbd_spectrum']);
            update_post_meta($product_id, '_cbd_extraction',    $p['cbd_extraction']);
            update_post_meta($product_id, '_cbd_origin',        $p['cbd_origin']);
            update_post_meta($product_id, '_cbd_thc',           $p['cbd_thc']);
        }
    }

    // Vider les caches WooCommerce
    wc_delete_product_transients();

    do_action('greenpure_demo_installed');
}
