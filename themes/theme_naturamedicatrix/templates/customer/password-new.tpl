{**
* PAGE NOUVEAU MOT DE PASSE
 *}
 {extends file='page.tpl'}

 {block name='breadcrumb'}{/block}

 {block name='page_title'}
   {l s='Reset your password' d='Shop.Theme.Customeraccount'}
 {/block}
 
 {block name='page_content'}
     <form action="{$urls.pages.password}" method="post">
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
       <section class="form-fields renew-password">
 
         <div class="email">
           {l
             s='Email address: %email%'
             d='Shop.Theme.Customeraccount'
             sprintf=['%email%' => $customer_email|stripslashes]}
         </div>
 
         <div class="container-fluid field-password-policy">
           <div class="row form-group">
             <label class="form-control-label col-md-3 offset-md-2">{l s='New password' d='Shop.Forms.Labels'}</label>
             <div class="col-md-4 js-input-column">
             <input
               class="form-control"
               type="password"
               data-validate="isPasswd"
               name="passwd"
               value=""
               {if isset($configuration.password_policy.minimum_length)}data-minlength="{$configuration.password_policy.minimum_length}"{/if}
               {if isset($configuration.password_policy.maximum_length)}data-maxlength="{$configuration.password_policy.maximum_length}"{/if}
               {if isset($configuration.password_policy.minimum_score)}data-minscore="{$configuration.password_policy.minimum_score}"{/if}
             >
             </div>
           </div>
 
           <div class="row form-group">
             <label class="form-control-label col-md-3 offset-md-2">{l s='Confirmation' d='Shop.Forms.Labels'}</label>
             <div class="col-md-4">
               <input class="form-control" type="password" data-validate="isPasswd" name="confirmation" value="">
             </div>
           </div>
 
           <input type="hidden" name="token" id="token" value="{$customer_token}">
           <input type="hidden" name="id_customer" id="id_customer" value="{$id_customer}">
           <input type="hidden" name="reset_token" id="reset_token" value="{$reset_token}">
 
           <div class="row form-group">
             <div class="offset-md-5">
               <button class="btn btn-primary" type="submit" name="submit">
                 {l s='Change Password' d='Shop.Theme.Actions'}
               </button>
             </div>
           </div>
         </div>
 
       </section>
     </form>
 {/block}
 
 {block name='page_footer'}
   <ul>
     <li><a href="{$urls.pages.authentication}">{l s='Back to Login' d='Shop.Theme.Actions'}</a></li>
   </ul>
 {/block}
 