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
{function name="cms_tree" optionsArray=[]}
	{strip}
		{if $optionsArray|count}
			{foreach $optionsArray as $option}
				<option value="{$option.value}" {if $option.type == 'category'} style="font-weight: bold;" {/if}>{$option.name}</option>
				{if isset($option.pages)}{*HTML·CONTENT*}{$option.pages  nofilter}{/if}
			{/foreach}
		{/if}
	{/strip}
{/function}


{cms_tree optionsArray=$optionsArray}


