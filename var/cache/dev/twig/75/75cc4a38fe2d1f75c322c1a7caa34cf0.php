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

/* @Modules/psxdesign/views/templates/admin/themes/Blocks/CurrentTheme/current_theme_content.html.twig */
class __TwigTemplate_aa2ba1c60740261df582f20cb945b27c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/CurrentTheme/current_theme_content.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/CurrentTheme/current_theme_content.html.twig"));

        // line 25
        echo "
";
        // line 27
        echo "<div class=\"col-12 col-lg-8\">
    <section class=\"card\">
        <header class=\"p-3\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <h3 class=\"h4 mb-1\">
                        ";
        // line 33
        if ((twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "display_name", [], "any", true, true, false, 33) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 33, $this->source); })()), "display_name", [], "any", false, false, false, 33)))) {
            // line 34
            echo "                            ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 34, $this->source); })()), "display_name", [], "any", false, false, false, 34), "html", null, true);
            echo "
                        ";
        } else {
            // line 36
            echo "                            &nbsp;
                        ";
        }
        // line 38
        echo "                    </h3>
                    <span class=\"small-text text-muted\">
                        ";
        // line 40
        if ((twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "version", [], "any", true, true, false, 40) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 40, $this->source); })()), "version", [], "any", false, false, false, 40)))) {
            // line 41
            echo "                            ";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("v%version%", ["%version%" => twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 41, $this->source); })()), "version", [], "any", false, false, false, 41)], "Modules.Psxdesign.Admin"), "html", null, true);
            echo " -
                        ";
        }
        // line 43
        echo "                        ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "author", [], "any", false, true, false, 43), "name", [], "any", true, true, false, 43) &&  !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 43, $this->source); })()), "author", [], "any", false, false, false, 43), "name", [], "any", false, false, false, 43)))) {
            // line 44
            echo "                            ";
            echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Developed by %author%", ["%author%" => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 45
($context["currentlyUsedTheme"] ?? null), "author", [], "any", false, true, false, 45), "url", [], "any", true, true, false, 45)) ? ((((("<a href=\"" . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 46
(isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 46, $this->source); })()), "author", [], "any", false, false, false, 46), "url", [], "any", false, false, false, 46)) . "\" target=\"_blank\" rel=\"noopener\">") . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 46, $this->source); })()), "author", [], "any", false, false, false, 46), "name", [], "any", false, false, false, 46)) . "</a>")) : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 47
(isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 47, $this->source); })()), "author", [], "any", false, false, false, 47), "name", [], "any", false, false, false, 47)))], "Modules.Psxdesign.Admin"), "<a>");
            // line 48
            echo "
                        ";
        }
        // line 50
        echo "                        ";
        if ((( !twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "version", [], "any", true, true, false, 50) || (null === twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 50, $this->source); })()), "version", [], "any", false, false, false, 50))) && ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "author", [], "any", false, true, false, 50), "name", [], "any", true, true, false, 50) || (null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 50, $this->source); })()), "author", [], "any", false, false, false, 50), "name", [], "any", false, false, false, 50))))) {
            // line 51
            echo "                            &nbsp;
                        ";
        }
        // line 53
        echo "                    </span>
                </div>
                <a href=\"";
        // line 55
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 55, $this->source); })()), "customizeUrl", [], "any", false, false, false, 55), "html", null, true);
        echo "\" class=\"btn btn-primary flex-shrink-0 ml-2\"><i class=\"material-icons\">edit</i> ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Customize", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</a>
            </div>
        </header>
        <div class=\"container\">
            <div class=\"theme-preview-container\">
                <div class=\"theme-preview theme-preview--desktop\">
                    ";
        // line 61
        if (twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "preview", [], "any", true, true, false, 61)) {
            // line 62
            echo "                        <img
                            src=\"";
            // line 63
            echo twig_escape_filter($this->env, (isset($context["baseShopUrl"]) || array_key_exists("baseShopUrl", $context) ? $context["baseShopUrl"] : (function () { throw new RuntimeError('Variable "baseShopUrl" does not exist.', 63, $this->source); })()), "html", null, true);
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 63, $this->source); })()), "preview", [], "any", false, false, false, 63), "html", null, true);
            echo "\"
                            alt=\"";
            // line 64
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("desktop preview of the theme %theme%", ["%theme%" => (((twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "display_name", [], "any", true, true, false, 64) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 64, $this->source); })()), "display_name", [], "any", false, false, false, 64)))) ? (twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 64, $this->source); })()), "display_name", [], "any", false, false, false, 64)) : (""))], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "\"
                        />
                    ";
        }
        // line 67
        echo "                </div>
                ";
        // line 68
        if ((twig_get_attribute($this->env, $this->source, ($context["currentlyUsedTheme"] ?? null), "previewMobile", [], "any", true, true, false, 68) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 68, $this->source); })()), "previewMobile", [], "any", false, false, false, 68)))) {
            // line 69
            echo "                    <div class=\"theme-preview-mobile-wrapper\">
                        <div class=\"theme-preview theme-preview--mobile\">
                            <img src=\"";
            // line 71
            echo twig_escape_filter($this->env, (isset($context["baseShopUrl"]) || array_key_exists("baseShopUrl", $context) ? $context["baseShopUrl"] : (function () { throw new RuntimeError('Variable "baseShopUrl" does not exist.', 71, $this->source); })()), "html", null, true);
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 71, $this->source); })()), "previewMobile", [], "any", false, false, false, 71), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("mobile preview of the theme %theme%", ["%theme%" => twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 71, $this->source); })()), "display_name", [], "any", false, false, false, 71)], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "\" />
                        </div>
                    </div>
                ";
        }
        // line 75
        echo "            </div>
        </div>
    </section>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/CurrentTheme/current_theme_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 75,  138 => 71,  134 => 69,  132 => 68,  129 => 67,  123 => 64,  118 => 63,  115 => 62,  113 => 61,  102 => 55,  98 => 53,  94 => 51,  91 => 50,  87 => 48,  85 => 47,  84 => 46,  83 => 45,  81 => 44,  78 => 43,  72 => 41,  70 => 40,  66 => 38,  62 => 36,  56 => 34,  54 => 33,  46 => 27,  43 => 25,);
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

