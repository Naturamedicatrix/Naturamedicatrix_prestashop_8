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
    // for New product page
    if ($('#product_grid_bulk_action_bulk_delete_ajax').length > 0) {
        $('#product_grid_bulk_action_bulk_delete_ajax').after(wk_catalog_cat_btn);
        $('.adminproducts #main-div .content-div').append(wk_bulk_prod_modal);
        getBulkAssignModal();
    }
    // for old product page
    if ($('.adminproducts .bulk-catalog .dropdown-menu:last-child').length > 0) {
        $('.adminproducts .bulk-catalog .dropdown-menu:last-child').append(wk_catalog_cat_btn);
        if ($('.adminproducts #main-div .content-div .col-sm-12:last-child').length > 0) {
            $('.adminproducts #main-div .content-div .col-sm-12:last-child').append(wk_bulk_prod_modal);
        } else {
            $('.adminproducts #main-div .content-div').append(wk_bulk_prod_modal);
        }
        getBulkAssignModal();
    }
});


$(document).on('click', '#wk_prod_bulk_subscription_assign', function (e) {
    $('.wk-form-errors').hide();
    $('.wk-subs-loader').hide();
    $('#wk_bulk_subscription_modal').modal({
        backdrop: "static",
        keyboard: false
    });
    $('#wk_bulk_subscription_modal').modal('show');
});

$(document).on('click', '.wk_bulk_subscription_modal_cancel', function (e) {
    $('#wk_bulk_subscription_modal').modal('hide');
});

$(document).on('click', '#wk_bulk_subscription_frequency_assign', function (e) {
    $("#form_subscription_errors").html("");
    $('.wk-form-errors').hide();
    $('.wk-subs-loader').show();
    var productIds = [];
    // for old product page
    $('input[name="bulk_action_selected_products[]"]').each(function () {
        if ($(this).prop("checked") == true) {
            productIds.push($(this).val());
        }
    });
    // for New product page
    $('input[name="product_bulk[]"]').each(function () {
        if ($(this).prop("checked") == true) {
            productIds.push($(this).val());
        }
    });

    if (productIds) {
        $.ajax({
            url: wk_assign_subscription_ajax,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                action: 'assignBulkSubscriptions',
                ajax: true,
                idProducts: productIds,
                frequencies: $("#formBulkSubscription").serialize()
            },
            success: function(result) {
                $('.wk-subs-loader').hide();
                if (result.success) {
                    setTimeout(function () {
                        window.location.href = result.url;
                    }, 100)
                    return $.growl.notice({
                        title: "",
                        size: "large",
                        message: result.message
                    });
                } else {
                    var errorMsg = '<ul class="list-unstyled text-danger">';
                    $.each(result.message, function(i, item) {
                        errorMsg += '<li>' + item + '</li>';
                    });
                    errorMsg += '</ul>';
                    $("#form_subscription_errors").html(errorMsg);
                    $('.wk-form-errors').show();
                }
            },
            error: function(xhr) {
                alert(xhr.statusText);
            }
        });
    }
});

$(document).on('blur', '#subscription_frequency_block .money-type input', function() {
    var discount = Number($(this).val());
    if (isNaN(discount)) {
        $(this).val('0');
    } else {
        if (discount < 0) {
            discount = Math.abs(discount);
            if (discount > 100) {
                discount = 100;
                $(this).val(discount);
            } else {
                $(this).val(Math.abs(discount));
            }
        } else if (discount > 100) {
            discount = 100;
            $(this).val(discount);
        }
    }
});
getBulkAssignModal = () => {
    $.ajax({
        url: wk_assign_subscription_ajax,
        type: 'post',
        dataType: 'json',
        cache: false,
        data: {
            action: 'getBulkAssignModal',
            ajax: true
        },
        success: function(result) {
            if (result) {
                $('.wk_subscription_frequency_container').html(result.tpl);
                $('[data-toggle="popover"]').popover();
                initWkBtnEvent();
            }
        },
        error: function(xhr) {
            alert(xhr.statusText);
        }
    });
}

function initWkBtnEvent() {
    // Display daily block
    $("input[name='daily_frequency']").change(function() {
        $('#daily-cycle-block').toggleClass('hide');
        if ($(this).is(':checked')) {
            $('#daily-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
        } else {
            $('#daily-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
        }
    });

    // Display weekly block
    $("input[name='weekly_frequency']").change(function() {
        $('#weekly-cycle-block').toggleClass('hide');
        if ($(this).is(':checked')) {
            $('#weekly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
        } else {
            $('#weekly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
        }
    });

    // Display monthly block
    $("input[name='monthly_frequency']").change(function() {
        $('#monthly-cycle-block').toggleClass('hide');
        if ($(this).is(':checked')) {
            $('#monthly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
        } else {
            $('#monthly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
        }
    });

    // Display yearly block
    $("input[name='yearly_frequency']").change(function() {
        $('#yearly-cycle-block').toggleClass('hide');
        if ($(this).is(':checked')) {
            $('#yearly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', false);
        } else {
            $('#yearly-cycle-block').find('input.js-cycle-checkbox').attr('disabled', true);
        }
    });
}
