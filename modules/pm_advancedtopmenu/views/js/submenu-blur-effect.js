/**
 * Submenu blur effect for Advanced Top Menu
 * Adds a blur effect on the #wrapper element when a submenu is displayed
 */
$(document).ready(function() {
  // Aucun besoin de créer ou positionner un overlay, nous appliquons le flou directement sur #wrapper

  // Handle mouse enter on menu items with submenus
  $('#adtm_menu ul#menu li.li-niveau1.sub').on({
    mouseenter: function() {
      if (!$('#adtm_menu').hasClass('adtm_touch') && !$('#adtm_menu').hasClass('adtm_menu_toggle_open')) {
        $('body').addClass('submenu-open');
      }
    },
    mouseleave: function() {
      if (!$('#adtm_menu').hasClass('adtm_touch') && !$('#adtm_menu').hasClass('adtm_menu_toggle_open')) {
        // Small delay to avoid flickering when moving between menu items
        setTimeout(function() {
          if (!$('#adtm_menu ul#menu li.li-niveau1.sub:hover').length) {
            $('body').removeClass('submenu-open');
          }
        }, 50);
      }
    }
  });

  // Handle click events for touch devices or click mode
  $('#adtm_menu.adtm_touch ul#menu li.li-niveau1.sub > a, #adtm_menu[data-open-method="2"] ul#menu li.li-niveau1.sub').on('click', function() {
    // Toggle submenu open class
    if ($(this).closest('.li-niveau1').hasClass('adtm_sub_open') || 
        $(this).closest('.li-niveau1').hasClass('atm_clicked')) {
      $('body').addClass('submenu-open');
    } else {
      $('body').removeClass('submenu-open');
    }
  });

  // Fermer les sous-menus en cliquant en dehors
  $('#wrapper').on('click', function(e) {
    // Vérifier si le clic n'est pas sur un élément du menu
    if (!$(e.target).closest('#adtm_menu').length && $('body').hasClass('submenu-open')) {
      $("#adtm_menu ul#menu li.li-niveau1.atm_clicked").removeClass('atm_clicked');
      $("#adtm_menu ul#menu li.li-niveau1.adtm_sub_open").removeClass('adtm_sub_open');
      $('body').removeClass('submenu-open');
    }
  });
});
