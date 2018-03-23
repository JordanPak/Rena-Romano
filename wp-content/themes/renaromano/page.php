<?php
/**
 * Single page adjustments
 *
 * @since 2.2.0
 */


/**
 * Add "top" buttons
 *
 * @since 2.2.0
 */
function renaromano_add_top_buttons() {

	$buttons = get_field( 'top_buttons' );
	if ( ! $buttons ) { return; }

	echo '<nav class="page-top-buttons">';

		foreach ( $buttons as $button ) {
			extract( $button['link'] );
			echo "<a href='$url' target='$target' class='button button-sm'>$title</a>";
		}

	echo '</nav>';
}

add_action( 'genesis_entry_content', 'renaromano_add_top_buttons', 7 );


genesis();
