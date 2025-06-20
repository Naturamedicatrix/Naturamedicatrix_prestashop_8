{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
 

{* VARIABLES *}
{assign var=productName value=$product.name|escape:'html':'UTF-8'}
{assign var=productName value=$productName|replace:'(':'<span class="small"> - '}
{assign var=productName value=$productName|replace:')':'</span>'}

{if isset($product.rounded_display_price) && isset($product.nm_days) && $product.nm_days != 0 && !is_array($product.rounded_display_price) && !is_array($product.nm_days)}
  {math equation="x / y" x=$product.rounded_display_price y=$product.nm_days format="%.2f" assign=prix_journalier}
{else}
  {assign var=prix_journalier value=""}
{/if}
{* END VARIABLES *}
 
{extends file=$layout}

{block name='head' append}
  <meta property="og:type" content="product">
  {if $product.cover}
    <meta property="og:image" content="{$product.cover.large.url}">
  {/if}

  {if $product.show_price}
    <meta property="product:pretax_price:amount" content="{$product.price_tax_exc}">
    <meta property="product:pretax_price:currency" content="{$currency.iso_code}">
    <meta property="product:price:amount" content="{$product.price_amount}">
    <meta property="product:price:currency" content="{$currency.iso_code}">
  {/if}
  {if isset($product.weight) && ($product.weight != 0)}
  <meta property="product:weight:value" content="{$product.weight}">
  <meta property="product:weight:units" content="{$product.weight_unit}">
  {/if}
{/block}

{block name='head_microdata_special'}
  {include file='_partials/microdata/product-jsonld.tpl'}
{/block}

{block name='content'}


  <style>
      hr {
        margin: 1rem 0;
      }
      
      .breadcrumb {
        padding-top: 20px !important;
      }
      
      #header .top-menu a[data-depth="0"]:hover, a:hover {
        color : #155585;
      }
      
      .product-container {
        padding-top: 1rem;
      }
      
      #product-block-infos {
        padding-right: 150px;
      }
      
      .product-manufacturer,
      .product-reference {
        color: #93A7C3;
        font-size: 0.9rem;
        margin-top: 5px;
      }
      
      .product-reference {
        float: right;
      }
    
      #product-block-infos h1 {
        text-align: left;
        font-size: 2rem;
        margin-top: 0.3rem;
        margin-bottom: 0.3rem;
      }
      
      #product-block-infos h1 .small {
        font-size: 1.2rem;
      }      
      
      .product-flags {
        padding-left: 0px;
        margin-top: 0px;
        gap: 5px;
        position: relative;
        flex-direction: row;
        display: inline-flex;
      }
      
      .product-flags li.product-flag.online-only {
        position: initial;
        color: #626265;
        background: #ececec;
        border-color: #ececec;
      }
      
      .product-flags li.product-flag,
      .has-discount .discount {
        font-size: 0.8rem;
        text-transform: inherit;
        background: none;
        color: #68768a;
        border: 1px solid #93A7C3;
        padding: 2px 10px;
        border-radius: 15px;
        border-top-right-radius: 2px;
        border-bottom-left-radius: 2px;
        line-height: 1.2;
        min-height: auto !important;
        min-width: auto;
        font-weight: normal !important;
        text-align: center;
        margin-top: 0;
      }
      
      .product-flags .out_of_stock,
      .product-flags .discount {
        display: none;
      }
      
      .product-flags .new {
        color: #136f9b !important;
        background: #d1eaf6 !important;
        border-color: #d1eaf6 !important;
      }
      
      .product-flags .discount,
      .has-discount .discount {
        background-color: #e45b7f !important;
        color: #f9fafb !important;
        border-color: #e45b7f !important;
        font-weight: 900 !important;
      }
      
      .has-discount .discount {
        font-size: 0.9rem;
        margin-left: 0;
      }      
      
      .seemore a {
        margin-top: 5px;
        font-size: 0.9rem;
        text-decoration: underline;
        display: inline-block;
        font-weight: 600;
      }
      
      #product-block-infos .product-description {
        margin-top: 10px;
        margin-bottom: 2rem;
      }
      
      #product-block-infos .lead {
        line-height: 1.2;
      }
      
      #product-block-infos .review-score {
        padding-top: 0;
      }
      
      .product-information p {
        padding-bottom: 0;
      }
      
      .product-information .product-description p,
      .product-information .product-description li  {
        color: #4B5563 !important;
        padding-bottom: 3px;
      }
      
      .product-information .product-description ul {
        margin-top: 5px;
      }
      
      .product-information .alert {
        margin: 0;
        max-width: 100%;
      }
      
      .product-variants ul {
        padding: 0;
      }
      
      .product-variants-item label {
        margin-bottom: 0;
      }
      
      
      .product-variants .input-color:checked+span,
      .product-variants .input-radio:checked+span, 
      
      .product-variants .input-color:hover:checked+span,
      .product-variants .input-radio:hover:checked+span
       {
        border: 2px solid #4B5563;
      }
      
      .product-variants .input-color:hover+span,
      .product-variants .input-radio:hover+span {
        border: 1px solid #e5e8ea; 
      }
      
      .product-variants .input-radio {
        right: 0;
      }
      
      .product-variants .radio-label {
        border: 1px solid #e5e8ea;
        font-weight: normal;
        color: #4B5563 !important;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 1rem;
      }
      
      .bi-circle-fill {
        font-size: 0.35rem;
        position: relative;
        top: -2px;
      }
      
      #product-availability {
        font-size: 0.8rem;
        font-weight: normal;
        color : #ee5c58;
      }
      
      #product-instock {
        font-size: 0.8rem;
        font-weight: normal;
      }
      
      #product-availability,
      #product-instock {
        display: block;
        margin-bottom: 3px;
      }
      
      #product-availability .product-last-items, 
      #product-availability .product-unavailable {
        color : #ee5c58;
      }
      
      #dlu {
        font-size: 0.9rem;
        color :#4B5563;
      }
      
      #dlu.badge-dlu {
        font-size: 1.2rem;
        background: #e45b7f;
        color: white;
        padding: 0 0.5rem;
        border-radius: 4px;
        display: inline;
      }
      
      #dlu.badge-dlu strong {
        text-wrap: nowrap;
      }
      
      #dlu.badge-dlu i {
        font-size: 80%;
      }
      
      .product-prices {
        text-align: right;
        margin-top: 0;
      }
      
      .current-price-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
      }
      
      .current-price,
      .product-price.h5 {
        margin: 0 !important;
      }
      
      .product-discount {
        display: inline-block;
        margin: 0 !important;
      }
      
      .product-discount .regular-price {
        font-size: .875rem;
        color: #4B5563;
      }
      
      .infoandprice {
        display: flex;
        align-items: end;
        justify-content: space-between;
      }
      
      .tax-shipping-delivery-label {
        display: none;
      }
      
      .bootstrap-touchspin .input-group-btn-vertical>.btn {
       min-width: inherit;
      }
      
      .product-actions .btn-primary {
        width: 100%;
        padding-top: 12px;
        line-height: 1;
      }
      .product-actions .btn-primary i {
        margin-right: 5px;
      }
      
      .product-actions .add-to-cart:disabled {
        background: rgba(0,0,0,.25) !important;
        border-color : #c6c6c6 !important;
        opacity: 1;
      }
      
      .product-quantity .add {
        flex-grow: 2;
      }
      

      .product-additional-info {
        display: flex;
      }
      
      .js-mailalert {
        width: 100%;
      }
      
      .js-mailalert .form-control {
        margin-bottom: 5px;
            padding: .65rem 1rem;
            background: white;
            border-radius: 4px;
      }
      
      .wishlist-button-product {
        border : 1px solid rgba(0,0,0,.25);
        border-radius: 4px;
        width: 3rem;
        height: 2.75rem;
        padding: .175rem .5rem;
        color: #4B5563;
        background-color: #fff;
        margin-left: .4rem;
      }
      .wishlist-button-product i {
        color : #4B5563 !important; 
      }
      .wishlist-button-add:hover {
        opacity: 1;
      }
      
      #prix_journalier {
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
        line-height: 1;
        align-items: normal;
        gap: 0.5rem;
      }
      
      #prix_journalier .col {
        align-content: center;
        width: calc(100%/3);
        color: #111927;
      }
      
      #prix_journalier .col-middle {
        border-right: 1px solid #c6c6c6;
        border-left: 1px solid #c6c6c6;
      }
      
      #prix_journalier .col p {
        font-weight: 600;
        font-size: 90%;
        margin-top: 0.3rem;
        color: #111927;
      }
      
      .product-images {
        padding: 0;
        margin: 0;
      }
      
      .product-images li.thumb-container .thumb {
        border: 1px solid #e5e8ea;
        border-radius: 4px;
        margin-right: 0 !important;
      }
      
      .product-images>li.thumb-container .thumb.selected, 
      .product-images>li.thumb-container .thumb:hover {
        border: 1px solid #4B5563;
      }
      
      #product-modal .modal-content .modal-body .product-images img:hover {
        border: 1px solid #4B5563;
      }
      
      #product-modal .thumb-video .thumb {
        height: 108px;
      }
      
      .thumb-video .thumb {
        display: flex;
        height: 73px;
        align-items: center;
        justify-content: center;
        background: white;
      }
      
      #modal-video-container {
        position: absolute;
        top: 15px;
        left: 15px;
      }
      
      #main .images-container .js-qv-mask.scroll {
        width: auto;
      }
      
      .images-container {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
      }
      
      .product-cover {
        margin-left: 15px;
        margin-bottom: 0;
      }
      
      #product #content {
        max-width: 600px;
      }
      
      
      #product-slider-items {
        display: flex;
        position: relative;
        justify-content: space-around;
      }
      
      #product-slider-items:before {
        content: '';
        border-top: 1px dashed #c6c6c6;
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        top: 100px;
      }
      
      #product-slider-items .item {
        background: white;
        z-index: 1;
        padding: 0 1rem;
        margin: 0 1rem;
        text-align: center;
      }
      
      #product-slider-items span {
        display: inline-block;
      }
      
      #product-slider-items .icon-special:after {
        width: 45px;
        height: 45px;
      }
      
      #product-slider-items img {
        width: 60px;
        border-radius: 50%;
        margin: 0 auto;
      }
      
      
      #manufacturer_block {
        display: flex;
        margin: 5rem 0;
        background: #f9fafb;
      }
      
      #manufacturer_block .block {
        padding: 1rem 3rem;
        border: 1px solid #e5e8ea;
        border-radius: 10px;
      }

      
      #manufacturer_block .product-manufacturer-img img {
        max-width: 165px;
      }
      
      #manufacturer_block .product-manufacturer-infos {
        display: flex;
        gap: 3rem;
        align-items: center;
      }
      
      #manufacturer_block .product-manufacturer-infos p {
        font-size: 0.9rem;
      }
      
      #manufacturer_block .seemore a {
        margin-top: 0;
      }
      
      #manufacturer_block .product-manufacturer-imgplus {
        padding: 0;
        width: 100%;
        overflow: hidden;
        margin-left: 2rem;
      }
      
      #manufacturer_block .product-manufacturer-imgplus img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      
      #manufacturer_block.brand-5 .product-manufacturer-infos {
        /* Olivie Pharma */
        background: #efece6;
      }
      
      #manufacturer_block.brand-4 .product-manufacturer-infos {
        /* NATURAMedicatrix */
        background: #f1f7f1;
      }
      
      #manufacturer_block.brand-3 .product-manufacturer-infos {
        /* Dr Jacob */
        background: #f8faff;
      }
      
    
      .product-container .tab-pane ul {
        list-style: disc;
      }
      
      .product-discounts {
        margin-bottom: 0.5rem;
      }
      
      #description .product-description > h2,
      #description .product-description > .h2 {
        margin-top : 10px;
      }
      
      #composition table {
        max-width: 700px;
        font-size: 0.9rem;
      }
      
      .table-striped tbody tr:nth-of-type(odd) {
        background: white;
      }
      
      .table-striped > tbody > tr:nth-of-type(even), 
      table > tbody > tr:nth-of-type(even) {
        background: #f9fafb;
      }
      .table thead th {
        background: #edeff1;
      }
      
      .table-small td {
        padding: 0.3rem .5rem;
      }
      
      .table-compare {
        border-radius: 10px;
        margin: 0;
      }
      .table-compare td,
      .table-compare th {
        border: 1px solid #ced2d9 !important;
        font-size: 0.85rem;
        vertical-align: middle !important;
      }
      
      .table-compare td:last-child,
      .table-compare th:last-child {
        border-right: none !important;
      }
      
      .table-compare tr:last-child td {
        border-bottom: none !important;
      }
      
      .table-compare td:first-child,
      .table-compare th:first-child {
        border-left: none !important;
      }
      
      .table-compare th {
        background: white !important;
        text-align: center;
        border-top: none !important;
      }
      .table-compare tbody tr:nth-child(odd) td {
        background: #f9fafb;
      }
      .table-compare tbody tr:nth-child(even) td {
        background: white;
      }
      .table-compare img {
        margin: 0 auto 1rem;
        max-width: 150px;
      }
      .table-responsive {
        border: 1px solid #ced2d9 !important;
        border-radius: 20px;
        margin-bottom: 1rem;
      }
      
      /* ONGLETS */
      .vertical-tabs {
        margin-top: 0 !important;
        border-bottom: none !important;
        padding-right: 50px;
      }
      
      .tabs .nav-tabs .nav-link.color-pro,
      .color-pro {
        color : #60ada7 !important;
      }
      
      .nav-tabs .nav-item+.nav-item {
        margin-left: 0 !important;
      }
      
      .tabs {
        padding-top: 3rem;
      }
      

      
      .tabs .tab-pane {
        padding-top: 0;
      }
      
      .vertical-tabs .nav-item {
        margin-bottom: 0 !important;
        width: 100% !important;
      }
      
      .vertical-tabs .nav-link,
      .vertical-tabs .nav-link.js-product-nav-active,
      .vertical-tabs .nav-link.active {
        border-radius: 0 !important;
        border: none !important;
        padding: 17px 0 !important;
        transition: all 0.2s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        font-weight: 500;
        color: #4B5563 !important;
        margin: 0 !important;
        line-height: normal !important;
        border-bottom: 1px solid #e5e8ea !important;
        font-size: 0.9rem;
      }
      
      .vertical-tabs .nav-link:after {
        content: '\2192' !important; /* Flèche droite */
        opacity: 0 !important;
        transition: opacity 0.2s ease, transform 0.2s ease !important;
      }
      
      .vertical-tabs .nav-link:hover {
        color: #83b58b !important;
      }
      
      .vertical-tabs .nav-link:hover:after {
        opacity: 1 !important;
        transform: translateX(3px) !important;
      }
      
      .vertical-tabs .nav-link.active,
      .vertical-tabs .nav-link.js-product-nav-active {
        color: #83b58b !important;
        font-weight: 600 !important;
      }
      
      .vertical-tabs .nav-link.active:after,
      .vertical-tabs .nav-link.js-product-nav-active:after {
        opacity: 1 !important;
      }
      
      .tab-content {
        border-left: 1px solid #e5e8ea !important;
        padding: 0px 0 20px 50px !important;
      }
      
      .product-custom-content {
        padding: 5px 0 !important;
      }

      .tab-pane {
        transition: opacity 0.2s ease !important;
      }
      
      .tab-pane.fade {
        opacity: 0 !important;
      }
      
      .tab-pane.fade.in.active {
        opacity: 1 !important;
      }
      
      #product-details #block_wrapper {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      
      #product-details .block {
        border-radius: 10px;
        border: 1px solid #e5e8ea;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        flex: 0 0 calc(100%/3 - 1rem);
      }
      
      #product-details .block .icon-special {
        display: inline-block;
      }
      
      #product-details .block .icon-special:after {
        width: 35px;
        height: 35px;
      }


      .sticky-tabs-nav {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        max-height: 80vh;
        overflow-y: auto;
      }
  </style>


  <section id="main">
    <meta content="{$product.url}">


    <!-- STICKY MENU -->
    {block name='sticky_menu'}
      {include file='catalog/_partials/sticky-menu.tpl'}
    {/block}
    
    
    {block name='breadcrumb'}
     {include file='_partials/breadcrumb.tpl'}
   {/block}

    <div class="row product-container js-product-container">
      <div class="col-md-6 col-xs-12" id="product-block-image">
        {block name='page_content_container'}
          <section class="page-content" id="content">
            {block name='page_content'}

              {block name='product_cover_thumbnails'}
                {include file='catalog/_partials/product-cover-thumbnails.tpl'}
              {/block}
{*
              <div class="scroll-box-arrows">
                <i class="material-icons left">&#xE314;</i>
                <i class="material-icons right">&#xE315;</i>
              </div>
*}
            {/block}
          </section>
        {/block}
        </div>
        <div class="col-md-6 col-xs-12" id="product-block-infos">
          {block name='page_header_container'}
            
            {include file='catalog/_partials/product-flags.tpl'}
            
            <span class="product-reference">Réf. {$product.reference}</span>
            
            <div class="product-manufacturer">
              <span><a href="#manufacturer_block" title="En savoir plus sur {$product.manufacturer_name}">{$product.manufacturer_name}</a></span>
            </div>
            
            {block name='page_header'}
              <h1 class="h1">{block name='page_title'}{$productName nofilter}{/block}</h1>
            {/block}
            
             <div class="review-product">
              <div class="review-score text-left text-xs">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
                <span class="review-stats">238 avis</span>
              </div>
            </div>
          {/block}

          <div class="product-information">
            {block name='product_description_short'}
              <div id="product-description-short-{$product.id}" class="product-description">
                {$product.description_short nofilter}
                <p class="seemore">» <a href="#description">Lire la suite</a></p>
              
              </div>
            {/block}
            

            {if $product.is_customizable && count($product.customizations.fields)}
              {block name='product_customization'}
                {include file="catalog/_partials/product-customization.tpl" customizations=$product.customizations}
              {/block}
            {/if}

            <div class="product-actions js-product-actions">
              {block name='product_buy'}
                <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
                  <input type="hidden" name="token" value="{$static_token}">
                  <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                  <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">

                  {block name='product_variants'}
                    {include file='catalog/_partials/product-variants.tpl'}
                  {/block}

                  {block name='product_pack'}
                    {if $packItems}
                      <section class="product-pack">
                        <p class="h4">{l s='This pack contains' d='Shop.Theme.Catalog'}</p>
                        {foreach from=$packItems item="product_pack"}
                          {block name='product_miniature'}
                            {include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack showPackProductsPrice=$product.show_price}
                          {/block}
                        {/foreach}
                    </section>
                    {/if}
                  {/block}
                  
                  
                  <div class="infoandprice">
              
                    <div class="availabledlu">
                    {block name='product_availability'}
                      {if $product.quantity > 0}<span id="product-instock" class="text-green-600"><i class="bi bi-circle-fill"></i> En stock</span>{/if}
                        {if $product.show_availability && $product.availability_message}
                        <span id="product-availability" class="js-product-availability">
                          {if $product.availability == 'available'}
                            <i class="bi bi-circle-fill rtl-no-flip product-available"></i>
                          {elseif $product.availability == 'last_remaining_items'}
                            <i class="bi bi-circle-fill product-last-items"></i>
                          {else}
                            <i class="bi bi-circle-fill product-unavailable"></i>
                          {/if}
                          {$product.availability_message}
                          </span>
                        {/if}
                    {/block}
                    
                    {if isset($product.dlu)}<div id="dlu"{if $product.dlu_checkbox} class="badge-dlu"{/if}><small>Date limite conseillée&nbsp;:</small> <strong>{$product.dlu|date_format:"%d-%m-%Y"}</strong> <i class="bi bi-info-circle info-tooltip" data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="bottom" data-bs-placement="bottom" title="Jusqu'à l'expiration de la date d'utilisation conseillée, nous vous garantissons un produit irréprochable. Cependant, l'expiration de la date d'utilisation conseillée ne signifie pas nécessairement qu'un produit n'est plus utilisable ou consommable ou présente un danger pour la santé. Si le produit vous semble correct en termes d'apparence et/ou d'odeur, vous pouvez l'utiliser sans problème."></i></div>{/if}
                    
                    </div> <!-- .availabledlu -->       
                              
                    {block name='product_prices'}
                      {include file='catalog/_partials/product-prices.tpl'}
                    {/block}
                  
                  </div> <!-- .infoandprice -->

                  {block name='product_discounts'}
                    {include file='catalog/_partials/product-discounts.tpl'}
                  {/block}
                  
                  
                  {if $product.availability == 'available'}
                    {block name='product_add_to_cart'}
                      {include file='catalog/_partials/product-add-to-cart.tpl'}
                    {/block}
                  {/if}
                
                  {block name='product_additional_info'}
                    {include file='catalog/_partials/product-additional-info.tpl'}
                  {/block}

                  {* Input to refresh product HTML removed, block kept for compatibility with themes *}
                  {block name='product_refresh'}{/block}
                </form>
              {/block}

            </div>

