/**
 * Creates Themewich shortcode dropdown and adds
 * example shorcodes to editor when clicked.
 *
 * @since  v1.0
 */
(function() {   
    tinymce.create('tinymce.plugins.themewichShortcodeMce', {
        init : function(ed, url){

            // Accordion Command
            ed.addCommand('mceaccordion', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/accordion_popup.php', // file that contains HTML for our modal window
                    width : 500 + parseInt(ed.getLang('accordion.delta_width', 0)), // size of our window
                    height : 400 + parseInt(ed.getLang('accordion.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Button Command
            ed.addCommand('mcebutton', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/button_popup.php', // file that contains HTML for our modal window
                    width : 250 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 325 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Column Command
            ed.addCommand('mcecolumn', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/column_popup.php', // file that contains HTML for our modal window
                    width : 250 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 150 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Google Map Command
            ed.addCommand('mcegooglemap', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/googlemap_popup.php', // file that contains HTML for our modal window
                    width : 250 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 325 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Lightbox Command
            ed.addCommand('mcelightbox', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/lightbox_popup.php', // file that contains HTML for our modal window
                    width : 500 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 335 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Posts Command
            ed.addCommand('mceposts', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/posts_popup.php', // file that contains HTML for our modal window
                    width : 250 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 310 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

           // Pricing Command
            ed.addCommand('mcepricing', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/pricing_popup.php', // file that contains HTML for our modal window
                    width : 500 + parseInt(ed.getLang('pricing.delta_width', 0)), // size of our window
                    height : 700 + parseInt(ed.getLang('pricing.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Social Icon Command
            ed.addCommand('mcesocial', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/social_popup.php', // file that contains HTML for our modal window
                    width : 250 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 205 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Tabs Command
            ed.addCommand('mcetabs', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/tabs_popup.php', // file that contains HTML for our modal window
                    width : 500 + parseInt(ed.getLang('accordion.delta_width', 0)), // size of our window
                    height : 400 + parseInt(ed.getLang('accordion.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Toggle Command
            ed.addCommand('mcetoggle', function() {
                ed.windowManager.open({
                    file : themewichShortcodesVars.template_url + 'popups/toggle_popup.php', // file that contains HTML for our modal window
                    width : 500 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
                    height : 335 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

        },
        createControl : function(btn, e) {
            if ( btn == "themewich_shortcodes_button" ) {
                var t = this;   
                var btn = e.createSplitButton('themewich_button', {
                    title: "Insert a Shortcode",
                    image: themewichShortcodesVars.template_url + "/images/shortcodes.png",
                    icons: false,
                });
                btn.onRenderMenu.add(function (c, b) {
                    t.render( b, "Accordion", "accordion" );
                    t.render( b, "Button", "button" );
                    t.render( b, "Column", "column" );
                    t.render( b, "Divider", "divider" );
                   // t.render( b, "Google Map", "googlemap" ); // coming soon
                    t.render( b, "Lightbox", "lightbox" );
                    t.render( b, "Posts", "posts" );
                    t.render( b, "Pricing Table", "pricing" );
                    t.render( b, "Social Icon", "social" );
                    t.render( b, "Tabs", "tabs" );
                    t.render( b, "Toggle", "toggle" );
                });
                
              return btn;
            }
            return null;               
        },
        render : function(ed, title, id) {
            ed.add({
                title: title,
                onclick: function () {
                    
                    // Switch the clicked item ID
                    switch (id) {

                        // Divider doesn't need a dialog box
                        case "divider" :
                            tinyMCE.activeEditor.selection.setContent('[tw-divider]' + tinyMCE.activeEditor.selection.getContent() + '[/tw-divider]');
                            break;

                        // Popup box for options
                        default :
                            tinyMCE.execCommand('mce' + id, false);
                            break;
                    }
                    
                    return false;
                }
            })
        }
    
    });
    tinymce.PluginManager.add("themewich_shortcodes", tinymce.plugins.themewichShortcodeMce);
})();  