<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedin()) {
    Session::flash('home', 'Already logged in');
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => true,
                'check_email' => true,
                'unique' => 'users'
            ),
            'username' => array(
                'required' => true,
                'min' => Config::get('validation/username_min'),
                'max' => Config::get('validation/username_max'),
                'unique' => 'users'
            ),
            'name' => array(
                'required' => true,
                'min' => Config::get('validation/name_min'),
                'max' => Config::get('validation/name_max')
            ),
            'password' => array(
                'required' => true,
                'min' => Config::get('validation/password_min')
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'captcha' => array(
                'required' => true
            )
        ));

        if($validation->passed()) {

            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1,
                    'email' => Input::get('email'),
                    'confirmed' => 0,
                    'active' => 1
                ));

                $confirm = new Confirm();

                if($confirm->setup(Input::get('username'))){
                    echo "success";
                }

                Session::flash('home', 'An email has been sent to confirm your email');
                Redirect::to('index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error) {
                echo $error, '<br/>';
            }
        }
    }
}
?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<form action="" method="post">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
    </div>

    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
    </div>

    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="password_again">Password Again</label>
        <input type="password" name="password_again" id="password_again" value="">
    </div>

    <div class="g-recaptcha" data-sitekey="<?php echo Config::get('captcha/public_key'); ?>"></div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Register">
</form>
