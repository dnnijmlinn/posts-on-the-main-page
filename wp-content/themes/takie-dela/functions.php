<?php
/**
 * Takie Dela functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Takie_Dela
 */

 function takiedela_enqueue_styles() {
    wp_register_style('takiedela-header', get_template_directory_uri() . '/assets/css/header.css', array(), null);
    wp_enqueue_style('takiedela-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime(get_template_directory() . '/assets/css/main.css'));
    wp_enqueue_style( 'article-style', get_template_directory_uri() . '/assets/css/article.css' );


    wp_enqueue_style('takiedela-header');
}

add_action('wp_enqueue_scripts', 'takiedela_enqueue_styles');


if ( ! function_exists( 'takie_dela_setup' ) ) :

    function takie_dela_setup() {
        add_theme_support( 'post-thumbnails' );
    }
    
    endif;
    add_action( 'after_setup_theme', 'takie_dela_setup' );
    

    function add_jquery_script() {
        wp_enqueue_script('jquery');
    }
    add_action('wp_enqueue_scripts', 'add_jquery_script');
                  
    function add_custom_js() {
        wp_register_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    
        wp_enqueue_script('custom-js');
    
        wp_localize_script('custom-js', 'custom_ajax_obj', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    add_action('wp_enqueue_scripts', 'add_custom_js');
    

        //Создать роуты для выдачи фронту по API списка постов
    //https://takidela.local.com/wp-json/my_namespace/v1/posts
    add_action('rest_api_init', function () {
        register_rest_route('my_namespace/v1', '/posts/', array(
          'methods' => 'GET',
          'callback' => 'get_my_custom_posts',
        ));
      });
      
      function get_my_custom_posts() {
        $posts = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => 10, // Или любое другое количество
        ));
    
        $data = array();
        foreach ($posts as $post) {
            $data[] = array(
                'id' => $post->ID,
                'title' => $post->post_title,
                'content' => $post->post_content,
                // Добавьте любые другие поля, которые вам нужны
            );
        }
    
        $response = new WP_REST_Response($data, 200);
        $response->set_headers(array('Content-Type' => 'application/json; charset=utf-8'));
        return $response;
    }


    function my_enqueue_assets() {
        wp_enqueue_script('load-more', get_template_directory_uri() . '/js/load-more.js', array('jquery'), '1.0', true);
    
        wp_localize_script('load-more', 'myAjax', array(
            'url' => admin_url('admin-ajax.php')
        ));
    }
    
    add_action('wp_enqueue_scripts', 'my_enqueue_assets');
    
    function load_more_posts() {
        $paged = $_POST['paged'];
        error_log('Запрос постов со страницы: ' . $paged); // Отладочное сообщение
    
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'paged'          => $paged
        );
    
        $query = new WP_Query($args);
        $output = '';
    
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
    
                $output .= '<article>';
                $output .= '<div class="post-content">';
    
                if (has_post_thumbnail()) {
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    error_log('URL изображения: ' . $img_url); // Отладочное сообщение
                    $output .= '<img width="360" height="200" src="' . $img_url . '" class="entry-thumbnail wp-post-image" alt="" decoding="async">';
                } else {
                    error_log('Миниатюра отсутствует для поста с ID: ' . get_the_ID()); // Отладочное сообщение
                }
        
                $output .= '<div class="internal-content">';
                $output .= '<header class="entry-header">';
    
                $output .= '<div class="entry-meta entry-content">' . get_the_date('d.m.Y, H:i') . '</div>';
                $output .= '<div class="entry-categories">';
                $categories = get_the_category();
                foreach ($categories as $category) {
                    $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" rel="category tag">' . esc_html($category->name) . '</a> ';
                }
                $output .= '</div>';
    
                $output .= '<h1 class="entry-title">' . get_the_title() . '</h1>';
                $output .= '</header>';
    
                $output .= '<div class="entry-content entry-description">' . get_the_content() . '</div>';
                $output .= '</div>'; // Закрываем internal-content
    
                // Авторы и прочее
                $output .= '<div class="internal-content-second">';
                $output .= '<div class="entry-footer">';
                $output .= '<div class="entry-authors">';
                $output .= '<!-- Вставка изображения -->';
                $output .= '<img src="' . get_template_directory_uri() . '/assets/images/author.png" alt="Author">';
                $output .= get_field('author_article'); 
                $output .= '</div>'; // Закрываем entry-authors
                $output .= '</div>'; // Закрываем entry-footer
                $output .= '</div>'; // Закрываем internal-content-second
    
                $output .= '</div>'; // Закрываем post-content
                $output .= '</article>';
            }
            wp_reset_postdata();
            wp_send_json_success($output);
        } else {
            wp_send_json_error('Нет постов для загрузки');
        }
        wp_die();
    }
    
    add_action('wp_ajax_load_more_posts', 'load_more_posts');
    add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
    