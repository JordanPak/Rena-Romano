<?php

/*
Plugin Name: Genesis Call To Action Widget
Description: A Genesis Framework Call To Action Widget with text, background image, alignment, and button icon support.
Version: 1.0
Author: Jordan Pakrosnis
Author URI: http://JordanPak.com/
*/


function jordanpak_register_widgets() {
	register_widget( 'Genesis_CTA_Widget');
}

add_action( 'widgets_init', 'jordanpak_register_widgets' );


//-- WIDGET CLASS --//
class Genesis_CTA_Widget extends WP_Widget {


	//-- CONSTRUCTOR --//
    function Genesis_CTA_Widget() {

		// Instantiate the parent object
		parent::__construct(
	            'genesis_cta_widget', // Base ID
        	    __('Genesis - Call To Action', 'text_domain'), // Name
 	           array( 'description' => __( 'Call to action with text, background, and button.', 'text_domain' ), ) // Args
		);

    } // Genesis_CTA_Widget()


	//-- DISPLAY THE WIDGET --//
	function widget( $args, $instance ) {

        // TEXT ALIGN //
        $text_align_style = '';

        $text_align_style = $instance['text_align'];
        $text_align_style = 'text-align: ' . $text_align_style . '; ';


        // BACKGROUND //
        $bg_style = 'background: ';
		$bg_size_style = 'background-size: ';


        if ( $instance['bg_url'] != '' ) {
            $bg_style .= 'url(\'' . $instance['bg_url'] . '\')';
		}

        if ( $instance['bg_color'] != '' ) {
            $bg_style .= ' ' . $instance['bg_color'];
		}

        $bg_style .= ' no-repeat';

        if ( $instance['bg_position'] != '' ) {
            $bg_style .= ' ' . $instance['bg_position'];
		}

		$bg_style .= '; ';

		if ( $instance['bg_size'] != '' ) {
			$bg_size_style .= $instance['bg_size'];
		}

		// BUTTON //
		if( $instance['button_text'] ) {

	        // Button
	        $button = '';

			// Non-Modal Button
			if ( $instance['video_in_modal'] == false ) {

				if ( $instance['button_newtab'] == true ) {
					$button_target = 'target="_BLANK"';
				}

				else {
					$button_target = '';
				}

				// Start Button
		        $button .= '<a class="gcta-button" ' . $button_target . ' href="' . esc_url($instance['button_url']) . '">';

					// Config Icon
			        if ( $instance['button_icon'] != '' ) {
			            $button .= '<i class="fa fa-lg fa-' . $instance['button_icon'] . '"></i>&nbsp;&nbsp;&nbsp;';
					}

					// Set Text
					$button .= $instance['button_text'];

				// Close Button
		        $button .= '</a>';

			} // If non-modal button (regular)


			// Modal Button
			else {

				// Start Button
				$button .= '<button type="button" class="button gcta-button gcta-open-modal-button" data-toggle="modal" data-target="#gcta-modal" data-youtubeID="' . $instance['youtube_id'] . '">';

					// Config Icon
					if ( $instance['button_icon'] != '' ) {
						$button .= '<i class="fa fa-lg fa-' . $instance['button_icon'] . '"></i>&nbsp;&nbsp;&nbsp;';
					}

				// Button Text & Close
				$button .= $instance['button_text'] . '</button>';

				// Add Modal Script
				$button .= '<script>gctaYTmodal();</script>';

			} // else: Modal Button



		} // if button_text


		// VIDEO EMBED //
		$video = '';
		$video_float = $instance['video_float'];

		if ( $instance['youtube_id'] ) {

			// Width
			if ( $instance['video_width'] ) {
				$video_width = $instance['video_width'];
			} else {
				$video_width = '400';
			}

			// Height
			if ( $instance['video_height'] ) {
				$video_height = $instance['video_height'];
			} else {
				$video_height = '224';
			}

			// NON-MODAL option
			if ( $instance['video_in_modal'] == false ) {

				// Set Classes
				$video_classes = 'gcta-video';

				if ( $video_float ) {
					$video_classes .= ' gcta-video-' . $video_float;
				}


				// Output Video Embed
				$video .= '<div class="' . $video_classes .'">';

					// YouTube
					if ( $instance['youtube_id'] ) {

						$video .= '<iframe width="'. $video_width . '" height="' . $video_height . '" src="https://www.youtube-nocookie.com/embed/' . $instance['youtube_id'] . '?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';

					} // if youtube_id

				$video .= '</div>';

			} // If no modal


			// Video in Modal - Embed!
			else {

				// Fix Video Width
				if ( strpos( $video_width, "%" ) ) {
					$video_width = "640px";
				} else if ( strpos( $video_width, "px" ) == false ) {
					$video_width .= 'px';
				}

				$video .= '<div class="modal fade" id="gcta-modal" tabindex="-1" role="dialog" aria-labelledby="gcta-modal-label" area-hidden="true">';

					$video .= '<div class="modal-dialog" role="document" style="width: ' . $video_width . ';">';

						$video .= '<div class="modal-content">';

							// Close Button
							$video .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

							// Body
							$video .= '<div class="modal-body">';

								// iframe embed
								$video .= '<div class="modal-video"><iframe width="100%" height="' . $video_height . '" src="" frameborder="0"></iframe></div>';

							$video .= '</div>'; // .modal-body

							// Footer w/ Button(s)
							$video .= '<div class="modal-footer">';

								// Button
								if ( $instance['modal_button_text'] ) {

									$video .= '<a href="' . $instance['modal_button_url'] . '" class="button">';

										// Button Icon
										if ( $instance['modal_button_icon'] ) {
											$video .= '<i class="fa fa-' . $instance['modal_button_icon'] . '"></i> &nbsp; ';
										}

									$video .= $instance['modal_button_text'] . '</a>';

								} // If Modal Button Text

							$video .= '</div>'; // .modal-footer

						$video .= '</div>'; // .modal-content
					$video .= '</div>'; // .modal-dialog
				$video .= '</div>'; // .modal#gcta-modal

			} // else: Video in Modal

		} // if there's ANY embed

        // WRAPPER CLASSES //
        $wrapper_classes = '';
        $wrapper_classes .= 'widget gcta-wrap';

		// Dark Theme
        if ( $instance['theme'] == 'dark' ) {
            $wrapper_classes .= ' gcta-theme-dark';
		}

		// Missing Elements
		if ( $instance['title'] == '' ) {
			$wrapper_classes .= ' gcta-no-title';
		}
		if ( $instance['body'] == '' ) {
			$wrapper_classes .= ' gcta-no-body';
		}

		// Custom CSS
		if ( $instance['custom_css_class'] ) {
			$wrapper_classes .= ' ' . $instance['custom_css_class'];
		}


        // OUTPUT //

		echo $args['before_widget'];

        echo '<section class="' . $wrapper_classes . '" style="' . $text_align_style . $bg_style . $bg_size_style . ';">';

			if ( $video ) {
				echo $video;

			}

			if ( $instance['title'] ) {
				echo '<h3 class="widget-title widgettitle">' . $instance['title'] . '</h3>';
			}

			if ( $instance['body'] ) {
				echo '<p class="gcta-body">' . $instance['body'] . '</p>';
			}

			if ( $instance['button_text'] !== '' ) {
            	echo $button;
			}

        // Close Wrap
        echo '</section>';

		echo $args['after_widget'];

    } // widget()



	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		//-- FIELDS --//

