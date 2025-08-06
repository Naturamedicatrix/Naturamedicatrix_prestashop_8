{**
 * Custom template for the ps_emailalerts account page
 * Based on the original module template but with left column integration
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  <div class="alerts-page-layout">
    {include file='customer/_partials/account-left-column.tpl'}
  </div>
{/block}
{* END LEFT COLUMN *}


{block name='page_content'}
<h1>{l s='Mes alertes' d='Modules.Emailalerts.Shop'}</h1>
<div class="alerts-container">
    {if $mailAlerts}
      <div class="products-grid grid grid-cols-2 xl:grid-cols-3 gap-6">
        {foreach from=$mailAlerts item=mailAlert}
          <div class="product-alert-item position-relative">
            {* Les données sont maintenant enrichies directement dans MailAlert.php *}
            {include file="catalog/_partials/miniatures/product.tpl" product=$mailAlert productClasses=""}
          </div>
        {/foreach}
      </div>
    {else}
      <div class="alert alert-info" role="alert">
        {l s='Vous n\'avez pas encore d\'alertes.' d='Modules.Emailalerts.Shop'}
      </div>
    {/if}
  </div>
{/block}