{*
            {block name='hook_display_reassurance'}
              {hook h='displayReassurance'}
            {/block}
*}



            
            <div id="prix_journalier" class="text-center">
              
              {if isset($product.features) && $product.features}
                <div class="col">
                  {foreach from=$product.features item=feature}
                    {if isset($feature.value) && $feature.value|trim != '' && $feature.id_feature == 3}
                      <i class="bi bi-capsule"></i>
                      <p>{$feature.value|escape:'html':'UTF-8'}</p>
                    {/if}
                  {/foreach}
                </div>
              {/if}
              
              {if isset($product.nm_days)}
              <div class="col col-middle">
                <i class="bi bi-calendar-week"></i>
                <p>± {$product.nm_days} jours<br/><small>de consommation</small></p>
              </div>
              {/if}
              
              {if isset($prix_journalier) && $prix_journalier != ""} 
              <div class="col">
                <i class="bi bi-tag"></i>
                <p>{$prix_journalier|replace:'.':','}&nbsp;€<br /><small>/ jour</small></p>
              </div>
              {/if}              
            </div>
            
        </div>
      </div>
      
      

      {block name='product_slider_items'}
        {include file='catalog/_partials/product-slider-items.tpl'}
      {/block}

      

      
            {block name='product_tabs'}

              <div class="tabs clear row">
                
                <ul class="nav nav-tabs col-md-3 col-sm-12 vertical-tabs sticky-tabs-nav" role="tablist">
                  <p class="h4">{$product.name}</p>
                 
                  {* Groupes Thérapeute BE (ID 4) et Thérapeute FR (ID 5) *}
                  {if $product.thera_sup && isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5)}
                    <li class="nav-item">
                       <a
                         class="nav-link color-pro active js-product-nav-active"
                         data-toggle="tab"
                         href="#thera_sup"
                         role="tab"
                         aria-controls="thera_sup"
                         aria-selected="true">
                         <i class="bi bi-lock-fill"></i> {l s='Professional information' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}
                  
                  {if $product.description}
                    <li class="nav-item">
                       <a
                         class="nav-link{if $product.description && !(isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5) && $product.thera_sup)} active js-product-nav-active{/if}"
                         data-toggle="tab"
                         href="#description"
                         role="tab"
                         aria-controls="description"
                         {if $product.description && !(isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5) && $product.thera_sup)} aria-selected="true"{/if}>{l s='Description' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}
                  {if isset($product.mode_emploi) && $product.mode_emploi}
                    <li class="nav-item">
                      <a class="nav-link"
                         data-toggle="tab"
                         href="#mode-emploi"
                         role="tab"
                         aria-controls="mode-emploi">{l s='Mode d\'emploi' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}
                  {if isset($product.ingredients) && $product.ingredients}
                    <li class="nav-item">
                      <a class="nav-link"
                         data-toggle="tab"
                         href="#composition"
                         role="tab"
                         aria-controls="composition">{l s='Composition' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}

                  <li class="nav-item">
                    <a
                      class="nav-link{if !$product.description} active js-product-nav-active{/if}"
                      data-toggle="tab"
                      href="#product-details"
                      role="tab"
                      aria-controls="product-details"
                      {if !$product.description} aria-selected="true"{/if}>{l s='Certifications' d='Shop.Theme.Catalog'}</a>
                  </li>
                  
                  
                  {if $product.attachments}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#attachments"
                        role="tab"
                        aria-controls="attachments">{l s='Attachments' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}
                  {foreach from=$product.extraContent item=extra key=extraKey}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#extra-{$extraKey}"
                        role="tab"
                        aria-controls="extra-{$extraKey}">{$extra.title}</a>
                    </li>
                  {/foreach}
                  
                  {if $product_manufacturer->id == 5}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#comparer"
                        role="tab"
                        aria-controls="comparer">{l s='Comparer et bien choisir' d='Shop.Theme.Catalog'}</a>
                    </li>
                  {/if}
                  
                </ul>
                

                
                <div class="tab-content col-md-8 col-sm-12" id="tab-content">
                 
                {* Groupes Thérapeute BE (ID 4) et Thérapeute FR (ID 5) *}
                {if $product.thera_sup && isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5)}
                 <div class="tab-pane fade in active js-product-tab-active" id="thera_sup" role="tabpanel">

                     <p class="h4 color-pro"><i class="bi bi-unlock-fill"></i> {l s='Professional-use information' d='Shop.Theme.Catalog'}</p>
                     {$product.thera_sup nofilter}

                 </div>
                 {/if}
                 
                 
                 <div class="tab-pane fade in{if $product.description && !(isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5) && $product.thera_sup)} active js-product-tab-active{/if}" id="description" role="tabpanel">
                   {block name='product_description'}
                     <div class="product-description">{$product.description nofilter}</div>
                   {/block}
                 </div>
                 
                 {if (isset($product.ingredients) && $product.ingredients) || (isset($product.tab_nutri) && $product.tab_nutri)}
                    <div class="tab-pane fade in" id="composition" role="tabpanel">
                      {if isset($product.ingredients) && $product.ingredients}
                        <p class="h4">Ingrédients</p>
                        {$product.ingredients nofilter}
                      {/if}
                      
                      {if isset($product.tab_nutri) && $product.tab_nutri}
                        <hr />
                        <p class="h4">Tableau nutritionnel</p>
                        {$product.tab_nutri nofilter}
                      {/if}
                    </div>
                 {/if}

                 
                 {if (isset($product.mode_emploi) && $product.mode_emploi) || (isset($product.contre_indications) && $product.contre_indications)}
                  <div class="tab-pane fade in" id="mode-emploi" role="tabpanel">
                    
                      <p class="h4">Conseils d'utilisation</p>
                      {$product.mode_emploi nofilter}
                      
                      <hr />
                                                         
                      <p class="h4">Contre-indications</p>
                      {if isset($product.contre_indications) && $product.contre_indications} 
                        {$product.contre_indications nofilter}
                      {/if}
                      <ul class="legal-information text-sm">
              			     <li>Ne pas dépasser la dose quotidienne recommandée.</li>
              			     <li>Tenir hors de portée des enfants.</li>
              			     <li>Les compléments alimentaires ne doivent pas être utilisés comme substituts à une alimentation variée et équilibrée ni à un mode de vie sain.</li>
            			    </ul>
                  </div>
                {/if}
                
                {if $product_manufacturer->id == 5}
                  {block name='comparer'}
                  <div class="tab-pane fade in" id="comparer" role="tabpanel">
                    {include file='../_partials/tab/tab-olivie.tpl'}
                  </div>
                  {/block}
                {/if}

                 {block name='product_details'}
                   {include file='catalog/_partials/product-details.tpl'}
                 {/block}

                 {block name='product_attachments'}
                   {if $product.attachments}
                    <div class="tab-pane fade in" id="attachments" role="tabpanel">
                       <section class="product-attachments">
                         <p class="h5 text-uppercase">{l s='Download' d='Shop.Theme.Actions'}</p>
                         {foreach from=$product.attachments item=attachment}
                           <div class="attachment">
                             <h4><a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">{$attachment.name}</a></h4>
                             <p>{$attachment.description}</p>
                             <a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
                               {l s='Download' d='Shop.Theme.Actions'} ({$attachment.file_size_formatted})
                             </a>
                           </div>
                         {/foreach}
                       </section>
                     </div>
                   {/if}
                 {/block}

                 {foreach from=$product.extraContent item=extra key=extraKey}
                 <div class="tab-pane fade in {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" {foreach $extra.attr as $key => $val} {$key}="{$val}"{/foreach}>
                   {$extra.content nofilter}
                 </div>
                 {/foreach}
              </div>
            </div>
            
            <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', function() {
                // Variables pour le scroll avec limite
                var tabContent = document.getElementById('tab-content');
                var tabNav = document.querySelector('.sticky-tabs-nav');
                
                if (tabContent && tabNav) {
                  // Gestion du scroll limite
                  window.addEventListener('scroll', function() {
                    var tabContentBottom = tabContent.getBoundingClientRect().bottom;
                    var navHeight = tabNav.offsetHeight;
                    var windowHeight = window.innerHeight;
                    
                    if (tabContentBottom < windowHeight && window.innerWidth > 767) {
                      var topPosition = Math.max(0, windowHeight - tabContentBottom - navHeight);
                      tabNav.style.top = (100 - topPosition) + 'px';
                    } else {
                      tabNav.style.top = '100px';
                    }
                  });
                  
                  var tabLinks = tabNav.querySelectorAll('li.nav-item a.nav-link');
                  tabLinks.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                      setTimeout(function() {
                        // Cible directement #product-slider-items
                        var targetElement = document.getElementById('product-slider-items');
                        if (targetElement) {
                          targetElement.scrollIntoView({ behavior: 'smooth' });
                        }
                      }, 50);
                    });
                  });
                }
              });
            </script>
          {/block}  
    </div>
    
    

    {if isset($product_manufacturer->id)}
      <div id="manufacturer_block" class="product-manufacturer brand-{$product_manufacturer->id}" itemprop="brand" itemscope itemtype="https://schema.org/Brand">
        <div class="block product-manufacturer-infos">
        {if isset($manufacturer_image_url)}
          <a href="{$product_brand_url}" class="product-manufacturer-img">
            <figure>
              <img src="{$manufacturer_image_url}" class="img img-fluid manufacturer-logo" alt="{$product_manufacturer->name}" loading="lazy">
              <meta itemprop="logo" content="{$manufacturer_image_url}" />
            </figure>
          </a>
        {/if}
          <div class="product-manufacturer-name">
            <h4 itemprop="name"><a href="{$product_brand_url}">{$product_manufacturer->name}</a></h4>
            {$product_manufacturer->short_description nofilter}
            <p class="seemore">» <a href="{$product_brand_url}">Les produits {$product_manufacturer->name}</a></p>
          </div>
        </div>
          
        {if $product_manufacturer->id == 5}
          <div class="block product-manufacturer-imgplus">
            <img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/brands/brand-olivie.jpg" />
          </div>
        {elseif $product_manufacturer->id == 4}
          <div class="block product-manufacturer-imgplus">
            <img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/brands/brand-naturamedicatrix.jpg" />
          </div>
        {elseif $product_manufacturer->id == 3}
          <div class="block product-manufacturer-imgplus">
            <img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/brands/brand-jacob.jpg" />
          </div>
        {/if}
      </div>
    {/if}
    
    {block name='product_accessories'}
      {if $accessories}
        <section class="product-accessories clearfix">
          <p class="h5 text-uppercase">{l s='You might also like' d='Shop.Theme.Catalog'}</p>
          <div class="products row">
            {foreach from=$accessories item="product_accessory" key="position"}
              {block name='product_miniature'}
                {include file='catalog/_partials/miniatures/product.tpl' product=$product_accessory position=$position productClasses="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
              {/block}
            {/foreach}
          </div>
        </section>
      {/if}
    {/block}
    
    
    
    
    
    {* SHOPIMIND INTERETS PRODUCTS *}
    <div id="shopimind-interets-products"></div>

    {block name='product_footer'}
      {hook h='displayFooterProduct' product=$product category=$category}
    {/block}

    {block name='product_images_modal'}
      {include file='catalog/_partials/product-images-modal.tpl'}
    {/block}

    {block name='page_footer_container'}
      <footer class="page-footer">
        {block name='page_footer'}
          <!-- Footer content -->
        {/block}
      </footer>
    {/block}
  </section>
  

{/block}
