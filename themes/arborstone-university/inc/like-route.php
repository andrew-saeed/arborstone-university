<?

function likeRoute() {
    register_rest_route('arbor/v1', 'likes', array(
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'createPost'
    ));

    register_rest_route('arbor/v1', 'likes', array(
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'deletePost'
    ));
}

function createPost($data) {
    if(is_user_logged_in()) {

        $professorId = sanitize_text_field($data['professorId']);

        $userHasData = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'professor_id',
                    'compare' => '=',
                    'value' => $professorId
                )
            )
        ));
        wp_reset_postdata();
    
        if($userHasData->found_posts == 0 AND get_post_type($professorId) == 'professor') {
            $likeId = wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'meta_input' => array(
                    'professor_id' => $professorId
                )
            ));

            wp_send_json(['likeId' => $likeId], 200);
        } else {
            wp_send_json(['message' => 'you already gave feedback'], 400);
        }
    } else {
        wp_send_json(['message' => 'you are not logged in'], 403);
    }

}

function deletePost($data) {
    $likeId = sanitize_text_field($data['likeId']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) AND 
    get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);
        wp_send_json(['message' => 'like was delete'], 200);
    } else {
        wp_send_json(['message' => 'forbidden'], 403);
    }
}

add_action('rest_api_init', 'likeRoute');