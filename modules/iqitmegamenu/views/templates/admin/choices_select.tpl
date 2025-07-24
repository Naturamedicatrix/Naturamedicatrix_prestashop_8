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

<select {if $name}name="{$name}" id="{$name}" {/if} {if $class}class="{$class}" {/if} {if $mobile}id="availableItems"
	{/if} {($single) ? '' : 'multiple="multiple" style="width: 300px; height: 160px;"'}>
	<option value="HOME0">{l s='Homepage' mod='iqitmegamenu'}</option>
	<optgroup label="{l s='CMS' mod='iqitmegamenu'}">
		{$cmsPages}
	</optgroup>
	<optgroup label="{l s='Manufacturers' mod='iqitmegamenu'}">
		<option value="ALLMAN0">{l s='All manufacturers' mod='iqitmegamenu'}</option>
		{foreach $manufacturersOptions as $manufacturersOption}
			<option value="{$manufacturersOption.value}">{$manufacturersOption.name}</option>
		{/foreach}
	</optgroup>

	<optgroup label="{l s='Categories' mod='iqitmegamenu'}">
		{$categories}
	</optgroup>
	<optgroup label="{l s='Custom links' mod='iqitmegamenu'}">
	{foreach $linksOptions as $linksOption}
		<option value="{$linksOption.value}">{$linksOption.name}</option>
	{/foreach}
	</optgroup>
</select>

