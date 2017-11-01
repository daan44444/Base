<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'rdbms.strato.de', //Enter host here
        'username' => 'U3146805', //Enter username here
        'password' => 'abcfa56401013a', //Enter password here
        'db' => 'DB3146805' //Enter db here
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    ),
    'validation' => array(
        'username_min' => 2,
        'username_max' => 20,
        'name_min' => 2,
        'name_max' => 50,
        'password_min' => 6
    ),
    'confirm' => array(
        'location' => 'https://daanaerts.com/_assets/php/confirm.php',
        'from' => 'Daan Aerts <confirm@daanaerts.com>',
        'reply_to' => 'Daan Aerts <confirm@daanaerts.com>',
        'valid_time' => '+1 hour'
    ),
    'forgot' => array(
        'location' => 'https://daanaerts.com/_assets/php/forgot.php',
        'from' => 'Daan Aerts <forgot@daanaerts.com>',
        'reply_to' => 'Daan Aerts <forgot@daanaerts.com>',
        'valid_time' => '+1 hour'
    ),
    'captcha' => array(
        'secret_key' => '6LdGcTYUAAAAAPfUmfzMoinS58ZVhiHPGVF6A-SK',
        'public_key' => '6LdGcTYUAAAAAOuP5JLpLrfOxk61Q6RWEPsxK7n0'
    ),
    'lang' => array(
        'default' => 'en',
        'languages' => 'en', //languages in xml file (format: lang,lang)
        'xml_loaction' => $_SERVER['DOCUMENT_ROOT'].'/_assets/xml/languages/languages.xml',
        'expiry' => 604800
    ),
    'meta' => array(
        'author' => '',
        'description' => '',
        'keywords' => 'HTML,CSS,XML,JavaScript,PHP',
        'safari-pt-background' => '#2F3BA2', // safari pinned tab bg (silhouet)
        'web-app-title' => 'daanaerts', //apple and android web app title
        'theme-color' => '#2F3BA2', //mobile status bar color
        'IE-tile-color' => '#2F3BA2' //Windows pinned to start background
    )
);

spl_autoload_register(function($class) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/_assets/php/classes/' . $class . '.php';
});

require_once $_SERVER['DOCUMENT_ROOT'].'/_assets/php/functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
