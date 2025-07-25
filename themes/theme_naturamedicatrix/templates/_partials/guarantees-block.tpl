{**
 * Fichier : guarantees-block.tpl
 * 
 * Description : Bloc des garanties/avantages affiché sur la page d'accueil
 *}

<div class="py-8 mt-6 lg:mt-0 bg-white guarantees-block">

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-left text-gray-600 text-sm">

      <!-- Fabrication européenne -->
      <div class="flex items-center justify-center gap-4">
        <i class="bi bi-globe-europe-africa text-3xl icon-special leading-none"></i>
        <p class="leading-tight mb-0 text-sm">Fabrication<br>européenne</p>
      </div>

      <!-- Respect environnement -->
      <div class="flex items-center justify-center gap-4">
        <i class="bi bi-emoji-wink text-3xl icon-special leading-none"></i>
        <p class="leading-tight mb-0 text-sm">Respect de<br>l'environnement</p>
      </div>

      <!-- Satisfaction clientèle -->
      <div class="flex items-center justify-center gap-4">
        <i class="bi bi-stars text-3xl icon-special leading-none"></i>
        <p class="leading-tight mb-0 text-sm">Satisfaction de<br>notre clientèle</p>
      </div>

      <!-- Conseils personnalisés -->
      <div class="flex items-center justify-center gap-4">
        <i class="bi bi-chat-heart text-3xl icon-special leading-none"></i>
        <p class="leading-tight mb-0 text-sm">Conseils spécialisés<br>et personnalisés</p>
      </div>

    </div>

</div>


<style>
  .guarantees-block i:after {
    width: 25px;
    height: 25px;
  }
</style>
