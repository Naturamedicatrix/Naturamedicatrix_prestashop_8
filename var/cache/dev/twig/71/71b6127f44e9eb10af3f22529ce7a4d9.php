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

/* @Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig */
class __TwigTemplate_90b2ba89104c87816f9cf9aecac9f9be extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig"));

        // line 25
        echo "
<div class=\"mb-3\">
    <label class=\"mb-1\" for=\"";
        // line 27
        echo twig_escape_filter($this->env, ((isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 27, $this->source); })()) . "_color"), "html", null, true);
        echo "\">
        <span class=\"sr-only\">";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["category_title"]) || array_key_exists("category_title", $context) ? $context["category_title"] : (function () { throw new RuntimeError('Variable "category_title" does not exist.', 28, $this->source); })()), "html", null, true);
        echo "</span> ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 28, $this->source); })()), "label", [], "any", false, false, false, 28), "html", null, true);
        echo "
    </label>
    ";
        // line 30
        if ((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "id", [], "any", true, true, false, 30) &&  !(null === twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 30, $this->source); })()), "id", [], "any", false, false, false, 30)))) {
            // line 31
            echo "        <input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 31, $this->source); })()), "html", null, true);
            echo "[id]\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 31, $this->source); })()), "id", [], "any", false, false, false, 31), "html", null, true);
            echo "\">
    ";
        }
        // line 33
        echo "    <input type=\"hidden\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 33, $this->source); })()), "html", null, true);
        echo "[palette_id]\" value=\"";
        ((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "paletteId", [], "any", true, true, false, 33)) ? (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 33, $this->source); })()), "paletteId", [], "any", false, false, false, 33), "html", null, true))) : (print (0)));
        echo "\">
    <input type=\"hidden\" name=\"";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 34, $this->source); })()), "html", null, true);
        echo "[variable_name]\" value=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 34, $this->source); })()), "variableName", [], "any", false, false, false, 34), "html", null, true);
        echo "\">
    <input type=\"hidden\" name=\"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 35, $this->source); })()), "html", null, true);
        echo "[variable_type]\" value=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 35, $this->source); })()), "variableType", [], "any", false, false, false, 35), "html", null, true);
        echo "\">
    ";
        // line 36
        $this->loadTemplate("@Modules/psxdesign/views/templates/components/color_input.html.twig", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig", 36)->display(twig_array_merge($context, ["disabled" =>  !        // line 37
(isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 37, $this->source); })()), "color" => ["name" => (        // line 39
(isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 39, $this->source); })()) . "[value]"), "id_color" => (        // line 40
(isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 40, $this->source); })()) . "_color"), "id_hex" => (        // line 41
(isset($context["form_index"]) || array_key_exists("form_index", $context) ? $context["form_index"] : (function () { throw new RuntimeError('Variable "form_index" does not exist.', 41, $this->source); })()) . "_hex"), "value" => twig_get_attribute($this->env, $this->source,         // line 42
(isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 42, $this->source); })()), "value", [], "any", false, false, false, 42), "aria_label_hex" => (((        // line 43
(isset($context["category_title"]) || array_key_exists("category_title", $context) ? $context["category_title"] : (function () { throw new RuntimeError('Variable "category_title" does not exist.', 43, $this->source); })()) . " ") . twig_get_attribute($this->env, $this->source, (isset($context["data"]) || array_key_exists("data", $context) ? $context["data"] : (function () { throw new RuntimeError('Variable "data" does not exist.', 43, $this->source); })()), "label", [], "any", false, false, false, 43)) . " hex")]]));
        // line 46
        echo "</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 46,  93 => 43,  92 => 42,  91 => 41,  90 => 40,  89 => 39,  88 => 37,  87 => 36,  81 => 35,  75 => 34,  68 => 33,  60 => 31,  58 => 30,  51 => 28,  47 => 27,  43 => 25,);
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

<div class=\"mb-3\">
    <label class=\"mb-1\" for=\"{{ form_index ~ '_color' }}\">
        <span class=\"sr-only\">{{ category_title }}</span> {{ data.label }}
    </label>
    {% if data.id is defined and data.id is not null %}
        <input type=\"hidden\" name=\"{{ form_index }}[id]\" value=\"{{ data.id }}\">
    {% endif %}
    <input type=\"hidden\" name=\"{{ form_index }}[palette_id]\" value=\"{{ data.paletteId is defined ? data.paletteId : 0 }}\">
    <input type=\"hidden\" name=\"{{ form_index }}[variable_name]\" value=\"{{ data.variableName }}\">
    <input type=\"hidden\" name=\"{{ form_index }}[variable_type]\" value=\"{{ data.variableType }}\">
    {% include '@Modules/psxdesign/views/templates/components/color_input.html.twig' with {
        disabled: not(isColorFeatureEnabled),
        color: {
            name: form_index ~ '[value]',
            id_color: form_index ~ '_color',
            id_hex: form_index ~ '_hex',
            value: data.value,
            aria_label_hex: category_title ~ ' ' ~ data.label ~ ' hex'
        }
    } %}
</div>
", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\Blocks\\Partials\\color_form.html.twig");
    }
}
