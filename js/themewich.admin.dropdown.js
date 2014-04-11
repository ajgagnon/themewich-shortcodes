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
                {text: 'Lightbox', value: 'lightbox_popup', width: '500', height: '370'},
                {text: 'Posts', value: 'posts_popup', width: '250', height: '375'},
                {text: 'Pricing Tabe', value: 'pricing_popup', width: '500', height: '715'},
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
                fixedWidth: true,
                onselect: function(e) {
                    // Open popup window
                    editor.windowManager.open({
                        file : themewichShortcodesVars.template_url + 'popups/' + e.control._value + '.php', // file that contains HTML for our modal window
                        width : e.control._width, // size of our window
                        height : e.control._height, // size of our window
                        inline : 1
                    }, {
                        plugin_url : url
                    });
                },
                menu: values,
            };

        });

    });

})();