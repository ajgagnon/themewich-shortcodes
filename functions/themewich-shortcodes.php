<?php
/**
 * This file loads the shortcode functions
 * @package Themewich Shortcodes
 * @since 1.0
 * @author Andre Gagnon
 * @link http://themewich.com
 * @License: GNU General Public License version 3.0
 * @License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/*
 * Allow Shortcodes in Widgets
 * @since v1.0
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Browser detection body class
 * @since  1.0
 */
if ( ! function_exists('tw_browser_body_class') ) :
    function tw_browser_body_class($classes) {
    	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
            if($is_lynx) $classes[] = 'lynx';
            elseif($is_gecko) $classes[] = 'gecko';
            elseif($is_opera) $classes[] = 'opera';
            elseif($is_NS4) $classes[] = 'ns4';
            elseif($is_safari) $classes[] = 'safari';
            elseif($is_chrome) $classes[] = 'chrome';
            elseif($is_IE) {
                    $classes[] = 'ie';
                    if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                    $classes[] = 'ie'.$browser_version[1];
            } else $classes[] = 'unknown';
            if($is_iphone) $classes[] = 'iphone';
            if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                     $classes[] = 'osx';
               } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                     $classes[] = 'linux';
               } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                     $classes[] = 'windows';
               }

            $classes[] = strtolower( wp_get_theme() ); // add theme name
            $classes[] = wp_is_mobile() ? 'mobile-device' : 'desktop-device'; // add mobile device class

            return $classes;
    }
    add_filter('body_class','tw_browser_body_class');
endif;

/*
 * Fix Shortcodes
 * @since v1.0
 */
if( ! function_exists( 'themewich_fix_shortcodes' ) ) {
	function themewich_fix_shortcodes($content){
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']&nbsp;' => ']',
			'&nbsp;[' => '['
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter( 'the_content', 'themewich_fix_shortcodes' );
}

/**
 * Button Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_button_shortcode' ) ) {
	function themewich_button_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   'link'	=>  '#',
	   'target'	=>  '',
	   'color'	=>  '',
	   'size'	=>  '',
	   'background'	=>  '',
	   'text'=>  '',
	   'class' => ''
	   ), $atts));

	    // Sanitize options
		$color 				= ($color != '') ? ' custom ' . $color : '';
		$size 				= ($size) ? ' '. $size : '';
		$target 			= ($target == 'blank' || $target == "_blank") ? ' target="_blank"' : '';

		// Background Style
		$backgroundstyle 	= ($background != '' || $text != '') ? ' style="' : '';
		$backgroundstyle 	.= ($background != '') ? 'background:'.$background.';' : '';
		$backgroundstyle 	.= ($text != '') ? ' color:'.$text.';' : '';
		$backgroundstyle 	.= ($background != '' || $text != '') ? '"' : '';
		$backgroundclass 	= ($background != '') ? ' custom ' : '';

		$out = '<a' .$target. ' class="tw-button '.$color.$size.$backgroundclass.' ' . $class . ' shortcode" href="' .$link. '" '.$backgroundstyle.'>' .do_shortcode($content).'</a>';

	   return $out;
	}
	add_shortcode( 'tw-button', 'themewich_button_shortcode' );
}

/**
 * Lightbox Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_lightbox_shortcode' ) ) {
	function themewich_lightbox_shortcode( $atts, $content = null ) {
	    extract(shortcode_atts(array(
	    'link'	=> '#',
	    'class' => ''
	    ), $atts));

		$out = '<a href="' .$link. '" class="tw-lightbox ' . $class . '">' .do_shortcode($content). '</a>';

	    return $out;
	}
	add_shortcode( 'tw-lightbox', 'themewich_lightbox_shortcode' );
}

/**
 * Divider Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_divider_shortcode' ) ) {
	function themewich_divider_shortcode( $atts, $content = null ) {
	    extract(shortcode_atts(array(
	    	'class' => ''
	    ), $atts));

	    if ($content && $content !== '') {
			$out = '<div class="tw-divider '. $class .'"><h5><span>'.do_shortcode($content).'</span></h5></div>';
		} else {
			$out = '<div class="tw-divider '. $class .'"></div>';
		}

	    return $out;
	}
	add_shortcode( 'tw-divider', 'themewich_divider_shortcode' );
}

/**
 * Tabs Shortcode
 * @since v1.0
 */
if( ! function_exists('themewich_tabs_shortcode ') ) {
	function themewich_tabs_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
	    'class' => ''
	    ), $atts));

		$tabs_counter = 1;

		//$tabs_counter_2++;

		$out 	= '<div class="clear"></div><div class="tw-tabs-shortcode"><ul class="tw-tabs '. $class .'">';

		// For each tab attribute
		foreach ($atts as $tab) {
			// Skip class attribute
			if ($tab !== $class) {

				// Set first tab to active
				$first = ($tabs_counter == 1) ? 'active' : '';

				$out .= '<li><a class="'.$first.'" href="#'.$tabs_counter.'">'.$tab.'</a></li>';

				$tabs_counter++;
			}
		}

		$out .= '</ul><div class="clear"></div>';

		// Set up container for content
		$out .= '<ul class="tabs-content">'. do_shortcode($content) .'</ul><div class="clear"></div></div>';

		return $out;
	}
	add_shortcode( 'tw-tabs', 'themewich_tabs_shortcode' );
}

