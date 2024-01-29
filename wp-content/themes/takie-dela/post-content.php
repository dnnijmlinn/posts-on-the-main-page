<div class="content" id="post-content">
    <?php
global $query;

$paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'paged'          => $paged,
);

// Добавьте фильтрацию по дате, если параметр date_filter установлен
// Добавьте фильтрацию по дате, если параметр date_filter установлен
if (isset($_GET['date_filter'])) {
    $date_filter = sanitize_text_field($_GET['date_filter']);
    
    // Преобразование даты в формат, который понимает WordPress
    $date_parts = explode('.', $date_filter);
    if (count($date_parts) === 3) {
        $day = $date_parts[0];
        $month = $date_parts[1];
        $year = $date_parts[2];
        $date_filter_converted = $year . '-' . $month . '-' . $day;
        
        // Записываем значение date_filter в журнал
        error_log('date_filter (original): ' . $date_filter);
        error_log('date_filter (converted): ' . $date_filter_converted);
        
        $args['date_query'] = array(
            array(
                'year'  => intval($year),
                'month' => intval($month),
                'day'   => intval($day),
            ),
        );
    } else {
        // Если дата не удалось разобрать, то не добавляем фильтрацию
        error_log('Invalid date format: ' . $date_filter);
    }
}

// Добавьте фильтрацию по категории, если параметр category_filter установлен
if (isset($_GET['category_filter'])) {
    $category_filter = intval($_GET['category_filter']);
    $args['cat'] = $category_filter;

    // Отладочная информация
}

$query = new WP_Query($args);

// Отладочная информация

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

    ?>
            <article>
                <div class="post-content">
                    <img width="360" height="200" src="<?php echo get_the_post_thumbnail_url(); ?>" class="entry-thumbnail wp-post-image" alt="" decoding="async" fetchpriority="high" srcset="<?php echo get_the_post_thumbnail_url(); ?> 360w, <?php echo get_the_post_thumbnail_url(); ?> 300w" sizes="(max-width: 360px) 100vw, 360px">
                    <div class="internal-content">
                        <header class="entry-header">
                            <div class="entry-meta entry-content">
                                <?php echo get_the_date('d.m.Y, H:i'); ?>
                            </div>

                            <div class="entry-categories">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    foreach ($categories as $category) {
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" rel="category tag">' . esc_html($category->name) . '</a> ';
                                    }
                                }
                                ?>
                            </div>

                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>

                        <div class="entry-content entry-description">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="internal-content-second">
                        <div class="entry-footer">
                            <div class="entry-authors">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/author.png" alt="Author">

                                <?php
                                $author_article = get_field('author_article'); 
                                echo $author_article; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
    <?php


        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
