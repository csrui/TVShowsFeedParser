<?php

include 'tvshows.config.php';

try {

	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false;

	$doc->load(sprintf(FEED_URL, $_GET['show']));
	$xpath = new DOMXPath($doc);

	# Filter HD or SD quality

	$nodes_to_remove = array();

	if ($_GET['sd'] == true) {

		$selected_nodes = $xpath->query('//channel/item/title[(contains(., "720p"))]');

	} else {

		$selected_nodes = $xpath->query('//channel/item/title[not(contains(., "720p"))]');

	}	
	
	foreach ($selected_nodes as $elem) {

	    $nodes_to_remove[] = $elem->parentNode;

	}

	if (count($nodes_to_remove) > 0) {
		foreach($nodes_to_remove as $node) {
			$node->parentNode->removeChild($node);
		}
	}


	# Filter from a specific episode and up

	if (!empty($_GET['starts'])) {

		$nodes_to_remove = array();
		$starts = explode(':', $_GET['starts']);

		foreach($xpath->query('//channel/item/title') as $title) {

			preg_match('/(?:S|season)\W?(\d{1,2})(?:E|episode)\W?(\d{1,2})/', $title->nodeValue, $matches);

			if ($starts[0] > $matches[1] || ($starts[0] == $matches[1] && $starts[1] > $matches[2])) {
				$nodes_to_remove[] = $title->parentNode;
			}

		}

		if (count($nodes_to_remove) > 0) {
			foreach($nodes_to_remove as $node) {
				$node->parentNode->removeChild($node);
			}
		}

	}
	
	# Output result feed

	header('Content-type: application/xml');
	echo $doc->saveXML();
	
} catch (Exception $e) {

	die($e->getMessage());
	
}
