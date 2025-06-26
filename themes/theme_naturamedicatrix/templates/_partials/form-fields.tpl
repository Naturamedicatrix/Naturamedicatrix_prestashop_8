{**
CUSTOM FORM FIELDS
 *}
{if $field.type == 'hidden'}

  {block name='form_field_item_hidden'}
    <input type="hidden" name="{$field.name}" value="{$field.value|default}">
  {/block}

{else}

  <div class="flex flex-col mb-6 mt-4 {if !empty($field.errors)}has-error{/if}">
    <label class="text-left font-bold {if $field.required} required after:content-['*'] after:ml-0.5 after:text-red-500{/if}" for="field-{$field.name}">
      {if $field.type !== 'checkbox'}
        {$field.label}
      {/if}
    </label>
    <div class="js-input-column{if ($field.type === 'radio-buttons')} form-control-valign{/if}">

      {if $field.type === 'select'}

        {block name='form_field_item_select'}
          <select id="field-{$field.name}" class="w-72 sm:w-96 border border-gray-300 rounded-md px-4 text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary bg-white" name="{$field.name}" {if $field.required}required{/if}>
            {if !$field.value}
              <option value disabled selected class="text-gray-500">{l s='Please choose' d='Shop.Forms.Labels'}</option>
            {/if}
            {foreach from=$field.availableValues item="label" key="value"}
              <option value="{$value}" class="text-black" {if $value eq $field.value} selected {/if}>{$label}</option>
            {/foreach}
          </select>
        {/block}

      {elseif $field.type === 'countrySelect'}

        {block name='form_field_item_country'}
          <select
            id="field-{$field.name}"
            class="w-72 sm:w-96 border border-gray-300 rounded-md px-4 text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary bg-white js-country"
            name="{$field.name}"
            {if $field.required}required{/if}
          >
            {if !$field.value}
              <option value disabled selected class="text-gray-500">{l s='Please choose' d='Shop.Forms.Labels'}</option>
            {/if}
            {foreach from=$field.availableValues item="label" key="value"}
              <option value="{$value}" class="text-black" {if $value eq $field.value} selected {/if}>{$label}</option>
            {/foreach}
          </select>
        {/block}

      {elseif $field.type === 'radio-buttons'}

        {block name='form_field_item_radio'}
          {foreach from=$field.availableValues item="label" key="value"}
            <label class="inline-flex items-center mr-4 mb-2" for="field-{$field.name}-{$value}">
              <span class="custom-radio">
                <input
                  name="{$field.name}"
                  id="field-{$field.name}-{$value}"
                  type="radio"
                  value="{$value}"
                  {if $field.required}required{/if}
                  {if $value eq $field.value} checked {/if}
                >
                <span></span>
              </span>
              {$label}
            </label>
          {/foreach}
        {/block}

      {elseif $field.type === 'checkbox'}

        {block name='form_field_item_checkbox'}
          <span class="inline-flex items-center">
            <label>
              <input name="{$field.name}" type="checkbox" class="w-4 h-4 mr-2" value="1" {if $field.value}checked="checked"{/if} {if $field.required}required{/if}>
              <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
              {$field.label nofilter}
            </label>
          </span>
        {/block}

      {elseif $field.type === 'date'}

        {block name='form_field_item_date'}
          <input id="field-{$field.name}" name="{$field.name}" class="w-72 sm:w-96 border border-gray-300 rounded-md px-4 py-1 text-sm h-9 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" type="date" value="{$field.value|default}"{if isset($field.availableValues.placeholder)} placeholder="{$field.availableValues.placeholder}"{/if}>
          {if isset($field.availableValues.comment)}
            <span class="text-xs text-gray-500 mt-1 block">
              {$field.availableValues.comment}
            </span>
          {/if}
        {/block}

      {elseif $field.type === 'birthday'}

        {block name='form_field_item_birthday'}
          <div class="js-parent-focus">
            {html_select_date
            field_order=DMY
            time={$field.value|default}
            field_array={$field.name}
            prefix=false
            reverse_years=true
            field_separator='<br>'
            day_extra='class="border border-gray-300 rounded-md px-4 py-1 text-sm h-9 mr-2 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"'
            month_extra='class="border border-gray-300 rounded-md px-4 py-1 text-sm h-9 mr-2 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"'
            year_extra='class="border border-gray-300 rounded-md px-4 py-1 text-sm h-9 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"'
            day_empty={l s='-- day --' d='Shop.Forms.Labels'}
            month_empty={l s='-- month --' d='Shop.Forms.Labels'}
            year_empty={l s='-- year --' d='Shop.Forms.Labels'}
            start_year={'Y'|date}-100 end_year={'Y'|date}
            }
          </div>
        {/block}

      {elseif $field.type === 'password'}

        {block name='form_field_item_password'}
          <div class="password-field-container">
            <input
              id="field-{$field.name}"
              class="w-72 sm:w-96 border border-gray-300 rounded-md pl-4 pr-10 py-1 text-sm h-9 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
              name="{$field.name}"
              aria-label="{l s='Password input' d='Shop.Forms.Help'}"
              type="password"
              {if isset($configuration.password_policy.minimum_length)}data-minlength="{$configuration.password_policy.minimum_length}"{/if}
              {if isset($configuration.password_policy.maximum_length)}data-maxlength="{$configuration.password_policy.maximum_length}"{/if}
              {if isset($configuration.password_policy.minimum_score)}data-minscore="{$configuration.password_policy.minimum_score}"{/if}
              {if $field.autocomplete}autocomplete="{$field.autocomplete}"{/if}
              value=""
              pattern=".{literal}{{/literal}5,{literal}}{/literal}"
              {if $field.required}required{/if}
            >
            <button
              type="button"
              class="password-toggle-btn"
              data-target="field-{$field.name}"
              aria-label="{l s='Toggle password visibility' d='Shop.Theme.Actions'}"
            >
              <i class="bi bi-eye password-toggle-icon"></i>
              <span class="password-toggle-text">{l s='Afficher' d='Shop.Theme.Actions'}</span>
            </button>
          </div>

        {/block}

      {else}

        {block name='form_field_item_other'}
          <input
            id="field-{$field.name}"
            class="w-72 sm:w-96 border border-gray-300 rounded-md px-4 py-1 text-sm h-9 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
            name="{$field.name}"
            type="{$field.type}"
            value="{$field.value|default}"
            {if $field.autocomplete}autocomplete="{$field.autocomplete}"{/if}
            {if isset($field.availableValues.placeholder)}placeholder="{$field.availableValues.placeholder}"{/if}
            {if $field.maxLength}maxlength="{$field.maxLength}"{/if}
            {if $field.required}required{/if}
          >
          {if isset($field.availableValues.comment)}
            <span class="text-xs text-gray-500 mt-0.5 block">
              {$field.availableValues.comment}
            </span>
          {/if}
        {/block}

      {/if}

      {block name='form_field_errors'}
        {include file='_partials/form-errors.tpl' errors=$field.errors}
      {/block}

    </div>

    {* <div class="text-xs text-gray-500 mt-0">
      {block name='form_field_comment'}
        {if (!$field.required && !in_array($field.type, ['radio-buttons', 'checkbox']))}
         {l s='Optional' d='Shop.Forms.Labels'}
        {/if}
      {/block}
    </div> *}
  </div>

{/if}
