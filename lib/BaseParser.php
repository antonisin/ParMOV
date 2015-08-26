<?php

/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 17.07.15
 * Time: 16:50
 */

namespace Lib;

/**
 * Class BaseParser
 * Base parser for extend Parsers.
 *
 * @author Maxim Antonisin <antonisin.maxim@gmail.com>
 * @version 0.1.beta
 */
class BaseParser
{
    /**
     * Parser list URL;
     * URL with list of pages;
     *
     * @var string
     * @access public
     */
    private $listURL;

    /**
     * Parser search URL;
     * URL for find content by parameters, ex. by name
     *
     * @var string
     * @access public
     */
    private $searchURL;

    /**
     * First page for parse lists of items;
     * By default first page is set (int) 1;
     *
     * @access public
     * @var int
     */
    private $firstPage = 1;

    /**
     * Page limit for parse list of items;
     * By default page limit is set (int) 10;
     *
     * @access public
     * @var int
     */
    private $pageLimit = 10;

    /**
     * Return page list array of URL's
     *
     * @access private
     * @return array [URL0, URL1, ... URLn];
     * @version 0.1.beta
     */
    protected function parseAllPage()
    {
        $sources = [];

        /** @noinspection HtmlUnknownTarget */
        $pattern = '/<h2 class="zagolo.*"><a href="(.*)">/';

        /** Print Message */
        self::printMsg('Start parsing page list');

        for ($i = $this->getFirstPage(); $i <= $this->getPageLimit(); $i++) {
            /** @noinspection PhpUsageOfSilenceOperatorInspection */
            $content = @file_get_contents($this->getListURL() . $i . '/');
            preg_match_all($pattern, $content, $result);
            $sources = array_merge($sources, $result[1]);

            /** Print message */
            self::printMsg('Parse page ' . $i . ' (URL: ' . $this->getListURL() . $i . '/)');
        }

        return $sources;
    }

    /**
     * Return (string) $listURL;
     *
     * @access private
     * @return string
     */
    public function getListURL()
    {
        return $this->listURL;
    }

    /**
     * Set (string) $listURL;
     * Return instance of $this class;
     *
     * @access private
     * @param  string $listURL
     * @return mixed  Instance of $this class
     */
    public function setListURL($listURL)
    {
        $this->listURL = $listURL;

        return $this;
    }

    /**
     * Return (string) $searchURL;
     *
     * @access private
     * @return string
     */
    public function getSearchURL ()
    {
        return $this->searchURL;
    }

    /**
     * Set (string) $searchURL;
     * Return instance of $this class;
     *
     * @access private
     * @param string $searchURL
     * @return mixed Instance of $this class
     */
    public function setSearchURL ($searchURL)
    {
        $this->searchURL = $searchURL;

        return $this;
    }

    /**
     * Return (int) $firstPage value;
     *
     * @access private
     * @return int
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * Set (int) $firstPage value;
     * Return instance of $this class
     *
     * @access private
     * @param  int $firstPage
     * @return mixed Instance of $this class
     */
    public function setFirstPage($firstPage)
    {
        $this->firstPage = $firstPage;

        return $this;
    }

    /**
     * Return (int) $pageLimit value;
     *
     * @access private
     * @return int
     */
    public function getPageLimit()
    {
        return $this->pageLimit;
    }

    /**
     * Set (int) $pageLimit value;
     * Return instance of $this class;
     *
     * @access private
     * @param int $pageLimit
     * @return mixed Instance of $this class
     */
    public function setPageLimit($pageLimit)
    {
        $this->pageLimit = $pageLimit;

        return $this;
    }

    /**
     * Echo string message
     * Debug method
     *
     * @access private
     * @param string $message Msg string for print
     * @version 0.1.beta
     */
    public function printMsg($message)
    {
        echo $message . "\n";
    }
}