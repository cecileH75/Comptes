<?php require 'inc/header.php'; ?>

<?php
if (!empty($_POST)) {

    $error = array();
    require_once 'inc/db.php';

    if (empty($_POST['username']) || !preg_match('/^[A-Za-z0-9_-éèçàù^¨]+$/', $_POST['username'])) {

        $error['username'] = "Votre pseudo n'est pas valide";
    } else {
         //chech if user aready exist
     
        $req = $pdo->prepare('SELECT id FROM users WHERE username=?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        //debug($user);
        //die();
        
        if ($user) {
            
            $error['username'] = "Ce pseudo est déjà pris";
        }
        
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $error['email'] = "Votre email n'est pas valide";
    } else {
         //chech if email aready exist
     
        $req = $pdo->prepare('SELECT id FROM users WHERE email=?');
        $req->execute([$_POST['email']]);
        $email = $req->fetch();
        //debug($user);
        //die();
        
        if ($email) {
            
            $error['email'] = "Cet email est déjà utilisé";
        }
        
    }

    if (empty($_POST['password']) || !preg_match('/^[A-Za-z0-9]+$/', $_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

        $error['password'] = "Vous devez saisir un mot de passe valide";
    }

    debug($error);

    if (empty($error)) {

        $req = $pdo->prepare("INSERT INTO users SET username=?, email=?, password=?");
        $password = md5($_POST['username']);
        $req->execute([$_POST['username'], $_POST['email'], $password]);
        die("Le compte a bien été créé");
    }
}
?>

<h1>S'inscrire</h1>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="username" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="">Mot de passe</label>
        <input type="password" name="password" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>

<?php require 'inc/footer.php'; ?>

