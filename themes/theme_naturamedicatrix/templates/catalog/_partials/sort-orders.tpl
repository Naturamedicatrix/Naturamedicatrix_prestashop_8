{**
 * CUSTOM SORT ORDERS (FILTRE)
 *}

<div class="products-sort-order">
      <h6>{l s='Sort by:' d='Shop.Theme.Global'}</h6>
      <div class="sort-options">
        {foreach from=$listing.sort_orders item=sort_order}
          <div class="form-check">
            <input 
              type="radio" 
              id="sort-{$sort_order@index}" 
              name="sort-option" 
              {if $sort_order.current}checked="checked"{/if}
              class="form-check-input js-search-link-radio"
              data-href="{$sort_order.url}"
            >
            <label for="sort-{$sort_order@index}" class="form-check-label {if $sort_order.current}font-weight-bold{/if}">
              {$sort_order.label}
            </label>
          </div>
        {/foreach}
      </div>
</div>
  
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      const radioButtons = document.querySelectorAll('.js-search-link-radio');
      radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
          if (this.checked) {
            window.location.href = this.getAttribute('data-href');
          }
        });
      });
    });
</script>