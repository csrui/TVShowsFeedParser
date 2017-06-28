<?php

namespace csrui\TVShowsFeedParser;

class Parser
{

    private $doc = null;

    private $xpath = null;

    private $parsed = null;


    public function __construct($show)
    {

        $this->doc = new \DOMDocument();
        $this->doc->preserveWhiteSpace = false;

        $this->doc->load(sprintf(Config::feedUrl(), $show));
        $this->xpath = new \DOMXPath($this->doc);

    }

    public function filter($string, $exclude = false)
    {

        $nodes_to_remove = array();

        if ($exclude === true) {

            $selected_nodes = $this->xpath->query(sprintf('//channel/item/title[(contains(., "%s"))]', $string));

        } else {

            $selected_nodes = $this->xpath->query(sprintf('//channel/item/title[not(contains(., "%s"))]', $string));

        }

        foreach ($selected_nodes as $elem) {

            $nodes_to_remove[] = $elem->parentNode;

        }

        if (count($nodes_to_remove) > 0) {
            foreach ($nodes_to_remove as $node) {
                $node->parentNode->removeChild($node);
            }
        }

    }

    public function resume($episode)
    {

        $nodes_to_remove = array();
        $starts = explode(':', $episode);

        foreach ($this->xpath->query('//channel/item/title') as $title) {

            preg_match('/(?:S|season)\W?(\d{1,2})(?:E|episode)\W?(\d{1,2})/', $title->nodeValue, $matches);

            if ($starts[0] > $matches[1] || ($starts[0] == $matches[1] && $starts[1] > $matches[2])) {
                $nodes_to_remove[] = $title->parentNode;
            }

        }

        if (count($nodes_to_remove) > 0) {
            foreach ($nodes_to_remove as $node) {
                $node->parentNode->removeChild($node);
            }
        }

    }

    public function getFeed()
    {
        return $this->doc->saveXML();
    }

}