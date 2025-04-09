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

/* @Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig */
class __TwigTemplate_76facdffb0e4e6591f172f775b0b2f00 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig"));

        // line 25
        echo "
";
        // line 27
        echo "<div class=\"col-12 col-lg-8\">
    <ul class=\"row row-cols-1 row-cols-sm-2 row-cols-lg-1 row-cols-xl-2 list-unstyled\">
        ";
        // line 29
        $context["themes"] = twig_sort_filter($this->env, (isset($context["notUsedThemes"]) || array_key_exists("notUsedThemes", $context) ? $context["notUsedThemes"] : (function () { throw new RuntimeError('Variable "notUsedThemes" does not exist.', 29, $this->source); })()), function ($__a__, $__b__) use ($context, $macros) { $context["a"] = $__a__; $context["b"] = $__b__; return (twig_get_attribute($this->env, $this->source, (isset($context["a"]) || array_key_exists("a", $context) ? $context["a"] : (function () { throw new RuntimeError('Variable "a" does not exist.', 29, $this->source); })()), "display_name", [], "any", false, false, false, 29) <=> twig_get_attribute($this->env, $this->source, (isset($context["b"]) || array_key_exists("b", $context) ? $context["b"] : (function () { throw new RuntimeError('Variable "b" does not exist.', 29, $this->source); })()), "display_name", [], "any", false, false, false, 29)); });
        // line 30
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["themes"]) || array_key_exists("themes", $context) ? $context["themes"] : (function () { throw new RuntimeError('Variable "themes" does not exist.', 30, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 31
            echo "            ";
            $this->loadTemplate("@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig", 31, "269232707")->display(twig_array_merge($context, $context["theme"]));
            // line 75
            echo "        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "    </ul>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 76,  73 => 75,  70 => 31,  52 => 30,  50 => 29,  46 => 27,  43 => 25,);
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
    <ul class=\"row row-cols-1 row-cols-sm-2 row-cols-lg-1 row-cols-xl-2 list-unstyled\">
        {% set themes = notUsedThemes|sort((a, b) => a.display_name <=> b.display_name) %}
        {% for theme in themes %}
            {% embed '@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig' with theme  %}
                {% block image %}
                    <div class=\"theme-preview theme-preview--single\">
                        {% if theme.demoUrl is defined and theme.demoUrl is not null %}
                            <div class=\"theme-preview--demo-container\">
                                <a href=\"{{ theme.demoUrl }}\" target=\"_blank\" rel=\"noopener\" class=\"btn btn-primary\">
                                    {{ 'View demo'|trans({}, 'Modules.Psxdesign.Admin') }}
                                    <i class=\"material-icons\">open_in_new</i>
                                </a>
                            </div>
                        {% endif %}
                        {% if theme.preview is defined %}
                            <img
                                src=\"{{ baseShopUrl }}{{ theme.preview }}\"
                                alt=\"{{ 'desktop preview of the theme %theme%'|trans({ '%theme%': theme.display_name is defined and theme.display_name is not null ? theme.display_name : '' }, 'Modules.Psxdesign.Admin') }}\"
                            />
                        {% endif %}
                    </div>
                {% endblock %}
                {% block button_container %}
                    {% if theme.name != 'classic' %}
                        <button
                                type=\"button\"
                                class=\"flex-fill btn btn-outline-danger js-open-delete-theme-modal\"
                                data-toggle=\"modal\"
                                data-target=\"#delete_theme_modal\"
                                data-action=\"{{ path('admin_themes_delete', {'themeName': theme.name}) }}\"
                                data-theme-name=\"{{ theme.display_name }}\"
                        >
                            {{ 'Delete'|trans({}, 'Modules.Psxdesign.Admin') }}
                        </button>
                    {% endif %}
                    <button
                            type=\"button\"
                            class=\"flex-fill btn btn-outline-primary js-open-use-theme-modal\"
                            data-toggle=\"modal\"
                            data-target=\"#use_theme_modal\" {{ (not isSingleShopContext) ? 'disabled' : '' }}
                            data-action=\"{{ path('admin_themes_enable', {'themeName': theme.name}) }}\"
                            data-theme-name=\"{{ theme.display_name }}\"
                    >
                        {{ 'Use'|trans({}, 'Modules.Psxdesign.Admin') }}
                    </button>
                {% endblock %}
            {% endembed %}
        {% endfor %}
    </ul>
</div>
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\ThemeLibrary\\theme_library_content.html.twig");
    }
}


