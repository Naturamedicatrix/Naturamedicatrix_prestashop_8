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

/* @Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig */
class __TwigTemplate_6b75ec2161e8c7e6a8fac6886ec1e81d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig"));

        // line 25
        echo "
<div class=\"col-12 col-lg-8\">
    <div class=\"card p-3\">
        ";
        // line 28
        $context["colors"] = (((isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 28, $this->source); })())) ? ((isset($context["colors"]) || array_key_exists("colors", $context) ? $context["colors"] : (function () { throw new RuntimeError('Variable "colors" does not exist.', 28, $this->source); })())) : ((isset($context["colorsPlaceholder"]) || array_key_exists("colorsPlaceholder", $context) ? $context["colorsPlaceholder"] : (function () { throw new RuntimeError('Variable "colorsPlaceholder" does not exist.', 28, $this->source); })())));
        // line 29
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["colors"]) || array_key_exists("colors", $context) ? $context["colors"] : (function () { throw new RuntimeError('Variable "colors" does not exist.', 29, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["colorsCategory"]) {
            // line 30
            echo "            ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["colorsCategory"], "colors", [], "any", false, false, false, 30))) {
                // line 31
                echo "                <div class=\"row\">
                    <div class=\"col-12 col-md-5\">
                        <h3>
                            ";
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["colorsCategory"], "title", [], "any", false, false, false, 34), "html", null, true);
                echo "
                        </h3>
                    </div>
                    <div class=\"col-12 col-md-7\">
                        ";
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["colorsCategory"], "colors", [], "any", false, false, false, 38));
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
                foreach ($context['_seq'] as $context["_key"] => $context["color"]) {
                    // line 39
                    echo "                            ";
                    $this->loadTemplate("@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig", 39)->display(twig_array_merge($context, ["category_title" => twig_get_attribute($this->env, $this->source,                     // line 40
$context["colorsCategory"], "title", [], "any", false, false, false, 40), "data" =>                     // line 41
$context["color"], "form_index" => ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                     // line 42
$context["loop"], "parent", [], "any", false, false, false, 42), "loop", [], "any", false, false, false, 42), "index", [], "any", false, false, false, 42) . "-") . twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 42))]));
                    // line 44
                    echo "                        ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['color'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 45
                echo "                    </div>
                </div>
            ";
            }
            // line 48
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colorsCategory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "    </div>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 49,  125 => 48,  120 => 45,  106 => 44,  104 => 42,  103 => 41,  102 => 40,  100 => 39,  83 => 38,  76 => 34,  71 => 31,  68 => 30,  50 => 29,  48 => 28,  43 => 25,);
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

<div class=\"col-12 col-lg-8\">
    <div class=\"card p-3\">
        {% set colors = isColorFeatureEnabled ? colors : colorsPlaceholder %}
        {% for colorsCategory in colors %}
            {% if colorsCategory.colors is not empty %}
                <div class=\"row\">
                    <div class=\"col-12 col-md-5\">
                        <h3>
                            {{ colorsCategory.title }}
                        </h3>
                    </div>
                    <div class=\"col-12 col-md-7\">
                        {% for color in colorsCategory.colors %}
                            {% include '@Modules/psxdesign/views/templates/admin/colors/Blocks/Partials/color_form.html.twig' with {
                                category_title: colorsCategory.title,
                                data: color,
                                form_index: loop.parent.loop.index ~ '-' ~ loop.index
                            } %}
                        {% endfor %}
                    </div>
                </div>
            {% endif %}
        {% endfor %}
    </div>
</div>
", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_content.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\Blocks\\Colors\\colors_content.html.twig");
    }
}
