<?php
require_once __DIR__ . '/../assets/php/inc.php';

$pc = [
    'es' => [
        'meta_title' => 'Partners — FIDORA Labs',
        'meta_desc'  => '¿Revendes, integras o complementas lo que hacemos? Hablemos. FIDORA LABS LLC. busca partners en Europa y US.',
        'eyebrow'    => 'PARTNERS · 2026',
        'title_l1'   => 'Hazlo con',
        'title_l2'   => 'nosotros.',
        'title_em'   => true,
        'lede'       => 'Revendes, integras o complementas lo que hacemos. Si tienes clientes que necesitan voz o WhatsApp atendido de verdad, hablemos. Te damos margen, soporte y acceso a la misma infraestructura que usamos nosotros.',
        'scroll'     => 'BAJA',
        'why_title'  => 'Por qué ser partner',
        'why' => [
            ['h' => 'Stack que ya funciona', 'p' => 'No tienes que vender humo. VozAI y WhatsApp Engine están en producción, en Europa, en clientes reales.'],
            ['h' => 'Margen y soporte', 'p' => 'Márgenes claros por plan. Soporte técnico directo de quien lo construye. Onboarding conjunto en tus primeros cinco clientes.'],
            ['h' => 'Co-branding o marca blanca', 'p' => 'Tú decides cómo lo presentas. Podemos ir co-branded, con tu marca, o como un módulo más dentro de tu oferta.'],
            ['h' => 'Co-desarrollo de producto', 'p' => 'Si tu industria necesita algo que no existe, lo construimos juntos. Ya hemos hecho esto con partners de real estate y salud.'],
        ],
        'form' => [
            'name'     => 'Nombre',
            'company'  => 'Empresa',
            'website'  => 'Web',
            'country'  => 'País',
            'email'    => 'Email de trabajo',
            'phone'    => 'Teléfono',
            'type'     => 'Tipo de partnership',
            'type_options' => ['Revendedor / reseller', 'Integrador / agencia', 'Complemento a tu producto', 'Otro'],
            'message'  => 'Cuéntanos qué haces y qué te gustaría vender juntos.',
            'consent'  => 'Soy mayor de 18 años y acepto la política de privacidad.',
            'submit'   => 'Enviar solicitud',
            'ok'       => 'Recibido. Te contestamos en menos de 24h.',
            'err'      => 'Algo ha fallado. Escríbenos a hola@fidora.io',
            'invalid'  => 'Rellena los campos obligatorios.',
        ],
    ],
    'en' => [
        'meta_title' => 'Partners — FIDORA Labs',
        'meta_desc'  => 'Resell, integrate, or complement what we do. FIDORA LABS LLC. is looking for partners in Europe and the US.',
        'eyebrow'    => 'PARTNERS · 2026',
        'title_l1'   => 'Build with',
        'title_l2'   => 'us.',
        'title_em'   => true,
        'lede'       => 'You resell, integrate, or complement what we do. If you have customers who need voice or WhatsApp actually handled, let’s talk. We give you margin, support, and access to the same infrastructure we use.',
        'scroll'     => 'SCROLL',
        'why_title'  => 'Why partner',
        'why' => [
            ['h' => 'A stack that already works', 'p' => 'You don’t have to sell vapour. VozAI and WhatsApp Engine are in production, in Europe, with real customers.'],
            ['h' => 'Margin and support', 'p' => 'Clear per-plan margins. Direct technical support from the people who build it. Joint onboarding on your first five customers.'],
            ['h' => 'Co-branding or white-label', 'p' => 'You decide how to present it. We can go co-branded, under your brand, or as a module inside your offering.'],
            ['h' => 'Co-development', 'p' => 'If your industry needs something that doesn’t exist yet, we build it together. We have done this with partners in real estate and health.'],
        ],
        'form' => [
            'name'     => 'Name',
            'company'  => 'Company',
            'website'  => 'Website',
            'country'  => 'Country',
            'email'    => 'Work email',
            'phone'    => 'Phone',
            'type'     => 'Partnership type',
            'type_options' => ['Reseller', 'Integrator / agency', 'Complement to your product', 'Other'],
            'message'  => 'Tell us what you do and what you’d like to sell together.',
            'consent'  => 'I’m 18+ and accept the privacy policy.',
            'submit'   => 'Send request',
            'ok'       => 'Received. We reply within 24h.',
            'err'      => 'Something failed. Email us at hello@fidora.io',
            'invalid'  => 'Please fill the required fields.',
        ],
    ],
    'de' => [
        'meta_title' => 'Partner — FIDORA Labs',
        'meta_desc'  => 'Sie vertreiben, integrieren oder ergänzen, was wir tun. FIDORA LABS LLC. sucht Partner in Europa und den USA.',
        'eyebrow'    => 'PARTNER · 2026',
        'title_l1'   => 'Mit uns, nicht',
        'title_l2'   => 'gegen uns.',
        'title_em'   => true,
        'lede'       => 'Sie vertreiben, integrieren oder ergänzen, was wir tun. Wenn Sie Kunden haben, die Sprache oder WhatsApp wirklich brauchen, sprechen Sie uns an. Wir geben Ihnen Marge, Support und Zugang zur gleichen Infrastruktur.',
        'scroll'     => 'SCROLLEN',
        'why_title'  => 'Warum Partner werden',
        'why' => [
            ['h' => 'Ein Stack, der bereits funktioniert', 'p' => 'Sie verkaufen keinen heißen Luft. VozAI und WhatsApp Engine sind in Produktion, in Europa, bei echten Kunden.'],
            ['h' => 'Marge und Support', 'p' => 'Klare Margen pro Plan. Direkter technischer Support von denjenigen, die es bauen.'],
            ['h' => 'Co-Branding oder White-Label', 'p' => 'Sie entscheiden, wie Sie es präsentieren.'],
            ['h' => 'Co-Entwicklung', 'p' => 'Wenn Ihre Branche etwas braucht, das es noch nicht gibt, bauen wir es gemeinsam.'],
        ],
        'form' => [
            'name'     => 'Name',
            'company'  => 'Unternehmen',
            'website'  => 'Webseite',
            'country'  => 'Land',
            'email'    => 'Geschäftliche E-Mail',
            'phone'    => 'Telefon',
            'type'     => 'Art der Partnerschaft',
            'type_options' => ['Wiederverkäufer', 'Integrator / Agentur', 'Ergänzung zu Ihrem Produkt', 'Andere'],
            'message'  => 'Erzählen Sie uns, was Sie tun und was Sie gemeinsam verkaufen möchten.',
            'consent'  => 'Ich bin 18+ und akzeptiere die Datenschutzerklärung.',
            'submit'   => 'Anfrage senden',
            'ok'       => 'Erhalten. Wir antworten innerhalb von 24h.',
            'err'      => 'Etwas ist schiefgelaufen. Schreiben Sie an hello@fidora.io',
            'invalid'  => 'Bitte Pflichtfelder ausfüllen.',
        ],
    ],
];
$c = $pc[$lang];
$f = $c['form'];
$isES = $lang === 'es';
?><!DOCTYPE html>
<html lang="<?php echo $lang; ?>" data-theme="dark">
<head>
<?php render_head($c['meta_title'], $c['meta_desc']); ?>
</head>
<body>
    <div class="bg-grid" aria-hidden="true"></div>
    <div class="bg-noise" aria-hidden="true"></div>

    <?php render_nav(); ?>

    <!-- Sub-hero. Same visual language as the index .hero: a
         cinematic background image, a left-anchored eyebrow + big
         title + lede, and the same scroll-triggered parallax. The
         image is anchored to the left half (.subhero--img-left). -->
    <section class="hero subhero subhero--img-left">
        <div class="subhero__media" aria-hidden="true">
            <img src="/assets/images/partners.jpg" alt="" data-subhero-img />
            <div class="hero__veil"></div>
            <div class="hero__scan"></div>
        </div>

        <div class="hero__eyebrow">
            <span class="mono"><?php echo $c['eyebrow']; ?></span>
        </div>

        <div class="hero__inner">
            <h1 class="hero__title" data-split-title>
                <span class="line"><span data-split><?php echo $c['title_l1']; ?></span></span>
                <span class="line"><span data-split><?php echo !empty($c['title_em']) ? '<em>'.$c['title_l2'].'</em>' : $c['title_l2']; ?></span></span>
            </h1>
            <p class="hero__lede"><?php echo $c['lede']; ?></p>
        </div>

        <a href="#why" class="hero__scroll" aria-label="Scroll">
            <span class="mono"><?php echo $c['scroll']; ?></span>
            <span class="hero__scroll-line"></span>
        </a>
    </section>

    <!-- "Why" + form. Two columns on desktop: left = narrative, right
         = form. Stacks on mobile. The form is the same component as
         on the index /contact section. -->
    <section class="contact subhero-after" id="why">
        <div class="contact__inner">
            <div class="contact__copy">
                <span class="section__index mono"><?php echo $isES?'POR QUÉ · 2026':($isDE?'WARUM · 2026':'WHY · 2026'); ?></span>
                <h2 class="section__title partners__title"><?php echo $c['why_title']; ?></h2>
                <ul class="partners__why">
                    <?php foreach ($c['why'] as $w): ?>
                        <li>
                            <span class="partners__why-arrow" aria-hidden="true">→</span>
                            <div>
                                <h3><?php echo $w['h']; ?></h3>
                                <p><?php echo $w['p']; ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <form class="contact__form" id="briefingForm" novalidate
                  data-source="partners"
                  data-msg-ok="<?php echo htmlspecialchars($f['ok'], ENT_QUOTES); ?>"
                  data-msg-err="<?php echo htmlspecialchars($f['err'], ENT_QUOTES); ?>"
                  data-msg-invalid="<?php echo htmlspecialchars($f['invalid'], ENT_QUOTES); ?>"
                  data-msg-sending="<?php echo $isES?'Enviando…':($lang==='de'?'Senden…':'Sending…'); ?>">
                <div class="field">
                    <label for="cname"><?php echo $f['name']; ?></label>
                    <input id="cname" name="name" type="text" required autocomplete="name" />
                </div>
                <div class="field">
                    <label for="ccompany"><?php echo $f['company']; ?></label>
                    <input id="ccompany" name="company" type="text" required autocomplete="organization" />
                </div>
                <div class="field">
                    <label for="cwebsite"><?php echo $f['website']; ?></label>
                    <input id="cwebsite" name="website" type="url" placeholder="https://" />
                </div>
                <div class="field">
                    <label for="ccountry"><?php echo $f['country']; ?></label>
                    <input id="ccountry" name="country" type="text" />
                </div>
                <div class="field">
                    <label for="cemail"><?php echo $f['email']; ?></label>
                    <input id="cemail" name="email" type="email" required autocomplete="email" />
                </div>
                <div class="field">
                    <label for="cphone"><?php echo $f['phone']; ?></label>
                    <input id="cphone" name="phone" type="tel" autocomplete="tel" />
                </div>
                <div class="field">
                    <label for="ctype"><?php echo $f['type']; ?></label>
                    <select id="ctype" name="partnership_type" required>
                        <option value="" disabled selected>—</option>
                        <?php foreach ($f['type_options'] as $opt): ?>
                            <option value="<?php echo htmlspecialchars($opt, ENT_QUOTES); ?>"><?php echo $opt; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="field field--check">
                    <input type="checkbox" required />
                    <span><?php echo $f['consent']; ?></span>
                </label>
                <button type="submit" class="btn btn--primary btn--block">
                    <span><?php echo $f['submit']; ?></span>
                    <svg viewBox="0 0 16 16" width="14" height="14" aria-hidden="true"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
                </button>
                <p class="contact__note mono" data-form-status></p>
            </form>
        </div>
    </section>

    <?php render_foot(); ?>
    <?php render_cookies_banner(); ?>

    <script src="/assets/js/app.js?v=9"></script>
</body>
</html>
