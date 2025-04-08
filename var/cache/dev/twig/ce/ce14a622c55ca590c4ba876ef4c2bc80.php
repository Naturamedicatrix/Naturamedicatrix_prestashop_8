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

/* @Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig */
class __TwigTemplate_9f753acb3b07d483facf4a2bca55f858 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig"));

        // line 25
        echo "
<div class=\"col-12 col-lg-4\">
    <h2>";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Colors", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</h2>
    <p class=\"text-muted\">
        ";
        // line 29
        echo twig_striptags($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Customize the colors by writing the [1]hex color code[/1] or by using the color picker.", ["[1]" => ((        // line 32
(isset($context["isColorFeatureEnabled"]) || array_key_exists("isColorFeatureEnabled", $context) ? $context["isColorFeatureEnabled"] : (function () { throw new RuntimeError('Variable "isColorFeatureEnabled" does not exist.', 32, $this->source); })())) ? ("<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" target=\"_blank\" rel=\"noopener\" class=\"external-link\">") : ("<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" target=\"_blank\" rel=\"noopener\" tabindex=\"-1\" class=\"external-link\">")), "[/1]" => "</a>"], "Modules.Psxdesign.Admin"), "<a>");
        // line 39
        echo "
    </p>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 39,  53 => 32,  52 => 29,  47 => 27,  43 => 25,);
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

<div class=\"col-12 col-lg-4\">
    <h2>{{ 'Colors'|trans({}, 'Modules.Psxdesign.Admin') }}</h2>
    <p class=\"text-muted\">
        {{ 'Customize the colors by writing the [1]hex color code[/1] or by using the color picker.'
        |trans(
            {'[1]':
                isColorFeatureEnabled ?
                '<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" target=\"_blank\" rel=\"noopener\" class=\"external-link\">' :
                '<a href=\"https://en.wikipedia.org/wiki/Web_colors#Hex_triplet\" target=\"_blank\" rel=\"noopener\" tabindex=\"-1\" class=\"external-link\">',
            '[/1]': '</a>'},
            'Modules.Psxdesign.Admin')
        |striptags('<a>')
        |raw
        }}
    </p>
</div>
", "@Modules/psxdesign/views/templates/admin/colors/Blocks/Colors/colors_description.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\admin\\colors\\Blocks\\Colors\\colors_description.html.twig");
    }
}
