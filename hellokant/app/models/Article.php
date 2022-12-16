<?php

namespace hellokant\models;
//require '../../../vendor/autoload.php';

use hellokant\model\Model;

class Article extends Model
{
    protected static $table = 'article';
    protected static $primaryKey = 'id';
}
