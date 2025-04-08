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

/* @Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig */
class __TwigTemplate_6f960c45c1fa0a6413024f15658dd301 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->loadTemplate("@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig", 26, "2023999877")->display(twig_array_merge($context, ["id" => "use_theme_modal", "closable" => true]));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig";
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

{% embed '@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig' with {
    'id': 'use_theme_modal',
    'closable': true,
} %}
    {% block header %}
        <div class=\"modal-header\">
            <h5 class=\"modal-title\">{{ 'Use this theme?'|trans({}, 'Modules.Psxdesign.Admin') }}</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"{{ 'close'|trans({}, 'Modules.Psxdesign.Admin') }}\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endblock %}

    {% block content %}
        <div class=\"modal-body\">
            <p>{{ 'Your current %currentTheme% theme will be replaced by the %new_theme% theme.'|trans({'%currentTheme%': currentlyUsedTheme.display_name, '%new_theme%': '<span class=\"theme-name\"></span>'}, 'Modules.Psxdesign.Admin')|striptags('<span>')|raw }}</p>
            {% if currentlyUsedTheme.name == 'classic' %}
                <div class=\"alert medium-alert alert-warning\" role=\"alert\">
                    <p class=\"alert-text\">
                        {{ 'It is important to check the compatibility of your modules with the %new_theme% theme in a test environment.'|trans({'%new_theme%': '<span class=\"theme-name\"></span>'}, 'Modules.Psxdesign.Admin')|striptags('<span>')|raw }}
                    </p>
                </div>
            {% endif %}
        </div>
    {% endblock %}

    {% block footer %}
        <div class=\"modal-footer\">
            <button
                    type=\"button\"
                    class=\"btn btn-outline-secondary\"
                    data-dismiss=\"modal\">
                {{ 'Cancel'|trans({}, 'Modules.Psxdesign.Admin') }}
            </button>
            <form action=\"\" method=\"post\" id=\"use_theme\" name=\"use_theme\">
                <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('enable-theme') }}\"/>
                <button type=\"submit\" class=\"btn btn-primary\">
                    {{ 'Use'|trans({}, 'Modules.Psxdesign.Admin') }}
                </button>
            </form>
        </div>
    {% endblock %}

{% endembed %}
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\Modals\\use_theme_modal.html.twig");
    }
}


/* @Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig */
class __TwigTemplate_6f960c45c1fa0a6413024f15658dd301___2023999877 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig"));

        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig", 26);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 30
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        // line 31
        echo "        <div class=\"modal-header\">
            <h5 class=\"modal-title\">";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Use this theme?", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("close", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 39
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 40
        echo "        <div class=\"modal-body\">
            <p>";
        // line 41
        echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Your current %currentTheme% theme will be replaced by the %new_theme% theme.", ["%currentTheme%" => twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 41, $this->source); })()), "display_name", [], "any", false, false, false, 41), "%new_theme%" => "<span class=\"theme-name\"></span>"], "Modules.Psxdesign.Admin"), "<span>");
        echo "</p>
            ";
        // line 42
        if ((twig_get_attribute($this->env, $this->source, (isset($context["currentlyUsedTheme"]) || array_key_exists("currentlyUsedTheme", $context) ? $context["currentlyUsedTheme"] : (function () { throw new RuntimeError('Variable "currentlyUsedTheme" does not exist.', 42, $this->source); })()), "name", [], "any", false, false, false, 42) == "classic")) {
            // line 43
            echo "                <div class=\"alert medium-alert alert-warning\" role=\"alert\">
                    <p class=\"alert-text\">
                        ";
            // line 45
            echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("It is important to check the compatibility of your modules with the %new_theme% theme in a test environment.", ["%new_theme%" => "<span class=\"theme-name\"></span>"], "Modules.Psxdesign.Admin"), "<span>");
            echo "
                    </p>
                </div>
            ";
        }
        // line 49
        echo "        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 52
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        // line 53
        echo "        <div class=\"modal-footer\">
            <button
                    type=\"button\"
                    class=\"btn btn-outline-secondary\"
                    data-dismiss=\"modal\">
                ";
        // line 58
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
            </button>
            <form action=\"\" method=\"post\" id=\"use_theme\" name=\"use_theme\">
                <input type=\"hidden\" name=\"token\" value=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("enable-theme"), "html", null, true);
        echo "\"/>
                <button type=\"submit\" class=\"btn btn-primary\">
                    ";
        // line 63
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Use", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
                </button>
            </form>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  291 => 63,  286 => 61,  280 => 58,  273 => 53,  263 => 52,  252 => 49,  245 => 45,  241 => 43,  239 => 42,  235 => 41,  232 => 40,  222 => 39,  207 => 33,  203 => 32,  200 => 31,  190 => 30,  46 => 26,  43 => 25,);
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

{% embed '@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig' with {
    'id': 'use_theme_modal',
    'closable': true,
} %}
    {% block header %}
        <div class=\"modal-header\">
            <h5 class=\"modal-title\">{{ 'Use this theme?'|trans({}, 'Modules.Psxdesign.Admin') }}</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"{{ 'close'|trans({}, 'Modules.Psxdesign.Admin') }}\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endblock %}

    {% block content %}
        <div class=\"modal-body\">
            <p>{{ 'Your current %currentTheme% theme will be replaced by the %new_theme% theme.'|trans({'%currentTheme%': currentlyUsedTheme.display_name, '%new_theme%': '<span class=\"theme-name\"></span>'}, 'Modules.Psxdesign.Admin')|striptags('<span>')|raw }}</p>
            {% if currentlyUsedTheme.name == 'classic' %}
                <div class=\"alert medium-alert alert-warning\" role=\"alert\">
                    <p class=\"alert-text\">
                        {{ 'It is important to check the compatibility of your modules with the %new_theme% theme in a test environment.'|trans({'%new_theme%': '<span class=\"theme-name\"></span>'}, 'Modules.Psxdesign.Admin')|striptags('<span>')|raw }}
                    </p>
                </div>
            {% endif %}
        </div>
    {% endblock %}

    {% block footer %}
        <div class=\"modal-footer\">
            <button
                    type=\"button\"
                    class=\"btn btn-outline-secondary\"
                    data-dismiss=\"modal\">
                {{ 'Cancel'|trans({}, 'Modules.Psxdesign.Admin') }}
            </button>
            <form action=\"\" method=\"post\" id=\"use_theme\" name=\"use_theme\">
                <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('enable-theme') }}\"/>
                <button type=\"submit\" class=\"btn btn-primary\">
                    {{ 'Use'|trans({}, 'Modules.Psxdesign.Admin') }}
                </button>
            </form>
        </div>
    {% endblock %}

{% endembed %}
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/use_theme_modal.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\Modals\\use_theme_modal.html.twig");
    }
}
