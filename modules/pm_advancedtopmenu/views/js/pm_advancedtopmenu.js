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

function adtm_isMobileDevice() {
    return (('ontouchstart' in window) || (typeof (document.documentElement) != 'undefined' && 'ontouchstart' in document.documentElement) || (typeof (window.navigator) != 'undefined' && typeof (window.navigator.msMaxTouchPoints) != 'undefined' && window.navigator.msMaxTouchPoints));
}

function adtm_loadDoubleTap() { !function (e) { e.event.special.doubletap = { bindType: "touchend", delegateType: "touchend", handle: function (e) { var a = e.handleObj, t = jQuery.data(e.target), n = (new Date).getTime(), l = t.lastTouch ? n - t.lastTouch : 0, u = null == u ? 300 : u; u > l && l > 50 ? (t.lastTouch = null, e.type = a.origType, ["clientX", "clientY", "pageX", "pageY"].forEach(function (a) { e[a] = e.originalEvent.changedTouches[0][a] }), a.handler.apply(this, arguments)) : t.lastTouch = n } } }(jQuery) }

function adtm_initMenu(isMobile) {
    if (typeof (isMobile) != 'undefined' && isMobile) {
        $("#adtm_menu").addClass('adtm_touch');
        $('#adtm_menu .advtm_menu_toggle').addClass('adtm_menu_mobile_mode');
    } else {
        $("#adtm_menu").removeClass('adtm_touch');
        if (adtm_isToggleMode) {
            $("#adtm_menu").removeClass('adtm_menu_toggle_open');
        }
        $('#adtm_menu .advtm_menu_toggle').removeClass('adtm_menu_mobile_mode');
    }

    // Handle the highlighting of the current tab
    if (typeof (adtm_activeLink) !== 'undefined' && typeof (adtm_activeLink.type) !== 'undefined' && typeof (adtm_activeLink.id) !== 'undefined') {
        activeType = adtm_activeLink.type;
        activeId = new String(adtm_activeLink.id);
        if (typeof (activeType) !== 'undefined'
            && typeof (activeId) !== 'undefined'
            && activeType.length > 0
            && activeId.length > 0
        ) {
            // Remove any previous link with advtm_menu_actif class
            $('#adtm_menu .advtm_menu_actif').removeClass('advtm_menu_actif');

            // Find possible candidate, and apply active state to the first item
            // Priority to level-1 links
            activeCandidates = $('#adtm_menu a.a-niveau1[data-type="' + activeType + '"][data-id="' + activeId + '"], #adtm_menu span.a-niveau1[data-href][data-type="' + activeType + '"][data-id="' + activeId + '"]');
            if (!activeCandidates.length) {
                activeCandidates = $('#adtm_menu a[data-type="' + activeType + '"][data-id="' + activeId + '"], #adtm_menu span[data-href][data-type="' + activeType + '"][data-id="' + activeId + '"]');
            }
            activeCandidate = activeCandidates.first();
            activeCandidate.parents('.li-niveau1').find('.a-niveau1').addClass('advtm_menu_actif');
        }
    }

    // Prevent click
    $('#adtm_menu .adtm_unclickable').on('click', function (e) {
        e.preventDefault();
    });

    $('#adtm_menu span[data-href]').on('click', function () {
        if (typeof (atob) !== 'function' || $(this).hasClass('adtm_unclickable') || $(this).data('href') === '' || $(this).data('href') === '#') {
            return;
        }
        var link = atob($(this).data('href'));
        var target = $(this).attr('target');
        if (typeof (target) != 'undefined' && target.length) {
            window.open(link, target);
        } else {
            window.location.href = link;
        }
    });

    // Set touch mode
    if ((typeof (isMobile) != 'undefined' && isMobile) || adtm_isMobileDevice()) {
        if ($('#adtm_menu .advtm_menu_toggle').is(':visible') || $(adtm_menuHamburgerSelector).is(':visible')) {
            // Menu toggle is visible
            $("#adtm_menu").addClass('adtm_touch');
            adtm_loadDoubleTap();
        } else {
            // Menu toggle is NOT visible (Laptop with touch)
            if ($('#adtm_menu').attr('data-open-method') == 1) {
                $("#adtm_menu").addClass('adtm_touch');
                adtm_loadDoubleTap();
            }
        }
    }

    // Touch devices
    $("#adtm_menu.adtm_touch ul#menu li.li-niveau1").each(function () {
        var li = $(this);
        li.on('mouseover', function () {
            li.data('hoverTime', new Date().getTime());
        });
        li.on('mouseleave', function () {
            li.removeClass("adtm_is_open");
        });
        li.on('mouseout', function () {
            li.removeClass("adtm_is_open");
        });
        li.children('a').on('click', function (e) {
            if (li.hasClass('sub') && !$('#adtm_menu').hasClass('adtm_menu_toggle_open')) {
                if ($('#adtm_menu_inner').hasClass('advtm_open_on_hover')) {
                    if ($('div.adtm_sub', li).css('visibility') == 'hidden') {
                        e.preventDefault();
                        return false;
                    }
                }
            } else if (li.hasClass('sub') && li.hasClass('menuHaveNoMobileSubMenu') && $(this).attr('href') != '' && $(this).attr('href') != '#') {
                window.location = $(this).attr('href');
                e.preventDefault();
                return false;
            } else if (li.hasClass('sub')) {
                $(li).toggleClass('adtm_sub_open');
                $('div.adtm_sub', li).toggleClass('adtm_submenu_toggle_open');
                e.preventDefault();
                return false;
            }
        });
        li.children('a').on('doubletap', function (e) {
            if (li.hasClass('sub') && $(this).attr('href') != '' && $(this).attr('href') != '#') {
                window.location = $(this).attr('href');
            }
            e.preventDefault();
            return false;
        });
    });

    if ($('#adtm_menu:not(.adtm_touch)').attr('data-open-method') == 2) {
        $('#adtm_menu:not(.adtm_touch)').on('mouseenter', function (e) {
            adtm_overState = true;
        }).on('mouseleave', function (e) {
            adtm_overState = false;
            // Remove any previous timeout
            clearTimeout(adtm_overStateTimeout);
            // Set new timeout
            adtm_overStateTimeout = setTimeout(function () {
                // Close sub-menu if menu isn't on mouse over state after 500ms
                if (!adtm_overState) {
                    $("#adtm_menu:not(.adtm_touch) ul#menu li.li-niveau1.atm_clicked").removeClass('atm_clicked');
                }
            }, 500);
        });
    }

    // Non-touch devices
    if (!$('#adtm_menu').hasClass('adtm_menu_toggle_open')) {
        $("#adtm_menu ul#menu li.li-niveau1").each(function () {
            var li = $(this);
            if (li.hasClass('sub')) {
                if ($('#adtm_menu').attr('data-open-method') == 2) {
                    // Open on click
                    li.on('click', function (e) {
                        targetElement = e.toElement || e.relatedTarget || e.target;

                        if (typeof (targetElement) != 'undefined' && $(targetElement).is('.adtm_menu_icon, .advtm_menu_span, .a-niveau1, .li-niveau-1')) {
                            // Follow link if submenu is already open
                            if ($(this).is('.atm_clicked')) {
                                return true;
                            }
                            if ($(li).css('position') != 'relative') {
                                // We must calculate top if it's on line != 1 (responsive case)
                                if ($('#adtm_menu li.li-niveau1:not(.advtm_menu_toggle):visible').offset().top != $(li).offset().top) {
                                    if (typeof ($('div.adtm_sub', li).data('originalTop')) === 'undefined') {
                                        $('div.adtm_sub', li).data('originalTop', parseInt($('div.adtm_sub', li).css('top')));
                                    }
                                    $('div.adtm_sub', li).css('top', $('div.adtm_sub', li).data('originalTop') + $(li).offset().top - $('#adtm_menu li.li-niveau1:not(.advtm_menu_toggle)').offset().top);
                                } else {
                                    $('div.adtm_sub', li).css('top', $('div.adtm_sub', li).data('originalTop'));
                                }
                            }
                            $("#adtm_menu:not(.adtm_touch) ul#menu li.li-niveau1.sub").each(function () {
                                if (li.get(0) != $(this).get(0)) {
                                    $(this).removeClass('atm_clicked');
                                }
                            });
                            $(this).toggleClass('atm_clicked');
                            e.preventDefault();
                            return false;
                        }
                    });
                } else {
                    li.on('mouseenter', function (e) {
                        if ($(li).css('position') != 'relative') {
                            // We must calculate top if it's on line != 1 (responsive case)
                            if ($('#adtm_menu li.li-niveau1:not(.advtm_menu_toggle):visible').offset().top != $(li).offset().top) {
                                if (typeof ($('div.adtm_sub', li).data('originalTop')) === 'undefined') {
                                    $('div.adtm_sub', li).data('originalTop', parseInt($('div.adtm_sub', li).css('top')));
                                }
                                $('div.adtm_sub', li).css('top', $('div.adtm_sub', li).data('originalTop') + $(li).offset().top - $('#adtm_menu li.li-niveau1:not(.advtm_menu_toggle)').offset().top);
                            } else {
                                $('div.adtm_sub', li).css('top', $('div.adtm_sub', li).data('originalTop'));
                            }
                        }
                    });
                }
                li.children('a').on('click', function (e) {
                    if ($('#adtm_menu:not(.adtm_touch) ul#menu li.advtm_menu_toggle').is(':visible') || $('#adtm_menu:not(.adtm_touch) ul#menu li.advtm_menu_toggle').hasClass('adtm_menu_mobile_mode')) {
                        $(li).toggleClass('adtm_sub_open');
                        $('div.adtm_sub', li).toggleClass('adtm_submenu_toggle_open');
                        e.preventDefault();
                        return false;
                    }
                });
                li.children('a').on('dblclick', function (e) {
                    if ($('#adtm_menu:not(.adtm_touch) ul#menu li.advtm_menu_toggle').is(':visible') || $('#adtm_menu:not(.adtm_touch) ul#menu li.advtm_menu_toggle').hasClass('adtm_menu_mobile_mode')) {
                        if ($('#adtm_menu').hasClass('adtm_menu_toggle_open') && li.hasClass('sub') && $(this).attr('href') != '' && $(this).attr('href') != '#') {
                            window.location = $(this).attr('href');
                        }
                        e.preventDefault();
                        return false;
                    }
                });
            }
        });
    }

    // Set event for menu toggle
    $('#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button').off('click').on('click', function (e) {
        $('#adtm_menu').toggleClass('adtm_menu_toggle_open');
        e.preventDefault();
        return false;
    });

    // Set sticky menu
    if ($('#adtm_menu').attr('data-sticky') == 1 && (!isMobile || (isMobile && adtm_stickyOnMobile))) {
        if (typeof ($("#adtm_menu").attr('class')) != 'undefined') {
            originalClasses = ' ' + $("#adtm_menu").attr('class');
        } else {
            originalClasses = '';
        }
        $("#adtm_menu").sticky({
            className: 'adtm_sticky' + originalClasses,
            getWidthFrom: '#adtm_menu_inner',
            zIndex: null
        });
    }
}

if (typeof (adtm_isToggleMode) == 'undefined') {
    var adtm_isToggleMode = true;
}
if (typeof (adtm_menuHamburgerSelector) == 'undefined' || adtm_menuHamburgerSelector == '') {
    var adtm_menuHamburgerSelector = '#menu-icon, .menu-icon';
}

var adtm_overState = false;
var adtm_overStateTimeout;
$(function () {
    // No need to keep this outside, as the even will be fired only while the mode change after a resize of the broswer
    var adtm_responsive = false;
    if (typeof (prestashop) == 'object') {
        if (!adtm_isToggleMode) {
            // Menu icon
            $(adtm_menuHamburgerSelector).on('click', function () {
                $('#adtm_menu').toggleClass('adtm_menu_toggle_open');
                $('#adtm_menu .advtm_menu_toggle').toggleClass('adtm_menu_mobile_mode');
            });
        } else {
            prestashop.on('responsive update', function (event) {
                var adtm_responsive = false;
                if ((typeof (event.mobile) != 'undefined' && event.mobile)) {
                    adtm_responsive = true;
                }
                adtm_initMenu(adtm_responsive);
            });
        }

        adtm_responsive = prestashop.responsive.mobile;
    }

    adtm_initMenu(adtm_responsive);
});
