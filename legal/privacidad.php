<?php
require_once __DIR__ . '/../assets/php/inc.php';

$key = 'privacidad';
$c = $legalCopy[$key][$lang];
$metaTitle = $c['title'] . ' — FIDORA Labs';
$metaDesc  = $isES
    ? 'Política de privacidad de FIDORA LABS LLC. Información sobre el tratamiento de datos personales según el RGPD.'
    : ($isEN
        ? 'FIDORA LABS LLC. privacy policy. Information on the processing of personal data under the GDPR.'
        : 'Datenschutzerklärung von FIDORA LABS LLC. Informationen zur Verarbeitung personenbezogener Daten gemäß DSGVO.');
$updated = $isES ? 'Última actualización: Junio 2026'
       : ($isEN ? 'Last updated: June 2026'
                : 'Zuletzt aktualisiert: Juni 2026');
?><!DOCTYPE html>
<html lang="<?php echo $lang; ?>" data-theme="dark">
<head>
<?php render_head($metaTitle, $metaDesc); ?>
</head>
<body>
    <div class="bg-grid" aria-hidden="true"></div>
    <div class="bg-noise" aria-hidden="true"></div>

    <?php render_nav(); ?>

    <article class="legal">
        <span class="legal__eyebrow mono"><?php echo $isES?'LEGAL · PRIVACIDAD':($isEN?'LEGAL · PRIVACY':'RECHT · DATENSCHUTZ'); ?></span>
        <h1 class="legal__title"><?php echo $c['title']; ?></h1>
        <p class="legal__intro"><?php echo $c['intro']; ?></p>
        <dl class="legal__facts">
            <?php foreach ($c['facts'] as $f): ?>
                <dt><?php echo $f[0]; ?></dt>
                <dd><?php echo $f[1]; ?></dd>
            <?php endforeach; ?>
        </dl>
        <?php foreach ($c['sections'] as $s): ?>
            <section class="legal__section">
                <?php if (!empty($s['h'])): ?><h2><?php echo $s['h']; ?></h2><?php endif; ?>
                <p><?php echo $s['p']; ?></p>
            </section>
        <?php endforeach; ?>
        <p class="legal__updated"><?php echo $updated; ?></p>
    </article>

    <?php render_foot(); ?>
    <?php render_cookies_banner(); ?>

    <script src="/assets/js/app.js?v=8"></script>
</body>
</html>