/**
 * Tab Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_tab_shortcode ') ) {
	function themewich_tab_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'class' => ''
	    ), $atts));

		// Set and initialize global counter
		global $tab_counter;
		$tab_counter = !isset($tab_counter) ? 1 : $tab_counter;

		// Set first tab to active
		$first = ($tab_counter == 1) ? 'active' : '';

		$out = '<li id="'.$tab_counter.'" class="'.$first.' '. $class .'">'. do_shortcode($content) .'</li>';

		$tab_counter++;

		return $out;
	}
	add_shortcode( 'tw-tab', 'themewich_tab_shortcode' );
}

/**
 * Posts Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_posts_shortcode ') ) {
	function themewich_posts_shortcode( $atts, $content = null ) {
	    extract(shortcode_atts(array(
	    'number'	=> '4',
	    'columns'   => '',
	    'title'	    => '',
	    'category'	=> '',
	    'content'   => 'yes',
	    'type'      => 'post',
	    'class'     => ''

	    ), $atts));

	    // Set Defaults
	    // =====================================================================
		$number 	= ($number != '') ? $number : '4'; // Set Default Posts Number
		$title 		= ($title != '') ? $title : ''; // Set Default Title
		$category 	= ($category != '') ? $category : ''; // Set Default Content
		$content 	= ($content != '') ? $content : 'yes'; // Set Default Posts Number
		$type 		= ($type != '') ? $type : 'post'; // Set Default Posts Number
		$counter 	= 1; // Set Initial Variable Number

		// Create HTML
		// ======================================================================
		$out = '<div class="sidepost tw-postshortcode ' . $class . '">';

		// Display the Posts Area Title
		if ($title != '') {
			$out .= '<h4 class="title-shortcode">' . $title . '</h4><div class="clear"></div>';
		}

		// Set taxonomy depending on post type
		$taxname = ($type == 'portfolio' || $type == 'Portfolio' || $type == 'portfolios' || $type == 'Portfolios') ? 'filter' : 'category';

		// Query the correct posts, category and number
		// ======================================================================
		if ($category && $category != '') {
			$the_query = new WP_Query(array(
				'showposts' => $number,
				'post_type' => strtolower($type),
				'tax_query' => array(
					array(
						'taxonomy' => $taxname,
						'field' => 'slug',
						'terms' => strtolower($category)
					))
			));
		} else {
			$the_query = new WP_Query(array(
				'showposts' => $number,
				'post_type' => strtolower($type)
			));
		}

		// Calculate appropriate columns if none are set
		// =======================================================================
		if (!$columns) {
			switch ($number) {
				case 1 :
				case 2 :
				case 3 :
				case 4 :
					$datavalue = $number;
				break;
				default:
					$datavalue = '4';
				break;
			}
		} else {
			$datavalue = $columns;
		}

		// allow hook to change thumbnail size
		$post_thumbnail_size = apply_filters( 'tw_posts_shortcode_thumb_size', 'medium' );

		// Output the Shortcode
		// =======================================================================
		$out .= '<div class="sidepostcontainer isotopecontainer" data-value="'. $datavalue .'">';

		// Loop Through Posts
		while ($the_query->have_posts()) : $the_query->the_post(); $postinfo =  '';

			// Get Post Thumbnail
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :
				$postinfo .= '<div class="thumbnailarea">
				                  <a class="thumblink" title="'. __('Permanent Link to %s', 'framework') .  get_the_title() .'" href="'. get_permalink() .'">
				                  	'. get_the_post_thumbnail(get_the_ID(), $post_thumbnail_size, array('class' => 'scale-with-grid')) .'
				                  </a>
			                  </div>';
			endif;

			// Get Post Title
			$postinfo .= '<h3 class="title-shortcode">
							<a href="'. get_permalink() .'" title="'. __('Permanent Link to %s', 'framework') .  get_the_title() .'">
								'. get_the_title() .'
							</a>
						  </h3>';

			// Set Date for Posts Only
			if ($type == 'post' || $type == 'Post' || $type == 'posts' || $type == 'Posts') {
				$postinfo .= '<span class="date"><span class="posted">' . get_the_time(get_option('date_format')) . '</span> <span class="date-divider"> | </span>
								<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '" class="author">
									'. get_the_author_meta('display_name').'
								</a>
							  </span>';
			}

			// Set the content if option is selected
			if ($content == 'Yes' || $content == 'yes' || $content == 'show' ||  $content == 'Show') {
				global $more; $more=0;

				$the_post = get_post(get_the_ID());

				if ( preg_match( '/<!--more/', $the_post->post_content ) ) {
					$postinfo .= apply_filters('the_content', get_the_content( __('Read More', 'themewich'), '<br />') );
				} else {
					$postinfo .= get_the_excerpt();
				}

			}

			// Close postinfo
			$postinfo .= '<div class="clear"></div>';

			// Set columns depending on number
			switch ($number) {
				case ('1') :
					$out .= $postinfo;
				break;
				case ('2') :
					if ($counter == 2) {
						$out .= '<div class="tw-one-half column-last articleinner isobrick">'.$postinfo.'</div>';
					} else {
						$out .= '<div class="tw-one-half articleinner isobrick">'.$postinfo.'</div>';
					}
				break;
				case ('3'):
					if ($counter == 3) {
						$out .= '<div class="tw-one-third column-last articleinner isobrick">'.$postinfo.'</div>';
					} else {
						$out .= '<div class="tw-one-third articleinner isobrick">'.$postinfo.'</div>';
					}
				break;
				default :
					if ($counter == 4) {
						$out .= '<div class="tw-one-fourth column-last articleinner isobrick">'.$postinfo.'</div>';
					} else {
						$out .= '<div class="tw-one-fourth articleinner isobrick">'.$postinfo.'</div>';
					}
				break;
			}

	 		// Increment counter
			$counter++;
		// End and reset query
		endwhile;  wp_reset_query();

		// Close containers
		$out .= '<div class="clear"></div></div></div>';

		// Return html string
	    return $out;
	}
	add_shortcode( 'tw-posts', 'themewich_posts_shortcode' );
}

/**
 * Toggle Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_toggle_shortcode ') ) {
	function themewich_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => 'Toggle Title',
			'class' => '',
		), $atts ) );

		// Display the Toggle
		return '<div class="tw-toggle '. $class .'"><div class="tw-toggle-trigger">'. $title .'</div><div class="tw-toggle-container">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'tw-toggle', 'themewich_toggle_shortcode' );
}

/**
 * Accordion Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_accordion_main_shortcode ') ) {
	function themewich_accordion_main_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'class' => ''
		), $atts ) );

		// Display the accordion
		return '<div class="tw-accordion '. $class .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'tw-accordion', 'themewich_accordion_main_shortcode' );
}

/**
 * Accordion Section Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_accordion_section_shortcode ') ) {
	function themewich_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'title' => 'Title',
			'class' => '',
		), $atts ) );
	   return '<div class="tw-accordion-trigger '. $class .'"><a href="#">'. $title .'</a></div><div>' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'tw-accordion-section', 'themewich_accordion_section_shortcode' );
}

/**
 * Pricing Table Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_pricing_table_shortcode ') ) {
	function themewich_pricing_table_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'class' => ''
		), $atts ) );
		return '<div class="tw-pricing-table  clearfix '. $class .'">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode( 'tw-pricing-table', 'themewich_pricing_table_shortcode' );
}

/**
 * Pricing Shortcode
 * @since v1.0
 */
