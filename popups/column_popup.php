<?php
// this file contains the contents of the popup window
$type = 'Column';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert <?php echo $type; ?> Icon</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="../css/themewich-tinyMCE.css" />

<script type="text/javascript">
 
var <?php echo $type; ?>Dialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insert<?php echo $type; ?>(ed) {
		 
		// set up variables to contain our input values
		var width 		= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-width').val();
		var position 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-position').val();	 		 		 
		
		// setup the output of our shortcode
		output = '[tw-column ';
			output += 'width="' + width + '"';
			if (position && position != '') {
				output += ' position="' + position + '"';
			}
		output += ']';

		// Add selected content
		if (ed.selection.getContent()) {
			output += ed.selection.getContent();
		} else {
			output += 'Column Text'
		}

		// Close column shortcode
		output += '[/tw-column]<br /><br />';
			
		ed.execCommand('mceReplaceContent', false, output);

		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(<?php echo $type; ?>Dialog.init, <?php echo $type; ?>Dialog);
 
</script>

</head>
<body>
	<div id="<?php echo strtolower($type); ?>-dialog" class="themewich-dialog-box">
		<form action="/" method="get" accept-charset="utf-8">	
			<div>
				<label for="<?php echo strtolower($type); ?>-width">Column Width</label>
				<select name="<?php echo strtolower($type); ?>-width" id="<?php echo strtolower($type); ?>-width" size="1">
					<option value="one-half" selected="selected">1/2</option>
					<option value="one-third">1/3</option>
					<option value="one-fourth">1/4</option>
					<option value="one-fifth">1/5</option>
					<option value="one-sixth">1/6</option>
					<option value="two-third">2/3</option>
					<option value="three-fourth">3/4</option>
					<option value="two-fifth">2/5</option>
					<option value="three-fifth">3/5</option>
					<option value="four-fifth">4/5</option>
					<option value="five-sixth">5/6</option>																												
				</select>
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-position">Position</label>
				<select name="<?php echo strtolower($type); ?>-position" id="<?php echo strtolower($type); ?>-position" size="1">
					<option value="" selected="selected">Not Last</option>
					<option value="last">Last</option>																										
				</select>
			</div>
			<br style="clear:both;" />

			<div>	
				<a href="javascript:<?php echo $type; ?>Dialog.insert(tinyMCEPopup.editor)" id="insert" title="Insert Shortcode" style="display: block; line-height: 24px;">Insert</a>
			</div>
			<br style="clear:both;" />

		</form>
	</div>
</body>
</html>