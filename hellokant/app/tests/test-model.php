<?php

use hellokant\models\Article;
use hellokant\query\Query;


require '../../../vendor/autoload.php';
require_once '../models/Article.php';


echo "TEST..............";


$article = new hellokant\models\Article(array('name' => "Article1", 'desc' => "Description", 'price' => 20), parse_ini_file("../../src/connection/conf.ini"));
$article->name = "Article1";
$article->desc = "Description";
$article->price = 20;
// var_dump($article);


// echo ("Name : " . $article->__get('name'));
// echo ("Description : " . $article->__get('desc'));
// echo ("Prix : " . $article->__get('price'));

//$query = new hellokant\query\Query('article', parse_ini_file("../../src/connection/conf.ini"));

//Delete
//$query->where('id', '=', 3);
//$query->delete(); // le parametre est le fichier de config pour la connection à la bdd 

// Insert
// $query->setField('name');
// $query->insert('\'David\'');
// $query->setField('description');
// $query->insert('\'Petite description\'');
// $query->setField('price');
// $query->insert(20);

// $id = $query
//     ->insert(array('name' => "Article10", 'description' => "Description", 'price' => 50));

// $article = Article::all();
// // foreach ($article as $art) {
// //     printf("\nName : " . $art->__get('name'));
// // }
// var_dump($article);

// $article = Article::find();
// var_dump($article);

$article = Article::find([8, 9]);
var_dump($article);

//$article = Article::find(['name', 'price'], 7);
//var_dump($article);