if( ! function_exists( 'themewich_pricing_shortcode ') ) {
	function themewich_pricing_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'size'                 => 'one-half',
			'position'             => '',
			'featured'             => 'no',
			'plan'                 => 'Basic',
			'cost'                 => '$20',
			'per'                  => 'month',
			'button_url'           => '',
			'button_text'          => 'Purchase',
			'button_color'         => '',
			'button_target'        => 'self',
			'button_rel'           => 'nofollow',
			'button_border_radius' => '',
			'class'                => '',
		), $atts ) );

		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;
		$border_radius_style = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;

		//start content
		$pricing_content  = '<div class="tw-pricing tw-'. $size .' '. $featured_pricing .' tw-column-'. $position. ' '. $class .'">' .
						    '<div class="tw-pricing-header">' .
		  						'<h5>'. $plan. '</h5>' .
								'<div class="tw-pricing-cost">'. $cost .'</div>' .
								'<div class="tw-pricing-per">'. $per .'</div>' .
		 					'</div>' .
		 					'<div class="tw-pricing-content">' . wp_kses( $content, array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'ul' => array(),
				'ol' => array(),
				'li' => array()
			) ) . '</div>';

		// Add button if there's a URL
		if( $button_url ) {
			$pricing_content .= '<div class="tw-pricing-button"><a href="'. $button_url .'" class="tw-button '. $button_color .'" target="_'. $button_target .'" rel="'. $button_rel .'" '. $border_radius_style .'><span class="tw-button-inner" '. $border_radius_style .'>'. $button_text .'</span></a></div>';
		}

		// Close Div
		$pricing_content .= '</div>';

		return $pricing_content;
	}
	add_shortcode( 'tw-pricing', 'themewich_pricing_shortcode' );
}


