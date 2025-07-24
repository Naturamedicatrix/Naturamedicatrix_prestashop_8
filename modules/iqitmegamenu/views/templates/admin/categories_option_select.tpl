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
{function name="categories_tree" optionsArray=[]}
	{strip}
		{if $optionsArray|count}
			{foreach $optionsArray as $option}
				<option value="{$option.value}">{$option.name}</option>
				{if isset($option.subcategories)}{*HTML·CONTENT*} {$option.subcategories  nofilter}{/if}
			{/foreach}
		{/if}
	{/strip}
{/function}

{categories_tree optionsArray=$optionsArray}


