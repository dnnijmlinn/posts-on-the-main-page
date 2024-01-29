<?php
/**
 * Template Name: Страница записей
 */

get_header(); 
?>

<div class="content">
    <h1>Статьи</h1>
</div>

<div class="content">
    <?php get_template_part('category-filter'); ?> 
</div>

<div class="content">
    <?php get_template_part('post-content'); ?> 
</div>

<div class="content ">
    <button class="btn_download" id="load-more-button" data-paged="2">Загрузить ещё</button>
</div>


<div class="content">
    <div class="">
        <?php get_template_part('pagination-content'); ?> 
    </div>
</div>

<?php
get_footer(); 
?>
