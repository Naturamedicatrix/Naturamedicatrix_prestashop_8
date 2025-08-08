{**
** CUSTOM MODULE SIGN IN WITH HOVER MODAL
 *}

 <div class="user-info m-0 text-left relative">
 {if $customer.is_logged}
   <!-- Utilisateur connecté -->
   <div class="user-hover-group">
     <a href="{$urls.pages.my_account}" class="flex items-end gap-2 text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out" rel="nofollow">
       <i class="bi bi-person-check text-2xl leading-0"></i>
       <div class="infos text-sm leading-tight">
         <div class="text-xs leading-tight opacity-90">
           {l s='My account' d='Shop.Theme.Customeraccount'}
         </div>
         <div class="text-base leading-none font-semibold">
           {$customer.firstname} {$customer.lastname|truncate:2:"."}
         </div>
       </div>
     </a>
     
     <!-- Menu déroulant pour utilisateur connecté -->
     <div class="user-hover-modal user-account-modal p-8 pt-4 w-104">
         <a href="{$urls.pages.my_account}" class="h-12 flex items-center text-gray-600 hover:text-brand transition duration-500 ease-in-out">
           <i class="bi bi-person icon-special menu-icon leading-0 mr-1"></i>{l s='Mon compte' d='Shop.Theme.Customeraccount'}
         </a>
         <a href="{$urls.pages.identity}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand hover:border-brand-900 transition duration-500 ease-in-out">
           <i class="bi bi-person-gear icon-special menu-icon leading-0 mr-1"></i>{l s='Mes informations personnelles' d='Shop.Theme.Customeraccount'}
         </a>
         <a href="{$urls.pages.addresses}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
           <i class="bi bi-house-door icon-special menu-icon leading-0 mr-1"></i>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}
         </a>
         {if $urls.pages.guest_tracking}
           <a href="{$urls.pages.history}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
             <i class="bi bi-card-list icon-special menu-icon leading-0 mr-1"></i>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}
           </a>
         {/if}
         <a href="{$link->getModuleLink('blockwishlist', 'lists')}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
           <i class="bi bi-clipboard-heart icon-special menu-icon leading-0 mr-1"></i>{l s='Mes favoris' d='Shop.Theme.Customeraccount'}
         </a>
         <a href="{$link->getModuleLink('ps_emailalerts', 'account')}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
           <i class="bi bi-bell icon-special menu-icon leading-0 mr-1"></i>{l s='Mes alertes' d='Shop.Theme.Customeraccount'}
         </a>
          {if $urls.pages.discount}
          <a href="{$urls.pages.discount}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
            <i class="bi bi-percent icon-special menu-icon leading-0 mr-1"></i>{l s='Mes bons d\'achat' d='Shop.Theme.Customeraccount'}
          </a>
          {/if}
          {if $urls.pages.order_slip}
          <a href="{$urls.pages.order_slip}" class="h-12 flex items-center border-brand-50 border-t text-gray-600 hover:text-brand transition duration-500 ease-in-out">
            <i class="bi bi-credit-card-2-front icon-special menu-icon leading-0 mr-1"></i>{l s='Mes avoirs' d='Shop.Theme.Customeraccount'}
          </a>
          {/if}
          
         
         <a href="{$urls.actions.logout}" class="btn btn-secondary w-full mt-1" rel="nofollow">
           <i class="bi bi-power menu-icon leading-0 mr-1.5"></i>{l s='Se déconnecter' d='Shop.Theme.Customeraccount'}
         </a>
     </div>
   </div>
 {else}
   <!-- Utilisateur non connecté -->
   <div class="user-hover-group">
     <a href="{$urls.pages.authentication}?back={$urls.current_url}" class="flex items-end gap-2 text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out" rel="nofollow">
       <i class="bi bi-person text-2xl leading-0"></i>
       <div class="infos text-sm leading-tight">
         <div class="text-xs leading-tight opacity-90">
           {l s='My account' d='Shop.Theme.Customeraccount'}
         </div>
         <div class="text-base leading-none font-semibold">
           {l s='Log in' d='Shop.Theme.Customeraccount'}
         </div>
       </div>
     </a>
     
     <!-- Modal de connexion -->
     <div class="user-hover-modal w-104 overflow">
        <h4 class="modal-title bg-gray-50 p-3.5">
           {l s='Already have an account?' d='Shop.Theme.Customeraccount'}
        </h4>
       <div class="p-8 pt-0">
         
         <form action="{$urls.pages.authentication}" method="post" class="modal-form">
           <input type="hidden" name="back" value="{$urls.current_url}">
           
           <!-- Email -->
           <div class="flex flex-col mb-4 mt-0">
             <label for="modal_email" class="modal-label text-left text-base text-gray-800 required after:content-['*'] after:text-red-500">
               {l s='Email address' d='Shop.Forms.Labels'}
             </label>
             <input 
              type="email" 
               id="modal_email" 
               name="email" 
               required 
               class="modal-input w-full border border-gray-300 rounded-md text-base px-4 py-1 h-12 focus:outline-none focus:ring-0 focus:border-gray-700 appearance-none"
               placeholder="{l s='Email address' d='Shop.Forms.Labels'}"
             >
           </div>
           
           <!-- Mot de passe -->
           <div class="flex flex-col mt-0 mb-4">
             <label for="modal_password" class="modal-label text-left text-base text-gray-800 required after:content-['*'] after:text-red-500">
               {l s='Password' d='Shop.Forms.Labels'}
             </label>
             <div class="password-container">
               <input 
                type="password" 
                 id="modal_password" 
                 name="password" 
                 required 
                 class="modal-input password-input w-full border border-gray-300 rounded-md text-base px-4 py-1 h-12 focus:outline-none focus:ring-0 focus:border-gray-700 appearance-none"
                 placeholder="{l s='Password' d='Shop.Forms.Labels'}"
               >
               <button 
                type="button" 
                 class="password-toggle"
                 onclick="togglePassword('modal_password')"
               >
                 <i class="bi bi-eye" id="modal_password_icon"></i>
               </button>
             </div>
             
             <!-- Lien mot de passe oublié -->
             <div class="forgot-password-container text-right text-sm mt-1.5 text-gray-600">
               <a href="{$urls.pages.password}" class="forgot-password-link underline">
                 {l s='Forgot your password?' d='Shop.Theme.Customeraccount'}
               </a>
             </div>
             
           </div>
           
           
           <div class="flex flex-col gap-2">
             <!-- Bouton Se connecter -->
             <button 
              type="submit" 
               name="submitLogin"
               class="btn btn-primary w-full"
             >
               {l s='Sign in' d='Shop.Theme.Customeraccount'}
             </button>
             
             <!-- Bouton Créer un compte -->
             <a 
               href="{$urls.pages.register}?back={$urls.current_url}" 
               class="btn btn-secondary w-full"
             >
               {l s='Create an account' d='Shop.Theme.Customeraccount'}
             </a>
           </div>
           
         </form>
       </div>
     </div>
   </div>
 {/if}
 </div>
 
 <script>
 function togglePassword(fieldId) {
   const field = document.getElementById(fieldId);
   const icon = document.getElementById(fieldId + '_icon');
   
   if (field.type === 'password') {
     field.type = 'text';
     icon.className = 'bi bi-eye-slash';
   } else {
     field.type = 'password';
     icon.className = 'bi bi-eye';
   }
 }
 </script>
 
 
 
<style>
  #header .user-account-modal a {
    color: #4b5563;
  }
  
   #header .user-account-modal a:hover {
     color: #487595;
   }
</style>
 