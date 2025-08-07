{**
 * Override du template contactform.tpl pour le thème enfant
 *}

<section class="contact-form">
  <form action="{$urls.pages.contact|escape:'htmlall':'UTF-8'}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if}>

    {if $notifications}
      <div class="p-4 mb-6 {if $notifications.nw_error}bg-red-100 text-red-700 border-l-4 border-red-500{else}bg-green-100 text-green-700 border-l-4 border-green-500{/if} rounded-md">
        <ul>
          {foreach $notifications.messages as $notif}
            <li>{$notif|escape:'htmlall':'UTF-8'}</li>
          {/foreach}
        </ul>
      </div>
    {/if}

    {if !$notifications || $notifications.nw_error}
      <section class="form-fields w-full">

        <div class="flex flex-col mb-6 mt-4">
          <label class="text-left font-bold text-base required after:content-['*'] after:ml-0.5 after:text-red-500" for="id_contact">{l s='Objet de la demande' d='Modules.Contactform.Shop'}*</label>
          <div class="js-input-column">
            <select name="id_contact" id="id_contact" class="w-100 sm:w-full border border-gray-300 rounded-md px-4 text-base focus:outline-none focus:border-black">
              {foreach from=$contact.contacts item=contact_elt}
                <option value="{$contact_elt.id_contact|escape:'htmlall':'UTF-8'}" class="text-black">{$contact_elt.name}</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="flex flex-col mb-6 mt-4">
          <label class="text-left font-bold text-base required after:content-['*'] after:ml-0.5 after:text-red-500" for="name">{l s='Nom' d='Modules.Contactform.Shop'}*</label>
          <div class="js-input-column">
            <input type="text" id="name" name="name" class="w-100 sm:w-full border border-gray-300 rounded-md px-4 py-2 text-base h-12 focus:outline-none focus:border-black" required />
          </div>
        </div>

        <div class="flex flex-col mb-6 mt-4">
          <label class="text-left font-bold text-base required after:content-['*'] after:ml-0.5 after:text-red-500" for="email">{l s='Adresse email' d='Modules.Contactform.Shop'}*</label>
          <div class="js-input-column">
            <input type="email" id="email" name="from" class="w-100 sm:w-full border border-gray-300 rounded-md px-4 py-2 text-base h-12 focus:outline-none focus:border-black" value="{$contact.email|escape:'htmlall':'UTF-8'}" required />
          </div>
        </div>

        {if $contact.orders}
          <div class="flex flex-col mb-6 mt-4">
            <label class="text-left font-bold text-base required after:content-['*'] after:ml-0.5 after:text-red-500" for="id_order">{l s='Référence commande' d='Modules.Contactform.Shop'}<span class="text-gray-700 font-normal ml-1.5 text-sm">({l s='optionnel' d='Modules.Contactform.Shop'})</span></label>
            <div class="js-input-column">
              <select name="id_order" id="id_order" class="w-100 sm:w-full border border-gray-300 rounded-md px-4 py-4 text-base h-12 focus:outline-none focus:border-black bg-white">
                <option value="" disabled selected class="text-gray-500">{l s='Sélectionnez une référence' d='Modules.Contactform.Shop'}</option>
                {foreach from=$contact.orders item=order}
                  <option value="{$order.id_order|escape:'htmlall':'UTF-8'}" class="text-black">{$order.reference|escape:'htmlall':'UTF-8'}</option>
                {/foreach}
              </select>
            </div>
          </div>
        {/if}


        <div class="flex flex-col mb-0 mt-4">
          <label class="text-left font-bold text-base required after:content-['*'] after:ml-0.5 after:text-red-500" for="message">{l s='Message' d='Modules.Contactform.Shop'}</label>
          <div class="js-input-column">
            <textarea id="message" name="message" class="w-100 sm:w-full border border-gray-300 rounded-md px-4 py-6 text-base focus:outline-none focus:ring-primary focus:border-black" rows="6" required>{if $contact.message}{$contact.message|escape:'htmlall':'UTF-8'}{/if}</textarea>
          </div>
        </div>
        
        {hook h='displayGDPRConsent' id_module=$id_module}

      </section>

      <footer class="form-footer mt-6">
        <style>
          input[name=url] {
            display: none !important;
          }
        </style>
        <input type="text" name="url" value=""/>
        <input type="hidden" name="token" value="{$token|escape:'htmlall':'UTF-8'}" />
        <button type="submit" name="submitMessage" class="btn btn-primary">
          {l s='Envoyer' d='Modules.Contactform.Shop'}
        </button>
      </footer>
    {/if}
  </form>
</section>
