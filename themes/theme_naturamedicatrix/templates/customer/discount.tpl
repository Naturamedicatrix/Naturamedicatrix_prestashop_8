{**
 * Page de réduction personnalisée avec la colonne de gauche
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
    <table class="table table-striped table-bordered hidden-sm-down">
      <thead class="thead-default">
        <tr>
          <th>{l s='Code' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Description' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Quantité' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Valeur' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Minimum' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Cumulable' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Date d\'expiration' d='Shop.Theme.Checkout'}</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$cart_rules item=cart_rule}
          <tr>
            <th scope="row">{$cart_rule.code}</th>
            <td>{$cart_rule.name}</td>
            <td class="text-xs-right">{$cart_rule.quantity_for_user}</td>
            <td>{$cart_rule.value}</td>
            <td>{$cart_rule.voucher_minimal}</td>
            <td>{$cart_rule.voucher_cumulable}</td>
            <td>{$cart_rule.voucher_date}</td>
          </tr>
        {/foreach}
      </tbody>
    </table>
    <div class="cart-rules hidden-md-up">
      {foreach from=$cart_rules item=cart_rule}
        <div class="cart-rule">
          <ul>
            <li>
              <strong>{l s='Code' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.code}
            </li>
            <li>
              <strong>{l s='Description' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.name}
            </li>
            <li>
              <strong>{l s='Quantité' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.quantity_for_user}
            </li>
            <li>
              <strong>{l s='Valeur' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.value}
            </li>
            <li>
              <strong>{l s='Minimum' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.voucher_minimal}
            </li>
            <li>
              <strong>{l s='Cumulable' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.voucher_cumulable}
            </li>
            <li>
              <strong>{l s='Date d\'expiration' d='Shop.Theme.Checkout'}</strong>
              {$cart_rule.voucher_date}
            </li>
          </ul>
        </div>
      {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">{l s='Vous n\'avez pas de bons d\'achat.' d='Shop.Notifications.Warning'}</div>
  {/if}
{/block}
