<?php

/**
 * Created by PhpStorm.
 * User: Maxim Antonisin
 * Date: 10.07.15
 * Time: 14:12
 */

require_once('UtilsClass.php');
require_once('MysqlClass.php');


/**
 * Class ParseClass
 *
 * @author Maxim Antonisin <antonisin.maxim@gmail.com>
 * @version 0.1.beta
 */
class ParseClass
{
    /**
     * Parser array of donors urls
     * ['donor1', 'donor2', ... , 'donorN']
     *
     * @access public
     *
     * @var array
     */
    private $donors;

    /**
     * Return donors($donors) array
     *
     * @access private
     *
     * @return array
     */
    public function getDonors()
    {
        return $this->donors;
    }

    /**
     * Set donors($donors) array
     * ['donor1', 'donor2', ... 'donorN']
     *
     * @access private
     *
     * @param array $donors Donors array
     * @return ParseClass
     */
    public function setDonors(array $donors)
    {
        $this->donors = $donors;

        return $this;
    }
}