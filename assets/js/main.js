/**
 * GreenPure CBD - Main JavaScript
 * Theme: GreenPure CBD (Premium WordPress Theme)
 * Description: Vanilla JS + jQuery compatible frontend logic.
 *              Covers Age Gate, Sticky Header, Mobile Menu, Search Toggle,
 *              FAQ Accordion, Testimonials Slider, Product Filter,
 *              Countdown Timer, Newsletter Form (AJAX), Back to Top,
 *              Cookie Banner, Scroll Animations, Particle System,
 *              Mini Cart (WooCommerce), Add to Cart Feedback,
 *              Smooth Scroll, and WooCommerce Gallery.
 * Version: 1.0.0
 */

/* =========================================================
   UTILITIES
   ========================================================= */

/**
 * Get a cookie value by name.
 * @param {string} name
 * @returns {string|null}
 */
function getCookie(name) {
    try {
        const match = document.cookie.match(
            new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + '=([^;]*)')
        );
        return match ? decodeURIComponent(match[1]) : null;
    } catch (e) {
        console.error('[GreenPure] getCookie error:', e);
        return null;
    }
}

/**
 * Set a cookie with a given name, value, and expiry in days.
 * @param {string} name
 * @param {string} value
 * @param {number} days
 */
function setCookie(name, value, days) {
    try {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) +
            '; expires=' + expires + '; path=/; SameSite=Lax';
    } catch (e) {
        console.error('[GreenPure] setCookie error:', e);
    }
}

/**
 * Throttle a function call to at most once per `limit` ms.
 * @param {Function} fn
 * @param {number} limit
 * @returns {Function}
 */
function throttle(fn, limit) {
    let lastCall = 0;
    return function (...args) {
        const now = Date.now();
        if (now - lastCall >= limit) {
            lastCall = now;
            fn.apply(this, args);
        }
    };
}

/* =========================================================
   1. AGE GATE
   ========================================================= */
function initAgeGate() {
    try {
        const modal    = document.getElementById('age-gate-modal');
        const btnYes   = document.getElementById('age-gate-yes');
        const btnNo    = document.getElementById('age-gate-no');

        if (!modal) return;

        // Already confirmed → hide immediately
        if (getCookie('greenpure_age_confirmed') === '1') {
            modal.style.display = 'none';
            return;
        }

        modal.style.display = 'flex';
        document.body.classList.add('age-gate-open');

        if (btnYes) {
            btnYes.addEventListener('click', function () {
                setCookie('greenpure_age_confirmed', '1', 30);
                modal.classList.add('age-gate--closing');
                setTimeout(function () {
                    modal.style.display = 'none';
                    document.body.classList.remove('age-gate-open');
                }, 400);
            });
        }

        if (btnNo) {
            btnNo.addEventListener('click', function () {
                // Redirect underage visitors
                window.location.href =
                    (typeof greenpureCBD !== 'undefined' && greenpureCBD.ageGateRedirect)
                        ? greenpureCBD.ageGateRedirect
                        : 'https://www.google.com';
            });
        }
    } catch (e) {
        console.error('[GreenPure] initAgeGate error:', e);
    }
}

/* =========================================================
   2. STICKY HEADER
   ========================================================= */
function initStickyHeader() {
    try {
        const header = document.querySelector('.site-header');
        if (!header) return;

        const SCROLL_THRESHOLD = 80;

        const onScroll = throttle(function () {
            if (window.scrollY > SCROLL_THRESHOLD) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        }, 100);

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll(); // run once on load
    } catch (e) {
        console.error('[GreenPure] initStickyHeader error:', e);
    }
}

/* =========================================================
   3. MOBILE MENU
   ========================================================= */
function initMobileMenu() {
    try {
        const burger  = document.querySelector('.burger-menu');
        const nav     = document.querySelector('.mobile-nav');
        const overlay = document.querySelector('.mobile-nav__overlay');
        const closeBtn = document.querySelector('.mobile-nav__close');

        if (!burger || !nav) return;

        function openMenu() {
            nav.classList.add('is-open');
            document.body.classList.add('menu-open');
            burger.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            nav.classList.remove('is-open');
            document.body.classList.remove('menu-open');
            burger.setAttribute('aria-expanded', 'false');
        }

        burger.addEventListener('click', function () {
            nav.classList.contains('is-open') ? closeMenu() : openMenu();
        });

        if (overlay) overlay.addEventListener('click', closeMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) closeMenu();
        });
    } catch (e) {
        console.error('[GreenPure] initMobileMenu error:', e);
    }
}

