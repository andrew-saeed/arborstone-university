<?

function arborstone_post_types() {

    register_post_type('event', array(
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'labels' => array(
            'name' => 'Events',
            'add_new' => 'Add New Event',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    register_post_type('program', array(
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'programs'),
        'labels' => array(
            'name' => 'Programs',
            'add_new' => 'Add New Program',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));
}

add_action('init', 'arborstone_post_types');