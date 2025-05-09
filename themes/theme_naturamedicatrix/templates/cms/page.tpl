{**
* CUSTOM PAGE CMS
 *}
 {extends file='page.tpl'}

 {block name='page_title'}
   {$cms.meta_title}
 {/block}
 
 {block name='page_content_container'}
   <section id="content" class="page-content page-cms page-cms-{$cms.id}">
   {block name='cms_content'}
    {if $cms.id == 7}
        {include file='cms/categories.tpl'}
    {else}
        {$cms.content nofilter}
    {/if}
   {/block}
 
     {block name='hook_cms_dispute_information'}
       {hook h='displayCMSDisputeInformation'}
     {/block}
 
     {block name='hook_cms_print_button'}
       {hook h='displayCMSPrintButton'}
     {/block}
 
   </section>
 {/block}
 