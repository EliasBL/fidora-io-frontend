<?php
// Shared bootstrap for all Fidora pages.
// Provides: $lang, $isES, $isEN, $isDE, $copy, $legalCopy, $c, $navCopy, $theme.
// Renders: render_head(), render_nav(), render_foot(), render_cookies_banner(),
//          render_cookie_consent_js() — call at the right place.

if (!isset($COPY_LOADED)) {
    $COPY_LOADED = true;

    $lang = isset($_GET['lang'])
        ? $_GET['lang']
        : (isset($_COOKIE['fidora_lang']) ? $_COOKIE['fidora_lang'] : 'es');
    $validLangs = ['es', 'en', 'de'];
    if (!in_array($lang, $validLangs)) { $lang = 'es'; }
    $isES = $lang === 'es';
    $isEN = $lang === 'en';
    $isDE = $lang === 'de';
    setcookie('fidora_lang', $lang, time() + (30 * 24 * 60 * 60), '/');

    // ============================================================
    // UI copy (per page) — only the navigation/footer strings live
    // here. Page-specific copy is in the page itself.
    // ============================================================
    $navCopy = [
        'es' => [
            'nav'         => ['Cómo funciona', 'Productos', 'Filosofía', 'Hablemos'],
            'nav_cta'     => 'Reservar llamada',
            'foot_tag'    => 'Sistemas complejos que se sienten simples. Construidos en Europa.',
            'foot_cols'   => [
                ['Productos', ['VozAI', 'WhatsApp Engine', 'Labs']],
                ['Empresa',   ['Filosofía', 'Cómo funciona', 'Contacto']],
                ['Legal',     ['/legal/privacidad.php', '/legal/aviso-legal.php', '/legal/cookies.php']],
            ],
            'foot_legal'  => ['Privacidad', 'Aviso legal', 'Cookies'],
            'foot_bottom' => ['© ' . date('Y') . ' FIDORA LABS', 'CONSTRUIDO Y ALOJADO EN LA UE', 'v2.0 — EDICIÓN 2026'],
            'home_link'   => '/',
            'cookie_text' => 'Usamos cookies para entender cómo se usa el sitio y mejorarlo. Puedes aceptarlas, rechazarlas o configurarlas.',
            'cookie_accept' => 'Aceptar',
            'cookie_reject' => 'Rechazar',
            'cookie_settings' => 'Configurar',
            'cookie_prefs' => 'Preferencias de cookies',
            'cookie_essential' => 'Esenciales (siempre activas)',
            'cookie_essential_desc' => 'Necesarias para el funcionamiento básico del sitio.',
            'cookie_analytics' => 'Analítica',
            'cookie_analytics_desc' => 'Nos ayuda a entender el uso del sitio de forma anónima.',
            'cookie_marketing' => 'Marketing',
            'cookie_marketing_desc' => 'Para mostrar publicidad relevante.',
            'cookie_save' => 'Guardar preferencias',
        ],
        'en' => [
            'nav'         => ['How it works', 'Products', 'Philosophy', 'Let’s talk'],
            'nav_cta'     => 'Book a call',
            'foot_tag'    => 'Complex systems that feel simple. Built in Europe.',
            'foot_cols'   => [
                ['Products', ['VozAI', 'WhatsApp Engine', 'Labs']],
                ['Company',  ['Philosophy', 'How it works', 'Contact']],
                ['Legal',    ['/legal/privacidad.php', '/legal/aviso-legal.php', '/legal/cookies.php']],
            ],
            'foot_legal'  => ['Privacy', 'Legal notice', 'Cookies'],
            'foot_bottom' => ['© ' . date('Y') . ' FIDORA LABS LLC.', 'BUILT &amp; HOSTED IN THE EU', 'v2.0 — 2026 EDITION'],
            'home_link'   => '/',
            'cookie_text' => 'We use cookies to understand how the site is used and improve it. You can accept, reject or configure them.',
            'cookie_accept' => 'Accept',
            'cookie_reject' => 'Reject',
            'cookie_settings' => 'Configure',
            'cookie_prefs' => 'Cookie preferences',
            'cookie_essential' => 'Essential (always on)',
            'cookie_essential_desc' => 'Required for the site to function properly.',
            'cookie_analytics' => 'Analytics',
            'cookie_analytics_desc' => 'Helps us understand site usage anonymously.',
            'cookie_marketing' => 'Marketing',
            'cookie_marketing_desc' => 'Used to show relevant advertising.',
            'cookie_save' => 'Save preferences',
        ],
        'de' => [
            'nav'         => ['Wie es funktioniert', 'Produkte', 'Philosophie', 'Sprechen'],
            'nav_cta'     => 'Termin buchen',
            'foot_tag'    => 'Komplexe Systeme, die sich einfach anfühlen. Gebaut in Europa.',
            'foot_cols'   => [
                ['Produkte', ['VozAI', 'WhatsApp Engine', 'Labs']],
                ['Firma',    ['Philosophie', 'Wie es funktioniert', 'Kontakt']],
                ['Recht',    ['/legal/privacidad.php', '/legal/aviso-legal.php', '/legal/cookies.php']],
            ],
            'foot_legal'  => ['Datenschutz', 'Impressum', 'Cookies'],
            'foot_bottom' => ['© ' . date('Y') . ' FIDORA LABS LLC.', 'GEBAUT &amp; GEHOSTET IN DER EU', 'v2.0 — AUSGABE 2026'],
            'home_link'   => '/',
            'cookie_text' => 'Wir verwenden Cookies, um zu verstehen, wie die Website genutzt wird, und sie zu verbessern. Sie können sie akzeptieren, ablehnen oder konfigurieren.',
            'cookie_accept' => 'Akzeptieren',
            'cookie_reject' => 'Ablehnen',
            'cookie_settings' => 'Konfigurieren',
            'cookie_prefs' => 'Cookie-Einstellungen',
            'cookie_essential' => 'Essenziell (immer aktiv)',
            'cookie_essential_desc' => 'Notwendig für die grundlegende Funktion der Website.',
            'cookie_analytics' => 'Analyse',
            'cookie_analytics_desc' => 'Hilft uns, die Nutzung der Website anonym zu verstehen.',
            'cookie_marketing' => 'Marketing',
            'cookie_marketing_desc' => 'Wird verwendet, um relevante Werbung anzuzeigen.',
            'cookie_save' => 'Einstellungen speichern',
        ],
    ];
    $c = $navCopy[$lang];

    // ============================================================
    // LEGAL copy — vozai.es source (FIDORA LABS LLC. is the entity
    // behind both vozai.es and fidora.io). Texts reproduced verbatim
    // from the source, with the same contact data and addresses.
    // ============================================================
    $legalCopy = [
        'privacidad' => [
            'es' => [
                'title' => 'Política de Privacidad',
                'intro' => 'En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), el propietario de la web y responsable del tratamiento de sus datos, le informa lo siguiente:',
                'facts' => [
                    ['Denominación social', 'FIDORA LABS LLC.'],
                    ['Domicilio',          '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Teléfono de soporte', '+1 (641) 381-5971'],
                    ['Delegado en Protección de Datos', 'dpo@fidora.io'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Con los límites establecidos en la ley, FIDORA LABS LLC. no asume ninguna responsabilidad derivada de la falta de veracidad, integridad, actualización y precisión de los datos o informaciones que contienen sus páginas web.'],
                    ['h' => '', 'p' => 'Los contenidos e información no vinculan a FIDORA LABS LLC. ni constituyen opiniones, consejos o asesoramiento legal de ningún tipo pues se trata meramente de un servicio ofrecido con carácter informativo y divulgativo.'],
                    ['h' => '', 'p' => 'Las páginas de Internet de FIDORA LABS LLC. pueden contener enlaces (links) a otras páginas de terceras partes que FIDORA LABS LLC. no puede controlar. Por lo tanto, FIDORA LABS LLC. no puede asumir responsabilidades por el contenido que pueda aparecer en páginas de terceros.'],
                    ['h' => '', 'p' => 'Los textos, imágenes, sonidos, animaciones, software y el resto de contenidos incluidos en este website son propiedad exclusiva de FIDORA LABS LLC. o sus licenciantes. Cualquier acto de transmisión, distribución, cesión, reproducción, almacenamiento o comunicación pública total o parcial, deberá contar con el consentimiento expreso de FIDORA LABS LLC.'],
                    ['h' => 'Protección de datos de carácter personal según el RGPD', 'p' => 'FIDORA LABS LLC., en aplicación de la normativa vigente en materia de protección de datos de carácter personal, informa que los datos personales que se recogen a través de los formularios del Sitio web: https://vozai.es/, se incluyen en los ficheros automatizados específicos de usuarios de los servicios de FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'La recogida y tratamiento automatizado de los datos de carácter personal tiene como finalidad el mantenimiento de la relación comercial y el desempeño de tareas de información, formación, asesoramiento y otras actividades propias de FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'Estos datos únicamente serán cedidos a aquellas entidades que sean necesarias con el único objetivo de dar cumplimiento a la finalidad anteriormente expuesta.'],
                    ['h' => '', 'p' => 'FIDORA LABS LLC. adopta las medidas necesarias para garantizar la seguridad, integridad y confidencialidad de los datos conforme a lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de los mismos, y derogando la antigua LOPD, la nueva Ley Orgánica 3/2018, de 5 diciembre, de Protección de Datos y Garantía de los Derechos Digitales (LOPDGDD).'],
                    ['h' => '¿Dónde puedo ejercer mis derechos ARCO-POL?', 'p' => 'El usuario podrá en cualquier momento ejercitar los derechos ARCO-POL: de acceso, oposición, rectificación, cancelación, limitación y portabilidad reconocidos en el citado Reglamento (UE). El ejercicio de estos derechos puede realizarlo el propio usuario a través de email a: info@fidora.io o en la dirección: 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, o llamando al teléfono de soporte: +1 (641) 381-5971.'],
                    ['h' => '', 'p' => 'El usuario manifiesta que todos los datos facilitados por él son ciertos y correctos, y se compromete a mantenerlos actualizados, comunicando los cambios a FIDORA LABS LLC.'],
                    ['h' => 'Finalidad del tratamiento de los datos personales', 'p' => '¿Con qué finalidad trataremos tus datos personales?'],
                    ['h' => '', 'p' => 'En FIDORA LABS LLC., trataremos tus datos personales recabados a través del Sitio Web: https://vozai.es/, con las siguientes finalidades:'],
                    ['h' => '', 'p' => '— Dar cumplimiento de las obligaciones, comerciales, laborales, corporativas y contables de la empresa.<br>— Prestar sus servicios de acuerdo con las necesidades particulares de los clientes, con el fin de cumplir los contratos suscritos por la misma.<br>— Envío de información comercial y boletines sobre nuevos servicios ofrecidos en la web y del sector.<br>— Enviar información promocional vía electrónica.<br>— Facilitar la información solicitada por el usuario a través del formulario de contacto.'],
                    ['h' => '', 'p' => 'Te recordamos que puedes oponerte al envío de comunicaciones comerciales por cualquier vía y en cualquier momento, remitiendo un correo electrónico a la dirección anteriormente indicada.'],
                    ['h' => '', 'p' => 'Los campos de dichos registros son de cumplimentación obligatoria, siendo imposible realizar las finalidades expresadas si no se aportan esos datos.'],
                    ['h' => '¿Por cuánto tiempo se conservan los datos personales recabados?', 'p' => 'Los datos personales proporcionados se conservarán mientras se mantenga la relación comercial o no solicites su supresión y durante el plazo por el cuál pudieran derivarse responsabilidades legales por los servicios prestados.'],
                    ['h' => 'Legitimación', 'p' => 'El tratamiento de tus datos se realiza con las siguientes bases jurídicas que legitiman el mismo:'],
                    ['h' => '', 'p' => '— La solicitud de información y/o la contratación de los servicios de FIDORA LABS LLC., cuyos términos y condiciones se pondrán a tu disposición en todo caso, de forma previa a una eventual contratación.<br>— El consentimiento libre, específico, informado e inequívoco, en tanto que te informamos poniendo a tu disposición la presente política de privacidad, que, tras la lectura de la misma, en caso de estar conforme, puedes aceptar mediante una declaración o una clara acción afirmativa, como el marcado de una casilla dispuesta al efecto.'],
                    ['h' => '', 'p' => 'En caso de que no nos facilites tus datos o lo hagas de forma errónea o incompleta, no podremos atender tu solicitud, resultando del todo imposible proporcionarte la información solicitada o llevar a cabo la contratación de los servicios.'],
                    ['h' => 'Destinatarios de los datos', 'p' => 'Los datos no se comunicarán a ningún tercero ajeno a FIDORA LABS LLC., salvo obligación legal o proveedores de servicio relacionados con la relación contractual. Entre ellos podrían cederse a: autoridades y organismos competentes; terceros titulares de ficheros comunes de cumplimiento de obligaciones dinerarias; y terceros titulares de servicios o productos que el usuario voluntariamente solicite.'],
                    ['h' => 'Comunicaciones comerciales', 'p' => 'En aplicación de la LSSI. FIDORA LABS LLC. no enviará comunicaciones publicitarias o promocionales por correo electrónico u otro medio de comunicación electrónica equivalente que previamente no hubieran sido solicitadas o expresamente autorizadas por los destinatarios de las mismas.'],
                    ['h' => '', 'p' => 'En el caso de usuarios con los que exista una relación contractual previa, FIDORA LABS LLC. sí está autorizado al envío de comunicaciones comerciales referentes a productos o servicios de FIDORA LABS LLC. que sean similares a los que inicialmente fueron objeto de contratación con el cliente.'],
                    ['h' => '', 'p' => 'En todo caso, el usuario, tras acreditar su identidad, podrá solicitar que no se le haga llegar más información comercial a través de los canales de Atención al Cliente.'],
                ],
            ],
            'en' => [
                'title' => 'Privacy Policy',
                'intro' => 'In compliance with the duty to inform set out in Article 10 of Law 34/2002, of 11 July, on Information Society Services and Electronic Commerce (LSSICE), the owner of the website and data controller informs you of the following:',
                'facts' => [
                    ['Company name',     'FIDORA LABS LLC.'],
                    ['Registered office','1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support phone',    '+1 (641) 381-5971'],
                    ['Data Protection Officer', 'dpo@fidora.io'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Within the limits established by law, FIDORA LABS LLC. assumes no responsibility for the lack of truthfulness, completeness, updating and accuracy of the data or information contained in its web pages.'],
                    ['h' => '', 'p' => 'The content and information do not bind FIDORA LABS LLC. and do not constitute opinions, advice or legal counsel of any kind, as this is merely a service offered for information and disclosure purposes.'],
                    ['h' => '', 'p' => 'The FIDORA LABS LLC. website may contain links to other third-party pages that FIDORA LABS LLC. cannot control. Therefore, FIDORA LABS LLC. cannot assume responsibility for the content that may appear on third-party pages.'],
                    ['h' => '', 'p' => 'The texts, images, sounds, animations, software and the rest of the contents included in this website are the exclusive property of FIDORA LABS LLC. or its licensors. Any act of transmission, distribution, assignment, reproduction, storage or public communication, total or partial, must have the express consent of FIDORA LABS LLC.'],
                    ['h' => 'Personal data protection under the GDPR', 'p' => 'FIDORA LABS LLC., in application of current regulations on the protection of personal data, informs that the personal data collected through the forms on the Website: https://vozai.es/ are included in the specific automated files of users of the services of FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'The automated collection and processing of personal data has the purpose of maintaining the commercial relationship and carrying out information, training, advisory and other activities of FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'These data will only be transferred to those entities that are necessary for the sole purpose of fulfilling the purpose set out above.'],
                    ['h' => '', 'p' => 'FIDORA LABS LLC. adopts the necessary measures to guarantee the security, integrity and confidentiality of the data in accordance with Regulation (EU) 2016/679 of the European Parliament and of the Council, of 27 April 2016, on the protection of natural persons with regard to the processing of personal data and on the free movement of such data, repealing the old LOPD, and Organic Law 3/2018, of 5 December, on the Protection of Personal Data and the Guarantee of Digital Rights (LOPDGDD).'],
                    ['h' => 'Where can I exercise my ARCO-POL rights?', 'p' => 'The user may at any time exercise the ARCO-POL rights: access, opposition, rectification, cancellation, limitation and portability recognised in the aforementioned Regulation (EU). The user may exercise these rights by email to: info@fidora.io or at the address: 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, or by calling the support phone: +1 (641) 381-5971.'],
                    ['h' => '', 'p' => 'The user states that all data provided by them is true and correct, and undertakes to keep it up to date, communicating any changes to FIDORA LABS LLC.'],
                    ['h' => 'Purpose of the processing of personal data', 'p' => 'For what purposes will we process your personal data?'],
                    ['h' => '', 'p' => 'At FIDORA LABS LLC., we will process your personal data collected through the Website: https://vozai.es/ for the following purposes:'],
                    ['h' => '', 'p' => '— To fulfil the company’s commercial, labour, corporate and accounting obligations.<br>— To provide its services according to the particular needs of customers, in order to fulfil the contracts signed.<br>— Sending commercial information and newsletters about new services offered on the website and the sector.<br>— Sending promotional information electronically.<br>— Providing the information requested by the user through the contact form.'],
                    ['h' => '', 'p' => 'Please remember that you may object to the sending of commercial communications by any means and at any time, by sending an email to the address indicated above.'],
                    ['h' => '', 'p' => 'The fields in such records are mandatory, and it is impossible to carry out the stated purposes if these data are not provided.'],
                    ['h' => 'How long are the personal data collected kept?', 'p' => 'The personal data provided will be kept as long as the commercial relationship is maintained or you do not request its deletion, and for the period in which legal responsibilities for the services provided may arise.'],
                    ['h' => 'Legitimation', 'p' => 'The processing of your data is carried out on the following legal bases:'],
                    ['h' => '', 'p' => '— The request for information and/or the contracting of the services of FIDORA LABS LLC., whose terms and conditions will be made available to you in any case, prior to any contracting.<br>— The free, specific, informed and unequivocal consent, since we inform you by making this privacy policy available, which, after reading it, if you agree, you can accept by means of a declaration or a clear affirmative action, such as ticking a box provided for that purpose.'],
                    ['h' => '', 'p' => 'If you do not provide us with your data, or do so incorrectly or incompletely, we will not be able to deal with your request, making it completely impossible to provide you with the information requested or carry out the contracting of the services.'],
                    ['h' => 'Recipients of the data', 'p' => 'The data will not be communicated to any third party outside FIDORA LABS LLC., except under legal obligation or service providers related to the contractual relationship. Among them, data may be transferred to: competent authorities and bodies; third parties holding common files for compliance with monetary obligations; and third parties providing services or products voluntarily requested by the user.'],
                    ['h' => 'Commercial communications', 'p' => 'In application of the LSSI, FIDORA LABS LLC. will not send advertising or promotional communications by email or any other equivalent electronic means that have not previously been requested or expressly authorised by the recipients.'],
                    ['h' => '', 'p' => 'In the case of users with whom there is a prior contractual relationship, FIDORA LABS LLC. is authorised to send commercial communications regarding products or services of FIDORA LABS LLC. that are similar to those that were initially the subject of contracting with the customer.'],
                    ['h' => '', 'p' => 'In any case, the user, after proving their identity, may request that they no longer receive commercial information through the Customer Service channels.'],
                ],
            ],
            'de' => [
                'title' => 'Datenschutzerklärung',
                'intro' => 'In Erfüllung der Informationspflicht gemäß Artikel 10 des Gesetzes 34/2002 vom 11. Juli über Dienste der Informationsgesellschaft und des elektronischen Geschäftsverkehrs (LSSICE) informiert der Inhaber der Website und Verantwortliche für die Datenverarbeitung Sie über Folgendes:',
                'facts' => [
                    ['Firmenname',       'FIDORA LABS LLC.'],
                    ['Sitz',             '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support-Telefon',  '+1 (641) 381-5971'],
                    ['Datenschutzbeauftragter', 'dpo@fidora.io'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Innerhalb der gesetzlichen Grenzen übernimmt FIDORA LABS LLC. keine Verantwortung für die mangelnde Wahrhaftigkeit, Vollständigkeit, Aktualisierung und Genauigkeit der auf den Webseiten enthaltenen Daten oder Informationen.'],
                    ['h' => '', 'p' => 'Die Inhalte und Informationen sind für FIDORA LABS LLC. nicht verbindlich und stellen keine Meinungen, Ratschläge oder Rechtsberatung jeglicher Art dar, da es sich lediglich um einen zu Informations- und Verbreitungszwecken angebotenen Dienst handelt.'],
                    ['h' => '', 'p' => 'Die Webseiten von FIDORA LABS LLC. können Links zu anderen Seiten Dritter enthalten, die FIDORA LABS LLC. nicht kontrollieren kann. Daher kann FIDORA LABS LLC. keine Verantwortung für die Inhalte auf Seiten Dritter übernehmen.'],
                    ['h' => '', 'p' => 'Die Texte, Bilder, Klänge, Animationen, Software und alle übrigen Inhalte auf dieser Website sind ausschließliches Eigentum von FIDORA LABS LLC. oder seiner Lizenzgeber. Jede Übertragung, Verbreitung, Abtretung, Vervielfältigung, Speicherung oder öffentliche Wiedergabe, ganz oder teilweise, bedarf der ausdrücklichen Zustimmung von FIDORA LABS LLC.'],
                    ['h' => 'Schutz personenbezogener Daten gemäß DSGVO', 'p' => 'FIDORA LABS LLC. informiert in Anwendung der geltenden Vorschriften zum Schutz personenbezogener Daten, dass die über die Formulare der Website https://vozai.es/ erhobenen personenbezogenen Daten in die spezifischen automatisierten Dateien der Nutzer der Dienste von FIDORA LABS LLC. aufgenommen werden.'],
                    ['h' => '', 'p' => 'Die automatisierte Erhebung und Verarbeitung personenbezogener Daten dient der Aufrechterhaltung der Geschäftsbeziehung und der Durchführung von Informations-, Schulungs-, Beratungs- und sonstigen Tätigkeiten von FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'Diese Daten werden ausschließlich an die Stellen übermittelt, die zur Erfüllung des oben genannten Zwecks erforderlich sind.'],
                    ['h' => '', 'p' => 'FIDORA LABS LLC. ergreift die notwendigen Maßnahmen, um die Sicherheit, Integrität und Vertraulichkeit der Daten gemäß der Verordnung (EU) 2016/679 des Europäischen Parlaments und des Rates vom 27. April 2016 und dem Organgesetz 3/2018 vom 5. Dezember zum Schutz personenbezogener Daten und zur Gewährleistung digitaler Rechte (LOPDGDD) zu gewährleisten.'],
                    ['h' => 'Wo kann ich meine ARCO-POL-Rechte ausüben?', 'p' => 'Der Nutzer kann jederzeit die in der genannten Verordnung (EU) anerkannten Rechte ARCO-POL ausüben: Auskunft, Widerspruch, Berichtigung, Löschung, Einschränkung und Datenübertragbarkeit. Die Ausübung dieser Rechte kann der Nutzer per E-Mail an info@fidora.io oder unter der Adresse 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, oder telefonisch unter +1 (641) 381-5971 vornehmen.'],
                    ['h' => '', 'p' => 'Der Nutzer erklärt, dass alle von ihm angegebenen Daten wahr und korrekt sind, und verpflichtet sich, diese aktuell zu halten und Änderungen FIDORA LABS LLC. mitzuteilen.'],
                    ['h' => 'Zweck der Verarbeitung personenbezogener Daten', 'p' => 'Zu welchen Zwecken verarbeiten wir Ihre personenbezogenen Daten?'],
                    ['h' => '', 'p' => 'Bei FIDORA LABS LLC. verarbeiten wir Ihre über die Website https://vozai.es/ erhobenen personenbezogenen Daten zu folgenden Zwecken:'],
                    ['h' => '', 'p' => '— Erfüllung der kommerziellen, arbeitsrechtlichen, unternehmens- und buchhalterischen Verpflichtungen des Unternehmens.<br>— Erbringung seiner Dienstleistungen gemäß den besonderen Bedürfnissen der Kunden.<br>— Versand kommerzieller Informationen und Newsletter über neue Dienstleistungen.<br>— Versand von Werbeinformationen auf elektronischem Weg.<br>— Bereitstellung der vom Nutzer über das Kontaktformular angeforderten Informationen.'],
                    ['h' => '', 'p' => 'Bitte beachten Sie, dass Sie dem Versand kommerzieller Mitteilungen jederzeit widersprechen können, indem Sie eine E-Mail an die oben genannte Adresse senden.'],
                    ['h' => '', 'p' => 'Die Felder dieser Register sind Pflichtfelder; ohne diese Daten ist die Umsetzung der genannten Zwecke nicht möglich.'],
                    ['h' => 'Wie lange werden die erhobenen personenbezogenen Daten aufbewahrt?', 'p' => 'Die zur Verfügung gestellten personenbezogenen Daten werden so lange aufbewahrt, wie die Geschäftsbeziehung besteht oder Sie deren Löschung nicht verlangen, sowie für den Zeitraum, in dem sich aus den erbrachten Dienstleistungen rechtliche Verantwortlichkeiten ergeben können.'],
                    ['h' => 'Rechtsgrundlage', 'p' => 'Die Verarbeitung Ihrer Daten erfolgt auf folgenden Rechtsgrundlagen:'],
                    ['h' => '', 'p' => '— Anfrage nach Informationen und/oder Vertragsabschluss über die Dienste von FIDORA LABS LLC.<br>— Die freie, spezifische, informierte und eindeutige Einwilligung.'],
                    ['h' => '', 'p' => 'Wenn Sie uns Ihre Daten nicht oder fehlerhaft oder unvollständig zur Verfügung stellen, können wir Ihre Anfrage nicht bearbeiten.'],
                    ['h' => 'Empfänger der Daten', 'p' => 'Die Daten werden nicht an Dritte außerhalb von FIDORA LABS LLC. weitergegeben, es sei denn, dies ist gesetzlich vorgeschrieben.'],
                    ['h' => 'Werbemeldungen', 'p' => 'In Anwendung des LSSI wird FIDORA LABS LLC. keine Werbe- oder Promotionsmitteilungen per E-Mail versenden, die nicht zuvor von den Empfängern angefordert oder ausdrücklich genehmigt wurden.'],
                    ['h' => '', 'p' => 'Bei Nutzern, mit denen eine vorherige Vertragsbeziehung besteht, ist FIDORA LABS LLC. berechtigt, Werbemitteilungen über Produkte oder Dienstleistungen von FIDORA LABS LLC. zu versenden.'],
                    ['h' => '', 'p' => 'Der Nutzer kann jederzeit verlangen, keine weiteren kommerziellen Informationen mehr zu erhalten.'],
                ],
            ],
        ],
        'cookies' => [
            'es' => [
                'title' => 'Política de Cookies',
                'intro' => 'Esta Política de Cookies es parte de la Política de Privacidad de FIDORA LABS LLC. El acceso y la navegación en el sitio, o el uso de los servicios del mismo, implican la aceptación de las condiciones generales recogidas en nuestro Aviso Legal y en nuestra Política de Privacidad.',
                'facts' => [
                    ['Denominación social', 'FIDORA LABS LLC.'],
                    ['Domicilio',          '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Teléfono de soporte', '+1 (641) 381-5971'],
                    ['Email',              'info@fidora.io'],
                ],
                'sections' => [
                    ['h' => '1. ¿Qué son las Cookies?', 'p' => 'Las cookies son pequeños archivos de texto que los sitios web colocan en tu dispositivo para almacenar información sobre tus preferencias, mejorar tu experiencia y ayudar a los sitios web a funcionar de manera más eficiente.'],
                    ['h' => '2. Tipos de Cookies que Utilizamos', 'p' => 'A continuación describimos las categorías de cookies que podemos usar:'],
                    ['h' => 'Cookies Esenciales', 'p' => 'Necesarias para el funcionamiento básico del sitio web. Estas cookies permiten funciones básicas como la navegación por páginas y el acceso a áreas seguras del sitio web. El sitio web no puede funcionar correctamente sin estas cookies.'],
                    ['h' => 'Cookies de Rendimiento', 'p' => 'Nos ayudan a entender cómo interactúas con el sitio web, recopilando información de forma anónima.'],
                    ['h' => 'Cookies de Funcionalidad', 'p' => 'Permiten recordar tus preferencias y opciones, como tu idioma preferido o la región en la que te encuentras.'],
                    ['h' => 'Cookies de Marketing', 'p' => 'Utilizadas para mostrar publicidad relevante y medir su efectividad.'],
                    ['h' => '3. Control de Cookies', 'p' => 'Puedes controlar y/o eliminar las cookies según desees. Tienes el control total sobre las cookies que se instalan en tu dispositivo. Gestiona tus preferencias en el banner de cookies de este sitio.'],
                    ['h' => '4. Cookies de Terceros', 'p' => 'Algunas cookies son establecidas por servicios de terceros que aparecen en nuestras páginas. FIDORA LABS LLC. no controla estas cookies de terceros y te recomendamos que consultes las políticas de privacidad de estos servicios externos: Google Analytics, redes sociales, procesamiento de pagos, etc.'],
                    ['h' => '5. Duración de las Cookies', 'p' => 'Las cookies pueden ser de sesión (temporales, se eliminan al cerrar el navegador) o persistentes (permanecen en tu dispositivo hasta que las elimines manualmente).'],
                    ['h' => '6. Actualizaciones de la Política', 'p' => 'FIDORA LABS LLC. puede actualizar esta política de cookies ocasionalmente para reflejar cambios en las cookies que utilizamos o por otras razones operativas, legales o reglamentarias. Te recomendamos revisarla periódicamente. La fecha de la última actualización se indica al final de esta política.'],
                    ['h' => '7. Más Información', 'p' => 'Si tienes alguna pregunta sobre nuestra Política de Cookies, puedes contactarnos en legal@fidora.io, por teléfono al +1 (641) 381-5971, o por correo postal a 1301 N Broadway STE 32349, Los Angeles, CA 90012 US.'],
                ],
            ],
            'en' => [
                'title' => 'Cookie Policy',
                'intro' => 'This Cookie Policy is part of the Privacy Policy of FIDORA LABS LLC. Accessing and browsing the site, or using its services, implies acceptance of the general conditions set out in our Legal Notice and in our Privacy Policy.',
                'facts' => [
                    ['Company name',      'FIDORA LABS LLC.'],
                    ['Registered office','1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support phone',     '+1 (641) 381-5971'],
                    ['Email',             'info@fidora.io'],
                ],
                'sections' => [
                    ['h' => '1. What are Cookies?', 'p' => 'Cookies are small text files that websites place on your device to store information about your preferences, improve your experience and help websites work more efficiently.'],
                    ['h' => '2. Types of Cookies We Use', 'p' => 'The categories of cookies we may use are described below.'],
                    ['h' => 'Essential Cookies', 'p' => 'Required for the site to function properly. The site cannot function correctly without these cookies.'],
                    ['h' => 'Performance Cookies', 'p' => 'Help us understand how you interact with the website by collecting information anonymously.'],
                    ['h' => 'Functionality Cookies', 'p' => 'Allow us to remember your preferences and choices, such as your preferred language or region.'],
                    ['h' => 'Marketing Cookies', 'p' => 'Used to show relevant advertising and measure its effectiveness.'],
                    ['h' => '3. Cookie Control', 'p' => 'You can control and/or delete cookies as you wish. You have full control over the cookies installed on your device. Manage your preferences in the cookie banner on this site.'],
                    ['h' => '4. Third-Party Cookies', 'p' => 'Some cookies are set by third-party services that appear on our pages. FIDORA LABS LLC. does not control these third-party cookies and recommends consulting the privacy policies of those external services (Google Analytics, social networks, payment processors, etc.).'],
                    ['h' => '5. Cookie Duration', 'p' => 'Cookies may be session cookies (temporary, deleted when you close the browser) or persistent (remain on your device until you delete them manually).'],
                    ['h' => '6. Policy Updates', 'p' => 'FIDORA LABS LLC. may update this cookie policy occasionally. The date of the last update is indicated at the bottom of this policy.'],
                    ['h' => '7. More Information', 'p' => 'If you have any questions about our Cookie Policy, contact us at legal@fidora.io, by phone at +1 (641) 381-5971, or by post at 1301 N Broadway STE 32349, Los Angeles, CA 90012 US.'],
                ],
            ],
            'de' => [
                'title' => 'Cookie-Richtlinie',
                'intro' => 'Diese Cookie-Richtlinie ist Teil der Datenschutzerklärung von FIDORA LABS LLC. Der Zugriff auf und die Nutzung der Website setzen die Annahme der in unserem Impressum und unserer Datenschutzerklärung enthaltenen allgemeinen Bedingungen voraus.',
                'facts' => [
                    ['Firmenname',     'FIDORA LABS LLC.'],
                    ['Sitz',           '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support-Telefon','+1 (641) 381-5971'],
                    ['E-Mail',         'info@fidora.io'],
                ],
                'sections' => [
                    ['h' => '1. Was sind Cookies?', 'p' => 'Cookies sind kleine Textdateien, die Websites auf Ihrem Gerät platzieren, um Informationen über Ihre Präferenzen zu speichern, Ihre Erfahrung zu verbessern und Websites effizienter zu machen.'],
                    ['h' => '2. Arten von Cookies, die wir verwenden', 'p' => 'Nachfolgend beschreiben wir die Kategorien von Cookies, die wir verwenden können.'],
                    ['h' => 'Essenzielle Cookies', 'p' => 'Erforderlich für das ordnungsgemäße Funktionieren der Website.'],
                    ['h' => 'Leistungs-Cookies', 'p' => 'Helfen uns zu verstehen, wie Sie mit der Website interagieren.'],
                    ['h' => 'Funktionalitäts-Cookies', 'p' => 'Ermöglichen das Speichern Ihrer Präferenzen.'],
                    ['h' => 'Marketing-Cookies', 'p' => 'Werden verwendet, um relevante Werbung anzuzeigen.'],
                    ['h' => '3. Cookie-Kontrolle', 'p' => 'Sie können Cookies nach Wunsch steuern und/oder löschen. Verwalten Sie Ihre Einstellungen im Cookie-Banner dieser Website.'],
                    ['h' => '4. Cookies von Drittanbietern', 'p' => 'Einige Cookies werden von Drittanbieterdiensten gesetzt. FIDORA LABS LLC. kontrolliert diese Cookies nicht.'],
                    ['h' => '5. Cookie-Dauer', 'p' => 'Cookies können Sitzungs-Cookies (temporär) oder persistente Cookies (dauerhaft) sein.'],
                    ['h' => '6. Aktualisierungen der Richtlinie', 'p' => 'FIDORA LABS LLC. kann diese Cookie-Richtlinie gelegentlich aktualisieren.'],
                    ['h' => '7. Weitere Informationen', 'p' => 'Bei Fragen kontaktieren Sie uns bitte unter legal@fidora.io, telefonisch unter +1 (641) 381-5971 oder per Post an 1301 N Broadway STE 32349, Los Angeles, CA 90012 US.'],
                ],
            ],
        ],
        'aviso-legal' => [
            'es' => [
                'title' => 'Aviso Legal',
                'intro' => 'En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), el propietario de la web, le informa de lo siguiente:',
                'facts' => [
                    ['Denominación social', 'FIDORA LABS LLC.'],
                    ['Domicilio',          '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Teléfono de soporte', '+1 (641) 381-5971'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Con los límites establecidos en la ley, FIDORA LABS LLC. no asume ninguna responsabilidad derivada de la falta de veracidad, integridad, actualización y precisión de los datos o informaciones que contienen sus páginas web.'],
                    ['h' => '', 'p' => 'Los contenidos e información no vinculan a FIDORA LABS LLC. ni constituyen opiniones, consejos o asesoramiento legal de ningún tipo pues se trata meramente de un servicio ofrecido con carácter informativo y divulgativo.'],
                    ['h' => '', 'p' => 'Las páginas de Internet de FIDORA LABS LLC. pueden contener enlaces (links) a otras páginas de terceras partes que FIDORA LABS LLC. no puede controlar. Por lo tanto, FIDORA LABS LLC. no puede asumir responsabilidades por el contenido que pueda aparecer en páginas de terceros.'],
                    ['h' => '', 'p' => 'Los textos, imágenes, sonidos, animaciones, software y el resto de contenidos incluidos en este website son propiedad exclusiva de FIDORA LABS LLC. o sus licenciantes. Cualquier acto de transmisión, distribución, cesión, reproducción, almacenamiento o comunicación pública total o parcial, deberá contar con el consentimiento expreso de FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'Asimismo, para acceder a algunos de los servicios que FIDORA LABS LLC. ofrece a través del sitio web, deberá proporcionar algunos datos de carácter personal. En cumplimiento de lo establecido en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos le informamos que, mediante la cumplimentación de los presentes formularios, sus datos personales quedarán incorporados y serán tratados en los ficheros de FIDORA LABS LLC. con el fin de poderle prestar y ofrecer nuestros servicios así como para informarle de las mejoras del sitio Web.'],
                    ['h' => '', 'p' => 'Le informamos también de que tendrá la posibilidad en todo momento de ejercer los derechos de acceso, rectificación, cancelación, oposición, limitación y portabilidad de sus datos de carácter personal, de manera gratuita mediante email a: info@fidora.io o en la dirección: 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, o llamando al teléfono de soporte: +1 (641) 381-5971.'],
                ],
            ],
            'en' => [
                'title' => 'Legal Notice',
                'intro' => 'In compliance with the duty to inform set out in Article 10 of Law 34/2002, of 11 July, on Information Society Services and Electronic Commerce (LSSICE), the owner of the website informs you of the following:',
                'facts' => [
                    ['Company name',      'FIDORA LABS LLC.'],
                    ['Registered office','1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support phone',     '+1 (641) 381-5971'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Within the limits established by law, FIDORA LABS LLC. assumes no responsibility for the lack of truthfulness, completeness, updating and accuracy of the data or information contained in its web pages.'],
                    ['h' => '', 'p' => 'The content and information do not bind FIDORA LABS LLC. and do not constitute opinions, advice or legal counsel of any kind, as this is merely a service offered for information and disclosure purposes.'],
                    ['h' => '', 'p' => 'The FIDORA LABS LLC. website may contain links to other third-party pages that FIDORA LABS LLC. cannot control. Therefore, FIDORA LABS LLC. cannot assume responsibility for the content that may appear on third-party pages.'],
                    ['h' => '', 'p' => 'The texts, images, sounds, animations, software and the rest of the contents included in this website are the exclusive property of FIDORA LABS LLC. or its licensors. Any act of transmission, distribution, assignment, reproduction, storage or public communication, total or partial, must have the express consent of FIDORA LABS LLC.'],
                    ['h' => '', 'p' => 'Likewise, to access some of the services offered by FIDORA LABS LLC. through the website, you must provide some personal data. In compliance with Regulation (EU) 2016/679 of the European Parliament and of the Council, of 27 April 2016, on the protection of natural persons with regard to the processing of personal data and on the free movement of such data, we inform you that, by completing these forms, your personal data will be incorporated and processed in the files of FIDORA LABS LLC. in order to provide and offer our services as well as to inform you of improvements to the Website.'],
                    ['h' => '', 'p' => 'We also inform you that you will have the possibility at all times to exercise the rights of access, rectification, cancellation, opposition, limitation and portability of your personal data, free of charge, by email to: info@fidora.io or at the address: 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, or by calling the support phone: +1 (641) 381-5971.'],
                ],
            ],
            'de' => [
                'title' => 'Impressum',
                'intro' => 'In Erfüllung der Informationspflicht gemäß Artikel 10 des Gesetzes 34/2002 vom 11. Juli über Dienste der Informationsgesellschaft und des elektronischen Geschäftsverkehrs (LSSICE) informiert der Inhaber der Website Sie über Folgendes:',
                'facts' => [
                    ['Firmenname',   'FIDORA LABS LLC.'],
                    ['Sitz',         '1301 N Broadway STE 32349, Los Angeles, CA 90012 US'],
                    ['Support-Telefon','+1 (641) 381-5971'],
                ],
                'sections' => [
                    ['h' => '', 'p' => 'Innerhalb der gesetzlichen Grenzen übernimmt FIDORA LABS LLC. keine Verantwortung für die mangelnde Wahrhaftigkeit, Vollständigkeit, Aktualisierung und Genauigkeit der Daten oder Informationen auf ihren Webseiten.'],
                    ['h' => '', 'p' => 'Die Inhalte und Informationen sind für FIDORA LABS LLC. nicht verbindlich und stellen keine Meinungen, Ratschläge oder Rechtsberatung jeglicher Art dar.'],
                    ['h' => '', 'p' => 'Die Webseiten von FIDORA LABS LLC. können Links zu anderen Seiten Dritter enthalten, für deren Inhalt FIDORA LABS LLC. keine Verantwortung übernimmt.'],
                    ['h' => '', 'p' => 'Die Texte, Bilder, Klänge, Animationen, Software und alle übrigen Inhalte auf dieser Website sind ausschließliches Eigentum von FIDORA LABS LLC. oder seiner Lizenzgeber.'],
                    ['h' => '', 'p' => 'Um einige der Dienste von FIDORA LABS LLC. zu nutzen, müssen Sie personenbezogene Daten angeben. Gemäß der Verordnung (EU) 2016/679 werden Ihre Daten in die Dateien von FIDORA LABS LLC. aufgenommen, um unsere Dienste anzubieten.'],
                    ['h' => '', 'p' => 'Sie können Ihre Rechte auf Auskunft, Berichtigung, Löschung, Widerspruch, Einschränkung und Übertragbarkeit jederzeit kostenlos per E-Mail an info@fidora.io, unter der Adresse 1301 N Broadway STE 32349, Los Angeles, CA 90012 US, oder telefonisch unter +1 (641) 381-5971 ausüben.'],
                ],
            ],
        ],
    ];
}

/* ---------- Head ---------- */
function render_head(string $title, string $desc, string $pageClass = '') {
    global $lang, $c, $navCopy;
    $nc = $navCopy[$lang];
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="theme-color" content="#000000" />
    <title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($desc, ENT_QUOTES); ?>" />
    <link rel="icon" type="image/png" href="/assets/images/fidora_whitebg.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/app.css?v=12" />
    <?php
}

/* ---------- Nav (always anchors to home / one-pager) ---------- */
function render_nav() {
    global $lang, $c, $navCopy;
    $nc = $navCopy[$lang];
    $isES = $lang === 'es';
    $isEN = $lang === 'en';
    $isDE = $lang === 'de';
    ?>
    <header class="nav" id="nav">
        <a href="/" class="nav__brand" aria-label="Fidora Labs">
            <img src="/assets/images/fidora_whitebg.png" alt="" class="nav__logo nav__logo--dark" />
            <img src="/assets/images/fidora_blackbg.png" alt="" class="nav__logo nav__logo--light" />
            <span class="nav__wordmark">FIDORA<span class="nav__wordmark-dot">.</span></span>
        </a>

        <nav class="nav__links" aria-label="Primary" data-overlay-lang="<?php echo strtoupper($lang); ?>">
            <a href="/#how" data-link data-index="01"><?php echo $nc['nav'][0]; ?></a>
            <a href="/products/" data-link data-index="02"><?php echo $nc['nav'][1]; ?></a>
            <a href="/#manifesto" data-link data-index="03"><?php echo $nc['nav'][2]; ?></a>
            <a href="/#contact" data-link data-index="04"><?php echo $nc['nav'][3]; ?></a>
            <a href="/partners/" data-link data-index="05"><?php echo $isES?'Partners':($isDE?'Partner':'Partners'); ?></a>
            <div class="nav__mobile-foot">
                <span><?php echo $isES?'Sistemas complejos que se sienten simples.':($isDE?'Komplexe Systeme, die sich einfach anfühlen.':'Complex systems that feel simple.'); ?></span>
                <span><?php echo $isES?'© 2026 FIDORA LABS':($isDE?'© 2026 FIDORA LABS':'© 2026 FIDORA LABS'); ?></span>
            </div>
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

            <a href="/#contact" class="btn btn--primary btn--sm" data-cta>
                <span><?php echo $nc['nav_cta']; ?></span>
                <svg viewBox="0 0 16 16" width="14" height="14" aria-hidden="true"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
            </a>

            <button class="nav__burger" id="burger" aria-label="Menu">
                <span></span><span></span>
            </button>
        </div>
    </header>
    <?php
}

/* ---------- Footer ---------- */
function render_foot() {
    global $lang, $c, $navCopy;
    $nc = $navCopy[$lang];
    ?>
    <footer class="foot">
        <div class="foot__top">
            <div class="foot__brand">
                <img src="/assets/images/fidora_whitebg.png" alt="Fidora Labs" class="nav__logo--dark" />
                <img src="/assets/images/fidora_blackbg.png" alt="Fidora Labs" class="nav__logo--light" />
                <p><?php echo $nc['foot_tag']; ?></p>
            </div>
            <nav class="foot__cols" aria-label="Footer">
                <?php foreach ($nc['foot_cols'] as $colIdx => $col): ?>
                    <div>
                        <h4><?php echo $col[0]; ?></h4>
                        <?php if ($colIdx === 2): ?>
                            <?php foreach ($col[1] as $i => $link): ?>
                                <a href="<?php echo $link . '?lang=' . $lang; ?>"><?php echo $nc['foot_legal'][$i]; ?></a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php foreach ($col[1] as $link): ?>
                                <a href="#"><?php echo $link; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
        </div>
        <div class="foot__bottom mono">
            <?php foreach ($nc['foot_bottom'] as $b): ?><span><?php echo $b; ?></span><?php endforeach; ?>
        </div>
    </footer>
    <?php
}

/* ---------- Cookies banner ---------- */
function render_cookies_banner() {
    global $lang, $navCopy;
    $nc = $navCopy[$lang];
    ?>
    <aside class="cookies" id="cookiesBanner" aria-label="Cookie preferences" hidden>
        <div class="cookies__bar">
            <div class="cookies__text">
                <span class="mono cookies__eyebrow"><?php echo $nc['cookie_prefs']; ?></span>
                <p><?php echo $nc['cookie_text']; ?></p>
            </div>
            <div class="cookies__actions">
                <button class="btn btn--ghost btn--sm" type="button" data-cookie-action="settings"><?php echo $nc['cookie_settings']; ?></button>
                <button class="btn btn--ghost btn--sm" type="button" data-cookie-action="reject"><?php echo $nc['cookie_reject']; ?></button>
                <button class="btn btn--primary btn--sm" type="button" data-cookie-action="accept"><?php echo $nc['cookie_accept']; ?></button>
            </div>
        </div>
        <div class="cookies__panel" id="cookiesPanel" hidden>
            <div class="cookies__row">
                <div>
                    <strong><?php echo $nc['cookie_essential']; ?></strong>
                    <p><?php echo $nc['cookie_essential_desc']; ?></p>
                </div>
                <label class="cookies__switch is-locked">
                    <input type="checkbox" checked disabled />
                    <span></span>
                </label>
            </div>
            <div class="cookies__row">
                <div>
                    <strong><?php echo $nc['cookie_analytics']; ?></strong>
                    <p><?php echo $nc['cookie_analytics_desc']; ?></p>
                </div>
                <label class="cookies__switch">
                    <input type="checkbox" data-cookie-pref="analytics" />
                    <span></span>
                </label>
            </div>
            <div class="cookies__row">
                <div>
                    <strong><?php echo $nc['cookie_marketing']; ?></strong>
                    <p><?php echo $nc['cookie_marketing_desc']; ?></p>
                </div>
                <label class="cookies__switch">
                    <input type="checkbox" data-cookie-pref="marketing" />
                    <span></span>
                </label>
            </div>
            <div class="cookies__panel-actions">
                <button class="btn btn--primary btn--sm" type="button" data-cookie-action="save"><?php echo $nc['cookie_save']; ?></button>
            </div>
        </div>
    </aside>
    <?php
}
