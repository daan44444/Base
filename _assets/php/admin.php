<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn() || !$user->hasPermission('moderator')) {
    Redirect::to(404);
}

?>
