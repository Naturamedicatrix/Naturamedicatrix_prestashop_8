{**
* CUSTOM FORM
 *}
{block name='customer_form'}
  {block name='customer_form_errors'}
    {include file='_partials/form-errors.tpl' errors=$errors['']}
  {/block}

<form action="{block name='customer_form_actionurl'}{$action}{/block}" id="customer-form" class="js-customer-form" method="post">
  <div>
    {* Vérification pour savoir si nous sommes sur la page d'identité (pas sur la page d'inscription) *}
    {if $page.page_name == 'identity'}
      <!-- Section Informations personnelles - Uniquement pour la page identité -->
      <div class="identity-section">
        <h1>{l s='Informations personnelles' d='Shop.Theme.Customeraccount'}</h1>
        <p class="instructions-account">
          {l s='Pour modifier vos informations personnelles, vous devrez saisir votre mot de passe actuel dans la section ci-dessous.' d='Shop.Theme.Customeraccount'}
        </p>
        <div class="form-section">
          {foreach from=$formFields item="field"}
            {if $field.name == 'id_gender' || $field.name == 'firstname' || $field.name == 'lastname' || $field.name == 'birthday' || $field.name == 'email'}
              {if $field.type === "password"}
                <div class="field-password-policy">
                  {form_field field=$field}
                </div>
              {else}
                {form_field field=$field}
              {/if}
            {/if}
          {/foreach}
        </div>
      </div>

      <!-- Section Mot de passe - Uniquement pour la page identité -->
      <div class="identity-section password-section mt-12">
        <h2>{l s='Mot de passe' d='Shop.Theme.Customeraccount'}</h2>
        <div class="form-section">
          <p class="instructions-account">
            {l s='Pour changer votre mot de passe, saisissez votre mot de passe actuel et définissez un nouveau dans les champs ci-dessous.' d='Shop.Theme.Customeraccount'}
          </p>
          
          {foreach from=$formFields item="field"}
            {if $field.type === "password"}
              <div class="field-password-policy">
                {* Label custom pour le mot de passe actuel *}
                {if $field.name === "password"}
                  {assign var="customField" value=$field}
                  {assign var="customField" value=$customField|array_replace:["label"=>"Mot de passe actuel*"]}
                  {form_field field=$customField}
                {else}
                  {form_field field=$field}
                {/if}
              </div>
            {/if}
          {/foreach}
          
          <div class="delete-account-section">
            <p>{l s='Si vous souhaitez supprimer votre compte et vos données, contactez-nous.' d='Shop.Theme.Customeraccount'}</p>
          </div>
        </div>
      </div>

      <hr />
      
      {* Bloc de checkboxes personnalisées avec variable pour la page d'identité *}
      {assign var='isIdentityPage' value=true}
      {include file='_partials/privacy-newsletter-block.tpl' formFields=$formFields isIdentityPage=$isIdentityPage}

      {* Important - Rendre les champs restants pour assurer la compatibilité - Uniquement pour la page identité *}
      {foreach from=$formFields item="field"}
        {if $field.name != 'id_gender' && $field.name != 'firstname' && $field.name != 'lastname' && $field.name != 'birthday' && $field.name != 'email' && $field.type !== "password" && $field.name != 'newsletter' && $field.name != 'optin' && $field.name != 'psgdpr' && $field.name != 'customer_privacy'}
          <div>
            {form_field field=$field}
          </div>
        {/if}
      {/foreach}
    {else}
      {* Pour les autres pages (inscription, etc.), afficher le formulaire normal *}
      {block "form_fields"}
        {* Affichage des champs d'informations personnelles *}
        {foreach from=$formFields item="field"}
          {if $field.name != 'newsletter' && $field.name != 'optin' && $field.name != 'psgdpr' && $field.name != 'customer_privacy'}
            {block "form_field"}
              {if $field.type === "password"}
                <div class="field-password-policy">
                  {form_field field=$field}
                </div>
              {else}
                {form_field field=$field}
              {/if}
            {/block}
          {/if}
        {/foreach}
        
        
        <hr />
        
        {* Bloc de checkboxes personnalisées pour la page d'inscription *}
        {assign var='isIdentityPage' value=false}
        {include file='_partials/privacy-newsletter-block.tpl' formFields=$formFields isIdentityPage=$isIdentityPage}
        
        {$hook_create_account_form nofilter}
      {/block}
    {/if}
  </div>

  <div class="form-footer-container">
    <p class="required-fields">*{l s='champs obligatoires' d='Shop.Forms.Labels'}</p>
  </div>

  {block name='customer_form_footer'}
    <footer class="form-footer clearfix">
      <input type="hidden" name="submitCreate" value="1">
      {block "form_buttons"}
        <button class="btn-primary form-control-submit" data-link-action="save-customer" type="submit">
          {l s='Enregistrer les modifications' d='Shop.Theme.Actions'}
        </button>
      {/block}
    </footer>
  {/block}

</form>
{/block}
