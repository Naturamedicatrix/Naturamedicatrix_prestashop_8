{if isset($product.features) && $product.features}
  <ul id="product-slider-items" class="clear pt-16">

    {foreach from=$product.features item=feature}
      
      {if 
        $feature.value == 'Sans exciptients' || 
        $feature.value == 'Made in France' || 
        $feature.value == 'Made in Belgique' || 
        $feature.value == 'Made in Europe' ||
        $feature.value == 'Made in Maroc' || 
        $feature.value == 'Bio' ||
        $feature.value == 'Label AB' ||
        $feature.value == 'Ecocert' ||
        $feature.value == 'Kasher' ||
        $feature.value == 'Halal' || 
        $feature.value == 'Haute concentration' ||
        $feature.value == 'Fermenté'
      }
      
        <li class="item">
            <span class="icon-special"><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
            <p class="text-sm">{$feature.value|escape:'html':'UTF-8'}</p>
        </li>
      
      {elseif $feature.value == 'Certifié VEGAN' || $feature.value == 'Vegan' || $feature.value == 'Vegan (NM)' || $feature.value == 'Végétarien' || $feature.value == 'Végétalien'}
        
        <li class="item">
            <span class="icon-special"><img src="{$urls.child_img_url}picto/Vegan.svg" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto" /></span>
            <p class="text-sm">{$feature.value|escape:'html':'UTF-8'}</p>
        </li>
        
      {/if}
      
    {/foreach}
    
  </ul>
{/if}