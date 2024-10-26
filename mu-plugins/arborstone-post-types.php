<?

function arborstone_post_types() {

    register_post_type('event', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'show_in_rest' => true,
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
        'show_in_rest' => true,
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

    register_post_type('professor', array(
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new' => 'Add New Professor',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'public' => false,
        'show_ui' => true,
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new' => 'Add New Note',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));
}

add_action('init', 'arborstone_post_types');