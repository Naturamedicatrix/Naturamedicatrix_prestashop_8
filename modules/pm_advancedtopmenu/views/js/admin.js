/**
 *
 * Advanced Top Menu
 *
 * @author Presta-Module.com <support@presta-module.com>
 * @copyright Presta-Module
 *
 *           ____     __  __
 *          |  _ \   |  \/  |
 *          | |_) |  | |\/| |
 *          |  __/   | |  | |
 *          |_|      |_|  |_|
 *
 ****/

// Override the default path to the admin images for the native color picker on 1.7.X
if (typeof (baseDir) !== 'undefined') {
    $.fn.mColorPicker.defaults.imageFolder = baseDir + 'img/admin/';
}

function showMenuType(e, type) {
    var val = $(e).val();
    if (type == 'menu') {
        var parent = $(e).parents('.form-group').parent('#blocMenuForm');
    } else if (type == 'column') {
        var parent = $(e).parents('.form-group').parent('#blocColumnForm');
    } else if (type == 'element') {
        var parent = $(e).parents('.form-group').parent('#blocElementForm');
    }

    $(parent).children('.menu_element').hide(0, function () {
        if (val == '1') {
            $(parent).children('.add_cms, .add_title, .prevent_click, .add_image').show();
        } else if (val == '2') {
            $(parent).children('.add_link, .add_title, .prevent_click, .add_image').show();
        } else if (val == '3') {
            $(parent).children('.add_category, .add_title, .prevent_click, .add_image').show();
        } else if (val == '4') {
            $(parent).children('.add_manufacturer, .add_title, .prevent_click, .add_image').show();
        } else if (val == '5') {
            $(parent).children('.add_supplier, .add_title, .prevent_click, .add_image').show();
        } else if (val == '6') {
            $(parent).children('.add_title, .prevent_click, .add_image').show();
        } else if (val == '7') {
            $(parent).children('.add_link, .prevent_click, .add_image').show();
        } else if (val == '8') {
            $(parent).children('.add_product_settings').show();
        } else if (val == '9') {
            $(parent).children('.add_specific_page, .add_title, .prevent_click, .add_image').show();
        } else if (val == '10') {
            $(parent).children('.add_cms_category, .add_title, .prevent_click, .add_image').show();
        }
    });
}
function showColumnSelect(e, selected) {
    var val = $(e).val();
    if (typeof (selected) !== 'undefined') {
        $("#column_select > div").load(base_config_url, { actionColumn: 'get_select_columns', id_menu: val, column_selected: selected });
    } else {
        $("#column_select > div").load(base_config_url, { actionColumn: 'get_select_columns', id_menu: val });
    }
}
function showColumnWrapSelect(e, selected) {
    var val = $(e).val();
    if (typeof (selected) != 'undefined') {
        $("#columnWrap_select > div").load(base_config_url, { actionColumn: 'get_select_columnsWrap', id_menu: val, columnWrap_selected: selected });
    } else {
        $("#columnWrap_select > div").load(base_config_url, { actionColumn: 'get_select_columnsWrap', id_menu: val });
    }
}
function hideNextIfTrue(e) {
    var val = parseInt($(e).val());
    var nextDiv = $(e).parents('.form-group').parent().find('.hideNextIfTrue');
    if (val) {
        nextDiv.slideUp('fast');
    } else {
        nextDiv.slideDown('fast');
    }
}
function showSpanIfChecked(e, idToShow) {
    var val = $(e).prop('checked');
    if (val) {
        $(idToShow).show();
    } else {
        $(idToShow).hide();
    }
}
var queue = false;
var next = false;
function show_info(id, content) {
    if (queue) { next = new Array(id, content); return; }
    queue = true;
    if ($('#' + id).is("div") === false)
        $('body').append('<div id="' + id + '" class="info_screen ui-state-hover"></div>');
    else return
    $('#' + id).html(content);
    $('#' + id).slideDown('slow');

    setTimeout(function () { $('#' + id).slideUp('slow', function () { $('#' + id).remove(); queue = false; if (next) { show_info(next[0], next[1]); next = false; } }) }, 2000);
}
function saveOrderElement(elementsOrder) {
    $.post(base_config_url, { columnElementsPosition: elementsOrder }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
    });
}
function saveElementChange(idGroup, idElement, orderElements, callback) {
    $.post(base_config_url, { elementChange: idElement, idGroup: idGroup, columnElementsPosition: orderElements }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
        if (typeof (callback) === 'function') {
            callback();
        }
    });
}
function saveOrderColumnWrap(orderColumnWrap) {
    $.post(base_config_url, { columnWrapPosition: orderColumnWrap }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
    });
}
function saveOrderColumn(orderColumn) {
    $.post(base_config_url, { columnPosition: orderColumn }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
    });
}
function saveGroupChange(idColumn, idGroup, orderColumn, callback) {
    $.post(base_config_url, { groupChange: idGroup, idColumn: idColumn, orderColumn: orderColumn }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
        if (typeof (callback) === 'function') {
            callback();
        }
    });
}
function setUnclickable(e) {
    var val = $(e).prop('checked');
    if (val) {
        $('.adtmInputLink').val('#');
    } else {
        $('.adtmInputLink').val('');
    }
}
function saveOrderMenu(orderMenu) {
    $.post(base_config_url, { menuPosition: orderMenu }, function (data) {
        // Use PS native function to display growl notifications, if available
        if (typeof (showSuccessMessage) === 'function') {
            showSuccessMessage(data);
        } else {
            show_info('saveorder', data);
        }
    });
}
$(function () {
    $("#menu-tab").tabs({
        cache: false,
        show: false,
        hide: false
    });
    $("#menu-tab .ui-tabs-nav").sortable({
        // axis: "x",
        delay: 300,
        handle: '.menu-dragHandler',
        update: function (event, ui) {
            saveOrderMenu($(this).sortable('toArray', { attribute: 'unique-id' }).join(','));
        }
    });
    $('.pmFaIconPicker').each(function () {
        $(this).iconpicker({
            iconset: 'fontawesome5',
            icon: ($(this).parents('.iconSelectorContainer').find('input.hiddenIconInput[type="hidden"]').val() !== 'empty' ? $(this).parents('.iconSelectorContainer').find('input.hiddenIconInput[type="hidden"]').val() : ''),
            search: true,
            footer: false,
            cols: 6,
            rows: 6,
            searchText: pmAtmTranslatedIconSearchLabel,
        });
    });
    $('.pmMiIconPicker').each(function () {
        $(this).iconpicker({
            iconset: 'materialdesign',
            icon: ($(this).parents('.iconSelectorContainer').find('input.hiddenIconInput[type="hidden"]').val() !== 'empty' ? $(this).parents('.iconSelectorContainer').find('input.hiddenIconInput[type="hidden"]').val() : ''),
            search: true,
            footer: false,
            cols: 6,
            rows: 6,
            searchText: pmAtmTranslatedIconSearchLabel,
        });
    });

    $('.pmFaIconPicker,.pmMiIconPicker').on('change', function (e) {
        // Update the corresponding lang input with the selected icon's class
        $(this).parents('.iconSelectorContainer').find('input.hiddenIconInput[type="hidden"]').val(e.icon);

        var idLang = $(this).data('id-lang');
        // Update the button label if an icon has been picked or removed
        if (e.icon === 'empty') {
            $('#iconPickingButton_' + idLang).find('span').text($('#iconPickingButton_' + idLang + ' button').data('empty-label'));
            $('#iconPickingButton_' + idLang).find('i').removeClass();
        } else {
            $('#iconPickingButton_' + idLang).find('span').text($('#iconPickingButton_' + idLang + ' button').data('picked-label'));
        }

        // Make sure to append the proper class for MI icons
        if (e.icon.match(/^zmdi.+$/)) {
            $('#iconPickingButton_' + idLang).find('i').removeClass().addClass('zmdi ' + e.icon);
        } else {
            $('#iconPickingButton_' + idLang).find('i').removeClass().addClass(e.icon);
        }
        // Close the modal after selection
        $('.iconModal').modal('hide');
    });

    $('select.iconLibrary').on('change', function () {
        if ($(this).val() === 'fa') {
            $(this).parents('.iconSelectorContainer').find('.faSelector').show();
            $(this).parents('.iconSelectorContainer').find('.miSelector').hide();
        } else {
            $(this).parents('.iconSelectorContainer').find('.miSelector').show();
            $(this).parents('.iconSelectorContainer').find('.faSelector').hide();
        }
    });

    // Listen for the icon picking modal opening to automatically display the proper lang input
    $('#iconPickingModal,#columnIconPickingModal,#elementIconPickingModal').on('show.bs.modal', function (e) {
        var selectedLang = parseInt($(e.relatedTarget).data('id-lang'));
        $('.iconSelectorContainer:not(.iconSelector_' + selectedLang + ')').hide();
        $('.iconSelector_' + selectedLang).show();

        // Handle initial value
        if ($('.iconSelector_' + selectedLang).find('input[name="lib_icon_' + selectedLang + '"]').val().length > 0) {
            if ($('.iconSelector_' + selectedLang).find('input[name="lib_icon_' + selectedLang + '"]').val().match(/^zmdi.+$/)) {
                $('.iconSelector_' + selectedLang).find('select.iconLibrary').val('mi');
                $('.iconSelector_' + selectedLang).find('.miSelector').show();
                $('.iconSelector_' + selectedLang).find('.faSelector').hide();
            } else {
                $('.iconSelector_' + selectedLang).find('select.iconLibrary').val('fa');
                $('.iconSelector_' + selectedLang).find('.faSelector').show();
                $('.iconSelector_' + selectedLang).find('.miSelector').hide();
            }
        } else {
            // Else, simply make sure that only FA is visible
            $('.iconSelector_' + selectedLang).find('.faSelector').show();
            $('.iconSelector_' + selectedLang).find('.miSelector').hide();
        }
    });
    $('#iconPickingModal,#columnIconPickingModal,#elementIconPickingModal').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });

    $('div#addons-rating-container p.dismiss a').on('click', function () {
        $('div#addons-rating-container').hide(500);
        $.ajax({ type: "GET", url: window.location + '&dismissRating=1' });
        return false;
    });

    $('.elementsContainer').sortable({
        delay: 300,
        handle: '.dragWrap',
        connectWith: '.elementsContainer',
        // Use this and not 'cancel' to to avoid the heading tr from being moved at all
        items: 'tr:not(.nodrag)',
        update: function (event, ui) {
            // Verify that the container hasn't changed to only trigger an order change,
            // otherwise it will be handled by receive as its a column change
            if ($(ui.item).parents('.menuColumn').data('id') == $(ui.item).data('id-column')) {
                var elementsOrder = $(this).sortable('toArray', { attribute: 'data-id' }).join(",");
                saveOrderElement(elementsOrder);
            }
        },
        receive: function (event, ui) {
            var newColumnId = parseInt($(event.target).parents('.menuColumn').data('id'));
            var elementId = parseInt($(ui.item).data('id'));
            var orderColumn = $(this).sortable("toArray").join(",");

            saveElementChange(newColumnId, elementId, orderColumn, function () {
                $(ui.item).data('id-column', newColumnId);
            });
        }
    });
    $(".columnWrapSort").sortable({
        placeholder: "ui-state-highlight",
        delay: 300,
        handle: '.dragWrap',
        update: function (event, ui) {
            var orderColumn = $(this).sortable('toArray', { attribute: 'unique-id' });
            saveOrderColumnWrap(orderColumn.join(','));
        }
    });
    $('.ajax_script_load').on('click', function () {
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            dataType: "script"
        });
        return false;
    });
    $('input[name="tinymce_container_toggle_menu"]').on('change', function () {
        if ($(this).val() == 1)
            $(this).parents('.form-group').next('.tinymce_container').show();
        else
            $(this).parents('.form-group').next('.tinymce_container').hide();
    });
    // Toogle button
    if ($('input[name="ATM_RESP_TOGGLE_ENABLED"]:checked').val() == 0) {
        $('#formMobileGlobal_pm_advancedtopmenu .resp_toggle').hide();
    }
    $('input[name="ATM_RESP_TOGGLE_ENABLED"]').on('change', function () {
        if ($(this).val() == 1) {
            $('#formMobileGlobal_pm_advancedtopmenu .resp_toggle').show();
        } else {
            $('#formMobileGlobal_pm_advancedtopmenu .resp_toggle').hide();
        }
    });
    // End Toggle button
    // Enable sticky on mobile section
    if ($('select[name="ATM_MENU_CONT_POSITION"]').val() !== 'sticky') {
        $('#formMobileGlobal_pm_advancedtopmenu .mobile_sticky').hide();
    }
    $('select[name="ATM_MENU_CONT_POSITION"]').on('change', function () {
        if ($(this).val() === 'sticky') {
            $('#formMobileGlobal_pm_advancedtopmenu .mobile_sticky').show();
        } else {
            $('#formMobileGlobal_pm_advancedtopmenu .mobile_sticky').hide();
        }
    });
    // End sticky on mobile section
    if ($('#id_product_search').length > 0) {
        atm_ajaxProductListUrl = 'index.php?controller=AdminProducts&ajax=1&action=productsList&excludeIds=0,';
        if (typeof (atm_token) != 'undefined' && atm_token.length) {
            atm_ajaxProductListUrl += '&token=' + atm_token;
        }

        $('#id_product_search').autocomplete(atm_ajaxProductListUrl, {
            minChars: 1,
            autoFill: true,
            max: 20,
            matchContains: true,
            mustMatch: true,
            scroll: false,
            cacheLength: 0,
            formatItem: function (item) {
                return item[0] + ' - ' + item[1];
            }
        }).result(atm_setProductId);
    }
    $('select[name="privacy"]').each(function () {
        $(this).on('change', function () {
            val = $(this).find('option:selected').val();
            if (val == 3) {
                $(this).parents('.form-group').next('.privacy.chosen_groups').show();
            } else {
                $(this).parents('.form-group').next('.privacy.chosen_groups').hide();
            }
        });
    });
});

function atm_setProductId(event, data, formatted) {
    if (data == null) {
        return false;
    }
    var productId = parseInt(data[1]);
    var productName = data[0];
    $('.add_product_settings input#id_product_search').val('');
    $('.add_product_settings span#current_product_name').html(productName);
    $('.add_product_settings input[name=id_product]').val(productId);
}

function setMenuContHook(value) {
    if (value == 'top') {
        $('div#atm_theme_compatibility_mode-field').show();
    } else {
        $('div#atm_theme_compatibility_mode-field').hide();
    }
}
