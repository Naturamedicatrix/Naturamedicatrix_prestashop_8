<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__58537f77f16e5e679f0ff4eb56cc9f21 */
class __TwigTemplate_0fb3c51aa4921a36d21d4c63a6fdeee6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__58537f77f16e5e679f0ff4eb56cc9f21"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__58537f77f16e5e679f0ff4eb56cc9f21"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/Naturamedicatrix/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/Naturamedicatrix/img/app_icon.png\" />

<title>Accueil • Naturamedicatrix</title>

  <script type=\"text/javascript\">
    var help_class_name = 'HOME';
    var iso_user = 'fr';
    var lang_is_rtl = '0';
    var full_language_code = 'fr';
    var full_cldr_language_code = 'fr-FR';
    var country_iso_code = 'LU';
    var _PS_VERSION_ = '8.2.0';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'Une nouvelle commande a été passée sur votre boutique.';
    var order_number_msg = 'Numéro de commande : ';
    var total_msg = 'Total : ';
    var from_msg = 'Du ';
    var see_order_msg = 'Afficher cette commande';
    var new_customer_msg = 'Un nouveau client s\\'est inscrit sur votre boutique.';
    var customer_name_msg = 'Nom du client : ';
    var new_msg = 'Un nouveau message a été posté sur votre boutique.';
    var see_msg = 'Lire le message';
    var token = '5a39fcd040b42c3c100d6e0789b4a32f';
    var currentIndex = 'index.php?controller=HOME';
    var employee_token = '0b0981426c94cdc6a9ed91b9bd20a0cf';
    var choose_language_translate = 'Choisissez la langue :';
    var default_language = '1';
    var admin_modules_link = '/Naturamedicatrix/admin123/index.php/improve/modules/manage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g';
    var admin_notification_get_link = '/Naturamedicatrix/admin123/index.php/common/notifications?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g';
    var admin_notification_push_link = adminNotificationPushLink = '/Naturamedicatrix/admin123/index.php/common/notifications/ack?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g';
    var tab_m";
        // line 41
        echo "odules_list = '';
    var update_success_msg = 'Mise à jour réussie';
    var search_product_msg = 'Rechercher un produit';
  </script>



<link
      rel=\"preload\"
      href=\"/Naturamedicatrix/admin123/themes/new-theme/public/2d8017489da689caedc1.preload..woff2\"
      as=\"font\"
      crossorigin
    >
      <link href=\"/Naturamedicatrix/admin123/themes/new-theme/public/create_product_default_theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/admin123/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"https://unpkg.com/@prestashopcorp/edition-reskin/dist/back.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/blockwishlist/public/backoffice.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/admin123/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/klaviyopsautomation/dist/css/klaviyops-admin-global.c13a0d59.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/psxdesign/views/css/admin/dashboard-notification.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/psxmarketingwithgoogle/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/ps_facebook/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/Naturamedicatrix\\/admin123\\/\";
var baseDir = \"\\/Naturamedicatrix\\/\";
var changeFormLanguageUrl = \"\\/Naturamedicatrix\\/admin123\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\";
var contextPsAccounts = {";
        // line 70
        echo "\"currentContext\":{\"type\":1,\"id\":1},\"psxName\":\"ps_edition_basic\",\"psIs17\":true,\"psAccountsVersion\":\"7.0.8\",\"psAccountsIsInstalled\":true,\"psAccountsInstallLink\":null,\"psAccountsIsEnabled\":true,\"psAccountsEnableLink\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php\\/improve\\/modules\\/manage\\/action\\/enable\\/ps_accounts?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\",\"psAccountsIsUptodate\":true,\"psAccountsUpdateLink\":null,\"user\":{\"uuid\":null,\"email\":null,\"emailIsValidated\":false,\"isSuperAdmin\":true},\"backendUser\":{\"email\":\"itdev@naturamedicatrix.lu\",\"employeeId\":1,\"isSuperAdmin\":true},\"currentShop\":{\"id\":\"1\",\"name\":\"Naturamedicatrix\",\"domain\":\"localhost\",\"domainSsl\":\"localhost\",\"physicalUri\":\"\\/Naturamedicatrix\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\/\\/localhost\\/Naturamedicatrix\\/\",\"uuid\":null,\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\r\\nMIGJAoGBAO\\/tJJgI9OvBtVUhgGm7K07QN4TRsy5bE+4NJ2kZazt\\/lwkpLAVvygGq\\r\\nC4JWq2qUPpvV+qlmG5W2aS6VGF+79KZAFU9L3rKzFJhHFCHLA\\/wXW7h47KbmH\\/Mr\\r\\nXtIM+87Ipnx5RJE7Jwlqc1V4ifUs+PMCVcd6mBjrxc6VXk2ZvOyxAgMBAAE=\\r\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":null,\"user\":{\"email\":null,\"emailIsValidated\":false,\"uuid\":null},\"url\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php?controller=AdminModules&configure=ps_edition_basic&setShopContext=s-1&token=ca99fc6ad744f64ece9e247c4112a126\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\"},\"isShopContext\":true,\"superAdminEmail\":\"itdev@naturamedicatrix.lu\",\"onboardingLink\":\"https:\\/\\/accounts.distribution.prestashop.net?shops=W3siaWQiOiIxIiwibmFtZSI6Ik5hdHVyYW1lZGljYXRyaXgiLCJkb21haW4iOiJsb2NhbGhvc3QiLCJkb21haW5Tc2wiOiJsb2NhbGhvc3QiLCJwaHlzaWNhbFVyaSI6IlwvTmF0dXJhbWVkaWNhdHJpeFwvIiwidmlydHVhbFVyaSI6IiIsImZyb250VXJsIjoiaHR0cHM6XC9cL2xvY2FsaG9zdFwvTmF0dXJhbWVkaWNhdHJpeFwvIiwidXVpZCI6bnVsbCwicHVibGljS2V5IjoiLS0tLS1CRUdJTiBSU0EgUFVCTElDIEtFWS0tLS0tXHJcbk1JR0pBb0dCQU9cL3RKSmdJOU92QnRWVWhnR203SzA3UU40VFJzeTViRSs0Tkoya1phenRcL2x";
        echo "3a3BMQVZ2eWdHcVxyXG5DNEpXcTJxVVBwdlYrcWxtRzVXMmFTNlZHRis3OUtaQUZVOUwzckt6RkpoSEZDSExBXC93WFc3aDQ3S2JtSFwvTXJcclxuWHRJTSs4N0lwbng1UkpFN0p3bHFjMVY0aWZVcytQTUNWY2Q2bUJqcnhjNlZYazJadk95eEFnTUJBQUU9XHJcbi0tLS0tRU5EIFJTQSBQVUJMSUMgS0VZLS0tLS0iLCJlbXBsb3llZUlkIjoiMSIsInVzZXIiOnsiZW1haWwiOm51bGwsImVtYWlsSXNWYWxpZGF0ZWQiOmZhbHNlLCJ1dWlkIjpudWxsfSwidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9OYXR1cmFtZWRpY2F0cml4XC9hZG1pbjEyM1wvaW5kZXgucGhwP2NvbnRyb2xsZXI9QWRtaW5Nb2R1bGVzJmNvbmZpZ3VyZT1wc19lZGl0aW9uX2Jhc2ljJnNldFNob3BDb250ZXh0PXMtMSZ0b2tlbj1jYTk5ZmM2YWQ3NDRmNjRlY2U5ZTI0N2M0MTEyYTEyNiIsImlzTGlua2VkVjQiOmZhbHNlLCJ1bmxpbmtlZEF1dG8iOmZhbHNlLCJtdWx0aXNob3AiOmZhbHNlLCJtb2R1bGVOYW1lIjoicHNfZWRpdGlvbl9iYXNpYyIsInBzVmVyc2lvbiI6IjguMi4wIn1d\",\"ssoResendVerificationEmail\":\"https:\\/\\/auth.prestashop.com\\/account\\/send-verification-email\",\"manageAccountLink\":\"https:\\/\\/auth.prestashop.com\\/login?lang=fr\",\"isOnboardedV4\":false,\"shops\":[{\"id\":\"1\",\"name\":\"Default\",\"shops\":[{\"id\":\"1\",\"name\":\"Naturamedicatrix\",\"domain\":\"localhost\",\"domainSsl\":\"localhost\",\"physicalUri\":\"\\/Naturamedicatrix\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\/\\/localhost\\/Naturamedicatrix\\/\",\"uuid\":null,\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\r\\nMIGJAoGBAO\\/tJJgI9OvBtVUhgGm7K07QN4TRsy5bE+4NJ2kZazt\\/lwkpLAVvygGq\\r\\nC4JWq2qUPpvV+qlmG5W2aS6VGF+79KZAFU9L3rKzFJhHFCHLA\\/wXW7h47KbmH\\/Mr\\r\\nXtIM+87Ipnx5RJE7Jwlqc1V4ifUs+PMCVcd6mBjrxc6VXk2ZvOyxAgMBAAE=\\r\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":null,\"user\":{\"email\":null,\"emailIsValidated\":false,\"uuid\":null},\"url\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php?controller=AdminModules&configure=ps_edition_basic&setShopContext=s-1&token=ca99fc6ad744f64ece9e247c4112a126\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\",\"moduleVersion\":\"7.0.8\"}],\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\"}],\"adminAjaxLink\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php?controller=AdminAjaxPsAccounts&aj";
        echo "ax=1&token=5f1a25c06bb6c54eafc122f298510b0d\",\"accountsUiUrl\":\"https:\\/\\/accounts.distribution.prestashop.net\",\"dependencies\":{\"ps_eventbus\":{\"isInstalled\":true,\"installLink\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php\\/improve\\/modules\\/manage\\/action\\/install\\/ps_eventbus?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\",\"isEnabled\":true,\"enableLink\":\"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php\\/improve\\/modules\\/manage\\/action\\/enable\\/ps_eventbus?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"}}};
