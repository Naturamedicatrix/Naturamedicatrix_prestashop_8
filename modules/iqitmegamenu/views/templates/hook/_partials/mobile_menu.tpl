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

{function name="mobile_links" nodes=[] first=false}
	{strip}
		{if $nodes|count}
			{if !$first}<ul>{/if}
			{foreach from=$nodes item=node}
				{if isset($node.title)}
					<li>{if isset($node.children)}<div class="responsiveInykator">+</div>{/if}<a href="{$node.href}">{$node.title}</a>
						{if isset($node.children)}
							{mobile_links nodes=$node.children first=false}
						{/if}
					</li>
				{/if}
			{/foreach}
			{if !$first}</ul>{/if}
		{/if}
	{/strip}
{/function}


{if isset($menu)}
	{mobile_links nodes=$menu first=true}
{/if}
