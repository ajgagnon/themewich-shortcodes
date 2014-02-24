<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Lightbox</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="../css/themewich-tinyMCE.css" />

<script type="text/javascript">
 
var LightboxDialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
		// Populate text box with selection
		jQuery('#lightbox-dialog textarea.lightbox-text').val(ed.selection.getContent());
	},
	insert : function insertLightbox(ed) {
		 
		// set up variables to contain our input values
		var url 	= jQuery('#lightbox-dialog input.lightbox-url').val();
		var text 	= jQuery('#lightbox-dialog textarea.lightbox-text').val();	 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[tw-lightbox link="' + url + '"]<br />';

		if(text) {	
			output += text + '<br />';
		}

		output += '[/tw-lightbox]<br />';

		ed.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(LightboxDialog.init, LightboxDialog);
 
</script>

</head>
<body>
	<div id="lightbox-dialog" class="themewich-dialog-box">
		<form action="/" method="get" accept-charset="utf-8">
			<span class="dialog-section">
				<h3><span>Lightbox</span></h3>
				<span class="section">
					<div>
						<label for="lightbox-url" class="full">Image, Youtube, Vimeo or Google Maps URL</label>
						<input type="text" name="lightbox-url" value="" placeholder="http://" class="lightbox-url full" />
					</div>
					<br style="clear:both;" />
					<div>
						<label for="lightbox-text" class="full">Clickable Content</label>
						<textarea name="lightbox-text" value="" class="lightbox-text full" rows="5"></textarea>
					</div>
					<br style="clear:both;" />
				</span>
			</span>
			<div>	
				<a href="javascript:LightboxDialog.insert(tinyMCEPopup.editor)" id="insert" title="Insert Shortcode" style="display: block; line-height: 24px;">Insert</a>
			</div>
			<br style="clear:both;" />

		</form>
	</div>
</body>
</html>