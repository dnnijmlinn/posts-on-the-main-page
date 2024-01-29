<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Takie_Dela
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
    <div class="content">
        <!-- Логотип в виде ссылки на главную страницу -->
        <a href="<?php echo home_url(); ?>" class="header__logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/takiedela.png" alt="Takie Dela Logo" class="header__logo">
        </a>
    </div>
</header>

<!-- остальная часть сайта -->

<?php wp_footer(); ?>
</body>
</html>
