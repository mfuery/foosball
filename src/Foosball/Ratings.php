<?php
namespace Foosball;

class Ratings
{
	protected $db;


	/**
	 * @param $filename
	 * @throws Exception
	 */
	public function import($filename) {
		if (!file_exists($filename)) {
			throw new Exception('File not found');
		}

		$fp = fopen($filename, 'r');

		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				$data = explode(',', $line);
				if (count($data) != 4) {
					echo "Warn: not 4 items on line: $line\n";
				}
			}

			if (!feof($fp)) {
				throw new Exception('Error: unexpected fgets() fail');
			}

			fclose($fp);
		}

	}
}
