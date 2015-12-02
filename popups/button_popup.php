<?php
// this file contains the contents of the popup window
$type = 'Button';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert <?php echo $type; ?></title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="../css/themewich-tinyMCE.css" />

<script type="text/javascript">
 
var buttonDialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
		// Populate text box with selection
		jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-text').val(ed.selection.getContent());
	},
	insert : function insertButton(ed) {
		 
		// set up variables to contain our input values
		var url 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-url').val();
		var text 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-text').val();
		var size 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-size').val();
		var color 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-color').val();		 
		var custom 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-custom').val();		 
		var target 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-target').val();		 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[tw-button ';
			output += 'size="' + size + '" ';
			output += 'background="' + custom + '" ';
			output += 'color="' + color + '" ';
			output += 'target="' + target + '"';
			
			// only insert if the url field is not blank
			if(url)
				output += ' link="' + url + '"';
				output += ']'+ text + '[/tw-button]<br />';
	
		ed.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(buttonDialog.init, buttonDialog);
 
</script>

</head>
<body>
	<div id="<?php echo strtolower($type); ?>-dialog" class="themewich-dialog-box">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="<?php echo strtolower($type); ?>-url"><?php echo $type; ?> URL</label>
				<input type="text" name="<?php echo strtolower($type); ?>-url" value="" placeholder="http://" id="<?php echo strtolower($type); ?>-url" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-text"><?php echo $type; ?> Text</label>
				<input type="text" name="<?php echo strtolower($type); ?>-text" value="" id="<?php echo strtolower($type); ?>-text" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-size">Size</label>
				<select name="<?php echo strtolower($type); ?>-size" id="<?php echo strtolower($type); ?>-size" size="1">
					<option value="small">Small</option>
					<option value="medium" selected="selected">Medium</option>
					<option value="large">Large</option>
				</select>
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-color">Color</label>
				<select name="<?php echo strtolower($type); ?>-color" id="<?php echo strtolower($type); ?>-color" size="1">
					<option value="" selected="selected">Theme Color</option>
					<option value="gray">Gray</option>
					<option value="blue"=>Blue</option>
					<option value="red">Red</option>
					<option value="green">Green</option>
					<option value="black">Black</option>
				</select>
			</div><br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-custom">Custom Color</label>
				<input type="text" name="<?php echo strtolower($type); ?>-custom" value="" placeholder="#000000" id="<?php echo strtolower($type); ?>-custom" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-target">Link Target</label>
				<select name="<?php echo strtolower($type); ?>-target" id="<?php echo strtolower($type); ?>-target" size="1">
					<option value="_self" selected="selected">Same Window</option>
					<option value="_blank">New Window</option>
				</select>
			</div>
			<br style="clear:both;" />
			<div>	
				<a href="javascript:buttonDialog.insert(tinyMCEPopup.editor);" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
			<br style="clear:both;" />

		</form>
	</div>
</body>
</html>