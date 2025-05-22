{**
 * Fichier : not-found.tpl
 * 
 * Description : Template pour afficher le contenu d'une page "non trouvée" (404)
 * 
 * Ce fichier est utilisé pour afficher le contenu d'une page d'erreur 404. Il est inclus
 * par le fichier 404.tpl et peut également être utilisé dans d'autres contextes où un
 * contenu est introuvable.
 *}
<section id="content" class="page-content page-not-found" style="max-width: 750px;">
  {block name='page_content'}
    {block name="error_content"}
      {if isset($errorContent)}
        {$errorContent nofilter}
      {else}
        <h4>{l s='This page could not be found' d='Shop.Theme.Global'}</h4>
        <p>{l s='Try to search our catalog, you may find what you are looking for!' d='Shop.Theme.Global'}</p>
      {/if}
    {/block}

    {block name='search'}
      {hook h='displaySearch'}
      <div class="text-center mb-4">
        <a href="{$urls.base_url}" class="primary-btn btn mt-0">{l s='Continuer mes achats' d='Shop.Theme.Global'}</a>
      </div>
    {/block}

    {block name='hook_not_found'}
      {hook h='displayNotFound'}
    {/block}
  {/block}
</section>
