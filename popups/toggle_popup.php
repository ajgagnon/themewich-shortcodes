<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Toggle</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="../css/themewich-tinyMCE.css" />

<script type="text/javascript">
 
var ToggleDialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
		// Populate text box with selection
		jQuery('#toggle-dialog textarea.toggle-text').val(ed.selection.getContent());
	},
	insert : function insertToggle(ed) {
		 
		// set up variables to contain our input values
		var title 	= jQuery('#toggle-dialog input.toggle-title').val();
		var text 	= jQuery('#toggle-dialog textarea.toggle-text').val();	 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[tw-toggle title="' + title + '"]<br />';

		if(text) {	
			output += text + '<br />';
		}
		// if it is blank, use the selected text, if present
		else {
			output += ToggleDialog.local_ed.selection.getContent() + '<br />';
		}

		output += '[/tw-toggle]<br />';

		ed.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ToggleDialog.init, ToggleDialog);
 
</script>

</head>
<body>
	<div id="toggle-dialog" class="themewich-dialog-box">
		<form action="/" method="get" accept-charset="utf-8">
			<span class="dialog-section">
				<h3><span>Toggle</span></h3>
				<span class="section">
					<div>
						<label for="toggle-title" class="full">Title</label>
						<input type="text" name="toggle-title" value="" class="toggle-title full" />
					</div>
					<br style="clear:both;" />
					<div>
						<label for="toggle-text" class="full">Content</label>
						<textarea name="toggle-text" value="" class="toggle-text full" rows="5"></textarea>
					</div>
					<br style="clear:both;" />
				</span>
			</span>
			<div>	
				<a href="javascript:ToggleDialog.insert(tinyMCEPopup.editor)" id="insert" title="Insert Shortcode" style="display: block; line-height: 24px;">Insert</a>
			</div>
			<br style="clear:both;" />

		</form>
	</div>
</body>
</html>