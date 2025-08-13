{**
* CUSTOM PAGE CMS
 *}
 {extends file='page.tpl'}

 {block name='page_title'}
   {$cms.meta_title}
 {/block}
 
 {block name='page_content_container'}
  
    
   {if $cms.id == 11} {* Page consultation *}
 
      {include file='../cms/page-consultations.tpl'}
   
   {elseif $cms.id == 8} {* Page catalogues *}
 
      {include file='../cms/page-catalogues.tpl'}
   
   {else}
    
    <section class="page-content page-cms page-cms-{$cms.id} max-w-4xl mx-auto">
     {block name='cms_content'}    
        {$cms.content nofilter}
     {/block}
 
     {block name='hook_cms_dispute_information'}
       {hook h='displayCMSDisputeInformation'}
     {/block}
 
     {block name='hook_cms_print_button'}
       {hook h='displayCMSPrintButton'}
     {/block}
 
   </section>
    
   {/if}
   
 {/block}
 