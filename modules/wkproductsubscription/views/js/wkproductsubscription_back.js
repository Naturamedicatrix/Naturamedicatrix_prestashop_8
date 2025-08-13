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

$(document).ready(function () {
    $(document).on('change', '#all_combination', function () {
        const isChecked = $(this).is(':checked');
        // Check/uncheck all others except "select all"
        $('input[name="id_product_attribute[]"]').not(this).prop('checked', isChecked);
    });

    $(document).on('change', 'input[name="id_product_attribute[]"]', function () {
        if (this.id === 'all_combination') return;

        const $allCheckboxes = $('input[name="id_product_attribute[]"]').not('#all_combination');
        const $checkedCheckboxes = $allCheckboxes.filter(':checked');

        $('#all_combination')
            .prop('checked', $allCheckboxes.length === $checkedCheckboxes.length)
    });


    if (typeof $.fn.autocomplete !== 'undefined') {
        $("#wk_id_product").autocomplete({
            source: function (request, response) {
                resetProductId();
                $.post(wkajax_url, { 'action': 'getProducts', 'ajax': true, 'query': request.term }, function (data) {
                    if (data === false) {
                        $.growl.error({ message: "No products found!" });
                        $('.ui-menu').hide();
                    } else {
                        response(data);
                    }
                }, 'json');
            },
            minLength: 3,
            select: function (event, ui) {
                $('#id_product').val(ui.item.id_product);
                $('#wksubscription-block').show();
                if (ui.item.attr > 0) {
                    getCombinations(ui.item.id_product);
                }
            }
        });
    }


    // Display daily block
    $('[name="daily_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#daily-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#daily-block').slideDown();
        } else {
            $('#daily-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#daily-block').slideUp();
        }
    });

    // Display weekly block
    $('[name="weekly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#weekly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#weekly-block').slideDown();
        } else {
            $('#weekly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#weekly-block').slideUp();
        }
    });

    // Display monthly block
    $('[name="monthly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#monthly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#monthly-block').slideDown();
        } else {
            $('#monthly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#monthly-block').slideUp();
        }
    });

    // Display yearly block
    $('[name="yearly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#yearly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#yearly-block').slideDown();
        } else {
            $('#yearly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#yearly-block').slideUp();
        }
    });




    // Make payment config form full width
    if ($('.wkPayPamentSetting').length) {
        var formGroups = $('.wkPayPamentSetting').find('.form-group > div');
        formGroups.each(function (i, v) {
            $(v).removeAttr('class');
            $(v).addClass('col-lg-12');
        });
    }
    // Show/Hide one time purchase text
    if (typeof wk_display_otp != 'undefined') {
        if (wk_display_otp == 1) {
            $('[name="WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE"]').parents('.form-group').next().slideDown();
            $('[name="WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE"]').parents('.form-group').next().next().slideDown();
        } else {
            $('[name="WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE"]').parents('.form-group').next().slideUp();
            $('[name="WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE"]').parents('.form-group').next().next().slideUp();
        }
    }
    $('[name="WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE"]').change(function () {
        if (Number($(this).val()) == 1) {
            $(this).parents('.form-group').next().slideDown();
            $(this).parents('.form-group').next().next().slideDown();
        } else {
            $(this).parents('.form-group').next().slideUp();
            $(this).parents('.form-group').next().next().slideUp();
        }
    });

    // Show/Hide one subscription message
    if (typeof wk_display_subs_msg != 'undefined') {
        if (wk_display_subs_msg == 1) {
            $('[name="WK_SUBSCRIPTION_DISPLAY_SUBS_MSG"]').parents('.form-group').next().slideDown();
        } else {
            $('[name="WK_SUBSCRIPTION_DISPLAY_SUBS_MSG"]').parents('.form-group').next().slideUp();
        }
    }
    $('[name="WK_SUBSCRIPTION_DISPLAY_SUBS_MSG"]').change(function () {
        if (Number($(this).val()) == 1) {
            $(this).parents('.form-group').next().slideDown();
        } else {
            $(this).parents('.form-group').next().slideUp();
        }
    });

    // Show/Hide one subscription offer message
    if (typeof wk_display_offer_msg != 'undefined') {
        if (wk_display_offer_msg == 1) {
            $('[name="WK_SUBSCRIPTION_DISPLAY_OFFER_MSG"]').parents('.form-group').next().slideDown();
            $('[name="WK_SUBSCRIPTION_DISPLAY_OFFER_MSG"]').parents('.form-group').next().next().slideDown();
        } else {
            $('[name="WK_SUBSCRIPTION_DISPLAY_OFFER_MSG"]').parents('.form-group').next().slideUp();
            $('[name="WK_SUBSCRIPTION_DISPLAY_OFFER_MSG"]').parents('.form-group').next().next().slideUp();
        }
    }
    $('[name="WK_SUBSCRIPTION_DISPLAY_OFFER_MSG"]').change(function () {
        if (Number($(this).val()) == 1) {
            $(this).parents('.form-group').next().slideDown();
            $(this).parents('.form-group').next().next().slideDown();
        } else {
            $(this).parents('.form-group').next().slideUp();
            $(this).parents('.form-group').next().next().slideUp();
        }
    });
    $('[name="daily_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#daily-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#daily-block').slideDown();
        } else {
            $('#daily-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#daily-block').slideUp();
        }
    });

    // Display weekly block
    $('[name="weekly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#weekly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#weekly-block').slideDown();
        } else {
            $('#weekly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#weekly-block').slideUp();
        }
    });

    // Display monthly block
    $('[name="monthly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#monthly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#monthly-block').slideDown();
        } else {
            $('#monthly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#monthly-block').slideUp();
        }
    });

    // Display yearly block
    $('[name="yearly_frequency"]').change(function () {
        if (Number($(this).val()) == 1) {
            $('#yearly-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#yearly-block').slideDown();
        } else {
            $('#yearly-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#yearly-block').slideUp();
        }
    });


    // Show/Hide email config
    if (typeof wk_send_email != 'undefined') {
        if (wk_send_email == 1) {
            $('[name="WK_SUBSCRIPTION_SEND_EMAIL"]').parents('.form-group').siblings('div.form-group').slideDown();
        } else {
            $('[name="WK_SUBSCRIPTION_SEND_EMAIL"]').parents('.form-group').siblings('div.form-group').slideUp();
        }
    }
    $('[name="WK_SUBSCRIPTION_SEND_EMAIL"]').change(function () {
        if (Number($(this).val()) == 1) {
            $(this).parents('.form-group').siblings('div.form-group').slideDown();
        } else {
            $(this).parents('.form-group').siblings('div.form-group').slideUp();
        }
    });

    // Enable frequency options after enable product for activation
    $('#wk_product_subscription_allow').change(function () {
        if ($(this).is(':checked')) {
            $('#subscription_frequency_block').slideDown();
        } else {
            $('#subscription_frequency_block').slideUp();
        }
    });

    // Display daily block
    $('#wk_product_subscription_daily').change(function () {
        if ($(this).is(':checked')) {
            $('#daily-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#daily-cycle-block').slideDown();
        } else {
            $('#daily-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#daily-cycle-block').slideUp();
        }
    });

    // Display weekly block
    $('#wk_product_subscription_weekly').change(function () {
        if ($(this).is(':checked')) {
            $('#weekly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#weekly-cycle-block').slideDown();
        } else {
            $('#weekly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#weekly-cycle-block').slideUp();
        }
    });

    // Display monthly block
    $('#wk_product_subscription_monthly').change(function () {
        if ($(this).is(':checked')) {
            $('#monthly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#monthly-cycle-block').slideDown();
        } else {
            $('#monthly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#monthly-cycle-block').slideUp();
        }
    });

    // Display yearly block
    $('#wk_product_subscription_yearly').change(function () {
        if ($(this).is(':checked')) {
            $('#yearly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
            $('#yearly-cycle-block').slideDown();
        } else {
            $('#yearly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
            $('#yearly-cycle-block').slideUp();
        }
    });

    $(document).on('change',
        'input[name="weekly_cycles_discount[]"], input[name="daily_cycles_discount[]"], input[name="monthly_cycles_discount[]"], input[name="yearly_cycles_discount[]"]',
        function () {
            if (isNaN($(this).val())) {
                $.growl.error({ message: enter_valid_value });
            }
        });


    $('#submitAddwk_subscription_products, #submitAddwk_subscription_productsAndStay').click(function (e) {
        e.preventDefault();
        var thisVar = $(this);
        $.ajax({
            url: wkajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                ajax: 1,
                action: 'validateForm',
                formData: $('#wksubscription_product_form').serialize()
            },
            success: function (data) {
                if (data.hasError) {
                    let message = '';
                    $.each(data.errors, function (key, msg) {
                        message += msg + "</br>";
                    });
                    $.growl.error({ message: message });
                } else {
                    console.log(thisVar.attr('id'));
                    if (thisVar.attr('id') == 'submitAddwk_subscription_productsAndStay') {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'submitAddwk_subscription_productsAndStay',
                            name: 'submitAddwk_subscription_productsAndStay',
                            value: 1
                        }).appendTo('#wksubscription_product_form');
                    } else {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'submitAddwk_subscription_products',
                            name: 'submitAddwk_subscription_products',
                            value: 1
                        }).appendTo('#wksubscription_product_form');
                    }
                    $('#wksubscription_product_form').submit();
                }
            }
        });
    });


    // Update subscription details
    $('[id^=wk_subs_quantity-]').change(function (e) {
        e.preventDefault();
        if (parseInt($(this).val()) > 0) {
            var form = $("form#updateSubscriptionDetails");
            $('<input>').attr({
                type: 'hidden',
                name: 'updateSubscription',
                value: 1
            }).appendTo(form);
            $("#updateSubscriptionDetails").submit();
        }
    });

    $('[id^=cancelSubscription-]').click(function (e) {
        e.preventDefault();
        if (!displayConfirmMsg()) {
            return false;
        }
        var form = $("form#updateSubscriptionDetails");
        $('<input>').attr({
            type: 'hidden',
            name: 'cancelSubscription',
            value: 1
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'id_subscription',
            value: $(this).data('id')
        }).appendTo(form);
        $("#updateSubscriptionDetails").submit();
    });

    $('[id^=resumeSubscription-]').click(function (e) {
        e.preventDefault();
        if (!displayConfirmMsg()) {
            return false;
        }
        var form = $("form#updateSubscriptionDetails");
        $('<input>').attr({
            type: 'hidden',
            name: 'resumeSubscription',
            value: 1
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'id_subscription',
            value: $(this).data('id')
        }).appendTo(form);
        $("#updateSubscriptionDetails").submit();
    });

    $('[id^=pauseSubscription-]').click(function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let pause_no_of_days = $('#pauseSubscriptionDate-' + id);
        if (pause_no_of_days.val() == "") {
            $.growl.error({ message: no_of_days_msg });
            return false;
        }
        if (!displayConfirmMsg()) {
            return false;
        }
        var form = $("form#updateSubscriptionDetails");
        $('<input>').attr({
            type: 'hidden',
            name: 'pauseSubscription',
            value: 1
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'id_subscription',
            value: $(this).data('id')
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'pause_no_of_days',
            value: pause_no_of_days.val()
        }).appendTo(form);
        $("#updateSubscriptionDetails").submit();
    });

    $('[id^=deleteSubscription-]').click(function (e) {
        e.preventDefault();
        if (!displayConfirmMsg()) {
            return false;
        }
        var form = $("form#updateSubscriptionDetails");
        $('<input>').attr({
            type: 'hidden',
            name: 'deleteSubscription',
            value: 1
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'id_subscription',
            value: $(this).data('id')
        }).appendTo(form);
        $("#updateSubscriptionDetails").submit();
    });
    $(document).on('blur', '#subscription_frequency_block .money-type input', function () {
        var discount = Number($(this).val());
        validateDiscountPercentage(discount, $(this));
    });
    $(document).on('blur', '#wksubscription_product_form .money-type input', function () {
        var discount = Number($(this).val());
        validateDiscountPercentage(discount, $(this));
    });

    $(document).on("focus", "[id^=pauseSubscriptionDate-]", function () {
        $(this).datepicker({
            showOtherMonths: true,
            dateFormat: 'dd-mm-yy',
            minDate: 1,
        });
    });

    if ($('.feature_tr').length > 0) {
        $.ajax({
            'url': wkajax_url,
            'type': 'post',
            'data': {
                'action': 'getModuleFeaturesContent',
                'ajax': true,
                // 'moduleId': moduleId
            },
            success: function (result) {
                if (result != 'false') {
                    var obj = $.parseJSON(result);
                    $.each(obj, function (key, value) {
                        $('.' + value.div_id).html(value.tpl);
                    });
                }
            }
        });
    }
});

