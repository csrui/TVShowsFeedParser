<?php

include 'tvshows.config.php';
include '../libs/Parser.php';

try {

	$parser = new Parser(FEED_URL, $_GET['show']);

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
