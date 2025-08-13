/**
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License version 3.0
* that is bundled with this package in the file LICENSE.txt
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/AFL-3.0
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to a newer
* versions in the future. If you wish to customize this module for your needs
* please refer to CustomizationPolicy.txt file inside our module for more information.
*
* @author Webkul IN
* @copyright Since 2010 Webkul
* @license https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
*/

$(document).ready(function() {
    if (wkStripeInstalled) {
        $('#payment-confirmation button').click(function(e) {
            e.preventDefault();
            var stripeSelected = $('.payment-options').find("input[data-module-name='wkstripepayment']").is(':checked');
            if (stripeSelected) {
                $.ajax({
                    url : wkProdSubsAjaxLink,
                    cache : false,
                    async: false,
                    type: 'POST',
                    data : {
                        ajax: true,
                        action: 'addStripeProductPlan',
                        wkSubToken: wkProdSubToken,
                    },
                    success : function (data) {
                        console.log(data);
                    }
                });
            }
        });
    }

    if (wkAdyenInstalled) {
        $('#payment-confirmation button').click(function(e) {
            e.preventDefault();
            var adyenSelected = $('.payment-options').find("input[data-module-name='psadyenpayment']").is(':checked');
            if (adyenSelected) {
                $.ajax({
                    url : wkProdSubsAjaxLink,
                    cache : false,
                    async: false,
                    type: 'POST',
                    data : {
                        ajax: true,
                        action: 'addAdyenProductPlan',
                        wkSubToken: wkProdSubToken,
                    },
                    success : function (data) {
                        console.log(data);
                    }
                });
            }
        });
    }

    if (wkWepayInstalled) {
        $('#payment-confirmation button').click(function(e) {
            e.preventDefault();
            var wePaySelected = $('.payment-options').find("input[data-module-name='wkwepay']").is(':checked');
            if (wePaySelected) {
                $.ajax({
                    url : wkProdSubsAjaxLink,
                    cache : false,
                    async: false,
                    type: 'POST',
                    data : {
                        ajax: true,
                        action: 'addWepayProductPlan',
                        wkSubToken: wkProdSubToken,
                    },
                    success : function (data) {
                        console.log(data);
                    }
                });
            }
        });
    }
});
