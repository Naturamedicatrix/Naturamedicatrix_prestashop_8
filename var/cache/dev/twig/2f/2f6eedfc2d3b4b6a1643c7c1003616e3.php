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

/* @Modules/psxdesign/views/templates/admin/colors/index.html.twig */
class __TwigTemplate_ace85a70bf357850c46c4264967d06a0 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'colors' => [$this, 'block_colors'],
            'colors_description' => [$this, 'block_colors_description'],
            'colors_content' => [$this, 'block_colors_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 26
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig"));

        // line 28
        $context["formId"] = "current_color_palette";
        // line 26
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", 26);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 30
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 31
        echo "  <div class=\"container position-relative\">
    ";
        // line 32
        if ( !(isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 32, $this->source); })())) {
            // line 33
            echo "        ";
            $this->loadTemplate("@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", 33)->display($context);
            // line 34
            echo "    ";
        }
        // line 35
        echo "    ";
        $this->displayBlock('colors', $context, $blocks);
        // line 45
        echo "    ";
        $this->loadTemplate("@Modules/psxdesign/views/templates/components/save_banner.html.twig", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", 45)->display(twig_array_merge($context, ["form" =>         // line 46
(isset($context["formId"]) || array_key_exists("formId", $context) ? $context["formId"] : (function () { throw new RuntimeError('Variable "formId" does not exist.', 46, $this->source); })())]));
        // line 48
        echo "  </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 35
    public function block_colors($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors"));

        // line 36
        echo "      <form id=\"";
        echo twig_escape_filter($this->env, (isset($context["formId"]) || array_key_exists("formId", $context) ? $context["formId"] : (function () { throw new RuntimeError('Variable "formId" does not exist.', 36, $this->source); })()), "html", null, true);
        echo "\" method=\"POST\" ";
        echo (((isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 36, $this->source); })())) ? ("") : ("disabled"));
        echo " action=\"";
        echo (((isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 36, $this->source); })())) ? ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_psxdesign_upsert_color_palette_action")) : (""));
        echo "\" class=\"row\">
        ";
        // line 37
        $this->displayBlock('colors_description', $context, $blocks);
        // line 40
        echo "        ";
        $this->displayBlock('colors_content', $context, $blocks);
        // line 43
        echo "      </form>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 37
    public function block_colors_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors_description"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors_description"));

        // line 38
        echo "          ";
        $this->loadTemplate("@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", 38)->display($context);
        // line 39
        echo "        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 40
    public function block_colors_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors_content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "colors_content"));

        // line 41
        echo "          ";
        $this->loadTemplate("@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", 41)->display($context);
        // line 42
        echo "        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 42,  171 => 41,  161 => 40,  151 => 39,  148 => 38,  138 => 37,  127 => 43,  124 => 40,  122 => 37,  113 => 36,  103 => 35,  92 => 48,  90 => 46,  88 => 45,  85 => 35,  82 => 34,  79 => 33,  77 => 32,  74 => 31,  64 => 30,  53 => 26,  51 => 28,  38 => 26,);
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

{% extends '@PrestaShop/Admin/layout.html.twig' %}

{% set formId = 'current_color_palette' %}

{% block content %}
  <div class=\"container position-relative\">
    {% if not isColorFeatureEnabled %}
        {% include '@Modules/psxdesign/views/templates/admin/colors/Blocks/Gateway/color_feature_disabled_gateway.html.twig' %}
    {% endif %}
    {% block colors %}
      <form id=\"{{ formId }}\" method=\"POST\" {{ isColorFeatureEnabled ? '' : 'disabled' }} action=\"{{ isColorFeatureEnabled ? path('admin_psxdesign_upsert_color_palette_action') : '' }}\" class=\"row\">
        {% block colors_description %}
          {% include '@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig' %}
        {% endblock %}
        {% block colors_content %}
          {% include '@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig' %}
        {% endblock %}
      </form>
    {% endblock %}
    {% include '@Modules/psxdesign/views/templates/components/save_banner.html.twig' with {
        form: formId
    } %}
  </div>
{% endblock %}
", "@Modules/psxdesign/views/templates/admin/colors/index.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\index.html.twig");
    }
}
