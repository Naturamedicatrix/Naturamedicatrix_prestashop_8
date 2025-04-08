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

/* @Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig */
class __TwigTemplate_3b72cd6ba6bbe9ea839e2175ce6ddccc extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'card_content' => [$this, 'block_card_content'],
            'image' => [$this, 'block_image'],
            'button_container' => [$this, 'block_button_container'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 25
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card_container.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig"));

        $this->parent = $this->loadTemplate("@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card_container.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig", 25);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 27
    public function block_card_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "card_content"));

        // line 28
        echo "    <article class=\"card d-flex justify-content-between align-items-stretch h-100\" data-role=\"theme-card-container\">
        <header class=\"p-3 mb-auto\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <h3 class=\"h4 mb-1 text-truncate\">
                    ";
        // line 32
        if ((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "display_name", [], "any", true, true, false, 32) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 32, $this->source); })()), "display_name", [], "any", false, false, false, 32)))) {
            // line 33
            echo "                        ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 33, $this->source); })()), "display_name", [], "any", false, false, false, 33), "html", null, true);
            echo "
                    ";
        } else {
            // line 35
            echo "                        &nbsp;
                    ";
        }
        // line 37
        echo "                </h3>
            </div>
            <span class=\"small-text text-muted d-block\">
                ";
        // line 40
        if ((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "version", [], "any", true, true, false, 40) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 40, $this->source); })()), "version", [], "any", false, false, false, 40)))) {
            // line 41
            echo "                    ";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("v%version%", ["%version%" => twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 41, $this->source); })()), "version", [], "any", false, false, false, 41)], "Modules.Psxdesign.Admin"), "html", null, true);
            echo " -
                ";
        }
        // line 43
        echo "                ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "author", [], "any", false, true, false, 43), "name", [], "any", true, true, false, 43) &&  !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 43, $this->source); })()), "author", [], "any", false, false, false, 43), "name", [], "any", false, false, false, 43)))) {
            // line 44
            echo "                    ";
            echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Developed by %author%", ["%author%" => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 45
($context["theme"] ?? null), "author", [], "array", false, true, false, 45), "url", [], "array", true, true, false, 45)) ? ((((("<a href=\"" . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 46
(isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 46, $this->source); })()), "author", [], "array", false, false, false, 46), "url", [], "array", false, false, false, 46)) . "\" target=\"_blank\" rel=\"noopener\">") . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 46, $this->source); })()), "author", [], "any", false, false, false, 46), "name", [], "any", false, false, false, 46)) . "</a>")) : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 47
(isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 47, $this->source); })()), "author", [], "any", false, false, false, 47), "name", [], "any", false, false, false, 47)))], "Modules.Psxdesign.Admin"), "<a>");
            // line 48
            echo "
                ";
        }
        // line 50
        echo "                ";
        if ((( !twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "version", [], "any", true, true, false, 50) || (null === twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 50, $this->source); })()), "version", [], "any", false, false, false, 50))) && ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "author", [], "any", false, true, false, 50), "name", [], "any", true, true, false, 50) || (null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 50, $this->source); })()), "author", [], "any", false, false, false, 50), "name", [], "any", false, false, false, 50))))) {
            // line 51
            echo "                    &nbsp;
                ";
        }
        // line 53
        echo "            </span>
            ";
        // line 54
        if ((array_key_exists("category", $context) &&  !twig_test_empty((isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 54, $this->source); })())))) {
            // line 55
            echo "                <span class=\"badge badge-outlined-secondary mt-3\">";
            echo twig_escape_filter($this->env, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 55, $this->source); })()), "html", null, true);
            echo "</span>
            ";
        }
        // line 57
        echo "        </header>
        <div class=\"px-3\">
            ";
        // line 59
        $this->displayBlock('image', $context, $blocks);
        // line 61
        echo "        </div>
        <footer class=\"p-3 d-flex flex-wrap form-group inline-switch-widget mb-0\">
            ";
        // line 63
        $this->displayBlock('button_container', $context, $blocks);
        // line 65
        echo "        </footer>
    </article>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 59
    public function block_image($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "image"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "image"));

        // line 60
        echo "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 63
    public function block_button_container($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "button_container"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "button_container"));

        // line 64
        echo "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 64,  176 => 63,  166 => 60,  156 => 59,  144 => 65,  142 => 63,  138 => 61,  136 => 59,  132 => 57,  126 => 55,  124 => 54,  121 => 53,  117 => 51,  114 => 50,  110 => 48,  108 => 47,  107 => 46,  106 => 45,  104 => 44,  101 => 43,  95 => 41,  93 => 40,  88 => 37,  84 => 35,  78 => 33,  76 => 32,  70 => 28,  60 => 27,  37 => 25,);
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
{% extends '@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card_container.html.twig' %}

{% block card_content %}
    <article class=\"card d-flex justify-content-between align-items-stretch h-100\" data-role=\"theme-card-container\">
        <header class=\"p-3 mb-auto\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <h3 class=\"h4 mb-1 text-truncate\">
                    {% if theme.display_name is defined and theme.display_name is not null %}
                        {{  theme.display_name }}
                    {% else %}
                        &nbsp;
                    {% endif %}
                </h3>
            </div>
            <span class=\"small-text text-muted d-block\">
                {% if theme.version is defined and theme.version is not null %}
                    {{ 'v%version%'|trans({'%version%': theme.version}, 'Modules.Psxdesign.Admin') }} -
                {% endif %}
                {% if theme.author.name is defined and theme.author.name is not null %}
                    {{ 'Developed by %author%'|trans({
                        '%author%': theme['author']['url'] is defined
                            ? '<a href=\"' ~ theme['author']['url'] ~ '\" target=\"_blank\" rel=\"noopener\">' ~ theme.author.name ~ '</a>'
                            :  theme.author.name
                    }, 'Modules.Psxdesign.Admin')|striptags('<a>')|raw }}
                {% endif %}
                {% if (theme.version is not defined or theme.version is null) and (theme.author.name is not defined or theme.author.name is null) %}
                    &nbsp;
                {% endif %}
            </span>
            {% if category is defined and category is not empty %}
                <span class=\"badge badge-outlined-secondary mt-3\">{{ category }}</span>
            {% endif %}
        </header>
        <div class=\"px-3\">
            {% block image %}
            {% endblock %}
        </div>
        <footer class=\"p-3 d-flex flex-wrap form-group inline-switch-widget mb-0\">
            {% block button_container %}
            {% endblock %}
        </footer>
    </article>
{% endblock %}
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\Partials\\theme_card.html.twig");
    }
}
