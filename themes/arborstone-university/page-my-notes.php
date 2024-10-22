<? if(!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
} ?>

<? get_header(); ?>

<? while( have_posts() ): the_post(); ?>

    <? pageBanner(); ?>
    
    <main>
        <div id="main-box">

            <div id="main-content">
                
                <ul id="notes-list">
                    <? 
                        $myNotes = new WP_Query(array(
                            'post_type' => 'note',
                            'posts_per_page' => -1,
                            'author' => get_current_user_id()
                        )); 
                        
                        while($myNotes->have_posts()): $myNotes->the_post(); 
                    ?>
                        <li data-id="<?= get_the_ID() ?>" x-data="note">
                            <div class="note-box pb-20">
                                <button class="btn btn--small btn--outline with-icon" @click="deleteItem">
                                    <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    <span>delete</span>
                                </button>
                                <input name="title" id="title" type="text" value="<?= esc_attr(get_the_title()); ?>">
                                <textarea name="content" id="content" rows="6"><?= esc_attr(wp_strip_all_tags(get_the_content())); ?></textarea>
                            </div>
                        </li>
                    <? endwhile; ?>
                </ul>
            </div>
        </div>
    </main>
<? endwhile; ?>

<? get_footer(); ?>