/* @Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig */
class __TwigTemplate_76facdffb0e4e6591f172f775b0b2f00___269232707 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'image' => [$this, 'block_image'],
            'button_container' => [$this, 'block_button_container'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 31
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig"));

        $this->parent = $this->loadTemplate("@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig", 31);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 32
    public function block_image($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "image"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "image"));

        // line 33
        echo "                    <div class=\"theme-preview theme-preview--single\">
                        ";
        // line 34
        if ((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "demoUrl", [], "any", true, true, false, 34) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 34, $this->source); })()), "demoUrl", [], "any", false, false, false, 34)))) {
            // line 35
            echo "                            <div class=\"theme-preview--demo-container\">
                                <a href=\"";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 36, $this->source); })()), "demoUrl", [], "any", false, false, false, 36), "html", null, true);
            echo "\" target=\"_blank\" rel=\"noopener\" class=\"btn btn-primary\">
                                    ";
            // line 37
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("View demo", [], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "
                                    <i class=\"material-icons\">open_in_new</i>
                                </a>
                            </div>
                        ";
        }
        // line 42
        echo "                        ";
        if (twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "preview", [], "any", true, true, false, 42)) {
            // line 43
            echo "                            <img
                                src=\"";
            // line 44
            echo twig_escape_filter($this->env, (isset($context["baseShopUrl"]) || array_key_exists("baseShopUrl", $context) ? $context["baseShopUrl"] : (function () { throw new RuntimeError('Variable "baseShopUrl" does not exist.', 44, $this->source); })()), "html", null, true);
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 44, $this->source); })()), "preview", [], "any", false, false, false, 44), "html", null, true);
            echo "\"
                                alt=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("desktop preview of the theme %theme%", ["%theme%" => (((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "display_name", [], "any", true, true, false, 45) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 45, $this->source); })()), "display_name", [], "any", false, false, false, 45)))) ? (twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 45, $this->source); })()), "display_name", [], "any", false, false, false, 45)) : (""))], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "\"
                            />
                        ";
        }
        // line 48
        echo "                    </div>
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 50
    public function block_button_container($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "button_container"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "button_container"));

        // line 51
        echo "                    ";
        if ((twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 51, $this->source); })()), "name", [], "any", false, false, false, 51) != "classic")) {
            // line 52
            echo "                        <button
                                type=\"button\"
                                class=\"flex-fill btn btn-outline-danger js-open-delete-theme-modal\"
                                data-toggle=\"modal\"
                                data-target=\"#delete_theme_modal\"
                                data-action=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_themes_delete", ["themeName" => twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 57, $this->source); })()), "name", [], "any", false, false, false, 57)]), "html", null, true);
            echo "\"
                                data-theme-name=\"";
            // line 58
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 58, $this->source); })()), "display_name", [], "any", false, false, false, 58), "html", null, true);
            echo "\"
                        >
                            ";
            // line 60
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Delete", [], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "
                        </button>
                    ";
        }
        // line 63
        echo "                    <button
                            type=\"button\"
                            class=\"flex-fill btn btn-outline-primary js-open-use-theme-modal\"
                            data-toggle=\"modal\"
                            data-target=\"#use_theme_modal\" ";
        // line 67
        echo (( !(isset($context["isSingleShopContext"]) || array_key_exists("isSingleShopContext", $context) ? $context["isSingleShopContext"] : (function () { throw new RuntimeError('Variable "isSingleShopContext" does not exist.', 67, $this->source); })())) ? ("disabled") : (""));
        echo "
                            data-action=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_themes_enable", ["themeName" => twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 68, $this->source); })()), "name", [], "any", false, false, false, 68)]), "html", null, true);
        echo "\"
                            data-theme-name=\"";
        // line 69
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["theme"]) || array_key_exists("theme", $context) ? $context["theme"] : (function () { throw new RuntimeError('Variable "theme" does not exist.', 69, $this->source); })()), "display_name", [], "any", false, false, false, 69), "html", null, true);
        echo "\"
                    >
                        ";
        // line 71
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Use", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
                    </button>
                ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  353 => 71,  348 => 69,  344 => 68,  340 => 67,  334 => 63,  328 => 60,  323 => 58,  319 => 57,  312 => 52,  309 => 51,  299 => 50,  288 => 48,  282 => 45,  277 => 44,  274 => 43,  271 => 42,  263 => 37,  259 => 36,  256 => 35,  254 => 34,  251 => 33,  241 => 32,  218 => 31,  87 => 76,  73 => 75,  70 => 31,  52 => 30,  50 => 29,  46 => 27,  43 => 25,);
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
    <ul class=\"row row-cols-1 row-cols-sm-2 row-cols-lg-1 row-cols-xl-2 list-unstyled\">
        {% set themes = notUsedThemes|sort((a, b) => a.display_name <=> b.display_name) %}
        {% for theme in themes %}
            {% embed '@Modules/psxdesign/views/templates/admin/themes/Blocks/Partials/theme_card.html.twig' with theme  %}
                {% block image %}
                    <div class=\"theme-preview theme-preview--single\">
                        {% if theme.demoUrl is defined and theme.demoUrl is not null %}
                            <div class=\"theme-preview--demo-container\">
                                <a href=\"{{ theme.demoUrl }}\" target=\"_blank\" rel=\"noopener\" class=\"btn btn-primary\">
                                    {{ 'View demo'|trans({}, 'Modules.Psxdesign.Admin') }}
                                    <i class=\"material-icons\">open_in_new</i>
                                </a>
                            </div>
                        {% endif %}
                        {% if theme.preview is defined %}
                            <img
                                src=\"{{ baseShopUrl }}{{ theme.preview }}\"
                                alt=\"{{ 'desktop preview of the theme %theme%'|trans({ '%theme%': theme.display_name is defined and theme.display_name is not null ? theme.display_name : '' }, 'Modules.Psxdesign.Admin') }}\"
                            />
                        {% endif %}
                    </div>
                {% endblock %}
                {% block button_container %}
                    {% if theme.name != 'classic' %}
                        <button
                                type=\"button\"
                                class=\"flex-fill btn btn-outline-danger js-open-delete-theme-modal\"
                                data-toggle=\"modal\"
                                data-target=\"#delete_theme_modal\"
                                data-action=\"{{ path('admin_themes_delete', {'themeName': theme.name}) }}\"
                                data-theme-name=\"{{ theme.display_name }}\"
                        >
                            {{ 'Delete'|trans({}, 'Modules.Psxdesign.Admin') }}
                        </button>
                    {% endif %}
                    <button
                            type=\"button\"
                            class=\"flex-fill btn btn-outline-primary js-open-use-theme-modal\"
                            data-toggle=\"modal\"
                            data-target=\"#use_theme_modal\" {{ (not isSingleShopContext) ? 'disabled' : '' }}
                            data-action=\"{{ path('admin_themes_enable', {'themeName': theme.name}) }}\"
                            data-theme-name=\"{{ theme.display_name }}\"
                    >
                        {{ 'Use'|trans({}, 'Modules.Psxdesign.Admin') }}
                    </button>
                {% endblock %}
            {% endembed %}
        {% endfor %}
    </ul>
</div>
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/ThemeLibrary/theme_library_content.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\ThemeLibrary\\theme_library_content.html.twig");
    }
}
