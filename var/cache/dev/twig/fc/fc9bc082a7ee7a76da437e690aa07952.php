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

/* @Modules/psxdesign/views/templates/components/save_banner.html.twig */
class __TwigTemplate_a107ed44a9d2a0fa203731930e68e431 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/save_banner.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/save_banner.html.twig"));

        // line 25
        echo "
";
        // line 31
        echo "
<div class=\"save-banner save-banner--hidden\">
    <p class=\"save-banner__text\">
        ";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Unsaved changes", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
    </p>
    <div class=\"save-banner__actions\">
        ";
        // line 37
        if (( !array_key_exists("resettable", $context) || ((isset($context["resettable"]) || array_key_exists("resettable", $context) ? $context["resettable"] : (function () { throw new RuntimeError('Variable "resettable" does not exist.', 37, $this->source); })()) != false))) {
            // line 38
            echo "            <button type=\"reset\" id=\"cancel-button\" form=\"";
            echo twig_escape_filter($this->env, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "html", null, true);
            echo "\" class=\"btn btn-outline-light\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Modules.Psxdesign.Admin"), "html", null, true);
            echo "</button>
        ";
        }
        // line 40
        echo "        <button type=\"submit\" id=\"save-button\" form=\"";
        echo twig_escape_filter($this->env, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "html", null, true);
        echo "\" class=\"btn btn-primary\">";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Save changes", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</button>
    </div>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/components/save_banner.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 40,  59 => 38,  57 => 37,  51 => 34,  46 => 31,  43 => 25,);
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
save banner parameters
- form : the form id to link the save button (string)
- resettable: add the button cancel to the bottom bar if the value is true (boolean / default: true)
#}

<div class=\"save-banner save-banner--hidden\">
    <p class=\"save-banner__text\">
        {{ 'Unsaved changes'|trans({}, 'Modules.Psxdesign.Admin') }}
    </p>
    <div class=\"save-banner__actions\">
        {% if resettable is not defined or resettable != false %}
            <button type=\"reset\" id=\"cancel-button\" form=\"{{ form }}\" class=\"btn btn-outline-light\">{{ 'Cancel'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
        {% endif %}
        <button type=\"submit\" id=\"save-button\" form=\"{{ form }}\" class=\"btn btn-primary\">{{ 'Save changes'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
    </div>
</div>
", "@Modules/psxdesign/views/templates/components/save_banner.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\components\\save_banner.html.twig");
    }
}
