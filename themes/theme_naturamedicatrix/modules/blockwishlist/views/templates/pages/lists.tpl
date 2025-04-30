{**
* CUSTOM WISHLIST PAGE
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{block name='page_header_container'}
{/block}

{block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mes listes d\'envies' d='Modules.Blockwishlist.Shop'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block}

{block name='page_content_container'}
  <div
    class="wishlist-container"
    data-url="{$url}"
    data-title="{$wishlistsTitlePage}"
    data-empty-text="{l s='Aucune liste d\'envies trouvée.' d='Modules.Blockwishlist.Shop'}"
    data-rename-text="{l s='Renommer' d='Modules.Blockwishlist.Shop'}"
    data-share-text="{l s='Partager' d='Modules.Blockwishlist.Shop'}"
    data-add-text="{$newWishlistCTA}"
  ></div>

  {include file="module:blockwishlist/views/templates/components/modals/share.tpl" url=$shareUrl}
  {include file="module:blockwishlist/views/templates/components/modals/rename.tpl" url=$renameUrl}
{/block}

{block name='page_footer_container'}
  <div class="wishlist-footer-links">
    <a href="{$link->getPageLink('my-account', true)|escape:'html'}" class="text-primary"><i class="bi bi-chevron-left"></i>{l s='Retour à mon compte' d='Modules.Blockwishlist.Shop'}</a>
    <a href="{$urls.base_url}" class="text-primary"><i class="bi bi-house"></i>{l s='Accueil' d='Shop.Theme.Global'}</a>
  </div>
{/block}
