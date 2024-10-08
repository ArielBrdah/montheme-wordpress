<?php

require_once('metaboxes/sponso.php');
require_once('options/agence.php');
require_once('options/cron.php');


require_once('walker/CommentWalker.php');

/**
 * @description: return customised anchor for taxonomy menu  
 * @return string
 * @var WP_TERM Object
 */
function montheme_anchor($item)
{
    $href = "href='" . get_term_link($item) . "'";
    $active = is_tax('sport', $item->term_id) ? 'active rounded-0' : '';
    $class = "class=' p-2 px-3 nav-link $active'";
    $label = $item->name;
    return "<a $href $class>$label</a>";
}

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5');
    add_theme_support('page-attributes');
    register_nav_menu('header', 'En tete du menu');
    register_nav_menu('footer', 'Pied de page');
    add_image_size('card-header', 350, 215, true);
}


function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_register_script('bootstrapjs', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js', [], null, true);
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], null, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrapjs');
    wp_enqueue_script('jquery');
}

function montheme_title()
{
    return 'ArielBerdah.com';
}
function montheme_title_separator()
{
    return '|';
}

function montheme_document_title_parts($title)
{
    $title['tagline'] = 'Le site du bejaoua';
    $title['truc'] = 'Accueil';
    return $title;
}

function montheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) return;
    echo "<nav aria-label='Page navigation example'>";
    echo "<ul class='pagination'>";
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = "page-item";
        if ($active) $class .= ' active';
        echo "<li class='" . $class . "'>";
        echo str_replace('page-numbers', 'page-link', $page);
        echo "</li>";
    }
    echo "</ul>";
    echo "</nav>";
}

function montheme_the_excerpt($post)
{
    return "<p>" . substr($post, 0, 100) . "...</p>";
}

function montheme_init()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'plural_name' => 'Sports',
            'search_items' => 'Rechercher des sports',
            'all_items' => 'Tous les sports',
            'edit_item' => 'Editer le sport',
            'update_item' => 'Mettre a jour le sport',
            'add_new_item' => 'Ajouter un nouveau sport',
            'new_item_name' => 'Ajouter un nouveau sport',
            'menu_name' => 'Sport',
        ],
        'show_in_rest' => true,
        'show_admin_column' => true
    ]);
    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true

    ]);
}


add_action('init', 'montheme_init');
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('wp_title', 'montheme_title');
add_filter('document_title_separator', 'montheme_title_separator');
add_filter('document_title_parts', 'montheme_document_title_parts');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');
add_filter('the_excerpt',  'montheme_the_excerpt');
// add_action('add_meta_boxes', 'montheme_add_custom_box');
// add_action('save_post', 'montheme_save_sponso');

SponsoMetabox::register();
AgenceMenuPage::register();

add_filter('manage_bien_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date'],
    ];
});

add_filter('manage_bien_posts_custom_column', function ($column, $postId) {
    if ($column === 'thumbnail') the_post_thumbnail('thumbnail', $postId);
}, 10, 2);


add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});


add_filter('manage_post_posts_columns', function ($columns) {
    return [
        ...$columns,
        'sponso' => 'sponso'
    ];
});

add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        $checked = 'yes';
        if (!get_post_meta($postId, SponsoMetabox::META_KEY, true)) $checked = 'no';
        else $checked = 'yes';

        echo "<div class='bullet bullet-" . $checked . "'></div>";
    }
}, 10, 2);

function montheme_pre_get_posts($query)
{
?>
    <pre>
    <?php
    //        var_dump($query);
    //      die(); 
    ?>
   </pre>
<?php
}
// add_action('pre_get_posts','montheme_pre_get_posts');

require_once('widgets/YoutubeWidget.php');
function montheme_register_widget()
{
    register_widget(YoutubeWidget::class);

    register_sidebar([
        'id' => 'homepage',
        'name' => __('Sidebar Accueil', 'montheme'),
        'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',
        'after_title' => '</h4>'
    ]);
}
add_action('widgets_init', 'montheme_register_widget');


add_filter('comment_form_default_fields', function ($fields) {
    foreach ([['email','email'], ['name','author'], ['website','url'],['comment','comment']] as $key) {

        if($key[0] == 'comment') {
            $fields[$key[1]] = <<<HTML
    <div class="form-group">
        <label for="${key[1]}" class="form-label text-capitalize">${key[0]}</label>
        <textarea class="form-control" name="${key[1]}" id="${key[1]}" required>
    </div>  
HTML;
            continue;
        }
        $fields[$key[1]] = <<<HTML
    <div class="form-group">
        <label for="${key[1]}" class="form-label text-capitalize">${key[0]}</label>
        <input type="text" class="form-control" name="${key[1]}" id="${key[1]}" required>
    </div>  
HTML;
    }

    return $fields;
});


add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('switch_theme', 'flush_rewrite_rules');

require_once('options/apparence.php');

add_action('after_setup_theme', function () {
    load_theme_textdomain('montheme', get_template_directory().'/languages');
});

add_action ( 'rest_api_init', function() {
    register_rest_route('montheme/v1', '/demo/(?P<slug>[a-zA-Z0-9-]+)', 
        [ 
            'methods' => 'GET', 
            'callback' => function(WP_REST_Request $request) {
                $response = new WP_REST_Response(['succcess'=> 'Youpiiii !']);
                $response->set_status(201);
                $id = $request->get_query_params('id');
                $slug = $request->get_param('slug');
                return $response;
            }
        ]);
    register_rest_route('montheme/v1', '/posts/(?P<id>\d+)', 
        [ 
            'methods' => 'GET', 
            'callback' => function(WP_REST_Request $request) {
                
                $id = $request->get_param('id');
                $post = get_post($id);
                $response = new WP_REST_Response(['title' => $post->post_title, 'content' => $post->post_content ]);
                $response->set_status(201);
                return $response;
                },
            'permission_callback' => function( ){
                return current_user_can('edit_posts');
            }
        ]);
});


add_filter('rest_authentication_errors', function ($result) {
  global $wp;
  if(strpos( $wp->query_vars['rest_route'], 'montheme/v1' ) !== false){
    return true;
  }
  
   return $result;
}, 9);





/**
 * @var wpdb $wpdb
 */

// global $wpdb;
// $tag="\"tag1";
// 
// $query      = $wpdb->prepare("SELECT name FROM {$wpdb->terms} WHERE tag=%s",[$tag]);
// $results    = $wpdb->get_results($query);
// 
// echo "<pre>";
// var_dump($results);
// echo "</pre>";
// die();