var currency = {\"iso_code\":\"EUR\",\"sign\":\"\\u20ac\",\"name\":\"Euro\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"EUR\",\"currencySymbol\":\"\\u20ac\",\"numberSymbols\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.00\\u00a0\\u00a4\",\"negativePattern\":\"-#,##0.00\\u00a0\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var number_specifications = {\"symbol\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\",\",\"\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":true};
var psxDesignUpdateNotification = \"\\n<div class=\\\"psxdesign-notification\\\">\\n  1\\n<\\/div>\\n\";
var show_new_customers = \"1\";
var show_new_messages = \"1\";
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_edition_basic/views/js/favicon.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/Natu";
        // line 83
        echo "ramedicatrix/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/admin.js?v=8.2.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/tools.js?v=8.2.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/create_product.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/blockwishlist/public/vendors.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_emailalerts/js/admin/ps_emailalerts.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_mbo/views/js/recommended-modules.js?v=4.12.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_faviconnotificationbo/views/js/favico.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_faviconnotificationbo/views/js/ps_faviconnotificationbo.js\"></script>

  <script>
            var admin_gamification_ajax_url = \"http:\\/\\/localhost\\/Naturamedicatrix\\/admin123\\/index.php?controller=AdminGamification&token=0e2242ecd604e2cd4fb2e4f06f88dbf2\";
            var current_id_tab = 151;
        </script><script type=\"module\" src=\"/Naturamedicatrix/modules/psxdesign/views/js/upgrade-notification.js\"></script>
    <script>
        window.userLocale  = 'fr';
        window.userflow_id = 'ct_55jfryadgneorc45cjqxpbf6o4';
    </script>
    <script type=\"module\" src=\"https://unpkg.com/@prestashopcorp/smb-edition-homepage/dist/assets/index.js\"></script><script>
  if (undefined !=";
        // line 106
        echo "= ps_faviconnotificationbo) {
    ps_faviconnotificationbo.initialize({
      backgroundColor: '#DF0067',
      textColor: '#FFFFFF',
      notificationGetUrl: '/Naturamedicatrix/admin123/index.php/common/notifications?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g',
      CHECKBOX_ORDER: 1,
      CHECKBOX_CUSTOMER: 1,
      CHECKBOX_MESSAGE: 1,
      timer: 120000, // Refresh every 2 minutes
    });
  }
</script>


";
        // line 120
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>";
        echo "

<body
  class=\"lang-fr home developer-mode\"
  data-base-url=\"/Naturamedicatrix/admin123/index.php\"  data-token=\"86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"></a>
      <span id=\"shop_version\">8.2.0</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Accès rapide
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/orders?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Commandes\"
      >Commandes</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=7e4b24a5dbddeec4b7f4d56de9e15154\"
                 data-item=\"Évaluation du catalogue\"
      >Évaluation du catalogue</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/improve/modules/manage?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Modules installés\"
      >Modules installés</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=591fabe76ba99ff58eead03392d3d98c\"
                 data-item=\"Nouveau bon de réduction";
        // line 155
        echo "\"
      >Nouveau bon de réduction</a>
          <a class=\"dropdown-item quick-row-link new-product-button\"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/products-v2/create?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Nouveau produit\"
      >Nouveau produit</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/categories/new?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Nouvelle catégorie\"
      >Nouvelle catégorie</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"51\"
        data-icon=\"\"
        data-method=\"add\"
        data-url=\"index.php/modules/pseditionbasic/homepage?-6XoP0wJJx1ES4wHv88g\"
        data-post-link=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\"
        data-prompt-text=\"Veuillez nommer ce raccourci :\"
        data-link=\"Bienvenue - Liste\"
      >
        <i class=\"material-icons\">add_circle</i>
        Ajouter la page actuelle à l'accès rapide
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\">
      <i class=\"material-icons\">settings</i>
      Gérez vos accès rapides
    </a>
  </div>
</div>
      </div>
      <div class=\"component component-search\" id=\"header-search-container\">
        <div class=\"component-search-body\">
          <div class=\"component-search-top\">
            <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/Naturamedicatrix/admin123/index.php?controller=AdminSearch&amp;token=96a8623e3a66ad4262577596abb88c8f\"
      role=\"search\">
  <input type=\"hidden\" name";
        // line 195
        echo "=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Rechercher (ex. : référence produit, nom du client, etc.)\" aria-label=\"Barre de recherche\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Partout
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Partout\" href=\"#\" data-value=\"0\" data-placeholder=\"Que souhaitez-vous trouver ?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Partout</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catalogue\" href=\"#\" data-value=\"1\" data-placeholder=\"Nom du produit, référence, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catalogue</a>
        <a class=\"dropdown-item\" data-item=\"Clients par nom\" href=\"#\" data-value=\"2\" data-placeholder=\"Nom\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Clients par nom</a>
        <a class=\"dropdown-item\" data-item=\"Clients par adresse IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Clients par adresse IP</a>
        <a class=\"dropdown-item\" data-item=\"Commandes\" href=\"#\" data-value=\"3\" data-placeholder=\"ID commande\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Commandes</a>
        <a class=\"dropdown-item\" data-item=\"Factures\" href=\"#\" data-value=\"4\" data-placeholder=\"Numéro de facture\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Factures</a>
        <a class=\"dropdown-item\" data-item=\"Paniers\" href=\"#\" data-value=\"5\" data-placeholder=\"ID panier\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopp";
        // line 210
        echo "ing_cart</i> Paniers</a>
        <a class=\"dropdown-item\" data-item=\"Modules\" href=\"#\" data-value=\"7\" data-placeholder=\"Nom du module\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Modules</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">RECHERCHE</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
            <button class=\"component-search-cancel d-none\">Annuler</button>
          </div>

          <div class=\"component-search-quickaccess d-none\">
  <p class=\"component-search-title\">Accès rapide</p>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/orders?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Commandes\"
    >Commandes</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=7e4b24a5dbddeec4b7f4d56de9e15154\"
             data-item=\"Évaluation du catalogue\"
    >Évaluation du catalogue</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/improve/modules/manage?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Modules installés\"
    >Modules installés</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=591fabe76ba99ff58eead03392d3d98c\"
             data-item=\"Nouveau bon de réduction\"
    >Nouveau bon de réduction</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/products-v2/create?token=d73d0da843b34eb107077dae93303b";
        // line 247
        echo "96\"
             data-item=\"Nouveau produit\"
    >Nouveau produit</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/categories/new?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Nouvelle catégorie\"
    >Nouvelle catégorie</a>
    <div class=\"dropdown-divider\"></div>
      <a id=\"quick-add-link\"
      class=\"dropdown-item js-quick-link\"
      href=\"#\"
      data-rand=\"54\"
      data-icon=\"\"
      data-method=\"add\"
      data-url=\"index.php/modules/pseditionbasic/homepage?-6XoP0wJJx1ES4wHv88g\"
      data-post-link=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\"
      data-prompt-text=\"Veuillez nommer ce raccourci :\"
      data-link=\"Bienvenue - Liste\"
    >
      <i class=\"material-icons\">add_circle</i>
      Ajouter la page actuelle à l'accès rapide
    </a>
    <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\">
    <i class=\"material-icons\">settings</i>
    Gérez vos accès rapides
  </a>
