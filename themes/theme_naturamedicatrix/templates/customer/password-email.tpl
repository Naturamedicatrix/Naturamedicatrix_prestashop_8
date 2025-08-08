{**
 * CUSTOM PAGE MOT DE PASSE OUBLIE
 *}
 {extends file='page.tpl'}

 {block name='breadcrumb'}{/block}

 {block name='page_title'}
   {l s='Forgot your password?' d='Shop.Theme.Customeraccount'}
 {/block}
 
 {block name='page_content'}
   <form action="{$urls.pages.password}" class="forgotten-password p-0 max-w-2xl mx-auto" method="post">
 
     <ul class="ps-alert-error">
       {foreach $errors as $error}
         <li class="item">
           <i>
             <svg viewBox="0 0 24 24">
               <path fill="#fff" d="M11,15H13V17H11V15M11,7H13V13H11V7M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20Z"></path>
             </svg>
           </i>
           <p>{$error}</p>
         </li>
       {/foreach}
     </ul>
 
     <header class="text-left">
       <p class="send-renew-password-link text-lg px-0">{l s='Please enter the email address you used to register. You will receive a temporary link to reset your password.' d='Shop.Theme.Customeraccount'}</p>
       <p class="alert alert-info inline-block">{l s='Please check if our message accidentally landed in your junk or spam email folder.' d='Shop.Theme.Actions'}</p>
     </header>
 
      <section class="form-fields w-full">
        <div class="form-group w-96">
          <label for="email" class="w-full text-left text-base text-gray-800 required after:content-['*'] after:text-red-500">{l s='Email address' d='Shop.Forms.Labels'}</label>
          <input type="email" name="email" id="email" value="{if isset($smarty.post.email)}{$smarty.post.email|stripslashes}{/if}" class="w-full border border-gray-300 rounded-md text-base px-4 py-1 h-12 focus:outline-none focus:ring-0 focus:border-gray-700 appearance-none" required>
        </div>
        <div class="form-group-btn">
          <button class="btn primary-btn" name="submit" type="submit">
            {l s='Send' d='Shop.Theme.Actions'}
          </button>
        </div>
      </section>
 
   </form>
 {/block}
 
 {block name='page_footer'}
   <a id="back-to-login" href="{$urls.pages.my_account}" class="account-link no-underline m-0">
     <i class="bi bi-arrow-left"></i> <span class="underline">{l s='Back to login' d='Shop.Theme.Actions'}</span>
   </a>
 {/block}