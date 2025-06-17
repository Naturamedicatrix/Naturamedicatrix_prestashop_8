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
      <ul class="alerts-list">
        {foreach from=$mailAlerts item=mailAlert}
          <li class="alert-item">
            {include 'module:ps_emailalerts/views/templates/front/mailalerts-account-line.tpl' mailAlert=$mailAlert}
          </li>
        {/foreach}
      </ul>
    {else}
      <div class="alert alert-info" role="alert">
        {l s='Vous n\'avez pas encore d\'alertes.' d='Modules.Emailalerts.Shop'}
      </div>
    {/if}
  </div>
{/block}
