{**
 * Override du layout-right-column.tpl pour ajuster les tailles des colonnes
 *}
 {extends file='layouts/layout-both-columns.tpl'}

{block name='left_column'}{/block}

{block name='content_wrapper'}
  <div id="content-wrapper" class="js-content-wrapper right-column col-xs-12 col-md-7 col-lg-8">
    {hook h="displayContentWrapperTop"}
    {block name='content'}
      <p>Hello world! This is HTML5 Boilerplate.</p>
    {/block}
    {hook h="displayContentWrapperBottom"}
  </div>
{/block}