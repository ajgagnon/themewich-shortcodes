<?php
// this file contains the contents of the popup window
$type = 'Pricing';
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
		jQuery('#<?php echo strtolower($type); ?>-dialog input.<?php echo strtolower($type); ?>-feature:first').val(ed.selection.getContent());
	},
	insert : function insert<?php echo $type; ?>(ed) {
		 
		// set up variables to contain our input values
		var title 	= jQuery('#accordion-dialog input#accordion-title').val();		 
		var output 	= '';
		
		// setup the output of our shortcode
		output = '[tw-pricing-table class=""]<br />';

			jQuery('#<?php echo strtolower($type); ?>-dialog .dialog-section').each(function(){
				$this = jQuery(this);

				output += '[tw-pricing size="' + $this.find('select.<?php echo strtolower($type); ?>-size').val() + '" ';
				output += 'featured="' + $this.find('select.<?php echo strtolower($type); ?>-featured').val() + '" ';
				output += 'plan="' + $this.find('input.<?php echo strtolower($type); ?>-plan').val() + '" ';
				output += 'cost="' + $this.find('input.<?php echo strtolower($type); ?>-cost').val() + '" ';
				output += 'per="' + $this.find('input.<?php echo strtolower($type); ?>-per').val() + '" ';
				output += 'button_url="' + $this.find('input.<?php echo strtolower($type); ?>-url').val() + '" ';
				output += 'button_text="' + $this.find('input.<?php echo strtolower($type); ?>-text').val() + '" ';
				output += 'button_target="' + $this.find('select.<?php echo strtolower($type); ?>-target').val() + '" ';
				output += 'position="' + $this.find('select.<?php echo strtolower($type); ?>-position').val() + '" class=""]<ul>';

				if ($this.find('input.<?php echo strtolower($type); ?>-feature').val()) {

					// Get each feature
					$this.find('input.<?php echo strtolower($type); ?>-feature').each(function(){
						$this = jQuery(this).val();
						if ($this != '') {
							output += '<li>' + $this + '</li>';
						}
					});

				} else {
					output += '<li>Feature</li><li>Feature</li><li>Feature</li>'
				}

				output += '</ul>[/tw-pricing]<br />'
			});

		output += '[/tw-pricing-table]<br />';
			
			
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
	featurecloner : function cloneSection(clicked) {
		// Clone the section and store in a variable
		lastSection 	= jQuery(clicked).closest('.dialog-section').find('.featurewrap:last');
		field 			= lastSection.clone(true); 
		fieldLocation 	= lastSection;
		
		// Clear the values of the cloned section  
		jQuery('input, textarea', field).val('');
		
		// Insert after last section
		field.insertAfter(fieldLocation, jQuery(clicked).closest('.featurewrap'));

		return false; 
	},
	remover : function removeSection(clicked) {
		// Check how many sections
		if (jQuery(clicked).closest('removable').hasClass('.dialog-section')){
			sections = jQuery('.dialog-section').length;
		} else {
			sections = jQuery('.featurewrap').length;
		}
		
		// If there's more than one section
		if (sections != 1) {
			// Add a conformation box
			var r=confirm("Are you Sure?");

			if (r==true) {
			  jQuery(clicked).closest('.removable').remove();
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
	<div id="<?php echo strtolower($type); ?>-dialog" class="themewich-dialog-box wider">
		<form action="/" method="get" accept-charset="utf-8">
			<span class="dialog-section removable">
				<h3><span><?php echo $type ; ?> Section</span><a href="#" class="remover" onclick="javascript:<?php echo $type; ?>Dialog.remover(this); return false;" style="float:right;">x</a></h3>
				<span class="section">
					<div>
						<label for="<?php echo strtolower($type); ?>-plan" class="full">Plan Title</label>
						<input type="text" name="<?php echo strtolower($type); ?>-plan" value="" placeholder="e.g. Basic" class="<?php echo strtolower($type); ?>-plan full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-cost" class="full">Cost</label>
						<input type="text" name="<?php echo strtolower($type); ?>-cost" value="" placeholder="e.g. $20" class="<?php echo strtolower($type); ?>-cost full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-per" class="full">Per</label>
						<input type="text" name="<?php echo strtolower($type); ?>-per" value="" placeholder="e.g. Month" class="<?php echo strtolower($type); ?>-per full" />
					</div>
					<br style="clear:both;" />

					<div>
						<span class="feature-section">
							<label for="<?php echo strtolower($type); ?>-feature" class="full">Features</label>							
							<span class="featurewrap removable">
								<input type="text" name="<?php echo strtolower($type); ?>-feature" value="" placeholder="Feature" class="<?php echo strtolower($type); ?>-feature full" />
								<a href="#" class="remover" onclick="javascript:<?php echo $type; ?>Dialog.remover(this); return false;" style="float:right;">x</a>
							</span>
							<span class="featurewrap removable">
								<input type="text" name="<?php echo strtolower($type); ?>-feature" value="" placeholder="Feature" class="<?php echo strtolower($type); ?>-feature full" />
								<a href="#" class="remover" onclick="javascript:<?php echo $type; ?>Dialog.remover(this); return false;" style="float:right;">x</a>
							</span>
							<span class="featurewrap removable">
								<input type="text" name="<?php echo strtolower($type); ?>-feature" value="" placeholder="Feature" class="<?php echo strtolower($type); ?>-feature full" />
								<a href="#" class="remover" onclick="javascript:<?php echo $type; ?>Dialog.remover(this); return false;" style="float:right;">x</a>
							</span>
							<br style="clear:both;" />
							<a href="#" class="addlink" onclick="javascript:<?php echo $type; ?>Dialog.featurecloner(this); return false;" style="display: block; line-height: 24px;">+ Add More</a>
							<br style="clear:both;" />
						</span>
						<br style="clear:both;" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-text" class="full">Button Text</label>
						<input type="text" name="<?php echo strtolower($type); ?>-text" value="" placeholder="e.g. Purchase" class="<?php echo strtolower($type); ?>-text full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-url" class="full">Button Url</label>
						<input type="text" name="<?php echo strtolower($type); ?>-url" value="" placeholder="http://" class="<?php echo strtolower($type); ?>-url full" />
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-target">Link Target</label>
						<select name="<?php echo strtolower($type); ?>-target" class="<?php echo strtolower($type); ?>-target" size="1">
							<option value="_self" selected="selected">Same Window</option>
							<option value="_blank">New Window</option>
						</select>
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-size">Size</label>
						<select name="<?php echo strtolower($type); ?>-size" class="<?php echo strtolower($type); ?>-size" size="1">
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
						<select name="<?php echo strtolower($type); ?>-position" class="<?php echo strtolower($type); ?>-position" size="1">
							<option value="" selected="selected">Not Last</option>
							<option value="last">Last</option>																										
						</select>
					</div>
					<br style="clear:both;" />

					<div>
						<label for="<?php echo strtolower($type); ?>-featured">Featured</label>
						<select name="<?php echo strtolower($type); ?>-featured" class="<?php echo strtolower($type); ?>-featured" size="1">
							<option value="no" selected="selected">No</option>
							<option value="yes">Yes</option>																										
						</select>
					</div>
					<br style="clear:both;" />

				</span>

			</span>
			<div>	
				<a href="#" class="addlink" onclick="javascript:<?php echo $type; ?>Dialog.cloner(this); return false;" style="display: block; line-height: 24px;">+ Add Table Column</a>
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