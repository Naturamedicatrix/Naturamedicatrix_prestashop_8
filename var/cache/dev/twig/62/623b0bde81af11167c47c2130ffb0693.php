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

/* @PrestaShop/Admin/Improve/Design/Cms/index.html.twig */
class __TwigTemplate_ae97d4ec4104675bb61878e43c6fdb01 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'cms_page_category_breadcrumb' => [$this, 'block_cms_page_category_breadcrumb'],
            'cms_category_grid' => [$this, 'block_cms_category_grid'],
            'cms_grid' => [$this, 'block_cms_grid'],
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig"));

        // line 28
        $context["layoutHeaderToolbarBtn"] = ["add_cms_category" => ["href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_cms_pages_category_create", ["id_cms_category" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 30
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "request", [], "any", false, false, false, 30), "query", [], "any", false, false, false, 30), "get", [0 => "id_cms_category"], "method", false, false, false, 30)]), "desc" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Add new page category", [], "Admin.Design.Help"), "icon" => "add_circle_outline"], "add_cms_page" => ["href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_cms_pages_create", ["id_cms_category" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 35
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "request", [], "any", false, false, false, 35), "query", [], "any", false, false, false, 35), "get", [0 => "id_cms_category"], "method", false, false, false, 35)]), "desc" => $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Add new page", [], "Admin.Design.Help"), "icon" => "add_circle_outline"]];
        // line 26
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 26);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 42
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 43
        echo "
  ";
        // line 44
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 44)->display($context);
        // line 45
        echo "
  ";
        // line 46
        $this->displayBlock('cms_page_category_breadcrumb', $context, $blocks);
        // line 49
        echo "
  ";
        // line 50
        $this->displayBlock('cms_category_grid', $context, $blocks);
        // line 59
        echo "
  ";
        // line 60
        $this->displayBlock('cms_grid', $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 46
    public function block_cms_page_category_breadcrumb($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_page_category_breadcrumb"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_page_category_breadcrumb"));

        // line 47
        echo "    ";
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 47)->display($context);
        // line 48
        echo "  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 50
    public function block_cms_category_grid($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_category_grid"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_category_grid"));

        // line 51
        echo "    ";
        $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 51, "690454666")->display(twig_array_merge($context, ["grid" => (isset($context["cmsCategoryGrid"]) || array_key_exists("cmsCategoryGrid", $context) ? $context["cmsCategoryGrid"] : (function () { throw new RuntimeError('Variable "cmsCategoryGrid" does not exist.', 51, $this->source); })())]));
        // line 58
        echo "  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 60
    public function block_cms_grid($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_grid"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "cms_grid"));

        // line 61
        echo "    ";
        $this->loadTemplate("@PrestaShop/Admin/Common/Grid/grid_panel.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 61)->display(twig_array_merge($context, ["grid" => (isset($context["cmsGrid"]) || array_key_exists("cmsGrid", $context) ? $context["cmsGrid"] : (function () { throw new RuntimeError('Variable "cmsGrid" does not exist.', 61, $this->source); })())]));
        // line 62
        echo "  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 65
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 66
        echo "  ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
  <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/new-theme/public/cms_page.bundle.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("themes/default/js/bundle/pagination.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 68,  189 => 67,  184 => 66,  174 => 65,  164 => 62,  161 => 61,  151 => 60,  141 => 58,  138 => 51,  128 => 50,  118 => 48,  115 => 47,  105 => 46,  95 => 60,  92 => 59,  90 => 50,  87 => 49,  85 => 46,  82 => 45,  80 => 44,  77 => 43,  67 => 42,  56 => 26,  54 => 35,  53 => 30,  52 => 28,  39 => 26,);
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

{% set layoutHeaderToolbarBtn = {
  add_cms_category: {
    href: path('admin_cms_pages_category_create', {'id_cms_category' : app.request.query.get('id_cms_category')}),
    desc: 'Add new page category'|trans({}, 'Admin.Design.Help'),
    icon: 'add_circle_outline',
  },
  add_cms_page: {
    href: path('admin_cms_pages_create', {'id_cms_category' : app.request.query.get('id_cms_category')}),
    desc: 'Add new page'|trans({}, 'Admin.Design.Help'),
    icon: 'add_circle_outline',
  }
}
%}

{% block content %}

  {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig' %}

  {% block cms_page_category_breadcrumb %}
    {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig' %}
  {% endblock %}

  {% block cms_category_grid %}
    {% embed '@PrestaShop/Admin/Common/Grid/grid_panel.html.twig' with {'grid': cmsCategoryGrid} %}
      {% block grid_panel_footer %}
        {% if app.request.query.get('id_cms_category') and app.request.query.get('id_cms_category') != cmsPageView.root_category_id %}
          {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/listing_panel_footer.html.twig' %}
        {% endif %}
      {% endblock %}
    {% endembed %}
  {% endblock %}

  {% block cms_grid %}
    {% include '@PrestaShop/Admin/Common/Grid/grid_panel.html.twig' with {'grid': cmsGrid} %}
  {% endblock %}
{% endblock %}

{% block javascripts %}
  {{ parent() }}
  <script src=\"{{ asset('themes/new-theme/public/cms_page.bundle.js') }}\"></script>
  <script src=\"{{ asset('themes/default/js/bundle/pagination.js') }}\"></script>
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Cms\\index.html.twig");
    }
}


/* @PrestaShop/Admin/Improve/Design/Cms/index.html.twig */
class __TwigTemplate_ae97d4ec4104675bb61878e43c6fdb01___690454666 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'grid_panel_footer' => [$this, 'block_grid_panel_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 51
        return "@PrestaShop/Admin/Common/Grid/grid_panel.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig"));

        $this->parent = $this->loadTemplate("@PrestaShop/Admin/Common/Grid/grid_panel.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 51);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 52
    public function block_grid_panel_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "grid_panel_footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "grid_panel_footer"));

        // line 53
        echo "        ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 53, $this->source); })()), "request", [], "any", false, false, false, 53), "query", [], "any", false, false, false, 53), "get", [0 => "id_cms_category"], "method", false, false, false, 53) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 53, $this->source); })()), "request", [], "any", false, false, false, 53), "query", [], "any", false, false, false, 53), "get", [0 => "id_cms_category"], "method", false, false, false, 53) != twig_get_attribute($this->env, $this->source, (isset($context["cmsPageView"]) || array_key_exists("cmsPageView", $context) ? $context["cmsPageView"] : (function () { throw new RuntimeError('Variable "cmsPageView" does not exist.', 53, $this->source); })()), "root_category_id", [], "any", false, false, false, 53)))) {
            // line 54
            echo "          ";
            $this->loadTemplate("@PrestaShop/Admin/Improve/Design/Cms/Blocks/listing_panel_footer.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", 54)->display($context);
            // line 55
            echo "        ";
        }
        // line 56
        echo "      ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 56,  354 => 55,  351 => 54,  348 => 53,  338 => 52,  315 => 51,  193 => 68,  189 => 67,  184 => 66,  174 => 65,  164 => 62,  161 => 61,  151 => 60,  141 => 58,  138 => 51,  128 => 50,  118 => 48,  115 => 47,  105 => 46,  95 => 60,  92 => 59,  90 => 50,  87 => 49,  85 => 46,  82 => 45,  80 => 44,  77 => 43,  67 => 42,  56 => 26,  54 => 35,  53 => 30,  52 => 28,  39 => 26,);
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

{% set layoutHeaderToolbarBtn = {
  add_cms_category: {
    href: path('admin_cms_pages_category_create', {'id_cms_category' : app.request.query.get('id_cms_category')}),
    desc: 'Add new page category'|trans({}, 'Admin.Design.Help'),
    icon: 'add_circle_outline',
  },
  add_cms_page: {
    href: path('admin_cms_pages_create', {'id_cms_category' : app.request.query.get('id_cms_category')}),
    desc: 'Add new page'|trans({}, 'Admin.Design.Help'),
    icon: 'add_circle_outline',
  }
}
%}

{% block content %}

  {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/showcase_card.html.twig' %}

  {% block cms_page_category_breadcrumb %}
    {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig' %}
  {% endblock %}

  {% block cms_category_grid %}
    {% embed '@PrestaShop/Admin/Common/Grid/grid_panel.html.twig' with {'grid': cmsCategoryGrid} %}
      {% block grid_panel_footer %}
        {% if app.request.query.get('id_cms_category') and app.request.query.get('id_cms_category') != cmsPageView.root_category_id %}
          {% include '@PrestaShop/Admin/Improve/Design/Cms/Blocks/listing_panel_footer.html.twig' %}
        {% endif %}
      {% endblock %}
    {% endembed %}
  {% endblock %}

  {% block cms_grid %}
    {% include '@PrestaShop/Admin/Common/Grid/grid_panel.html.twig' with {'grid': cmsGrid} %}
  {% endblock %}
{% endblock %}

{% block javascripts %}
  {{ parent() }}
  <script src=\"{{ asset('themes/new-theme/public/cms_page.bundle.js') }}\"></script>
  <script src=\"{{ asset('themes/default/js/bundle/pagination.js') }}\"></script>
{% endblock %}
", "@PrestaShop/Admin/Improve/Design/Cms/index.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Cms\\index.html.twig");
    }
}
