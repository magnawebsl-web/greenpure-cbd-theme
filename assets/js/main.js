/**
 * GreenPure CBD — main.js v2.1
 * FIXED: sélecteurs alignés avec le HTML, variable AJAX corrigée,
 *        tabs produit, qty +/-, notices, sidebar mobile, langue
 */

/* === UTILITIES === */
function getCookie(name) {
    try {
        const m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\/+^])/g,'\\$1') + '=([^;]*)'));
        return m ? decodeURIComponent(m[1]) : null;
    } catch(e){ return null; }
}
function setCookie(name, value, days) {
    try {
        const e = new Date(Date.now() + days*864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + e + '; path=/; SameSite=Lax';
    } catch(e){}
}
function throttle(fn, limit) {
    let last = 0;
    return function(...args){ const now=Date.now(); if(now-last>=limit){ last=now; fn.apply(this,args); } };
}

/* === 1. AGE GATE — id correct : #age-gate === */
function initAgeGate() {
    try {
        const modal  = document.getElementById('age-gate');
        const btnYes = document.getElementById('age-gate-yes');
        const btnNo  = document.getElementById('age-gate-no');
        if (!modal) return;
        if (getCookie('greenpure_age') === '1') { modal.style.display='none'; return; }
        modal.style.display = 'flex';
        document.body.classList.add('age-gate-open');
        btnYes && btnYes.addEventListener('click', function(){
            setCookie('greenpure_age','1',30);
            modal.classList.add('age-gate--closing');
            setTimeout(function(){ modal.style.display='none'; document.body.classList.remove('age-gate-open'); }, 400);
        });
        btnNo && btnNo.addEventListener('click', function(){
            window.location.href = (typeof greenpureData!=='undefined' && greenpureData.ageGateRedirect) ? greenpureData.ageGateRedirect : 'https://www.google.com';
        });
    } catch(e){ console.error('[GP] AgeGate:',e); }
}

/* === 2. STICKY HEADER === */
function initStickyHeader() {
    try {
        const h = document.querySelector('.site-header');
        if (!h) return;
        const fn = throttle(()=>h.classList.toggle('is-scrolled',window.scrollY>80),100);
        window.addEventListener('scroll',fn,{passive:true}); fn();
    } catch(e){ console.error('[GP] StickyHeader:',e); }
}

/* === 3. MOBILE MENU — sélecteurs HTML réels : .burger, .mobile-menu, .mobile-menu-overlay === */
function initMobileMenu() {
    try {
        const burger  = document.querySelector('.burger');
        const nav     = document.querySelector('.mobile-menu');
        const overlay = document.querySelector('.mobile-menu-overlay');
        const close   = document.querySelector('.mobile-menu__close');
        if (!burger || !nav) return;
        const open  = ()=>{ nav.classList.add('is-open'); overlay&&overlay.classList.add('is-visible'); document.body.classList.add('menu-open'); burger.setAttribute('aria-expanded','true'); };
        const close2= ()=>{ nav.classList.remove('is-open'); overlay&&overlay.classList.remove('is-visible'); document.body.classList.remove('menu-open'); burger.setAttribute('aria-expanded','false'); };
        burger.addEventListener('click',()=>nav.classList.contains('is-open')?close2():open());
        overlay&&overlay.addEventListener('click',close2);
        close&&close.addEventListener('click',close2);
        document.addEventListener('keydown',e=>e.key==='Escape'&&close2());
    } catch(e){ console.error('[GP] MobileMenu:',e); }
}

/* === 4. SEARCH — sélecteurs HTML réels : .js-search-toggle, .js-search-bar === */
function initSearchToggle() {
    try {
        const toggle = document.querySelector('.js-search-toggle');
        const bar    = document.querySelector('.js-search-bar');
        if (!toggle || !bar) return;
        const open  = ()=>{ bar.classList.add('is-visible'); bar.setAttribute('aria-hidden','false'); const i=bar.querySelector('input'); i&&setTimeout(()=>i.focus(),50); };
        const close = ()=>{ bar.classList.remove('is-visible'); bar.setAttribute('aria-hidden','true'); };
        toggle.addEventListener('click',()=>bar.classList.contains('is-visible')?close():open());
        document.addEventListener('keydown',e=>e.key==='Escape'&&close());
        document.addEventListener('click',e=>{ if(!bar.contains(e.target)&&!toggle.contains(e.target)) close(); });
    } catch(e){ console.error('[GP] Search:',e); }
}

/* === 5. PRODUCT TABS — NOUVEAU === */
function initProductTabs() {
    try {
        const btns   = document.querySelectorAll('.product-tabs__btn');
        const panels = document.querySelectorAll('.product-tabs__panel');
        if (!btns.length) return;
        btns.forEach(function(btn){
            btn.addEventListener('click',function(){
                const target = btn.getAttribute('data-tab');
                btns.forEach(b=>{ b.classList.remove('is-active'); b.setAttribute('aria-selected','false'); });
                panels.forEach(p=>p.classList.remove('is-active'));
                btn.classList.add('is-active');
                btn.setAttribute('aria-selected','true');
                const panel = document.getElementById('tab-'+target);
                if (panel) panel.classList.add('is-active');
            });
        });
    } catch(e){ console.error('[GP] ProductTabs:',e); }
}

/* === 6. QUANTITY +/− — NOUVEAU === */
function initQtyButtons() {
    try {
        document.addEventListener('click',function(e){
            const btn = e.target.closest('.qty-btn--plus,.qty-btn--minus');
            if (!btn) return;
            const wrap  = btn.closest('.qty-selector');
            if (!wrap) return;
            const input = wrap.querySelector('input.qty');
            if (!input) return;
            const step = parseFloat(input.step)||1;
            const min  = parseFloat(input.min)||0;
            const max  = input.max ? parseFloat(input.max) : Infinity;
            let val    = parseFloat(input.value)||0;
            if (btn.classList.contains('qty-btn--plus')) val = Math.min(val+step, max);
            else val = Math.max(val-step, min);
            input.value = val;
            input.dispatchEvent(new Event('change',{bubbles:true}));
        });
    } catch(e){ console.error('[GP] QtyButtons:',e); }
}

/* === 7. NOTICES CLOSE — NOUVEAU === */
function initNoticesClose() {
    try {
        document.addEventListener('click',function(e){
            const btn = e.target.closest('.woo-notice__close');
            if (!btn) return;
            const notice = btn.closest('.woo-notice');
            if (notice){
                notice.style.cssText += ';opacity:0;transform:translateY(-8px);transition:opacity .3s,transform .3s';
                setTimeout(()=>notice.remove(),320);
            }
        });
    } catch(e){ console.error('[GP] NoticesClose:',e); }
}

/* === 8. FAQ ACCORDION === */
function initFaqAccordion() {
    try {
        const items = document.querySelectorAll('.faq-item');
        if (!items.length) return;
        items.forEach(function(item){
            const trigger = item.querySelector('.faq-item__question');
            const answer  = item.querySelector('.faq-item__answer');
            if (!trigger||!answer) return;
            answer.style.overflow='hidden'; answer.style.height='0px'; answer.style.transition='height .35s ease';
            trigger.setAttribute('aria-expanded','false');
            trigger.addEventListener('click',function(){
                const isOpen = item.classList.contains('is-open');
                items.forEach(function(o){ if(o!==item&&o.classList.contains('is-open')){ o.classList.remove('is-open'); const a=o.querySelector('.faq-item__answer'); const t=o.querySelector('.faq-item__question'); if(a)a.style.height='0px'; if(t)t.setAttribute('aria-expanded','false'); } });
                if(isOpen){ item.classList.remove('is-open'); answer.style.height='0px'; trigger.setAttribute('aria-expanded','false'); }
                else{ item.classList.add('is-open'); answer.style.height=answer.scrollHeight+'px'; trigger.setAttribute('aria-expanded','true'); }
            });
        });
    } catch(e){ console.error('[GP] FAQ:',e); }
}

/* === 9. TESTIMONIALS SLIDER === */
function initTestimonialsSlider() {
    try {
        const slider = document.querySelector('.testimonials-slider');
        if (!slider) return;
        const track = slider.querySelector('.testimonials-slider__track');
        if (!track) return;
        // Supporte .testimonial ET .testimonial-card comme slides
        const slides = track.querySelectorAll('.testimonial, .testimonial-card');
        if (!slides.length) return;
        const prevBtn = document.querySelector('.slider-prev, .js-prev');
        const nextBtn = document.querySelector('.slider-next, .js-next');
        const dotsWrap = document.querySelector('.slider-dots, .js-dots');
        let cur=0, timer=null, dots=[], txStart=0;
        // Assurer que le track est flex
        track.style.cssText += 'display:flex;overflow:hidden;';
        slides.forEach(s => { s.style.minWidth='100%'; s.style.flexShrink='0'; });
        if(dotsWrap){ slides.forEach((_,i)=>{ const d=document.createElement('button'); d.className='slider-dot'+(i===0?' is-active':''); d.setAttribute('aria-label','Avis '+(i+1)); d.addEventListener('click',()=>goTo(i)); dotsWrap.appendChild(d); dots.push(d); }); }
        function goTo(i){
            cur=(i+slides.length)%slides.length;
            track.style.transform='translateX(-'+(cur*100)+'%)';
            track.style.transition='transform 0.5s cubic-bezier(0.4,0,0.2,1)';
            dots.forEach((d,j)=>d.classList.toggle('is-active',j===cur));
        }
        const startAuto=()=>{ stopAuto(); timer=setInterval(()=>goTo(cur+1),5500); };
        const stopAuto=()=>clearInterval(timer);
        nextBtn&&nextBtn.addEventListener('click',()=>{ stopAuto(); goTo(cur+1); startAuto(); });
        prevBtn&&prevBtn.addEventListener('click',()=>{ stopAuto(); goTo(cur-1); startAuto(); });
        startAuto();
        slider.addEventListener('mouseenter',stopAuto);
        slider.addEventListener('mouseleave',startAuto);
        // Swipe tactile
        track.addEventListener('touchstart',e=>{ txStart=e.changedTouches[0].screenX; stopAuto(); },{passive:true});
        track.addEventListener('touchend',e=>{ const dx=txStart-e.changedTouches[0].screenX; if(Math.abs(dx)>50){ goTo(cur+(dx>0?1:-1)); } startAuto(); },{passive:true});
    } catch(e){ console.error('[GP] Slider:',e); }
}

/* === 10. PRODUCT FILTER === */
function initProductFilter() {
    try {
        const btns = document.querySelectorAll('[data-filter]');
        const cards = document.querySelectorAll('[data-category]');
        if(!btns.length||!cards.length) return;
        btns.forEach(function(btn){
            btn.addEventListener('click',function(){
                const f = btn.getAttribute('data-filter');
                btns.forEach(b=>b.classList.remove('is-active')); btn.classList.add('is-active');
                cards.forEach(function(card){
                    const show = f==='all'||(card.getAttribute('data-category')||'').split(' ').includes(f);
                    if(show){ card.style.display=''; requestAnimationFrame(()=>{ card.style.opacity='1'; card.style.transform='scale(1)'; }); }
                    else{ card.style.opacity='0'; card.style.transform='scale(0.95)'; setTimeout(()=>{ if(card.style.opacity==='0') card.style.display='none'; },300); }
                });
            });
        });
    } catch(e){ console.error('[GP] Filter:',e); }
}

/* === 11. COUNTDOWN === */
function initCountdownTimer() {
    try {
        const h=document.getElementById('timer-h'), m=document.getElementById('timer-m'), s=document.getElementById('timer-s');
        if(!h&&!m&&!s) return;
        const pad=n=>String(n).padStart(2,'0');
        function tick(){ let d=Math.max(0,Math.floor((new Date(new Date().setHours(23,59,59,0))-Date.now())/1000)); const hv=Math.floor(d/3600); d-=hv*3600; const mv=Math.floor(d/60); const sv=d-mv*60; if(h)h.textContent=pad(hv); if(m)m.textContent=pad(mv); if(s)s.textContent=pad(sv); }
        tick(); setInterval(tick,1000);
    } catch(e){ console.error('[GP] Countdown:',e); }
}

/* === 12. BACK TO TOP === */
function initBackToTop() {
    try {
        // Supporte #back-to-top ET .js-back-to-top
        const btn = document.getElementById('back-to-top') || document.querySelector('.js-back-to-top');
        if(!btn) return;
        window.addEventListener('scroll',throttle(()=>btn.classList.toggle('is-visible',window.scrollY>400),150),{passive:true});
        btn.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));
    } catch(e){ console.error('[GP] BackToTop:',e); }
}

