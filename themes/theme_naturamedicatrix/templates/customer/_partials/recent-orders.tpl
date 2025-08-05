{if $customer.is_logged}

  {assign var="orders" value=Order::getCustomerOrders($customer.id)}

  {if isset($orders) && count($orders) > 0}
    <div class="mx-auto mt-24">
      <p class="text-center text-gray-600 text-lg">{l s='Your last orders' d='Shop.Theme.Checkout'}&nbsp;:</p>
      
      <div class="flex flex-nowrap justify-center gap-6">
        {foreach from=$orders item=order name=orderLoop}
          {if $smarty.foreach.orderLoop.index < 3}
            
          
            <div class="border border-gray-200 rounded-xl flex flex-col items-center text-center bg-white shadow-sm overflow-hidden w-full">                            
              <div class="bg-gray-50 w-full p-1">
                <p class="text-sm mb-0"><a href="{$link->getPageLink('order-detail', true, null, 'id_order='|cat:$order.id_order)}" class="text-gray-600 hover:underline transition">{l s='Order' d='Shop.Theme.Checkout'} {$order.reference}</a></p>
              </div>
              
              <div class="p-6 pb-10">
                <p class="text-base font-semibold text-gray-800 mb-1">{$order.order_state}</h3>

                <p><i class="bi bi-receipt text-5xl text-gray-400 mb-2"></i></p>
                
                <p class="text-sm text-gray-600 mb-1">{l s='Past on' d='Shop.Theme.Checkout'} {$order.date_add|date_format:"%d/%m/%Y"}</p>
                <p class="text-sm text-gray-600 mb-2">{l s='Total' d='Shop.Theme.Checkout'}&nbsp;: {$order.total_paid|number_format:2:',':'.'} €</p>
 
                <a href="{$link->getPageLink('order', true)}?submitReorder=1&id_order={$order.id_order}" class="bg-gray-900 hover:bg-gray-700 text-white font-bold text-base px-10 py-2.5 w-full rounded-md transition">
                  {l s='Reorder' d='Shop.Theme.Checkout'}
                </a>
                
              </div>
            </div>
          {/if}
        {/foreach}
      </div>
    </div>
  {else}
    <p class="text-center text-gray-600 text-lg mt-6">{l s='You haven\'t placed any orders yet.' d='Shop.Theme.Checkout'}</p>
    <div class="text-center mt-6">
      <a href="{$urls.pages.index}" class="bg-gray-900 hover:bg-gray-700 text-white text-sm btn btn-primary rounded-full transition">
        {l s='Continue shopping' d='Shop.Theme.Checkout'}
      </a>
    </div>
  {/if}

{else}

  <div class="text-center mt-6">
    <a href="{$link->getPageLink('authentication', true)}" class="bg-gray-900 hover:bg-gray-700 text-white text-sm btn btn-primary rounded-full transition">
      {l s='Log in' d='Shop.Theme.Checkout'}
    </a>
  </div>

{/if}
