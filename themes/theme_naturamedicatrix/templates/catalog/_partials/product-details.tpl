<div class="js-product-details tab-pane fade{if !$product.description} in active{/if}"
     id="product-details"
     data-product="{$product.embedded_attributes|json_encode}"
     role="tabpanel"
  >
  {block name='product_reference'}
    {if isset($product.reference_to_display) && $product.reference_to_display neq ''}
      <div class="product-reference">
        <label class="label">{l s='Reference' d='Shop.Theme.Catalog'} </label>
        <span>{$product.reference_to_display}</span>
      </div>
    {/if}
  {/block}

  {block name='product_quantities'}
    {if $product.show_quantities}
      <div class="product-quantities">
        <label class="label">{l s='In stock' d='Shop.Theme.Catalog'}</label>
        <span data-stock="{$product.quantity}" data-allow-oosp="{$product.allow_oosp}">{$product.quantity} {$product.quantity_label}</span>
      </div>
    {/if}
  {/block}

  {block name='product_availability_date'}
    {if $product.availability_date}
      <div class="product-availability-date">
        <label>{l s='Availability date:' d='Shop.Theme.Catalog'} </label>
        <span>{$product.availability_date}</span>
      </div>
    {/if}
  {/block}

  {block name='product_out_of_stock'}
    <div class="product-out-of-stock">
      {hook h='actionProductOutOfStock' product=$product}
    </div>
  {/block}

  {block name='product_features'}
    {if $product.grouped_features}
      <section class="product-features">
        <p class="h4">{l s='Certifications' d='Shop.Theme.Catalog'}</p>
        
        <dl class="data-sheet">
          {foreach from=$product.grouped_features item=feature}
            <dt class="name">{$feature.name}</dt>
            <dd class="value">{$feature.value|escape:'htmlall'|nl2br nofilter}</dd>
          {/foreach}
        </dl>
        
        <div id="block_wrapper" class="mt-1">
        {foreach from=$product.features item=feature}
          {if 
            $feature.value == 'Made in Belgique' || 
            $feature.value == 'Made in Europe' ||
            $feature.value == 'Made in Maroc' ||
            $feature.value == 'Label AB' ||
            $feature.value == 'Ecocert' ||
            $feature.value == 'Kasher' ||
            $feature.value == 'Halal' || 
            $feature.value == 'Haute concentration' ||
            $feature.value == 'Fermenté'
          }
            
            <div class="block text-center">
              <span class="icon-special"><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
              <p class="text-sm mt-1.5 pb-0 mb-0"><strong>{$feature.value}</strong></p>
              <p class="text-sm pb-0">Onatera développe ses propres marques depuis 2014 pour vous offrir des produits toujours plus efficaces, qualitatifs et abordables.</p>
            </div>
          
          {elseif $feature.value == 'Sans exciptients'}  
            
            <div class="block text-center">
              <span class="icon-special"><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
              <p class="text-sm mt-1.5 pb-0 mb-0"><strong>{$feature.value}</strong></p>
              <p class="text-sm pb-0">Produits exempts de tous les excipients (conservateurs, colorants et arômes) controversés, en conformité avec la réglementation européenne en vigueur.</p>
            </div>
          
          
          
          {elseif $feature.value == 'Made in France'}
            
            <div class="block text-center">
              <span class="icon-special"><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
              <p class="text-sm mt-1.5 pb-0 mb-0"><strong>{$feature.value}</strong></p>
              <p class="text-sm pb-0">Produits dont au moins la dernière transformation substantielle a été réalisée en France, et donc soumis à la législation française (DGCCRF et DGDDI).</p>
            </div>
            
            
          {elseif $feature.value == 'Certifié VEGAN' || $feature.value == 'Vegan' || $feature.value == 'Vegan (NM)' || $feature.value == 'Végétarien' || $feature.value == 'Végétalien'}
          
          
            <div class="block text-center">
              <span class="icon-special"><img src="{$urls.child_img_url}picto/Vegan.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
              <p class="text-sm mt-1.5 pb-0 mb-0"><strong>{$feature.value}</strong></p>
              <p class="text-sm pb-0">Produits fabriqués sans ingrédients d’origine animale ni dérivés d’origine animale, et n’ayant pas fait l’objet de tests sur les animaux.</p>
            </div>
            
          {elseif $feature.value == 'Bio'}
             <div class="block text-center">
              <span class="icon-special"><img src="{$urls.child_img_url}picto/{$feature.value}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
              <p class="text-sm mt-1.5 pb-0 mb-0"><strong>{$feature.value}</strong></p>
              <p class="text-sm pb-0">Produits fabriqués à partir d’ingrédients issus de l’agriculture biologique, c’est-à-dire cultivés sans pesticides ni engrais chimiques de synthèse et sans OGM.</p>
            </div>
            
          {/if}
        {/foreach}
        </div>
        
         
        
      </section>
    {/if}
  {/block}

  {* if product have specific references, a table will be added to product details section *}
  {block name='product_specific_references'}
    {if !empty($product.specific_references)}
      <section class="product-features">
        <p class="h4">{l s='Specific References' d='Shop.Theme.Catalog'}</p>
          <dl class="data-sheet">
            {foreach from=$product.specific_references item=reference key=key}
              <dt class="name">{$key}</dt>
              <dd class="value">{$reference}</dd>
            {/foreach}
          </dl>
      </section>
    {/if}
  {/block}

  {block name='product_condition'}
    {if $product.condition}
      <div class="product-condition">
        <label class="label">{l s='Condition' d='Shop.Theme.Catalog'} </label>
        <link href="{$product.condition.schema_url}"/>
        <span>{$product.condition.label}</span>
      </div>
    {/if}
  {/block}
</div>