        // Text
        $instance['title']				= $new_instance['title'];
        $instance['body']				= $new_instance['body'];
        $instance['text_align']			= strip_tags( $new_instance['text_align'] );

        // Background
        $instance['theme']          	= strip_tags( $new_instance['theme'] );
        $instance['bg_url']         	= strip_tags( $new_instance['bg_url'] );
        $instance['bg_color']       	= strip_tags( $new_instance['bg_color'] );
        $instance['bg_position']    	= strip_tags( $new_instance['bg_position'] );
		$instance['bg_size']			= strip_tags( $new_instance['bg_size'] );

        // Button
        $instance['button_text']    	= strip_tags( $new_instance['button_text'] );
        $instance['button_icon']    	= strip_tags( $new_instance['button_icon'] );
        $instance['button_url']     	= strip_tags( $new_instance['button_url'] );
		$instance['button_newtab']		= strip_tags( $new_instance['button_newtab']);

		// Video
		$instance['video_in_modal']		= strip_tags( $new_instance['video_in_modal'] );
		$instance['modal_button_text']	= strip_tags( $new_instance['modal_button_text'] );
		$instance['modal_button_url']	= strip_tags( $new_instance['modal_button_url'] );
		$instance['modal_button_icon']	= strip_tags( $new_instance['modal_button_icon'] );
		$instance['video_float']		= strip_tags( $new_instance['video_float'] );
		$instance['video_width']		= strip_tags( $new_instance['video_width'] );
		$instance['video_height']		= strip_tags( $new_instance['video_height'] );
		$instance['youtube_id']			= strip_tags( $new_instance['youtube_id'] );

		// Custom CSS Class
		$instance['custom_css_class']	= strip_tags( $new_instance['custom_css_class'] );

