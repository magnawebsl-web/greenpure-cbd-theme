<?php
/**
 * Template — Montant libre (paiement privé)
 * URL : /montant-libre  — Non indexé, hors navigation.
 * Flux : saisie montant → checkout direct (panier invisible).
 * POST handling + redirect géré dans functions.php via template_redirect.
 */
defined('ABSPATH') || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Paiement — <?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body.montant-libre-body {
    min-height: 100vh;
    background: #0f1a14;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #e8f5e9;
    padding: 24px;
}

.ml-card {
    background: #1a2e21;
    border: 1px solid #2d5a3d;
    border-radius: 20px;
    padding: 48px 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 24px 64px rgba(0,0,0,.5);
}

.ml-logo {
    text-align: center;
    margin-bottom: 32px;
}
.ml-logo svg { width: 44px; height: 44px; fill: #52B788; }
.ml-logo span {
    display: block;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: .08em;
    color: #B7E4C7;
    margin-top: 8px;
    text-transform: uppercase;
}

.ml-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    text-align: center;
    margin-bottom: 8px;
}
.ml-subtitle {
    font-size: .9rem;
    color: #74b08a;
    text-align: center;
    margin-bottom: 36px;
}

/* Currency toggle */
.ml-currency-group {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
}
.ml-currency-btn {
    flex: 1;
    padding: 10px;
    border: 2px solid #2d5a3d;
    border-radius: 10px;
    background: transparent;
    color: #74b08a;
    font-size: .95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s;
}
.ml-currency-btn.is-active {
    background: #52B788;
    border-color: #52B788;
    color: #0f1a14;
}
.ml-currency-btn:hover:not(.is-active) {
    border-color: #52B788;
    color: #B7E4C7;
}

