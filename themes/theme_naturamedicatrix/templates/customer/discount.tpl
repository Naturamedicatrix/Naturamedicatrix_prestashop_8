{**
* CUSTOM PAGE MES BONS D'ACHAT (Mon compte)
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}


{block name='page_content'}
  <h1>{l s='Mes bons d\'achat' d='Shop.Theme.Customeraccount'}</h1>
  
  {if $cart_rules}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
    {foreach from=$cart_rules item=cart_rule}
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden text-left flex flex-col items-center justify-between space-y-4">
        <article id="discount-{$cart_rule.code}" class="w-full h-full flex flex-col justify-between min-h-[280px]" data-code="{$cart_rule.code}">
          <div>
            <div class="discount-header bg-gray-50 w-full mt-0 mb-2 py-5 px-6 relative">
              <h4 class="m-0 p-0 font-bold text-lg">{$cart_rule.name}</h4>
              <div class="absolute right-5 top-5 text-green-600 font-semibold">
                {$cart_rule.value}
              </div>
            </div>
            <div class="discount-body px-6 mb-2 space-y-3">
              <div class="mb-8">
                <strong class="text-gray-700">{l s='Description' d='Shop.Theme.Checkout'}:</strong>
                <div class="text-gray-900 text-sm">{$cart_rule.description}</div>
              </div>
              
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <strong class="text-gray-700">{l s='Code' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900 font-mono font-bold">{$cart_rule.code}</div>
                </div>
                <div>
                  <strong class="text-gray-700">{l s='Minimum amount' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900">{$cart_rule.voucher_minimal}</div>
                </div>
              </div>
              
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <strong class="text-gray-700">{l s='Cumulative' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900">{$cart_rule.voucher_cumulable}</div>
                </div>
                <div>
                  <strong class="text-gray-700">{l s='Expires on' d='Shop.Theme.Checkout'}:</strong>
                  <div class="text-gray-900">{$cart_rule.voucher_date}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="discount-footer px-6 mt-auto pb-4">
            <div class="text-xs text-gray-500 italic">
              {l s='Code to use at checkout' d='Shop.Theme.Checkout'}
            </div>
          </div>
        </article>
      </div>
    {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">
      {l s='No discount available.' d='Shop.Notifications.Success'}
    </div>
  {/if}
  <div class="clearfix"></div>
  
{/block}
