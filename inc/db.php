<?php

//connect to database
$pdo = new PDO('mysql:dbname=tuto;host=localhost', 'root', 'root');
//advise about issues
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//get elements into object
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

