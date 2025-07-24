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




{extends file="helpers/form/form.tpl"}


{block name="script"}

$(document).ready(function() {


 $('.iframe-upload').fancybox({
			'width'		: 900,
			'height'	: 600,
			'type'		: 'iframe',
      		'autoScale' : false,
      		'autoDimensions': false,
      		 'fitToView' : false,
  			 'autoSize' : false,
  			 onUpdate : function(){ $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
			 	 $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));},
  			 afterShow: function(){
			 	 $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
			 	 $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));
			}
  		  });

 $('.iframe-column-upload').fancybox({
			'width'		: 900,
			'height'	: 600,
			'type'		: 'iframe',
      		'autoScale' : false,
      		'autoDimensions': false,
      		 'fitToView' : false,
  			 'autoSize' : false,
  			 onUpdate : function(){
  			 	 $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
			 	 $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));
			 	},
  			 afterShow: function(){
			 	 $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
			 	 $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));
			}
  		  });

var control = $("#url_type");

if (control.val() == 1)
{
$("#custom-url-wrapper").removeClass('hidden');
$("#system-url-wrapper").addClass('hidden');
}

if (control.val() == 0) {
$("#custom-url-wrapper").addClass('hidden');
$("#system-url-wrapper").removeClass('hidden');
}

if (control.val() == 2) {
$("#custom-url-wrapper").addClass('hidden');
$("#system-url-wrapper").addClass('hidden');
}



$("#url_type").change(function() {
	var control = $(this);

if (control.val() == 1)
{
$("#custom-url-wrapper").removeClass('hidden');
$("#system-url-wrapper").addClass('hidden');
}

if (control.val() == 0) {
$("#custom-url-wrapper").addClass('hidden');
$("#system-url-wrapper").removeClass('hidden');
}

if (control.val() == 2) {
$("#custom-url-wrapper").addClass('hidden');
$("#system-url-wrapper").addClass('hidden');
}

});


var control = $("#icon_type");

if (control.val() == 1)
{
$("#icon-class-wrapper").removeClass('hidden');
$("#image-icon-wrapper").addClass('hidden');
}

if (control.val() == 0) {
$("#icon-class-wrapper").addClass('hidden');
$("#image-icon-wrapper").removeClass('hidden');
}



$("#icon_type").change(function() {
	var control = $(this);

if (control.val() == 1)
{
$("#icon-class-wrapper").removeClass('hidden');
$("#image-icon-wrapper").addClass('hidden');
}

if (control.val() == 0) {
$("#icon-class-wrapper").addClass('hidden');
$("#image-icon-wrapper").removeClass('hidden');
}

});


var control1 = $("#submenu_type");

if (control1.val() == 2)
{
$("#grid-submenu").removeClass('hidden');
$("#cssstyle-submenu").removeClass('hidden');


}

if (control1.val() == 1)
{
$("#tabs-submenu").removeClass('hidden');
$("#cssstyle-submenu").removeClass('hidden');
}

$("#submenu_type").change(function() {
	var control1 = $(this);
if (control1.val() == 2)
{
$("#grid-submenu").removeClass('hidden');
$("#cssstyle-submenu").removeClass('hidden');
$("#tabs-submenu").addClass('hidden');
}

if (control1.val() == 1)
{
$("#tabs-submenu").removeClass('hidden');
$("#grid-submenu").addClass('hidden');
$("#cssstyle-submenu").removeClass('hidden');
}

if (control1.val() == 0) {
$("#tabs-submenu").addClass('hidden');
$("#grid-submenu").addClass('hidden');
$("#cssstyle-submenu").addClass('hidden');
}

});


		$('.list-wrapper-horizontal').show();
		$('#options_tab a').click(function (e) {
		e.preventDefault();
		$('.list-wrapper').hide();
		if($(this).attr('href')=='#main_tab')
		$('.list-wrapper-horizontal').show();
		if($(this).attr('href')=='#vertical_tab')
		$('.list-wrapper-vertical').show();
		if($(this).attr('href')=='#submenutabs_tab')
		$('.list-wrapper-submenutabs').show();
		if($(this).attr('href')=='#mobile_tab')
		$('.list-wrapper-mobile').show();
		if($(this).attr('href')=='#customhtml_tab')
		$('.list-wrapper-html').show();



		$(this).tab('show');
	});

