<?php
// Language detection and loading
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_COOKIE['fidora_lang']) ? $_COOKIE['fidora_lang'] : 'es');

// Validate language
$validLangs = ['es', 'en', 'de'];
if (!in_array($lang, $validLangs)) {
    $lang = 'es';
}

// Set cookie
setcookie('fidora_lang', $lang, time() + (30 * 24 * 60 * 60), '/');

// Load translations
$translationsFile = __DIR__ . '/assets/i18n/' . $lang . '.json';
$translations = ['translations' => []];
if (file_exists($translationsFile)) {
    $jsonData = json_decode(file_get_contents($translationsFile), true);
    if (isset($jsonData['translations'])) {
        $translations = $jsonData['translations'];
    }
}

// Helper function to get translation
function t($key, $default = '') {
    global $translations;
    $keys = explode('.', $key);
    $value = $translations;
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default;
        }
    }
    return $value;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('hero.title', 'FIDORA Labs - Automatización Inteligente para tu Negocio'); ?></title>
    <meta name="description" content="<?php echo t('hero.description', 'FIDORA Labs - VozAI y automatización de WhatsApp. Respuestas en tiempo real, seguimiento automático y soluciones a medida para tu negocio.'); ?>">
    <meta name="keywords" content="FIDORA Labs, VozAI, automatización WhatsApp, respuestas automáticas, automatización a medida, IA conversacional">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://fidora.io/">
    <meta property="og:title" content="<?php echo t('hero.title', 'FIDORA Labs - Automatización Inteligente para tu Negocio'); ?>">
    <meta property="og:description" content="<?php echo t('hero.description', 'FIDORA Labs - VozAI y automatización de WhatsApp. Respuestas en tiempo real, seguimiento automático y soluciones a medida para tu negocio.'); ?>">
    <meta property="og:image" content="https://fidora.com/og-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://fidora.io/">
    <meta property="twitter:title" content="<?php echo t('hero.title', 'FIDORA Labs - Automatización Inteligente para tu Negocio'); ?>">
    <meta property="twitter:description" content="<?php echo t('hero.description', 'FIDORA Labs - VozAI y automatización de WhatsApp. Respuestas en tiempo real, seguimiento automático y soluciones a medida para tu negocio.'); ?>">
    <meta property="twitter:image" content="https://fidora.com/og-image.jpg">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/light-theme.css">
    
    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "FIDORA Labs",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web",
      "description": "FIDORA Labs - Automatización inteligente con IA conversacional e IA por WhatsApp. Respuestas en tiempo real y soluciones a medida para tu negocio.",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Consulta disponible"
      }
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="landing-nav">
        <div class="nav-container">
            <div class="nav-brand">
                <div class="logo">
                    <i class="fas fa-chart-network logo-icon"></i>
                    <div class="logo-text">
                        <div class="logo-name">FIDORA</div>
                        <div class="logo-tagline">AI LABS</div>
                    </div>
                </div>
            </div>
            
            <div class="nav-links">
                <a href="#features" class="nav-link"><?php echo t('nav.features', 'Características'); ?></a>
                <a href="#productos" class="nav-link"><?php echo t('nav.products', 'Productos'); ?></a>
                <a href="#testimonials" class="nav-link"><?php echo t('nav.testimonials', 'Testimonios'); ?></a>
                <a href="#faq" class="nav-link"><?php echo t('nav.faq', 'FAQ'); ?></a>
            </div>
            
            <div class="nav-actions">
                <div class="lang-selector">
                    <button class="lang-btn" id="langBtn" aria-label="Cambiar idioma">
                        <i class="fas fa-globe"></i>
                        <span class="lang-current"><?php echo strtoupper($lang); ?></span>
                    </button>
                    <div class="lang-dropdown" id="langDropdown">
                        <a href="?lang=es" class="lang-option <?php echo $lang === 'es' ? 'active' : ''; ?>" data-lang="es">
                            <span class="lang-flag">🇪🇸</span>
                            <span>Español</span>
                        </a>
                        <a href="?lang=en" class="lang-option <?php echo $lang === 'en' ? 'active' : ''; ?>" data-lang="en">
                            <span class="lang-flag">🇬🇧</span>
                            <span>English</span>
                        </a>
                        <a href="?lang=de" class="lang-option <?php echo $lang === 'de' ? 'active' : ''; ?>" data-lang="de">
                            <span class="lang-flag">🇩🇪</span>
                            <span>Deutsch</span>
                        </a>
                    </div>
                </div>
                <button class="theme-toggle" id="themeToggle" aria-label="Cambiar tema">
                    <i class="fas fa-sun"></i>
                </button>
                <button class="btn-primary" id="ctaBtn"><?php echo t('cta.requestDemo', 'Solicitar Demo'); ?></button>
            </div>
            
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            <a href="#features" class="mobile-nav-link"><?php echo t('nav.features', 'Características'); ?></a>
            <a href="#productos" class="mobile-nav-link"><?php echo t('nav.products', 'Productos'); ?></a>
            <a href="#testimonials" class="mobile-nav-link"><?php echo t('nav.testimonials', 'Testimonios'); ?></a>
            <a href="#faq" class="mobile-nav-link"><?php echo t('nav.faq', 'FAQ'); ?></a>
            
            <!-- Mobile Language Selector -->
            <div class="mobile-lang-selector">
                <span class="mobile-lang-label">Idioma / Language / Sprache</span>
                <div class="mobile-lang-options">
                    <a href="?lang=es" class="mobile-lang-option <?php echo $lang === 'es' ? 'active' : ''; ?>">🇪🇸 ES</a>
                    <a href="?lang=en" class="mobile-lang-option <?php echo $lang === 'en' ? 'active' : ''; ?>">🇬🇧 EN</a>
                    <a href="?lang=de" class="mobile-lang-option <?php echo $lang === 'de' ? 'active' : ''; ?>">🇩🇪 DE</a>
                </div>
            </div>
            
            <div class="mobile-menu-actions">
                <button class="btn-primary mobile-btn" id="mobileCtaBtn"><?php echo t('cta.requestDemo', 'Solicitar Demo'); ?></button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title" style="font-size: clamp(2rem, 4vw, 3rem);">
                    <?php echo t('hero.title', 'Deja de perder clientes por no responder a <span class="gradient-text">tiempo.</span>'); ?>
                </h1>
                
                <p class="hero-description">
                    <?php echo t('hero.description', 'Respuestas en tiempo real, seguimiento automático y soluciones a medida. Desarrollamos automatizaciones inteligentes que transforman tu forma de comunicarte con tus clientes.'); ?>
                </p>
                
                <div class="hero-cta">
                    <button class="btn-primary-large" id="heroCtaBtn">
                        <i class="fas fa-calendar"></i>
                        <?php echo t('cta.requestConsult', 'Solicitar Consulta'); ?>
                    </button>
                    <a href="#productos" class="btn-secondary-large" id="heroDemoBtn">
                        <i class="fas fa-cogs"></i>
                        <?php echo t('cta.viewServices', 'Ver Servicios'); ?>
                    </a>
                </div>
                
                <div class="hero-trust">
                    <span class="trust-text"><?php echo t('hero.trustText', 'Soluciones de automatización para empresas innovadoras.'); ?></span>
                    <div class="trust-badges">
                        <div class="trust-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" style="margin-right: 6px;">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            <i class="fas fa-shield-check" style="color: #dc3545;"></i>
                            <span><?php echo t('hero.security', 'Seguridad de grado Empresarial'); ?></span>
                        </div>
                        <div class="trust-badge">
                            <i class="fas fa-lock"></i>
                            <span><?php echo t('hero.gdpr', 'Cumple GDPR'); ?></span>
                        </div>
                        <div class="trust-badge">
                            <i class="fas fa-star"></i>
                            <span><?php echo t('hero.rating', 'Valoración 4.9/5'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="dashboard-preview">
                    <div class="preview-header">
                        <div class="preview-controls">
                            <div class="control-dot red"></div>
                            <div class="control-dot yellow"></div>
                            <div class="control-dot green"></div>
                        </div>
                        <div class="preview-title"><?php echo t('dashboard.title', 'Panel de Usuario'); ?></div>
                    </div>
                    <div class="preview-content">
                        <div class="preview-sidebar">
                            <div class="sidebar-item active">
                                <i class="fas fa-chart-line"></i>
                                <span><?php echo t('dashboard.sidebar.0', 'Panel'); ?></span>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-users"></i>
                                <span><?php echo t('dashboard.sidebar.1', 'Leads'); ?></span>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-phone"></i>
                                <span><?php echo t('dashboard.sidebar.2', 'Llamadas'); ?></span>
                            </div>
                            <div class="sidebar-item">
                                <i class="fab fa-whatsapp"></i>
                                <span><?php echo t('dashboard.sidebar.3', 'WhatsApp'); ?></span>
                            </div>
                        </div>
                        <div class="preview-main">
                            <div class="preview-kpis">
                                <div class="preview-kpi">
                                    <div class="kpi-value">1,247</div>
                                    <div class="kpi-label"><?php echo t('dashboard.kpis.0', 'Llamadas'); ?></div>
                                    <div class="kpi-trend positive"><?php echo t('dashboard.trends.0', '+32%'); ?></div>
                                </div>
                                <div class="preview-kpi">
                                    <div class="kpi-value">3,891</div>
                                    <div class="kpi-label"><?php echo t('dashboard.kpis.1', 'Mensajes'); ?></div>
                                    <div class="kpi-trend positive"><?php echo t('dashboard.trends.1', '+45%'); ?></div>
                                </div>
                            </div>
                            <div class="preview-chart">
                                <div class="chart-bars">
                                    <div class="chart-bar" style="height: 60%"></div>
                                    <div class="chart-bar" style="height: 80%"></div>
                                    <div class="chart-bar" style="height: 45%"></div>
                                    <div class="chart-bar" style="height: 90%"></div>
                                    <div class="chart-bar" style="height: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="floating-cards">
                    <div class="floating-card call-launched">
                        <div class="card-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-title"><?php echo t('dashboard.floating.callLaunched', 'Llamada Iniciada'); ?></div>
                            <div class="card-text"><?php echo t('dashboard.floating.callLaunchedDesc', 'IA contactando al lead en tiempo real'); ?></div>
                        </div>
                    </div>
                    
                    <div class="floating-card call-declined">
                        <div class="card-icon">
                            <i class="fas fa-phone-slash"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-title"><?php echo t('dashboard.floating.callDeclined', 'Llamada Rechazada'); ?></div>
                            <div class="card-text"><?php echo t('dashboard.floating.callDeclinedDesc', 'Activando WhatsApp automático'); ?></div>
                        </div>
                    </div>
                    
                    <div class="floating-card whatsapp-sent">
                        <div class="card-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-title"><?php echo t('dashboard.floating.whatsappSent', 'WhatsApp Enviado'); ?></div>
                            <div class="card-text"><?php echo t('dashboard.floating.whatsappSentDesc', 'Propiedades mandadas al cliente por WhatsApp'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section - Corporate Grade -->
    <section class="features-corporate" id="features">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-rocket"></i>
                    <span><?php echo t('features.badge', 'Características Potentes'); ?></span>
                </div>
                <h2 class="section-title"><?php echo t('features.title', 'Automatización Inteligente para tu Negocio'); ?></h2>
                <p class="section-description"><?php echo t('features.description', 'FIDORA Labs ofrece soluciones de automatización con IA que transforman la comunicación con tus clientes.'); ?></p>
            </div>
            
            <div class="features-corporate-grid">
                <!-- Feature 1: Análisis y Métricas -->
                <div class="feature-corporate-card">
                    <div class="feature-corporate-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-corporate-content">
                        <h3 class="feature-corporate-title"><?php echo t('features.analytics.title', 'Análisis y Métricas'); ?></h3>
                        <p class="feature-corporate-description"><?php echo t('features.analytics.description', 'Monitorea el rendimiento con dashboards en tiempo real y reportes detallados.'); ?></p>
                        <ul class="feature-corporate-list">
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.analytics.benefits.0', 'Métricas en tiempo real'); ?></li>
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.analytics.benefits.1', 'Reportes personalizados'); ?></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 2: Respuesta Instantánea -->
                <div class="feature-corporate-card">
                    <div class="feature-corporate-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="feature-corporate-content">
                        <h3 class="feature-corporate-title"><?php echo t('features.instant.title', 'Respuesta Instantánea'); ?></h3>
                        <p class="feature-corporate-description"><?php echo t('features.instant.description', 'Responde a tus clientes en menos de 1 minuto con automatizaciones 24/7.'); ?></p>
                        <ul class="feature-corporate-list">
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.instant.benefits.0', 'Disponibilidad 24/7'); ?></li>
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.instant.benefits.1', 'Tiempo de respuesta <1min'); ?></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Feature 3: Seguridad y Privacidad -->
                <div class="feature-corporate-card">
                    <div class="feature-corporate-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-corporate-content">
                        <h3 class="feature-corporate-title"><?php echo t('features.security.title', 'Seguridad y Privacidad'); ?></h3>
                        <p class="feature-corporate-description"><?php echo t('features.security.description', 'Protección de datos de nivel empresarial con encriptación y cumplimiento GDPR.'); ?></p>
                        <ul class="feature-corporate-list">
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.security.benefits.0', 'Encriptación de datos'); ?></li>
                            <li><i class="fas fa-check-circle"></i> <?php echo t('features.security.benefits.1', 'Cumple GDPR'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="social-proof" id="productos">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-box"></i>
                    <span><?php echo t('products.badge', 'Nuestros Productos'); ?></span>
                </div>
                <h2 class="section-title"><?php echo t('products.title', 'Soluciones de Automatización'); ?></h2>
                <p class="section-description"><?php echo t('products.description', 'FIDORA ofrece una suite completa de productos de automatización inteligente'); ?></p>
            </div>
            <div class="pricing-grid">
                <!-- Product 1: VozAI -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3 class="plan-name"><?php echo t('products.voiceAI.name', 'VozAI'); ?></h3>
                        <div class="plan-price">
                            <div style="font-size: 1.75rem; font-weight: 600; margin: 0.5rem 0;"><?php echo t('products.voiceAI.subtitle', 'Asistente de Voz IA'); ?></div>
                        </div>
                        <p class="plan-description"><?php echo t('products.voiceAI.description', 'Interacción por voz inteligente y natural'); ?></p>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.voiceAI.features.0', 'Procesamiento de lenguaje natural'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.voiceAI.features.1', 'Respuestas en tiempo real'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.voiceAI.features.2', 'Integración con sistemas'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.voiceAI.features.3', 'Disponibilidad 24/7'); ?></span>
                        </div>
                    </div>
                    <button class="btn-secondary-full"><?php echo t('cta.moreInfo', 'Más Información'); ?></button>
                </div>
                
                <!-- Product 2: WhatsApp Automation -->
                <div class="pricing-card popular">
                    <div class="popular-badge"><?php echo t('products.whatsapp.popular', 'Más Popular'); ?></div>
                    <div class="pricing-header">
                        <h3 class="plan-name"><?php echo t('products.whatsapp.name', 'WhatsApp Automation'); ?></h3>
                        <div class="plan-price">
                            <div style="font-size: 1.75rem; font-weight: 600; margin: 0.5rem 0;"><?php echo t('products.whatsapp.subtitle', 'Automatización WhatsApp'); ?></div>
                        </div>
                        <p class="plan-description"><?php echo t('products.whatsapp.description', 'Comunicación automática con clientes'); ?></p>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.whatsapp.features.0', 'Envío masivo personalizado'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.whatsapp.features.1', 'Respuestas automáticas'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.whatsapp.features.2', 'Seguimiento de propiedades'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.whatsapp.features.3', 'WhatsApp Business API'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.whatsapp.features.4', 'Métricas y análisis'); ?></span>
                        </div>
                    </div>
                    <button class="btn-primary-full"><?php echo t('cta.requestDemo', 'Solicitar Demo'); ?></button>
                </div>
                
                <!-- Product 3: Custom Solutions -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3 class="plan-name"><?php echo t('products.custom.name', 'Soluciones a Medida'); ?></h3>
                        <div class="plan-price">
                            <div style="font-size: 1.75rem; font-weight: 600; margin: 0.5rem 0;"><?php echo t('products.custom.subtitle', 'Automatizaciones a Medida'); ?></div>
                        </div>
                        <p class="plan-description"><?php echo t('products.custom.description', 'Automatizaciones diseñadas específicamente para ti'); ?></p>
                    </div>
                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.custom.features.0', 'Desarrollo personalizado'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.custom.features.1', 'Integración completa'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.custom.features.2', 'Soporte dedicado'); ?></span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span><?php echo t('products.custom.features.3', 'Escalabilidad garantizada'); ?></span>
                        </div>
                    </div>
                    <button class="btn-secondary-full"><?php echo t('cta.contact', 'Contactar'); ?></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-quote-left"></i>
                    <span><?php echo t('testimonials.badge', 'Historias de éxito'); ?></span>
                </div>
                <h2 class="section-title"><?php echo t('testimonials.title', 'Lo que Dicen Nuestros Clientes'); ?></h2>
                <p class="section-description"><?php echo t('testimonials.description', 'Descubre cómo empresas como la tuya están transformando su proceso de ventas con FIDORA.'); ?></p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote class="testimonial-text">
                        "La automatización de WhatsApp de FIDORA Labs transformó nuestra comunicación con clientes. Ahora respondemos en tiempo real y nuestros clientes están más satisfechos que nunca."
                    </blockquote>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face" alt="Carlos Martínez">
                        </div>
                        <div class="author-info">
                            <div class="author-name">Carlos Martínez</div>
                            <div class="author-title">Director Comercial, PropTech Solutions</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote class="testimonial-text">
                        "VozAI nos permite atender a nuestros clientes 24/7 sin aumentar costos. La calidad de las interacciones es sorprendente y nuestros clientes ni siquiera notan que es IA."
                    </blockquote>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Miguel Ángel Torres">
                        </div>
                        <div class="author-info">
                            <div class="author-name">Miguel Ángel Torres</div>
                            <div class="author-title">CEO, InmobiliariaPlus</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote class="testimonial-text">
                        "Las automatizaciones a medida que desarrolló FIDORA Labs se integraron perfectamente con nuestros sistemas. El ROI fue inmediato y el soporte es excepcional."
                    </blockquote>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=60&h=60&fit=crop&crop=face" alt="Laura Fernández">
                        </div>
                        <div class="author-info">
                            <div class="author-name">Laura Fernández</div>
                            <div class="author-title">Directora de Operaciones, TechVentures</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="section-container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-question-circle"></i>
                    <span><?php echo t('faq.badge', 'Preguntas Frecuentes'); ?></span>
                </div>
                <h2 class="section-title"><?php echo t('faq.title', 'Resolvemos tus Dudas'); ?></h2>
                <p class="section-description"><?php echo t('faq.description', 'Encuentra respuestas a las preguntas más comunes sobre nuestras soluciones de automatización.'); ?></p>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q1', '¿Qué es VozAI y cómo funciona?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a1', 'VozAI es nuestro asistente de voz inteligente que utiliza procesamiento de lenguaje natural para interactuar con tus clientes de forma conversacional y natural. Puede entender consultas complejas y proporcionar respuestas contextualmente relevantes, mejorando significativamente la experiencia del cliente.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q2', '¿Cómo se integra WhatsApp Automation?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a2', 'Utilizamos la API oficial de WhatsApp Business para automatizar mensajes, enviar propiedades y gestionar conversaciones de forma inteligente y personalizada. La integración es seamless con tus sistemas existentes y permite un control total sobre las conversaciones automatizadas.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q3', '¿Cuáles son los precios?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a3', 'Ofrecemos planes personalizados según tus necesidades específicas. Nuestros precios varían según el volumen de conversaciones, características requeridas y nivel de personalización. Contáctanos para una consulta gratuita y cotizaciones adaptadas a tu negocio.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q4', '¿Cuánto tiempo tarda la implementación?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a4', 'La implementación varía según la complejidad del proyecto. VozAI puede estar listo en 1-2 semanas, mientras que las soluciones a medida pueden tomar 4-8 semanas. Trabajamos contigo para establecer un cronograma realista y mantenerte informado durante todo el proceso.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q5', '¿Mis datos están seguros?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a5', 'Absolutamente. Utilizamos encriptación de nivel bancario y cumplimos con todas las normativas GDPR y de protección de datos europeas. Tu información está almacenada en servidores seguros y nunca compartimos datos con terceros sin tu consentimiento explícito.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q6', '¿Qué tipo de soporte ofrecen?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a6', 'Ofrecemos soporte 24/7, documentación completa, training personalizado y un gestor de cuenta dedicado para asegurar tu éxito. Nuestro equipo de expertos está disponible para resolver cualquier duda y optimizar continuamente tus automatizaciones.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q7', '¿Se puede personalizar según mi negocio?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a7', 'Sí, todas nuestras soluciones son altamente personalizables. Desarrollamos automatizaciones específicamente diseñadas para tu industria, procesos de trabajo y objetivos de negocio. Cada implementación se adapta perfectamente a tus necesidades únicas.'); ?></p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php echo t('faq.q8', '¿Funciona con mis sistemas actuales?'); ?></h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo t('faq.a8', 'Nuestras soluciones se integran con la mayoría de los sistemas empresariales comunes como CRM, ERP y herramientas de gestión. Realizamos una evaluación técnica previa para garantizar una integración seamless con tu infraestructura existente.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="section-container">
            <div class="cta-content">
                <h2 class="cta-title"><?php echo t('cta.title', '¿Listo para Automatizar tu Negocio?'); ?></h2>
                <p class="cta-description"><?php echo t('cta.description', 'Descubre cómo FIDORA Labs puede transformar tu comunicación con clientes mediante automatización inteligente.'); ?></p>
                <div class="cta-buttons">
                    <button class="btn-primary-large" id="finalCtaBtn">
                        <i class="fas fa-calendar"></i>
                        <?php echo t('cta.scheduleConsult', 'Solicitar Consulta Gratuita'); ?>
                    </button>
                    <a href="#productos" class="btn-secondary-large" id="finalDemoBtn">
                        <i class="fas fa-cogs"></i>
                        <?php echo t('cta.viewServices', 'Ver Servicios'); ?>
                    </a>
                </div>
                <div class="cta-note">
                    <i class="fas fa-info-circle"></i>
                    <span><?php echo t('cta.note', 'Consulta sin compromiso • Soluciones personalizadas • Soporte dedicado'); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="logo">
                            <i class="fas fa-chart-network logo-icon"></i>
                            <div class="logo-text">
                                <div class="logo-name">FIDORA</div>
                                <div class="logo-tagline">LABS</div>
                            </div>
                        </div>
                    </div>
                    <p class="footer-description">
                        Automatización inteligente para transformar tu negocio. <br>VozAI, WhatsApp y soluciones de IA a medida.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title"><?php echo t('footer.products', 'Productos'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="#">VozAI</a></li>
                        <li><a href="#">WhatsApp Automation</a></li>
                        <li><a href="#"><?php echo t('products.custom.subtitle', 'Automatizaciones a medida'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title"><?php echo t('footer.company', 'Empresa'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="#"><?php echo t('footer.about', 'Sobre Nosotros'); ?></a></li>
                        <li><a href="#"><?php echo t('footer.cases', 'Casos de Éxito'); ?></a></li>
                        <li><a href="#contact"><?php echo t('footer.contact', 'Contacto'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title"><?php echo t('footer.support', 'Soporte'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="#"><?php echo t('footer.help', 'Centro de Ayuda'); ?></a></li>
                        <li><a href="#"><?php echo t('footer.docs', 'Documentación'); ?></a></li>
                        <li><a href="#faq"><?php echo t('nav.faq', 'FAQ'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title"><?php echo t('footer.legal', 'Legal'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="privacy.html"><?php echo t('footer.privacy', 'Política de Privacidad'); ?></a></li>
                        <li><a href="#"><?php echo t('footer.terms', 'Términos de Servicio'); ?></a></li>
                        <li><a href="#"><?php echo t('footer.cookies', 'Política de Cookies'); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p class="copyright"><?php echo t('footer.copyright', '© 2025 FIDORA Labs. Todos los derechos reservados.'); ?></p>
                    <div class="footer-bottom-links">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Trial Signup Modal -->
    <div class="modal-overlay" id="trialModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title"><?php echo t('modal.trialTitle', 'Solicitar Consulta Gratuita'); ?></h3>
                <button class="modal-close" id="closeTrialModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-content">
                <div class="trial-benefits">
                    <div class="benefit-item">
                        <i class="fas fa-check"></i>
                        <span><?php echo t('modal.trialBenefits.0', 'Consulta sin compromiso'); ?></span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-check"></i>
                        <span><?php echo t('modal.trialBenefits.1', 'Soluciones personalizadas'); ?></span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-check"></i>
                        <span><?php echo t('modal.trialBenefits.2', 'Respuesta en 24 horas'); ?></span>
                    </div>
                </div>
                
                <form class="trial-form" id="trialForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName"><?php echo t('modal.form.firstName', 'Nombre'); ?></label>
                            <input type="text" id="firstName" name="firstName" required placeholder="Juan">
                        </div>
                        <div class="form-group">
                            <label for="lastName"><?php echo t('modal.form.lastName', 'Apellidos'); ?></label>
                            <input type="text" id="lastName" name="lastName" required placeholder="García">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="trialEmail"><?php echo t('modal.form.email', 'Email de Trabajo'); ?></label>
                        <input type="email" id="trialEmail" name="email" required placeholder="juan@empresa.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="company"><?php echo t('modal.form.company', 'Nombre de la Empresa'); ?></label>
                        <input type="text" id="company" name="company" required placeholder="Tu Empresa">
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label consent-checkbox checkbox-inline" style="display: flex; align-items: flex-start; gap: 8px; line-height: 1.4;">
                            <input type="checkbox" id="consent" name="consent" required style="margin: 0; margin-top: 2px;">
                            <span class="checkmark"></span>
                            <span class="consent-text" style="flex: 1; text-align: left; line-height: 1.4;"><?php echo t('modal.form.consent', 'Acepto la política de privacidad, soy mayor de 18 años y autorizo ser contactado mediante IA'); ?></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-primary-full">
                        <i class="fas fa-calendar"></i>
                        <?php echo t('modal.form.submit', 'Solicitar Consulta'); ?>
                    </button>
                </form>
                
                <div class="trial-footer">
                    <p class="trial-note">
                        <i class="fas fa-shield-check"></i>
                        <?php echo t('modal.trialNote', 'Tus datos están seguros y protegidos. Nunca compartimos tu información.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/landing.js"></script>
</body>
</html>
