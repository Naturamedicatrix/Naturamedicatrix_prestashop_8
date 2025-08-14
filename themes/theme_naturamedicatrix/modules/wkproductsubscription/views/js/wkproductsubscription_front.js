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
    if (prestashop.page.page_name == 'product') {
        if (typeof wkPayPalInstalled != 'undefined' && wkPayPalInstalled) {
            if ($('.wk-subscription-block').length) {
                let ppblock = $('.wk-subscription-block').siblings('.wkstripe_subscribe');
                ppblock.prev('.alert').remove();
                ppblock.remove();
            }
        }
    }
    if (prestashop.page.page_name == 'product') {
        if (typeof wkWepayInstalled != 'undefined' && wkWepayInstalled) {
            if ($('.wk-subscription-block').length) {
                let wepayAlert = $('.wk-subscription-block').siblings('.alert');
                wepayAlert.remove();
            }
        }
    }
    prestashop.on(
        'updateCart',
        function(event) {
            if (typeof event.resp != 'undefined') {
                var response = event.resp;
                if (response.success && $('#wk_subscription_subscribe').is(':checked')) {
                    var subFreq = $('#wkSubscriptionFrequency').find(':selected').val();
                    var subFirstDel = $('#wkFirstDeliveryDate').val();
                    var idSubTemp = $('#id_sub_temp').val();
                    $.ajax({
                        url : wkProdSubsAjaxLink,
                        cache : false,
                        async: false,
                        type: 'POST',
                        dataType: 'json',
                        data : {
                            ajax: true,
                            action: 'addSubscribe',
                            wkSubToken: wkProdSubToken,
                            id_product : response.id_product,
                            id_product_attribute : response.id_product_attribute,
                            id_customization: response.id_customization,
                            frequency: subFreq,
                            delivery_date: subFirstDel,
                            id_sub_temp: idSubTemp,
                            is_subscribe : $('input[name=subscription_plan]:checked').val()
                        },
                        success : function (data) {
                            if (data) {
                                console.log(data);
                            }
                        }
                    });
                }
            }
        }
    );

    prestashop.on(
        'updatedProduct',
        function () {
            initFirstDelDateCalendar();
       }
    );

    prestashop.on(
        'clickQuickView',
        function(event) {
            // Check if Ajax completed
            $(document).ajaxStop(function() {
                // Remove subscription button from quick view popup
                setTimeout(() => {
                    if ((wk_subscribe_show_modal_btn == 0)) {
                        $('div.quickview').find('.wk-subscription-block').remove();
                    }
                    initFirstDelDateCalendar();
                }, 100);
            });
        }
    );

    // GESTION ORIGINALE - Radio buttons
    $(document).on('change', '#wk_subscription_subscribe', function() {
        if ($(this).is(':checked')) {
            $('.wksubscription-options').slideDown();
            // Changement visuel des bordures
            $('.subscription-buy').removeClass('border-gray-200').addClass('border-green-700');
            $('.unique-buy').removeClass('border-green-700').addClass('border-gray-200');
            
            if ($('#id_sub_temp').val()) {
                var subFreq = $('#wkSubscriptionFrequency').find(':selected').val();
                var subFirstDel = $('#wkFirstDeliveryDate').val();
                var idSubTemp = $('#id_sub_temp').val();
                updateSubsTempCart(idSubTemp, subFreq, subFirstDel, 1);
            }
        }
    });

    $(document).on('change', '#wk_subscription_one_time', function() {
        if ($(this).is(':checked')) {
            $('.wksubscription-options').slideUp();
            // Changement visuel des bordures
            $('.unique-buy').removeClass('border-gray-200').addClass('border-green-700');
            $('.subscription-buy').removeClass('border-green-700').addClass('border-gray-200');
            
            if ($('#id_sub_temp').val()) {
                var subFreq = $('#wkSubscriptionFrequency').find(':selected').val();
                var subFirstDel = $('#wkFirstDeliveryDate').val();
                var idSubTemp = $('#id_sub_temp').val();
                updateSubsTempCart(idSubTemp, subFreq, subFirstDel, 0);
            }
        }
    });

    // AJOUT CUSTOM - Gestion des clics sur les cartes .subscription-buy et .unique-buy
    $(document).on('click', '.subscription-buy', function(e) {
        // Empêcher la propagation si on clique sur un élément enfant
        if (!$(e.target).is('input, select, option, label')) {
            $('#wk_subscription_subscribe').prop('checked', true).trigger('change');
        }
    });

    $(document).on('click', '.unique-buy', function(e) {
        // Empêcher la propagation si on clique sur un élément enfant
        if (!$(e.target).is('input, select, option, label')) {
            $('#wk_subscription_one_time').prop('checked', true).trigger('change');
        }
    });

    $(document).on('change', '.wkUpdateTempCart', function() {
        $('.wk-subs-error-msg').html('');
        $('.wk-subs-success-msg').html('');
        var subFreq = $('#wkSubscriptionFrequency').find(':selected').val();
        var subFirstDel = $('#wkFirstDeliveryDate').val();
        var idSubTemp = $('#id_sub_temp').val();

        if (idSubTemp && subFreq && subFirstDel && $('#wk_subscription_subscribe').is(':checked')) {
            updateSubsTempCart(idSubTemp, subFreq, subFirstDel, 1);
        }
    });

    $(document).on('click', '[data-link-action="wk-subscribe-remove-from-cart"]', function(e) {
        e.preventDefault();
        if (confirm(wkSubCartConf)) {
            $.ajax({
                url : wkProdSubsAjaxLink,
                cache : false,
                async: false,
                type: 'POST',
                data : {
                    ajax: true,
                    action: 'removeSubscribe',
                    wkSubToken: wkProdSubToken,
                    id_product : $(this).attr('data-id-product'),
                    id_product_attribute : $(this).attr('data-id-product-attribute'),
                },
                success : function (data) {
                    location.reload();
                }
            });
        } else {
            return false;
        }
    });

    $(document).on('focus', '#wkFirstDeliveryDate', function() {
        initFirstDelDateCalendar();
    });

    $(document).on('click', '[data-link-action="wk-subscribe-get-subscribe"]', function(e) {
        e.preventDefault();
        $.ajax({
            url : wkProdSubsAjaxLink,
            cache : false,
            async: false,
            type: 'POST',
            data : {
                ajax: true,
                action: 'getSubscribe',
                wkSubToken: wkProdSubToken,
                id_product : $(this).attr('data-id-product'),
                id_product_attribute : $(this).attr('data-id-product-attribute'),
            },
            success : function (result) {
                if (result) {
                    if (result.success) {
                        location.reload();
                    }
                }
            }
        });
    });

    if (!$('#wk_subscription_one_time').is(':checked')) {
        var wk_product_subsFreq = $('#wkSubscriptionFrequency').val()
        var wk_sub_productId = $('#product_page_product_id').val();
        var wk_sub_prod_attr = null;
        if ($('[data-product-attribute]').length == 1) {
            wk_sub_prod_attr = $('[data-product-attribute]').val();
        }
        updatePriceOnProductPage(wk_product_subsFreq, wk_sub_productId, wk_sub_prod_attr);
    }

    if (prestashop.page.page_name === 'product') {
        $(document).on('change', '#wkSubscriptionFrequency', function (e) {
            e.preventDefault();
            var wk_product_subsFreq = $(this).val();
            var wk_sub_productId = $('#product_page_product_id').val();
            var wk_sub_prod_attr = null;
            if ($('[data-product-attribute]').length == 1) {
                wk_sub_prod_attr = $('[data-product-attribute]').val();
            }
            updatePriceOnProductPage(wk_product_subsFreq, wk_sub_productId, wk_sub_prod_attr);
        });

        $(document).on('change', '[name="subscription_plan"]', function (e) {
            if($('input[name="subscription_plan"]:checked').val() != 0) {
                var wk_product_subsFreq = $('#wkSubscriptionFrequency').val();
                var wk_sub_productId = $('#product_page_product_id').val();
                var wk_sub_prod_attr = null;
                if ($('[data-product-attribute]').length == 1) {
                    wk_sub_prod_attr = $('[data-product-attribute]').val();
                }
                updatePriceOnProductPage(wk_product_subsFreq, wk_sub_productId, wk_sub_prod_attr);
            } else {
                // location.reload(true);
            }
        });

    }

});

