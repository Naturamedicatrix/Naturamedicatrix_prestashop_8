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
    let previousQuantity = $('#wk_subs_quantity').val();

    if (typeof TouchSpin !== 'undefined') {
        $("#wk_subs_quantity").TouchSpin({
            verticalbuttons: !0,
            verticalupclass: "material-icons touchspin-up",
            verticaldownclass: "material-icons touchspin-down",
            buttondown_class: "btn btn-touchspin js-touchspin",
            buttonup_class: "btn btn-touchspin js-touchspin",
            min: 1,
            max: 1e6
        });
    }

    // Update subscription details
    $(document).on('change', '#wk_subs_quantity', function (e) {
        e.preventDefault();
        if (!displayConfirmMsg()) {
            // Revert the value if user cancels
            $(this).val(previousQuantity).trigger('touchspin.updatesettings');
            return false;
        }
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

    $(document).on('click', '#cancelSubscription', function (e) {
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
        $("#updateSubscriptionDetails").submit();
    });

    $(document).on('click', '#pauseSubscription', function (e) {
        e.preventDefault();
        if ($('#pause_no_of_days').val() == "") {
            $('#pause_error').html(no_of_days_msg);
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
        $("#updateSubscriptionDetails").submit();
    });


    $(document).on('click', '#resumeSubscription', function (e) {
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
        $("#updateSubscriptionDetails").submit();
    });

    $(document).on('click', '#updateFrequency', function (e) {
        e.preventDefault();
        if (!displayConfirmMsg()) {
            return false;
        }
        var form = $("form#updateSubscriptionDetails");
        $('<input>').attr({
            type: 'hidden',
            name: 'frequency_select',
            value: $('#subs_frequency').val()
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'cycle_select',
            value: $('#subs_cycle').val()
        }).appendTo(form);
        $('<input>').attr({
            type: 'hidden',
            name: 'frequencyUpdateSubscription',
            value: 1
        }).appendTo(form);
        $("#updateSubscriptionDetails").submit();
    });

    $(document).on('click', '#deleteSubscription', function (e) {
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
        $("#updateSubscriptionDetails").submit();
    });

    if ($('#subs_frequency').length > 0) {
        if ($('#subs_frequency').val() == '1') {
            updateDailyCycle(daily_cycles);
        }

        if ($('#subs_frequency').val() == '2') {
            updateWeeklyCycle(weekly_cycles);
        }

        if ($('#subs_frequency').val() == '3') {
            updateMonthlyCycle(monthly_cycles);
        }

        if ($('#subs_frequency').val() == '4') {
            updateYearlyCycle(yearly_cycles);
        }

        $(document).on('change', '#subs_frequency', function (e) {
            if ($('#subs_frequency').val() == '1') {
                updateDailyCycle(daily_cycles);
            } else if ($('#subs_frequency').val() == '2') {
                updateWeeklyCycle(weekly_cycles);
            } else if ($('#subs_frequency').val() == '3') {
                updateMonthlyCycle(monthly_cycles);
            } else if ($('#subs_frequency').val() == '4') {
                updateYearlyCycle(yearly_cycles);
            }
        });
    }

    $(document).on("focus", "#pause_no_of_days", function () {
        $("#pause_no_of_days").datepicker({
            showOtherMonths: true,
            dateFormat: 'dd-mm-yy',
            minDate: 1,
        });
    });
});

function displayConfirmMsg() {
    return confirm(confirmMsg);
}

updateDailyCycle = (daily_cycles) => {
    let option = '';
    let daily_cycle = JSON.parse(daily_cycles);
    daily_cycle.forEach(
        function (value, index) {
            if (value == 1) {
                option += `<option value='1'>${everyday_str}</option>`
            }
            if (value == 2) {
                option += `<option value='2'>${every_2_str}</option>`
            }
            if (value == 3) {
                option += `<option value='3'>${every_3_str}</option>`
            }
            if (value == 4) {
                option += `<option value='3'>${every_4_str}</option>`
            }
            if (value == 5) {
                option += `<option value='3'>${every_5_str}</option>`
            }
            if (value == 6) {
                option += `<option value='3'>${every_6_str}</option>`
            }
            $('#subs_cycle').html(option);
        }
    )
}

updateWeeklyCycle = (weekly_cycles) => {
    let option = '';
    let weekly_cycle = JSON.parse(weekly_cycles);
    weekly_cycle.forEach(
        function (value, index) {

            if (value == 1) {
                option += `<option value='1'>${every_week_str}</option>`
            }
            if (value == 2) {
                option += `<option value='2'>${every_2_week_str}</option>`
            }
            if (value == 3) {
                option += `<option value='3'>${every_3_week_str}</option>`
            }
            if (value == 4) {
                option += `<option value='3'>${every_4_week_str}</option>`
            }
            $('#subs_cycle').html(option);
        }
    )
}

updateMonthlyCycle = (monthly_cycles) => {
    let option = '';
    let monthly_cycle = JSON.parse(monthly_cycles);
    monthly_cycle.forEach(
        function (value, index) {
            if (value == 1) {
                option += `<option value='1'>${every_month_str}</option>`
            }
            if (value == 2) {
                option += `<option value='2'>${every_2_month_str}</option>`
            }
            if (value == 3) {
                option += `<option value='3'>${every_3_month_str}</option>`
            }
            if (value == 4) {
                option += `<option value='3'>${every_4_month_str}</option>`
            }
            if (value == 5) {
                option += `<option value='3'>${every_5_month_str}</option>`
            }
            if (value == 6) {
                option += `<option value='3'>${every_6_month_str}</option>`
            }
            $('#subs_cycle').html(option);
        }
    )
}

updateYearlyCycle = (yearly_cycles) => {
    let option = '';
    let yearly_cycle = JSON.parse(yearly_cycles);
    yearly_cycle.forEach(
        function (value, index) {

            if (value == 1) {
                option += `<option value='1'>${every_year_str}</option>`
            }
            if (value == 2) {
                option += `<option value='2'>${every_2_year_str}</option>`
            }
            $('#subs_cycle').html(option);
        }
    )
}