</div>
        </div>

        <div class=\"component-search-background d-none\"></div>
      </div>

              <div class=\"component hide-mobile-sm\" id=\"header-debug-mode-container\">
          <a class=\"link shop-state\"
             id=\"debug-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"<p class=&quot;text-left&quot;><strong>Votre boutique est en mode debug.</strong></p><p class=&quot;text-left&quot;>Tous les messages et erreurs PHP sont affichés. Lorsque vous n&#039;en avez plus besoin, &lt;strong&gt;désactivez&lt;/strong&gt; ce mode.</p>\"
             href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/performance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"
          >
     ";
        // line 288
        echo "       <i class=\"material-icons\">bug_report</i>
            <span>Mode debug</span>
          </a>
        </div>
      
                      <div class=\"component hide-mobile-sm\" id=\"header-maintenance-mode-container\">
          <a class=\"link shop-state\"
             id=\"maintenance-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"          &lt;p class=&quot;text-left text-nowrap&quot;&gt;
            &lt;strong&gt;Votre boutique est en mode maintenance.&lt;/strong&gt;
          &lt;/p&gt;
          &lt;p class=&quot;text-left&quot;&gt;
              Vos visiteurs et clients ne peuvent pas accéder à votre boutique lorsque le mode maintenance est activé.
          &lt;/p&gt;
          &lt;p class=&quot;text-left&quot;&gt;
              Pour gérer les paramètres de maintenance, rendez-vous sur la page Paramètres de la boutique &amp;gt; Paramètres généraux &amp;gt; Maintenance.
          &lt;/p&gt;
                      &lt;p class=&quot;text-left&quot;&gt;
              Les administrateurs peuvent accéder au front-office de la boutique sans que leur adresse IP ne soit enregistrée.
            &lt;/p&gt;
                  \"
             href=\"/Naturamedicatrix/admin123/index.php/configure/shop/maintenance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"
          >
            <i class=\"material-icons\"
              style=\"color: var(--green);\"
            >build</i>
            <span>Mode maintenance</span>
          </a>
        </div>
      
      <div class=\"header-right\">
                  <div class=\"component\" id=\"header-shop-list-container\">
              <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://localhost/Naturamedicatrix/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      <span>Voir ma boutique</span>
    </a>
  </div>
          </div>
                          <div class=\"component header-right-component\"";
        // line 330
        echo " id=\"header-notifications-container\">
            <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Commandes<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Clients<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Messages<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouvelle commande pour le moment :(<br>
              Avez-vous consulté vos <strong><a href=\"http://localhost/Naturam";
        // line 382
        echo "edicatrix/admin123/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=ec15058ac00c92955895055df8fd8ec4\">paniers abandonnés</a></strong> ?<br> Votre prochaine commande s'y trouve peut-être !
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Aucun nouveau client pour l'instant :(<br>
              Êtes-vous actifs sur les réseaux sociaux en ce moment ?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouveau message pour l'instant.<br>
              On dirait que vos clients sont satisfaits :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      de <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - enregistré le <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
          </div>
        
        <div class=\"compo";
        // line 429
        echo "nent\" id=\"header-employee-container\">
          <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      <div class=\"employee-top\">
        <span class=\"employee-avatar\"><img class=\"avatar rounded-circle\" src=\"http://localhost/Naturamedicatrix/img/pr/default.jpg\" alt=\"Jordan\" /></span>
        <span class=\"employee_profile\">Ravi de vous revoir Jordan</span>
      </div>

      <a class=\"dropdown-item employee-link profile-link\" href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/1/edit?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">
      <i class=\"material-icons\">edit</i>
      <span>Votre profil</span>
    </a>
    </div>

    <p class=\"divider\"></p>

                  <a class=\"dropdown-item \" href=\"https://accounts.distribution.prestashop.net?utm_source=localhost&utm_medium=back-office&utm_campaign=ps_accounts&utm_content=headeremployeedropdownlink\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">open_in_new</i> Gérer votre compte PrestaShop
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://www.prestashop.com/fr/formation?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=training-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">school</i> Formation
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://www.prestashop.com/fr/experts?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=expert-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">person_pin_circle</i> Trouver un expert
        </a>
                          <a cla";
        // line 458
        echo "ss=\"dropdown-item ps_mbo\" href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?utm_mbo_source=menu-user-back-office&_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g&utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=addons-fr&utm_mbo_source=menu-user-back-office\"  rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">extension</i> Marketplace Prestashop
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://help-center.prestashop.com/fr?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=help-center-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">help</i> Centre d'assistance
        </a>
                  <p class=\"divider\"></p>
            
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminLogin&amp;logout=1&amp;token=45467cd425938a4538faba714c167471\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Déconnexion</span>
    </a>
  </div>
</div>
        </div>
              </div>
    </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/toggle-navigation?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">
    <i class=\"material-icons rtl-flip\">chevron_left</i>
    <i class=\"material-icons rtl-flip\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
      <div class=\"logo-container\">
          <a id=\"header_logo\" class=\"logo float-left\" href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"></a>
          <span id=\"shop_version\" class=\"header-version\">8.2.0</span>
      </div>

      <ul class=\"main-menu\">
              
       ";
        // line 491
        echo "                                   
                    
          
            <li class=\"category-title link-active\" data-submenu=\"151\" id=\"tab-HOME\">
                <span class=\"title\">Bienvenue</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"152\" id=\"subtab-AdminPsEditionBasicHomepageController\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-home\">home</i>
                      <span>
                      Accueil
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"1\" id=\"subtab-AdminDashboard\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminDashboard&amp;token=0670674f058b05ae85a5f730ff44a095\" class=\"link\">
                      <i class=\"material-icons mi-trending_up\">trending_up</i>
                      <span>
                      Tableau de bord
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
          ";
        // line 527
        echo "                              </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Vendre</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Commandes
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"s";
        // line 564
        echo "ubtab-AdminInvoices\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/invoices/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Factures
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/credit-slips/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Avoirs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/delivery-slips/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Bons de livraison
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarts&amp;token=ec15058ac00c92955895055df8fd8ec4\" class=\"link\"> Paniers
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
      ";
        // line 595
        echo "                                        
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/products?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalogue
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/products?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/categories?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Catégories
                                </a>
                              </li>

                                ";
        // line 626
        echo "                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/monitoring/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Suivi
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminAttributesGroups&amp;token=f72d6e1cd99a2045a35010bdd3a55c68\" class=\"link\"> Attributs &amp; caractéristiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/brands/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Marques et fournisseurs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/attachments/";
        // line 654
        echo "?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Fichiers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;token=591fabe76ba99ff58eead03392d3d98c\" class=\"link\"> Réductions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/stocks/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Stock
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/customers/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Clients
                      </span>
                                                    <i class=\"material-icons sub-tab";
        // line 686
        echo "s-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/customers/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/addresses/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Adresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCustomerThreads&amp;token=041f0c4849da8f5f4c7d4bde72e1fd44\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
   ";
        // line 716
        echo "                   <span>
                      SAV
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCustomerThreads&amp;token=041f0c4849da8f5f4c7d4bde72e1fd44\" class=\"link\"> SAV
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/customer-service/order-messages/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Messages prédéfinis
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminReturn&amp;token=608ecd2b845d55eec6a193b328ae047a\" class=\"link\">";
        // line 744
        echo " Retours produits
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics/legacy/stats?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Statistiques
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"168\" id=\"subtab-AdminMetricsLegacyStatsController\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics/legacy/stats?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Statistiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"169\" id=\"subtab-AdminMetricsController\"";
        // line 776
        echo ">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"37\" id=\"tab-IMPROVE\">
                <span class=\"title\">Personnaliser</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"38\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-38\" class=\"submenu panel-collapse\">
                                                                                                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"161\" id=\"subtab-AdminPsMboModuleParent\">
      ";
        // line 812
        echo "                          <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"39\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/modules/manage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Gestionnaire de modules 
                                </a>
                              </li>

                                                                                                                                                                                          </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentThemes\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsThemeCustoConfiguration&amp;token=44108a1b7e04c208ed91d9ad7fa74c85\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Apparence
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=";
        // line 840
        echo "\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"170\" id=\"subtab-AdminThemesParent\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsThemeCustoConfiguration&amp;token=44108a1b7e04c208ed91d9ad7fa74c85\" class=\"link\"> Modules du thème
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"165\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/themes/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Catalogue de thèmes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"136\" id=\"subtab-AdminPsxDesignParentTab\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/improve/design/themes?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Personnalisation
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"45\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/Naturamedica";
        // line 869
        echo "trix/admin123/index.php/improve/design/mail_theme/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Thème d&#039;e-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"47\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/design/cms-pages/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/design/modules/positions/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"49\" id=\"subtab-AdminImages\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminImages&amp;token=3a7f70a244a5bac8dc66d67d192e80b6\" class=\"link\"> Images
                                </a>
                              </li>

                                                                                  
                              
                                                            
         ";
        // line 900
        echo "                     <li class=\"link-leveltwo\" data-submenu=\"118\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/link-widget/list?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Liste de liens
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"50\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarriers&amp;token=88cfd81d0e4c27fdb4d9a839ed298fe2\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Livraison
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-50\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"51\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarriers&amp;token=88cfd81d0e4c27fdb4d9a839ed298fe2\" class=\"link\"> Transporteurs
                                </a>
                              </li>

                     ";
        // line 930
        echo "                                                             
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"52\" id=\"subtab-AdminShipping\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/shipping/preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"53\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/payment_methods?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Paiement
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-53\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"54\" id=\"subtab-AdminPayment\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/payment_methods?_token=86jmVRmw0mFZtFxSHl8kCJV";
        // line 959
        echo "-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Moyens de paiement
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"56\" id=\"subtab-AdminInternational\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/localization/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      International
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-56\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5";
        // line 991
        echo "7\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/localization/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Localisation
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/zones/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Zones géographiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"66\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/taxes/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Taxes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"69\" id=\"subtab-AdminTranslations\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/translations/settings?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Traductions
                                </a>
                              </li>

                                                        ";
        // line 1020
        echo "                      </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"141\" id=\"subtab-Marketing\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=9dcb6e8b1946c5a25171d32a99646b1f\" class=\"link\">
                      <i class=\"material-icons mi-campaign\">campaign</i>
                      <span>
                      Marketing
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-141\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"142\" id=\"subtab-AdminPsxMktgWithGoogleModule\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=9dcb6e8b1946c5a25171d32a99646b1f\" class=\"link\"> Google
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"157\" id=\"subtab-AdminPsfacebookModule\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsfacebookModule";
        // line 1049
        echo "&amp;token=e61c2a26a664e692dfbdb9fc7e836173\" class=\"link\"> Facebook &amp; Instagram
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"70\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configurer</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"153\" id=\"subtab-AdminPsEditionBasicSettingsController\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/settings?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Paramètres
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"71\" id=\"subtab-ShopParameters\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/preferences/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <spa";
        // line 1087
        echo "n>
                      Paramètres de la boutique
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-71\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/preferences/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Paramètres généraux
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"75\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/order-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"78\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/product-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx";
        // line 1115
        echo "1ES4wHv88g\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/customer-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"83\" id=\"subtab-AdminParentStores\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/contacts/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Contact
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"86\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/seo-urls/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Trafic et SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminPare";
        // line 1146
        echo "ntSearchConf\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminSearchConf&amp;token=432c03000b120fdd5314e0b764a6175d\" class=\"link\"> Rechercher
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"92\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/system-information/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Paramètres avancés
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-92\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminInformation\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/system-information/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Informations
                                </a>
                              </li>

                                                    ";
        // line 1176
        echo "                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"94\" id=\"subtab-AdminPerformance\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/performance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Performances
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"95\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/administration/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminEmails\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/emails/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"97\" id=\"subtab-AdminImport\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/import/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" c";
        // line 1204
        echo "lass=\"link\"> Importer
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"98\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Équipe
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"102\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/sql-requests/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Base de données
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminLogs\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/logs/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminWebservice\">
            ";
        // line 1236
        echo "                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/webservice-keys/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                                                                                    
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"110\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/feature-flags/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Fonctionnalités nouvelles et expérimentales
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"111\" id=\"subtab-AdminParentSecurity\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/security/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Security
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"127\" id=\"subtab-AdminKlaviyoPsConfig\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminKla";
        // line 1263
        echo "viyoPsConfig&amp;token=37cd73949dbbf4e3cbf1e2722b4ea0da\" class=\"link\">
                      <i class=\"material-icons mi-trending_up\">trending_up</i>
                      <span>
                      Klaviyo
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"129\" id=\"subtab-AdminPsAssistantSettings\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsAssistantSettings&amp;token=65c0e9556d54670d67b6cc677916af1b\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Assistance By PrestaShop
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>


<div class=\"header-toolbar d-print-none\">
    
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" aria-current=\"page\">Bienve";
        // line 1305
        echo "nue</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Accueil          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                        
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Aide\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"https://help.prestashop-project.org/fr/doc/HOME?version=8.2.0&amp;country=fr\"
                   id=\"product_form_open_help\"
                >
                  Aide
                </a>
                                    </div>
        </div>

      
    </div>
  </div>

  
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
        
                              <a class=\"btn btn-floating-item btn-help btn-sidebar\" href=\"#\"
               title=\"Aide\"
               data-toggle=\"sidebar\"
               data-target=\"#right-sidebar\"
               data-url=\"https://help.prestashop-project.org/fr/doc/HOME?version=8.2.0&amp;country=fr\"
            >
              Aide
            </a>
                        </div>
    </div>
  </div>
  
</div>

<div id=\"main-div\">
          
      <div class=\"content-div  \">

        

                                                        
        <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>
<div id=\"content-message-box\"></div>


  ";
        // line 1374
        $this->displayBlock('content_header', $context, $blocks);
        $this->displayBlock('content', $context, $blocks);
        $this->displayBlock('content_footer', $context, $blocks);
        $this->displayBlock('sidebar_right', $context, $blocks);
        echo "

        

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>Oh non !</h1>
  <p class=\"mt-3\">
    La version mobile de cette page n'est pas encore disponible.
  </p>
  <p class=\"mt-2\">
    Cette page n'est pas encore disponible sur mobile, merci de la consulter sur ordinateur.
  </p>
  <p class=\"mt-2\">
    Merci.
  </p>
  <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons rtl-flip\">arrow_back</i>
    Précédent
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      
    </div>
  
";
        // line 1408
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>";
        echo "
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 120
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 1374
    public function block_content_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_content_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_sidebar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 1408
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translate_javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translate_javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "__string_template__58537f77f16e5e679f0ff4eb56cc9f21";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1673 => 1408,  1604 => 1374,  1569 => 120,  1554 => 1408,  1514 => 1374,  1443 => 1305,  1399 => 1263,  1370 => 1236,  1336 => 1204,  1306 => 1176,  1274 => 1146,  1241 => 1115,  1211 => 1087,  1171 => 1049,  1140 => 1020,  1109 => 991,  1075 => 959,  1044 => 930,  1012 => 900,  979 => 869,  948 => 840,  918 => 812,  880 => 776,  846 => 744,  816 => 716,  784 => 686,  750 => 654,  720 => 626,  687 => 595,  654 => 564,  615 => 527,  577 => 491,  542 => 458,  511 => 429,  462 => 382,  408 => 330,  364 => 288,  321 => 247,  282 => 210,  265 => 195,  223 => 155,  183 => 120,  167 => 106,  142 => 83,  125 => 70,  94 => 41,  52 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{{ '<!DOCTYPE html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/Naturamedicatrix/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/Naturamedicatrix/img/app_icon.png\" />

<title>Accueil • Naturamedicatrix</title>

  <script type=\"text/javascript\">
    var help_class_name = \\'HOME\\';
    var iso_user = \\'fr\\';
    var lang_is_rtl = \\'0\\';
    var full_language_code = \\'fr\\';
    var full_cldr_language_code = \\'fr-FR\\';
    var country_iso_code = \\'LU\\';
    var _PS_VERSION_ = \\'8.2.0\\';
    var roundMode = 2;
    var youEditFieldFor = \\'\\';
        var new_order_msg = \\'Une nouvelle commande a été passée sur votre boutique.\\';
    var order_number_msg = \\'Numéro de commande : \\';
    var total_msg = \\'Total : \\';
    var from_msg = \\'Du \\';
    var see_order_msg = \\'Afficher cette commande\\';
    var new_customer_msg = \\'Un nouveau client s\\\\\\'est inscrit sur votre boutique.\\';
    var customer_name_msg = \\'Nom du client : \\';
    var new_msg = \\'Un nouveau message a été posté sur votre boutique.\\';
    var see_msg = \\'Lire le message\\';
    var token = \\'5a39fcd040b42c3c100d6e0789b4a32f\\';
    var currentIndex = \\'index.php?controller=HOME\\';
    var employee_token = \\'0b0981426c94cdc6a9ed91b9bd20a0cf\\';
    var choose_language_translate = \\'Choisissez la langue :\\';
    var default_language = \\'1\\';
    var admin_modules_link = \\'/Naturamedicatrix/admin123/index.php/improve/modules/manage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\\';
    var admin_notification_get_link = \\'/Naturamedicatrix/admin123/index.php/common/notifications?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\\';
    var admin_notification_push_link = adminNotificationPushLink = \\'/Naturamedicatrix/admin123/index.php/common/notifications/ack?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\\';
    var tab_m' | raw }}{{ 'odules_list = \\'\\';
    var update_success_msg = \\'Mise à jour réussie\\';
    var search_product_msg = \\'Rechercher un produit\\';
  </script>



<link
      rel=\"preload\"
      href=\"/Naturamedicatrix/admin123/themes/new-theme/public/2d8017489da689caedc1.preload..woff2\"
      as=\"font\"
      crossorigin
    >
      <link href=\"/Naturamedicatrix/admin123/themes/new-theme/public/create_product_default_theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/admin123/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"https://unpkg.com/@prestashopcorp/edition-reskin/dist/back.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/blockwishlist/public/backoffice.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/admin123/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/klaviyopsautomation/dist/css/klaviyops-admin-global.c13a0d59.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/psxdesign/views/css/admin/dashboard-notification.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/psxmarketingwithgoogle/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/Naturamedicatrix/modules/ps_facebook/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\\\/Naturamedicatrix\\\\/admin123\\\\/\";
var baseDir = \"\\\\/Naturamedicatrix\\\\/\";
var changeFormLanguageUrl = \"\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php\\\\/configure\\\\/advanced\\\\/employees\\\\/change-form-language?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\";
var contextPsAccounts = {' | raw }}{{ '\"currentContext\":{\"type\":1,\"id\":1},\"psxName\":\"ps_edition_basic\",\"psIs17\":true,\"psAccountsVersion\":\"7.0.8\",\"psAccountsIsInstalled\":true,\"psAccountsInstallLink\":null,\"psAccountsIsEnabled\":true,\"psAccountsEnableLink\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php\\\\/improve\\\\/modules\\\\/manage\\\\/action\\\\/enable\\\\/ps_accounts?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\",\"psAccountsIsUptodate\":true,\"psAccountsUpdateLink\":null,\"user\":{\"uuid\":null,\"email\":null,\"emailIsValidated\":false,\"isSuperAdmin\":true},\"backendUser\":{\"email\":\"itdev@naturamedicatrix.lu\",\"employeeId\":1,\"isSuperAdmin\":true},\"currentShop\":{\"id\":\"1\",\"name\":\"Naturamedicatrix\",\"domain\":\"localhost\",\"domainSsl\":\"localhost\",\"physicalUri\":\"\\\\/Naturamedicatrix\\\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/\",\"uuid\":null,\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\\\r\\\\nMIGJAoGBAO\\\\/tJJgI9OvBtVUhgGm7K07QN4TRsy5bE+4NJ2kZazt\\\\/lwkpLAVvygGq\\\\r\\\\nC4JWq2qUPpvV+qlmG5W2aS6VGF+79KZAFU9L3rKzFJhHFCHLA\\\\/wXW7h47KbmH\\\\/Mr\\\\r\\\\nXtIM+87Ipnx5RJE7Jwlqc1V4ifUs+PMCVcd6mBjrxc6VXk2ZvOyxAgMBAAE=\\\\r\\\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":null,\"user\":{\"email\":null,\"emailIsValidated\":false,\"uuid\":null},\"url\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php?controller=AdminModules&configure=ps_edition_basic&setShopContext=s-1&token=ca99fc6ad744f64ece9e247c4112a126\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\"},\"isShopContext\":true,\"superAdminEmail\":\"itdev@naturamedicatrix.lu\",\"onboardingLink\":\"https:\\\\/\\\\/accounts.distribution.prestashop.net?shops=W3siaWQiOiIxIiwibmFtZSI6Ik5hdHVyYW1lZGljYXRyaXgiLCJkb21haW4iOiJsb2NhbGhvc3QiLCJkb21haW5Tc2wiOiJsb2NhbGhvc3QiLCJwaHlzaWNhbFVyaSI6IlwvTmF0dXJhbWVkaWNhdHJpeFwvIiwidmlydHVhbFVyaSI6IiIsImZyb250VXJsIjoiaHR0cHM6XC9cL2xvY2FsaG9zdFwvTmF0dXJhbWVkaWNhdHJpeFwvIiwidXVpZCI6bnVsbCwicHVibGljS2V5IjoiLS0tLS1CRUdJTiBSU0EgUFVCTElDIEtFWS0tLS0tXHJcbk1JR0pBb0dCQU9cL3RKSmdJOU92QnRWVWhnR203SzA3UU40VFJzeTViRSs0Tkoya1phenRcL2x' | raw }}{{ '3a3BMQVZ2eWdHcVxyXG5DNEpXcTJxVVBwdlYrcWxtRzVXMmFTNlZHRis3OUtaQUZVOUwzckt6RkpoSEZDSExBXC93WFc3aDQ3S2JtSFwvTXJcclxuWHRJTSs4N0lwbng1UkpFN0p3bHFjMVY0aWZVcytQTUNWY2Q2bUJqcnhjNlZYazJadk95eEFnTUJBQUU9XHJcbi0tLS0tRU5EIFJTQSBQVUJMSUMgS0VZLS0tLS0iLCJlbXBsb3llZUlkIjoiMSIsInVzZXIiOnsiZW1haWwiOm51bGwsImVtYWlsSXNWYWxpZGF0ZWQiOmZhbHNlLCJ1dWlkIjpudWxsfSwidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9OYXR1cmFtZWRpY2F0cml4XC9hZG1pbjEyM1wvaW5kZXgucGhwP2NvbnRyb2xsZXI9QWRtaW5Nb2R1bGVzJmNvbmZpZ3VyZT1wc19lZGl0aW9uX2Jhc2ljJnNldFNob3BDb250ZXh0PXMtMSZ0b2tlbj1jYTk5ZmM2YWQ3NDRmNjRlY2U5ZTI0N2M0MTEyYTEyNiIsImlzTGlua2VkVjQiOmZhbHNlLCJ1bmxpbmtlZEF1dG8iOmZhbHNlLCJtdWx0aXNob3AiOmZhbHNlLCJtb2R1bGVOYW1lIjoicHNfZWRpdGlvbl9iYXNpYyIsInBzVmVyc2lvbiI6IjguMi4wIn1d\",\"ssoResendVerificationEmail\":\"https:\\\\/\\\\/auth.prestashop.com\\\\/account\\\\/send-verification-email\",\"manageAccountLink\":\"https:\\\\/\\\\/auth.prestashop.com\\\\/login?lang=fr\",\"isOnboardedV4\":false,\"shops\":[{\"id\":\"1\",\"name\":\"Default\",\"shops\":[{\"id\":\"1\",\"name\":\"Naturamedicatrix\",\"domain\":\"localhost\",\"domainSsl\":\"localhost\",\"physicalUri\":\"\\\\/Naturamedicatrix\\\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/\",\"uuid\":null,\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\\\r\\\\nMIGJAoGBAO\\\\/tJJgI9OvBtVUhgGm7K07QN4TRsy5bE+4NJ2kZazt\\\\/lwkpLAVvygGq\\\\r\\\\nC4JWq2qUPpvV+qlmG5W2aS6VGF+79KZAFU9L3rKzFJhHFCHLA\\\\/wXW7h47KbmH\\\\/Mr\\\\r\\\\nXtIM+87Ipnx5RJE7Jwlqc1V4ifUs+PMCVcd6mBjrxc6VXk2ZvOyxAgMBAAE=\\\\r\\\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":null,\"user\":{\"email\":null,\"emailIsValidated\":false,\"uuid\":null},\"url\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php?controller=AdminModules&configure=ps_edition_basic&setShopContext=s-1&token=ca99fc6ad744f64ece9e247c4112a126\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\",\"moduleVersion\":\"7.0.8\"}],\"multishop\":false,\"moduleName\":\"ps_edition_basic\",\"psVersion\":\"8.2.0\"}],\"adminAjaxLink\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php?controller=AdminAjaxPsAccounts&aj' | raw }}{{ 'ax=1&token=5f1a25c06bb6c54eafc122f298510b0d\",\"accountsUiUrl\":\"https:\\\\/\\\\/accounts.distribution.prestashop.net\",\"dependencies\":{\"ps_eventbus\":{\"isInstalled\":true,\"installLink\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php\\\\/improve\\\\/modules\\\\/manage\\\\/action\\\\/install\\\\/ps_eventbus?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\",\"isEnabled\":true,\"enableLink\":\"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php\\\\/improve\\\\/modules\\\\/manage\\\\/action\\\\/enable\\\\/ps_eventbus?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"}}};
var currency = {\"iso_code\":\"EUR\",\"sign\":\"\\\\u20ac\",\"name\":\"Euro\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\"\\\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\\\u00d7\",\"\\\\u2030\",\"\\\\u221e\",\"NaN\"],\"currencyCode\":\"EUR\",\"currencySymbol\":\"\\\\u20ac\",\"numberSymbols\":[\",\",\"\\\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\\\u00d7\",\"\\\\u2030\",\"\\\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.00\\\\u00a0\\\\u00a4\",\"negativePattern\":\"-#,##0.00\\\\u00a0\\\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var number_specifications = {\"symbol\":[\",\",\"\\\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\\\u00d7\",\"\\\\u2030\",\"\\\\u221e\",\"NaN\"],\"numberSymbols\":[\",\",\"\\\\u202f\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\\\u00d7\",\"\\\\u2030\",\"\\\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":true};
var psxDesignUpdateNotification = \"\\\\n<div class=\\\\\"psxdesign-notification\\\\\">\\\\n  1\\\\n<\\\\/div>\\\\n\";
var show_new_customers = \"1\";
var show_new_messages = \"1\";
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_edition_basic/views/js/favicon.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/Natu' | raw }}{{ 'ramedicatrix/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/admin.js?v=8.2.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/tools.js?v=8.2.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/new-theme/public/create_product.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/blockwishlist/public/vendors.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/admin123/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_emailalerts/js/admin/ps_emailalerts.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_mbo/views/js/recommended-modules.js?v=4.12.0\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_faviconnotificationbo/views/js/favico.js\"></script>
<script type=\"text/javascript\" src=\"/Naturamedicatrix/modules/ps_faviconnotificationbo/views/js/ps_faviconnotificationbo.js\"></script>

  <script>
            var admin_gamification_ajax_url = \"http:\\\\/\\\\/localhost\\\\/Naturamedicatrix\\\\/admin123\\\\/index.php?controller=AdminGamification&token=0e2242ecd604e2cd4fb2e4f06f88dbf2\";
            var current_id_tab = 151;
        </script><script type=\"module\" src=\"/Naturamedicatrix/modules/psxdesign/views/js/upgrade-notification.js\"></script>
    <script>
        window.userLocale  = \\'fr\\';
        window.userflow_id = \\'ct_55jfryadgneorc45cjqxpbf6o4\\';
    </script>
    <script type=\"module\" src=\"https://unpkg.com/@prestashopcorp/smb-edition-homepage/dist/assets/index.js\"></script><script>
  if (undefined !=' | raw }}{{ '= ps_faviconnotificationbo) {
    ps_faviconnotificationbo.initialize({
      backgroundColor: \\'#DF0067\\',
      textColor: \\'#FFFFFF\\',
      notificationGetUrl: \\'/Naturamedicatrix/admin123/index.php/common/notifications?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\\',
      CHECKBOX_ORDER: 1,
      CHECKBOX_CUSTOMER: 1,
      CHECKBOX_MESSAGE: 1,
      timer: 120000, // Refresh every 2 minutes
    });
  }
</script>


' | raw }}{% block stylesheets %}{% endblock %}{% block extra_stylesheets %}{% endblock %}</head>{{ '

<body
  class=\"lang-fr home developer-mode\"
  data-base-url=\"/Naturamedicatrix/admin123/index.php\"  data-token=\"86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"></a>
      <span id=\"shop_version\">8.2.0</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Accès rapide
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/orders?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Commandes\"
      >Commandes</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=7e4b24a5dbddeec4b7f4d56de9e15154\"
                 data-item=\"Évaluation du catalogue\"
      >Évaluation du catalogue</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/improve/modules/manage?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Modules installés\"
      >Modules installés</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=591fabe76ba99ff58eead03392d3d98c\"
                 data-item=\"Nouveau bon de réduction' | raw }}{{ '\"
      >Nouveau bon de réduction</a>
          <a class=\"dropdown-item quick-row-link new-product-button\"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/products-v2/create?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Nouveau produit\"
      >Nouveau produit</a>
          <a class=\"dropdown-item quick-row-link \"
         href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/categories/new?token=d73d0da843b34eb107077dae93303b96\"
                 data-item=\"Nouvelle catégorie\"
      >Nouvelle catégorie</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"51\"
        data-icon=\"\"
        data-method=\"add\"
        data-url=\"index.php/modules/pseditionbasic/homepage?-6XoP0wJJx1ES4wHv88g\"
        data-post-link=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\"
        data-prompt-text=\"Veuillez nommer ce raccourci :\"
        data-link=\"Bienvenue - Liste\"
      >
        <i class=\"material-icons\">add_circle</i>
        Ajouter la page actuelle à l\\'accès rapide
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\">
      <i class=\"material-icons\">settings</i>
      Gérez vos accès rapides
    </a>
  </div>
</div>
      </div>
      <div class=\"component component-search\" id=\"header-search-container\">
        <div class=\"component-search-body\">
          <div class=\"component-search-top\">
            <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/Naturamedicatrix/admin123/index.php?controller=AdminSearch&amp;token=96a8623e3a66ad4262577596abb88c8f\"
      role=\"search\">
  <input type=\"hidden\" name' | raw }}{{ '=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Rechercher (ex. : référence produit, nom du client, etc.)\" aria-label=\"Barre de recherche\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Partout
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Partout\" href=\"#\" data-value=\"0\" data-placeholder=\"Que souhaitez-vous trouver ?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Partout</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catalogue\" href=\"#\" data-value=\"1\" data-placeholder=\"Nom du produit, référence, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catalogue</a>
        <a class=\"dropdown-item\" data-item=\"Clients par nom\" href=\"#\" data-value=\"2\" data-placeholder=\"Nom\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Clients par nom</a>
        <a class=\"dropdown-item\" data-item=\"Clients par adresse IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Clients par adresse IP</a>
        <a class=\"dropdown-item\" data-item=\"Commandes\" href=\"#\" data-value=\"3\" data-placeholder=\"ID commande\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Commandes</a>
        <a class=\"dropdown-item\" data-item=\"Factures\" href=\"#\" data-value=\"4\" data-placeholder=\"Numéro de facture\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Factures</a>
        <a class=\"dropdown-item\" data-item=\"Paniers\" href=\"#\" data-value=\"5\" data-placeholder=\"ID panier\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopp' | raw }}{{ 'ing_cart</i> Paniers</a>
        <a class=\"dropdown-item\" data-item=\"Modules\" href=\"#\" data-value=\"7\" data-placeholder=\"Nom du module\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Modules</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">RECHERCHE</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$(\\'#bo_query\\').one(\\'click\\', function() {
    \$(this).closest(\\'form\\').removeClass(\\'collapsed\\');
  });
});
</script>
            <button class=\"component-search-cancel d-none\">Annuler</button>
          </div>

          <div class=\"component-search-quickaccess d-none\">
  <p class=\"component-search-title\">Accès rapide</p>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/orders?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Commandes\"
    >Commandes</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=7e4b24a5dbddeec4b7f4d56de9e15154\"
             data-item=\"Évaluation du catalogue\"
    >Évaluation du catalogue</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/improve/modules/manage?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Modules installés\"
    >Modules installés</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=591fabe76ba99ff58eead03392d3d98c\"
             data-item=\"Nouveau bon de réduction\"
    >Nouveau bon de réduction</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/products-v2/create?token=d73d0da843b34eb107077dae93303b' | raw }}{{ '96\"
             data-item=\"Nouveau produit\"
    >Nouveau produit</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://localhost/Naturamedicatrix/admin123/index.php/sell/catalog/categories/new?token=d73d0da843b34eb107077dae93303b96\"
             data-item=\"Nouvelle catégorie\"
    >Nouvelle catégorie</a>
    <div class=\"dropdown-divider\"></div>
      <a id=\"quick-add-link\"
      class=\"dropdown-item js-quick-link\"
      href=\"#\"
      data-rand=\"54\"
      data-icon=\"\"
      data-method=\"add\"
      data-url=\"index.php/modules/pseditionbasic/homepage?-6XoP0wJJx1ES4wHv88g\"
      data-post-link=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\"
      data-prompt-text=\"Veuillez nommer ce raccourci :\"
      data-link=\"Bienvenue - Liste\"
    >
      <i class=\"material-icons\">add_circle</i>
      Ajouter la page actuelle à l\\'accès rapide
    </a>
    <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminQuickAccesses&token=45b94ec50eddc9b9e4e02be40e3d0790\">
    <i class=\"material-icons\">settings</i>
    Gérez vos accès rapides
  </a>