        return $instance;

	} // update()



    // Widget form creation
	function form( $instance ) {

        $title = '';
        $body = '';
        $text_align = '';

        $theme = '';
        $bg_url = '';
        $bg_color = '';
        $bg_position = '';
		$bg_size = '';

        $button_text = '';
        $button_icon = '';
        $button_url = '';
		$button_newtab = '';

		$video_in_modal = '';
		$modal_button_text = '';
		$modal_button_url = '';
		$modal_button_icon = '';
		$video_float = '';
		$video_width = '';
		$video_height = '';
		$youtube_id = '';

		$custom_css_class = '';


		// Check values
		if( $instance ) {

            $title          	= esc_html( $instance['title'] );
            $body           	= esc_html( $instance['body'] );
            $text_align     	= esc_attr( $instance['text_align'] );

            $theme          	= esc_attr( $instance['theme'] );
            $bg_url         	= esc_url( $instance['bg_url'] );
            $bg_color       	= esc_attr( $instance['bg_color'] );
            $bg_position    	= esc_attr( $instance['bg_position'] );
			$bg_size			= esc_attr( $instance['bg_size'] );

            $button_text    	= esc_attr( $instance['button_text'] );
            $button_icon    	= esc_attr( $instance['button_icon'] );
            $button_url     	= esc_url( $instance['button_url'] );
			$button_newtab		= esc_attr( $instance['button_newtab'] );

			$video_in_modal		= esc_attr( $instance['video_in_modal'] );
			$modal_button_text 	= esc_attr( $instance['modal_button_text'] );
			$modal_button_url 	= esc_url( $instance['modal_button_url'] );
			$modal_button_icon 	= esc_attr( $instance['modal_button_icon'] );
			$video_float		= esc_attr( $instance['video_float'] );
			$video_width		= esc_attr( $instance['video_width'] );
			$video_height		= esc_attr( $instance['video_height'] );
			$youtube_id			= esc_attr( $instance['youtube_id'] );

			$custom_css_class	= esc_attr( $instance['custom_css_class'] );

		} ?>

		<p>
			<b>TITLE &amp; SUBTITLE</b>
		</p>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('body'); ?>"><?php _e('Body / Subtitle', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>" type="text" value="<?php echo $body; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text_align'); ?>"><?php _e('Text Alignment', 'wp_widget_plugin'); ?></label>
            <select id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">

                <?php

                $text_align_options = array(
                    "left"		=>	"Left",
                    "center"	=>	"Center",
                    "right"		=>	"Right"
                );

                foreach( $text_align_options as $value=>$label ) {

                    if ( $text_align == $value )
                        echo '<option selected value="' . $value . '">' . $label . '</option>';

                    else
                        echo '<option value="' . $value . '">' . $label . '</option>';

                } // foreach

                ?>

            </select>
        </p>

        <br>

		<p>
			<b>STYLING</b>
		</p>

        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme', 'wp_widget_plugin'); ?></label>
            <select id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>">

                <?php

                $theme_options = array(
                    "light"	=>	"Light",
                    "dark"	=>	"Dark",
                );

                foreach( $theme_options as $value=>$label ) {

                    if ( $theme == $value ) {
                        echo '<option selected value="' . $value . '">' . $label . '</option>';
					} else {
                        echo '<option value="' . $value . '">' . $label . '</option>';
					}

                } // foreach

                ?>

            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('bg_url'); ?>"><?php _e('Background URL', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_url'); ?>" name="<?php echo $this->get_field_name('bg_url'); ?>" type="text" value="<?php echo $bg_url; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('bg_color'); ?>"><?php _e('BG Color (Ex: #000000)', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_color'); ?>" name="<?php echo $this->get_field_name('bg_color'); ?>" type="text" value="<?php echo $bg_color; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('bg_position'); ?>"><?php _e('CSS Background Position', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('bg_position'); ?>" name="<?php echo $this->get_field_name('bg_position'); ?>" type="text" value="<?php echo $bg_position; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('bg_size'); ?>"><?php _e('Background Size', 'wp_widget_plugin'); ?></label>
            <select id="<?php echo $this->get_field_id('bg_size'); ?>" name="<?php echo $this->get_field_name('bg_size'); ?>">

                <?php

                $bg_size_options = array(
					"auto"		=>	"auto",
                    "contain" 	=>	"contain",
                    "cover"		=>	"cover",
					"100%"		=>	"100%"
                );

                foreach( $bg_size_options as $value=>$label ) {

                    if ( $bg_size == $value ) {
                        echo '<option selected value="' . $value . '">' . $label . '</option>';
					} else {
                        echo '<option value="' . $value . '">' . $label . '</option>';
					}

                } // foreach

                ?>

            </select>
        </p>

        <br>

		<p>
			<b>BUTTON</b>
		</p>

        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_icon'); ?>"><?php _e('Button Icon (<a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_BLANK">FontAwesome</a> class suffix. Ex: "book")', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_icon'); ?>" name="<?php echo $this->get_field_name('button_icon'); ?>" type="text" value="<?php echo $button_icon; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL (Will be overridden if "Open Video In Modal" is checked.)', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
        </p>

		<p>
		    <input class="checkbox" type="checkbox" <?php checked($instance['button_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('button_newtab'); ?>" name="<?php echo $this->get_field_name('button_newtab'); ?>" />
		    <label for="<?php echo $this->get_field_id('button_newtab'); ?>">Open Link in New Tab</label>
		</p>

		<br>

		<p>
			<b>VIDEO EMBED</b>
		</p>

		<p>
            <label for="<?php echo $this->get_field_id('youtube_id'); ?>"><?php _e('YouTube Video ID', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" type="text" value="<?php echo $youtube_id; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('video_width'); ?>"><?php _e('Video Embed Width (Use pixel value if modal)', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('video_width'); ?>" name="<?php echo $this->get_field_name('video_width'); ?>" type="text" value="<?php echo $video_width; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('video_height'); ?>"><?php _e('Video Embed Height (Ignore if modal)', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('video_height'); ?>" name="<?php echo $this->get_field_name('video_height'); ?>" type="text" value="<?php echo $video_height; ?>" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('video_float'); ?>"><?php _e('Video Embed Float', 'wp_widget_plugin'); ?></label>
			<select id="<?php echo $this->get_field_id('video_float'); ?>" name="<?php echo $this->get_field_name('video_float'); ?>">

				<?php

				$video_float_options = array(
					"left"	=>	"Left",
					"right"	=>	"Right",
					"none"	=>	"None"
				);

				foreach( $video_float_options as $value=>$label ) {

					if ( $video_float == $value ) {
						echo '<option selected value="' . $value . '">' . $label . '</option>';
					} else {
						echo '<option value="' . $value . '">' . $label . '</option>';
					}

				} // foreach

				?>

			</select>
		</p>

		<p style="margin-top: 30px;">
		    <input class="checkbox" type="checkbox" <?php checked($instance['video_in_modal'], 'on'); ?> id="<?php echo $this->get_field_id('video_in_modal'); ?>" name="<?php echo $this->get_field_name('video_in_modal'); ?>" />
		    <label for="<?php echo $this->get_field_id('video_in_modal'); ?>">Open Video in Modal</label>
		</p>

		<p>
            <label for="<?php echo $this->get_field_id('modal_button_text'); ?>"><?php _e('Modal Button Text', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('modal_button_text'); ?>" name="<?php echo $this->get_field_name('modal_button_text'); ?>" type="text" value="<?php echo $modal_button_text; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('modal_button_url'); ?>"><?php _e('Modal Button URL', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('modal_button_url'); ?>" name="<?php echo $this->get_field_name('modal_button_url'); ?>" type="text" value="<?php echo $modal_button_url; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('modal_button_icon'); ?>"><?php _e('Modal Button Icon (<a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_BLANK">FontAwesome</a> class suffix. Ex: "book")', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('modal_button_icon'); ?>" name="<?php echo $this->get_field_name('modal_button_icon'); ?>" type="text" value="<?php echo $modal_button_icon; ?>" />
        </p>

		<br>

		<p>
			<b>Custom CSS</b>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('custom_css_class'); ?>"><?php _e('Custom CSS Class', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('custom_css_class'); ?>" name="<?php echo $this->get_field_name('custom_css_class'); ?>" type="text" value="<?php echo $custom_css_class; ?>" />
		</p>

	<?php }

} // class Genesis_CTA_Widget




// WIDGET STYLES
add_action( 'wp_enqueue_scripts', 'gcta_styles' );
function gcta_styles() {

	if ( !is_admin() ) {

		// GCTA Styles
		wp_enqueue_style( 'gcta', plugins_url() . '/genesis-cta-widget/css/gcta-styles.css', array() );

		// Bootstrap Modal
		wp_enqueue_script( 'bootstrap-modal', plugins_url() . '/genesis-cta-widget/js/bootstrap.min.js', array( 'jquery' ) );

		// YouTube Modal
		wp_enqueue_script( 'yt-modal', plugins_url() . '/genesis-cta-widget/js/yt-embed.js', array( 'jquery') );

	}

} // renaromano_global_styles()
