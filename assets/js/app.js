/* =================================================================
   FIDORA Labs — v2 / 2026
   Interactions: theme, lang, scroll effects, parallax,
   3D stack, manifesto pinning, counters, form submit.
   ================================================================= */
(() => {
    'use strict';

    const $  = (s, r = document) => r.querySelector(s);
    const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
    const html = document.documentElement;
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Theme -------------------------------------------- */
    const themeKey = 'fidora_theme';
    const stored = localStorage.getItem(themeKey);
    if (stored === 'light' || stored === 'dark') html.dataset.theme = stored;

    const themeBtn = $('#themeToggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const next = html.dataset.theme === 'light' ? 'dark' : 'light';
            html.dataset.theme = next;
            localStorage.setItem(themeKey, next);
            document.querySelector('meta[name="theme-color"]')
                ?.setAttribute('content', next === 'light' ? '#ffffff' : '#000000');
        });
    }

    /* ---------- Lang dropdown ----------------------------------- */
    const lang = $('[data-lang]');
    if (lang) {
        const btn = $('.lang__btn', lang);
        btn?.addEventListener('click', (e) => {
            e.stopPropagation();
            lang.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', lang.classList.contains('is-open'));
        });
        document.addEventListener('click', (e) => {
            if (!lang.contains(e.target)) {
                lang.classList.remove('is-open');
                btn?.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ---------- Nav scroll state -------------------------------- */
    const nav = $('#nav');
    const onScrollNav = () => {
        if (!nav) return;
        nav.classList.toggle('is-scrolled', window.scrollY > 24);
    };
    onScrollNav();
    window.addEventListener('scroll', onScrollNav, { passive: true });

    /* ---------- Reveal on scroll -------------------------------- */
    const toReveal = $$(
        '.section__head, .product, .metric, .contact__form, .contact__copy, .stack__scene, .foot__top'
    );
    toReveal.forEach(el => el.setAttribute('data-reveal', ''));
    const revealIO = new IntersectionObserver((entries) => {
        entries.forEach(en => {
            if (en.isIntersecting) {
                en.target.classList.add('is-in');
                revealIO.unobserve(en.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    toReveal.forEach(el => revealIO.observe(el));

    /* ---------- Hero parallax (subtle, scroll-linked) ----------- */
    const heroImg = $('.hero__media img');
    if (heroImg && !prefersReduced) {
        let ticking = false;
        const update = () => {
            const y = Math.min(window.scrollY, 800);
            const scale = 1.05 + (y / 800) * 0.06;
            heroImg.style.transform = `translateY(${y * 0.18}px) scale(${scale})`;
            ticking = false;
        };
        window.addEventListener('scroll', () => {
            if (!ticking) { requestAnimationFrame(update); ticking = true; }
        }, { passive: true });
    }

    /* ---------- 3D stack: pinned scroll-driven reveal -----------
       The .stack__pin element is a tall track; .stack__scene is
       sticky inside it (CSS). We compute progress 0..1 across the
       pin's scroll distance and animate each layer accordingly.
       Layers initially sit stacked on the topmost card. As the user
       scrolls, the top card peels off (translateY up + tilt + fade),
       revealing the next card, then the next, and the next.
       --------------------------------------------------------- */
    const pin = $('.stack__pin');
    const scene = $('.stack__scene');
    if (pin && scene && !prefersReduced) {
        const stackLayers = $$('.stack__layer', scene);
        const N = stackLayers.length;
        // The progress rail is now <ol><li>…</li></ol>, not <span>s.
        const dots = $$('.stack__progress li', scene);

        const sceneIO = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) scene.classList.add('is-active');
            });
        }, { threshold: 0.05 });
        sceneIO.observe(scene);

        // Base depths (must match CSS so initial paint matches).
        // We use a *uniform, gentle* depth so all cards read at the same
        // visual size — the depth illusion comes from the layered shadows
        // and the slight rotation, not from popping the front card forward.
        const isMobile = window.matchMedia('(max-width: 640px)').matches;
        const BASE_Z = isMobile
            ? [0, -8, -16, -24]
            : [0, -20, -40, -60];

        let raf = null;
        const update = () => {
            raf = null;
            const rect = pin.getBoundingClientRect();
            const vh = window.innerHeight;
            // Progress over the pin track: 0 when scene first sticks,
            // 1 when the pin has fully scrolled past (scene un-sticks).
            const trackLength = pin.offsetHeight - vh;
            const scrolled = -rect.top;
            const progress = Math.max(0, Math.min(1, scrolled / trackLength));

            // Reserve a tiny tail (5%) so the last card has a moment to be seen
            // before the section ends.
            const usable = Math.min(progress / 0.95, 1);

            // Each of the first (N-1) layers peels off across an equal slice.
            // The Nth (deepest) layer never peels — it stays as the final reveal.
            const peels = N - 1;
            const slice = 1 / peels;

            stackLayers.forEach((layer, i) => {
                const baseZ = BASE_Z[i] !== undefined ? BASE_Z[i] : 0;

                // Stacking order: the card currently "in front" must visually
                // sit above the others. Without this, the deepest card (e.g.
                // "EL METAL") could bleed through cards 2/3 because its
                // translateZ + perspective made it pop forward in 3D space.
                // We give each layer a zIndex that decreases as we go deeper,
                // so the natural stack reads 1 → 2 → 3 → 4 from the front.
                layer.style.zIndex = String(N - i);

                if (i === N - 1) {
                    // Last layer: stays in place as the final card.
                    // Don't pop it forward on Z — that was causing it to
                    // bleed in front of layers 2 and 3 on mobile while they
                    // were still being read.
                    layer.style.transform = `translate3d(0, 0, ${baseZ}px)`;
                    layer.style.opacity = '1';
                    return;
                }

                // local progress for this layer's peel
                const start = i * slice;
                const local = Math.max(0, Math.min(1, (usable - start) / slice));
                // ease-out cubic
                const eased = 1 - Math.pow(1 - local, 3);

                // movement
                const translateY = -eased * 220;            // peel upward
                const rotateX    = -eased * 22;             // tilt forward as it peels
                const translateZ = baseZ + eased * 240;     // pop toward camera then off
                const opacity    = 1 - eased;               // fade to 0

                layer.style.transform =
                    `translate3d(0, ${translateY}px, ${translateZ}px) rotateX(${rotateX}deg)`;
                layer.style.opacity = String(opacity);
            });

            // Active chapter = the card currently visible *at the front of the stack*.
            // Each layer i peels across the slice [i/peels, (i+1)/peels]. As soon as
            // peeling for layer i begins, layer i is fading/translating away and the
            // next card (i+1) is what the user is actually reading. So the active
            // index is the count of layers that have *started* peeling — clamped to
            // the last card. At progress 0, that's card 0 (nothing has peeled yet).
            let activeIdx = 0;
            for (let i = 0; i < peels; i++) {
                const start = i * slice;
                const local = (usable - start) / slice;
                if (local > 0.5) activeIdx = i + 1; // once layer i is past midway, the next card is in front
            }
            activeIdx = Math.min(N - 1, activeIdx);
            dots.forEach((d, i) => d.classList.toggle('is-active', i === activeIdx));
        };

        const onScroll = () => {
            if (!raf) raf = requestAnimationFrame(update);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        update();
    }

    /* ---------- Manifesto pinned reveal ------------------------- */
    const manifestoLines = $$('[data-manifesto-line]');
    if (manifestoLines.length) {
        const lineIO = new IntersectionObserver((entries) => {
            entries.forEach(en => {
                if (en.isIntersecting) en.target.classList.add('is-active');
            });
        }, { threshold: 0.7 });

        // Scroll-driven: activate based on the sticky parent's progress.
        const wrapper = $('.manifesto__sticky');
        const updateManifesto = () => {
            if (!wrapper) return;
            const rect = wrapper.getBoundingClientRect();
            const total = wrapper.offsetHeight - window.innerHeight;
            const progress = Math.max(0, Math.min(1, -rect.top / total));
            const idx = Math.floor(progress * manifestoLines.length);
            manifestoLines.forEach((line, i) => {
                line.classList.toggle('is-active', i <= idx);
            });
        };
        window.addEventListener('scroll', updateManifesto, { passive: true });
        updateManifesto();
    }

    /* ---------- Animated counters ------------------------------- */
    const counters = $$('[data-count]');
    const fmt = (n, target) => {
        const isFloat = String(target).includes('.');
        return isFloat ? n.toFixed(2) : Math.round(n).toLocaleString();
    };
    const counterIO = new IntersectionObserver((entries) => {
        entries.forEach(en => {
            if (!en.isIntersecting) return;
            const el = en.target;
            const target = parseFloat(el.dataset.count);
            const duration = 1400;
            const t0 = performance.now();
            const tick = (t) => {
                const k = Math.min(1, (t - t0) / duration);
                const eased = 1 - Math.pow(1 - k, 3);
                el.textContent = fmt(target * eased, target);
                if (k < 1) requestAnimationFrame(tick);
                else el.textContent = fmt(target, target);
            };
            requestAnimationFrame(tick);
            counterIO.unobserve(el);
        });
    }, { threshold: 0.5 });
    counters.forEach(el => counterIO.observe(el));

    /* ---------- Smooth scroll for in-page anchors --------------- */
    $$('a[href^="#"]').forEach(a => {
        a.addEventListener('click', (e) => {
            const href = a.getAttribute('href');
            if (!href || href === '#' || href.length < 2) return;
            const target = document.querySelector(href);
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    /* ---------- Form submit (webhook) ---------------------------
       Mirrors the original landing.js behaviour exactly:
       fetch -> .then(response.json()) -> .then(success) / .catch(error)
       same webhook, same payload shape, same source='landing_page'.
       --------------------------------------------------------- */
    const form = $('#briefingForm');
    if (form) {
        const status = $('[data-form-status]', form);
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (!form.checkValidity()) {
                if (status) {
                    status.textContent = form.dataset.msgInvalid || 'Please fill the required fields.';
                    status.className = 'contact__note mono is-err';
                }
                return;
            }

            const fd = new FormData(form);
            // Map v2 fields -> same payload shape the original webhook expects.
            // Original sends: firstName, lastName, email, phone, timestamp, source
            // v2 has: name, company, email, message (we keep extras; n8n handles them).
            const fullName = (fd.get('name') || '').toString().trim();
            const [firstName, ...rest] = fullName.split(/\s+/);
            const lastName = rest.join(' ');

            const payload = {
                firstName: firstName || fullName,
                lastName: lastName || '',
                email: fd.get('email') || '',
                phone: fd.get('phone') || '',
                company: fd.get('company') || '',
                message: fd.get('message') || '',
                website: fd.get('website') || '',
                country: fd.get('country') || '',
                partnership_type: fd.get('partnership_type') || '',
                timestamp: new Date().toISOString(),
                source: form.dataset.source || 'landing_page',
            };

            const submitBtn = form.querySelector('button[type="submit"]');
            const original = submitBtn.innerHTML;
            submitBtn.disabled = true;
            const sendingMsg = form.dataset.msgSending || 'Sending…';
            submitBtn.innerHTML = `<span>${sendingMsg}</span>`;

            fetch('https://n.fidora.es/webhook/Fidora-demo', {
                method: 'POST',
                body: JSON.stringify(payload),
            })
            .then(response => response.json())
            .then(() => {
                if (status) {
                    status.textContent = form.dataset.msgOk || 'Received.';
                    status.className = 'contact__note mono is-ok';
                }
                form.reset();
            })
            .catch((err) => {
                console.error('Error:', err);
                if (status) {
                    status.textContent = form.dataset.msgErr || 'Something failed.';
                    status.className = 'contact__note mono is-err';
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = original;
            });
        });
    }

    /* ---------- Mobile menu (burger) ---------------------------- */
    const burger = $('#burger');
    const navLinks = $('.nav__links');
    if (burger && navLinks) {
        burger.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('is-open');
            navLinks.style.display = isOpen ? 'flex' : '';
            navLinks.style.position = 'fixed';
            navLinks.style.inset = '64px 0 0 0';
            navLinks.style.flexDirection = 'column';
            navLinks.style.alignItems = 'center';
            navLinks.style.justifyContent = 'center';
            navLinks.style.background = 'var(--bg)';
            navLinks.style.zIndex = '40';
            navLinks.style.fontSize = '20px';
            if (!isOpen) {
                navLinks.removeAttribute('style');
            }
        });
        navLinks.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                navLinks.classList.remove('is-open');
                navLinks.removeAttribute('style');
            }
        });
    }

    /* ---------- Cookies banner ------------------------------------
       Stores consent in a single cookie 'fidora_consent' as JSON:
       { essential: true, analytics: bool, marketing: bool, ts: number }
       Banner shows only if the cookie is missing. Re-open via the
       footer "Cookie preferences" link. --------------------------- */
    const CONSENT_KEY = 'fidora_consent';
    const banner = $('#cookiesBanner');
    if (banner) {
        const panel = $('#cookiesPanel', banner);
        const readConsent = () => {
            try { return JSON.parse(localStorage.getItem(CONSENT_KEY) || 'null'); }
            catch { return null; }
        };
        const writeConsent = (c) => {
            try { localStorage.setItem(CONSENT_KEY, JSON.stringify({ ...c, ts: Date.now() })); } catch {}
            // also drop a non-tracking marker cookie so server-side (if ever)
            // can see the user has consented to at least essentials
            document.cookie = CONSENT_KEY + '=1; path=/; max-age=' + (60 * 60 * 24 * 365);
        };

        const show = () => {
            banner.hidden = false;
            requestAnimationFrame(() => banner.classList.add('is-visible'));
        };
        const hide = () => {
            banner.classList.remove('is-visible');
            setTimeout(() => { banner.hidden = true; }, 600);
        };

        const existing = readConsent();
        if (!existing) {
            // Show the banner once the page is interactive. Short delay
            // so users notice it without it feeling intrusive.
            setTimeout(show, 250);
        }

        // Re-open the banner from the footer / dedicated trigger.
        // Triggered by any element with [data-cookie-reopen].
        $$('[data-cookie-reopen]').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                show();
            });
        });

        banner.addEventListener('click', (e) => {
            // Walk up to the nearest button so the inner <span> child
            // doesn't break the action lookup.
            const btn = e.target.closest('[data-cookie-action]');
            if (!btn) return;
            const action = btn.dataset.cookieAction;
            if (action === 'accept') {
                writeConsent({ essential: true, analytics: true, marketing: true });
                hide();
            } else if (action === 'reject') {
                writeConsent({ essential: true, analytics: false, marketing: false });
                hide();
            } else if (action === 'settings') {
                panel.hidden = !panel.hidden;
            } else if (action === 'save') {
                const analytics  = !!$('[data-cookie-pref="analytics"]', banner)?.checked;
                const marketing  = !!$('[data-cookie-pref="marketing"]', banner)?.checked;
                writeConsent({ essential: true, analytics, marketing });
                hide();
            }
        });
    }
})();
