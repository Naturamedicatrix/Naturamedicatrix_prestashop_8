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

<ul>
{foreach $childrens as $children}
	{if isset($children.title)}
		<li>{if isset($children.children)}<div class="responsiveInykator">+</div>{/if}<a href="{$children.href}">{$children.title}</a>
			{if isset($children.children)}
			{include file="./front_link.tpl" childrens=$children.children}
			{/if}
		</li>
	{/if}
{/foreach}
</ul>
