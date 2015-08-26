<?php

namespace App;

require_once 'autoload.php';
use Parsers\KinogoParser;

$parser = new KinogoParser();
$parser->execute();