/* === 13. COOKIE BANNER === */
function initCookieBanner() {
    try {
        const banner = document.getElementById('cookie-banner');
        if(!banner) return;
        if(getCookie('greenpure_cookie')){ banner.hidden=true; return; }
        banner.hidden = false; // enlever l'attribut hidden
        // Supporte #cookie-accept / .js-cookie-accept
        const a = document.getElementById('cookie-accept') || document.querySelector('.js-cookie-accept');
        const d = document.getElementById('cookie-decline') || document.querySelector('.js-cookie-decline');
        const dismiss = v => {
            setCookie('greenpure_cookie', v, 365);
            banner.classList.add('cookie-banner--hiding');
            setTimeout(() => { banner.hidden = true; }, 500);
        };
        a && a.addEventListener('click', () => dismiss('accepted'));
        d && d.addEventListener('click', () => dismiss('declined'));
    } catch(e){ console.error('[GP] Cookie:',e); }
}

/* === 14. SCROLL ANIMATIONS === */
function initScrollAnimations() {
    try {
        const els = document.querySelectorAll('[data-aos]');
        if(!els.length) return;
        if(!('IntersectionObserver' in window)){ els.forEach(el=>el.classList.add('aos-animated')); return; }
        els.forEach(el=>el.classList.add('aos-init'));
        const obs = new IntersectionObserver(function(entries){ entries.forEach(function(entry){ if(entry.isIntersecting){ const delay=parseInt(entry.target.getAttribute('data-aos-delay')||'0',10); setTimeout(()=>entry.target.classList.add('aos-animated'),delay); obs.unobserve(entry.target); } }); },{threshold:0.12});
        els.forEach(el=>obs.observe(el));
    } catch(e){ console.error('[GP] ScrollAnim:',e); }
}