{# TODO: update 'category' with method getting category #}
<div class=\"col-12 col-lg-8\">
    <section class=\"card\">
        <header class=\"p-3\">
            <div class=\"d-flex justify-content-between align-items-start\">
                <div>
                    <h3 class=\"h4 mb-1\">
                        {% if currentlyUsedTheme.display_name is defined and currentlyUsedTheme.display_name is not null %}
                            {{ currentlyUsedTheme.display_name }}
                        {% else %}
                            &nbsp;
                        {% endif %}
                    </h3>
                    <span class=\"small-text text-muted\">
                        {% if currentlyUsedTheme.version is defined and currentlyUsedTheme.version is not null %}
                            {{ 'v%version%'|trans({'%version%': currentlyUsedTheme.version }, 'Modules.Psxdesign.Admin') }} -
                        {% endif %}
                        {% if currentlyUsedTheme.author.name is defined and currentlyUsedTheme.author.name is not null %}
                            {{ 'Developed by %author%'|trans({
                                '%author%': currentlyUsedTheme.author.url is defined
                                ? '<a href=\"' ~ currentlyUsedTheme.author.url ~ '\" target=\"_blank\" rel=\"noopener\">' ~ currentlyUsedTheme.author.name ~ '</a>'
                                :  currentlyUsedTheme.author.name
                            }, 'Modules.Psxdesign.Admin')|striptags('<a>')|raw }}
                        {% endif %}
                        {% if (currentlyUsedTheme.version is not defined or currentlyUsedTheme.version is null) and (currentlyUsedTheme.author.name is not defined or currentlyUsedTheme.author.name is null) %}
                            &nbsp;
                        {% endif %}
                    </span>
                </div>
                <a href=\"{{ currentlyUsedTheme.customizeUrl }}\" class=\"btn btn-primary flex-shrink-0 ml-2\"><i class=\"material-icons\">edit</i> {{ 'Customize'|trans({}, 'Modules.Psxdesign.Admin') }}</a>
            </div>
        </header>
        <div class=\"container\">
            <div class=\"theme-preview-container\">
                <div class=\"theme-preview theme-preview--desktop\">
                    {% if currentlyUsedTheme.preview is defined %}
                        <img
                            src=\"{{ baseShopUrl }}{{ currentlyUsedTheme.preview }}\"
                            alt=\"{{ 'desktop preview of the theme %theme%'|trans({ '%theme%': currentlyUsedTheme.display_name is defined and currentlyUsedTheme.display_name is not null ? currentlyUsedTheme.display_name : '' }, 'Modules.Psxdesign.Admin') }}\"
                        />
                    {% endif %}
                </div>
                {% if currentlyUsedTheme.previewMobile is defined and currentlyUsedTheme.previewMobile is not null %}
                    <div class=\"theme-preview-mobile-wrapper\">
                        <div class=\"theme-preview theme-preview--mobile\">
                            <img src=\"{{ baseShopUrl }}{{ currentlyUsedTheme.previewMobile }}\" alt=\"{{ 'mobile preview of the theme %theme%'|trans({ '%theme%': currentlyUsedTheme.display_name }, 'Modules.Psxdesign.Admin') }}\" />
                        </div>
                    </div>
                {% endif %}
            </div>
        </div>
    </section>
</div>
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/CurrentTheme/current_theme_content.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\CurrentTheme\\current_theme_content.html.twig");
    }
}
