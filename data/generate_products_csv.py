#!/usr/bin/env python3
"""
Génère un CSV WooCommerce de produits variables avec grammages et prix.
Basé sur les prix réels de cbdborea.com + benchmarks marché 2025-2026.
"""
import csv, io

# ── Colonnes WooCommerce ─────────────────────────────────────────────
COLS = [
    "Type","SKU","Name","Published","Is featured?","Visibility in catalog",
    "Short description","Description","Date sale price starts","Date sale price ends",
    "Tax status","Tax class","In stock?","Stock","Low stock amount",
    "Backorders allowed?","Sold individually?","Weight (kg)","Length (cm)",
    "Width (cm)","Height (cm)","Allow customer reviews?","Purchase note",
    "Sale price","Regular price","Categories","Tags","Shipping class","Images",
    "Download limit","Download expiry days","Parent","Grouped products",
    "Upsells","Cross-sells","External URL","Button text","Position",
    "Attribute 1 name","Attribute 1 value(s)","Attribute 1 visible","Attribute 1 global",
    "Attribute 2 name","Attribute 2 value(s)","Attribute 2 visible","Attribute 2 global",
]

BASE_URL = "https://cbdborea.com/wp-content/themes/greenpure-cbd-theme/assets/images/products-premium/"

def row(**kw):
    r = {c: "" for c in COLS}
    r.update(kw)
    return r

# ── Grammages et prix par catégorie de produit ───────────────────────
#
# Format: [(grammage_label, prix_vente, prix_barre_ou_None)]
#
# Benchmarks marché France 2025 :
#  Indoor premium  : ~4.50-6€/g       → marge x1.8-2.2 du coût
#  Indoor standard : ~3.50-4.50€/g
#  Greenhouse      : ~2.00-3.00€/g
#  Outdoor Bio     : ~1.20-2.00€/g
#  Résine/Hash     : ~5.00-8.00€/g
#  Moonrocks       : ~8.00-12€/g
#  Icerocks        : ~9.00-13€/g

GRAMMAGES_INDOOR_PREMIUM = [
    ("1g",   5.90,  None),
    ("3g",  12.90,  None),
    ("5g",  19.90, 22.00),
    ("10g", 34.90, 39.00),
    ("25g", 74.90, 84.00),
    ("50g",129.90,149.00),
]
GRAMMAGES_INDOOR_LUXE = [   # Gelato, Wedding Cake
    ("1g",   6.90,  None),
    ("3g",  14.90, 16.90),
    ("5g",  22.90, 26.00),
    ("10g", 39.90, 45.00),
    ("25g", 84.90, 99.00),
    ("50g",149.90,179.00),
]
GRAMMAGES_GREENHOUSE = [
    ("1g",   3.50,  4.00),
    ("3g",   8.90, 10.00),
    ("5g",  12.90, 15.00),
    ("10g", 22.90, 27.00),
    ("25g", 44.90, 54.00),
    ("50g", 79.90, 99.00),
]
GRAMMAGES_OUTDOOR = [
    ("3g",   5.90,  None),
    ("5g",   8.90,  9.90),
    ("10g", 14.90, 17.00),
    ("25g", 29.90, 35.00),
    ("50g", 49.90, 60.00),
   ("100g", 79.90,100.00),
]
GRAMMAGES_RESINE = [
    ("1g",   7.90,  8.90),
    ("3g",  19.90, 22.90),
    ("5g",  29.90, 34.90),
    ("10g", 49.90, 59.90),
    ("25g", 99.90,119.90),
    ("50g",179.90,219.90),
]
GRAMMAGES_MOONROCKS = [
    ("1g",  11.90, 13.90),
    ("3g",  29.90, 34.90),
    ("5g",  44.90, 54.90),
    ("10g", 79.90, 99.90),
]
GRAMMAGES_ICEROCKS = [
    ("1g",  12.90, 14.90),
    ("3g",  32.90, 37.90),
    ("5g",  49.90, 59.90),
    ("10g", 89.90,109.90),
]

