<?php

namespace Foosball;

use Exception;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class Ratings
{

	public function currentRankings() {
		$db = Db::get();
		$result = $db->query('
SELECT name, SUM(wins) as wins FROM (
  SELECT name1 as name,
    SUM(
      CASE WHEN score1 > score2 THEN 1
      ELSE 0
      END
    ) as wins
  FROM scores
  GROUP BY name1
 UNION
  SELECT name2 as name,
    SUM(
      CASE WHEN score2 > score1 THEN 1
      ELSE 0
      END
    ) as wins
  FROM scores
  GROUP BY name2
) t
GROUP BY name
ORDER BY wins DESC
', Adapter::QUERY_MODE_EXECUTE);

		$resultSet = new ResultSet;
		$resultSet->initialize($result);

		echo 'Name  Wins', "\n";
		foreach ($resultSet as $row) {
			echo $row->name , ' ' , $row->wins , PHP_EOL;
		}

	}

	/**
	 * @param $filename
	 * @throws Exception
	 */
	public function import($filename) {
		if (!file_exists($filename)) {
			throw new Exception('File not found');
		}

		$db = Db::get();

		$fp = fopen($filename, 'r');

		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				$data = explode(',', $line);

				//print_r($data);
				if (count($data) != 4) {
					echo "Warn: not 4 items on line: $line\n";
					continue;
				}

				for ($i = 0; $i < 4; $i++) {
					$data[$i] = trim($data[$i]);
				}

				if (!is_numeric($data[1]) || !is_numeric($data[3])) {
					echo "Warn: ignoring line with invalid score(s): $line\n";
				} else {
					$db->query('INSERT INTO scores (name1,score1,name2,score2,created) VALUES (?,?,?,?, NOW())', $data);
				}
			}

			if (!feof($fp)) {
				throw new Exception('Error: unexpected fgets() fail');
			}

			fclose($fp);
		}

	}
}