/*
 * Social Shortcode
 * @since v1.0
 *
 */
if( ! function_exists( 'themewich_social_shortcode ') ) {
	function themewich_social_shortcode( $atts ){
		extract( shortcode_atts( array(
			'icon'   => 'twitter',
			'url'    => 'http://www.twitter.com/username',
			'title'  => 'Follow Us',
			'target' => 'self',
			'rel'    => '',
			'class'  => '',
		), $atts ) );
		return '<a href="' . $url . '" class="tw-social-icon '. $class .' '. $icon .'" target="_'.$target.'" title="'. $title .'" rel="'. $rel .'"></a>';
	}
	add_shortcode( 'tw-social', 'themewich_social_shortcode' );
}


/*
 * Columns
 * @since v1.0
 *
 */
if( ! function_exists( 'themewich_column_shortcode ') ) {
	function themewich_column_shortcode( $atts, $content = null ){
		extract( shortcode_atts( array(
			'width'    => 'one-half',
			'position' =>'first',
			'class'    => '',
		  ), $atts ) );

		$out = '<div class="tw-column tw-' . $width . ' tw-column-'.$position.' '. $class .'">' . do_shortcode($content) . '</div>';

		if ($position == 'last') {
			$out .= '<div class="clear"></div>';
		}

		return $out;

	}
	add_shortcode( 'tw-column', 'themewich_column_shortcode' );
}

/*
 * Parallax Images
 * @since v1.1
 *
 */
if( ! function_exists( 'themewich_parallax_images ') ) {
	function themewich_parallax_images( $atts, $content = null ){
		extract( shortcode_atts( array(
			'image'      => '',
			'opacity'    =>'100',
            'bgcolor'    => '#222',
            'link'       => '',
            'target'     => '',
            'lightbox'   => '',
			'class'      => '',
		  ), $atts ) );

        $out = '<div class="tw-post-break '.$class.'">';

        /* Setup Link */
        if ($link && $link != '') {
            $out .= '<a href="' . $link . '"';

            if ($lightbox && ($lightbox == 'yes' || $lightbox == 'Yes' ) ) {
                $out .= ' class="tw-lightbox"';
            }

            $out .= ($target && $target != '') ? ' target="_' . $target . '"' : '';
            $out .= ($link && $link != '') ? '>' : '';
        }

        /* Background Image */
        $bgimg = ' style="';
        $bgimg .= ($image && $image != '') ? 'background-image: url(' . $image . '); ' : '';
        $bgimg .= '"';

        /* Background Color */
        $bgc = ' style="';
        $bgc .= ($bgcolor && $bgcolor != '') ? 'background-color:' . $bgcolor . '; ' : '';
        if ($opacity && $opacity != '') {
            $opacity = (100 - $opacity)/100;
            $bgc .= 'opacity:'.$opacity.'; ';
        }
        $bgc .= '"';

        $out .= '<div class="tw-full-bg-image"' . $bgimg . '><div class="tw-opacity"'.$bgc.'></div><div class="tw-parallax-content">' . do_shortcode($content) . '</div></div>';

        /* End Link */
        $out .= ($link && $link != '') ? '</a>' : '';

        /* End Post Break */
        $out .= '</div><div class="clear"></div>';

		return $out;

	}
	add_shortcode( 'tw-parallax', 'themewich_parallax_images' );
}

/**
 * Current Year Shortcode
 * @since v1.0
 */
if ( ! function_exists( 'themewich_current_year' ) ) {
	function themewich_current_year() {
		return date( 'Y' );
	}

	add_shortcode( 'tw-current-year', 'themewich_current_year' );
}

/**
 * Site Title Shortcode
 * @since v1.0
 */
if ( ! function_exists( 'themewich_site_title' ) ) {
	function themewich_site_title() {
		return get_bloginfo( 'name' );
	}

	add_shortcode( 'tw-site-title', 'themewich_site_title' );
}

/**
 * Site Tagline Shortcode
 * @since v1.0
 */
if ( ! function_exists( 'themewich_site_tagline' ) ) {
	function themewich_site_tagline() {
		return get_bloginfo( 'description' );
	}

	add_shortcode( 'tw-site-tagline', 'themewich_site_tagline' );
}