/* =========================================================
   4. SEARCH TOGGLE
   ========================================================= */
function initSearchToggle() {
    try {
        const searchToggle = document.querySelector('.search-toggle');
        const searchBar    = document.querySelector('.header-search');
        const searchInput  = document.querySelector('.header-search__input');
        const searchClose  = document.querySelector('.header-search__close');

        if (!searchToggle || !searchBar) return;

        function openSearch() {
            searchBar.classList.add('is-visible');
            searchToggle.setAttribute('aria-expanded', 'true');
            if (searchInput) setTimeout(function () { searchInput.focus(); }, 50);
        }

        function closeSearch() {
            searchBar.classList.remove('is-visible');
            searchToggle.setAttribute('aria-expanded', 'false');
        }

        searchToggle.addEventListener('click', function () {
            searchBar.classList.contains('is-visible') ? closeSearch() : openSearch();
        });

        if (searchClose) searchClose.addEventListener('click', closeSearch);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSearch();
        });

        // Close if click outside
        document.addEventListener('click', function (e) {
            if (!searchBar.contains(e.target) && !searchToggle.contains(e.target)) {
                closeSearch();
            }
        });
    } catch (e) {
        console.error('[GreenPure] initSearchToggle error:', e);
    }
}

/* =========================================================
   5. FAQ ACCORDION
   ========================================================= */