function displayConfirmMsg() {
    return confirm(confirmMsg);
}


function validateDiscountPercentage(discount, ele) {
    if (isNaN(discount)) {
        ele.val('0');
    } else {

        if (discount < 0) {
            discount = Math.abs(discount);
            if (discount > 100) {
                discount = 100;
                ele.val(discount);
            } else {
                ele.val(Math.abs(discount));
            }
        } else if (discount > 100) {
            discount = 100;
            $(this).val(discount);
        }
    }
};

function displayConfirmMsg() {
    return confirm(confirmMsg);
}
function getCombinations(id_product) {
    $.ajax({
        'url': wkajax_url,
        'type': 'post',
        'data': {
            'action': 'getCombinations',
            'ajax': true,
            'id_product': id_product
        },
        success: function (result) {
            if (result != 'false') {
                var options = '';

                var obj = $.parseJSON(result);
                // var options = '<option value="all">'+all_comb_txt+'</option>';
                options += '<div> <input type="checkbox" name="id_product_attribute[]" id="all_combination" value="all" /> <label for="all"> ' + all_comb_txt + ' </label> </div>';
                $.each(obj, function (key, value) {
                    options += '<div> <input type="checkbox" name="id_product_attribute[]" id="' + value.id_product_attribute + '" value="' + value.id_product_attribute + '" /> <label for="' + value.id_product_attribute + '"> ' + value.attributes + ' </label> </div>';
                });

                $('#id_product_attribute_checkbox').html(options);
                // $('#id_product_attribute').html(options);
                $('#wksubscription-attr-block').show();
            }
        }
    });
}

function resetProductId() {
    $('#id_product').val('');
    $('#wksubscription-attr-block').hide();
    $('#id_product_attribute').html('<option value="0">' + no_comb_txt + '</option>');
}

hideShowPaymentFeatureInfo = (e) => {
    let id = $(e).attr('module-id');
    if ($(e).val() === '1') {
        $('#info_' + id).show('slow');
    } else {
        $('#info_' + id).hide('slow');
    }
}


