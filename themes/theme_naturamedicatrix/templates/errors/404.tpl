{**
 * Fichier : 404.tpl
 *}
{extends file='page.tpl'}

{block name="breadcrumb"}{/block}


{block name='page_title'}
  <div class="text-center mb-1 h4">
    <span class="badge-pink">404</span>
  </div>
  Oups... cette page s'est perdue dans la nature
{/block}

{capture assign="errorContent"}
    <div class="text-center">
      <p>La page demandée est introuvable.</p>
      <p class="mb-8">Mais la nature regorge de belles découvertes... Utilisez la recherche ci-dessous pour retrouver votre chemin.</p>
      <p class="mb-1 text-lg font-semibold">Chercher dans notre catalogue</p>
    </div>
{/capture}

{block name='page_content_container'}
  {include file='errors/not-found.tpl' errorContent=$errorContent}
{/block}
