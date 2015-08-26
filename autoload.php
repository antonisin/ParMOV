<?php
new Parsers\KinogoParser();
new Lib\BaseParser();

/**
 * @param string $class
 */
function __autoload($class)
{
    $class = str_replace('\\', '/', $class);

    /** @noinspection PhpIncludeInspection */
    require_once($class . '.php');
}