$('#menuOrderUp').click(function(e){
	e.preventDefault();
    move(true);
});
$('#menuOrderDown').click(function(e){
    e.preventDefault();
    move();
});
$("#items").closest('form').on('submit', function(e) {
	$("#items option").prop('selected', true);
});
$("#addItem").click(add);
$("#availableItems").dblclick(add);
$("#removeItem").click(remove);
$("#items").dblclick(remove);
function add()
{
	$("#availableItems option:selected").each(function(i){
		var val = $(this).val();
		var text = $(this).text();
		text = text.replace(/(^\s*)|(\s*$)/gi,"");
		if (val == "PRODUCT")
		{
			val = prompt('{l s='Indicate the ID number for the product' mod='iqitmegamenu' js=1}');
			if (val == null || val == "" || isNaN(val))
				return;
			text = '{l s='Product ID #' mod='iqitmegamenu' js=1}'+val;
			val = "PRD"+val;
		}
		$("#items").append('<option value="'+val+'" selected="selected">'+text+'</option>');
	});
	serialize();
	return false;
}
function remove()
{
	$("#items option:selected").each(function(i){
		$(this).remove();
	});
	serialize();
	return false;
}
function serialize()
{
	var options = "";
	$("#items option").each(function(i){
		options += $(this).val()+",";
	});
	$("#itemsInput").val(options.substr(0, options.length - 1));
}
function move(up)
{
        var tomove = $('#items option:selected');
        if (tomove.length >1)
        {
                alert('{l s='Please select just one item' mod='iqitmegamenu'}');
                return false;
        }
        if (up)
                tomove.prev().insertAfter(tomove);
        else
                tomove.next().insertBefore(tomove);
        serialize();
        return false;
}


});



{/block}


{block name="defaultForm"}
<div class="row">
<div class="col-lg-2">
<div id="options_tab" class="">
	<ul class="list-group">
{foreach $fields as $tab}
{if $tab.form.tab_name != 'save_tab'}<li {if $tab.form.tab_name == 'main_tab'}class="active"{/if}><a class="list-group-item" href="#{$tab.form.tab_name}">{$tab.form.legend.title}</a></li>{/if}
{/foreach}
<ul>
</div>
</div>
<div id="list-container" class="col-lg-10 tab-content menu-type-{$menu_type}">
{$smarty.block.parent}
</div>
</div>
{/block}

{block name="fieldset"}
{if $fieldset.form.tab_name != 'save_tab'}

<div class="tab-pane-wrapper {if $fieldset.form.tab_name == 'main_tab'}active{/if}" id="{$fieldset.form.tab_name}">
	{*HTML CONTENT*} {if isset($fieldset.form.assigned_list)}<div class="tab-pane clearfix">{$fieldset.form.assigned_list nofilter}</div>{/if}
<div class="tab-pane">
{/if}
{$smarty.block.parent}
{if $fieldset.form.tab_name != 'save_tab'}</div></div>{/if}
{/block}


{block name="label"}
{if ($input.type == 'grid_creator') || ($input.type == 'ietool') }
{else}
{$smarty.block.parent}
{/if}
{/block}

