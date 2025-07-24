{*
* 2017 IQIT-COMMERCE.COM
*
* NOTICE OF LICENSE
*
* This file is licenced under the Software License Agreement.
* With the purchase or the installation of the software in your application
* you accept the licence agreement
*
* @author    IQIT-COMMERCE.COM <support@iqit-commerce.com>
* @copyright 2017 IQIT-COMMERCE.COM
* @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
*
*}


{foreach $categories as $category}
	<option value="{$category.id}" {if isset($ids) && $type == 2 && in_array($category.id, $ids)}selected{/if} > {$category.name}</option>
	{if isset($category.children)}

		{if isset($ids) && $type == 2}
			{include file="./subcategory.tpl" categories=$category.children ids=$ids type=$type}
		{else}
			{include file="./subcategory.tpl" categories=$category.children}
		{/if}
	{/if}
{/foreach}