function updatePriceOnProductPage(wk_product_subsFreq, wk_sub_productId, wk_sub_prod_attr, isSubscription = 0) {
    $.ajax({
        url: wkProdSubsAjaxLink,
        dataType: 'json',
        type: 'POST',
        data: {
            ajax: true,
            action: 'getPriceWithSubscription',
            wkSubFreq: wk_product_subsFreq,
            wkSubToken: wkProdSubToken,
            id_product: wk_sub_productId,
            id_product_attribute: wk_sub_prod_attr,
            isSubscription: isSubscription
        },
        success: function (result) {
            if (result.success) {
                $('.current-price').find('span[content]').each(function() {
                    $(this).html(result.wkDiscountedPrice);
                    $(this).attr('content', result.wkDiscountedPrice);
                })
            }
        }
    });
}

function updateSubsTempCart(idSubTemp, subFreq, subFirstDel, is_subscribe) {
    if (idSubTemp > 0) {
        $.ajax({
            url : wkProdSubsAjaxLink,
            cache : false,
            async: false,
            type: 'POST',
            data : {
                ajax: true,
                action: 'updateSubscribe',
                wkSubToken: wkProdSubToken,
                frequency: subFreq,
                delivery_date: subFirstDel,
                id_sub_temp: idSubTemp,
                is_subscribe : is_subscribe
            },
            success : function (data) {
                if (data > 0) {
                    $('.wk-subs-success-msg').html(wkSubCartUpdate).show();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    }
}

function wkTriggerUpdate() {
    var subFreq = $('#wkSubscriptionFrequency').find(':selected').val();
    var subFirstDel = $('#wkFirstDeliveryDate').val();
    var idSubTemp = $('#id_sub_temp').val();

    if (idSubTemp && subFreq && subFirstDel) {
        updateSubsTempCart(idSubTemp, subFreq, subFirstDel, 1);
    }
}

function initFirstDelDateCalendar() {
    var pslocale = prestashop.language.iso_code;
    console.log($.datepicker.regional[pslocale]);
    if (typeof($.datepicker.regional[pslocale]) == 'undefined') {
        pslocale = '';
    }
    $('.wkdatepicker').datepicker({
        minDate: "+"+wkOrderDays+"d",
        maxDate: "+"+parseInt(wkOrderDays + 6)+"d",
        dateFormat: 'yy-mm-dd'
    });
    $.datepicker.setDefaults($.datepicker.regional[pslocale]);
}
