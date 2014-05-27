<?php
// this file contains the contents of the popup window
$type = 'Social';
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
		var icon 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-icon').val();
		var url 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-url').val();
		var title 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-title').val();		 		 		 
		
		// setup the output of our shortcode
		output = '[tw-social ';
			output += 'icon="' + icon + '" ';
			output += 'url="' + url + '" ';
			output += 'title="' + title + '"';

		output += '][/tw-social]&nbsp;';
			
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
				<label for="<?php echo strtolower($type); ?>-icon">Social Icon</label>
				<select name="<?php echo strtolower($type); ?>-icon" id="<?php echo strtolower($type); ?>-icon" size="1">
					<option value="twitter" selected="selected">Twitter</option>
					<option value="facebook">Facebook</option>
					<option value="dribbble">Dribbble</option>
					<option value="google">Google+</option>
					<option value="instagram">Instagram</option>
					<option value="linkedin">Linkedin</option>
					<option value="pinterest">Pinterest</option>
					<option value="rss">RSS</option>
					<option value="stumble">Stumble</option>
					<option value="vimeo">Vimeo</option>
					<option value="youtube">Youtube</option>						
				</select>
			</div><br style="clear:both;" />

			<div>
			<div>
				<label for="<?php echo strtolower($type); ?>-url">Link URL</label>
				<input type="text" name="<?php echo strtolower($type); ?>-url" placeholder="http://" value="" id="<?php echo strtolower($type); ?>-url" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-title">Link Title</label>
				<input type="text" name="<?php echo strtolower($type); ?>-title" value="" placeholder="e.g. Follow Me" id="<?php echo strtolower($type); ?>-title" />
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