{**
 * Override du template contactform.tpl pour le thème enfant
 *}

<section class="contact-form">
  <form action="{$urls.pages.contact|escape:'htmlall':'UTF-8'}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if}>

    {if $notifications}
      <div class="notification {if $notifications.nw_error}notification-error{else}notification-success{/if}">
        <ul>
          {foreach $notifications.messages as $notif}
            <li>{$notif|escape:'htmlall':'UTF-8'}</li>
          {/foreach}
        </ul>
      </div>
    {/if}

    {if !$notifications || $notifications.nw_error}
      <section class="form-fields">

        <div class="form-group">
          <label for="id_contact">{l s='Objet de la demande' d='Modules.Contactform.Shop'}</label>
          <select name="id_contact" id="id_contact" class="form-control">
            {foreach from=$contact.contacts item=contact_elt}
              <option value="{$contact_elt.id_contact|escape:'htmlall':'UTF-8'}">{$contact_elt.name}</option>
            {/foreach}
          </select>
        </div>

        <div class="form-group">
          <label for="name">{l s='Nom' d='Modules.Contactform.Shop'}*</label>
          <input type="text" id="name" name="name" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="email">{l s='Adresse email' d='Modules.Contactform.Shop'}*</label>
          <input type="email" id="email" name="from" class="form-control" value="{$contact.email|escape:'htmlall':'UTF-8'}" required />
        </div>

        {if $contact.orders}
          <div class="form-group">
            <label for="id_order">{l s='Référence commande' d='Modules.Contactform.Shop'}*</label>
            <select name="id_order" id="id_order" class="form-control" required>
              <option value="">{l s='Sélectionnez une référence' d='Modules.Contactform.Shop'}</option>
              {foreach from=$contact.orders item=order}
                <option value="{$order.id_order|escape:'htmlall':'UTF-8'}">{$order.reference|escape:'htmlall':'UTF-8'}</option>
              {/foreach}
            </select>
          </div>
        {/if}


        <div class="form-group">
          <label for="message">{l s='Message' d='Modules.Contactform.Shop'}*</label>
          <textarea id="message" name="message" class="form-control" rows="6" required>{if $contact.message}{$contact.message|escape:'htmlall':'UTF-8'}{/if}</textarea>
        </div>
        
        {hook h='displayGDPRConsent' id_module=$id_module}

      </section>

      <footer class="form-footer">
        <style>
          input[name=url] {
            display: none !important;
          }
        </style>
        <input type="text" name="url" value=""/>
        <input type="hidden" name="token" value="{$token|escape:'htmlall':'UTF-8'}" />
        <button type="submit" name="submitMessage" class="primary-btn btn">
          {l s='Envoyer' d='Modules.Contactform.Shop'}
        </button>
      </footer>
    {/if}
  </form>
</section>
