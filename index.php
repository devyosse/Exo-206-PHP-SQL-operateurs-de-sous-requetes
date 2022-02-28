<?php

/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */

$server = 'localhost';
$user = 'root';
$pass = '';
$db = "exo206";

try{


    $conn = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $request = $conn->prepare("SELECT * FROM user");

    if ($request->execute()){
        foreach ($request->fetchAll() as $value){
            echo "<p>" . $value['username'] . "</p>";
        }
    }

    $request = $conn->prepare("SELECT * FROM article");

    if ($request->execute()){
        foreach ($request->fetchAll() as $value){
            echo "<p>" . $value['titre'] . "</p>";
             echo "<p>" . $value['contenu'] . "</p>";
        }
    }

    $request = $conn->prepare("SELECT * FROM user WHERE EXISTS (SELECT * FROM article WHERE article.user_fk = user.id)");
    if ($request->execute()){
        foreach ($request->fetchAll() as $value){
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }


    $request = $conn->prepare("SELECT * FROM user WHERE EXISTS (SELECT * FROM article WHERE article.user_fk = user.id)");
    if ($request->execute()){
        foreach ($request->fetchAll() as $value){
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }
}
catch (PDOException $e){
    die($e->getMessage());
}
