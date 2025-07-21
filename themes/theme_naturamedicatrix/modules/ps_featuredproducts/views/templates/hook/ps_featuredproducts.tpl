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
<section class="featured-products clearfix">

  <div class="all-product-link text-center">
    <a href="{$allProductsLink2}">
    » {l s='Tous nos produits' d='Shop.Theme.Catalog'}
    </a>
  </div>

  <h2 class="h2 products-section-title">
    {l s='Nos produits populaires' d='Shop.Theme.Catalog'}
  </h2>

  <div class="title-separator">
    <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
      <path class="logo-title"
        d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
    </svg>
  </div>
  
  <div class="product-filter-buttons text-center mt-4 mb-8">
    <a href="{$allProductsLink}" class="btn btn-light active" data-filter="populaires">Populaires</a>
    <a href="{$urls.pages.prices_drop}" class="btn btn-light" data-filter="promotions">Promotions</a>
    <a href="{$urls.pages.new_products}" class="btn btn-light" data-filter="nouveautes">Nouveautés</a>
  </div>
  {include file="catalog/_partials/productlist.tpl" products=$products cssClass="row" productClass="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
</section>
