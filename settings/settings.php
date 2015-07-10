<?php
/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 10.07.15
 * Time: 14:52
 */

require_once('parsers/zhdParser.php');

/**
 * host     => Mysql host url
 * port     => Mysql host port
 * user     => Mysql user name
 * password => Mysql user password
 * database => Mysql default database
 */
$settings = [
    'host' => 'localhost',
    'port' =>  3306,
    'user' => 'root',
    'password' => '',
    'database' => ''
];

$donors = [
    'http://mail.ru'
];

$parsers = [
    new zhdParser()
];