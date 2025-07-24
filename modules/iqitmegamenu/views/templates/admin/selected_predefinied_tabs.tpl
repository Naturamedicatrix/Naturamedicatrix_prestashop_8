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

<select name="items[]" id="items" multiple="multiple" style="width: 300px; height: 160px;" >
	{foreach from=$tabs item=tab}
		<option value="{$tab->id_tab}">{$tab->title} id: {$tab->id_tab}</option>
	{/foreach}	
</select>