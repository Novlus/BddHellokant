<?php

/**
 * ConnexionFactory.php : fabrique pour la connexion PDO vers la base SQL
 *
 * @author Gérome Canals
 * @package hellokant
 */

namespace hellokant\connection;

use \PDO;

/**
 * Class ConnectionFactory : fabrique des connexions PDO
 * Elle implante un singleton sur la connexion.
 *
 * @package ciasie\hellokant\connection
 */
class ConnectionFactory
{

    private static $config;
    private static $db = null;


    /**
     *   makeConnection() : fabrique une instance PDO
     *
     * reçoit un tableau contenant la configuration de la connexion à la BD :
     * array ( 'db_driver'  =>  'mysql',
     *         'db_user'    =>  'user',
     *         'db_password'=>  'password',
     *         'host'       =>  'localhost',
     *         'dbname'     =>  'db',
     *         'dbport'     =>  3306 )
     *
     *   @access public
     *   @params array $conf le tableau de configuration
     *   @return PDO un nouvel objet PDO ou False en cas d'erreur
     *   @throws DBException si l'établissement de la connexion échoue
     **/
    public static  function makeConnection(array $conf)
    {

        self::$config =  $conf;

        $dbtype = self::$config['db_driver'];
        $host = self::$config['host'];
        $dbname = self::$config['dbname'];
        $user = self::$config['db_user'];
        $pass = self::$config['db_password'];
        $port = ((isset(self::$config['dbport'])) ? self::$config['dbport'] : null);

        //echo("dbtype = $dbtype, host = $host, dbname = $dbname, user = $user, pass = $pass, port = $port");

        $dsn = "$dbtype:host=$host;dbname=$dbname";


        //if (!empty($port)) $dsn .= "port=$port;";


        try {
            self::$db = new PDO($dsn, $user, $pass, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ));

            self::$db->prepare('SET NAMES \'UTF8\'')->execute();
            echo ("vous êtes connecté à la base de données");
        } catch (\PDOException $e) {
            echo ($e->getMessage()); //throw new DBException("connection: $dsn  " . $e->getMessage() . '<br/>');
        }

        return self::$db;
    }

    /**
     *   getConnection() : retourne une instance PDO créée préalablement avec makeConnection
     *
     *
     *   @access public
     *   @return PDO un nouvel objet PDO ou False en cas d'erreur
     **/

    public static function getConnection()
    {
        if (is_null(self::$db)) return false;
        return self::$db;
    }
}
//$config = parse_ini_file("conf.ini");
//$connection = ConnectionFactory::makeConnection($config);