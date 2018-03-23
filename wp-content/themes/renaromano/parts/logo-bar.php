<?php
/**
 * RENA ROMANO
 * "As Seen On" Logo Bar
 */

// Get meta
$meta = get_fields();

if ( $meta['logos'] ) : ?>
	<section class="logo-bar">

		<h2>As Seen On</h2>

		<section>
			<?php foreach ( $meta['logos'] as $logo ) : if ( $logo['logo'] ) :

				echo ( $logo['url'] ) ? '<a href="' . $logo['url'] . '" target="_blank">' : '<figure>'; ?>

					<img src="<?php echo $logo['logo']['sizes']['medium']; ?>" alt="<?php echo ( $logo['title'] ) ? $logo['title'] : $logo['logo']['alt']; ?>" />

				<?php echo ( $logo['url'] ) ? '</a>' : '</figure>';

			endif; endforeach; ?>
		</section>

	</section><!-- .logo-bar -->
<?php endif;
