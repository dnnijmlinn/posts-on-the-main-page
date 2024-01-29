<div class="content content-pagination">
    <?php
    global $query;

    $big = 999999999;

    $current_page = max(1, get_query_var('page', 1)); 
    error_log('Текущая страница пагинации: ' . $current_page); 

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?page=%#%',
        'current' => $current_page,
        'total' => $query->max_num_pages,
        'type' => 'array',
        'before_page_number' => '<span class="page-numbers">',
        'after_page_number' => '</span>',
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    ));
    
    if (is_array($links)) {
        echo '<div class="pagination">';
        foreach ($links as $link) {
            if (strpos($link, ">$current_page<") !== false) {
                $link = str_replace('page-numbers', 'page-numbers current', $link);
            } else {
                $link = str_replace('page-numbers current', 'page-numbers', $link);
            }
            echo $link;
        }
        echo '</div>';
    }
    ?>
</div>

