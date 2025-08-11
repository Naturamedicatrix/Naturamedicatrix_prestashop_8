{**
 FICHE PRODUIT
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

<!-- etiquettes (label) et boites (box) -->
{assign var="labels" value=ProductController::getProductLabels($product.reference)}
{assign var="analyses" value=ProductController::getProductAnalyses($product.reference)}
{assign var="analysesBio" value=ProductController::getProductAnalysesBio($product.reference)}
{assign var="attestations" value=ProductController::getProductAttestations($product.reference)}
{assign var="analysesHalal" value=ProductController::getProductAnalysesHalal($product.reference)}
{assign var="analysesKosher" value=ProductController::getProductAnalysesKosher($product.reference)}
{assign var="analysesGMP" value=ProductController::getProductAnalysesGMP($product.reference)}

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
      
      .mobile-accordion {
        display: none;
      }
      @media (max-width: 767px) {
        .product-container {
          padding-top: 0;
        }
        
        .nav.nav-tabs.col-md-3.col-sm-12.vertical-tabs.sticky-tabs-nav {
          display: none;
        }
        
        .tab-content.col-md-8.col-sm-12 {
          display: none;
        }
        
        #product-block-infos {
          padding-right: 15px !important;
          padding-left: 15px !important;
          text-align: left;
        }
        
        #product-block-infos h1 {
          text-align: left;
        }
        
        .product-flags {
          justify-content: flex-start;
          margin-left: 0;
        }
        
        .product-manufacturer {
          text-align: left;
        }
        
        .product-reference {
          float: none;
          display: block;
          text-align: left;
          margin-bottom: 10px;
          color: #93A7C3;
        }

        #product-block-infos h1 {
          font-size: 1.7rem !important;
          margin-top: 0;
          margin-bottom: 15px;
          line-height: 1.2;
        }

        .yotpo.bottomLine {
          justify-content: flex-start;
          margin-bottom: 18px;
        }
        
        /* Styles pour l'accordéon mobile */
        .mobile-accordion {
          margin-bottom: 0;
          margin-top: 0;
          width: 100%;
          display: block;
        }
        
        .accordion-list {
          list-style: none;
          padding: 0;
          margin: 0;
        }
        
        .accordion-item {
          border-bottom: 1px solid #e5e5e5;
        }
        
        .accordion-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 1rem 0.5rem;
          cursor: pointer;
          background-color: #fff;
        }
        
        .accordion-header h2 {
          margin: 0;
          font-size: 1rem;
          font-weight: 600;
          color: #333;
        }
        
        .accordion-icon {
          font-size: 1.5rem;
          font-weight: 300;
          transition: all 0.3s ease;
          display: inline-block;
        }
        
        .accordion-item.active .accordion-icon {
          transform: rotate(45deg);
        }
        
        .accordion-content {
          padding: 0;
          overflow: hidden;
        }
        
        .product-description {
          text-align: left;
          margin-bottom: 20px;
          font-size: 0.9rem;
          line-height: 1.4;
        }
        
        .product-description .lead {
          font-size: 0.95rem;
          font-weight: 500;
          margin-bottom: 12px;
        }
        
        .product-description p {
          margin-bottom: 10px;
        }
        
        .product-description ul li {
          font-size: 0.9rem;
          line-height: 1.4;
          margin-bottom: 6px;
        }
        
        .availabledlu {
          display: flex;
          flex-direction: column;
          align-items: flex-start;
          margin-bottom: 15px;
        }
        
        #product-instock {
          text-align: left;
          margin-bottom: 8px;
          font-weight: 500;
          color: #28a745;
        }
        
        .product-dlc {
          font-size: 0.85rem;
          margin-bottom: 18px;
          color: #6c757d;
        }
        
        #dlu.badge-dlu {
          font-size: 0.8rem !important;
        }

        .current-price-value {
          font-size: 1.5rem !important;
        }

        .product-discount .regular-price  {
          margin-right: 0 !important;
        }
        
        
        /* Affichage des prix */
        .product-prices {
          margin-top: 5px;
          margin-bottom: 20px;
          display: flex;
          flex-direction: column;
          align-items: flex-start;
        }
        
        .product-discount {
          margin-right: 10px;
          text-align: left;
        }
        
        .product-discount .regular-price {
          font-size: 0.95rem;
          color: #7a7a7a;
        }
        
        .product-price {
          font-size: 1.4rem;
          font-weight: 600;
          color: #000;
          margin-top: 5px;
        }
        
        .product-discount .discount {
          display: inline-block;
          padding: 3px 6px;
          background-color: #f6546a;
          color: white;
          font-size: 0.75rem;
          font-weight: 600;
          border-radius: 3px;
          margin-left: 5px;
          vertical-align: middle;
        }
        
        .product-information {
          text-align: left;
        }
        
        .product-actions .control-label {
          text-align: left;
          display: block;
          margin-bottom: 10px;
          font-weight: 500;
        }
        
        .product-variants-item {
          justify-content: flex-start;
          margin-bottom: 15px;
        }
        
        .product-quantity {
          flex-direction: row;
          justify-content: space-between;
          margin-top: 15px;
          margin-bottom: 15px;
          width: 100%;
        }
        
        .product-quantity .qty {
          margin: 0;
          width: 68px;
        }
        
        .add-to-cart {
          margin: 0;
          padding: 12px 15px;
          flex: 1;
          margin-left: 10px;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        
        .add-to-cart .material-icons {
          margin-right: 8px;
          font-size: 20px;
        }
        
        .input-group-btn-vertical {
          height: 100%;
        }
        
        .input-group-btn-vertical .btn {
          padding: 4px 6px;
        }
        
        #quantity_wanted {
          min-width: 40px;
          height: 40px;
          text-align: center;
        }
        
        /* Adaptation du conteneur pour liste de souhaits */
        .product-actions-main {
          display: flex;
          align-items: center;
          width: 100%;
        }
        
        .wishlist-button-add {
          margin-left: 8px;
          border: 1px solid #e5e5e5;
          border-radius: 4px;
          width: 44px;
          height: 44px;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 0;
          background-color: white;
        }
        
        .wishlist-button-add i {
          font-size: 20px;
          color: #7a7a7a;
        }
      }
      
      #product-block-infos {
        padding-right: 150px;
      }
      
      @media (max-width: 991px) {
        #product-block-infos {
          padding-right: 15px;
          padding-left: 15px;
        }
      }
      
      .product-manufacturer,
      .product-reference {
        color: #93A7C3;
        font-size: 0.9rem;
        margin-top: 5px;
      }
      
      @media (max-width: 767px) {
        .product-manufacturer {
          margin-top: 8px;
          margin-bottom: 8px;
        }
      }
      
      .product-manufacturer .no-underline {
        text-decoration: none;
      }
      .product-manufacturer .no-underline:hover {
        text-decoration: underline;
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
        list-style: none;
        margin-bottom: 0;
      }
      
      .product-flags .pack {
          background-color: #fffbeb !important;
          color: #92400e !important;
          border-color: #fffbeb !important;
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
      
      .product-information p,
      .product-information li {
        padding-bottom: 0;
        margin-bottom: 0;
      }
      
      .product-information .product-description p,
      .product-information .product-description li  {
        color: #4B5563 !important;
      }
      
      .product-information .product-description ul {
        margin-top: 5px;
      }
      
      .product-information .alert {
        margin: 0;
        max-width: 100%;
        padding: .75rem 1.25rem;
        border-radius: 4px;
        line-height: inherit;
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
        padding: 1rem 2rem;
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
        display: flex;
        align-items: center;
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

      .product-quantity #quantity_wanted {
        max-width: 40px;
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
            width: 100% !important;
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
        margin-top: 0.3rem;
        color: #111927;
        line-height: 1;
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
      
      .product-cover .layer {
        background: transparent;
      }
      
      .product-cover .layer .zoom-in {
        display: none;
      }
      
      #product #content {
        max-width: 610px;
      }

      
      
      #product-slider-items:before {
        content: '';
        border-top: 1px dashed #c6c6c6;
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        top: 93px;
        z-index: 0;
      }
      

      
{*
      #product-slider-items span.flex:after {
        width: 45px;
        height: 45px;
        content: '';
        display: block;
        background-color: rgba(131, 181, 139, 0.3);
        border-radius: 100%;
        top: 0;
        position: absolute;
        right: 0;
        z-index: 0;
      }
