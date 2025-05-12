{**
* CUSTOM FOOTER PAGE CHECKOUT
*}
<div class="modal fade js-checkout-modal" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="{l s='Close' d='Shop.Theme.Global'}">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="js-modal-content"></div>
    </div>
  </div>
</div>

<div class="checkout-footer">
  {include file='_partials/block_besoin_aide.tpl'}
  
  <div class="copyright text-center mt-8">
    {block name='copyright_link'}
      {l s='%copyright% 2009 - %year% NATURA%italictext%. %rights%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©', '%italictext%' => '<i><strong>Medicatrix</strong></i>', '%rights%' => 'Tous droits réservés.'] d='Shop.Theme.Global'}
    {/block}
  </div>
</div>
