{**
* CUSTOM PAGE CREDIT SLIPS
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{* {block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mes avoirs' d='Shop.Theme.Customeraccount'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block} *}

{block name='page_content'}
  <h1>{l s='Mes avoirs' d='Shop.Theme.Customeraccount'}</h1>
  
  {if $credit_slips}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
    {foreach from=$credit_slips item=slip}
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden text-left flex flex-col items-center justify-between space-y-4">
        <article id="credit-slip-{$slip.credit_slip_number}" class="w-full h-full flex flex-col justify-between min-h-[280px]" data-slip="{$slip.credit_slip_number}">
          <div>
            <div class="credit-slip-header bg-gray-50 w-full mt-0 mb-2 py-5 px-6 flex justify-between items-center flex-wrap gap-2">
              <h4 class="m-0 p-0 font-bold text-lg">{$slip.order_reference}</h4>
              <div class="text-green-600 font-semibold">
                {if $slip.total_products_tax_incl > 0}
                  {Tools::displayPrice($slip.total_products_tax_incl + $slip.total_shipping_tax_incl)}
                {elseif $slip.amount > 0}
                  {Tools::displayPrice($slip.amount)}
                {else}
                  <a href="{$slip.url}" class="text-green-600 hover:text-green-700">
                    <i class="bi bi-file-earmark-text text-xl"></i>
                  </a>
                {/if}
              </div>
            </div>
            <div class="credit-slip-body px-6 mb-2 space-y-3">
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <strong class="text-gray-700">{l s='Order' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900">
                    <a href="{$slip.order_url_details}" data-link-action="view-order-details" class="text-blue-600 hover:text-blue-700 underline">{$slip.order_reference}</a>
                  </div>
                </div>
                <div>
                  <strong class="text-gray-700">{l s='Refund amount' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900 font-semibold">
                    {if $slip.total_products_tax_incl > 0}
                      {Tools::displayPrice($slip.total_products_tax_incl + $slip.total_shipping_tax_incl)}
                    {elseif $slip.amount > 0}
                      {Tools::displayPrice($slip.amount)}
                    {else}
                      -
                    {/if}
                  </div>
                </div>
              </div>
              
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <strong class="text-gray-700">{l s='Credit slip number' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900 font-mono font-bold">{$slip.credit_slip_number}</div>
                </div>
                <div>
                  <strong class="text-gray-700">{l s='Issue date' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900">{$slip.credit_slip_date}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="credit-slip-footer px-6 mt-auto pb-4">
            <div class="text-xs text-gray-500 italic">
              <a href="{$slip.url}" class="text-blue-600 hover:text-blue-700 underline inline-flex items-center space-x-1">
                <i class="bi bi-file-earmark-text"></i>
                <span>{l s='Download credit slip PDF' d='Shop.Theme.Checkout'}</span>
              </a>
            </div>
          </div>
        </article>
      </div>
    {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">
      {l s='No credit slip available.' d='Shop.Notifications.Success'}
    </div>
  {/if}
  <div class="clearfix"></div>
  
{/block}
