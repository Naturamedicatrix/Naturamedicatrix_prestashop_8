{**
* CUSTOM PAGE GDPR
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  <div class="gdpr-page-layout">
    {include file='customer/_partials/account-left-column.tpl'}
  </div>
{/block}
{* END LEFT COLUMN *}

{block name='page_content_container'}
  {* BREADCRUMB *}
  {* <nav data-depth="2" class="breadcrumb">
    <ol>
      <li>
        <a href="{$urls.base_url}"><span>{l s='Accueil' d='Shop.Theme.Global'}</span></a>
      </li>
      <li>
        <a href="{$link->getPageLink('my-account', true)|escape:'html'}"><span>{l s='Mon compte' d='Shop.Theme.Customeraccount'}</span></a>
      </li>
      <li>
        <span>{l s='RGPD - Données personnelles' mod='psgdpr'}</span>
      </li>
    </ol>
  </nav>

  {block name='page_header_container'}
    {block name='page_title'}
      {include file='_partials/page-title-with-svg.tpl' title={l s='RGPD - Données personnelles' mod='psgdpr'}}
    {/block}
  {/block} *}

  <div class="page_content">
    <div class="col-xs-12 psgdprinfo17 p-0">
      <h2>{l s='Accès à mes données' mod='psgdpr'}</h2>
      <p>{l s='À tout moment, vous avez le droit de récupérer les données que vous avez fournies à notre site. Cliquez sur "Obtenir mes données" pour télécharger automatiquement une copie de vos données personnelles au format PDF ou CSV.' mod='psgdpr'}</p>
      <div class="data-export-buttons">
        <a id="exportDataToCsv" class="btn-secondary psgdprgetdatabtn17 mb-1" target="_blank" href="{$psgdpr_csv_controller|escape:'htmlall':'UTF-8'}">{l s='OBTENIR MES DONNÉES EN CSV' mod='psgdpr'}</a>
        <a id="exportDataToPdf" class="btn-secondary psgdprgetdatabtn17" target="_blank" href="{$psgdpr_pdf_controller|escape:'htmlall':'UTF-8'}">{l s='OBTENIR MES DONNÉES EN PDF' mod='psgdpr'}</a>
      </div>
    </div>
    <div class="col-xs-12 psgdprinfo17 p-0 mt-2">
      <h2>{l s='Demandes de rectification et d\'effacement' mod='psgdpr'}</h2>
      <p>{l s='Vous avez le droit de modifier toutes vos informations personnelles dans la page "Mon compte". Pour toute autre demande concernant la rectification et/ou l\'effacement de vos données personnelles, veuillez nous contacter via notre' mod='psgdpr'} <a href="{$psgdpr_contactUrl|escape:'htmlall':'UTF-8'}">{l s='page de contact' mod='psgdpr'}</a>. {l s='Nous examinerons votre demande et vous répondrons dans les plus brefs délais.' mod='psgdpr'}</p>
    </div>
  </div>

  {literal}
  <script type="text/javascript">
    var psgdpr_front_controller = "{/literal}{$psgdpr_front_controller|escape:'htmlall':'UTF-8'}{literal}";
    var psgdpr_id_customer = "{/literal}{$psgdpr_front_controller|escape:'htmlall':'UTF-8'}{literal}";  
    var psgdpr_ps_version = "{/literal}{$psgdpr_ps_version|escape:'htmlall':'UTF-8'}{literal}";
  </script>
  {/literal}
{/block}
