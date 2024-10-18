<?

function searchRoute() {
    register_rest_route('arbor/v1', 'collections', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'searchResult'
    ));
}

function searchResult($data) { 
    if($data['search'] == '') {
        return array('msg' => 'search term is required');
    }

    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'event', 'program'),
        's' => sanitize_text_field($data['search'])
    ));

    $result = array(
        'info' => array(),
        'professors' => array(),
        'events' => array(),
        'programs' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();
        
        if(get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($result['info'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if(get_post_type() == 'professor') {
            array_push($result['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if(get_post_type() == 'event') {
            array_push($result['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if(get_post_type() == 'program') {
            array_push($result['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
    }

    return $result; 
}

add_action('rest_api_init', 'searchRoute');