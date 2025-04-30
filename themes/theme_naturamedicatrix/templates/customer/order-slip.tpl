{**
* CUSTOM PAGE CREDIT SLIPS
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mes avoirs' d='Shop.Theme.Customeraccount'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block}

{block name='page_content'}
  <h6>{l s='Avoirs reçus suite à des commandes annulées.' d='Shop.Theme.Customeraccount'}</h6>

  {if $credit_slips}
    <table class="table table-striped table-bordered hidden-sm-down">
      <thead class="thead-default">
        <tr>
          <th>{l s='Commande' d='Shop.Theme.Customeraccount'}</th>
          <th>{l s='Avoir' d='Shop.Theme.Customeraccount'}</th>
          <th>{l s='Date d\'émission' d='Shop.Theme.Customeraccount'}</th>
          <th>{l s='Voir l\'avoir' d='Shop.Theme.Customeraccount'}</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$credit_slips item=slip}
          <tr>
            <td><a href="{$slip.order_url_details}" data-link-action="view-order-details">{$slip.order_reference}</a></td>
            <td scope="row">{$slip.credit_slip_number}</td>
            <td>{$slip.credit_slip_date}</td>
            <td class="text-sm-center">
              <a href="{$slip.url}"><i class="bi bi-file-earmark-text"></i></a>
            </td>
          </tr>
        {/foreach}
      </tbody>
    </table>
    <div class="credit-slips hidden-md-up">
      {foreach from=$credit_slips item=slip}
        <div class="credit-slip">
          <ul>
            <li>
              <strong>{l s='Commande' d='Shop.Theme.Customeraccount'}</strong>
              <a href="{$slip.order_url_details}" data-link-action="view-order-details">{$slip.order_reference}</a>
            </li>
            <li>
              <strong>{l s='Avoir' d='Shop.Theme.Customeraccount'}</strong>
              {$slip.credit_slip_number}
            </li>
            <li>
              <strong>{l s='Date d\'émission' d='Shop.Theme.Customeraccount'}</strong>
              {$slip.credit_slip_date}
            </li>
            <li>
              <a href="{$slip.url}">{l s='Voir l\'avoir' d='Shop.Theme.Customeraccount'}</a>
            </li>
          </ul>
        </div>
      {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">{l s='Vous n\'avez reçu aucun avoir.' d='Shop.Notifications.Warning'}</div>
  {/if}
{/block}
