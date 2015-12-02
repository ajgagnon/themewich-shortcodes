<?php
// this file contains the contents of the popup window
$type = 'Posts';
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
 
var <?php echo $type; ?>Dialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insert<?php echo $type; ?>(ed) {
		 
		// set up variables to contain our input values
		var title 		= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-title').val();
		var number 		= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-number').val();
		var category 	= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-category').val();
		var content 	= jQuery('#<?php echo strtolower($type); ?>-dialog select#<?php echo strtolower($type); ?>-content').val();
		var type 		= jQuery('#<?php echo strtolower($type); ?>-dialog input#<?php echo strtolower($type); ?>-type').val();		 		 		 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[tw-posts ';
			output += 'title="' + title + '" ';
			output += 'number="' + number + '" ';
			output += 'category="' + category + '" ';
			output += 'content="' + content + '" ';
			output += 'type="' + type + '"';

		output += '][/tw-posts]<br />';
			
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
				<label for="<?php echo strtolower($type); ?>-title" class="full"><?php echo $type; ?> Section Title</label>
				<input type="text" name="<?php echo strtolower($type); ?>-title" class="full" value="" placeholder="(Optional)" id="<?php echo strtolower($type); ?>-title" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-number">Number of Posts</label>
				<input type="text" name="<?php echo strtolower($type); ?>-number" value="" placeholder="e.g. 3" id="<?php echo strtolower($type); ?>-number" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-category">Category Slug</label>
				<input type="text" name="<?php echo strtolower($type); ?>-category" value="" placeholder="e.g. illustration" id="<?php echo strtolower($type); ?>-category" />
			</div>
			<br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-content">Show Post Content</label>
				<select name="<?php echo strtolower($type); ?>-content" id="<?php echo strtolower($type); ?>-content" size="1">
					<option value="yes" selected="selected">Yes</option>
					<option value="no">No</option>
				</select>
			</div><br style="clear:both;" />

			<div>
				<label for="<?php echo strtolower($type); ?>-type">Post Type Slug</label>
				<input type="text" name="<?php echo strtolower($type); ?>-type" value="" placeholder="e.g. portfolio" id="<?php echo strtolower($type); ?>-type" />			
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