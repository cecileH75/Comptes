<?php require 'inc/header.php'; ?>

<?php
if (!empty($_POST)) {

    $error = array();

    if (empty($_POST['username']) || !preg_match('/^[A-Za-z0-9_-éèçàù^¨]+$/', $_POST['username'])) {

        $error['username'] = "Votre pseudo n'est pas valide";
    }

    debug($error);
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
        <input type="password" name="mot de passe" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>

<?php require 'inc/footer.php'; ?>

