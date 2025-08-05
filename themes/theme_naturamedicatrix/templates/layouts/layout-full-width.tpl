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
{extends file='layouts/layout-both-columns.tpl'}

{* Détection mobile/desktop *}
{assign var="isMobile" value=false}
{if isset($smarty.server.HTTP_USER_AGENT) && (strpos($smarty.server.HTTP_USER_AGENT, 'Mobile') !== false || strpos($smarty.server.HTTP_USER_AGENT, 'Android') !== false || strpos($smarty.server.HTTP_USER_AGENT, 'iPhone') !== false)}
  {assign var="isMobile" value=true}
{/if}

{* Déterminer si cette page a besoin de la sidebar sur mobile *}
{assign var="needsSidebarOnMobile" value=false}
{if $page.page_name == 'my-account' || $page.page_name == 'identity' || $page.page_name == 'address' || $page.page_name == 'addresses' || $page.page_name == 'history' || $page.page_name == 'order-detail' || $page.page_name == 'order-return' || $page.page_name == 'order-slip' || $page.page_name == 'discount' || $page.page_name == 'guest-tracking' || $page.page_name == 'module-psgdpr-gdpr' || $page.page_name == 'module-blockwishlist-lists' || $page.page_name == 'module-ps_emailalerts-account'}
  {assign var="needsSidebarOnMobile" value=true}
{/if}

{block name='left_column'}{/block}
{block name='right_column'}{/block}

{block name='content_wrapper'}
  <div id="content-wrapper" class="js-content-wrapper {if $isMobile && !$needsSidebarOnMobile}col-xs-12{elseif $page.page_name == 'module-psgdpr-gdpr' || $page.page_name == 'module-blockwishlist-lists' || $page.page_name == 'order-detail' || $page.page_name == 'module-ps_emailalerts-account'}col-xs-12 col-md-8 col-lg-8{else}col-xs-12{/if}">
    
    {hook h="displayContentWrapperTop"}
    {block name='content'}
      <p>Hello world! This is HTML5 Boilerplate.</p>
    {/block}
    {hook h="displayContentWrapperBottom"}
  </div>
{/block}
