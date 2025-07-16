<section class="py-12">
  <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6 items-center container">
    <div>
      <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">Nos dons humanitaires</h2>
      <p class="text-gray-600">Nous soutenons des projets humanitaires grâce à vos commandes, afin d'apporter une aide concrète dans des zones nécessitant un soutien immédiat et durable.</p>

      <div class="flex items-center space-x-4">
        <img src="{$urls.child_img_url}logo_fondation-jacob.png" alt="Dr Jacob's Foundation" class="h-12 w-auto">
        <img src="{$urls.child_img_url}logo_MSF.png" alt="Médecins Sans Frontières" class="h-8 w-auto">
        <img src="{$urls.child_img_url}logo_Oxfam.png" alt="Oxfam" class="h-8 w-auto">
      </div>
    
    </div>
    
    <a href="{$link->getCMSLink(10)}" title="En savoir plus sur la fondation Dr. Jacob\'s" aria-label="Découvrir Dr Jacob's Foundation" class="relative bg-white rounded-xl shadow overflow-hidden group transform transition-transform duration-300 cursor-pointer">
      <img src="{$urls.child_img_url}fondation-jacobs.jpg" alt="Dr Jacob's Foundation" class="w-full h-64 object-cover rounded-xl group-hover:opacity-75 hover:scale-105 transition-transform duration-300">
      <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-gray-800 to-transparent flex items-end p-4 ">
        <p class="text-white text-lg font-medium mb-0 transition-opacity duration-300">Dr. Jacob's Foundation</p>
      </div>
    </a>
    
    <div class="relative bg-white rounded-xl shadow overflow-hidden">
      <img src="{$urls.child_img_url}don_MSF.webp" alt="Médecins Sans Frontières" class="w-full h-64 object-cover rounded-xl">
      <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-gray-800 to-transparent flex items-end p-4">
        <p class="text-white text-lg font-medium mb-0">Médecins Sans Frontières</p>
      </div>
    </div>
    <div class="relative bg-white rounded-xl shadow overflow-hidden">
      <img src="{$urls.child_img_url}don_Oxfam.webp" alt="Oxfam" class="w-full h-64 object-cover rounded-xl">
      <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-gray-800 to-transparent flex items-end p-4">
        <p class="text-white text-lg font-medium mb-0">Oxfam</p>
      </div>
    </div>
  </div>
</section>