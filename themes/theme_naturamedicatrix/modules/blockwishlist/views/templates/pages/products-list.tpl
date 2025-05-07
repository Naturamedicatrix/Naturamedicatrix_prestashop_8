{**
* CUSTOM WISHLIST PRODUCTS LIST PAGE
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{block name='page_content'}
  <h1>{$wishlistName}</h1>
  
  <div
    class="wishlist-products-container"
    data-url="{$url}"
    data-list-id="{$id}"
    data-default-sort="{l s='Last added' d='Modules.Blockwishlist.Shop'}"
    data-add-to-cart="{l s='Add to cart' d='Shop.Theme.Actions'}"
    data-share="{if $isGuest}true{else}false{/if}"
    data-customize-text="{l s='Customize' d='Modules.Blockwishlist.Shop'}"
    data-quantity-text="{l s='Quantity' d='Shop.Theme.Catalog'}"
    data-title="{$wishlistName}"
    data-no-products-message="{l s='No products found' d='Modules.Blockwishlist.Shop'}"
    data-filter="{l s='Sort by:' d='Shop.Theme.Global'}"
  >
  </div>

  {include file="module:blockwishlist/views/templates/components/pagination.tpl"}

  <div class="wishlist-footer-links">
    <a href="{$wishlistsLink}" class="text-primary">
      <i class="bi bi-chevron-left"></i>
      {l s='Return to wishlists' d='Modules.Blockwishlist.Shop'}
    </a>
    <a href="{$urls.base_url}" class="text-primary">
      <i class="bi bi-house"></i>
      {l s='Home' d='Shop.Theme.Global'}
    </a>
  </div>
{/block}
