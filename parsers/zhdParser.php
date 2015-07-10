<?php

/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 10.07.15
 * Time: 16:17
 */


/**
 * Class zhdParser
 * @author Maxim Antonisin <antonisin.maxim@gmail.com>
 * @version 0.1.beta
 */
class zhdParser
{
    /** Base URL */
    const URL = 'http://zhd.life/film/page/';
    const HTTP_REQUEST_FAILED = ' HTTP/1.1 404 Not Found';

    /**
     * HTML page content
     *
     * @access public
     *
     * @var string
     */
    private $content = '';

    /**
     * Execute/call parse page
     *
     * @access public
     *
     * @version 0.1.beta
     */
    public function execute()
    {
        $result = $this
            ->getPagesContent()
            ->getUrls();
        var_dump(self::formatResults($result));
    }

    /**
     * Get URL's
     * Return all URL's from page(s) content($content)
     * [
     *      '0' => patterns output,
     *      '1' => URL's,
     *      '2' => URL names
     * ]
     *
     * @access private
     *
     * @return mixed
     * @version 0.1.beta
     */
    private function getUrls()
    {
        /** @noinspection HtmlUnknownTarget */
        $pattern = '/class=\"info-poster\"><a href=\"(\S*)\"><h3>(\D*)<\/h3>/';
        preg_match_all($pattern, $this->getContent(), $output);

        return $output;
    }

    /**
     * Get pages content
     * Parse array of pages by URL's
     * Ex. 'http://zhd.life/film/page/[:id]'
     *
     * @access private
     *
     * @param int $offset Max counter value
     * @param int $limit  Max counter value
     * @return zhdParser
     * @todo Catch errors
     * @version 0.2.beta
     */
    private function getPagesContent($offset = 1, $limit = 40)
    {
        $content = '';

        for ($i = $offset; $i < $limit; $i++) {
            try {
                /** @noinspection PhpUsageOfSilenceOperatorInspection */
                $page = @file_get_contents(zhdParser::URL. $i . '/');

                if ($page) {
                    $content .= $page;
                } else {
                    /** @todo Create Exception class */
                    throw new Exception(zhdParser::HTTP_REQUEST_FAILED, 404);
                }
            } catch (Exception $e) {
                $error[] = ['message' => $e->getMessage(), 'code' => $e->getCode()];
            }
        }

        $this->setContent($content);

        return $this;
    }

    /**
     * Reordering result array
     * Change array ordering and grouping in special mode
     * Return array from: [
     *      0 => ['RegE0', 'RegE1', ... 'RegEn'],
     *      1 => ['URL0' , 'URL1' , ... 'URLn'],
     *      2 => ['name0', 'name1', ... 'nameN']
     * ]
     * to: [
     *      0 => ['URL' => URL0, 'name' => name0],
     *      1 => ['URL' => URL1, 'name' => name1],
     *      ...
     *      n => ['URL' => URLn, 'name' => nameN]
     * ]
     *
     * @access private
     *
     * @param array $input Result after parsing page. $input[1] - All URL's, $input[2] - All names
     *
     * @todo rename this method
     * @return array
     * @version 0.1.beta
     */
    private function formatResults(array $input)
    {
        $result = [];

        if (!empty($input[0])) {
            foreach ($input[0] as $key => $value) {
                $result[] = [
                    'URL'  => $input[1][$key],
                    'name' => $input[2][$key]
                ];
            }
        }

        return $result;
    }

    /**
     * Return page(s) content
     *
     * @access private
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set page(s) $content
     *
     * @access private
     *
     * @param string $content
     * @return zhdParser
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}