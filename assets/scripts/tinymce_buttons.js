/**
 * Created by aino on 20.7.2017.
 */
(function() {

    function getLinkModalHtml() {
        return '<div data-remodal-id="modal" class="klab_addImageLinksModal">' +
            '<h1>Adds shortlink for link with image</h1>' +
            '<p>Will be generated into image + link on the web page</p>' +
            '<label for="klab_image_title_in_media_library">Image title in media library: </label>' +
            '<input name="klab_image_title_in_media_library" id="klab_image_title_in_media_library" type=text /><br/>' +
            '<label for="klab_link_text">Link text: </label>' +
            '<input name="klab_link_text" id="klab_link_text" type=text /><br/>' +
            '<label for="klab_link_url">Link url: </label>' +
            '<input name="klab_link_url" id="klab_link_url" type=text /><br/>' +
            '<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>' +
            '<button data-remodal-action="confirm" class="remodal-confirm" id = "klab_addImageLink">Add</button>' +
            '</div>';
    }

    function getNewsLinkModalHtml() {
        return '<div data-remodal-id="modal" class="klab_addNewsLinksModal">' +
            '<h1>Adds html for news link</h1>' +
            '<p>Excerpt of the news will be fetched from pages which offer an excerpt to be fetched.</p>' +
            '<label for="klab_link_text">Link text: </label>' +
            '<input name="klab_link_text" id="klab_link_text" type=text /><br/>' +
            '<label for="klab_link_url">Link url: </label>' +
            '<input name="klab_link_url" id="klab_link_url" type=text /><br/>' +
            '<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>' +
            '<button data-remodal-action="confirm" class="remodal-confirm" id = "klab_addNewsLink">Add</button>' +
            '</div>';
    }

    tinymce.PluginManager.add( 'linkWithImage', function( editor, url ) {
        editor.addButton('linkWithImage', {
            text: 'Icon link',
            onclick: function () {
                jQuery('#wpbody-content').append(getLinkModalHtml());
                var inst = jQuery('[data-remodal-id=modal]').remodal();
                inst.open();
            }
        });
        editor.addButton('newsLink', {
            text: 'News link',
            onclick: function () {
                jQuery('#wpbody-content').append(getNewsLinkModalHtml());
                var inst = jQuery('[data-remodal-id=modal]').remodal();
                inst.open();
            }
        });

    });

    jQuery(document).on('confirmation', '.klab_addImageLinksModal', function () {
        var imageTitle = document.getElementById("klab_image_title_in_media_library").value;
        var linkText = document.getElementById("klab_link_text").value;
        var linkUrl = document.getElementById("klab_link_url").value;
        var shortLink = 'link image_title_in_media_library = "'+ imageTitle +'" link_text = "'+ linkText+'" url ="' + linkUrl + '" ]';

        tinymce.activeEditor.execCommand('mceInsertContent', false, shortLink);
    });
    jQuery(document).on('closing', '.klab_addImageLinksModal', function () {
        jQuery('.klab_addImageLinksModal').remove();
    });

    jQuery(document).on('confirmation', '.klab_addNewsLinksModal', function () {
        var linkText = document.getElementById("klab_link_text").value;
        var linkUrl = document.getElementById("klab_link_url").value;
        var html = '<div class="unfurledLink"><a href="'+linkUrl+'>'+linkText+'</a></div>';
        tinymce.activeEditor.execCommand('mceInsertContent', false, html);
    });
    jQuery(document).on('closing', '.klab_addImageLinksModal', function () {
        jQuery('.klab_addNewsLinksModal').remove();
    });

})();

