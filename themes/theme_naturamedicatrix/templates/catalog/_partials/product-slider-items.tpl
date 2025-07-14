{if isset($product.features) && $product.features}
  <div id="product-slider-items" class="flex flex-wrap justify-center gap-24 pt-16 w-full relative">

    {foreach from=$product.features item=feature}

      {if 
        $feature.value == 'Sans excipients' || 
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
        $feature.value == 'Fermenté' ||
        $feature.value == 'Végétarien'
      }
        <div class="text-center w-[96px]">
          <span class="flex items-center justify-center bg-white rounded-full mx-auto mb-2.5 relative px-4">
            <img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg"
                 alt="{$feature.value|escape:'html':'UTF-8'}"
                 class="w-14 h-14 object-contain z-10" />
          </span>
          <p class="text-sm text-gray-600">{$feature.value|escape:'html':'UTF-8'}</p>
        </div>

      {elseif $feature.value == 'Certifié VEGAN' || $feature.value == 'Vegan' || $feature.value == 'Vegan (NM)' || $feature.value == 'Végétalien'}
        <div class="text-center w-[96px]">
          <span class="flex items-center justify-center bg-white rounded-full mx-auto mb-2.5 relative px-4">
            <img src="{$urls.child_img_url}picto/Vegan.svg"
                 alt="{$feature.value|escape:'html':'UTF-8'}"
                 class="w-14 h-14 object-contain z-10" />
          </span>
          <p class="text-sm text-gray-600">{$feature.value|escape:'html':'UTF-8'}</p>
        </div>
      {/if}

    {/foreach}

  </div>
{/if}
