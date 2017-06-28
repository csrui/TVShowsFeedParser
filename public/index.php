<?php

use csrui\TVShowsFeedParser;

include __DIR__ . '/../vendor/autoload.php';

try {

    $parser = new TVShowsFeedParser\Parser($_GET['show']);

    # Filter HD or SD quality

    if (!empty($_GET['filter'])) {

        $parser->filter($_GET['filter']);

    }


    # Filter from a specific episode and up

    if (!empty($_GET['starts'])) {

        $parser->resume($_GET['starts']);

    }

    # Output result feed

    header('Content-type: application/xml');
    echo $parser->getFeed();

} catch (Exception $e) {
    die($e->getMessage());
}
