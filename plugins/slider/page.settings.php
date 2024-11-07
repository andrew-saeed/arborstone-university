<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <? $active_tab = $_GET['tab'] ?? 'main_options' ?>
    <h2 class="nav-tab-wrapper">
        <a 
            href="?page=slider-admin&tab=main_options" 
            class="nav-tab <?= $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>"
        >Main Options</a>
        <a 
            href="?page=slider-admin&tab=additional_options"
            class="nav-tab <?= $active_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>"
        >Additional Options</a>
    </h2>
    <form action="options.php" method="POST">
        <? 
            if($active_tab == 'main_options') {
                settings_fields('slider_group');
                do_settings_sections('slider_page1');
            } else if($active_tab == 'additional_options') {
                settings_fields('slider_group');
                do_settings_sections('slider_page2');
            }
            submit_button('Save Settings');
        ?>
    </form>
</div>