*}

      

    
      
      #manufacturer_block .product-manufacturer-img img {
        max-width: 165px;
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
      
      
      
      
      .product-discounts {
        margin-bottom: 0.5rem;
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
      
      .tabs {
        padding-top: 4rem;
      }
      
      .tabs .nav-tabs .nav-link.color-pro,
      .color-pro {
        color : #60ada7 !important;
      }
      
      .nav-tabs .nav-item+.nav-item {
        margin-left: 0 !important;
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
        text-decoration: none;
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
        padding: 1.5rem;
      }
      

      .sticky-tabs-nav {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        max-height: 80vh;
        overflow-y: auto;
      }

      /* Principes actifs */
      .principes-list {
        list-style: none !important;
      }

      .principe-item {
        gap: .5rem;
      }
      
      
      .yotpo-sr-bottom-line-text {
        font-size: .75rem !important;
        font-weight: 600 !important;
      }
      
      .yotpo-sr-bottom-line-summary.yotpo-sr-bottom-line-button {
        align-items: center !important;
      }
      
      .yotpo-reviews-star-ratings-widget .star-container {
        width: 12px;
        height: 12px;
      }
      
      .yotpo-empty-state svg {
        margin: 0 auto !important;
      }
      
      .yotpo-review-rating-title {
        align-items: center !important;
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
              <span><a href="#manufacturer_block" title="En savoir plus sur {$product.manufacturer_name}" class="color-text no-underline hover:underline">{$product.manufacturer_name}</a></span>
            </div>
            
            {block name='page_header'}
              <h1 class="h1 mb-0">{block name='page_title'}{$productName nofilter}{/block}</h1>
            {/block}
            
            
            <div class="yotpo bottomLine review-score text-left text-xs" data-yotpo-product-id="{$product.id_product}"></div>
    
             
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
                      <section class="product-pack mt-2 mb-2">
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
                      {if $product.quantity > 0}<span id="product-instock" class="text-green-600"><i class="bi bi-circle-fill"></i> {l s='In stock' d='Shop.Theme.Catalog'}</span>{/if}
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
                    

                  {if isset($product.dlu)}
                  <div id="dlu"{if $product.dlu_checkbox} class="badge-dlu"{/if}>
                      <div class="flex items-center flex-wrap gap-1">
                          <small>Date limite conseillée&nbsp;:</small>
                          <strong>{$product.dlu|date_format:"%d-%m-%Y"}</strong>
                      </div>
                  </div>
                  {/if}


                    
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

              <div class="tabs clear row pt-16 mt-0">
                
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
                         aria-controls="mode-emploi">{l s='Instructions for use' d='Shop.Theme.Catalog'}</a>
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
                      {if !$product.description} aria-selected="true"{/if}>{l s='Technical specifications' d='Shop.Theme.Catalog'}</a>
                  </li>
                  
                  
                  
                  {if ($labels && count($labels) > 0) || ($analyses && count($analyses) > 0)}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#labels-analyses"
                        role="tab"
                        aria-controls="labels-analyses">{l s='Labels and analyses' d='Shop.Theme.Actions'}</a>
                    </li>
                  {/if}
                  {if $attestations && count($attestations) > 0}
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#attachments"
                        role="tab"
                        aria-controls="attachments">{l s='Sales attestation' d='Shop.Theme.Catalog'}</a>
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
                
                <!-- Accordéon mobile pour les onglets -->
                <div class="mobile-accordion">
                  <ul class="accordion-list">
                    {* Groupes Thérapeute BE (ID 4) et Thérapeute FR (ID 5) *}
                    {if $product.thera_sup && isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5)}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2><i class="bi bi-unlock-fill"></i> {l s='Informations pour les professionnels' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="thera_sup"></div>
                      </li>
                    {/if}
                    
                    {if $product.description}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Description' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="description"></div>
                      </li>
                    {/if}
                    
                    {if isset($product.mode_emploi) && $product.mode_emploi}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Instructions for use' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="mode-emploi"></div>
                      </li>
                    {/if}
                    
                    {if isset($product.ingredients) && $product.ingredients}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Composition' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="composition"></div>
                      </li>
                    {/if}
                    
                    <li class="accordion-item">
                      <div class="accordion-header">
                        <h2>{l s='Technical specifications' d='Shop.Theme.Catalog'}</h2>
                        <span class="accordion-icon">+</span>
                      </div>
                      <div class="accordion-content" data-target="product-details"></div>
                    </li>
                    
                    {if $attestations && count($attestations) > 0}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Sales attestation' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="attachments"></div>
                      </li>
                    {/if}
                    
                    {if ($labels && count($labels) > 0) || ($analyses && count($analyses) > 0) || ($analysesBio && count($analysesBio) > 0) || ($analysesHalal && count($analysesHalal) > 0) || ($analysesKosher && count($analysesKosher) > 0) || ($analysesGMP && count($analysesGMP) > 0) || (isset($product.attachments) && $product.attachments)}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Labels and analyses' d='Shop.Theme.Actions'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="labels-analyses"></div>
                      </li>
                    {/if}
                    
                    {foreach from=$product.extraContent item=extra key=extraKey}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{$extra.title}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="extra-{$extraKey}"></div>
                      </li>
                    {/foreach}
                    
                    {if $product_manufacturer->id == 5}
                      <li class="accordion-item">
                        <div class="accordion-header">
                          <h2>{l s='Comparer et bien choisir' d='Shop.Theme.Catalog'}</h2>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content" data-target="comparer"></div>
                      </li>
                    {/if}
                  </ul>
                </div>
                
                <div class="tab-content col-md-8 col-sm-12" id="tab-content">
                 
                {* Groupes Thérapeute BE (ID 4) et Thérapeute FR (ID 5) *}
                {if $product.thera_sup && isset($customer) && $customer.is_logged && ($customer.id_default_group == 4 || $customer.id_default_group == 5)}
                 <div class="tab-pane fade in active js-product-tab-active" id="thera_sup" role="tabpanel">

                     <p class="h4 color-pro"><i class="bi bi-unlock-fill"></i> {l s='Informations pour les professionnels' d='Shop.Theme.Catalog'}</p>
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
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Ingredients' d='Shop.Theme.Catalog'}</h2>
                        {$product.ingredients nofilter}
                      {/if}

                      {* Principes actifs (cat id = 25) - Utilisation de notre méthode enrichie *}
                      {$product_cats = Product::getProductCategories($product.id_product)}
                      {$principes_actifs = []}
                      
                      {* Récupérer les sous-catégories avec toutes leurs données *}
                      {foreach from=CategoryController::getChildrenCategory(25, $language.id, true, $shop.id) item=pa}
                        {if in_array($pa.id_category, $product_cats)}
                          {$principes_actifs[] = $pa}
                        {/if}
                      {/foreach}
                      
                      {* Affichage si principes actifs sur le produit *}
                      {if !empty($principes_actifs)}
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-10 mt-8">
                          {foreach from=$principes_actifs item=pa}
                            <div class="border-t border-gray-200 pt-4 flex items-start gap-4">
                              {if isset($pa.image.small) && $pa.image.small}
                                <img src="{$pa.image.small}" alt="{$pa.name}" class="w-24 h-24 object-contain" />
                              {/if}
                      
                              <div>
                                <dt class="font-medium text-gray-900">
                                  <a href="{$link->getCategoryLink($pa.id_category, $pa.link_rewrite)}" class="no-underline text-gray-800 color-title hover:text-blue-600" title="Voir tous nos produits {$pa.name}">{$pa.name}</a>
                                </dt>
                                {if isset($pa.additional_description) && $pa.additional_description}
                                  <dd class="mt-1.5 mb-1.5 text-sm text-gray-500">
                                    {$pa.additional_description|strip_tags}
                                  </dd>
                                {elseif isset($pa.description) && $pa.description}
                                  <dd class="mt-1.5 mb-1.5 text-sm text-gray-500">
                                    {$pa.description|strip_tags|truncate:300:'...'}
                                  </dd>
                                {/if}
                                <p class="text-xs lowercase">» <a href="{$link->getCategoryLink($pa.id_category, $pa.link_rewrite)}" title="Voir tous nos produits {$pa.name}" class="underline">{l s='See all products' d='Shop.Theme.Catalog'} {$pa.name}</a></p>
                              </div>
                            </div>
                          {/foreach}
                        </dl>
                      {/if}

                      
                      
                      {if isset($product.tab_nutri) && $product.tab_nutri}
                        <hr />
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Nutritional table' d='Shop.Theme.Catalog'}</h2>
                        {$product.tab_nutri nofilter}
                      {/if}
                      
                      
                    </div>
                 {/if}
                      

                 
                 {if (isset($product.mode_emploi) && $product.mode_emploi) || (isset($product.contre_indications) && $product.contre_indications)}
                  <div class="tab-pane fade in" id="mode-emploi" role="tabpanel">                    
                      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Directions for use' d='Shop.Theme.Catalog'}</h2>
                      {$product.mode_emploi nofilter}
                      
                      <hr />
                                                         
                      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Contraindications' d='Shop.Theme.Catalog'}</h2>
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
                   {if $attestations && count($attestations) > 0}
                    <div class="tab-pane fade in" id="attachments" role="tabpanel">
                       <section class="product-attachments">
                         <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Sales attestation' d='Shop.Theme.Actions'}</h2>
                          
                          {* Attestations de vente *}
                         {assign var="attestationsFr" value=[]}
                         {assign var="attestationsBe" value=[]}
                         
                         {* Séparation des attestations par pays *}
                         {foreach from=$attestations item=attestationUrl}
                           {if strpos($attestationUrl, 'Fr') !== false}
                             {assign var="attestationsFr" value=$attestationsFr|array_merge:[$attestationUrl]}
                           {elseif strpos($attestationUrl, 'Be') !== false}
                             {assign var="attestationsBe" value=$attestationsBe|array_merge:[$attestationUrl]}
                           {/if}
                         {/foreach}
                          
                          {if ($attestationsFr && count($attestationsFr) > 0) || ($attestationsBe && count($attestationsBe) > 0)}
                          <div class="pt-4 sm:grid sm:gap-4 sm:px-0">
                           <dd class="text-sm text-gray-900 sm:mt-0 max-w-lg">
                            <div class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                {foreach from=$attestationsFr item=attestationUrl}
                                <div class="flex items-center justify-between p-4">
                                  <div class="flex items-center space-x-3">
                                    <i class="bi bi-link-45deg leading-0"></i>
                                    <div>
                                      <p class="text-sm font-medium text-gray-700 mb-0">🇫🇷 {l s='Sales attestation France' d='Shop.Theme.Actions'} <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                    </div>
                                  </div>
                                  <a href="{$attestationUrl}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Download</a>
                                </div>
                                {/foreach}
                                {foreach from=$attestationsBe item=attestationUrl}
                                <div class="flex items-center justify-between p-4">
                                  <div class="flex items-center space-x-3">
                                    <i class="bi bi-link-45deg leading-0"></i>
                                    <div>
                                      <p class="text-sm font-medium text-gray-700 mb-0">🇧🇪 {l s='Sales attestation Belgium' d='Shop.Theme.Actions'} <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                    </div>
                                  </div>
                                  <a href="{$attestationUrl}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Download</a>
                                </div>
                                {/foreach}
                              </div>
                            </dd>
                          </div>
                          {/if}                         
                       </section>
                     </div>
                   {/if}
                 {/block}

                 {block name='product_labels_analyses'}
                   {if ($labels && count($labels) > 0) || ($analyses && count($analyses) > 0) || ($analysesBio && count($analysesBio) > 0) || ($analysesHalal && count($analysesHalal) > 0) || ($analysesKosher && count($analysesKosher) > 0) || ($analysesGMP && count($analysesGMP) > 0) || (isset($product.attachments) && $product.attachments)}
                    <div class="tab-pane fade in" id="labels-analyses" role="tabpanel">
                       <section class="product-labels-analyses">
                         <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">{l s='Labels and analyses' d='Shop.Theme.Actions'}</h2>                         
                         {if $labels && count($labels) > 0}
                         <div class="pt-4 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-0">
                           <dt class="text-sm/6 font-medium text-gray-900">{l s='Labels' d='Shop.Theme.Actions'}</dt>
                           <dd class="text-sm text-gray-900 sm:col-span-3 sm:mt-0 max-w-lg">
                            <div class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                {foreach from=$labels item=label name=labels}
                                <div class="flex items-center justify-between p-4">
                                  <div class="flex items-center space-x-3">
                                    <i class="bi bi-link-45deg leading-0"></i>
                                    <div>
                                      {if $label|strpos:"_box" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download box" d='Shop.Theme.Actions'} <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                      {elseif $label|strpos:"_notice" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download notice" d='Shop.Theme.Actions'} <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                      {else}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download label" d='Shop.Theme.Actions'} <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                      {/if}
                                      <!-- <span class="text-xs text-gray-500">2.4 MB</span> -->
                                    </div>
                                  </div>
                                  <a href="{$label|escape:'html':'UTF-8'}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Download</a>
                                </div>
                                {/foreach}
                              </div>
                            </dd>
                          </div>
                          {/if}

                         {if (isset($product.attachments) && $product.attachments) || (isset($analyses) && $analyses)}
                         <div class="pt-4 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-0">
                           <dt class="text-sm/6 font-medium text-gray-900">{l s='Analysis' d='Shop.Theme.Actions'}</dt>

                           <dd class="text-sm text-gray-900 sm:col-span-3 sm:mt-0 max-w-lg">
                            <div class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                {foreach from=$analyses item=analyse name=analyses}
                                <div class="flex items-center justify-between p-4">
                                  <div class="flex items-center space-x-3">
                                    <i class="bi bi-link-45deg leading-0"></i>
                                    <div>
                                      {if $analyse|strpos:"-analyse" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>{if $analyse|strpos:"-2023" !== false}2023{elseif $analyse|strpos:"-2024" !== false}2024{elseif $analyse|strpos:"-2025" !== false}2025{/if}</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                      
                                      {elseif $analyse|strpos:"-bio" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>bio</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                        
                                      {elseif $analyse|strpos:"-agricert" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>bioagricert</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                        
                                      {elseif $analyse|strpos:"-Halal" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>halal</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                        
                                      {elseif $analyse|strpos:"-Kosher" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>kosher</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                      
                                      {elseif $analyse|strpos:"-GMP" !== false}
                                        <p class="text-sm font-medium text-gray-700 mb-0">{l s="Download analysis" d='Shop.Theme.Actions'} <strong>GMP</strong> <span class="text-xs text-gray-500 font-normal">{$product.name|regex_replace:'/\s*\([^)]*\)/':''}</span></p>
                                        
                                      {else}
                                      
                                      {$analyse}
                                      
                                      
                                      {/if}
                                      
                                    </div>
                                  </div>
                                  <a href="{$label|escape:'html':'UTF-8'}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Download</a>
                                </div>
                                {/foreach}
                                
                                {* Attachments depuis le BACKOFFICE *}
                               {foreach from=$product.attachments item=attachment name=attachements}
                                 <div class="flex items-center justify-between p-4">
                                  <div class="flex items-center space-x-3">
                                    <i class="bi bi-link-45deg leading-0"></i>
                                    <div>
                                       <p class="text-sm font-medium text-gray-700 mb-0">
                                         {if $attachment.description}
                                           {l s="Download" d='Shop.Theme.Actions'} {$attachment.description|escape:'html':'UTF-8'}
                                         {else}
                                           {l s="Download" d='Shop.Theme.Actions'} {$attachment.name|escape:'html':'UTF-8'}
                                         {/if}
                                       </p>
                                    </div>
                                  </div>
                                  <a href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Download</a>
                                 </div>
                               {/foreach}
                              </div>
                            </dd>
                          </div>
                          {/if}
                          
                                                 
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
      <div id="manufacturer_block" class="my-20 flex flex-col md:flex-row brand-{$product_manufacturer->id}" itemprop="brand" itemscope itemtype="https://schema.org/Brand">
        <div class="block product-manufacturer-infos flex flex-col lg:flex-row items-center lg:gap-12 gap-4 rounded-xl py-4 lg:py-8 px-8 lg:px-12  border border-gray-200">
        {if isset($manufacturer_image_url)}
          <a href="{$product_brand_url}" class="product-manufacturer-img" title="{$product_manufacturer->name}">
            <figure class="m-0">
              <img src="{$manufacturer_image_url}" class="img img-fluid manufacturer-logo" alt="{$product_manufacturer->name}" loading="lazy">
              <meta itemprop="logo" content="{$manufacturer_image_url}" />
            </figure>
          </a>
        {/if}
          <div class="product-manufacturer-name text-sm space-y-2">
            <h4 class="text-xl font-bold mt-0" itemprop="name"><a href="{$product_brand_url}" title="{$product_manufacturer->name}">{$product_manufacturer->name}</a></h4>
            {$product_manufacturer->short_description nofilter}
            <p class="seemore text-sm">» <a href="{$product_brand_url}" title="{$product_manufacturer->name}" class="link-blue">{l s='See all products' d='Shop.Theme.Catalog'} {$product_manufacturer->name}</a></p>
          </div>
        </div>
          
        {if $product_manufacturer->id == 5}
          <div class="block product-manufacturer-imgplus rounded-xl border border-gray-200 p-0 sm:ml-0 lg:ml-8 w-full overflow-hidden">
            <img src="{$urls.child_img_url}brands/brand-olivie.jpg" class="w-full h-full object-cover" />
          </div>
        {elseif $product_manufacturer->id == 4}
          <div class="block product-manufacturer-imgplus rounded-xl border border-gray-200 p-0 sm:ml-0 lg:ml-8 w-full overflow-hidden">
            <img src="{$urls.child_img_url}brands/brand-naturamedicatrix.jpg" class="w-full h-full object-cover" />
          </div>
        {elseif $product_manufacturer->id == 3}
          <div class="block product-manufacturer-imgplus rounded-xl border border-gray-200 p-0 sm:ml-0 lg:ml-8 w-full overflow-hidden">
            <img src="{$urls.child_img_url}brands/brand-jacob.jpg" class="w-full h-full object-cover" />
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
    
    
    
    
    {block name='therap'}
      {include file='../_partials/therap.tpl'}
    {/block}
    

    <div class="yotpo yotpo-main-widget"
         data-product-id="{$product.id_product}"
         data-price="{$product.regular_price}"
         data-currency="EUR"
         data-name="{$product.name}"
         data-url="{$product.url}"
         data-image-url="{$product.default_image.bySize.medium_default.url}">
    </div>

    
    
    {* SHOPIMIND INTERETS PRODUCTS *}
    <div id="shopimind-interets-products"></div>

    {block name='product_footer'}
      {hook h='displayFooterProduct' product=$product category=$category}
    {/block}

    {block name='product_images_modal'}
      {include file='catalog/_partials/product-images-modal.tpl'}
    {/block}
    


    {* FONDATION JACOBS & CHARTES NATURAMEDICATRIX *}
    {block name='fondation-jacobs'}
      {if isset($product_manufacturer) && $product_manufacturer->id == 3}
        {include file='../_partials/fondation-jacobs.tpl'}
      {/if}
    {/block}
    
    {block name='charte-qualite'}
      {if isset($product_manufacturer) && $product_manufacturer->id == 4}
        {include file='../_partials/charte-qualite.tpl'}
      {/if}
    {/block}
    
    
    {block name='page_footer_container'}
      <footer class="page-footer">
        {block name='page_footer'}
          <!-- Footer content -->
        {/block}
      </footer>
    {/block}
  </section>
  



{assign var='productPopupQuantity' value=Product::getQuantity({$product->product_popup_redirection})}
{if isset($product->product_popup_redirection) && $product->product_popup_redirection && isset($productPopupQuantity) && $productPopupQuantity > 0 && isset($product->quantity) && $product->quantity == 0}
  {include file="catalog/_partials/product-popup-redirection.tpl"}
{/if}

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    // Initialise l'accordéon mobile
    initMobileAccordion();
  });

  function initMobileAccordion() {
    // Sélectionne tous les éléments d'accordéon
    const accordionItems = document.querySelectorAll('.accordion-item');
    
    // Pour chaque élément d'accordéon
    accordionItems.forEach(function(item) {
      const header = item.querySelector('.accordion-header');
      const content = item.querySelector('.accordion-content');
      const targetId = content.getAttribute('data-target');
      const tabContent = document.getElementById(targetId);
      
      // Prépare le style initial
      content.style.overflow = 'hidden';
      content.style.transition = 'max-height 0.4s ease-in-out, padding 0.3s ease-in-out';
      content.style.maxHeight = '0';
      content.style.padding = '0';
      content.style.opacity = '0';
      content.style.transition = 'all 0.4s ease-in-out';
      
      // Si on trouve le contenu correspondant dans les onglets
      if (tabContent && tabContent.innerHTML) {
        // Copie le contenu de l'onglet dans l'accordéon
        content.innerHTML = tabContent.innerHTML;
        
        // Ajoute une div wrapper pour l'espacement
        const wrapper = document.createElement('div');
        wrapper.className = 'accordion-content-wrapper';
        wrapper.style.padding = '0rem 0.5rem';
        
        // Déplace le contenu dans le wrapper
        const contentHtml = content.innerHTML;
        content.innerHTML = '';
        wrapper.innerHTML = contentHtml;
        content.appendChild(wrapper);
      } else {
        console.log('Aucun contenu trouvé pour', targetId);
      }
      
      // Ajoute un écouteur d'événement pour le clic sur l'en-tête
      header.addEventListener('click', function() {
        // Vérifie si cet élément est actuellement actif
        const isActive = item.classList.contains('active');
        
        // Ferme tous les éléments ouverts avec animation
        accordionItems.forEach(function(otherItem) {
          if (otherItem !== item && otherItem.classList.contains('active')) {
            const otherContent = otherItem.querySelector('.accordion-content');
            otherItem.classList.remove('active');
            otherContent.style.maxHeight = '0';
            otherContent.style.opacity = '0';
          }
        });
        
        // Basculer l'état actif de l'élément cliqué
        if (isActive) {
          // Ferme le contenu actif
          item.classList.remove('active');
          content.style.maxHeight = '0';
          content.style.opacity = '0';
        } else {
          // Ouvre le contenu
          item.classList.add('active');
          // Calcul la hauteur nécessaire pour le contenu
          content.style.maxHeight = content.scrollHeight + 'px';
          content.style.opacity = '1';
          
          // Recalcul la hauteur après un court délai pour s'assurer que tout est rendu
          setTimeout(function() {
            content.style.maxHeight = content.scrollHeight + 'px';
          }, 50);
        }
      });
    });
  }
</script>

{/block}
