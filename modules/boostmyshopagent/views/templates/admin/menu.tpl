{**
 * 2007-2023 boostmyshop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @copyright 2007-2023 boostmyshop
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div>
    <div id="tabs-id">
      <div class="w-full bg-app bg-white bg-cover bg-no-repeat">
      <div class="max-w-6xl mx-auto p-4">
      <div class="w-full">
  
        <div class="flex justify-between mt-4 mb-8 lg:mb-16">
          <div class="flex items-center space-x-4">
            <img src="https://academy.boostmyshop.com/_next/image?url=%2F_next%2Fstatic%2Fimage%2Fpublic%2Fstatic%2Fsvg%2FFrFlag.3b5e19f703e4054dd9ef935003077b87.svg&w=48&q=75" class="cursor-pointer" alt="French" onclick="langtranslate('fr')" />
            <img src="https://academy.boostmyshop.com/_next/image?url=%2F_next%2Fstatic%2Fimage%2Fpublic%2Fstatic%2Fsvg%2FEnFlag.4bef43c892675c9dcccb1a8b77521959.svg&w=48&q=75" class="cursor-pointer" alt="English" onclick="langtranslate('en')" />
          </div>
          
          <div class="flex justify-end items-center space-x-2">
            <a target="_parent" href='{$configLink|escape:'htmlall':'UTF-8'}' class="text-center text-grey-8 px-6 py-2 border-2 border-white bg-grey-2 focus:ring-2 rounded-lg focus:ring-grey-4 hover:shadow-md hover:bg-grey-3 cursor-pointer">
              <div data-translate="configure"></div>
            </a>
            <button onClick="window.open('https://sso.boostmyshop.com/auth/realms/boostmyshop/protocol/openid-connect/auth?client_id=boostmyshop-app&redirect_uri=https%3A%2F%2Fapp.boostmyshop.com%2Fen%2Fhome%3Ftab%3Dmyads&state=d7bdcf92-08bf-4e12-8762-5330a49b58e1&response_mode=fragment&response_type=code&scope=openid&nonce=d547e6ed-0608-40d6-8a27-440785d58edc&kc_action=login&ui_locales=en','_blank')" class="text-center text-white px-6 py-2 border-2 border-white bg-geekBlue-6 rounded-lg focus:ring-2 focus:ring-geekBlue-6 hover:shadow-md hover:bg-geekBlue-5 cursor-pointer">
              <div data-translate="login"></div>
            </button>
          </div>
        </div>
  
        <div class="text-center mb-8">
          <h1 class="text-2xl md:text-4xl font-medium"><div data-translate="home_title"></div></h1>
          <div class="text-md mt-4 md:text-lg text-grey-6 mx-auto max-w-lg" data-translate="home_subtitle"></div>
        </div>
  
        <ul class="flex mt-8 mb-0 list-none flex-wrap flex-row">
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-lg font-bold px-5 py-4 rounded-lg block leading-normal border-2 border-geekBlue-6 text-myful bg-white cursor-pointer" onclick="changeAtiveTab(event,'tab-profile')">
              <div class="aspect-w-16 aspect-h-2"><img src="https://www.boostmyshop.com/media/misc/H_100%20myF.svg"/></div>
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-lg font-bold px-5 py-4 rounded-lg block leading-normal border-2 border-geekBlue-2 text-mypricing bg-white cursor-pointer" onclick="changeAtiveTab(event,'tab-settings')">
              <div class="aspect-w-16 aspect-h-2"><img src="https://www.boostmyshop.com/media/misc/H_100%20myP.svg"/></div>
            </a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-lg font-bold px-5 py-4 rounded-lg block leading-normal border-2 border-geekBlue-2 text-myads bg-white cursor-pointer" onclick="changeAtiveTab(event,'tab-options')">
              <div class="aspect-w-16 aspect-h-2"><img src="https://www.boostmyshop.com/media/misc/H_100%20myAds.svg"/></div>
            </a>
          </li>
        </ul>
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mt-2 mb-6 border-2 border-geekBlue-2 shadow-lg rounded-lg">
          <div>
            <div class="tab-content tab-space">
              <div class="block" id="tab-profile">
               <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 md:p-8">
                 <div class="md:w-1/2 max-w-md">
                   <h1 class="text-2xl font-medium"><div data-translate="myF_title"></div></h1>
                   <div class="mt-4 text-lg text-grey-8" data-translate="myF_subtitle"></div>
                   <button onClick="window.open('https://app.boostmyshop.com/en/demo?tab=myfulfillment','_blank')" class="mt-4 text-center text-white text-lg px-6 py-2 font-medium rounded-md border-2 border-white bg-geekBlue-6 focus:ring-2 focus:ring-geekBlue-6 hover:shadow-md hover:bg-geekBlue-5"><div data-translate="myF_btn"></div></button>
                 </div>
                 <div class="md:w-1/2 mt-6 md:mt-0">
                  <div class="aspect-w-16 aspect-h-9">
                    <embed id="myF_video" src="" class="rounded-lg shadow-lg" title="YouTube video player" wmode="transparent type="video/mp4" width="100%" height="100%" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></embed>
                  </div>
                </div>
               </div>
              </div>
              <div class="hidden" id="tab-settings">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 md:p-8">
                  <div class="md:w-1/2 max-w-md">
                    <h1 class="text-2xl font-medium"><div data-translate="myP_title"></div></h1>
                    <div class="mt-4 text-lg text-grey-8" data-translate="myP_subtitle"></div>
                    <button onClick="window.open('https://app.boostmyshop.com/en/demo?tab=pricing','_blank')" class="mt-4 text-center text-white text-lg px-6 py-2 font-medium rounded-md border-2 border-white bg-geekBlue-6 focus:ring-2 focus:ring-geekBlue-6 hover:shadow-md hover:bg-geekBlue-5"><div data-translate="myP_btn"></div></button>
                  </div>
                  <div class="md:w-1/2 mt-6 md:mt-0">
                   <div class="aspect-w-16 aspect-h-9">
                     <embed id="myP_video" src="" class="rounded-lg shadow-lg" title="YouTube video player" wmode="transparent type="video/mp4" width="100%" height="100%" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></embed>
                   </div>
                 </div>
                </div>
              </div>
              <div class="hidden" id="tab-options">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 md:p-8">
                  <div class="md:w-1/2 max-w-md">
                    <h1 class="text-2xl font-medium"><div data-translate="myAds_title"></div></h1>
                    <div class="mt-4 text-lg text-grey-8" data-translate="myAds_subtitle"></div>
                    <button onClick="window.open('https://app.boostmyshop.com/en/demo?tab=campaigns','_blank')" class="mt-4 text-center text-white text-lg px-6 py-2 font-medium rounded-md border-2 border-white bg-geekBlue-6 focus:ring-2 focus:ring-geekBlue-6 hover:shadow-md hover:bg-geekBlue-5"><div data-translate="myAds_btn"></div></button>
                  </div>
                  <div class="md:w-1/2 mt-6 md:mt-0">
                   <div class="aspect-w-16 aspect-h-9">
                     <embed id="myAds_video" src="" class="rounded-lg shadow-lg" title="YouTube video player" wmode="transparent type="video/mp4" width="100%" height="100%" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></embed>
                   </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        </div>
      </div>
    </div>
    </div>
  </div>

  <script>
      (function() {
        window.dictionary = {
          'configure': {
              'en': 'Configure',
              'fr': 'Configurer',
          },
          'language': {
              'en': 'Change language',
              'fr': 'Changer de langue',
          },
          'login': {
              'en': 'Login',
              'fr': 'Se connecter',
          },
          'home_title': {
              'en': 'The solution for ecommerce professionals.',
              'fr': 'La solution des professionnels du e‑commerce',
          },
          'home_subtitle': {
              'en': 'Discover the Boostmyshop solution that facilitates and improves your ecommerce management.',
              'fr': 'Découvrez la solution Boostmyshop qui facilite et améliore votre gestion e‑commerce.',
          },
          'myF_title': {
              'en': 'Manage your entire ecommerce logistics with a single interface.',
              'fr': 'Pilotez toute la logistique de votre e‑commerce depuis une seule interface.',
          },
          'myF_subtitle': {
              'en': 'Optimising warehouses and order management has never been so simple. Our unique SaaS interface meets all your needs.',
              'fr': "Optimiser la gestion de vos entrepôts et de vos commandes n'a jamais été aussi simple. Notre interface unique accessible en SaaS répond à tous vos besoins.",
          },
          'myF_btn': {
              'en': 'Discover myFulfillment',
              'fr': "Découvrir myFulfillment",
          },
          'myP_title': {
              'en': 'Automate your competitive positioning and the management of your catalogue prices.',
              'fr': 'Automatisez votre positionnement concurrentiel et la gestion de vos prix catalogue.',
          },
          'myP_subtitle': {
              'en': 'Adjust your prices on all your sales channels, optimise your competitiveness without impacting your margins? Our repricing tool can do it, and much more.',
              'fr': "Ajuster vos prix sur tous vos canaux de vente, optimiser votre compétitivité sans impacter vos marges ? Notre outil de repricing peut le faire, et bien plus encore.",
          },
          'myP_btn': {
              'en': 'Discover myPricing',
              'fr': "Découvrir myPricing",
          },
          'myAds_title': {
              'en': 'To infinity and beyond!',
              'fr': 'Vers l’infini et au-delà !',
          },
          'myAds_subtitle': {
              'en': "Accelerate your customer acquisition while securing your margins? It's possible thanks to our automated solution to manage your Google Ads.",
              'fr': "Accélérer votre acquisition client tout en sécurisant vos marges ? C'est possible grâce à notre solution automatisée pour gérer vos publicités Google Ads.",
          },
          'myAds_btn': {
              'en': 'Discover myAds',
              'fr': "Découvrir myAds",
          },
        };  
        
        langtranslate("en");  
      })()
      
      function langtranslate(current_lang) {
        dictionary = window.dictionary;
          $("[data-translate]").each(function(){
              var key = $(this).data('translate');
              $(this).html(dictionary[key][current_lang] || "N/A");
          });
          $(document).ready(function(){
              var myF_video = $('#myF_video');
              current_MyF_video = (current_lang == "fr") ? "https://www.youtube.com/embed/T24A_1jd0a8" : "https://www.youtube.com/embed/p3RSLtVq_CE"; 
              myF_video.attr('src', current_MyF_video );
          });
          $(document).ready(function(){
              var myP_video = $('#myP_video');
              current_MyP_video = (current_lang == "fr") ? "https://www.youtube.com/embed/Hp0thosLAS4" : "https://www.youtube.com/embed/wR48-DEWrU0"; 
              myP_video.attr('src', current_MyP_video );
          });
          $(document).ready(function(){
              var myAds_video = $('#myAds_video');
              current_MyAds_video = (current_lang == "fr") ? "https://www.youtube.com/embed/FG5mqL-jLqs" : "https://www.youtube.com/embed/zm1-3WTjgy4"; 
              myAds_video.attr('src', current_MyAds_video );
          });
      }
     
    </script>

    <script type="text/javascript">
      function changeAtiveTab(event,tabID){
        let element = event.target;
        while(element.nodeName !== "A"){
          element = element.parentNode;
        }
        ulElement = element.parentNode.parentNode;
        aElements = ulElement.querySelectorAll("li > a");
        tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
        for(let i = 0 ; i < aElements.length; i++){
          aElements[i].classList.remove("border-geekBlue-6");
          aElements[i].classList.add("bg-white");
          aElements[i].classList.add("border-geekBlue-2");
          tabContents[i].classList.add("hidden");
          tabContents[i].classList.remove("block");
          
          element.classList.remove("bg-white");
          element.classList.remove("border-geekBlue-2");
          element.classList.add("border-geekBlue-6");
          element.classList.add("bg-white");
          document.getElementById(tabID).classList.remove("hidden");
          document.getElementById(tabID).classList.add("block");
        }
      }
    </script>
  </div>