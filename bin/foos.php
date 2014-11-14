#!/usr/bin/env php
<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use Foosball\Ratings;

$command = '';

if (isset($argv[1])) {
	$command = $argv[1];
}

$ratings = new Ratings();

if (file_exists($command)) {
	$ratings->import($command);
} else if ($command == 'rankings') {
	$ratings->currentRankings();
} else {
	echo "No command specified";
}

echo "\n";
