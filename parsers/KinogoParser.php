<?php

/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 17.07.15
 * Time: 16:52
 */

namespace Parsers;
use Lib\BaseParser;

/**
 * Class KinogoParser
 * Parser for <http://kinogo.co>
 *
 * @author Maxim Antonisin <antonisin.maxim@gmail.com>
 * @version 0.1.beta
 */
class KinogoParser extends BaseParser
{
    /**
     * Parser __construct method;
     * Set $listUrl;
     *
     * @access private
     * @version 0.1.beta
     */
    public function __construct()
    {
        $this
            ->setListURL('http://kinogo.co/page/')
            ->setSearchUrl('http://kinogo.co/index.php?do=search');

        /** Temp sets*/
        $this
            ->setFirstPage(1)
            ->setPageLimit(4);
    }

    /**
     * Temp Execute function
     * @access private
     *
     * @version 0.1.beta
     */
    public function execute()
    {
        $pages = $this->parseAllPage();
        $this->parseOnePage($pages);
//        $this->parseByName(['Фантастическая четверка (2005)']);
    }

    /**
     * Parse page for content
     *
     * @access private
     * @param array $sources
     * @return array
     * @version 0.1.beta
     * @todo Done this method and refactor
     */
    private function parseOnePage(array $sources)
    {
        $result = [];

        /** Print message */
        parent::printMsg('Start parse pages contents');

        foreach ($sources as $key => $url) {
            /** @noinspection PhpUsageOfSilenceOperatorInspection */
            $page = @file_get_contents($url);
            preg_match_all('/flashvars.*value="(.*)"/', $page, $output);
            $result[]['player'] = $this->insertParam($output[1][0]);

            /** Print message */
            parent::printMsg('Parse page ' . $key . ' for content (URL: ' . $url);
        }

        return $result;
    }

    private function parseByName(array $sources)
    {
        $result = [];

        /** @var string $name Content name for search(Ex. Name of movie) */
        foreach ($sources as $name) {
            $name    = mb_convert_encoding($name, 'windows-1251', 'utf-8');
            $content = $this->search($name);

            /** Get all result URL's and names; $out => [1 => URL's, 2 => names] */
//            preg_match_all('/"zagolovki"><a href="(.*)" >(.*) \((\d{4})/', $content, $out);
            preg_match_all('/"zagolovki"><a href="(.*)" >(.* \(\d{4}\))/', $content, $out);
            $key = array_search($name, $out[2]);
            if (gettype($key) == 'integer') {
                $page = $this->parseOnePage([$out[1][$key]]);
                $result[] = ['name' => $name, 'player' => $page['player']];
            }
        }

        var_dump($result);
    }

    /**
     * Search method by name
     *
     * @access private
     * @param string $name windows-1251
     *
     * @return string
     * @version 0.1.beta
     */
    private function search($name)
    {
        $data = [
            'story'         => $name,
            'do'            => 'search',
            'subaction'     => 'search',
            'search_start'  => 1,
            'full_search'   => 0,
            'result_from'   => 1
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $stream = stream_context_create($options);
        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        $content = @file_get_contents($this->getSearchURL(), false, $stream);

        return $content;
    }


    /**
     * Special method for insert player parameters
     *
     * @access private
     * @param string $string Player parameter
     * @return string
     */
    private function insertParam($string)
    {
        /** @noinspection HtmlUnknownAttribute */
        $string = '<object class="uppod_style_video" id="films5731" uid="films5731" type="application/x-shockwave-flash" data="http://kinogo.co/templates/kinogo/player/player.swf" width="640" height="408">
                    <param name="bgcolor" value="#000000">
                    <param name="wmode" value="transparent">
                    <param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always">
                    <param name="movie" value="http://kinogo.co/templates/kinogo/player/player.swf">
                    <param name="flashvars" value="' . $string . '">
                   </object>';

        return $string;
    }
}