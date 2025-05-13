{**
** CUSTOM FOOTER
 *}

{* SECTION AVANTAGES *}
<div class="advantages-container">
  <div class="container">
    <div class="advantages-wrapper row">
    {* AVANTAGE 1 - PAIEMENT SÉCURISÉ *}
    <div class="advantage-item col-lg-3 col-md-3 col-sm-6">
      <div class="advantage-icon">
        <i class="bi bi-lock"></i>
      </div>
      <div class="advantage-content">
        <a href="{$link->getCMSLink(3)}#paiement">
          <div class="advantage-title">Paiement sécurisé</div>
          <div class="advantage-text">100% sécurisé</div>
        </a>
      </div>
    </div>

    {* AVANTAGE 2 - LIVRAISON OFFERTE *}
    <div class="advantage-item col-lg-3 col-md-3 col-sm-6">
      <div class="advantage-icon">
        <i class="bi bi-truck"></i>
      </div>
      <div class="advantage-content">
        <a href="#">
          <div class="advantage-title">Livraison offerte</div>
          <div class="advantage-text">à partir de 35€ en Point Relais*</div>
        </a>
      </div>
    </div>

    {* AVANTAGE 3 - PRODUITS CERTIFIÉS *}
    <div class="advantage-item col-lg-3 col-md-3 col-sm-6">
      <div class="advantage-icon">
        <i class="bi bi-trophy"></i>
      </div>
      <div class="advantage-content">
        <a href="{$link->getCMSLink(3)}#produits">
          <div class="advantage-title">Produits certifiés</div>
          <div class="advantage-text">Naturels et de qualité</div>
        </a>
      </div>
    </div>

    {* AVANTAGE 4 - SERVICE CLIENT *}
    <div class="advantage-item col-lg-3 col-md-3 col-sm-6">
      <div class="advantage-icon">
        <i class="bi bi-chat-heart"></i>
      </div>
      <div class="advantage-content">
        <a href="{$urls.pages.contact}">
          <div class="advantage-title">Service client</div>
          <div class="advantage-text">Un problème ? Une question ?</div>
        </a>
      </div>
    </div>
  </div>
  </div>
</div>

