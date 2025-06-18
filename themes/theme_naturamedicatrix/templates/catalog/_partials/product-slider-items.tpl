{if isset($product.features) && $product.features}
  <ul id="product-slider-items" class="row owl-theme-item owl-carousel owl-banners owl-theme owl-loaded owl-drag clear">
    
    {foreach from=$product.features item=feature}
      <li class="item">{$feature.id_feature|escape:'html':'UTF-8'} : {$feature.value|escape:'html':'UTF-8'}</li>
    {/foreach}
    
  </ul>
{/if}



  


<script>
  {literal}
$('.owl-theme-item').owlCarousel({
    loop:false,
    margin:10,
    rtl: false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:8
        }
    }
	});
	{/literal}
	</script>