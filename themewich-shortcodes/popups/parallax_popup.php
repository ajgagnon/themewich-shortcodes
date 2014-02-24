<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Parallax</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="../../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="../css/themewich-tinyMCE.css" />

<script type="text/javascript">
var ParallaxDialog = {
	init : function(ed) {
		// Resize box to inner size
		tinyMCEPopup.resizeToInnerSize();
		// Populate text box with selection
		jQuery('#parallax-dialog input.parallax-headline:first').val(ed.selection.getContent());
	},
	insert : function insertParallax(ed) { 
		
		// set up variables to contain our input values
		var image 	    = jQuery('#parallax-dialog .parallax-image').val();
		var opacity 	= jQuery('#parallax-dialog .parallax-opacity').val();
		var bgcolor 	= jQuery('#parallax-dialog .parallax-bgcolor').val();
		var link	 	= jQuery('#parallax-dialog .parallax-link').val();		 
		var target		= jQuery('#parallax-dialog .parallax-target').val();		 
		var lightbox 	= jQuery('#parallax-dialog .parallax-lightbox').val();
		var headline 	= jQuery('#parallax-dialog .parallax-headline').val();
		var subheadline = jQuery('#parallax-dialog .parallax-subheadline').val();
		var textcolor 	= jQuery('#parallax-dialog .parallax-textcolor').val();
		
		console.log(headline);
		
		// setup the output of our shortcode
		var output = '[tw-parallax ';
		
		if (image)
			output += 'image="' + image + '" ';
		if (opacity)
			output += 'opacity="' + opacity + '" ';
		if (bgcolor)
			output += 'bgcolor="' + bgcolor + '" ';
		if (link)
			output += 'link="' + link + '" ';
		if (target)
		    output += 'target="' + target + '" ';
		if (lightbox)
		    output += 'lightbox="' + lightbox + '" ';
			
			// only insert if the url field is not blank
			if(link)
				output += ' link="' + link + '" ';
				output += ']';
			if (headline) {	
				if (textcolor == 'light') {
					output += '<h3 style="color:#fff; text-align:center;">';	
				} else {
					output += '<h3 style="color:#000; text-align:center;">';
				}
				 output += headline + '</h3>';
			}
		
			if (subheadline) {	
				if (textcolor == 'light') {
					output += '<p style="color:#fff; text-align:center;">';	
				} else {
					output += '<p style="color:#000; text-align:center;">';
				}
				 output += subheadline + '</p>';
			}
					
			output += '[/tw-parallax]<br />';
			
			
		ed.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ParallaxDialog.init, ParallaxDialog);
 
</script>

</head>
<body>
	<div id="parallax-dialog" class="themewich-dialog-box wider">
		<form action="/" method="get" accept-charset="utf-8">
			<span class="dialog-section removable">
				<span class="section">
					<div>
						<label for="parallax-image" class="full">Background Image URL</label>
						<input type="text" name="parallax-image" value="" placeholder="http://" class="parallax-image full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="parallax-bgcolor" class="full">Background Color</label>
						<input type="text" name="parallax-bgcolor" value="" placeholder="e.g. #333333" class="parallax-bgcolor full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="parallax-opacity" class="full">Image Opacity</label>
						<input type="text" name="parallax-opacity" value="" placeholder="1 - 100" class="parallax-opacity full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="parallax-link" class="full">Parallax Link</label>
						<input type="text" name="parallax-link" value="" placeholder="http://" class="parallax-link full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="parallax-target">Link Target</label>
						<select name="parallax-target" class="parallax-target" size="1">
							<option value="self" selected="selected">Same Window</option>
							<option value="blank">New Window</option>
						</select>
					</div>
					<br style="clear:both;" />
					
					<div>
						<label for="parallax-target">Open Link in lightbox?</label>
						<select name="parallax-target" class="parallax-target" size="1">
							<option value="no" selected="selected">No</option>
							<option value="yes">Yes</option>
						</select>
					</div>
					<br style="clear:both;" />
					
					<span class="feature-section">
						<div>
							<label for="parallax-headline" class="full">Headline</label>
							<input type="text" name="parallax-headline" value="" placeholder="Optional" class="parallax-headline full" />
						</div>
						<br style="clear:both;" />
						
						<div>
							<label for="parallax-subheadline" class="full">Subheadline</label>
							<input type="text" name="parallax-subheadline" value="" placeholder="Optional" class="parallax-subheadline full" />
						</div>
						<br style="clear:both;" />
						
						<div>
							<label for="parallax-textcolor">Color</label>
							<select name="parallax-textcolor" class="parallax-textcolor" size="1">
								<option value="light" selected="selected">Light</option>
								<option value="dark">Dark</option>
							</select>
						</div>
						<br style="clear:both;" />
					</span>
					<br />
				</span>
			</span>
			<div style="clear:both;"></div>
			<div>	
				<a href="javascript:ParallaxDialog.insert(tinyMCEPopup.editor)" id="insert" title="Insert Shortcode" style="display: block; line-height: 24px;">Insert</a>
			</div>
			<br style="clear:both;" />
		</form>
	</div>
</body>
</html>