# ── Catalogue produits ───────────────────────────────────────────────
# (sku_prefix, nom, catégorie_woo, grammages, image_file, short_desc, cbd_pct, tags)
PRODUCTS = [
    # ── FLEURS INDOOR PREMIUM ──────────────────────────────────────
    ("GP-FOG",  "Fleurs CBD OG Kush Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_luxe.png",
     "Arômes complexes de citron, pin et terre. Effets relaxants. CBD ~18%.",
     "18%",
     "fleurs cbd, indoor, og kush, relaxation"),
    ("GP-FAH",  "Fleurs CBD Amnesia Haze Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_luxe.png",
     "Arômes citronnés et épicés, goût fruité. Effet stimulant et créatif. CBD ~20%.",
     "20%",
     "fleurs cbd, indoor, amnesia haze, stimulant"),
    ("GP-FPH",  "Fleurs CBD Purple Haze Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_gorilla.png",
     "Arômes fruités et floraux aux notes de myrtille. Effets euphorisants et créatifs. CBD ~17%.",
     "17%",
     "fleurs cbd, indoor, purple haze, créatif"),
    ("GP-FGG",  "Fleurs CBD Gorilla Glue Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_gorilla.png",
     "Arômes puissants de terre et de chocolat. Détente profonde. CBD ~22%.",
     "22%",
     "fleurs cbd, indoor, gorilla glue, détente"),
    ("GP-FLH",  "Fleurs CBD Lemon Haze Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_luxe.png",
     "Arômes citron vif et notes herbacées. Effet énergisant et focus. CBD ~19%.",
     "19%",
     "fleurs cbd, indoor, lemon haze, énergie"),
    ("GP-FSSH", "Fleurs CBD Super Silver Haze Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_luxe.png",
     "Arômes terreux et épicés avec une touche sucrée. Effets cérébraux et dynamiques. CBD ~21%.",
     "21%",
     "fleurs cbd, indoor, super silver haze, dynamique"),
    ("GP-FCH",  "Fleurs CBD Cheese Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_PREMIUM,
     "borea_fleur_cbd_luxe.png",
     "Arômes fromager caractéristiques et notes épicées. Détente et apaisement. CBD ~18%.",
     "18%",
     "fleurs cbd, indoor, cheese, apaisement"),
    # ── FLEURS INDOOR LUXE ────────────────────────────────────────
    ("GP-FGEL", "Fleurs CBD Gelato Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_LUXE,
     "borea_fleur_cbd_gorilla.png",
     "Arômes sucrés de dessert aux notes de fruits rouges et de menthe. CBD ~23%.",
     "23%",
     "fleurs cbd, indoor, gelato, premium, fruits rouges"),
    ("GP-FWC",  "Fleurs CBD Wedding Cake Indoor",
     "Fleurs CBD",
     GRAMMAGES_INDOOR_LUXE,
     "borea_fleur_cbd_gorilla.png",
     "Arômes vanillés et sucrés de gâteau. Relaxation profonde et bien-être. CBD ~24%.",
     "24%",
     "fleurs cbd, indoor, wedding cake, premium, relaxation"),
    # ── FLEURS GREENHOUSE ─────────────────────────────────────────
    ("GP-FCR",  "Fleurs CBD Critical Greenhouse",
     "Fleurs CBD",
     GRAMMAGES_GREENHOUSE,
     "borea_fleur_cbd_luxe.png",
     "Arômes sucrés et fruités. Bon rapport qualité/prix. CBD ~15%.",
     "15%",
     "fleurs cbd, greenhouse, critical, rapport qualité prix"),
    ("GP-FBD",  "Fleurs CBD Blue Dream Greenhouse",
     "Fleurs CBD",
     GRAMMAGES_GREENHOUSE,
     "borea_fleur_cbd_luxe.png",
     "Arômes de myrtille et de vanille. Effets équilibrés. CBD ~16%.",
     "16%",
     "fleurs cbd, greenhouse, blue dream, équilibré"),
    ("GP-FLHG", "Fleurs CBD Lemon Haze Greenhouse",
     "Fleurs CBD",
     GRAMMAGES_GREENHOUSE,
     "borea_fleur_cbd_luxe.png",
     "Arômes citronnés frais. Bon rapport qualité/prix pour une variété populaire. CBD ~15%.",
     "15%",
     "fleurs cbd, greenhouse, lemon haze, citron"),
    # ── FLEURS OUTDOOR BIO ────────────────────────────────────────
    ("GP-FWW",  "Fleurs CBD White Widow Outdoor Bio",
     "Fleurs CBD",
     GRAMMAGES_OUTDOOR,
     "borea_fleur_cbd_luxe.png",
     "Culture biologique en plein air. Arômes terreux et boisés. CBD ~12%.",
     "12%",
     "fleurs cbd, outdoor, bio, white widow, naturel"),
    ("GP-FBDO", "Fleurs CBD Blue Dream Outdoor Bio",
     "Fleurs CBD",
     GRAMMAGES_OUTDOOR,
     "borea_fleur_cbd_luxe.png",
     "Culture biologique. Arômes fruités et herbal. Idéal pour les petits budgets. CBD ~11%.",
     "11%",
     "fleurs cbd, outdoor, bio, blue dream, budget"),
    ("GP-FSK",  "Fleurs CBD Strawberry Kush Outdoor Bio",
     "Fleurs CBD",
     GRAMMAGES_OUTDOOR,
     "borea_fleur_cbd_luxe.png",
     "Arômes de fraise fraîche et notes herbacées. Production plein air biologique. CBD ~13%.",
     "13%",
     "fleurs cbd, outdoor, bio, strawberry, fruité"),
    # ── RÉSINES / HASH ────────────────────────────────────────────
    ("GP-RMA",  "Résine CBD Marocaine",
     "Résines CBD",
     GRAMMAGES_RESINE,
     "borea_fleur_cbd_luxe.png",
     "Hash traditionnel marocain au CBD. Texture souple, arômes terreux et épicés. CBD ~25%.",
     "25%",
     "résine cbd, hash, marocain, traditionnel"),
    ("GP-RCH",  "Résine CBD Charas",
     "Résines CBD",
     GRAMMAGES_RESINE,
     "borea_fleur_cbd_luxe.png",
     "Résine artisanale à la main, style indien. Texture crémeuse, arômes floraux. CBD ~28%.",
     "28%",
     "résine cbd, charas, indien, artisanal"),
    ("GP-RICO", "Résine CBD Ice-O-Lator",
     "Résines CBD",
     GRAMMAGES_RESINE,
     "borea_fleur_cbd_luxe.png",
     "Extraction à l'eau glacée. Pureté maximale, arômes intenses. CBD ~35%.",
     "35%",
     "résine cbd, ice-o-lator, extraction eau, pur"),
    ("GP-RPO",  "Pollen CBD Premium",
     "Résines CBD",
     GRAMMAGES_RESINE,
     "borea_fleur_cbd_luxe.png",
     "Pollen de haute qualité, texture fine et dorée. Arômes épicés et boisés. CBD ~30%.",
     "30%",
     "résine cbd, pollen, premium, épicé"),
    # ── MOONROCKS / ICEROCKS ──────────────────────────────────────
    ("GP-MROC", "Moonrocks CBD",
     "Moonrocks CBD",
     GRAMMAGES_MOONROCKS,
     "borea_fleur_cbd_gorilla.png",
     "Fleurs CBD enrobées de distillat et de kief. Concentration exceptionnelle. CBD ~40%.",
     "40%",
     "moonrocks, cbd, concentré, kief, distillat"),
    ("GP-IROC", "Icerocks CBD",
     "Moonrocks CBD",
     GRAMMAGES_ICEROCKS,
     "borea_fleur_cbd_gorilla.png",
     "Fleurs CBD recouvertes d'isolat de CBD pur. Blancheur cristalline, effet puissant. CBD ~50%.",
     "50%",
     "icerocks, cbd, isolat, cristal, puissant"),
]

