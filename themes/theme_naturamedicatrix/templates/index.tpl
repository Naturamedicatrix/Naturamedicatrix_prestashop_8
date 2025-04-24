{**
 * Fichier : index.tpl
 * 
 * Description : Template principal pour la page d'accueil
 * Ce fichier étend le template original du thème parent et ajoute des fonctionnalités supplémentaires.
 *}
{extends file='page.tpl'}

{block name='page_content_container'}
  <section id="content" class="page-home">
    {block name='page_content_top'}{/block}

    {block name='page_content'}
      {block name='hook_home'}
        {$HOOK_HOME nofilter}
      {/block}
      
      {* BLOCK DES BRANDS *}
      {block name='featured_brands_home'}
        {include file='_partials/brands-main.tpl'}
      {/block}
      {* END BLOCK DES BRANDS *}
      
    {/block}
  </section>
{/block}
