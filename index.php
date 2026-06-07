<?php
// ---------------------------------------------------------------
// FIDORA Labs — v2 (2026 redesign draft)
// Default locale: ES. Narrative: "complex systems that feel simple."
// ---------------------------------------------------------------

$lang = isset($_GET['lang'])
    ? $_GET['lang']
    : (isset($_COOKIE['fidora_lang']) ? $_COOKIE['fidora_lang'] : 'es');
$validLangs = ['es', 'en', 'de'];
if (!in_array($lang, $validLangs)) { $lang = 'es'; }
$isES = $lang === 'es';
$isDE = $lang === 'de';
$isEN = $lang === 'en';
setcookie('fidora_lang', $lang, time() + (30 * 24 * 60 * 60), '/');

// -- inline copy (kept here for easy editing — feed me final ES later)
$copy = [
    'es' => [
        'meta_title'       => 'FIDORA Labs — Sistemas complejos que se sienten simples',
        'meta_desc'        => 'Construimos infraestructura conversacional propia: Voz y WhatsApp con IA. Lo complejo, escondido. Lo simple, lo que tú usas.',
        'nav'              => ['Cómo funciona', 'Productos', 'Filosofía', 'Hablemos'],
        'nav_cta'          => 'Reservar llamada',
        'eyebrow'          => 'FIDORA LABS · INFRAESTRUCTURA PROPIA · 2026',
        'hero_line_1'      => 'Lo complicado lo hacemos nosotros.',
        'hero_line_2'      => 'Tú solo lo <em>usas</em>.',
        'hero_lede'        => 'Construimos los sistemas de IA que atienden a tus clientes —Voz, WhatsApp, seguimiento— sobre <span class="u">nuestra propia infraestructura</span>. Tú no lidias con APIs, modelos ni proveedores. Solo recibes resultados.',
        'cta_primary'      => 'Quiero ver cómo funciona',
        'cta_secondary'    => 'Ver lo que hay debajo',
        'stat_1_label'     => 'Tiempo en montarlo',
        'stat_1_value'     => '&lt; 72 horas',
        'stat_2_label'     => 'Lo que tú aprendes',
        'stat_2_value'     => 'Nada técnico',
        'stat_3_label'     => 'Dónde viven tus datos',
        'stat_3_value'     => 'UE · nuestra',
        'scroll'           => 'BAJA',
        'band'             => ['INFRAESTRUCTURA PROPIA', 'DATOS EN LA UE', 'VOZ · WHATSAPP · SEGUIMIENTO', 'LO COMPLEJO, ESCONDIDO'],
        'sec1_index'       => '01 — CÓMO FUNCIONA',
        'sec1_title_a'     => 'Por dentro es complejo. ',
        'sec1_title_em'    => 'Por fuera, una conversación.',
        'sec1_lede'        => 'Modelos de voz, motores de inferencia, telefonía, bases de datos, colas… todo eso lo operamos nosotros. Tú no lo ves. Solo ves que el teléfono se contesta y los clientes reciben respuesta.',
        'stack' => [
            ['mono' => 'LO QUE TÚ VES',         'h' => 'Una llamada contestada. Un WhatsApp respondido. Una cita en tu calendario.'],
            ['mono' => 'LO QUE OCURRE DEBAJO',  'h' => 'Agentes orquestados con contexto, memoria y reglas de negocio.'],
            ['mono' => 'EL MOTOR',              'h' => 'Modelos de voz y lenguaje autoalojados — reconocimiento, síntesis, razonamiento.'],
            ['mono' => 'EL METAL',              'h' => 'GPUs, operadores SIP y datacenters europeos que contratamos directamente.'],
        ],
        'sec2_index'       => '02 — PRODUCTOS',
        'sec2_title_a'     => 'Dos canales. ',
        'sec2_title_em'    => 'Un mismo cerebro.',
        'sec2_lede'        => 'No vendemos "tecnología". Vendemos que tu teléfono se conteste y tu WhatsApp responda — sin que tú tengas que aprender nada.',
        'prod_1_tag'       => 'VOZ',
        'prod_1_name'      => 'VozAI',
        'prod_1_price'     => '99€',
        'prod_1_price_label' => 'Desde',
        'prod_1_desc'      => 'Una voz que contesta el teléfono por ti. Califica, hace seguimiento, agenda. En tiempo real, indistinguible de un humano entrenado.',
        'prod_1_list'      => ['Llamadas entrantes y salientes', 'Voz personalizada para tu marca', 'Se conecta a tu CRM y agenda', 'Grabaciones y datos en la UE'],
        'prod_2_tag'       => 'MENSAJERÍA',
        'prod_2_pill'      => 'Más desplegado',
        'prod_2_name'      => 'WhatsApp Engine',
        'prod_2_price'     => '299€',
        'prod_2_price_label' => 'Desde',
        'prod_2_desc'      => 'Tu WhatsApp se convierte en un canal que recuerda, responde y vende — con un humano detrás solo cuando importa.',
        'prod_2_list'      => ['WhatsApp Business API oficial', 'Conversaciones largas con contexto', 'Catálogos, pagos, multimedia', 'Pase a humano cuando hace falta'],
        'prod_3_tag'       => 'A MEDIDA',
        'prod_3_name'      => 'Labs',
        'prod_3_price'     => '499€',
        'prod_3_price_label' => 'Desde',
        'prod_3_desc'      => 'Cuando tu problema no cabe en una plantilla. Nos sentamos contigo, lo entendemos, lo construimos. En nuestra infraestructura o en la tuya.',
        'prod_3_list'      => ['Discovery y arquitectura', 'Modelos y pipelines a medida', 'On-prem o aislado disponible', 'Un equipo de ingeniería dedicado'],
        'prod_cta'         => 'Quiero esto',
        'sec3_index'       => '03 — FILOSOFÍA',
        'manifesto'        => [
            'La IA no se alquila. Se construye.',
            'Y lo que se construye, se entiende.',
            'Por eso operamos cada pieza —voz, modelos, datos, infraestructura— nosotros mismos. En Europa.',
            'No revendemos APIs. No alquilamos cerebros ajenos.',
            'Tú no tienes que saber cómo funciona. Solo <em>verlo funcionar</em>.',
        ],
        'sec4_index'       => '04 — HABLEMOS',
        'contact_title_a'  => 'Una llamada honesta. ',
        'contact_title_em' => 'Sin discurso comercial.',
        'contact_lede'     => 'Cuéntanos qué intentas resolver. Si tiene sentido, hablas directamente con quien lo va a construir.',
        'contact_meta'     => [
            ['EMAIL', 'hola@fidora.io', true],
            ['SEDE',  'Madrid · Berlín', false],
            ['RESPUESTA', '&lt; 24h laborables', false],
        ],
        'form'             => [
            'name'    => 'Nombre',
            'phone'   => 'Teléfono',
            'company' => 'Empresa',
            'email'   => 'Email de trabajo',
            'message' => '¿Qué intentas resolver?',
            'consent' => 'Soy mayor de 18 años y acepto la política de privacidad.',
            'submit'  => 'Enviar',
            'ok'      => 'Recibido. Te contestamos en menos de 24h.',
            'err'     => 'Algo ha fallado. Escríbenos a hola@fidora.io',
            'invalid' => 'Rellena los campos obligatorios.',
        ],
        'foot_tag'         => 'Sistemas complejos que se sienten simples. Construidos en Europa.',
        'foot_cols'        => [
            ['Productos', ['VozAI', 'WhatsApp Engine', 'Labs']],
            ['Empresa',   ['Filosofía', 'Cómo funciona', 'Contacto']],
            ['Legal',     ['Privacidad', 'Términos', 'DPA']],
        ],
        'foot_bottom'      => ['© ' . date('Y') . ' FIDORA LABS', 'CONSTRUIDO Y ALOJADO EN LA UE', 'v2.0 — EDICIÓN 2026'],
    ],

    'en' => [
        'meta_title'       => 'FIDORA Labs — Complex systems that feel simple',
        'meta_desc'        => 'We build and operate our own conversational AI infrastructure: voice and WhatsApp. The complex stays hidden. You only see results.',
        'nav'              => ['How it works', 'Products', 'Philosophy', 'Let’s talk'],
        'nav_cta'          => 'Book a call',
        'eyebrow'          => 'FIDORA LABS · OWNED INFRASTRUCTURE · 2026',
        'hero_line_1'      => 'The complicated part is on us.',
        'hero_line_2'      => 'You just <em>use</em> it.',
        'hero_lede'        => 'We build the AI systems that take care of your customers — voice, WhatsApp, follow-up — on <span class="u">our own infrastructure</span>. You don’t deal with APIs, models or vendors. You just get results.',
        'cta_primary'      => 'Show me how it works',
        'cta_secondary'    => 'See what’s underneath',
        'stat_1_label'     => 'Time to live',
        'stat_1_value'     => '&lt; 14 days',
        'stat_2_label'     => 'What you learn',
        'stat_2_value'     => 'Nothing technical',
        'stat_3_label'     => 'Where data lives',
        'stat_3_value'     => 'EU · ours',
        'scroll'           => 'SCROLL',
        'band'             => ['OWNED INFRASTRUCTURE', 'EU DATA RESIDENCY', 'VOICE · WHATSAPP · FOLLOW-UP', 'COMPLEX, HIDDEN'],
        'sec1_index'       => '01 — HOW IT WORKS',
        'sec1_title_a'     => 'Complex inside. ',
        'sec1_title_em'    => 'A conversation outside.',
        'sec1_lede'        => 'Models, inference, telephony, databases, queues — we operate all of it. You never see it. You just see that the phone gets answered and customers get a reply.',
        'stack' => [
            ['mono' => 'WHAT YOU SEE',          'h' => 'A call answered. A WhatsApp replied. A booking on your calendar.'],
            ['mono' => 'WHAT’S HAPPENING',      'h' => 'Orchestrated agents with context, memory and business rules.'],
            ['mono' => 'THE ENGINE',            'h' => 'Self-hosted voice and language models — recognition, synthesis, reasoning.'],
            ['mono' => 'THE METAL',             'h' => 'GPUs, SIP carriers and EU datacenters we contract directly.'],
        ],
        'sec2_index'       => '02 — PRODUCTS',
        'sec2_title_a'     => 'Two channels. ',
        'sec2_title_em'    => 'One brain.',
        'sec2_lede'        => 'We don’t sell "technology". We sell that your phone gets answered and your WhatsApp replies — without you having to learn anything.',
        'prod_1_tag'       => 'VOICE',
        'prod_1_name'      => 'VozAI',
        'prod_1_price'     => '99€',
        'prod_1_price_label' => 'From',
        'prod_1_desc'      => 'A voice that picks up the phone for you. Qualifies, follows up, books. In real time, indistinguishable from a trained human.',
        'prod_1_list'      => ['Inbound &amp; outbound calls', 'Custom voice for your brand', 'Connects to your CRM and calendar', 'Recordings &amp; data in the EU'],
        'prod_2_tag'       => 'MESSAGING',
        'prod_2_pill'      => 'Most deployed',
        'prod_2_name'      => 'WhatsApp Engine',
        'prod_2_price'     => '299€',
        'prod_2_price_label' => 'From',
        'prod_2_desc'      => 'Your WhatsApp becomes a channel that remembers, replies and sells — with a human behind only when it matters.',
        'prod_2_list'      => ['Official WhatsApp Business API', 'Stateful long conversations', 'Catalogs, payments, media', 'Human handoff when needed'],
'prod_3_tag'       => 'BESPOKE',
        'prod_3_name'      => 'Labs',
        'prod_3_price'     => '499€',
        'prod_3_price_label' => 'From',
        'prod_3_desc'      => 'When your problem doesn\'t fit a template. We sit with you, understand it, build it. On our infra or yours.',
        'prod_3_list'      => ['Discovery &amp; architecture', 'Custom models &amp; pipelines', 'On-prem &amp; air-gapped options', 'A dedicated engineering pod'],
        'prod_cta'         => 'I want this',
        'sec3_index'       => '03 — PHILOSOPHY',
        'manifesto'        => [
            'AI isn’t rented. It’s built.',
            'And what you build, you understand.',
            'That’s why we operate every piece — voice, models, data, infrastructure — ourselves. In Europe.',
            'We don’t resell APIs. We don’t lease anyone else’s brain.',
            'You don’t need to know how it works. You just need to <em>see it work</em>.',
        ],
        'sec4_index'       => '04 — LET’S TALK',
        'contact_title_a'  => 'An honest call. ',
        'contact_title_em' => 'No sales theater.',
        'contact_lede'     => 'Tell us what you’re trying to solve. If it’s a fit, you’ll talk directly to whoever will build it.',
        'contact_meta'     => [
            ['EMAIL', 'hello@fidora.io', true],
            ['HQ',    'Madrid · Berlin', false],
            ['RESPONSE', '&lt; 24h business', false],
        ],
        'form'             => [
            'name'    => 'Name',
            'phone'   => 'Phone',
            'company' => 'Company',
            'email'   => 'Work email',
            'message' => 'What are you trying to solve?',
            'consent' => 'I’m 18+ and accept the privacy policy.',
            'submit'  => 'Send',
            'ok'      => 'Received. We reply within 24h.',
            'err'     => 'Something failed. Email us at hello@fidora.io',
            'invalid' => 'Please fill the required fields.',
        ],
        'foot_tag'         => 'Complex systems that feel simple. Built in Europe.',
        'foot_cols'        => [
            ['Products', ['VozAI', 'WhatsApp Engine', 'Labs']],
            ['Company',  ['Philosophy', 'How it works', 'Contact']],
            ['Legal',    ['Privacy', 'Terms', 'DPA']],
        ],
        'foot_bottom'      => ['© ' . date('Y') . ' FIDORA LABS S.L.', 'BUILT &amp; HOSTED IN THE EU', 'v2.0 — 2026 EDITION'],
    ],

    'de' => [
        'meta_title'       => 'FIDORA Labs — Komplexe Systeme, die sich einfach anfühlen',
        'meta_desc'        => 'Wir bauen und betreiben eigene konversationelle KI-Infrastruktur: Sprache und WhatsApp. Das Komplizierte bleibt verborgen. Sie sehen nur Ergebnisse.',
        'nav'              => ['Wie es funktioniert', 'Produkte', 'Philosophie', 'Sprechen'],
        'nav_cta'          => 'Termin buchen',
        'eyebrow'          => 'FIDORA LABS · EIGENE INFRASTRUKTUR · 2026',
        'hero_line_1'      => 'Das Komplizierte machen wir.',
        'hero_line_2'      => 'Sie <em>benutzen</em> es einfach.',
        'hero_lede'        => 'Wir bauen die KI-Systeme, die Ihre Kunden betreuen — Sprache, WhatsApp, Follow-up — auf <span class="u">unserer eigenen Infrastruktur</span>. Keine APIs, keine Modelle, keine Anbieter. Nur Ergebnisse.',
        'cta_primary'      => 'Zeigen Sie mir, wie es geht',
        'cta_secondary'    => 'Was steckt dahinter',
        'stat_1_label'     => 'Bis zum Live-Gang',
        'stat_1_value'     => '&lt; 14 Tage',
        'stat_2_label'     => 'Was Sie lernen',
        'stat_2_value'     => 'Nichts Technisches',
        'stat_3_label'     => 'Wo Ihre Daten liegen',
        'stat_3_value'     => 'EU · unsere',
        'scroll'           => 'SCROLLEN',
        'band'             => ['EIGENE INFRASTRUKTUR', 'EU-DATENRESIDENZ', 'SPRACHE · WHATSAPP · FOLLOW-UP', 'KOMPLEX, VERBORGEN'],
        'sec1_index'       => '01 — WIE ES FUNKTIONIERT',
        'sec1_title_a'     => 'Innen komplex. ',
        'sec1_title_em'    => 'Außen ein Gespräch.',
        'sec1_lede'        => 'Modelle, Inferenz, Telefonie, Datenbanken, Queues — alles betreiben wir. Sie sehen es nie. Sie sehen nur: das Telefon klingelt, der Kunde bekommt Antwort.',
        'stack' => [
            ['mono' => 'WAS SIE SEHEN',         'h' => 'Ein angenommener Anruf. Eine beantwortete WhatsApp-Nachricht. Ein Termin im Kalender.'],
            ['mono' => 'WAS PASSIERT',          'h' => 'Orchestrierte Agenten mit Kontext, Gedächtnis und Geschäftsregeln.'],
            ['mono' => 'DER MOTOR',             'h' => 'Selbstgehostete Sprach- und Sprachmodelle — Erkennung, Synthese, Reasoning.'],
            ['mono' => 'DAS METALL',            'h' => 'GPUs, SIP-Carrier und EU-Rechenzentren, die wir direkt unter Vertrag haben.'],
        ],
        'sec2_index'       => '02 — PRODUKTE',
        'sec2_title_a'     => 'Zwei Kanäle. ',
        'sec2_title_em'    => 'Ein Gehirn.',
        'sec2_lede'        => 'Wir verkaufen keine "Technologie". Wir verkaufen, dass Ihr Telefon angenommen wird und WhatsApp antwortet — ohne dass Sie etwas lernen müssen.',
        'prod_1_tag'       => 'SPRACHE',
        'prod_1_name'      => 'VozAI',
        'prod_1_price'     => '99€',
        'prod_1_price_label' => 'Ab',
        'prod_1_desc'      => 'Eine Stimme, die für Sie ans Telefon geht. Qualifiziert, verfolgt nach, bucht. In Echtzeit, kaum unterscheidbar von einem trainierten Menschen.',
        'prod_1_list'      => ['Eingehend &amp; ausgehend', 'Individuelle Markenstimme', 'CRM &amp; Kalender-Anbindung', 'Aufnahmen &amp; Daten in der EU'],
        'prod_2_tag'       => 'MESSAGING',
        'prod_2_pill'      => 'Am meisten genutzt',
        'prod_2_name'      => 'WhatsApp Engine',
        'prod_2_price'     => '299€',
        'prod_2_price_label' => 'Ab',
        'prod_2_desc'      => 'Ihr WhatsApp wird zum Kanal, der sich erinnert, antwortet und verkauft — mit einem Menschen nur, wenn es zählt.',
        'prod_2_list'      => ['Offizielle WhatsApp Business API', 'Lange Gespräche mit Kontext', 'Kataloge, Zahlungen, Medien', 'Übergabe an Menschen'],
        'prod_3_tag'       => 'MASSGESCHNEIDERT',
        'prod_3_name'      => 'Labs',
        'prod_3_price'     => '499€',
        'prod_3_price_label' => 'Ab',
        'prod_3_desc'      => 'Wenn Ihr Problem nicht in eine Vorlage passt. Wir setzen uns mit Ihnen zusammen, verstehen es, bauen es. Auf unserer oder Ihrer Infrastruktur.',
        'prod_3_list'      => ['Discovery &amp; Architektur', 'Eigene Modelle &amp; Pipelines', 'On-prem &amp; air-gapped möglich', 'Dediziertes Engineering-Team'],
        'prod_cta'         => 'Das will ich',
        'sec3_index'       => '03 — PHILOSOPHIE',
        'manifesto'        => [
            'KI mietet man nicht. Man baut sie.',
            'Und was man baut, versteht man.',
            'Deshalb betreiben wir jedes Stück — Sprache, Modelle, Daten, Infrastruktur — selbst. In Europa.',
            'Keine wiederverkauften APIs. Kein fremdes Gehirn.',
            'Sie müssen nicht wissen, wie es funktioniert. Sie müssen nur <em>sehen, dass es funktioniert</em>.',
        ],
        'sec4_index'       => '04 — SPRECHEN',
        'contact_title_a'  => 'Ein ehrliches Gespräch. ',
        'contact_title_em' => 'Kein Vertriebstheater.',
        'contact_lede'     => 'Sagen Sie uns, was Sie lösen wollen. Wenn es passt, sprechen Sie direkt mit dem, der es baut.',
        'contact_meta'     => [
            ['E-MAIL', 'hello@fidora.io', true],
            ['SITZ',   'Madrid · Berlin', false],
            ['ANTWORT', '&lt; 24h werktags', false],
        ],
        'form'             => [
            'name'    => 'Name',
            'phone'   => 'Telefon',
            'company' => 'Unternehmen',
            'email'   => 'Geschäftliche E-Mail',
            'message' => 'Was wollen Sie lösen?',
            'consent' => 'Ich bin 18+ und akzeptiere die Datenschutzerklärung.',
            'submit'  => 'Senden',
            'ok'      => 'Erhalten. Wir antworten innerhalb von 24h.',
            'err'     => 'Etwas ist schiefgelaufen. Schreiben Sie an hello@fidora.io',
            'invalid' => 'Bitte Pflichtfelder ausfüllen.',
        ],
        'foot_tag'         => 'Komplexe Systeme, die sich einfach anfühlen. Gebaut in Europa.',
        'foot_cols'        => [
            ['Produkte', ['VozAI', 'WhatsApp Engine', 'Labs']],
            ['Firma',    ['Philosophie', 'Wie es funktioniert', 'Kontakt']],
            ['Recht',    ['Datenschutz', 'AGB', 'DPA']],
        ],
        'foot_bottom'      => ['© ' . date('Y') . ' FIDORA LABS S.L.', 'GEBAUT &amp; GEHOSTET IN DER EU', 'v2.0 — AUSGABE 2026'],
    ],
];