{* BLOC TOP FOOTER - VERSION DESKTOP *}
<div class="custom-footer-container desktop-footer container">
  <div class="custom-footer-wrapper row">
    {* BLOC RATING *}
    <div class="footer-rating-block text-center col-lg-3 col-md-3 col-sm-12">
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
    <div class="newsletter-main-block col-lg-6 col-md-6 col-sm-12">
      {hook h='displayFooterBefore'}
    </div>

    {* BLOC RÉSEAUX SOCIAUX *}
    <div class="social-icons-block text-center col-lg-3 col-md-3 col-sm-12">
      <div class="social-title">{l s='Nos réseaux sociaux' d='Shop.Theme.Global'}</div>
      <div class="social-icons">
        <a href="https://www.facebook.com/profile.php?id=61559694586944" target="_blank" rel="noopener noreferrer"
          aria-label="Facebook">
          <i class="bi bi-facebook"></i>
        </a>
        <a href="https://www.instagram.com/naturamedicatrix_/" target="_blank" rel="noopener noreferrer"
          aria-label="Instagram">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.youtube.com/channel/UCLficPRJRt4fuz6xm8v1-oA" target="_blank" rel="noopener noreferrer"
          aria-label="YouTube">
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

    {* BLOC RATING & SOCIAL *}
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
          <a href="https://www.facebook.com/profile.php?id=61559694586944" target="_blank" rel="noopener noreferrer"
            aria-label="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://www.instagram.com/naturamedicatrix_/" target="_blank" rel="noopener noreferrer"
            aria-label="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://www.youtube.com/channel/UCLficPRJRt4fuz6xm8v1-oA" target="_blank" rel="noopener noreferrer"
            aria-label="YouTube">
            <i class="bi bi-youtube"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="footer-container">
  <div class="container">
      {* LIST FOOTER *}
      <div class="footer-columns row">
        <div class="footer-column col-lg-3 col-md-3 col-sm-6 text-center">
          <h4 id="footer-title-1"><span class="natura-light">NATURA</span><span
              class="medicatrix-bold">Medicatrix</span></h4>
          <div class="footer-column-content" id="footer-content-1">
            <address class="footer-address"><strong>Maison mère — Siège social</strong><br>
              22, route des Fagnes<br>
              B-4190 Ferrières<br>
              Belgique</address>
            <p class="footer-tax">TVA : BE0543862766</p>

            <address class="footer-address"><strong>Nos bureaux</strong><br>
              8, Hannert dem Duarref<br>
              L-9772 Troine (Wincrange)<br>
              Grand Duché de Luxembourg</address>
            <p class="footer-tax">TVA : LU26788281<br>
              MATRICULE : 20142414296</p>
          </div>
        </div>

        <div class="footer-column col-lg-3 col-md-3 col-sm-6">
          <h4 id="footer-title-2">Service client</h4>
          <div class="footer-column-content" id="footer-content-2">
            <p class="footer-phone">
              <span class="phone-main">09 77 42 37 04</span>
              🇫🇷
            </p>

            <p class="footer-phone">
              <span class="phone-secondary">+32 42 90 00 79</span>
              🇧🇪
            </p>

            <p class="footer-phone">
              <span class="phone-secondary">+352 27 86 11 39</span>
              🇱🇺
            </p>

            <p class="footer-email">
              <a href="mailto:support@naturamedicatrix.zendesk.com">support@naturamedicatrix.zendesk.com</a>
            </p>

            <div class="footer-contact-btn">
              <a href="{$urls.pages.contact}" class="btn-primary">Contactez-nous</a>
            </div>

            <p class="footer-contact-text">
              Thérapeutes, professionnels de la santé,<br>
              contactez-nous !
            </p>
          </div>
        </div>

        <div class="footer-column col-lg-3 col-md-3 col-sm-6 text-center">
          <h4 id="footer-title-3">Nos magasins partenaires</h4>
          <div class="footer-column-content" id="footer-content-3">
            <p class="footer-stores-intro">
              Nos magasins partenaires ont la plupart de nos produits et seront disponibles pour répondre à toutes vos
              questions.
            </p>

            <div class="footer-store">
              <p class="store-name">NATURAMedicatrix</p>
              <address class="store-address">26 avenue Émile Digneffe, 4000 Liège, Belgique</address>
            </div>

            <div class="footer-store">
              <p class="store-name">Pharmacie Matt Anne-Laure</p>
              <address class="store-address">21 Rue des Jardins, 68110 Illzach, France</address>
            </div>

            <div class="footer-store">
              <p class="store-name">Euro Nutri Santé S.A.</p>
              <address class="store-address">14 rue de la Libération, L-3510 Dudelange, Luxembourg</address>
            </div>

            <div class="footer-stores-btn">
              <a href="{$urls.pages.stores}" class="btn-secondary btn-small">Tous nos magasins partenaires</a>
            </div>
          </div>
        </div>

        <div class="footer-column col-lg-3 col-md-3 col-sm-6">
          <h4 id="footer-title-4">Liens utiles</h4>
          <div class="footer-column-content" id="footer-content-4">
            <ul class="footer-links">
              <li><a href="{$link->getCMSLink(7)}">Catégories</a></li>
              <li><a href="{$urls.pages.new_products}">Nouveautés</a></li>
              <li><a href="{$urls.pages.prices_drop}">Bonnes affaires</a></li>
              <li><a href="{$urls.pages.cms|cat:'/5'}">Catalogues</a></li>
              <li><a href="{$urls.pages.cms|cat:'/6'}">Blog</a></li>
              <li><a href="{$urls.pages.manufacturer}">Nos marques</a></li>
              <li><a href="{$urls.pages.stores}">Points de vente</a></li>
              <li><a href="{$link->getCMSLink(6)}">Offres d'emploi</a></li>
              <li><a href="{$urls.pages.cms|cat:'/8'}">Certificat bio</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>

      {* PAYMENT METHODS AND LINKS ROW *}
      <div class="footer-bottom-row">
        <div class="container">
          <div class="footer-links-payment-wrapper row">
            <div class="footer-bottom-links col-lg-8 col-md-8 col-sm-12">
              <a href="{$link->getCMSLink(3)}" class="footer-bottom-link">{l s='Conditions générales de vente' d='Shop.Theme.Global'}</a>
              <a href="{$link->getCMSLink(2)}" class="footer-bottom-link">{l s='Mentions légales' d='Shop.Theme.Global'}</a>
              <a href="{$link->getCMSLink(3)}#livraison" class="footer-bottom-link">{l s='Livraison, frais de port et retours' d='Shop.Theme.Global'}</a>
              <a href="{$link->getCMSLink(3)}#paiement" class="footer-bottom-link">{l s='Modes de paiement' d='Shop.Theme.Global'}</a>
            </div>
            <div class="footer-payment-logos col-lg-4 col-md-4 col-sm-12">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/alma.svg" alt="Naturamedicatrix Alma" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/bancontact.svg" alt="Naturamedicatrix Bancontact" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/visa.svg" alt="Naturamedicatrix Visa" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/paypal.svg" alt="Naturamedicatrix PayPal" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/mastercard.svg" alt="Naturamedicatrix MasterCard" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/payconiq.svg" alt="Naturamedicatrix Payconiq" class="payment-logo">
              <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/credit_card/applepay.svg" alt="Naturamedicatrix Apple Pay" class="payment-logo">
            </div>
          </div>
        </div>
      </div>

      {* COPYRIGHT *}
      <div class="col-md-12 text-center footer-copyright">
        <p class="text-sm-center pb-0">
          {block name='copyright_link'}
            <span>
              {l s='%copyright% 2009 - %year% NATURA%italictext%. %rights%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©', '%italictext%' => '<i><strong>Medicatrix</strong></i>', '%rights%' => 'Tous droits réservés.'] d='Shop.Theme.Global'}
            </span>
          {/block}
        </p>
      </div>
  </div>
</div>

{hook h='displayFooter'}