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

$(function () {
    if (typeof (tinySetup) != 'undefined') {
        tinySetup({ editor_selector: "rte" });
    } else {
        tinyMCE.init({
            mode: "specific_textareas",
            editor_selector: "rte",
            theme: "advanced",
            skin: "cirkuit",
            plugins: "safari,pagebreak,style,table,advimage,advlink,inlinepopups,media,contextmenu,paste,fullscreen,xhtmlxtras,preview",
            // Theme options
            theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,,|,forecolor,backcolor",
            theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4: "styleprops,|,cite,abbr,acronym,del,ins,attribs,pagebreak",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: false,
            content_css: pathCSS + "global.css",
            document_base_url: ad,
            width: "600",
            height: "auto",
            font_size_style_values: "8pt, 10pt, 12pt, 14pt, 18pt, 24pt, 36pt",
            elements: "nourlconvert,ajaxfilemanager",
            file_browser_callback: "ajaxfilemanager",
            entity_encoding: "raw",
            convert_urls: false,
            language: iso,
        });

        function ajaxfilemanager(field_name, url, type, win) {
            var ajaxfilemanagerurl = ad + "/ajaxfilemanager/ajaxfilemanager.php";
            switch (type) {
                case "image":
                    break;
                case "media":
                    break;
                case "flash":
                    break;
                case "file":
                    break;
                default:
                    return false;
            }
            tinyMCE.activeEditor.windowManager.open({
                url: ajaxfilemanagerurl,
                width: 782,
                height: 440,
                inline: "yes",
                close_previous: "no"
            }, {
                    window: win,
                    input: field_name
            });
        }
    }
});
