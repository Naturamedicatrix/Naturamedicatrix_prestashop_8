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
          <input name="{$field.name}" id="{$field.name}" type="checkbox" value="1">
          <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
          <label for="{$field.name}">
            {if $field.name == 'optin'}
              Recevoir des informations santé de nos partenaires <a href="https://www.medicatrix.be/?utm_source=NaturaMedicatrix&utm_medium=link&utm_campaign=identity%2F" target="_blank">Medicatrix</a> & <a href="https://www.editionsmarcopietteur.com/" target="_blank">Editions marco pietteur</a>
            {elseif $field.name == 'newsletter'}
              S'inscrire à notre newsletter!
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
              En validant ce formulaire, j'accepte que les données confidentielles saisies peuvent être utilisées par NATURA<span class="font-bold italic">Medicatrix</span>
            {else}
              {$field.label nofilter}
            {/if}
          </label>
        </div>
      {/if}
    {/foreach}
  </div>
</div>