rows = []

for sku_prefix, name, cat, grammages, img_file, short_desc, cbd_pct, tags in PRODUCTS:
    gram_labels = " | ".join(g[0] for g in grammages)
    image_url   = BASE_URL + img_file
    parent_sku  = sku_prefix + "-VAR"

    # ── Ligne parent (variable) ──────────────────────────────────
    rows.append(row(
        Type="variable",
        SKU=parent_sku,
        Name=name,
        Published="1",
        **{"Is featured?": "0"},
        **{"Visibility in catalog": "visible"},
        **{"Short description": short_desc},
        Description=(
            f"Découvrez notre {name} de qualité premium. {short_desc} "
            f"Taux de CBD : {cbd_pct}. THC < 0,2%. Cultivé en Union Européenne, "
            "certifié Bio. Analyses laboratoire indépendant disponibles."
        ),
        **{"Tax status": "taxable"},
        **{"In stock?": "1"},
        Stock="",
        **{"Allow customer reviews?": "1"},
        **{"Regular price": ""},
        **{"Sale price": ""},
        Categories=cat,
        Tags=tags,
        Images=image_url,
        **{"Attribute 1 name": "Grammage"},
        **{"Attribute 1 value(s)": gram_labels},
        **{"Attribute 1 visible": "1"},
        **{"Attribute 1 global": "1"},
    ))

    # ── Lignes variations ────────────────────────────────────────
    for i, (gram, sale, regular) in enumerate(grammages):
        var_sku = f"{sku_prefix}-{gram}"
        rows.append(row(
            Type="variation",
            SKU=var_sku,
            Name="",
            Published="1",
            **{"Visibility in catalog": "visible"},
            **{"Tax status": "taxable"},
            **{"In stock?": "1"},
            Stock="500",
            **{"Allow customer reviews?": "1"},
            **{"Sale price": str(sale) if (regular and regular > sale) else ""},
            **{"Regular price": str(regular) if regular else str(sale)},
            Parent=parent_sku,
            **{"Attribute 1 name": "Grammage"},
            **{"Attribute 1 value(s)": gram},
            **{"Attribute 1 visible": "1"},
            **{"Attribute 1 global": "1"},
        ))

# ── Écriture CSV ─────────────────────────────────────────────────────
out = "/home/user/greenpure-cbd-theme/data/woocommerce_variable_products.csv"
with open(out, "w", newline="", encoding="utf-8") as f:
    writer = csv.DictWriter(f, fieldnames=COLS)
    writer.writeheader()
    writer.writerows(rows)

print(f"✅ CSV généré : {out}")
print(f"   {len([r for r in rows if r['Type']=='variable'])} produits variables")
print(f"   {len([r for r in rows if r['Type']=='variation'])} variations")
print()

# Aperçu
for r in rows[:12]:
    t = r['Type']
    n = r['Name'] or f"  └─ {r['Attribute 1 value(s)']}"
    p = r['Regular price'] or r['Sale price']
    if r['Sale price'] and r['Regular price']:
        p = f"{r['Sale price']}€ (barré {r['Regular price']}€)"
    elif p:
        p = f"{p}€"
    print(f"[{t:9s}] {n:<45} {p}")
