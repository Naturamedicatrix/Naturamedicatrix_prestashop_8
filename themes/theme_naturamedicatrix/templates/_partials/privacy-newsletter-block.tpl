{**
 * Template partial pour les checkboxes de newsletter et RGPD
 * Ce template est inclus dans le formulaire client pour la page d'identité et d'inscription
 *}

{* Bloc englobant pour les checkboxes *}
<div class="block-checkbox-newsletter-rgpd">
  {* Checkbox de newsletter *}
  <div>
    {foreach from=$formFields item="field"}
      {if $field.name == 'newsletter' || $field.name == 'optin'}
        <div class="custom-checkbox">
          <input name="{$field.name}" id="{$field.name}" type="checkbox" value="1" {if ($field.name == 'newsletter' && isset($customer) && $customer.newsletter == 1) || ($field.name == 'optin' && isset($customer) && $customer.optin == 1)}checked="checked"{/if}>
          <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
          <label for="{$field.name}">
            {if $field.name == 'newsletter'}
              <span class="font-bold">S'inscrire à la newsletter et profitez d'offres exclusives</span>
            {elseif $field.name == 'optin'}
              Recevoir des informations santé de nos partenaires <a href="https://www.medicatrix.be/?utm_source=NaturaMedicatrix&utm_medium=identity&utm_campaign=medicatrix" target="_blank">Medicatrix</a> & <a href="https://www.editionsmarcopietteur.com/?utm_source=NaturaMedicatrix&utm_medium=identity&utm_campaign=edmp" target="_blank">Editions marco pietteur</a>
            {else}
              {$field.label nofilter}
            {/if}
          </label>
        </div>
      {/if}
    {/foreach}
  </div>

  {* Checkbox RGPD *}
  <div>
    {foreach from=$formFields item="field"}
      {if $field.name == 'psgdpr' || $field.name == 'customer_privacy'}
        <div class="custom-checkbox">
          <input name="{$field.name}" id="{$field.name}" type="checkbox" value="1" checked="checked">
          <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
          <label for="{$field.name}">
            {if $field.name == 'customer_privacy'}
              En validant ce formulaire, j'accepte que les données confidentielles saisies peuvent être utilisées par NATURA<span class="font-bold italic">Medicatrix</span>*
            {else}
              {$field.label nofilter}*
            {/if}
          </label>
        </div>
      {/if}
    {/foreach}
  </div>
</div>
