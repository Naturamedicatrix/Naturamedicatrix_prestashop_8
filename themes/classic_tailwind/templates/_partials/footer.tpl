{**
** CUSTOM FOOTER
 *}

{* SECTION AVANTAGES *}
<div class="advantages-container">
  <div class="advantages-wrapper">
    {* AVANTAGE 1 - PAIEMENT SÉCURISÉ *}
    <div class="advantage-item">
      <div class="advantage-icon">
        <i class="bi bi-lock"></i>
      </div>
      <div class="advantage-content">
        <div class="advantage-title">Paiement sécurisé</div>
        <div class="advantage-text">100% sécurisé</div>
      </div>
    </div>

    {* AVANTAGE 2 - LIVRAISON OFFERTE *}
    <div class="advantage-item">
      <div class="advantage-icon">
        <i class="bi bi-truck"></i>
      </div>
      <div class="advantage-content">
        <div class="advantage-title">Livraison offerte</div>
        <div class="advantage-text">à partir de 35€ en Point Relais*</div>
      </div>
    </div>

    {* AVANTAGE 3 - PRODUITS CERTIFIÉS *}
    <div class="advantage-item">
      <div class="advantage-icon">
        <i class="bi bi-trophy"></i>
      </div>
      <div class="advantage-content">
        <div class="advantage-title">Produits certifiés</div>
        <div class="advantage-text">Naturels et de qualité</div>
      </div>
    </div>

    {* AVANTAGE 4 - SERVICE CLIENT *}
    <div class="advantage-item">
      <div class="advantage-icon">
        <i class="bi bi-chat-heart"></i>
      </div>
      <div class="advantage-content">
        <div class="advantage-title">Service client</div>
        <div class="advantage-text">Un problème ? Une question ?</div>
      </div>
    </div>
  </div>
</div>

{* BLOC TOP FOOTER - VERSION DESKTOP *}
<div class="custom-footer-container desktop-footer">
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
          <i class="bi bi-facebook"></i>
        </a>
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
          <i class="bi bi-youtube"></i>
        </a>
      </div>
    </div>
  </div>
</div>

{* BLOC TOP FOOTER - VERSION MOBILE *}
<div class="custom-footer-container mobile-footer">
  <div class="mobile-footer-wrapper">
    {* BLOC NEWSLETTER *}
    <div class="mobile-newsletter-block">
      {hook h='displayFooterBefore'}
    </div>

    {* BLOC RATING ET RÉSEAUX SOCIAUX CÔTE À CÔTE *}
    <div class="mobile-bottom-row">
      {* BLOC GAUCHE - RATING *}
      <div class="mobile-bottom-left">
        <div class="mobile-rating-value">4,8<span class="mobile-rating-max"> / 5</span></div>
        <div class="mobile-rating-stars">
          <i class="material-icons star-full">star</i>
          <i class="material-icons star-full">star</i>
          <i class="material-icons star-full">star</i>
          <i class="material-icons star-full">star</i>
          <i class="material-icons star-half">star_half</i>
        </div>
      </div>

      {* BLOC DROIT - RÉSEAUX SOCIAUX *}
      <div class="mobile-bottom-right">
        <div class="mobile-social-title">{l s='Nos réseaux sociaux' d='Shop.Theme.Global'}</div>
        <div class="mobile-social-icons">
          <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
            <i class="bi bi-youtube"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

{* Copyright section only *}
<div class="footer-container">
  <div class="container">
    <div class="row">

      {* LIST FOOTER *}
      <div class="footer-columns">
        <div class="footer-column">
          <h4 id="footer-title-1">NATURA<span>Medicatrix</span></h4>
          <div class="footer-column-content" id="footer-content-1">
            <p class="footer-address"><strong>Maison mère / Siège social</strong><br>
            2, route des Fagnes<br>
            B-4190 Ferrières<br>
            Belgique</p>
            <p class="footer-tax">TVA : BE0543862765</p>

            <p class="footer-address"><strong>Nos bureaux</strong><br>
            8, Hannert dem Duarref<br>
            L-9772 Troine (Wincrange)<br>
            Grand Duché du Luxembourg</p>
            <p class="footer-tax">TVA : LU26788289<br>
            MATRICULE : 20142345295</p>
          </div>
        </div>

        <div class="footer-column">
          <h4 id="footer-title-2">Service client</h4>
          <div class="footer-column-content" id="footer-content-2">
            {* Contenu de la colonne 2 *}
          </div>
        </div>

        <div class="footer-column">
          <h4 id="footer-title-3">Nos magasins partenaires</h4>
          <div class="footer-column-content" id="footer-content-3">
            {* Contenu de la colonne 3 *}
          </div>
        </div>

        <div class="footer-column">
          <h4 id="footer-title-4">Liens utiles</h4>
          <div class="footer-column-content" id="footer-content-4">
            {* Contenu de la colonne 4 *}
          </div>
        </div>
      </div>

      <div class="col-md-12 text-center footer-copyright">
        <p class="text-sm-center">
          {block name='copyright_link'}
            <span>
              {l s='%copyright% 2009 - %year% NATURA%italictext%. %rights%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©', '%italictext%' => '<i><strong>Medicatrix</strong></i>', '%rights%' => 'Tous droits réservés.'] d='Shop.Theme.Global'}
            </span>
          {/block}
        </p>
      </div>
    </div>
  </div>
</div>