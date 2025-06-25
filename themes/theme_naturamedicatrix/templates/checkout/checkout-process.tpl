{assign var='current_step' value=Tools::getValue('step')}

{$current_step|@var_dump}

<ol class="checkout-steps mb-4">
  <li class="step-item {if $current_step == 'personal-information'}current{/if}">
    <a href="{$urls.pages.order}?step=personal-information" class="step-link">Informations</a>
  </li>
  <li class="step-item {if $current_step == 'addresses'}current{/if}">
    <a href="{$urls.pages.order}?step=addresses" class="step-link">Adresse</a>
  </li>
  <li class="step-item {if $current_step == 'delivery'}current{/if}">
    <a href="{$urls.pages.order}?step=delivery" class="step-link">Livraison</a>
  </li>
  <li class="step-item {if $current_step == 'payment'}current{/if}">
    <a href="{$urls.pages.order}?step=payment" class="step-link">Paiement</a>
  </li>
</ol>


{**
CUSTOM CHECKOUT PROCESS
 *}

{foreach from=$steps item="step" key="index"}
  {render identifier  =  $step.identifier
          position    =  ($index + 1)
          ui          =  $step.ui
  }
{/foreach}


