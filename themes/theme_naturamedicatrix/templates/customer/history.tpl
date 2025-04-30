{**
* CUSTOM PAGE ORDER HISTORY
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block}

{block name='page_content'}
  <h6>{l s='Voici les commandes que vous avez passées depuis la création de votre compte.' d='Shop.Theme.Customeraccount'}</h6>

  {if $orders}
    <table class="table table-striped table-bordered table-labeled hidden-sm-down">
      <thead class="thead-default">
        <tr>
          <th>{l s='Référence' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Date' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Prix total' d='Shop.Theme.Checkout'}</th>
          <th class="hidden-md-down">{l s='Paiement' d='Shop.Theme.Checkout'}</th>
          <th class="hidden-md-down">{l s='Statut' d='Shop.Theme.Checkout'}</th>
          <th>{l s='Facture' d='Shop.Theme.Checkout'}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$orders item=order}
          <tr>
            <th scope="row">{$order.details.reference}</th>
            <td>{$order.details.order_date}</td>
            <td class="text-xs-right">{$order.totals.total.value}</td>
            <td class="hidden-md-down">{$order.details.payment}</td>
            <td>
              <span
                class="label label-pill {$order.history.current.contrast}"
                style="background-color:{$order.history.current.color}"
              >
                {$order.history.current.ostate_name}
              </span>
            </td>
            <td class="text-sm-center hidden-md-down">
              {if $order.details.invoice_url}
                <a href="{$order.details.invoice_url}"><i class="bi bi-file-earmark-text"></i></a>
              {else}
                -
              {/if}
            </td>
            <td class="text-sm-center order-actions">
              <a class="view-order-details-link" href="{$order.details.details_url}" data-link-action="view-order-details">
                {l s='Détails' d='Shop.Theme.Customeraccount'}
              </a>
              {if $order.details.reorder_url}
                <a class="reorder-link" href="{$order.details.reorder_url}">{l s='Commander à nouveau' d='Shop.Theme.Actions'}</a>
              {/if}
            </td>
          </tr>
        {/foreach}
      </tbody>
    </table>

    <div class="orders hidden-md-up">
      {foreach from=$orders item=order}
        <div class="order">
          <div class="row">
            <div class="col-xs-10">
              <a href="{$order.details.details_url}"><h3>{$order.details.reference}</h3></a>
              <div class="date">{$order.details.order_date}</div>
              <div class="total">{$order.totals.total.value}</div>
              <div class="status">
                <span
                  class="label label-pill {$order.history.current.contrast}"
                  style="background-color:{$order.history.current.color}"
                >
                  {$order.history.current.ostate_name}
                </span>
              </div>
            </div>
            <div class="col-xs-2 text-xs-right">
                <div>
                  <a href="{$order.details.details_url}" data-link-action="view-order-details" title="{l s='Détails' d='Shop.Theme.Customeraccount'}">
                    <i class="bi bi-search"></i>
                  </a>
                </div>
                {if $order.details.reorder_url}
                  <div>
                    <a href="{$order.details.reorder_url}" title="{l s='Commander à nouveau' d='Shop.Theme.Actions'}">
                      <i class="bi bi-arrow-repeat"></i>
                    </a>
                  </div>
                {/if}
            </div>
          </div>
        </div>
      {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">{l s='Vous n\'avez pas encore passé de commande.' d='Shop.Notifications.Warning'}</div>
  {/if}
{/block}