</div>
        </div>

        <div class=\"component-search-background d-none\"></div>
      </div>

              <div class=\"component hide-mobile-sm\" id=\"header-debug-mode-container\">
          <a class=\"link shop-state\"
             id=\"debug-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"<p class=&quot;text-left&quot;><strong>Votre boutique est en mode debug.</strong></p><p class=&quot;text-left&quot;>Tous les messages et erreurs PHP sont affichés. Lorsque vous n&#039;en avez plus besoin, &lt;strong&gt;désactivez&lt;/strong&gt; ce mode.</p>\"
             href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/performance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"
          >
     ' | raw }}{{ '       <i class=\"material-icons\">bug_report</i>
            <span>Mode debug</span>
          </a>
        </div>
      
                      <div class=\"component hide-mobile-sm\" id=\"header-maintenance-mode-container\">
          <a class=\"link shop-state\"
             id=\"maintenance-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"          &lt;p class=&quot;text-left text-nowrap&quot;&gt;
            &lt;strong&gt;Votre boutique est en mode maintenance.&lt;/strong&gt;
          &lt;/p&gt;
          &lt;p class=&quot;text-left&quot;&gt;
              Vos visiteurs et clients ne peuvent pas accéder à votre boutique lorsque le mode maintenance est activé.
          &lt;/p&gt;
          &lt;p class=&quot;text-left&quot;&gt;
              Pour gérer les paramètres de maintenance, rendez-vous sur la page Paramètres de la boutique &amp;gt; Paramètres généraux &amp;gt; Maintenance.
          &lt;/p&gt;
                      &lt;p class=&quot;text-left&quot;&gt;
              Les administrateurs peuvent accéder au front-office de la boutique sans que leur adresse IP ne soit enregistrée.
            &lt;/p&gt;
                  \"
             href=\"/Naturamedicatrix/admin123/index.php/configure/shop/maintenance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"
          >
            <i class=\"material-icons\"
              style=\"color: var(--green);\"
            >build</i>
            <span>Mode maintenance</span>
          </a>
        </div>
      
      <div class=\"header-right\">
                  <div class=\"component\" id=\"header-shop-list-container\">
              <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://localhost/Naturamedicatrix/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      <span>Voir ma boutique</span>
    </a>
  </div>
          </div>
                          <div class=\"component header-right-component\"' | raw }}{{ ' id=\"header-notifications-container\">
            <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Commandes<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Clients<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Messages<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouvelle commande pour le moment :(<br>
              Avez-vous consulté vos <strong><a href=\"http://localhost/Naturam' | raw }}{{ 'edicatrix/admin123/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=ec15058ac00c92955895055df8fd8ec4\">paniers abandonnés</a></strong> ?<br> Votre prochaine commande s\\'y trouve peut-être !
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Aucun nouveau client pour l\\'instant :(<br>
              Êtes-vous actifs sur les réseaux sociaux en ce moment ?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Pas de nouveau message pour l\\'instant.<br>
              On dirait que vos clients sont satisfaits :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href=\\'order_url\\'>
      #_id_order_ -
      de <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href=\\'customer_url\\'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - enregistré le <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href=\\'message_url\\'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
          </div>
        
        <div class=\"compo' | raw }}{{ 'nent\" id=\"header-employee-container\">
          <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      <div class=\"employee-top\">
        <span class=\"employee-avatar\"><img class=\"avatar rounded-circle\" src=\"http://localhost/Naturamedicatrix/img/pr/default.jpg\" alt=\"Jordan\" /></span>
        <span class=\"employee_profile\">Ravi de vous revoir Jordan</span>
      </div>

      <a class=\"dropdown-item employee-link profile-link\" href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/1/edit?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">
      <i class=\"material-icons\">edit</i>
      <span>Votre profil</span>
    </a>
    </div>

    <p class=\"divider\"></p>

                  <a class=\"dropdown-item \" href=\"https://accounts.distribution.prestashop.net?utm_source=localhost&utm_medium=back-office&utm_campaign=ps_accounts&utm_content=headeremployeedropdownlink\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">open_in_new</i> Gérer votre compte PrestaShop
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://www.prestashop.com/fr/formation?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=training-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">school</i> Formation
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://www.prestashop.com/fr/experts?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=expert-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">person_pin_circle</i> Trouver un expert
        </a>
                          <a cla' | raw }}{{ 'ss=\"dropdown-item ps_mbo\" href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?utm_mbo_source=menu-user-back-office&_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g&utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=addons-fr&utm_mbo_source=menu-user-back-office\"  rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">extension</i> Marketplace Prestashop
        </a>
                          <a class=\"dropdown-item ps_mbo\" href=\"https://help-center.prestashop.com/fr?utm_source=back-office&utm_medium=menu&utm_content=download8_2&utm_campaign=help-center-fr&utm_mbo_source=menu-user-back-office\"  target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">help</i> Centre d\\'assistance
        </a>
                  <p class=\"divider\"></p>
            
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminLogin&amp;logout=1&amp;token=45467cd425938a4538faba714c167471\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Déconnexion</span>
    </a>
  </div>
</div>
        </div>
              </div>
    </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/toggle-navigation?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\">
    <i class=\"material-icons rtl-flip\">chevron_left</i>
    <i class=\"material-icons rtl-flip\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
      <div class=\"logo-container\">
          <a id=\"header_logo\" class=\"logo float-left\" href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\"></a>
          <span id=\"shop_version\" class=\"header-version\">8.2.0</span>
      </div>

      <ul class=\"main-menu\">
              
       ' | raw }}{{ '                                   
                    
          
            <li class=\"category-title link-active\" data-submenu=\"151\" id=\"tab-HOME\">
                <span class=\"title\">Bienvenue</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"152\" id=\"subtab-AdminPsEditionBasicHomepageController\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-home\">home</i>
                      <span>
                      Accueil
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"1\" id=\"subtab-AdminDashboard\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminDashboard&amp;token=0670674f058b05ae85a5f730ff44a095\" class=\"link\">
                      <i class=\"material-icons mi-trending_up\">trending_up</i>
                      <span>
                      Tableau de bord
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
          ' | raw }}{{ '                              </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Vendre</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Commandes
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"s' | raw }}{{ 'ubtab-AdminInvoices\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/invoices/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Factures
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/credit-slips/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Avoirs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/orders/delivery-slips/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Bons de livraison
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarts&amp;token=ec15058ac00c92955895055df8fd8ec4\" class=\"link\"> Paniers
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
      ' | raw }}{{ '                                        
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/products?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalogue
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/products?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/categories?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Catégories
                                </a>
                              </li>

                                ' | raw }}{{ '                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/monitoring/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Suivi
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminAttributesGroups&amp;token=f72d6e1cd99a2045a35010bdd3a55c68\" class=\"link\"> Attributs &amp; caractéristiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/catalog/brands/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Marques et fournisseurs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/attachments/' | raw }}{{ '?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Fichiers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCartRules&amp;token=591fabe76ba99ff58eead03392d3d98c\" class=\"link\"> Réductions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/stocks/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Stock
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/sell/customers/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Clients
                      </span>
                                                    <i class=\"material-icons sub-tab' | raw }}{{ 's-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/customers/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/addresses/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Adresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCustomerThreads&amp;token=041f0c4849da8f5f4c7d4bde72e1fd44\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
   ' | raw }}{{ '                   <span>
                      SAV
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCustomerThreads&amp;token=041f0c4849da8f5f4c7d4bde72e1fd44\" class=\"link\"> SAV
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/sell/customer-service/order-messages/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Messages prédéfinis
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminReturn&amp;token=608ecd2b845d55eec6a193b328ae047a\" class=\"link\">' | raw }}{{ ' Retours produits
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics/legacy/stats?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Statistiques
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"168\" id=\"subtab-AdminMetricsLegacyStatsController\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics/legacy/stats?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Statistiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"169\" id=\"subtab-AdminMetricsController\"' | raw }}{{ '>
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/metrics?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"37\" id=\"tab-IMPROVE\">
                <span class=\"title\">Personnaliser</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"38\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-38\" class=\"submenu panel-collapse\">
                                                                                                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"161\" id=\"subtab-AdminPsMboModuleParent\">
      ' | raw }}{{ '                          <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/modules/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"39\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/modules/manage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Gestionnaire de modules 
                                </a>
                              </li>

                                                                                                                                                                                          </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentThemes\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsThemeCustoConfiguration&amp;token=44108a1b7e04c208ed91d9ad7fa74c85\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Apparence
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=' | raw }}{{ '\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"170\" id=\"subtab-AdminThemesParent\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsThemeCustoConfiguration&amp;token=44108a1b7e04c208ed91d9ad7fa74c85\" class=\"link\"> Modules du thème
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"165\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/mbo/themes/catalog/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Catalogue de thèmes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"136\" id=\"subtab-AdminPsxDesignParentTab\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/improve/design/themes?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Personnalisation
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"45\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/Naturamedica' | raw }}{{ 'trix/admin123/index.php/improve/design/mail_theme/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Thème d&#039;e-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"47\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/design/cms-pages/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/design/modules/positions/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"49\" id=\"subtab-AdminImages\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminImages&amp;token=3a7f70a244a5bac8dc66d67d192e80b6\" class=\"link\"> Images
                                </a>
                              </li>

                                                                                  
                              
                                                            
         ' | raw }}{{ '                     <li class=\"link-leveltwo\" data-submenu=\"118\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/modules/link-widget/list?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Liste de liens
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"50\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarriers&amp;token=88cfd81d0e4c27fdb4d9a839ed298fe2\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Livraison
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-50\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"51\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminCarriers&amp;token=88cfd81d0e4c27fdb4d9a839ed298fe2\" class=\"link\"> Transporteurs
                                </a>
                              </li>

                     ' | raw }}{{ '                                                             
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"52\" id=\"subtab-AdminShipping\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/shipping/preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"53\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/payment_methods?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Paiement
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-53\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"54\" id=\"subtab-AdminPayment\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/payment_methods?_token=86jmVRmw0mFZtFxSHl8kCJV' | raw }}{{ '-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Moyens de paiement
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/payment/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Préférences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"56\" id=\"subtab-AdminInternational\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/localization/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      International
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-56\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5' | raw }}{{ '7\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/localization/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Localisation
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/zones/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Zones géographiques
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"66\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/taxes/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Taxes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"69\" id=\"subtab-AdminTranslations\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/improve/international/translations/settings?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Traductions
                                </a>
                              </li>

                                                        ' | raw }}{{ '                      </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"141\" id=\"subtab-Marketing\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=9dcb6e8b1946c5a25171d32a99646b1f\" class=\"link\">
                      <i class=\"material-icons mi-campaign\">campaign</i>
                      <span>
                      Marketing
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-141\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"142\" id=\"subtab-AdminPsxMktgWithGoogleModule\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=9dcb6e8b1946c5a25171d32a99646b1f\" class=\"link\"> Google
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"157\" id=\"subtab-AdminPsfacebookModule\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsfacebookModule' | raw }}{{ '&amp;token=e61c2a26a664e692dfbdb9fc7e836173\" class=\"link\"> Facebook &amp; Instagram
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"70\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configurer</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"153\" id=\"subtab-AdminPsEditionBasicSettingsController\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/settings?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Paramètres
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"71\" id=\"subtab-ShopParameters\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/preferences/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <spa' | raw }}{{ 'n>
                      Paramètres de la boutique
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-71\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/preferences/preferences?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Paramètres généraux
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"75\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/order-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Commandes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"78\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/product-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx' | raw }}{{ '1ES4wHv88g\" class=\"link\"> Produits
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/customer-preferences/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Clients
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"83\" id=\"subtab-AdminParentStores\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/contacts/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Contact
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"86\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/shop/seo-urls/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Trafic et SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminPare' | raw }}{{ 'ntSearchConf\">
                                <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminSearchConf&amp;token=432c03000b120fdd5314e0b764a6175d\" class=\"link\"> Rechercher
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"92\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/system-information/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Paramètres avancés
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-92\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminInformation\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/system-information/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Informations
                                </a>
                              </li>

                                                    ' | raw }}{{ '                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"94\" id=\"subtab-AdminPerformance\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/performance/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Performances
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"95\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/administration/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminEmails\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/emails/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"97\" id=\"subtab-AdminImport\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/import/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" c' | raw }}{{ 'lass=\"link\"> Importer
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"98\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/employees/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Équipe
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"102\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/sql-requests/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Base de données
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminLogs\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/logs/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminWebservice\">
            ' | raw }}{{ '                    <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/webservice-keys/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                                                                                    
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"110\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/feature-flags/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Fonctionnalités nouvelles et expérimentales
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"111\" id=\"subtab-AdminParentSecurity\">
                                <a href=\"/Naturamedicatrix/admin123/index.php/configure/advanced/security/?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"link\"> Security
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"127\" id=\"subtab-AdminKlaviyoPsConfig\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminKla' | raw }}{{ 'viyoPsConfig&amp;token=37cd73949dbbf4e3cbf1e2722b4ea0da\" class=\"link\">
                      <i class=\"material-icons mi-trending_up\">trending_up</i>
                      <span>
                      Klaviyo
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"129\" id=\"subtab-AdminPsAssistantSettings\">
                    <a href=\"http://localhost/Naturamedicatrix/admin123/index.php?controller=AdminPsAssistantSettings&amp;token=65c0e9556d54670d67b6cc677916af1b\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Assistance By PrestaShop
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>


<div class=\"header-toolbar d-print-none\">
    
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" aria-current=\"page\">Bienve' | raw }}{{ 'nue</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Accueil          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                        
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Aide\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"https://help.prestashop-project.org/fr/doc/HOME?version=8.2.0&amp;country=fr\"
                   id=\"product_form_open_help\"
                >
                  Aide
                </a>
                                    </div>
        </div>

      
    </div>
  </div>

  
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
        
                              <a class=\"btn btn-floating-item btn-help btn-sidebar\" href=\"#\"
               title=\"Aide\"
               data-toggle=\"sidebar\"
               data-target=\"#right-sidebar\"
               data-url=\"https://help.prestashop-project.org/fr/doc/HOME?version=8.2.0&amp;country=fr\"
            >
              Aide
            </a>
                        </div>
    </div>
  </div>
  
</div>

<div id=\"main-div\">
          
      <div class=\"content-div  \">

        

                                                        
        <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>
<div id=\"content-message-box\"></div>


  ' | raw }}{% block content_header %}{% endblock %}{% block content %}{% endblock %}{% block content_footer %}{% endblock %}{% block sidebar_right %}{% endblock %}{{ '

        

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>Oh non !</h1>
  <p class=\"mt-3\">
    La version mobile de cette page n\\'est pas encore disponible.
  </p>
  <p class=\"mt-2\">
    Cette page n\\'est pas encore disponible sur mobile, merci de la consulter sur ordinateur.
  </p>
  <p class=\"mt-2\">
    Merci.
  </p>
  <a href=\"/Naturamedicatrix/admin123/index.php/modules/pseditionbasic/homepage?_token=86jmVRmw0mFZtFxSHl8kCJV-6XoP0wJJx1ES4wHv88g\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons rtl-flip\">arrow_back</i>
    Précédent
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      
    </div>
  
' | raw }}{% block javascripts %}{% endblock %}{% block extra_javascripts %}{% endblock %}{% block translate_javascripts %}{% endblock %}</body>{{ '
</html>' | raw }}", "__string_template__58537f77f16e5e679f0ff4eb56cc9f21", "");
    }
}
