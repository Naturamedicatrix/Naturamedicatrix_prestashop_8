<div class="{if $page.page_name != 'contact'}bg-wrapper py-24 sm:py-32{/if}">
  <div class="mx-auto section-therap{if $page.page_name != 'contact'} grid gap-20 xl:grid-cols-3 items-center container{/if}">
    <!-- Intro -->
    <div class="max-w-xl{if $page.page_name == 'contact'} mx-auto w-full text-center mb-8{/if}">
      <h3 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-4xl{if $page.page_name == 'contact'} text-center{/if}">Nos scientifiques</h3>
      <p class="mt-6 text-lg/8 text-gray-600">
        Nos conseillers sont à votre disposition pour vous offrir, avec plaisir, un accompagnement de 10 minutes afin de vous informer sur la posologie, l’usage et les indications de nos produits.
      </p>
      <p class="mt-4 text-base text-gray-600">
        Pour des conseils plus personnalisés ou des échanges dépassant les 10 minutes, nous vous invitons à souscrire à notre abonnement <a href="#" class="text-primary underline">consultations avec nos nutrithérapeutes</a>.
      </p>
    </div>

    <!-- Liste des scientifiques -->
    <ul role="list" class="grid gap-x-8 gap-y-12 sm:gap-y-16 xl:col-span-2 pl-0{if $page.page_name != 'contact'} sm:grid-cols-2{else} grid-cols-1 lg:grid-cols-2{/if}">
      <!-- Anthony -->
      <li class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center gap-x-6 mb-4">
          <img class="size-16 w-24 rounded-full object-cover" src="{$urls.child_img_url}therapeutes/anthony_96.jpg" alt="Anthony-Damien Désirée" />
          <div>
            <h4 class="text-base font-semibold text-gray-900">Anthony-Damien Désirée<small>, PhD</small></h4>
            <p class="text-xs text-gray-600">
              Doctorat en Biologie, Biochimie et Physiologie de la Nutrition<br/>
              Université de Bourgogne (France)
            </p>
          </div>
        </div>
        <hr />
        <p class="text-xs text-gray-500 pb-1.5"><i class="bi bi-clock me-1 text-primary"></i> Lundi au vendredi · 14h00 – 16h30</p>
        <div class="flex items-center gap-4 text-sm font-semibold text-gray-900">
          <a href="tel:+33366880234" class="hover:text-primary flex items-center gap-1">
            <i class="bi bi-telephone text-primary"></i> +33 (0)3 66 88 02 34
          </a>
          <a href="tel:+3242900072" class="hover:text-primary flex items-center gap-1">
            <i class="bi bi-telephone text-primary"></i> +32 42 90 00 72
          </a>
        </div>
        <div class="flex items-baseline gap-1 text-sm font-semibold text-gray-900 mt-1.5">
          <i class="bi bi-envelope text-primary"></i>
          <a href="mailto:conseil@naturamedicatrix.zendesk.com" class="hover:text-primary">Contacter par email</a>
          <span class="text-xs text-gray-500 font-normal ms-1">(réponse sous 8 jours ouvrables)</span>
        </div>

      </li>

      <!-- Fabien -->
      <li class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center gap-x-6 mb-4">
          <img class="size-16 w-24 rounded-full object-cover" src="{$urls.child_img_url}therapeutes/fabien_96.jpg" alt="Fabien Piasco" />
          <div>
            <h4 class="text-base font-semibold text-gray-900">Fabien Piasco</h4>
            <p class="text-xs text-gray-600">
              D.E.S.S. Nutrition, U. Laval (Canada)<br/>
              D.U. Nutrition et maladies métaboliques – U. Rennes I<br/>
              Diététicien D.E. – Diplômé en neuro-nutrition (SiiN)
            </p>
          </div>
        </div>
        <hr/>
        <p class="text-xs text-gray-500 pb-1.5"><i class="bi bi-clock me-1 text-primary"></i> Mar : 14h–19h · Jeu : 9h–12h / 13h–19h · Ven : 9h–12h</p>
        <div class="flex items-center gap-4 text-sm font-semibold text-gray-900">
          <a href="tel:+33485440124" class="hover:text-primary flex items-center gap-1">
            <i class="bi bi-telephone text-primary"></i> +33 (0)4 85 44 01 24
          </a>
        </div>
        <div class="flex items-baseline gap-1 text-sm font-semibold text-gray-900 mt-1.5">
          <i class="bi bi-envelope text-primary"></i>
          <a href="mailto:nutrition@naturamedicatrix.fr" class="hover:text-primary">Contacter par email</a>
          <span class="text-xs text-gray-500 font-normal ms-1">(réponse sous 8 jours ouvrables)</span>
        </div>
      </li>
    </ul>
  </div>
</div>
