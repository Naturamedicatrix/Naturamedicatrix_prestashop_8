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

/* @PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig */
class __TwigTemplate_1f8b36f7e3c08f3fbc453f8790abbab3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig"));

        // line 25
        echo "
";
        // line 26
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, (isset($context["cmsPageView"]) || array_key_exists("cmsPageView", $context) ? $context["cmsPageView"] : (function () { throw new RuntimeError('Variable "cmsPageView" does not exist.', 26, $this->source); })()), "breadcrumb_tree", [], "any", false, false, false, 26))) {
            // line 27
            echo "  <div class=\"card\">
    <div class=\"card-body\">
      <nav>
        <ol class=\"breadcrumb\">
          ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["cmsPageView"]) || array_key_exists("cmsPageView", $context) ? $context["cmsPageView"] : (function () { throw new RuntimeError('Variable "cmsPageView" does not exist.', 31, $this->source); })()), "breadcrumb_tree", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 32
                echo "            <li class=\"breadcrumb-item\">
              ";
                // line 33
                $context["cmsPageRouteParameters"] = [];
                // line 34
                echo "
              ";
                // line 35
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["category"], "cmsPageCategoryId", [], "any", false, false, false, 35), "value", [], "any", false, false, false, 35) != twig_get_attribute($this->env, $this->source, (isset($context["cmsPageView"]) || array_key_exists("cmsPageView", $context) ? $context["cmsPageView"] : (function () { throw new RuntimeError('Variable "cmsPageView" does not exist.', 35, $this->source); })()), "root_category_id", [], "any", false, false, false, 35))) {
                    // line 36
                    echo "                ";
                    $context["cmsPageRouteParameters"] = ["id_cms_category" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["category"], "cmsPageCategoryId", [], "any", false, false, false, 36), "value", [], "any", false, false, false, 36)];
                    // line 37
                    echo "              ";
                }
                // line 38
                echo "
              <a href=\"";
                // line 39
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_cms_pages_index", (isset($context["cmsPageRouteParameters"]) || array_key_exists("cmsPageRouteParameters", $context) ? $context["cmsPageRouteParameters"] : (function () { throw new RuntimeError('Variable "cmsPageRouteParameters" does not exist.', 39, $this->source); })())), "html", null, true);
                echo "\">
                ";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 40), "html", null, true);
                echo "
              </a>
            </li>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "        </ol>
      </nav>
    </div>
  </div>
";
        }
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 44,  81 => 40,  77 => 39,  74 => 38,  71 => 37,  68 => 36,  66 => 35,  63 => 34,  61 => 33,  58 => 32,  54 => 31,  48 => 27,  46 => 26,  43 => 25,);
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

{% if cmsPageView.breadcrumb_tree is not empty %}
  <div class=\"card\">
    <div class=\"card-body\">
      <nav>
        <ol class=\"breadcrumb\">
          {% for category in cmsPageView.breadcrumb_tree %}
            <li class=\"breadcrumb-item\">
              {% set cmsPageRouteParameters = {} %}

              {% if category.cmsPageCategoryId.value != cmsPageView.root_category_id %}
                {% set cmsPageRouteParameters = {'id_cms_category' : category.cmsPageCategoryId.value} %}
              {% endif %}

              <a href=\"{{ path('admin_cms_pages_index', cmsPageRouteParameters) }}\">
                {{ category.name }}
              </a>
            </li>
          {% endfor %}
        </ol>
      </nav>
    </div>
  </div>
{% endif %}
", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/breadcrumb.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\src\\PrestaShopBundle\\Resources\\views\\Admin\\Improve\\Design\\Cms\\Blocks\\breadcrumb.html.twig");
    }
}
