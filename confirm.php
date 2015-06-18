<?php
require 'inc/db.php';

$user_id = $_GET['id'];
$token = $_GET['confirmation_token'];

$req = $pdo->prepare('SELECT confirmation_token FROM users WHERE id=?');
$req->execute([$user_id]);
$user = $req->fetch();

if ($user && $user->confirmation_token == $token) {
    
    die('ok');
} else {
    
    die('pas ok');
}

