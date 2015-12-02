<?php
// this file contains the contents of the popup window
$type = 'Tabs';
$type_single = 'Tab';
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
		// Populate text box with selection
		jQuery('#<?php echo strtolower($type); ?>-dialog textarea.tabs-text').val(ed.selection.getContent());
	},
	insert : function insert<?php echo $type; ?>(ed) {
		
		// setup the output of our shortcode
		output = '[tw-tabs ';

		// Tab Titles
		i=1;
		jQuery('#tabs-dialog .dialog-section').each(function(){
			$this = jQuery(this);
			output += 'tab' + i + '="' + $this.find('input.tabs-title').val() +'" ';
			i++;
		});

		// Close Out Title
		output += ']<br />'

		// Tab Content
		jQuery('#tabs-dialog .dialog-section').each(function(){
			$this = jQuery(this);
			output += '[tw-tab]' + $this.find('textarea.tabs-text').val() + '[/tw-tab] <br />';
		});

		output += '[/tw-tabs]<br />';
			
			
		ed.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	},
	cloner : function cloneSection(clicked) {
		// Clone the section and store in a variable
		lastSection 	= jQuery(clicked).closest('.themewich-dialog-box').find('.dialog-section:last');
		field 			= lastSection.clone(true); 
		fieldLocation 	= lastSection;
		
		// Clear the values of the cloned section  
		jQuery('input, textarea', field).val('');
		
		// Insert after last section
		field.insertAfter(fieldLocation, jQuery(clicked).closest('.dialog-section'));

		topOffset = jQuery(clicked).closest('.themewich-dialog-box').find('.dialog-section:last').offset().top;
		jQuery('html, body').animate({scrollTop:topOffset}, 200);
		return false; 
	},
	remover : function removeSection(clicked) {
		// Check how many sections
		sections = jQuery('.dialog-section').length;

		// If there's more than one section
		if (sections != 1) {
			// Add a conformation box
			var r=confirm("Are you Sure?");

			if (r==true) {
			  jQuery(clicked).closest('.dialog-section').remove();
			} else {
			  return false;
			}
		}
	}
};
tinyMCEPopup.onInit.add(<?php echo $type; ?>Dialog.init, <?php echo $type; ?>Dialog);
 
</script>

</head>
<body>
	<div id="<?php echo strtolower($type); ?>-dialog" class="themewich-dialog-box">
		<form action="/" method="get" accept-charset="utf-8">
			<span class="dialog-section">
				<h3><span><?php echo $type_single; ?></span><a href="#" class="remover" onclick="javascript:<?php echo $type; ?>Dialog.remover(this); return false;" style="float:right;">x</a></h3>
				<span class="section">
					<div>
						<label for="<?php echo strtolower($type); ?>-title" class="full"><?php echo $type_single; ?> Title</label>
						<input type="text" name="<?php echo strtolower($type); ?>-title" value="" class="<?php echo strtolower($type); ?>-title full" />
					</div>
					<br style="clear:both;" />
					<div>
						<label for="<?php echo strtolower($type); ?>-text" class="full"><?php echo $type_single; ?> Content</label>
						<textarea name="<?php echo strtolower($type); ?>-text" value="" class="<?php echo strtolower($type); ?>-text full" rows="5"></textarea>
					</div>
					<br style="clear:both;" />
				</span>
			</span>
			<div>	
				<a href="#" class="addlink" onclick="javascript:<?php echo $type; ?>Dialog.cloner(this); return false;" style="display: block; line-height: 24px;">+ Add Tab</a>
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