/* === 15. PARTICLES === */
function initParticles() {
    try {
        const c = document.getElementById('particles');
        if(!c) return;
        const f = document.createDocumentFragment();
        for(let i=0;i<30;i++){ const p=document.createElement('span'); const sz=Math.random()*8+4; p.className='particle'; p.style.cssText=`position:absolute;width:${sz}px;height:${sz}px;left:${Math.random()*100}%;top:${Math.random()*100}%;opacity:${(Math.random()*.35+.1).toFixed(2)};border-radius:50%;background:currentColor;pointer-events:none;animation:particleFloat ${(Math.random()*12+8).toFixed(1)}s ${(Math.random()*8).toFixed(1)}s ease-in-out infinite`; f.appendChild(p); }
        c.appendChild(f);
        if(!document.getElementById('pkf')){ const s=document.createElement('style'); s.id='pkf'; s.textContent='@keyframes particleFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-28px) scale(1.08)}}'; document.head.appendChild(s); }
    } catch(e){ console.error('[GP] Particles:',e); }
}

/* === 16. SMOOTH SCROLL === */
function initSmoothScroll() {
    try {
        document.addEventListener('click',function(e){
            const a = e.target.closest('a[href^="#"]');
            if(!a) return;
            const href=a.getAttribute('href');
            if(!href||href==='#') return;
            const target=document.querySelector(href);
            if(!target) return;
            e.preventDefault();
            const hh=(document.querySelector('.site-header')||{}).offsetHeight||0;
            window.scrollTo({top:target.getBoundingClientRect().top+window.scrollY-hh-16,behavior:'smooth'});
            if(history.pushState) history.pushState(null,null,href);
        });
    } catch(e){ console.error('[GP] SmoothScroll:',e); }
}

