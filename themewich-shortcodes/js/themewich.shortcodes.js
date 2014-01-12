/**
 * Plugin Javascript
 */
jQuery(document).ready(function($){

	/*-----------------------------------------------------------------------------------*/
	/* Lightbox Initialize
	/*-----------------------------------------------------------------------------------*/
	$images = $('a.tw-lightbox[href*=".jpg"], a.tw-lightbox[href*="jpeg"], a.tw-lightbox[href*=".png"], a.tw-lightbox[href*=".gif"]');
	$notImages = $('a.tw-lightbox').not($images);

	$images.magnificPopup({
		type:'image', 
		closeBtnInside: true,
		mainClass: 'mfp-zoom-in',
		removalDelay: 500, //delay removal by X to allow out-animation
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
			  return item.el.find('img').attr('title');				  
			},
			 markup: '<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<div class="mfp-img"></div>'+
            '<div class="mfp-bottom-bar">'+
              '<div class="mfp-title-wrapper"><div class="mfp-title"></div></div>'+
              '<div class="mfp-counter"></div>'+
            '</div>'+
          '</div>' // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
		},

		callbacks: {
			imageLoadComplete: function() {
			  var self = this;
			  setTimeout(function() {
			    self.wrap.addClass('mfp-image-loaded');
			  }, 16);
			},
			close: function() {
			  this.wrap.removeClass('mfp-image-loaded');
			}
		},
		closeOnContentClick: true,
		midClick: true
	});

    $notImages.magnificPopup({
      disableOn: 700,
      closeBtnInside: true,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false
    });


	/*-----------------------------------------------------------------------------------*/
	/* Tabs
	/*-----------------------------------------------------------------------------------*/
	if ($.fn.themewichTabs) {
		$('ul.tw-tabs').themewichTabs();
	}


	/*-----------------------------------------------------------------------------------*/
	/* Toggle
	/*-----------------------------------------------------------------------------------*/
	$(".tw-toggle-trigger").click(function(){
		$(this).toggleClass("active").next().slideToggle("fast");
		return false;
	});


	/*-----------------------------------------------------------------------------------*/
	/* Accordion
	/*-----------------------------------------------------------------------------------*/

	if (jQuery.isFunction(jQuery.fn.accordion)) {
		jQuery(".tw-accordion").accordion({autoHeight: false});
	}


			jQuery('.tw-postshortcode .isotopecontainer').each(function($) {

				var $this = jQuery(this),
		  	 	 	columnNumber = $this.attr('data-value'),
		  	 	 	isoBrick = jQuery('.isobrick'),
		  	 	 	$colnum2;

		  	 	// Remove margins
				isoBrick.css({
					'margin-left': 0,
					'margin-right': 0 
				});
		  
				// Calculate column number
				if ($this.width() < 500 ) {
					$colnum2 = 2;
				} else { 
					$colnum2 = columnNumber;
				}

				// Call isotope with selected columns
				if (columnNumber != '1') {
				  $this.isotope({
				  masonry: {
				      columnWidth: $this.width() / $colnum2
				    },
				    itemSelector : '.isobrick',
				    layoutMode : 'masonry'
				  });
					
					// In case it fires too soon due to css3 animations
					$this.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
						if ($this.hasClass('isotope')) {
							$this.isotope('reLayout');
						}
					});
				}


				/**
				* Run Isotope on Resize Event
				*/
				jQuery(window).resize(function () {
					// Find column number
					if ($this.width() < 500 ) {
						$colnum2 = 2;
					} else {
						$colnum2 = columnNumber;
					}

					// Resize isotope container
					if (columnNumber != '1') {
						$this.isotope({
						  masonry: {  // update columnWidth to a percentage of container width
						  	columnWidth: $this.width() / $colnum2
						   },
						  itemSelector : '.isobrick',
						  layoutMode : 'masonry'
						});
					}	
				});
				
			});

});