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

/* @Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig */
class __TwigTemplate_b03a3d73ce434ad13568763737ea7067 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->loadTemplate("@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", 26, "1951922980")->display($context);
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 26,  43 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *#}

{% embed '@Modules/psxdesign/views/templates/components/gateway.html.twig' %}
    {% block gateway_header %}
        <h2 class=\"h3 mb-3\">{{ 'Use a compatible theme to customize colors'|trans({}, 'Modules.Psxdesign.Admin') }}</h2>
    {% endblock %}
    {% block gateway_content %}
        <img class=\"d-block mx-auto mb-3\" src=\"{{ asset('../modules/psxdesign/views/img/custom_design.png') }}\" alt=\"{{ 'Customize your theme image'|trans({}, 'Modules.Psxdesign.Admin') }}\"/>
        <p class=\"text-muted mb-3\">
            {{ 'Choose a theme from the list in the Themes page.'|trans({}, 'Modules.Psxdesign.Admin') }}
        </p>
    {% endblock %}
    {% block gateway_footer %}
        <div class=\"d-flex flex-wrap form-group inline-switch-widget mb-0\">
            <a class=\"btn btn-outline-primary flex-grow-1\" href=\"{{ path('admin_psxdesign_themes_index') }}\"><i class=\"material-icons\">arrow_back</i> {{ 'Go to Themes'|trans({}, 'Modules.Psxdesign.Admin') }}</a>
        </div>
    {% endblock %}
{% endembed %}
", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\Blocks\\Gateway\\color_feature_disabled_gateway.html.twig");
    }
}


/* @Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig */
class __TwigTemplate_b03a3d73ce434ad13568763737ea7067___1951922980 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'gateway_header' => [$this, 'block_gateway_header'],
            'gateway_content' => [$this, 'block_gateway_content'],
            'gateway_footer' => [$this, 'block_gateway_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@Modules/psxdesign/views/templates/components/gateway.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig"));

        $this->parent = $this->loadTemplate("@Modules/psxdesign/views/templates/components/gateway.html.twig", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", 26);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 27
    public function block_gateway_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_header"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_header"));

        // line 28
        echo "        <h2 class=\"h3 mb-3\">";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Use a compatible theme to customize colors", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</h2>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 30
    public function block_gateway_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_content"));

        // line 31
        echo "        <img class=\"d-block mx-auto mb-3\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("../modules/psxdesign/views/img/custom_design.png"), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Customize your theme image", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "\"/>
        <p class=\"text-muted mb-3\">
            ";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Choose a theme from the list in the Themes page.", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
        </p>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 36
    public function block_gateway_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "gateway_footer"));

        // line 37
        echo "        <div class=\"d-flex flex-wrap form-group inline-switch-widget mb-0\">
            <a class=\"btn btn-outline-primary flex-grow-1\" href=\"";
        // line 38
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_psxdesign_themes_index");
        echo "\"><i class=\"material-icons\">arrow_back</i> ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Go to Themes", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</a>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 38,  226 => 37,  216 => 36,  203 => 33,  195 => 31,  185 => 30,  172 => 28,  162 => 27,  46 => 26,  43 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *#}

{% embed '@Modules/psxdesign/views/templates/components/gateway.html.twig' %}
    {% block gateway_header %}
        <h2 class=\"h3 mb-3\">{{ 'Use a compatible theme to customize colors'|trans({}, 'Modules.Psxdesign.Admin') }}</h2>
    {% endblock %}
    {% block gateway_content %}
        <img class=\"d-block mx-auto mb-3\" src=\"{{ asset('../modules/psxdesign/views/img/custom_design.png') }}\" alt=\"{{ 'Customize your theme image'|trans({}, 'Modules.Psxdesign.Admin') }}\"/>
        <p class=\"text-muted mb-3\">
            {{ 'Choose a theme from the list in the Themes page.'|trans({}, 'Modules.Psxdesign.Admin') }}
        </p>
    {% endblock %}
    {% block gateway_footer %}
        <div class=\"d-flex flex-wrap form-group inline-switch-widget mb-0\">
            <a class=\"btn btn-outline-primary flex-grow-1\" href=\"{{ path('admin_psxdesign_themes_index') }}\"><i class=\"material-icons\">arrow_back</i> {{ 'Go to Themes'|trans({}, 'Modules.Psxdesign.Admin') }}</a>
        </div>
    {% endblock %}
{% endembed %}
", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\Blocks\\Gateway\\color_feature_disabled_gateway.html.twig");
    }
}
