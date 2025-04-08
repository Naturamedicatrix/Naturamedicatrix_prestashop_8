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

/* @Modules/psxdesign/views/templates/components/file_uploader.html.twig */
class __TwigTemplate_26215e4019b12b915d580871649773e3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'default_message' => [$this, 'block_default_message'],
            'preview_template' => [$this, 'block_preview_template'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/file_uploader.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/file_uploader.html.twig"));

        // line 25
        echo "
<fieldset
    class=\"file-uploader\"
    ";
        // line 28
        if ((array_key_exists("disabled", $context) && ((isset($context["disabled"]) || array_key_exists("disabled", $context) ? $context["disabled"] : (function () { throw new RuntimeError('Variable "disabled" does not exist.', 28, $this->source); })()) == true))) {
            // line 29
            echo "        disabled
    ";
        }
        // line 31
        echo ">
    <div class=\"file-uploader__container\">
        ";
        // line 33
        $this->displayBlock('default_message', $context, $blocks);
        // line 39
        echo "
        <div class=\"file-uploader__preview-container\"></div>
        <template class=\"file-uploader__template-previews\">
            ";
        // line 42
        $this->displayBlock('preview_template', $context, $blocks);
        // line 45
        echo "        </template>
        <input
            id=\"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["id"]) || array_key_exists("id", $context) ? $context["id"] : (function () { throw new RuntimeError('Variable "id" does not exist.', 47, $this->source); })()), "html", null, true);
        echo "\"
            name=\"";
        // line 48
        echo twig_escape_filter($this->env, ((array_key_exists("name", $context)) ? ((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 48, $this->source); })())) : ((isset($context["id"]) || array_key_exists("id", $context) ? $context["id"] : (function () { throw new RuntimeError('Variable "id" does not exist.', 48, $this->source); })()))), "html", null, true);
        echo "\"
            type=\"file\"
            class=\"file-uploader__hidden-input\"
            tabindex=\"-1\"

            ";
        // line 53
        if (array_key_exists("accept", $context)) {
            // line 54
            echo "                accept=\"";
            echo twig_escape_filter($this->env, (isset($context["accept"]) || array_key_exists("accept", $context) ? $context["accept"] : (function () { throw new RuntimeError('Variable "accept" does not exist.', 54, $this->source); })()), "html", null, true);
            echo "\"
            ";
        }
        // line 56
        echo "
            ";
        // line 57
        if ((array_key_exists("multiple", $context) && ((isset($context["multiple"]) || array_key_exists("multiple", $context) ? $context["multiple"] : (function () { throw new RuntimeError('Variable "multiple" does not exist.', 57, $this->source); })()) == true))) {
            // line 58
            echo "                multiple
            ";
        }
        // line 60
        echo "
            ";
        // line 61
        if ((array_key_exists("required", $context) && ((isset($context["required"]) || array_key_exists("required", $context) ? $context["required"] : (function () { throw new RuntimeError('Variable "required" does not exist.', 61, $this->source); })()) == true))) {
            // line 62
            echo "                required
            ";
        }
        // line 64
        echo "        >
    </div>
</fieldset>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 33
    public function block_default_message($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "default_message"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "default_message"));

        // line 34
        echo "            <p class=\"file-uploader__legend\">
                <i class=\"material-icons file-uploader__legend-icon\">file_upload</i>
                ";
        // line 36
        echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("[1]Select[/1] a file or drag and drop", ["[1]" => "<button class=\"btn btn-link file-uploader__legend-btn\" type=\"button\">", "[/1]" => "</button>"], "Modules.Psxdesign.Admin"), "<button>");
        echo "
            </p>
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 42
    public function block_preview_template($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "preview_template"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "preview_template"));

        // line 43
        echo "                ";
        $this->loadTemplate("@Modules/psxdesign/views/templates/components/Partials/file_uploader_preview_template.html.twig", "@Modules/psxdesign/views/templates/components/file_uploader.html.twig", 43)->display($context);
        // line 44
        echo "            ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/components/file_uploader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 44,  161 => 43,  151 => 42,  138 => 36,  134 => 34,  124 => 33,  111 => 64,  107 => 62,  105 => 61,  102 => 60,  98 => 58,  96 => 57,  93 => 56,  87 => 54,  85 => 53,  77 => 48,  73 => 47,  69 => 45,  67 => 42,  62 => 39,  60 => 33,  56 => 31,  52 => 29,  50 => 28,  45 => 25,);
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

<fieldset
    class=\"file-uploader\"
    {% if disabled is defined and disabled == true %}
        disabled
    {% endif %}
>
    <div class=\"file-uploader__container\">
        {% block default_message %}
            <p class=\"file-uploader__legend\">
                <i class=\"material-icons file-uploader__legend-icon\">file_upload</i>
                {{ '[1]Select[/1] a file or drag and drop'|trans({'[1]': '<button class=\"btn btn-link file-uploader__legend-btn\" type=\"button\">', '[/1]': '</button>'}, 'Modules.Psxdesign.Admin')|striptags('<button>')|raw  }}
            </p>
        {% endblock %}

        <div class=\"file-uploader__preview-container\"></div>
        <template class=\"file-uploader__template-previews\">
            {% block preview_template %}
                {% include '@Modules/psxdesign/views/templates/components/Partials/file_uploader_preview_template.html.twig' %}
            {% endblock %}
        </template>
        <input
            id=\"{{ id }}\"
            name=\"{{ name is defined ? name : id }}\"
            type=\"file\"
            class=\"file-uploader__hidden-input\"
            tabindex=\"-1\"

            {% if accept is defined %}
                accept=\"{{ accept }}\"
            {% endif %}

            {% if multiple is defined and multiple == true %}
                multiple
            {% endif %}

            {% if required is defined and required == true %}
                required
            {% endif %}
        >
    </div>
</fieldset>
", "@Modules/psxdesign/views/templates/components/file_uploader.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\components\\file_uploader.html.twig");
    }
}