function initFaqAccordion() {
    try {
        const items = document.querySelectorAll('.faq-item');
        if (!items.length) return;

        items.forEach(function (item) {
            const trigger = item.querySelector('.faq-item__question');
            const answer  = item.querySelector('.faq-item__answer');

            if (!trigger || !answer) return;

            // Set initial state
            answer.style.overflow = 'hidden';
            answer.style.height   = '0px';
            answer.style.transition = 'height 0.35s ease';
            trigger.setAttribute('aria-expanded', 'false');

            trigger.addEventListener('click', function () {
                const isOpen = item.classList.contains('is-open');

                // Close all others
                items.forEach(function (other) {
                    if (other !== item && other.classList.contains('is-open')) {
                        other.classList.remove('is-open');
                        const otherAnswer = other.querySelector('.faq-item__answer');
                        const otherTrigger = other.querySelector('.faq-item__question');
                        if (otherAnswer) otherAnswer.style.height = '0px';
                        if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                    }
                });

                if (isOpen) {
                    item.classList.remove('is-open');
                    answer.style.height = '0px';
                    trigger.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('is-open');
                    answer.style.height = answer.scrollHeight + 'px';
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });
    } catch (e) {
        console.error('[GreenPure] initFaqAccordion error:', e);
    }
}

/* =========================================================
   6. TESTIMONIALS SLIDER
   ========================================================= */
function initTestimonialsSlider() {
    try {
        const slider   = document.querySelector('.testimonials-slider');
        if (!slider) return;

        const track    = slider.querySelector('.testimonials-slider__track');
        const slides   = slider.querySelectorAll('.testimonial');
        const prevBtn  = slider.querySelector('.slider-prev');
        const nextBtn  = slider.querySelector('.slider-next');
        const dotsWrap = slider.querySelector('.slider-dots');

        if (!track || slides.length === 0) return;

        let current   = 0;
        let autoTimer = null;
        let touchStartX = 0;
        let touchEndX   = 0;

        // Build dots
        const dots = [];
        if (dotsWrap) {
            slides.forEach(function (_, i) {
                const dot = document.createElement('button');
                dot.className = 'slider-dot' + (i === 0 ? ' is-active' : '');
                dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                dot.addEventListener('click', function () { goTo(i); });
                dotsWrap.appendChild(dot);
                dots.push(dot);
            });
        }

        function updateDots() {
            dots.forEach(function (d, i) {
                d.classList.toggle('is-active', i === current);
            });
        }

        function goTo(index) {
            current = (index + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            updateDots();
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }

        if (nextBtn) nextBtn.addEventListener('click', next);
        if (prevBtn) prevBtn.addEventListener('click', prev);

        function startAuto() {
            autoTimer = setInterval(next, 5000);
        }
        function stopAuto() {
            clearInterval(autoTimer);
        }

        startAuto();
        slider.addEventListener('mouseenter', stopAuto);
        slider.addEventListener('mouseleave', startAuto);

        // Touch / Swipe support
        track.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        track.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                diff > 0 ? next() : prev();
            }
        }, { passive: true });
    } catch (e) {
        console.error('[GreenPure] initTestimonialsSlider error:', e);
    }
}

/* =========================================================
   7. PRODUCT FILTER
   ========================================================= */
function initProductFilter() {
    try {
        const filterBtns = document.querySelectorAll('[data-filter]');
        const products   = document.querySelectorAll('[data-category]');

        if (!filterBtns.length || !products.length) return;

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const filter = btn.getAttribute('data-filter');

                // Active state
                filterBtns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');

                products.forEach(function (card) {
                    const category = card.getAttribute('data-category');
                    const show = filter === 'all' || category === filter;

                    if (show) {
                        card.style.opacity = '0';
                        card.style.display = '';
                        // Trigger reflow then fade in
                        void card.offsetWidth;
                        card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    } else {
                        card.style.transition = 'opacity 0.3s ease';
                        card.style.opacity = '0';
                        setTimeout(function () {
                            if (card.style.opacity === '0') card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    } catch (e) {
        console.error('[GreenPure] initProductFilter error:', e);
    }
}

/* =========================================================
   8. COUNTDOWN TIMER
   ========================================================= */
function initCountdownTimer() {
    try {
        const elH = document.getElementById('timer-h');
        const elM = document.getElementById('timer-m');
        const elS = document.getElementById('timer-s');

        if (!elH && !elM && !elS) return;

        function pad(n) { return String(n).padStart(2, '0'); }

        function getEndOfDay() {
            const now = new Date();
            return new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59, 0);
        }

        function tick() {
            const now  = Date.now();
            const end  = getEndOfDay().getTime();
            let   diff = Math.max(0, Math.floor((end - now) / 1000));

            const h = Math.floor(diff / 3600);
            diff   -= h * 3600;
            const m = Math.floor(diff / 60);
            const s = diff - m * 60;

            if (elH) elH.textContent = pad(h);
            if (elM) elM.textContent = pad(m);
            if (elS) elS.textContent = pad(s);
        }

        tick();
        setInterval(tick, 1000);
    } catch (e) {
        console.error('[GreenPure] initCountdownTimer error:', e);
    }
}

/* =========================================================
   9. NEWSLETTER FORM (AJAX)  — jQuery section
   ========================================================= */
function initNewsletterForm($) {
    try {
        const $form = $('#greenpure-newsletter-form');
        if (!$form.length) return;

        $form.on('submit', function (e) {
            e.preventDefault();

            const $btn     = $form.find('[type="submit"]');
            const $msg     = $form.find('.newsletter-message');
            const email    = $form.find('input[name="email"]').val().trim();
            const nonce    = $form.find('input[name="newsletter_nonce"]').val() || '';

            if (!email) {
                showMsg($msg, 'Veuillez entrer votre adresse email.', 'error');
                return;
            }

            $btn.prop('disabled', true).addClass('is-loading');
            $msg.hide().removeClass('success error');

            $.ajax({
                url:    (typeof greenpureCBD !== 'undefined') ? greenpureCBD.ajaxUrl : '/wp-admin/admin-ajax.php',
                method: 'POST',
                data:   {
                    action: 'greenpure_newsletter_subscribe',
                    email:  email,
                    nonce:  nonce
                },
                success: function (res) {
                    if (res && res.success) {
                        showMsg($msg, res.data && res.data.message
                            ? res.data.message
                            : 'Merci pour votre inscription !', 'success');
                        $form[0].reset();
                    } else {
                        showMsg($msg, res && res.data && res.data.message
                            ? res.data.message
                            : 'Une erreur est survenue. Réessayez.', 'error');
                    }
                },
                error: function () {
                    showMsg($msg, 'Erreur réseau. Veuillez réessayer.', 'error');
                },
                complete: function () {
                    $btn.prop('disabled', false).removeClass('is-loading');
                }
            });
        });

        function showMsg($el, text, type) {
            $el.text(text).addClass(type).fadeIn(300);
            setTimeout(function () { $el.fadeOut(400); }, 5000);
        }
    } catch (e) {
        console.error('[GreenPure] initNewsletterForm error:', e);
    }
}

/* =========================================================
   10. BACK TO TOP
   ========================================================= */
function initBackToTop() {
    try {
        const btn = document.getElementById('back-to-top');
        if (!btn) return;

        const SHOW_AFTER = 400;

        const onScroll = throttle(function () {
            btn.classList.toggle('is-visible', window.scrollY > SHOW_AFTER);
        }, 150);

        window.addEventListener('scroll', onScroll, { passive: true });

        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    } catch (e) {
        console.error('[GreenPure] initBackToTop error:', e);
    }
}

/* =========================================================
   11. COOKIE BANNER
   ========================================================= */
function initCookieBanner() {
    try {
        const banner     = document.getElementById('cookie-banner');
        const btnAccept  = document.getElementById('cookie-accept');
        const btnDecline = document.getElementById('cookie-decline');

        if (!banner) return;
        if (getCookie('greenpure_cookie_consent')) {
            banner.style.display = 'none';
            return;
        }

        banner.style.display = '';
        banner.setAttribute('aria-hidden', 'false');

        function dismissBanner(value) {
            setCookie('greenpure_cookie_consent', value, 365);
            banner.classList.add('cookie-banner--hiding');
            setTimeout(function () { banner.style.display = 'none'; }, 500);
        }

        if (btnAccept)  btnAccept.addEventListener('click',  function () { dismissBanner('accepted'); });
        if (btnDecline) btnDecline.addEventListener('click', function () { dismissBanner('declined'); });
    } catch (e) {
        console.error('[GreenPure] initCookieBanner error:', e);
    }
}

/* =========================================================
   12. SCROLL ANIMATIONS (IntersectionObserver)
   ========================================================= */
function initScrollAnimations() {
    try {
        const elements = document.querySelectorAll('[data-aos]');
        if (!elements.length) return;

        if (!('IntersectionObserver' in window)) {
            // Fallback: show everything immediately
            elements.forEach(function (el) { el.classList.add('aos-animated'); });
            return;
        }

        elements.forEach(function (el) {
            el.classList.add('aos-init');
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const el    = entry.target;
                    const delay = parseInt(el.getAttribute('data-aos-delay') || '0', 10);
                    setTimeout(function () {
                        el.classList.add('aos-animated');
                    }, delay);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.15 });

        elements.forEach(function (el) { observer.observe(el); });
    } catch (e) {
        console.error('[GreenPure] initScrollAnimations error:', e);
    }
}

/* =========================================================
   13. PARTICLE SYSTEM
   ========================================================= */
function initParticles() {
    try {
        const container = document.getElementById('particles');
        if (!container) return;

        const PARTICLE_COUNT = 40;
        const particles = [];

        function rand(min, max) { return Math.random() * (max - min) + min; }

        for (let i = 0; i < PARTICLE_COUNT; i++) {
            const p = document.createElement('span');
            p.className = 'particle';

            const size = rand(4, 12);
            const x    = rand(0, 100);
            const y    = rand(0, 100);
            const dur  = rand(8, 20);
            const del  = rand(0, 10);
            const op   = rand(0.15, 0.5);

            p.style.cssText =
                'position:absolute;' +
                'width:'   + size + 'px;' +
                'height:'  + size + 'px;' +
                'left:'    + x + '%;' +
                'top:'     + y + '%;' +
                'opacity:' + op + ';' +
                'border-radius:50%;' +
                'background:currentColor;' +
                'pointer-events:none;' +
                'animation:particleFloat ' + dur + 's ' + del + 's ease-in-out infinite;';

            container.appendChild(p);
            particles.push(p);
        }

        // Inject keyframes if not already present
        if (!document.getElementById('particle-keyframes')) {
            const style = document.createElement('style');
            style.id = 'particle-keyframes';
            style.textContent =
                '@keyframes particleFloat {' +
                '  0%,100% { transform: translateY(0) scale(1); }' +
                '  33%      { transform: translateY(-30px) scale(1.1); }' +
                '  66%      { transform: translateY(20px) scale(0.9); }' +
                '}';
            document.head.appendChild(style);
        }
    } catch (e) {
        console.error('[GreenPure] initParticles error:', e);
    }
}

/* =========================================================
   14. MINI CART — WooCommerce Fragments  (jQuery)
   ========================================================= */
function initMiniCart($) {
    try {
        // WooCommerce fires this event after cart fragments update
        $(document.body).on('wc_fragments_refreshed wc_fragments_loaded', function () {
            const count = $('.cart-count').text();
            if (parseInt(count, 10) > 0) {
                $('.cart-icon-wrap').addClass('has-items');
            } else {
                $('.cart-icon-wrap').removeClass('has-items');
            }
        });

        // Mini cart toggle
        const $cartToggle = $('.mini-cart-toggle');
        const $miniCart   = $('.mini-cart-dropdown');

        if ($cartToggle.length && $miniCart.length) {
            $cartToggle.on('click', function (e) {
                e.preventDefault();
                $miniCart.toggleClass('is-open');
                $cartToggle.attr('aria-expanded', $miniCart.hasClass('is-open') ? 'true' : 'false');
            });

            $(document).on('click', function (e) {
                if (!$miniCart.is(e.target) && !$miniCart.has(e.target).length &&
                    !$cartToggle.is(e.target) && !$cartToggle.has(e.target).length) {
                    $miniCart.removeClass('is-open');
                    $cartToggle.attr('aria-expanded', 'false');
                }
            });
        }
    } catch (e) {
        console.error('[GreenPure] initMiniCart error:', e);
    }
}

/* =========================================================
   15. ADD TO CART FEEDBACK  (jQuery)
   ========================================================= */
function initAddToCartFeedback($) {
    try {
        $(document.body).on('added_to_cart', function (e, fragments, cartHash, $btn) {
            if (!$btn || !$btn.length) return;

            const originalText = $btn.text();
            $btn.text('Ajouté !').addClass('added-feedback');

            setTimeout(function () {
                $btn.text(originalText).removeClass('added-feedback');
            }, 2500);
        });
    } catch (e) {
        console.error('[GreenPure] initAddToCartFeedback error:', e);
    }
}

/* =========================================================
   16. SMOOTH SCROLL
   ========================================================= */
function initSmoothScroll() {
    try {
        const anchors = document.querySelectorAll('a[href^="#"]');
        if (!anchors.length) return;

        anchors.forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                const href   = anchor.getAttribute('href');
                if (!href || href === '#') return;

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();

                const headerH = (document.querySelector('.site-header') || {}).offsetHeight || 0;
                const top     = target.getBoundingClientRect().top + window.scrollY - headerH - 16;

                window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });

                // Update URL hash without jump
                if (history.pushState) {
                    history.pushState(null, null, href);
                }
            });
        });
    } catch (e) {
        console.error('[GreenPure] initSmoothScroll error:', e);
    }
}

