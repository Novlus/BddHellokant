<?php 

require '../../../vendor/autoload.php';


echo "TEST";


$article = new hellokant\models\Article(array('name' => "Article1", 'desc' => "Description", 'price' => 20));
// $article->name = "Article1";
// $article->desc = "Description";
// $article->price = 20;
var_dump($article);


echo("Name : " . $article->__get('name'));
echo("Description : " . $article->__get('desc'));
echo("Prix : " . $article->__get('price'));

