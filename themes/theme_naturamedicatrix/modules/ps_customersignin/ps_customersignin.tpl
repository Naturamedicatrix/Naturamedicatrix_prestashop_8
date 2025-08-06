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
     <div class="user-hover-modal user-account-modal">
       <div class="modal-padding">
         <div class="menu-container">
           <a href="{$urls.pages.my_account}" class="account-menu-item">
             <i class="bi bi-person menu-icon"></i>{l s='Mon compte' d='Shop.Theme.Customeraccount'}
           </a>
           <a href="{$urls.pages.identity}" class="account-menu-item">
             <i class="bi bi-person-gear menu-icon"></i>{l s='Mes informations personnelles' d='Shop.Theme.Customeraccount'}
           </a>
           <a href="{$urls.pages.addresses}" class="account-menu-item">
             <i class="bi bi-house-door menu-icon"></i>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}
           </a>
           <a href="{$link->getModuleLink('blockwishlist', 'lists')}" class="account-menu-item">
             <i class="bi bi-heart menu-icon"></i>{l s='Mes listes d\'envies' d='Shop.Theme.Customeraccount'}
           </a>
           <a href="{$link->getModuleLink('ps_emailalerts', 'account')}" class="account-menu-item">
             <i class="bi bi-bell menu-icon"></i>{l s='Mes alertes' d='Shop.Theme.Customeraccount'}
           </a>
           {if $urls.pages.order_slip}
            <a href="{$urls.pages.order_slip}" class="account-menu-item">
              <i class="bi bi-credit-card-2-front menu-icon"></i>{l s='Mes avoirs' d='Shop.Theme.Customeraccount'}
            </a>
            {/if}
            {if $urls.pages.discount}
            <a href="{$urls.pages.discount}" class="account-menu-item">
              <i class="bi bi-percent menu-icon"></i>{l s='Mes bons d\'achat' d='Shop.Theme.Customeraccount'}
            </a>
            {/if}
           <a href="{$urls.pages.history}" class="account-menu-item">
             <i class="bi bi-card-list menu-icon"></i>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}
           </a>
           {if $urls.pages.guest_tracking}
           <a href="{$urls.pages.guest_tracking}" class="account-menu-item">
             <i class="bi bi-search menu-icon"></i>{l s='Suivi de commande' d='Shop.Theme.Customeraccount'}
           </a>
           {/if}
           <hr class="menu-separator">
           <a href="{$urls.actions.logout}" class="account-menu-item btn btn-secondary" rel="nofollow">
             <i class="bi bi-box-arrow-right menu-icon"></i>{l s='Se deconnecter' d='Shop.Theme.Actions'}
           </a>
         </div>
       </div>
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
           {l s='Log in' d='Shop.Theme.Actions'}
         </div>
       </div>
     </a>
     
     <!-- Modal de connexion -->
     <div class="user-hover-modal">
       <div class="modal-padding-large">
         <h3 class="modal-title">
           {l s='Sign in' d='Shop.Theme.Actions'}
         </h3>
         
         <form action="{$urls.pages.authentication}" method="post" class="modal-form">
           <input type="hidden" name="back" value="{$urls.current_url}">
           
           <!-- Email -->
           <div>
             <label for="modal_email" class="modal-label">
               {l s='Email address' d='Shop.Forms.Labels'}*
             </label>
             <input 
               type="email" 
               id="modal_email" 
               name="email" 
               required 
               class="modal-input"
               placeholder="{l s='Email address' d='Shop.Forms.Labels'}"
             >
           </div>
           
           <!-- Mot de passe -->
           <div>
             <label for="modal_password" class="modal-label">
               {l s='Password' d='Shop.Forms.Labels'}
             </label>
             <div class="password-container">
               <input 
                 type="password" 
                 id="modal_password" 
                 name="password" 
                 required 
                 class="modal-input password-input"
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
           </div>
           
           <!-- Lien mot de passe oublié -->
           <div class="forgot-password-container">
             <a href="{$urls.pages.password}" class="forgot-password-link">
               {l s='Forgot your password?' d='Shop.Theme.Customeraccount'}
             </a>
           </div>
           
           <!-- Bouton Se connecter -->
           <button 
             type="submit" 
             name="submitLogin"
             class="btn btn-primary"
           >
             {l s='Sign in' d='Shop.Theme.Actions'}
           </button>
           
           <!-- Bouton Créer un compte -->
           <a 
             href="{$urls.pages.register}?back={$urls.current_url}" 
             class="btn btn-secondary"
           >
             {l s='Create an account' d='Shop.Theme.Customeraccount'}
           </a>
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
 