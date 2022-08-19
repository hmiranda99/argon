<?php
header("Location: ./categories.page.php");
require_once('../../../database/Connection.php');
require_once("./Categorie.class.php");

$categorie = new Categorie();

$categorie->setNomeCategoria($_POST['input-categories']);
$categorie->register($categorie);