{block name="input_row"}
{if !isset($input.iqitTheme) || !$input.iqitTheme}
{if isset($input.hide) && $input.hide}<div style="display: none !important;">{/if}
{if isset($input.preffix_wrapper)}<div id="{$input.preffix_wrapper}" {if isset($input.wrapper_hidden) && $input.wrapper_hidden} class="hidden clearfix"{/if}>{/if}
{if isset($input.accordion_wrapper)}<a class="btn btn-primary menu-collapse-expand" data-toggle="collapse" href="#{$input.accordion_wrapper}" aria-expanded="false" aria-controls="{$input.accordion_wrapper}">{l s='Expand submenu optional design options' mod='iqitmegamenu'}
 <i class="icon-angle-double-down"></i> </a><div id="{$input.accordion_wrapper}" class="collapse collapse-menu-expand">{/if}
{if isset($input.upper_separator) && $input.upper_separator}<hr>{/if}
{if isset($input.row_title)}
<div class="col-lg-9 col-lg-offset-3 row-title">{$input.row_title}</div>
{/if}
{$smarty.block.parent}
{if isset($input.separator) && $input.separator}<hr>{/if}
{if isset($input.suffix_a_wrapper) && $input.suffix_wrapper}</div>{/if}
{if isset($input.suffix_wrapper) && $input.suffix_wrapper}</div>{/if}
{if isset($input.hide) && $input.hide}</div>{/if}
{/if}
{/block}