$c = $copy[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="theme-color" content="#000000" />

    <title><?php echo $c['meta_title']; ?></title>
    <meta name="description" content="<?php echo $c['meta_desc']; ?>" />

    <link rel="icon" type="image/png" href="assets/images/fidora_whitebg.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/app.css?v=6" />
</head>
<body>

    <div class="bg-grid" aria-hidden="true"></div>
    <div class="bg-noise" aria-hidden="true"></div>

    <!-- NAV -->
    <header class="nav" id="nav">
        <a href="#" class="nav__brand" aria-label="Fidora Labs">
            <img src="assets/images/fidora_whitebg.png" alt="" class="nav__logo nav__logo--dark" />
            <img src="assets/images/fidora_blackbg.png" alt="" class="nav__logo nav__logo--light" />
            <span class="nav__wordmark">FIDORA<span class="nav__wordmark-dot">.</span></span>
        </a>

        <nav class="nav__links" aria-label="Primary">
            <a href="#how" data-link><?php echo $c['nav'][0]; ?></a>
            <a href="#products" data-link><?php echo $c['nav'][1]; ?></a>
            <a href="#manifesto" data-link><?php echo $c['nav'][2]; ?></a>
            <a href="#contact" data-link><?php echo $c['nav'][3]; ?></a>
        </nav>

        <div class="nav__actions">
            <div class="lang" data-lang>
                <button class="lang__btn" type="button" aria-haspopup="true" aria-expanded="false">
                    <span><?php echo strtoupper($lang); ?></span>
                    <svg viewBox="0 0 10 6" width="10" height="6" aria-hidden="true"><path d="M1 1l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
                </button>
                <ul class="lang__menu" role="menu">
                    <li><a href="?lang=es" role="menuitem" <?php echo $isES?'aria-current="true"':'';?>>ES — Español</a></li>
                    <li><a href="?lang=en" role="menuitem" <?php echo $isEN?'aria-current="true"':'';?>>EN — English</a></li>
                    <li><a href="?lang=de" role="menuitem" <?php echo $isDE?'aria-current="true"':'';?>>DE — Deutsch</a></li>
                </ul>
            </div>

            <button class="theme" id="themeToggle" type="button" aria-label="Toggle theme">
                <svg class="theme__sun" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><circle cx="12" cy="12" r="4" fill="currentColor"/><g stroke="currentColor" stroke-width="1.6"><line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/><line x1="4.5" y1="4.5" x2="6.5" y2="6.5"/><line x1="17.5" y1="17.5" x2="19.5" y2="19.5"/><line x1="4.5" y1="19.5" x2="6.5" y2="17.5"/><line x1="17.5" y1="6.5" x2="19.5" y2="4.5"/></g></svg>
                <svg class="theme__moon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z" fill="currentColor"/></svg>
            </button>

            <a href="#contact" class="btn btn--primary btn--sm" data-cta>
                <span><?php echo $c['nav_cta']; ?></span>
                <svg viewBox="0 0 16 16" width="14" height="14" aria-hidden="true"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
            </a>

            <button class="nav__burger" id="burger" aria-label="Menu">
                <span></span><span></span>
            </button>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero" id="hero">
        <div class="hero__media" aria-hidden="true">
            <img src="assets/images/hero.jpg" alt="" />
            <div class="hero__veil"></div>
            <div class="hero__scan"></div>
        </div>

        <div class="hero__eyebrow">
            <span class="mono"><?php echo $c['eyebrow']; ?></span>
        </div>

        <div class="hero__inner">
            <h1 class="hero__title">
                <span class="line"><span data-split><?php echo $c['hero_line_1']; ?></span></span>
                <span class="line"><span data-split><?php echo $c['hero_line_2']; ?></span></span>
            </h1>

            <p class="hero__lede"><?php echo $c['hero_lede']; ?></p>

            <div class="hero__cta">
                <a href="#contact" class="btn btn--primary">
                    <span><?php echo $c['cta_primary']; ?></span>
                    <svg viewBox="0 0 16 16" width="14" height="14" aria-hidden="true"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
                </a>
                <a href="#how" class="btn btn--ghost">
                    <span><?php echo $c['cta_secondary']; ?></span>
                </a>
            </div>

            <dl class="hero__stats mono">
                <div><dt><?php echo $c['stat_1_label']; ?></dt><dd><?php echo $c['stat_1_value']; ?></dd></div>
                <div><dt><?php echo $c['stat_2_label']; ?></dt><dd><?php echo $c['stat_2_value']; ?></dd></div>
                <div><dt><?php echo $c['stat_3_label']; ?></dt><dd><?php echo $c['stat_3_value']; ?></dd></div>
            </dl>
        </div>

        <a href="#how" class="hero__scroll" aria-label="Scroll">
            <span class="mono"><?php echo $c['scroll']; ?></span>
            <span class="hero__scroll-line"></span>
        </a>
    </section>

    <!-- MARQUEE -->
    <section class="band" aria-hidden="true">
        <div class="band__track">
            <?php for ($i = 0; $i < 2; $i++): foreach ($c['band'] as $k => $b): ?>
                <span><?php echo $b; ?></span><span class="band__sep">✦</span>
            <?php endforeach; endfor; ?>
        </div>
    </section>

    <!-- HOW IT WORKS (was: infrastructure) -->
    <section class="stack" id="how">
        <header class="section__head">
            <span class="section__index mono"><?php echo $c['sec1_index']; ?></span>
            <h2 class="section__title">
                <?php echo $c['sec1_title_a']; ?><br />
                <em><?php echo $c['sec1_title_em']; ?></em>
            </h2>
            <p class="section__lede"><?php echo $c['sec1_lede']; ?></p>
        </header>

        <div class="stack__pin">
            <div class="stack__scene" data-tilt>
                <div class="stack__layers">
                    <?php foreach ($c['stack'] as $i => $layer): ?>
                    <div class="stack__layer" data-layer="<?php echo $i; ?>">
                        <span class="mono"><?php echo $layer['mono']; ?></span>
                        <h3><?php echo $layer['h']; ?></h3>
                    </div>
                    <?php endforeach; ?>
                </div>
                <ol class="stack__progress" aria-hidden="true">
                    <?php foreach ($c['stack'] as $i => $layer): ?>
                        <li data-step="<?php echo $i; ?>">
                            <span class="stack__progress-num mono"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            <span class="stack__progress-label mono"><?php echo $layer['mono']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section class="products" id="products">
        <header class="section__head">
            <span class="section__index mono"><?php echo $c['sec2_index']; ?></span>
            <h2 class="section__title"><?php echo $c['sec2_title_a']; ?><em><?php echo $c['sec2_title_em']; ?></em></h2>
            <p class="section__lede"><?php echo $c['sec2_lede']; ?></p>
        </header>

        <div class="products__grid">
            <article class="product" data-product>
                <header class="product__head">
                    <span class="product__tag mono"><?php echo $c['prod_1_tag']; ?></span>
                    <h3 class="product__name"><?php echo $c['prod_1_name']; ?></h3>
                    <div class="product__price">
                        <span class="mono"><?php echo $c['prod_1_price_label']; ?></span>
                        <strong><?php echo $c['prod_1_price']; ?></strong>
                    </div>
                </header>
                <p class="product__desc"><?php echo $c['prod_1_desc']; ?></p>
                <ul class="product__list">
                    <?php foreach ($c['prod_1_list'] as $li): ?><li><?php echo $li; ?></li><?php endforeach; ?>
                </ul>
                <a class="product__cta" href="#contact"><span><?php echo $c['prod_cta']; ?></span><i></i></a>
            </article>

            <article class="product product--featured" data-product>
                <header class="product__head">
                    <span class="product__tag mono"><?php echo $c['prod_2_tag']; ?></span>
                    <span class="product__pill"><?php echo $c['prod_2_pill']; ?></span>
                    <h3 class="product__name"><?php echo $c['prod_2_name']; ?></h3>
                    <div class="product__price">
                        <span class="mono"><?php echo $c['prod_2_price_label']; ?></span>
                        <strong><?php echo $c['prod_2_price']; ?></strong>
                    </div>
                </header>
                <p class="product__desc"><?php echo $c['prod_2_desc']; ?></p>
                <ul class="product__list">
                    <?php foreach ($c['prod_2_list'] as $li): ?><li><?php echo $li; ?></li><?php endforeach; ?>
                </ul>
                <a class="product__cta" href="#contact"><span><?php echo $c['prod_cta']; ?></span><i></i></a>
            </article>

            <article class="product" data-product>
                <header class="product__head">
                    <span class="product__tag mono"><?php echo $c['prod_3_tag']; ?></span>
                    <h3 class="product__name"><?php echo $c['prod_3_name']; ?></h3>
                    <div class="product__price">
                        <span class="mono"><?php echo $c['prod_3_price_label']; ?></span>
                        <strong><?php echo $c['prod_3_price']; ?></strong>
                    </div>
                </header>
                <p class="product__desc"><?php echo $c['prod_3_desc']; ?></p>
                <ul class="product__list">
                    <?php foreach ($c['prod_3_list'] as $li): ?><li><?php echo $li; ?></li><?php endforeach; ?>
                </ul>
                <a class="product__cta" href="#contact"><span><?php echo $c['prod_cta']; ?></span><i></i></a>
            </article>
        </div>
    </section>

    <!-- MANIFESTO / Philosophy -->
    <section class="manifesto" id="manifesto">
        <div class="manifesto__sticky">
            <span class="section__index mono"><?php echo $c['sec3_index']; ?></span>
            <h2 class="manifesto__title">
                <?php foreach ($c['manifesto'] as $line): ?>
                    <span data-manifesto-line><?php echo $line; ?></span>
                <?php endforeach; ?>
            </h2>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact" id="contact">
        <div class="contact__inner">
            <div class="contact__copy">
                <span class="section__index mono"><?php echo $c['sec4_index']; ?></span>
                <h2 class="section__title"><?php echo $c['contact_title_a']; ?><br /><em><?php echo $c['contact_title_em']; ?></em></h2>
                <p class="section__lede"><?php echo $c['contact_lede']; ?></p>
                <ul class="contact__meta mono">
                    <?php foreach ($c['contact_meta'] as $row): ?>
                        <li>
                            <span><?php echo $row[0]; ?></span>
                            <?php if ($row[2]): ?><a href="mailto:<?php echo $row[1]; ?>"><?php echo $row[1]; ?></a>
                            <?php else: ?><span><?php echo $row[1]; ?></span><?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <form class="contact__form" id="briefingForm" novalidate
                  data-msg-ok="<?php echo htmlspecialchars($c['form']['ok'], ENT_QUOTES); ?>"
                  data-msg-err="<?php echo htmlspecialchars($c['form']['err'], ENT_QUOTES); ?>"
                  data-msg-invalid="<?php echo htmlspecialchars($c['form']['invalid'], ENT_QUOTES); ?>"
                  data-msg-sending="<?php echo $isES?'Enviando…':($isDE?'Senden…':'Sending…'); ?>">
                <div class="field">
                    <label for="cname"><?php echo $c['form']['name']; ?></label>
                    <input id="cname" name="name" type="text" required autocomplete="name" />
                </div>
                <div class="field">
                    <label for="ccompany"><?php echo $c['form']['company']; ?></label>
                    <input id="ccompany" name="company" type="text" autocomplete="organization" />
                </div>
                <div class="field">
                    <label for="cemail"><?php echo $c['form']['email']; ?></label>
                    <input id="cemail" name="email" type="email" required autocomplete="email" />
                </div>
                <div class="field">
                    <label for="cphone"><?php echo $c['form']['phone']; ?></label>
                    <input id="cphone" name="phone" type="tel" autocomplete="tel" />
                </div>
                <div class="field">
                    <label for="cmessage"><?php echo $c['form']['message']; ?></label>
                    <textarea id="cmessage" name="message" rows="4" required></textarea>
                </div>
                <label class="field field--check">
                    <input type="checkbox" required />
                    <span><?php echo $c['form']['consent']; ?></span>
                </label>
                <button type="submit" class="btn btn--primary btn--block">
                    <span><?php echo $c['form']['submit']; ?></span>
                    <svg viewBox="0 0 16 16" width="14" height="14" aria-hidden="true"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
                </button>
                <p class="contact__note mono" data-form-status></p>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="foot">
        <div class="foot__top">
            <div class="foot__brand">
                <img src="assets/images/fidora_whitebg.png" alt="Fidora Labs" class="nav__logo--dark" />
                <img src="assets/images/fidora_blackbg.png" alt="Fidora Labs" class="nav__logo--light" />
                <p><?php echo $c['foot_tag']; ?></p>
            </div>
            <nav class="foot__cols" aria-label="Footer">
                <?php foreach ($c['foot_cols'] as $col): ?>
                    <div>
                        <h4><?php echo $col[0]; ?></h4>
                        <?php foreach ($col[1] as $link): ?>
                            <a href="#"><?php echo $link; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
        </div>
        <div class="foot__bottom mono">
            <?php foreach ($c['foot_bottom'] as $b): ?><span><?php echo $b; ?></span><?php endforeach; ?>
        </div>
    </footer>

    <script src="assets/js/app.js?v=3"></script>
</body>
</html>