/* === 17. WOO GALLERY === */
function initWooGallery() {
    try {
        const main = document.querySelector('.woocommerce-product-gallery__image:first-child img');
        const thumbs = document.querySelectorAll('.flex-control-thumbs img');
        if(!main||!thumbs.length) return;
        thumbs.forEach(function(t){ t.style.cursor='pointer'; t.addEventListener('click',function(){ main.src=t.getAttribute('data-large_image')||t.src; main.srcset=''; thumbs.forEach(x=>x.classList.remove('active-thumb')); t.classList.add('active-thumb'); }); });
    } catch(e){ console.error('[GP] WooGallery:',e); }
}

/* === 18. LANGUE — switcher (géré par language-detector.php inline JS) === */
function initLangSwitcher() {
    try {
        // Le switcher dropdown est géré par language-detector.php
        // Fallback pour un <select id="lang-switcher"> si présent
        const sw = document.getElementById('lang-switcher');
        if(!sw) return;
        const saved = getCookie('greenpure_lang');
        if(saved) sw.value = saved;
        sw.addEventListener('change',function(){ setCookie('greenpure_lang',sw.value,365); window.location.reload(); });
    } catch(e){ console.error('[GP] LangSwitcher:',e); }
}

/* === 19. STICKY TOPBAR + HEADER === */
function initStickyBehavior() {
    try {
        const header = document.querySelector('.site-header');
        if(!header) return;
        const fn = throttle(function(){
            const scrolled = window.scrollY > 60;
            header.classList.toggle('is-scrolled', scrolled);
        }, 100);
        window.addEventListener('scroll', fn, {passive: true});
        fn();
    } catch(e){ console.error('[GP] StickyBehavior:',e); }
}

