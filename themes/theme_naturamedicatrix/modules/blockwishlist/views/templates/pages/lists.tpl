{**
* CUSTOM WISHLIST PAGE
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  <div class="wishlist-page-layout">
    {include file='customer/_partials/account-left-column.tpl'}
  </div>
{/block}
{* END LEFT COLUMN *}





{block name='page_content_container'} 

  {* BREADCRUMB *}
  {* <nav data-depth="2" class="breadcrumb">
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
  </nav>*}

  {block name='page_header_container'}
    {block name='page_title'}
      <h1>{$wishlistsTitlePage}</h1>
    {/block}
  {/block} 
  
  <div
    class="wishlist-container mt-6"
    data-url="{$url}"
    data-empty-text="{l s='Aucune liste d\'envies trouvée.' d='Modules.Blockwishlist.Shop'}"
    data-rename-text="{l s='Renommer' d='Modules.Blockwishlist.Shop'}"
    data-share-text="{l s='Partager' d='Modules.Blockwishlist.Shop'}"
    data-add-text="{$newWishlistCTA}"
  ></div>

  {include file="module:blockwishlist/views/templates/components/modals/share.tpl" url=$shareUrl}
  {include file="module:blockwishlist/views/templates/components/modals/rename.tpl" url=$renameUrl}
  
  
  
  <style>
    .wishlist-container-header h1 {
      display: none;
    }  
    .wishlist-container {
      margin-top: 1.5rem;
    }
    
    
    .wishlist-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-top: 1rem;
    }
    
    .wishlist-list-item {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
      max-width: 457px;
      padding-bottom: 2rem;
    }
    
    /* Titre avec fond gris + trash à droite */
    .wishlist-list-item-link {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      padding: 0;
      text-decoration: none !important;
    }
    
    .wishlist-list-item-title span {
      background: #e45b7f;
      color: white;
      border-radius: 50%;
      width: 25px;
      height: 25px;
    }
    
    .wishlist-list-item-title {
      width: 100%;
      color: #111827;
      font-weight: 700;
      font-size: 1.125rem;
      line-height: 1.75rem;
      padding-top: 1.25rem;
      padding-bottom: 1.25rem;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
      background: #f9fafb;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    /* Icône cœur centrée */
    .wishlist-list-item-right::before {
      content: "\f71f";
      font-family: 'Bootstrap-icons';
      font-size: 3rem;
      color: #9ca3af;
      display: block;
      margin: 1rem auto 2rem auto;
    }
    
    .wishlist-list-item .dropdown-menu {
      right: 0 !important;
    }
    
    /* Boutons (partage...) */
    .wishlist-list-item-right {
      margin-top: auto;
    }
    
    .wishlist-list-item-right button,
    .wishlist-list-item-right a {
      font-size: 0.875rem;
      padding: 0.4rem 0.8rem;
      border: 1px solid #e5e7eb;
      background: white;
      border-radius: 0.375rem;
      color: #374151;
      transition: all 0.2s ease;
    }
    
    .wishlist-list-item-right button:hover,
    .wishlist-list-item-right a:hover {
      background: #f3f4f6;
      color: #111827;
    }
    
    .wishlist-list-item:hover .wishlist-list-item-title {
      color: #4B5563;
    }    
    
  </style>
  
  
  
{/block}

{* {block name='page_footer_container'}
  <div class="wishlist-footer-links">
    <a href="{$link->getPageLink('my-account', true)|escape:'html'}" class="text-primary"><i class="bi bi-chevron-left"></i>{l s='Retour à mon compte' d='Modules.Blockwishlist.Shop'}</a>
    <a href="{$urls.base_url}" class="text-primary"><i class="bi bi-house"></i>{l s='Accueil' d='Shop.Theme.Global'}</a>
  </div>
{/block} *}


