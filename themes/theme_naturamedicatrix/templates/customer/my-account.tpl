{**
* CUSTOM PAGE MY ACCOUNT
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{* CONTENT *}
{block name='page_title'}
  Aperçu de mon compte
{/block}

{block name='page_content'}
  <div class="content-account">
    <p>Dans votre espace client NATURAMedicatrix, vous pouvez gérer vos commandes et vos retours, ainsi que vos informations personnelles.</p>
    <div class="content-account-logo text-center">
      <i class="bi bi-bag"></i>
      <p class="text-2xl font-bold">Tout est à jour :)</p>
    </div>
  </div>
  
  <div class="text-center mt-12">
    <a href="{$urls.pages.index}" class="btn-primary">
      Continuer mes achats
    </a>
  </div>
{/block}


{block name='page_footer'}
{/block}
