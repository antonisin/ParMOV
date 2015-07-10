<?php
/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 10.07.15
 * Time: 14:51
 */

require_once('lib/ParseClass.php');

/** Include defaults settings */
include_once('settings/settings.php');


$startTime = microtime(true);
$parsers[0]->execute();

echo microtime(true) - $startTime;

//$parser = new ParseClass();
//$parser->setDonors($donors);



//var_dump($parser->getDonors());
