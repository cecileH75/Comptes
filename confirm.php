<?php
require 'inc/db.php';

$user_id = $_GET['id'];


$req = $pdo->prepare('SELECT confirmation_token FROM users WHERE id=?');
$req->execute([$user_id]);
$user = $req->fetch();
$token = $_GET['confirmation_token'];
if ($user && $user->confirmation_token == $token) {
    
    die('ok');
} else {
    
    die('pas ok');
}

