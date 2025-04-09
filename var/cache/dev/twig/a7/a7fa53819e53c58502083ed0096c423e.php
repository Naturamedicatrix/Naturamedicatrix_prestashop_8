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

/* @Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig */
class __TwigTemplate_4775384e03cf0081550c53e65bbd1194 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig"));

        // line 25
        echo "
";
        // line 26
        $this->loadTemplate("@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig", 26, "1502299836")->display(twig_array_merge($context, ["id" => "import_theme_from_ftp_modal", "closable" => true]));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig";
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
    'id': 'import_theme_from_ftp_modal',
    'closable': true,
} %}
    {% block header %}
        <div class=\"modal-header\">
            <h5 class=\"modal-title\">{{ 'Import from FTP'|trans({}, 'Modules.Psxdesign.Admin') }}</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endblock %}
    {% block content %}
        <div class=\"modal-body\">
            <form id=\"import-from-ftp\" action=\"{{ importThemeUrl }}\" data-action=\"import-from-ftp\">
                <div class=\"alert-container\" role=\"alert\"></div>
                <label class=\"form-control-label font-weight-bold\" for=\"theme-ftp-path\">{{ 'Select archive'|trans({}, 'Modules.Psxdesign.Admin') }}</label>
                <div class=\"form-select\">
                    <select class=\"form-control custom-select\" name=\"theme-ftp-path\" id=\"theme-ftp-path\" required>
                        <option value=\"\" selected>-</option>
                        {% if themesZipFiles %}
                            {% for themeZipFile in themesZipFiles %}
                              <option value=\"{{ themeZipFile }}\">{{ themeZipFile }}</option>
                            {% endfor %}
                        {% endif %}
                    </select>
                </div>
                <p class=\"form-text mt-2\">
                    {{ 'This field shows the ZIP files present in the \"/themes\" folder.'|trans({}, 'Modules.Psxdesign.Admin') }}
                </p>
            </form>
        </div>
    {% endblock %}
    {% block footer %}
        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-outline-secondary\" data-dismiss=\"modal\">{{ 'Cancel'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
            <button type=\"submit\" class=\"btn btn-primary import-theme\" form=\"import-from-ftp\">{{ 'Import'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
        </div>
    {% endblock %}
{% endembed %}
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\Modals\\import_theme_from_ftp_modal.html.twig");
    }
}


/* @Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig */
class __TwigTemplate_4775384e03cf0081550c53e65bbd1194___1502299836 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig"));

        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Helpers/bootstrap_popup.html.twig", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig", 26);
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
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Import from FTP", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 38
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 39
        echo "        <div class=\"modal-body\">
            <form id=\"import-from-ftp\" action=\"";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["importThemeUrl"]) || array_key_exists("importThemeUrl", $context) ? $context["importThemeUrl"] : (function () { throw new RuntimeError('Variable "importThemeUrl" does not exist.', 40, $this->source); })()), "html", null, true);
        echo "\" data-action=\"import-from-ftp\">
                <div class=\"alert-container\" role=\"alert\"></div>
                <label class=\"form-control-label font-weight-bold\" for=\"theme-ftp-path\">";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Select archive", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</label>
                <div class=\"form-select\">
                    <select class=\"form-control custom-select\" name=\"theme-ftp-path\" id=\"theme-ftp-path\" required>
                        <option value=\"\" selected>-</option>
                        ";
        // line 46
        if ((isset($context["themesZipFiles"]) || array_key_exists("themesZipFiles", $context) ? $context["themesZipFiles"] : (function () { throw new RuntimeError('Variable "themesZipFiles" does not exist.', 46, $this->source); })())) {
            // line 47
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["themesZipFiles"]) || array_key_exists("themesZipFiles", $context) ? $context["themesZipFiles"] : (function () { throw new RuntimeError('Variable "themesZipFiles" does not exist.', 47, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["themeZipFile"]) {
                // line 48
                echo "                              <option value=\"";
                echo twig_escape_filter($this->env, $context["themeZipFile"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["themeZipFile"], "html", null, true);
                echo "</option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['themeZipFile'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "                        ";
        }
        // line 51
        echo "                    </select>
                </div>
                <p class=\"form-text mt-2\">
                    ";
        // line 54
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("This field shows the ZIP files present in the \"/themes\" folder.", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
                </p>
            </form>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 59
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        // line 60
        echo "        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-outline-secondary\" data-dismiss=\"modal\">";
        // line 61
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Cancel", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</button>
            <button type=\"submit\" class=\"btn btn-primary import-theme\" form=\"import-from-ftp\">";
        // line 62
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Import", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</button>
        </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  298 => 62,  294 => 61,  291 => 60,  281 => 59,  266 => 54,  261 => 51,  258 => 50,  247 => 48,  242 => 47,  240 => 46,  233 => 42,  228 => 40,  225 => 39,  215 => 38,  199 => 32,  196 => 31,  186 => 30,  46 => 26,  43 => 25,);
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
    'id': 'import_theme_from_ftp_modal',
    'closable': true,
} %}
    {% block header %}
        <div class=\"modal-header\">
            <h5 class=\"modal-title\">{{ 'Import from FTP'|trans({}, 'Modules.Psxdesign.Admin') }}</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
    {% endblock %}
    {% block content %}
        <div class=\"modal-body\">
            <form id=\"import-from-ftp\" action=\"{{ importThemeUrl }}\" data-action=\"import-from-ftp\">
                <div class=\"alert-container\" role=\"alert\"></div>
                <label class=\"form-control-label font-weight-bold\" for=\"theme-ftp-path\">{{ 'Select archive'|trans({}, 'Modules.Psxdesign.Admin') }}</label>
                <div class=\"form-select\">
                    <select class=\"form-control custom-select\" name=\"theme-ftp-path\" id=\"theme-ftp-path\" required>
                        <option value=\"\" selected>-</option>
                        {% if themesZipFiles %}
                            {% for themeZipFile in themesZipFiles %}
                              <option value=\"{{ themeZipFile }}\">{{ themeZipFile }}</option>
                            {% endfor %}
                        {% endif %}
                    </select>
                </div>
                <p class=\"form-text mt-2\">
                    {{ 'This field shows the ZIP files present in the \"/themes\" folder.'|trans({}, 'Modules.Psxdesign.Admin') }}
                </p>
            </form>
        </div>
    {% endblock %}
    {% block footer %}
        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-outline-secondary\" data-dismiss=\"modal\">{{ 'Cancel'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
            <button type=\"submit\" class=\"btn btn-primary import-theme\" form=\"import-from-ftp\">{{ 'Import'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
        </div>
    {% endblock %}
{% endembed %}
", "@Modules/psxdesign/views/templates/admin/themes/Blocks/Modals/import_theme_from_ftp_modal.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\themes\\Blocks\\Modals\\import_theme_from_ftp_modal.html.twig");
    }
}
