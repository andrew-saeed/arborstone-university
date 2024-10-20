<?

add_action('register_form', 'add_custom_register_fields');

add_filter('registration_errors', 'handle_validation_errors', 10, 3);

add_action('user_register', 'handle_form_submit');

function add_custom_register_fields() { ?>

    <p>
        <label for="first_name">First name</label>
        <input type="text" name="first_name" id="first_name">
    </p>

    <p>
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" id="last_name">
    </p>

    <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </p>

    <p>
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" id="confirm_password">
    </p>

<? }

function handle_validation_errors($errors, $sanitized_user_login, $user_email) {
    
    if(empty($sanitized_user_login)) {
        $errors->remove('empty_username');
        $errors->add('empty_username', 'Username is required');
    }
    if(empty($_POST['user_email'])) {
        $errors->remove('empty_email');
        $errors->add('empty_email', 'Email is required');
    } elseif (!is_email($user_email)) {
        $errors->remove('invalid_email');
        $errors->add('invalid_email', 'Email address is not valid');
    } elseif (email_exists($user_email)) {
        $errors->remove('email_exists');
        $errors->add('email_exists', 'Email is already used');
    }
    if(empty($_POST['first_name'])) $errors->add('first_name_error', 'First name is required');
    if(empty($_POST['last_name'])) $errors->add('last_name_error', 'Last name is required');
    if(empty($_POST['password'])) $errors->add('password_error', 'Password is required');
    if(empty($_POST['confirm_password'])) $errors->add('confirm_password_error', 'Confirm password is required');
    if(
        !empty($_POST['password']) &&
        !empty($_POST['confirm_password']) &&
        $_POST['confirm_password'] != $_POST['password']
    ) {
        $errors->add('password_match_error', 'Password doesn\'t match ');
    }

    return $errors;
}

function handle_form_submit($user_id) {

    if(isset($_POST['first_name']) && !empty($_POST['first_name'])) update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    if(isset($_POST['last_name']) && !empty($_POST['last_name'])) update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    if(isset($_POST['password']) && !empty($_POST['password'])) wp_set_password(sanitize_text_field($_POST['password']), $user_id);

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
    wp_redirect(home_url());
    exit();
}