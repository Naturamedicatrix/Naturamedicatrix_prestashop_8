<section class="page-content page-cms page-cms-{$cms.id} mx-auto px-0 mb-0 pb-0 overflow-visible">
 
<div class="flex flex-col lg:flex-row gap-10 items-start mt-8">
  
  <div class="flex-1 space-y-6 mb-12">
    
    <h1 class="text-3xl lg:text-6xl font-extrabold text-gray-900 leading-none lg:max-w-2xl">
      Consultations nutrithérapeutiques
    </h1>

    {block name='cms_content'}    
      <div class="prose prose-lg max-w-none text-gray-600">
        {$cms.content nofilter}
      </div>
    {/block}
    
  </div>

  <div class="flex-1 relative overflow-visible sticky top-10">
      {include file='_partials/consultations-products.tpl'}
  </div>
  
</div>

{include file='_partials/therap.tpl'}
 

 {block name='hook_cms_dispute_information'}
   {hook h='displayCMSDisputeInformation'}
 {/block}

 {block name='hook_cms_print_button'}
   {hook h='displayCMSPrintButton'}
 {/block}

</section>


<style>
  .cms-id-11 .page-header {
    display: none;
  }
  .cms-id-11 .page-footer {
    margin: 0 !important;
  }  
</style>