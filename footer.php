<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package davocate1
 */

?>

	<footer class="footer bg-teal">
		<div class="content content-padding flex tablet-1 align-center">
			<img class="logo" alt="DAvocate1 Study logo" src="<?= get_template_directory_uri() ?>/assets/images/logo.svg" />
			<p>&#169;<?= date("Y") ?> DAvocate1. All rights reserved.</p>
		</div>
	</footer><!-- footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
