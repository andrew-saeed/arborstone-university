<?

define('HMR_HOST', 'http://localhost:4200/wp-content/themes/arborstone-university/');

require get_theme_file_path('inc/search-route.php');

function theme_files() {

    $js = '';
    $style = '';
    
    if( !is_wp_error(wp_remote_get(HMR_HOST)) ) {
        $js = HMR_HOST . 'src/main.js';
        wp_enqueue_script_module('theme_main_js', $js, [], false);

        $style = HMR_HOST . 'src/style.scss';
    } else {
        $manifest = [];
        $path = dirname(__FILE__) . '/dist/manifest.json';
        if(empty($path) || !file_exists($path)) {
            wp_die('Run: <code>`npm run build`</code> in your application root!');
        }
        $manifest = json_decode(file_get_contents($path), true);

        $js = get_theme_file_uri('/dist/' . $manifest['src/main.js']['file']);
        wp_enqueue_script('theme_main_js', $js, null, null, ['in_footer'=>true]);

        $style = get_theme_file_uri('/dist/' . $manifest['src/style.scss']['file']);
    }

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    wp_enqueue_style('theme_main_style', $style);
}
add_action('wp_enqueue_scripts', 'theme_files');

function theme_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_post_type_support( 'page', 'excerpt' );
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
}
add_action('after_setup_theme', 'theme_features');

function remove_archive_title_prefix($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_year()) {
        $title = get_the_date('Y');
    } elseif (is_month()) {
        $title = get_the_date('F Y');
    } elseif (is_day()) {
        $title = get_the_date('F j, Y');
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    
    return $title;
}
add_filter('get_the_archive_title', 'remove_archive_title_prefix');

function adjust_queries($query) {
    if(!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
    if(!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
}
add_action('pre_get_posts', 'adjust_queries');

function customize_rest() {
    register_rest_field('post', 'author_name', array(
        'get_callback' => function() {return get_the_author();}
    ));
}
add_action('rest_api_init', 'customize_rest');

function redirectSubsToHomePage() {
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
add_action('admin_init', 'redirectSubsToHomePage');

function hideAdminbarForSubscribers() {
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}
add_action('wp_loaded', 'hideAdminbarForSubscribers');

// Customize Login page
add_action('login_enqueue_scripts', 'theme_files');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourHeaderUrl');

function login_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'login_title' );

// note rest api
function add_author_filter_to_rest_api( $args, $request ) {
    if ( isset( $request['author'] ) ) {
        $args['author'] = sanitize_text_field( $request['author'] );
    }
    return $args;
}

add_filter( 'rest_note_query', 'add_author_filter_to_rest_api', 10, 2 );

?>

<? function pageBanner($args = NULL) {
    
    $photo = $args['photo'] ?? get_theme_file_uri('/images/office.webp');
    $title = $args['title'] ?? get_the_title();
    $excerpt = $args['excerpt'] ?? get_the_excerpt(); ?>

    <section id="page-banner">
        <div id="page-banner__bg" style="background-image: url('<?= $photo; ?>')"></div>
        <div id="page-banner__box">
            <h1 id="page-banner__title"><?= $title; ?></h1>
            <p id="page-banner__intro"><?= $excerpt; ?></p>
        </div>
    </section>

<?  } ?>