/* Amount input */
.ml-amount-wrap {
    position: relative;
    margin-bottom: 10px;
}
.ml-currency-symbol {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.6rem;
    font-weight: 700;
    color: #52B788;
    pointer-events: none;
    line-height: 1;
}
.ml-amount-input {
    width: 100%;
    padding: 18px 18px 18px 42px;
    font-size: 2rem;
    font-weight: 700;
    background: #0f1a14;
    border: 2px solid #2d5a3d;
    border-radius: 12px;
    color: #fff;
    outline: none;
    transition: border-color .2s;
    -moz-appearance: textfield;
}
.ml-amount-input::-webkit-outer-spin-button,
.ml-amount-input::-webkit-inner-spin-button { -webkit-appearance: none; }
.ml-amount-input:focus { border-color: #52B788; }
.ml-amount-input::placeholder { color: #2d5a3d; }

/* Conversion hint */
.ml-conversion {
    font-size: .8rem;
    color: #52B788;
    text-align: right;
    min-height: 18px;
    margin-bottom: 28px;
    transition: opacity .2s;
}
.ml-conversion.hidden { opacity: 0; }

/* Quick amounts */
.ml-quick {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}
.ml-quick-btn {
    padding: 7px 14px;
    background: transparent;
    border: 1px solid #2d5a3d;
    border-radius: 8px;
    color: #74b08a;
    font-size: .85rem;
    cursor: pointer;
    transition: all .15s;
}
.ml-quick-btn:hover {
    background: #2d5a3d;
    color: #B7E4C7;
}

/* Submit */
.ml-submit {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #2D6A4F, #52B788);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: .03em;
    transition: opacity .2s, transform .1s;
}
.ml-submit:hover { opacity: .9; }
.ml-submit:active { transform: scale(.98); }
.ml-submit:disabled { opacity: .5; cursor: not-allowed; }

/* Errors */
.ml-error {
    background: #3d1a1a;
    border: 1px solid #7f3b3b;
    border-radius: 10px;
    padding: 12px 16px;
    color: #f4a8a8;
    font-size: .88rem;
    margin-bottom: 20px;
    display: none;
}
.ml-error.visible { display: block; }

.ml-footer-note {
    text-align: center;
    margin-top: 20px;
    font-size: .78rem;
    color: #3d6b4f;
}
.ml-footer-note a { color: #52B788; text-decoration: none; }

/* WC notices (optional) */
.woocommerce-error, .woocommerce-message {
    background: #1a2e21;
    border-left: 4px solid #52B788;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: .9rem;
    color: #B7E4C7;
    list-style: none;
    width: 100%;
    max-width: 420px;
}
.woocommerce-error { border-left-color: #e57373; color: #f4a8a8; background: #2a1a1a; }
</style>
</head>
<body class="montant-libre-body">

<?php
// Affiche les notices WC éventuelles (ex: montant trop bas)
if ( function_exists('woocommerce_output_all_notices') ) {
    woocommerce_output_all_notices();
}

// Récupère le nonce pour la soumission
$nonce = wp_create_nonce('borea_montant_libre');
$checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
?>

<div class="ml-card">

    <div class="ml-logo">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z"/>
        </svg>
        <span>Boréa CBD</span>
    </div>

    <h1 class="ml-title">Montant libre</h1>
    <p class="ml-subtitle">Entrez le montant souhaité et procédez au paiement</p>

    <div class="ml-error" id="ml-error"></div>

    <form method="POST" id="ml-form" action="">
        <?php wp_nonce_field('borea_montant_libre', '_borea_nonce'); ?>
        <input type="hidden" name="borea_action" value="montant_libre">
        <input type="hidden" name="borea_currency_hidden" id="borea-currency-hidden" value="EUR">

        <!-- Devise -->
        <div class="ml-currency-group" role="group" aria-label="Devise">
            <button type="button" class="ml-currency-btn is-active" data-currency="EUR">€ Euro</button>
            <button type="button" class="ml-currency-btn" data-currency="USD">$ Dollar</button>
        </div>

        <!-- Saisie montant -->
        <div class="ml-amount-wrap">
            <span class="ml-currency-symbol" id="ml-symbol">€</span>
            <input type="number"
                   name="borea_amount"
                   id="ml-amount"
                   class="ml-amount-input"
                   min="1"
                   max="99999"
                   step="0.01"
                   placeholder="0"
                   autocomplete="off"
                   inputmode="decimal"
                   required>
        </div>

        <!-- Indication de conversion USD→EUR -->
        <div class="ml-conversion hidden" id="ml-conversion"></div>

        <!-- Montants rapides -->
        <div class="ml-quick" id="ml-quick">
            <button type="button" class="ml-quick-btn" data-val="20">20</button>
            <button type="button" class="ml-quick-btn" data-val="50">50</button>
            <button type="button" class="ml-quick-btn" data-val="100">100</button>
            <button type="button" class="ml-quick-btn" data-val="200">200</button>
            <button type="button" class="ml-quick-btn" data-val="500">500</button>
        </div>

        <button type="submit" class="ml-submit" id="ml-submit">
            Procéder au paiement →
        </button>
    </form>

    <p class="ml-footer-note">
        Paiement sécurisé SSL · <a href="<?php echo esc_url( home_url('/') ); ?>">Retour à la boutique</a>
    </p>

</div>

<script>
(function () {
    var USD_TO_EUR = 0.92; // taux indicatif
    var currentCurrency = 'EUR';
    var symbolEl  = document.getElementById('ml-symbol');
    var inputEl   = document.getElementById('ml-amount');
    var convEl    = document.getElementById('ml-conversion');
    var hiddenEl  = document.getElementById('borea-currency-hidden');
    var errorEl   = document.getElementById('ml-error');
    var submitBtn = document.getElementById('ml-submit');

    // Currency toggle
    document.querySelectorAll('.ml-currency-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.ml-currency-btn').forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            currentCurrency = btn.dataset.currency;
            hiddenEl.value  = currentCurrency;
            symbolEl.textContent = currentCurrency === 'EUR' ? '€' : '$';

            // Quick amounts labels
            document.querySelectorAll('.ml-quick-btn').forEach(function (qb) {
                qb.textContent = qb.dataset.val;
            });

            updateConversion();
        });
    });

    // Quick amounts
    document.querySelectorAll('.ml-quick-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            inputEl.value = btn.dataset.val;
            updateConversion();
        });
    });

    // Live conversion hint
    inputEl.addEventListener('input', updateConversion);

    function updateConversion() {
        var val = parseFloat(inputEl.value);
        if (currentCurrency === 'USD' && val > 0) {
            var eur = (val * USD_TO_EUR).toFixed(2);
            convEl.textContent = '≈ ' + eur + ' € (taux indicatif)';
            convEl.classList.remove('hidden');
        } else {
            convEl.textContent = '';
            convEl.classList.add('hidden');
        }
    }

    // Form validation
    document.getElementById('ml-form').addEventListener('submit', function (e) {
        var val = parseFloat(inputEl.value);
        hideError();
        if (!val || val < 1) {
            e.preventDefault();
            showError('Veuillez saisir un montant minimum de 1 €.');
            return;
        }
        if (val > 99999) {
            e.preventDefault();
            showError('Le montant maximum est de 99 999 €.');
            return;
        }
        submitBtn.disabled = true;
        submitBtn.textContent = 'Chargement…';
    });

    function showError(msg) {
        errorEl.textContent = msg;
        errorEl.classList.add('visible');
        inputEl.focus();
    }
    function hideError() {
        errorEl.classList.remove('visible');
    }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
