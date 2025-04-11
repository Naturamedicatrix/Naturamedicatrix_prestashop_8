{**
** CUSTOM FOOTER
 *}
{* BLOC TOP FOOTER *}
<div class="custom-footer-container">
  <div class="custom-footer-wrapper">
    {* BLOC RATING *}
    <div class="footer-rating-block">
      <div class="rating-value">4,8<span class="rating-max"> / 5</span></div>
      <div class="rating-stars">
        <i class="material-icons star-full">star</i>
        <i class="material-icons star-full">star</i>
        <i class="material-icons star-full">star</i>
        <i class="material-icons star-full">star</i>
        <i class="material-icons star-half">star_half</i>
      </div>
    </div>
    
    {* BLOC NEWSLETTER *}
    <div class="newsletter-main-block">
      {hook h='displayFooterBefore'}
    </div>
    
    {* BLOC RÉSEAUX SOCIAUX *}
    <div class="social-icons-block">
      <div class="social-title">{l s='Nos réseaux sociaux' d='Shop.Theme.Global'}</div>
      <div class="social-icons">
        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
          <i class="fa-brands fa-youtube"></i>
        </a>
      </div>
    </div>
  </div>
</div>

{* BLOC MENU FOOTER *}
<div class="footer-container">
  <div class="container">
    <div class="row">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
    </div>
    <div class="row">
      {block name='hook_footer_after'}
        {hook h='displayFooterAfter'}
      {/block}
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="text-sm-center">
          {block name='copyright_link'}
            <a href="https://www.prestashop-project.org/" target="_blank" rel="noopener noreferrer nofollow">
              {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
            </a>
          {/block}
        </p>
      </div>
    </div>
  </div>
</div>
