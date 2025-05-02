{**
* CUSTOM WISHLIST PAGE
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}




{block name='page_content_container'}

  {* BREADCRUMB *}
  <nav data-depth="2" class="breadcrumb">
    <ol>
      <li>
        <a href="{$urls.base_url}"><span>{l s='Accueil' d='Shop.Theme.Global'}</span></a>
      </li>
      <li>
        <a href="{$link->getPageLink('my-account', true)|escape:'html'}"><span>{l s='Mon compte' d='Shop.Theme.Customeraccount'}</span></a>
      </li>
      <li>
        <span>{l s='Mes listes d\'envies' d='Modules.Blockwishlist.Shop'}</span>
      </li>
    </ol>
  </nav>

  {block name='page_header_container'}
    {block name='page_title'}
      {include file='_partials/page-title-with-svg.tpl' title=$wishlistsTitlePage}
    {/block}
  {/block}
  
  <div
    class="wishlist-container"
    data-url="{$url}"
    data-empty-text="{l s='Aucune liste d\'envies trouvée.' d='Modules.Blockwishlist.Shop'}"
    data-rename-text="{l s='Renommer' d='Modules.Blockwishlist.Shop'}"
    data-share-text="{l s='Partager' d='Modules.Blockwishlist.Shop'}"
    data-add-text="{$newWishlistCTA}"
  ></div>

  {include file="module:blockwishlist/views/templates/components/modals/share.tpl" url=$shareUrl}
  {include file="module:blockwishlist/views/templates/components/modals/rename.tpl" url=$renameUrl}
{/block}

{* {block name='page_footer_container'}
  <div class="wishlist-footer-links">
    <a href="{$link->getPageLink('my-account', true)|escape:'html'}" class="text-primary"><i class="bi bi-chevron-left"></i>{l s='Retour à mon compte' d='Modules.Blockwishlist.Shop'}</a>
    <a href="{$urls.base_url}" class="text-primary"><i class="bi bi-house"></i>{l s='Accueil' d='Shop.Theme.Global'}</a>
  </div>
{/block} *}
