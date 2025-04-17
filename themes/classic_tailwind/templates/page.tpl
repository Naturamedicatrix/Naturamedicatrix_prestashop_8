{**
** CUSTOM PAGE
 *}
{extends file=$layout}

{block name='content'}

  <section id="main">

    {block name='page_header_container'}
      {block name='page_title' hide}
        <header class="page-header">
          <h1 class="page-title">{$smarty.block.child}</h1>
          <div class="title-separator">
            <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
              <path class="logo-title"
                d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
            </svg>
          </div>
        </header>
      {/block}
    {/block}

    {block name='page_content_container'}
      <div id="content" class="page-content card card-block">
        {block name='page_content_top'}{/block}
        {block name='page_content'}
          <!-- Page content -->
        {/block}
      </div>
    {/block}

    {block name='page_footer_container'}
      <footer class="page-footer">
        {block name='page_footer'}
          <!-- Footer content -->
        {/block}
      </footer>
    {/block}

  </section>

{/block}