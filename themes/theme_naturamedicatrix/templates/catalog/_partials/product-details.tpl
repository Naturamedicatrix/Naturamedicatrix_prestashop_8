<div class="js-product-details tab-pane fade{if !$product.description} in active{/if}"
     id="product-details"
     data-product="{$product.embedded_attributes|json_encode}"
     role="tabpanel">
  
<div class="bg-white">
  <div class="mx-auto grid max-w-2xl grid-cols-1 items-top gap-x-8 gap-y-16 lg:max-w-7xl lg:grid-cols-2">
    <div>
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{l s='Technical specifications' d='Shop.Theme.Catalog'}</h2>
      <p class="mt-4 text-gray-500">Formulé avec rigueur, ce produit allie qualité, efficacité et naturalité. Chaque ingrédient est sélectionné avec soin et transformé dans le respect des actifs.</p>
      
      
      <dl class="product-features mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
        {block name='product_reference'}
          {if isset($product.reference_to_display) && $product.reference_to_display neq ''}
             <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">{l s='Reference' d='Shop.Theme.Catalog'}</dt>
                <dd class="mt-1.5 text-sm text-gray-500">{$product.reference_to_display}</dd>
              </div>
          {/if}
        {/block}
        
        {block name='product_manufacturer'}
          {if isset($product_manufacturer->id)}
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{l s='Manufacturer' d='Shop.Theme.Catalog'}</dt>
              <dd class="mt-1.5 text-sm text-gray-500"><a href="{$product_brand_url}" title="{$product_manufacturer->name}">{$product_manufacturer->name}</a></dd>
            </div>
          {/if}
        {/block}
        
        {block name='product_ean'}
          {if $product.ean13}
            <div class="border-t border-gray-200 pt-4">
              <dt class="font-medium text-gray-900">{l s='Code EAN 13' d='Shop.Theme.Catalog'}</dt>
              <dd class="mt-1.5 text-sm text-gray-500">{$product.ean13}</dd>
            </div>
          {/if}
        {/block}
        
        
        {block name='product_features'}
          {if $product.grouped_features}
            {foreach from=$product.grouped_features item=feature}
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">{$feature.name}</dt>
                <dd class="mt-1.5 text-sm text-gray-500">{$feature.value|escape:'htmlall'|nl2br nofilter}</dd>
              </div>
            {/foreach}
          {/if}
        {/block}
      </dl>
      
      
    
{*
      {block name='product_quantities'}
        {if $product.show_quantities}
          <div class="product-quantities">
            <label class="label">{l s='In stock' d='Shop.Theme.Catalog'}</label>
            <span data-stock="{$product.quantity}" data-allow-oosp="{$product.allow_oosp}">{$product.quantity} {$product.quantity_label}</span>
          </div>
        {/if}
      {/block}
*}
    
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
    
    
      <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
  
        {foreach from=$product.features item=feature}
            {if $feature.value == 'Label AB'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Certifié Agriculture Biologique : une garantie de qualité, de traçabilité et de respect de l’environnement.</p>
              </div>
            
            {elseif $feature.value == 'Ecocert'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Certification Ecocert : des ingrédients et des procédés validés par l’un des organismes les plus exigeants du bio.</p>
              </div>
            
            {elseif $feature.value == 'Kasher'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Conforme aux exigences de la certification Kasher : une fabrication respectueuse des traditions alimentaires juives.</p>
              </div>  
                
            {elseif $feature.value == 'Fermenté'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des ingrédients fermentés pour une meilleure assimilation, une action optimisée et une tolérance améliorée.</p>
              </div>
              
            {elseif $feature.value == 'Halal'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Certifié Halal : des produits respectant les critères de pureté et les règles de fabrication conformes à la tradition musulmane.</p>
              </div>
              
            {elseif $feature.value == 'Haute concentration'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des formules à haute concentration d’actifs pour une efficacité renforcée, dès les premières prises.</p>
              </div>
            
            {elseif $feature.value == 'Sans excipients'}  
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">100% d’actifs, 0% d’ajouts inutiles : nos formules pures vont à l’essentiel pour une efficacité maximale.</p>
              </div>
              
            {elseif $feature.value == 'Made in France'}
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Conçus et fabriqués en France, nos produits répondent aux standards de qualité et aux exigences réglementaires françaises.</p>
              </div>
              
            {elseif $feature.value == 'Made in Belgique'}
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des produits élaborés en Belgique, au cœur de l’Europe, dans le respect des normes de qualité les plus strictes.</p>
              </div>
              
            {elseif $feature.value == 'Made in Europe'}
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Une fabrication européenne garantissant traçabilité, savoir-faire maîtrisé et conformité aux standards réglementaires.</p>
              </div>
              
            {elseif $feature.value == 'Made in Maroc'}
              
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value|escape:'html':'UTF-8'}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Conçus et fabriqués au Maroc, nos produits bénéficient d’un savoir-faire local reconnu et d’un sourcing naturel de haute qualité.</p>
              </div>
              
              
            {elseif $feature.value == 'Certifié VEGAN' || $feature.value == 'Vegan' || $feature.value == 'Vegan (NM)' || $feature.value == 'Végétalien'}
            
            
              <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/Vegan.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des produits sans aucun ingrédient d’origine animale, non testés sur les animaux, pour un respect total du vivant.</p>
              </div>
            
            {elseif $feature.value == 'Végétarien'}
               <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des produits formulés sans viande ni dérivés animaux, parfaitement adaptés à un mode de vie végétarien.</p>
              </div>  
            
              
            {elseif $feature.value == 'Bio'}
               <div class="block text-center rounded-lg bg-gray-50">
                <span><img src="{$urls.child_img_url}picto/{$feature.value}.svg" width="50" alt="{$feature.value|escape:'html':'UTF-8'}" class="img-responsive mx-auto w-14 h-14" /></span>
                <p class="text-sm mt-2.5 pb-0 mb-1.5 font-bold text-gray-900"><strong>{$feature.value}</strong></p>
                <p class="text-sm pb-0">Des produits formulés à partir d’ingrédients issus de l’agriculture biologique, cultivés sans pesticides chimiques, sans OGM ni engrais de synthèse, pour une naturalité préservée.</p>
              </div>
              
            {/if}
          {/foreach}
      </div>
    
  </div>
</div>

  
  
  
  
  
  
</div>
