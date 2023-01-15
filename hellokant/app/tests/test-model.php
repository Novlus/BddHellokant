<?php

use hellokant\models\Article;
use hellokant\query\Query;


require '../../../vendor/autoload.php';
require_once '../models/Article.php';


echo "TEST..............";


$article = new hellokant\models\Article(array('name' => "Article1", 'description' => "Description", 'price' => 20), parse_ini_file("../../src/connection/conf.ini"));
$article->name = "Article1";
$article->desc = "Description";
$article->price = 20;

// $article1 = new hellokant\models\Article(array('name' => "Article2", 'desc' => "Description: Article2", 'price' => 200), parse_ini_file("../../src/connection/conf.ini"));
// var_dump($article1->attributes);
// $article1->delete();
$test = new hellokant\models\Article(array('name' => "TESSSST", 'description' => "Description: TESSSSSST", 'price' => 20000), parse_ini_file("../../src/connection/conf.ini"));
// $test->insert();
// var_dump($test);
// $test->delete();
// var_dump($article);


// echo ("Name : " . $article->__get('name'));
// echo ("Description : " . $article->__get('desc'));
// echo ("Prix : " . $article->__get('price'));

// $query = new hellokant\query\Query('article', parse_ini_file("../../src/connection/conf.ini"));

//Delete
//$query->where('id', '=', 3);
//$query->delete(); // le parametre est le fichier de config pour la connection à la bdd 

// Insert
// $query->setField('name');
// $query->insert('\'TESSSSST\'');
// $query->setField('description');
// $query->insert('\'Petite description TEST\'');
// $query->setField('price');
// $query->insert(20000000);


// $id = $query->insert(array('name' => "Article10TEST", 'description' => "DescriptionTEST", 'price' => 50000));

// $article = Article::all();
// foreach ($article as $art) {
//     printf("\nName : " . $art->__get('name'));
// }
// var_dump($article);

// $article = Article::find(11);
// echo ("FIND!!!!!!: ");
// var_dump($article[0]);


// $article = Article::one(8);
// var_dump($article);


$article = Article::find(['name', 'price'], 21);
var_dump($article);

// $article = Article::find();
// var_dump($article);


//$article = Article::find(['name', 'price'], 7);
//var_dump($article);