/* === 20. PRODUCT FILTER ANIMATION === */
function initProductFilterAnim() {
    try {
        const btns  = document.querySelectorAll('[data-filter]');
        const cards = document.querySelectorAll('[data-category]');
        if(!btns.length || !cards.length) return;
        btns.forEach(function(btn){
            btn.addEventListener('click',function(){
                const f = btn.getAttribute('data-filter');
                btns.forEach(b => { b.classList.remove('is-active', 'active'); });
                btn.classList.add('is-active');
                cards.forEach(function(card){
                    const cats = (card.getAttribute('data-category') || '').split(/\s+/);
                    const show = f === 'all' || cats.includes(f);
                    if(show){
                        card.style.opacity = '0';
                        card.style.display = '';
                        requestAnimationFrame(function(){
                            requestAnimationFrame(function(){
                                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                                card.style.opacity = '1';
                                card.style.transform = 'scale(1)';
                            });
                        });
                    } else {
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(function(){ if(card.style.opacity === '0') card.style.display = 'none'; }, 320);
                    }
                });
            });
        });
    } catch(e){ console.error('[GP] FilterAnim:',e); }
}

/* === jQuery — Mini Cart, Add to Cart, Newsletter === */
(function($){
    'use strict';
    function initMiniCart(){
        try{
            $(document.body).on('wc_fragments_refreshed wc_fragments_loaded',function(){ const n=parseInt($('.cart-count').first().text(),10)||0; $('.cart-count').text(n); });
            const $t=$('.mini-cart-toggle,.header-btn--cart'), $d=$('.mini-cart-dropdown');
            if($t.length&&$d.length){
                $t.on('click',function(e){ e.preventDefault(); $d.toggleClass('is-open'); });
                $(document).on('click',function(e){ if(!$(e.target).closest('.mini-cart-toggle,.header-btn--cart,.mini-cart-dropdown').length) $d.removeClass('is-open'); });
            }
        }catch(e){ console.error('[GP] MiniCart:',e); }
    }
    function initAddToCart(){
        try{
            $(document.body).on('added_to_cart',function(e,f,h,$btn){
                if(!$btn||!$btn.length) return;
                const orig=$btn.html();
                $btn.html('✓ Ajouté !').addClass('added-feedback');
                setTimeout(()=>$btn.html(orig).removeClass('added-feedback'),2500);
            });
        }catch(e){ console.error('[GP] AddToCart:',e); }
    }
    function initNewsletter(){
        try{
            const $form=$('#greenpure-newsletter-form');
            if(!$form.length) return;
            $form.on('submit',function(e){
                e.preventDefault();
                const $btn=$form.find('[type="submit"]'), $msg=$form.find('.newsletter-message');
                const email=$form.find('input[name="email"]').val().trim();
                const nonce=$form.find('input[name="newsletter_nonce"]').val()||'';
                if(!email){ show($msg,'Veuillez entrer votre email.','error'); return; }
                $btn.prop('disabled',true).addClass('is-loading');
                $.ajax({
                    url:(typeof greenpureData!=='undefined')?greenpureData.ajaxUrl:'/wp-admin/admin-ajax.php',
                    method:'POST', data:{action:'greenpure_newsletter',email,nonce},
                    success:function(r){ show($msg,r&&r.data&&r.data.message?r.data.message:(r.success?'Merci !':'Erreur.'),r&&r.success?'success':'error'); if(r&&r.success)$form[0].reset(); },
                    error:()=>show($msg,'Erreur réseau.','error'),
                    complete:()=>$btn.prop('disabled',false).removeClass('is-loading')
                });
                function show($el,txt,type){ $el.removeClass('success error').text(txt).addClass(type).fadeIn(300); setTimeout(()=>$el.fadeOut(400),5000); }
            });
        }catch(e){ console.error('[GP] Newsletter:',e); }
    }
    $(document).ready(function(){ initMiniCart(); initAddToCart(); initNewsletter(); });
}(typeof jQuery!=='undefined'?jQuery:{fn:{},ready:function(cb){document.addEventListener('DOMContentLoaded',cb);},on:function(){}}));

/* === BOOTSTRAP === */
document.addEventListener('DOMContentLoaded',function(){
    initAgeGate();
    initStickyHeader();
    initStickyBehavior();
    initMobileMenu();
    initSearchToggle();
    initProductTabs();
    initQtyButtons();
    initNoticesClose();
    initFaqAccordion();
    initTestimonialsSlider();
    initProductFilter();
    initProductFilterAnim();
    initCountdownTimer();
    initBackToTop();
    initCookieBanner();
    initScrollAnimations();
    initParticles();
    initSmoothScroll();
    initWooGallery();
    initLangSwitcher();
});