/* =========================================================
   17. WOOCOMMERCE GALLERY — Thumbnail Switching
   ========================================================= */
function initWooCommerceGallery() {
    try {
        const mainImage = document.querySelector('.woocommerce-product-gallery__image img');
        const thumbs    = document.querySelectorAll('.woocommerce-product-gallery__image:not(:first-child) img, .flex-control-thumbs img');

        if (!mainImage || !thumbs.length) return;

        let originalSrc   = mainImage.src;
        let originalSrcSet = mainImage.srcset || '';

        thumbs.forEach(function (thumb) {
            thumb.style.cursor = 'pointer';
            thumb.addEventListener('click', function () {
                mainImage.src    = thumb.getAttribute('data-large_image') || thumb.src;
                mainImage.srcset = '';
                thumbs.forEach(function (t) { t.classList.remove('active-thumb'); });
                thumb.classList.add('active-thumb');
            });
        });

        // Reset on main image click
        mainImage.addEventListener('click', function () {
            mainImage.src    = originalSrc;
            mainImage.srcset = originalSrcSet;
            thumbs.forEach(function (t) { t.classList.remove('active-thumb'); });
        });
    } catch (e) {
        console.error('[GreenPure] initWooCommerceGallery error:', e);
    }
}

/* =========================================================
   BOOTSTRAP — DOM READY
   ========================================================= */

// Vanilla JS initializations (no jQuery dependency)
document.addEventListener('DOMContentLoaded', function () {
    initAgeGate();
    initStickyHeader();
    initMobileMenu();
    initSearchToggle();
    initFaqAccordion();
    initTestimonialsSlider();
    initProductFilter();
    initCountdownTimer();
    initBackToTop();
    initCookieBanner();
    initScrollAnimations();
    initParticles();
    initSmoothScroll();
    initWooCommerceGallery();
});

// jQuery-dependent initializations
/* global jQuery */
(function ($) {
    'use strict';

    $(document).ready(function () {
        initNewsletterForm($);
        initMiniCart($);
        initAddToCartFeedback($);
    });

}(typeof jQuery !== 'undefined' ? jQuery : { fn: {}, extend: function () {} }));
