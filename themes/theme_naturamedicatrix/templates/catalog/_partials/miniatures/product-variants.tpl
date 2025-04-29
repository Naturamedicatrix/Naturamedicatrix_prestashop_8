{**
 * Template pour afficher les variantes de produit dans la liste des produits
 *}

<div class="products-variants">
  {if isset($product.id_product) && $product.id_product}
    {* VARIABLES *}
    {assign var="id_product" value=$product.id_product}
    {assign var="all_attributes_by_group" value=[]}
  
    {* Requête SQL directe pour récupérer toutes les variantes *}
    {assign var="db_query" value="SELECT DISTINCT 
      agl.name AS group_name, 
      al.name AS attribute_name,
      a.id_attribute_group,
      a.id_attribute
    FROM {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}product_attribute pa
    JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}product_attribute_combination pac ON pa.id_product_attribute = pac.id_product_attribute
    JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}attribute a ON a.id_attribute = pac.id_attribute
    JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}attribute_lang al ON (a.id_attribute = al.id_attribute AND al.id_lang = {Context::getContext()->language->id})
    JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}attribute_group_lang agl ON (a.id_attribute_group = agl.id_attribute_group AND agl.id_lang = {Context::getContext()->language->id})
    WHERE pa.id_product = {$id_product}
    ORDER BY a.id_attribute_group, a.position"}
    
    {* Execute la requête avec getInstance *}
    {assign var="attributes_result" value=Db::getInstance()->executeS($db_query)}
    
    {* Groupe les attributs par groupe *}
    {foreach from=$attributes_result item=attr}
      {if !isset($all_attributes_by_group[$attr.id_attribute_group])}
        {$all_attributes_by_group[$attr.id_attribute_group] = [
          'group_name' => $attr.group_name,
          'attributes' => []
        ]}
      {/if}
      {$all_attributes_by_group[$attr.id_attribute_group]['attributes'][] = $attr.attribute_name}
    {/foreach}
    
    {* Display des attributs *}
    <div class="product-variants">
      {foreach from=$all_attributes_by_group key=id_group item=group}
        <div class="variants-group text-center">
          {* Split les attributs par "/" *}
          {assign var="attributes_str" value=""}
          {foreach from=$group.attributes item=attr_name name=attr_loop}
            {if !$smarty.foreach.attr_loop.first}
              {assign var="attributes_str" value="$attributes_str / $attr_name"}
            {else}
              {assign var="attributes_str" value=$attr_name}
            {/if}
          {/foreach}
          {$attributes_str}
        </div>
      {/foreach}
    </div>
    
  {/if}
</div>
