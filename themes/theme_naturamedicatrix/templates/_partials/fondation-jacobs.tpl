<section class="relative h-[500px] sm:h-[600px] md:h-[700px] flex items-center justify-center text-center py-12 sm:py-24 my-24 bg-wrapper">
  <!-- Image de fond -->
  <img src="{$urls.child_img_url}fondation-jacobs.jpg"
       alt="Dr. Jacob's Foundation" class="absolute inset-0 w-full h-full object-cover custom-bg" />

  <!-- Dégradé foncé semi-transparent -->
   <div class="gradient-white-overlay"></div>


  <!-- Texte centré -->
  <div class="relative z-10 px-4 max-w-3xl text-white">
    <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-center">Dr. Jacob's Foundation</h2>
    <p class="font-bold mb-0 text-gray-900 mb-1">
      Notre objectif : des repas à base de plantes pour les personnes dans le besoin
    </p>
    <p class="leading-relaxed mb-1 text-gray-600">
      Les repas sains et végétaux sont 1. plus économiques, 2. plus sains et 3. plus respectueux des animaux et du climat.
      La guerre en Ukraine et la flambée des prix alimentaires laissent des populations du monde entier plus que jamais sous-alimentées.
      Depuis plus de 20 ans, le Dr Jacob, fondateur de la fondation, et Dr Jacob's Medical GmbH soutiennent des projets dans les domaines
      de l'aide alimentaire, du parrainage d'enfants, de la protection du climat et des animaux, et de la santé.
      La fondation est à but non lucratif, ses frais administratifs étant quasiment nuls.
      <br><strong class="block mt-1 font-semibold">Notre devise : un bien durable et efficace.</strong>
    </p>
    <a href="{$link->getCMSLink(10)}" title="En savoir plus sur la fondation Dr. Jacob\'s"
       class="inline-block px-6 bg-white text-gray-900 font-semibold rounded-md shadow hover:bg-gray-100 transition btn btn-primary">
      Lire le projet
    </a>
  </div>
</section>


<style>
    .gradient-white-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.6));
      backdrop-filter: blur(4px);
      z-index: 1;
    }
    
    .custom-bg {
      object-position: center 20%;
    }
</style>