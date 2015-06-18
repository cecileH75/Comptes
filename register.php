<?php

require 'inc/function.php';
if (!empty($_POST)) {

    $errors = array();
    require_once 'inc/db.php';
    
    
    if (empty($_POST['username']) || !preg_match('/^[A-Za-z0-9_-éèçàù^¨]+$/', $_POST['username'])) {

        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        //chech if user aready exist

        $req = $pdo->prepare('SELECT id FROM users WHERE username=?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        //debug($user);
        //die();

        if ($user) {

            $errors['username'] = "Ce pseudo est déjà pris";
        }
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $errors['email'] = "Votre email n'est pas valide";
    } else {
        //chech if email aready exist

        $req = $pdo->prepare('SELECT id FROM users WHERE email=?');
        $req->execute([$_POST['email']]);
        $email = $req->fetch();
        //debug($email);
        //die();

        if ($email) {

            $errors['email'] = "Cet email est déjà utilisé pour un autre compte";
        }
    }

    if (empty($_POST['password']) || !preg_match('/^[A-Za-z0-9]+$/', $_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

        $errors['password'] = "Vous devez saisir un mot de passe valide";
    }

    debug($errors);

    if (empty($errors)) {

        $req = $pdo->prepare("INSERT INTO users SET username=?, email=?, password=?, confirmation_token=?");
        $password = md5($_POST['username']);
        $token = str_random(60);
        $req->execute([$_POST['username'], $_POST['email'], $password, $token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST['email'], 'Confirmation de de la création de votre compre', 
                "Afin de valider votre compte, merci de cliquer ce lien.\n\nhttp://localhost/Lab/Comptes/confirm.php?id=$user_id&token = $token");
        //header('Location: login.php');
        printf( "http://localhost/Lab/Comptes/confirm.php?id=$user_id&token = $token");
        exit();
    }
}
?>

<?php require 'inc/header.php'; ?>
<h1>S'inscrire</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <h4>Vous n'avez pas rempli le formulaire correctement.</h4>
        <?php foreach ($errors as $error): ?>
            <ul>
                <li><?php echo $error; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

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

