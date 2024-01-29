<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Takie_Dela
 */

get_header();


?>




<main id="primary" class="site-main">
	<div class="content">
		<h2 class="page-title"><?php echo get_the_title($page_id); ?></h2>
	</div>

	<!-- Переместите фильтр категорий сюда -->
	<div class="content">
		<?php include get_template_directory() . '/category-filter.php'; // Включаем фильтр категорий ?>
	</div>
	
	<div class="content">
		<div class="posts-row">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
		</div>
	</div>

</main><!-- #main -->



<?php
get_sidebar();
get_footer();


