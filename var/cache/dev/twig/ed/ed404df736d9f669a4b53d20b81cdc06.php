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

/* @Modules/psxdesign/views/templates/components/alert_notification.html.twig */
class __TwigTemplate_312f6e7c2b36e99eff25733be6785ce7 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/alert_notification.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Modules/psxdesign/views/templates/components/alert_notification.html.twig"));

        // line 25
        echo "
<div class=\"alert alert-info d-md-flex justify-content-between\">
  <div class=\"mb-2 mb-md-0 mr-md-2\">
    <h2 class=\"h4 mb-1\">
      ";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("We have improved the Design section of your back office", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
    </h2>
    <p>
      ";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Enjoy a better experience and benefit from the latest improvements. Your settings and data will be preserved.", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "
    </p>
  </div>
  <div class=\"pr-0 flex-shrink-0\">
    <form id=\"psxdesign-upgrade-form\" action=\"";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["psxdesignUpgradeUrl"]) || array_key_exists("psxdesignUpgradeUrl", $context) ? $context["psxdesignUpgradeUrl"] : (function () { throw new RuntimeError('Variable "psxdesignUpgradeUrl" does not exist.', 36, $this->source); })()), "html", null, true);
        echo "\" method=\"post\">
      <button type=\"submit\" class='btn btn-primary'>";
        // line 37
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Activate new features", [], "Modules.Psxdesign.Admin"), "html", null, true);
        echo "</button>
    </form>
  </div>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "@Modules/psxdesign/views/templates/components/alert_notification.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 37,  62 => 36,  55 => 32,  49 => 29,  43 => 25,);
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

<div class=\"alert alert-info d-md-flex justify-content-between\">
  <div class=\"mb-2 mb-md-0 mr-md-2\">
    <h2 class=\"h4 mb-1\">
      {{ 'We have improved the Design section of your back office'|trans({}, 'Modules.Psxdesign.Admin') }}
    </h2>
    <p>
      {{ 'Enjoy a better experience and benefit from the latest improvements. Your settings and data will be preserved.'|trans({}, 'Modules.Psxdesign.Admin') }}
    </p>
  </div>
  <div class=\"pr-0 flex-shrink-0\">
    <form id=\"psxdesign-upgrade-form\" action=\"{{ psxdesignUpgradeUrl }}\" method=\"post\">
      <button type=\"submit\" class='btn btn-primary'>{{ 'Activate new features'|trans({}, 'Modules.Psxdesign.Admin') }}</button>
    </form>
  </div>
</div>
", "@Modules/psxdesign/views/templates/components/alert_notification.html.twig", "C:\\xampp\\htdocs\\Naturamedicatrix\\modules\\psxdesign\\views\\templates\\components\\alert_notification.html.twig");
    }
}
