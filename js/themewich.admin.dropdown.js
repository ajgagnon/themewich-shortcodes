/**
 * Creates Themewich shortcode dropdown and adds
 * example shorcodes to editor when clicked for 
 * tinyMCE 4.0
 *
 * @since  v1.2
 */
(function() {
    tinymce.PluginManager.add( 'themewich_shortcodes', function( editor, url ) {

        editor.addButton('themewich_shortcodes_button_key', function() {
     
            // Setup dropdown values
            var values = [
                {text: 'Accordion', value: 'accordion_popup', width: '500', height: '450'},
                {text: 'Button', value: 'button_popup', width: '250', height: '350'},
                {text: 'Column', value: 'column_popup', width: '250', height: '180'},
                {text: 'Divider', value: 'divider'},
                {text: 'Lightbox', value: 'lightbox_popup', width: '500', height: '370'},
                {text: 'Posts', value: 'posts_popup', width: '250', height: '375'},
                {text: 'Pricing Table', value: 'pricing_popup', width: '500', height: '715'},
                {text: 'Social Icon', value: 'social_popup', width: '250', height: '225'},
                {text: 'Tabs', value: 'tabs_popup', width: '500', height: '445'},
                {text: 'Toggle', value: 'toggle_popup', width: '500', height: '375'},
                {text: 'Parallax', value: 'parallax_popup', width: '500', height: '700'},
            ];
     
            return {
                type: 'splitbutton',
                icon: 'shortcodes', // set a custom dashicon
                text: '',
                label: 'Insert a Shortcode',
                tooltip: 'Insert a Shortcode',
                fixedWidth: false,
                onselect: function(e) {
                    var value = e.control.settings.value,
                        width = e.control.settings.width,
                        height = e.control.settings.height;

                    // backwards compat
                    if ( typeof value == undefined ) {
                        value = e.control._value;
                        width = e.control._width,
                        height = e.control._height;
                    }

                    // Check for popup
                    if (value == 'divider') {
                        tinyMCE.activeEditor.selection.setContent('[tw-divider]' + tinyMCE.activeEditor.selection.getContent() + '[/tw-divider]');
                    } else {
                        editor.windowManager.open({ // Open popup window
                            file : themewichShortcodesVars.template_url + 'popups/' + value + '.php', // file that contains HTML for our modal window
                            width : width, // size of our window
                            height : height, // size of our window
                            inline : 1
                        }, {
                            plugin_url : url
                        });
                    }
                },
                menu: values,
            };

        });

    });

})();