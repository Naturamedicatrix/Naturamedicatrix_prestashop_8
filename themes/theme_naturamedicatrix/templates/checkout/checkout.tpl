{**
* PAGE CHECKOUT CUSTOM
* Intègre le header et le footer
*}
{extends file=$layout}

{block name='header'}
  {include file='checkout/_partials/header.tpl'}
{/block}

{block name='content'}
  <section id="content">
    <div class="row">
      <div class="cart-grid-body section-step-checkout col-xs-12 col-xl-7">
        
        {* CUSTOM STEP *}
        {* {block name='steps'}
          {include file='checkout/_partials/steps.tpl'}
        {/block} *}
        
        
        {block name='checkout_process'}
          {render file='checkout/checkout-process.tpl' ui=$checkout_process}
        {/block}
      </div>
      <div class="cart-grid-right col-xs-12 col-xl-5">
        <h3>Récapitulatif</h3>
        {block name='cart_summary'}
          {include file='checkout/_partials/cart-summary.tpl' cart=$cart}
        {/block}
        
        {hook h='displayReassurance'}
      </div>
    </div>
  </section>
{/block}

{block name='footer'}
  {include file='checkout/_partials/footer.tpl'}
{/block}