{block name="input"}
    {if $input.type == 'link_choice'}
	    <div class="row">
	    	<div class="col-lg-1">
	    		<h4 style="margin-top:5px;">{l s='Change position' mod='iqitmegamenu'}</h4>
                <a href="#" id="menuOrderUp" class="btn btn-default" style="font-size:20px;display:block;"><i class="icon-chevron-up"></i></a><br/>
                <a href="#" id="menuOrderDown" class="btn btn-default" style="font-size:20px;display:block;"><i class="icon-chevron-down"></i></a><br/>
	    	</div>
	    	<div class="col-lg-4">
	    		<h4 style="margin-top:5px;">{l s='Selected items' mod='iqitmegamenu'}</h4>
	    		{*HTML CONTENT*} {$selected_links nofilter}
	    	</div>
	    	<div class="col-lg-4">
	    		<h4 style="margin-top:5px;">{l s='Available items' mod='iqitmegamenu'}</h4>
	    		{*HTML CONTENT*} {$choices nofilter}
	    	</div>

	    </div>
	    <br/>
	    <div class="row">
	    	<div class="col-lg-1"></div>
	    	<div class="col-lg-4"><a href="#" id="removeItem" class="btn btn-default"><i class="icon-arrow-right"></i> {l s='Remove' mod='iqitmegamenu'}</a></div>
	    	<div class="col-lg-4"><a href="#" id="addItem" class="btn btn-default"><i class="icon-arrow-left"></i> {l s='Add' mod='iqitmegamenu'}</a></div>
	    </div>
	 {elseif $input.type == 'tabs_choice'}
	    <div class="row">
	    	<div class="col-lg-1">
	    		<h4 style="margin-top:5px;">{l s='Change position' mod='iqitmegamenu'}</h4>
                <a href="#" id="menuOrderUp" class="btn btn-default" style="font-size:20px;display:block;"><i class="icon-chevron-up"></i></a><br/>
                <a href="#" id="menuOrderDown" class="btn btn-default" style="font-size:20px;display:block;"><i class="icon-chevron-down"></i></a><br/>
	    	</div>
	    	<div class="col-lg-4">
	    		<h4 style="margin-top:5px;">{l s='Selected tabs' mod='iqitmegamenu'}</h4>
	    		{*HTML CONTENT*} {$selected_tabs nofilter}
	    	</div>
	    	<div class="col-lg-4">
	    		<h4 style="margin-top:5px;">{l s='Available predefined tabs' mod='iqitmegamenu'}</h4>
	    		{*HTML CONTENT*} {$choices_tabs nofilter}
	    	</div>

	    </div>
	    <br/>
	    <div class="row">
	    	<div class="col-lg-1"></div>
	    	<div class="col-lg-4"><a href="#" id="removeItem" class="btn btn-default"><i class="icon-arrow-right"></i> {l s='Remove' mod='iqitmegamenu'}</a></div>
	    	<div class="col-lg-4"><a href="#" id="addItem" class="btn btn-default"><i class="icon-arrow-left"></i> {l s='Add' mod='iqitmegamenu'}</a></div>
	    </div>
	{elseif $input.type == 'grid_creator'}
	{*HTML CONTENT*}  <input type="hidden" name="submenu-elements" id="submenu-elements" value="{$submenu_content nofilter}">





	<div id="column-content-sample" class="hidden">
		{include file="./column_content.tpl"}
	</div>
	<div class="row grid_creator">
		<div class="col-xs-12 first-rows-wrapper" data-element-id="0">

			{foreach $submenu_content_format as $element}
				{include file="./submenu_content.tpl" node=$element}
			{/foreach}

		</div>
		<div id="buttons-sample">
				<div class="action-buttons-container">
					<button type="button" class="btn btn-default  add-row-action" ><i class="icon icon-plus"></i> {l s='Row' mod='iqitmegamenu'}</button>
					<button type="button" class="btn btn-default  add-column-action" ><i class="icon icon-plus"></i> {l s='Column' mod='iqitmegamenu'}</button>
					<button type="button" class="btn btn-default duplicate-element-action" ><i class="icon icon-files-o"></i> </button>
					<button type="button" class="btn btn-danger remove-element-action" ><i class="icon-trash"></i> </button>
				</div>
				<div class="dragger-handle btn btn-danger"><i class="icon-arrows "></i></a></div>
			</div>
	</div>


	{elseif $input.type == 'image_upload'}
	<p> <input id="{$input.name}" type="text" name="{$input.name}" value="{$fields_value[$input.name]}"> </p>
	 <a href="filemanager/dialog.php?type=1&field_id={$input.name}" class="btn btn-default iframe-upload"  data-input-name="{$input.name}" type="button">{l s='Select image' mod='iqitmegamenu'} <i class="icon-angle-right"></i></a>

	{elseif $input.type == 'ietool'}

	<div class="row-title">{l s='Design import/export' mod='iqitmegamenu'} </div>
	<div style="display:inline-block;"><input type="file" id="uploadConfig" name="uploadConfig" /></div>

	<button type="submit" class="btn btn-default btn-lg" name="importConfiguration" ><span class="icon icon-upload"></span> {l s='Import design' mod='iqitmegamenu'} </button>
	<button type="submit" class="btn btn-default btn-lg" name="exportConfiguration" ><span class="icon icon-share"></span> {l s='Export design' mod='iqitmegamenu'} </button>
	<hr>
	<div class="row-title">{l s='Tabs import/export' mod='iqitmegamenu'} </div>
	<div style="display:inline-block;"><input type="file" id="uploadTabs" name="uploadTabs" /></div>

	<button type="submit" class="btn btn-default btn-lg" name="importTabs" ><span class="icon icon-upload"></span> {l s='Import tabs' mod='iqitmegamenu'} </button>
	<button type="submit" class="btn btn-default btn-lg" name="exportTabs" ><span class="icon icon-share"></span> {l s='Export tabs' mod='iqitmegamenu'} </button>
		<hr>
	<div class="alert alert-info">
	{l s='If you using multistore: It will import or export design or tabs of your currently selected store only.' mod='iqitmegamenu'}
	</div>


	{elseif $input.type == 'custom_select'}
	{*HTML CONTENT*} {$input.choices nofilter}

	<script>
	$("#{$input.name} option").filter(function() {

    return $(this).val() == '{$fields_value[$input.name]}';
	}).prop('selected', true);
	</script>
	{elseif $input.type == 'icon_selector'}
	<div class="input-group col-lg-3">
            <input type="text" name="{$input.name}" class="icp icp-auto" id="{$input.name}" value="{$fields_value[$input.name]}">
            <span class="input-group-addon">{l s='Select icon' mod='iqitmegamenu'}</span>
    </div>

	{elseif $input.type == 'border_generator'}

	<div class="col-xs-2">
	<select name="{$input.name}_type" id="{$input.name}_type">
		<option value="5" {if $fields_value[$input.name].type==5}selected{/if}>{l s='groove' mod='iqitmegamenu'}</option>
		<option value="4" {if $fields_value[$input.name].type==4}selected{/if}>{l s='double' mod='iqitmegamenu'}</option>
		<option value="3" {if $fields_value[$input.name].type==3}selected{/if}>{l s='dotted' mod='iqitmegamenu'}</option>
		<option value="2" {if $fields_value[$input.name].type==2}selected{/if}>{l s='dashed' mod='iqitmegamenu'}</option>
		<option value="1" {if $fields_value[$input.name].type==1}selected{/if}>{l s='solid' mod='iqitmegamenu'}</option>
		<option value="0" {if $fields_value[$input.name].type==0}selected{/if}>{l s='none' mod='iqitmegamenu'}</option>
	</select>
	</div>
	<div class="col-xs-2">
	<select name="{$input.name}_width" id="{$input.name}_width">
		{for $i=1 to 10}
  				  <option value="{$i}" {if $fields_value[$input.name].width == $i}selected{/if}>{$i} px</option>
		{/for}
	</select>
	</div>
	<div class="col-xs-2">
	<div class="row">
	<div class="input-group">
	<input type="color" data-hex="true" class="color mColorPickerInput"	name="{$input.name}_color" value="{$fields_value[$input.name].color}" />
	</div>	</div>	</div>
	
	{elseif $input.type == 'font'}
		<div class="col-lg-6">
        {assign var='value_font' value=$fields_value[$input.name]}
        <div class="input-group{if isset($input.class)} {$input.class}{/if} js-typography-generator">
            {if isset($input.prefix)}
                <span class="input-group-addon">{$input.prefix}</span>
            {/if}
            <input type="hidden" value="" name="{$input.name}" id="{$input.name}" class="js-font-input"/>
            <input type="number"
                   id="{if isset($input.id)}{$input.id}{else}{$input.name}{/if}_size"
                   value="{if isset($value_font.size)}{$value_font.size}{/if}"
                   data-name="size"
                   name="{$input.name}_size"
                   class="form-control js-font-size js-scss-ignore width-70"
                   step="1"
                    {if isset($input.size)} size="{$input.size}"{/if}
                    {if isset($input.min)} min="{$input.min|intval}"{/if}
                    {if isset($input.maxchar) && $input.maxchar} data-maxchar="{$input.maxchar|intval}"{/if}
                    {if isset($input.maxlength) && $input.maxlength} maxlength="{$input.maxlength|intval}"{/if}
                    {if isset($input.readonly) && $input.readonly} readonly="readonly"{/if}
                    {if isset($input.disabled) && $input.disabled} disabled="disabled"{/if}
                    {if isset($input.autocomplete) && !$input.autocomplete} autocomplete="off"{/if}
                    {if isset($input.required) && $input.required } required="required" {/if}
                    {if isset($input.placeholder) && $input.placeholder } placeholder="{$input.placeholder}"{/if}
            />
            {if isset($input.suffix)}
                <span class="input-group-addon">{$input.suffix}</span>
            {/if}
            <span class="input-group-addon single-option-switch-wrapper">
                <span class="single-option-switch">
                    <input data-name="bold" type="radio" class="js-font-bold js-scss-ignore" id="{$input.name}_unbold"
                           name="{$input.name}_bold"
                           value="0" {if !isset($value_font.bold) || !$value_font.bold} checked{/if} />
                    <label for="{$input.name}_unbold"><i class="icon-bold"></i></label>
                    <input data-name="bold" type="radio" class="js-font-bold js-scss-ignore" id="{$input.name}_bold"
                           name="{$input.name}_bold"
                           value="1" {if isset($value_font.bold) && $value_font.bold} checked{/if}/>
                    <label for="{$input.name}_bold"><i class="icon-bold"></i></label>
                </span>
            </span>
            <span class="input-group-addon single-option-switch-wrapper">
                <span class="single-option-switch">
                    <input data-name="italic" type="radio" class="js-font-italic js-scss-ignore"
                           id="{$input.name}_unitalic" name="{$input.name}_italic"
                           value="0" {if !isset($value_font.italic) || !$value_font.italic} checked{/if}/>
                    <label for="{$input.name}_unitalic"><i class="icon-italic"></i></label>
                    <input data-name="italic" type="radio" class="js-font-italic js-scss-ignore"
                           id="{$input.name}_italic" name="{$input.name}_italic"
                           value="1" {if isset($value_font.italic) && $value_font.italic} checked{/if}/>
                    <label for="{$input.name}_italic"><i class="icon-italic"></i></label>
                </span>
            </span>
            <span class="input-group-addon single-option-switch-wrapper">
                <span class="single-option-switch">
                    <input data-name="uppercase" type="radio" class="js-font-uppercase js-scss-ignore"
                           id="{$input.name}_unuppercase" name="{$input.name}_uppercase"
                           value="0" {if !isset($value_font.uppercase) || !$value_font.uppercase} checked{/if}/>
                    <label for="{$input.name}_unuppercase">ABC</label>
                    <input data-name="uppercase" type="radio" class="js-font-uppercase js-scss-ignore"
                           id="{$input.name}_uppercase" name="{$input.name}_uppercase"
                           value="1" {if isset($value_font.uppercase) && $value_font.uppercase} checked{/if}/>
                    <label for="{$input.name}_uppercase">Abc</label>
                </span>
            </span>
            <span class="input-group-addon"><i class="icon icon-arrows-h" aria-hidden="true"></i></span>
            <input type="number"
                   value="{if isset($value_font.spacing)}{$value_font.spacing}{/if}"
                   data-name="spacing"
                   name="{$input.name}_spacing"
                   class="form-control js-font-spacing js-scss-ignore width-70"
                   step="1"`
                   min="-10"
                   max="20"
            />
        </div>
		</div>

		{elseif $input.type == 'number'}
			<div class="col-lg-6">
			{assign var='value_text' value=$fields_value[$input.name]}
			{if isset($input.prefix) || isset($input.suffix)}
				<div class="input-group{if isset($input.class)} {$input.class}{/if}">
			{/if}
			{if isset($input.prefix)}
				<span class="input-group-addon">{$input.prefix}</span>
			{/if}
			<input type="number"
				   name="{$input.name}"
				   id="{if isset($input.id)}{$input.id}{else}{$input.name}{/if}"
				   value="{if isset($input.string_format) && $input.string_format}{$value_text|string_format:$input.string_format|escape:'html':'UTF-8'}{else}{$value_text|escape:'html':'UTF-8'}{/if}"
				   class="form-control {if isset($input.class)}{$input.class}{/if}"
					{if isset($input.size)} size="{$input.size}"{/if}
					{if isset($input.min)} min="{$input.min|floatval}"{/if}
					{if isset($input.max)} max="{$input.max|floatval}"{/if}
					{if isset($input.step)} step="{$input.step|floatval}"{/if}
					{if isset($input.maxchar) && $input.maxchar} data-maxchar="{$input.maxchar|intval}"{/if}
					{if isset($input.maxlength) && $input.maxlength} maxlength="{$input.maxlength|intval}"{/if}
					{if isset($input.readonly) && $input.readonly} readonly="readonly"{/if}
					{if isset($input.disabled) && $input.disabled} disabled="disabled"{/if}
					{if isset($input.autocomplete) && !$input.autocomplete} autocomplete="off"{/if}
					{if isset($input.required) && $input.required } required="required" {/if}
					{if isset($input.placeholder) && $input.placeholder } placeholder="{$input.placeholder}"{/if}
			/>
			{if isset($input.suffix)}
				<span class="input-group-addon">{$input.suffix}</span>
			{/if}
			{if isset($input.prefix) || isset($input.suffix)}
				</div>
			{/if}
			</div>
	{elseif $input.type == 'custom_info'}
	  &nbsp;
	{else}
		{$smarty.block.parent}
    {/if}
{/block}




