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

/* @Modules/psxdesign/views/templates/components/color_input.html.twig */
class __TwigTemplate_c8c044e1b0c84a77c3d273fccf7452cd extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/color_input.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/color_input.html.twig"));

        // line 25
        echo "
";
        // line 37
        echo "
<fieldset class=\"color-input\" ";
        // line 38
        echo (((array_key_exists("disabled", $context) && ((isset($context["disabled"]) || array_key_exists("disabled", $context) ? $context["disabled"] : (function () { throw new RuntimeError('Variable "disabled" does not exist.', 38, $this->source); })()) == true))) ? ("disabled") : (""));
        echo ">
    <input
            class=\"color-input__color\" name=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 40, $this->source); })()), "name", [], "any", false, false, false, 40), "html", null, true);
        echo "\"
            id=\"";
        // line 41
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["color"] ?? null), "id_color", [], "any", true, true, false, 41)) ? (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 41, $this->source); })()), "id_color", [], "any", false, false, false, 41)) : ((twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 41, $this->source); })()), "name", [], "any", false, false, false, 41) . "_color"))), "html", null, true);
        echo "\"
            type=\"color\" value=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 42, $this->source); })()), "value", [], "any", false, false, false, 42), "html", null, true);
        echo "\" ";
        echo (((twig_get_attribute($this->env, $this->source, ($context["color"] ?? null), "required", [], "any", true, true, false, 42) && (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 42, $this->source); })()), "required", [], "any", false, false, false, 42) == true))) ? ("required=\"\"") : (""));
        echo "
    >
    <input
            class=\"color-input__hex\" type=\"text\"
            id=\"";
        // line 46
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["color"] ?? null), "id_hex", [], "any", true, true, false, 46)) ? (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 46, $this->source); })()), "id_hex", [], "any", false, false, false, 46)) : ((twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 46, $this->source); })()), "name", [], "any", false, false, false, 46) . "_hex"))), "html", null, true);
        echo "\"
            maxlength=\"7\"
            pattern=\"^#+([a-fA-F0-9]{6})\$\"
            value=\"";
        // line 49
        ((twig_get_attribute($this->env, $this->source, ($context["color"] ?? null), "value", [], "any", true, true, false, 49)) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 49, $this->source); })()), "value", [], "any", false, false, false, 49), "html", null, true))) : (print ("#000000")));
        echo "\"
            aria-label=\"";
        // line 50
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["color"] ?? null), "aria_label_hex", [], "any", true, true, false, 50)) ? (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 50, $this->source); })()), "aria_label_hex", [], "any", false, false, false, 50)) : ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Hexadecimal color", [], "Modules.Psxdesign.Admin"))), "html", null, true);
        echo "\"
            aria-describedby=\"";
        // line 51
        echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 51, $this->source); })()), "name", [], "any", false, false, false, 51) . "_error"), "html", null, true);
        echo "\"
    >
    <button
            type=\"button\"
            class=\"input_color__copy\"
            aria-label=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Copy", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "\"
            data-original-title=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Copy", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "\"
            data-updated-title=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Copied", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo " <span class='material-icons'>done</span>\"
            data-toggle=\"pstooltip\"
            data-placement=\"left\"
    >
        <span class=\"material-icons input_color__copy_icon\">
            content_copy
        </span>
    </button>
    <div id=\"";
        // line 66
        echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, (isset($context["color"]) || array_key_exists("color", $context) ? $context["color"] : (function () { throw new RuntimeError('Variable "color" does not exist.', 66, $this->source); })()), "name", [], "any", false, false, false, 66) . "_error"), "html", null, true);
        echo "\" class=\"color-input__error\" role=\"alert\">
        <p class=\"error__message\">
            ";
        // line 68
        echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Enter a valid [1]hex code[/1] or use the color picker.", ["[1]" => "<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" class=\"external-link\" target=\"_blank\" rel=\"noopener\">", "[/1]" => "</a>"], "Modules.Psxdesign.Admin"), "<a>");
        echo "
        </p>
    </div>
</fieldset>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/components/color_input.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 68,  112 => 66,  101 => 58,  97 => 57,  93 => 56,  85 => 51,  81 => 50,  77 => 49,  71 => 46,  62 => 42,  58 => 41,  54 => 40,  49 => 38,  46 => 37,  43 => 25,);
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

{#
color input parameters
- disabled: change the state for all the inputs to disabled / enabled
- color:
    - name: name use into form
    - id_color: id used by input color (by default color.name + '_color')
    - id_hex: id used by input for hex (by default color.name + '_hex')
    - value: default value of the inputs
    - required: input color is / is not required (by default false)
    - aria_label_hex: value of aria-label to input hex (by default 'Hexadecimal color')
#}

<fieldset class=\"color-input\" {{ disabled is defined and disabled == true ? 'disabled' : '' }}>
    <input
            class=\"color-input__color\" name=\"{{ color.name }}\"
            id=\"{{ color.id_color is defined ? color.id_color : color.name ~ '_color' }}\"
            type=\"color\" value=\"{{ color.value }}\" {{ color.required is defined and color.required == true ? 'required=\"\"' : '' }}
    >
    <input
            class=\"color-input__hex\" type=\"text\"
            id=\"{{ color.id_hex is defined ? color.id_hex : color.name ~ '_hex' }}\"
            maxlength=\"7\"
            pattern=\"^#+([a-fA-F0-9]{6})\$\"
            value=\"{{ color.value is defined ? color.value : '#000000' }}\"
            aria-label=\"{{ color.aria_label_hex is defined ? color.aria_label_hex : 'Hexadecimal color'|trans({}, 'Modules.Psxdesign.Admin') }}\"
            aria-describedby=\"{{  color.name ~ '_error' }}\"
    >
    <button
            type=\"button\"
            class=\"input_color__copy\"
            aria-label=\"{{ 'Copy'|trans({}, 'Modules.Psxdesign.Admin') }}\"
            data-original-title=\"{{ 'Copy'|trans({}, 'Modules.Psxdesign.Admin') }}\"
            data-updated-title=\"{{ 'Copied'|trans({}, 'Modules.Psxdesign.Admin') }} <span class='material-icons'>done</span>\"
            data-toggle=\"pstooltip\"
            data-placement=\"left\"
    >
        <span class=\"material-icons input_color__copy_icon\">
            content_copy
        </span>
    </button>
    <div id=\"{{  color.name ~ '_error' }}\" class=\"color-input__error\" role=\"alert\">
        <p class=\"error__message\">
            {{ 'Enter a valid [1]hex code[/1] or use the color picker.'|trans({'[1]': '<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" class=\"external-link\" target=\"_blank\" rel=\"noopener\">', '[/1]': '</a>'}, 'Modules.Psxdesign.Admin')|striptags('<a>')|raw }}
        </p>
    </div>
</fieldset>
", "@Modules/psxdesign/views/templates/components/color_input.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\components\\color_input.html.twig");
    }
}
