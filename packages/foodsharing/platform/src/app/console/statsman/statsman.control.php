<?php
class StatsmanControl extends ConsoleControl
{	
	private $model;
	
	public function __construct()
	{		
		$this->model = new StatsmanModel();
	}
	
	
	public function gen_abholmengen()
	{
		echo "inserting total fetch volumes into fs_stat_abholmengen...\n";
		$cleanup = $this->model->sql('DELETE FROM fs_stat_abholmengen');
		$betriebe = $this->model->q('SELECT id FROM fs_betrieb');
		foreach($betriebe as $b) {
			$q = $this->model->insert('INSERT INTO fs_stat_abholmengen
						   SELECT b.id, a.`date`, m.menge
						   FROM fs_betrieb b
						   INNER JOIN fs_abholer a ON a.betrieb_id = b.id
						   INNER JOIN fs_abholmengen m ON m.id = b.abholmenge
						   WHERE b.id = '.$b['id'].'
						   GROUP BY a.`date`');
			echo '.';
		}
		echo "\ndone";
	}

	private function get_parent_bezirke()
	{
		$bezirk_parents = array();
		$parents = $this->model->q('SELECT bezirk_id, GROUP_CONCAT(ancestor_id) as parents FROM fs_bezirk_closure WHERE ancestor_id != 0 GROUP BY bezirk_id');
		foreach($parents as $p) {
			$a = explode(',', $p['parents']);
			if(!is_array($a))
			{
				$a = array($a);
			}
			$bezirk_parents[$p['bezirk_id']] = $a;
		}
		return $bezirk_parents;
	}

	public function out_bezirk_stat()
	{
		// array of arrays -> [bezirk_id] = array(parent1, parent2, ..)
		$bezirk_parents = $this->get_parent_bezirke();
		// 2 dimensional array [bezirk_id][yearweek] = sum
		$bezirk_yw_sum = array();
		$bezirk_yw_cnt = array();
		$all_yw = array();
		$q = $this->model->q('
			SELECT b.id, b.name, YEARWEEK( m.`date` ) as yw, SUM( m.abholmenge ) as total, COUNT( m.abholmenge) as cnt
			FROM fs_bezirk b
			INNER JOIN fs_betrieb btr ON ( btr.bezirk_id = b.id ) 
			INNER JOIN fs_stat_abholmengen m ON ( m.betrieb_id = btr.id ) 
			GROUP BY b.id, YEARWEEK( m.`date` ) 
			ORDER BY b.name');
		foreach($q as $line) {
			$all_yw[$line['yw']] = True;
			foreach($bezirk_parents[$line['id']] as $bzid) {
				if(!array_key_exists($bzid, $bezirk_yw_sum)
				   || !array_key_exists($line['yw'], $bezirk_yw_sum[$bzid])) {
					$bezirk_yw_sum[$bzid][$line['yw']] = 0.0;
					$bezirk_yw_cnt[$bzid][$line['yw']] = 0;
				}
				$bezirk_yw_sum[$bzid][$line['yw']] += $line['total'];
				$bezirk_yw_cnt[$bzid][$line['yw']] += $line['cnt'];
			}
		}
		$fp = fopen("stat_out.txt", "w");
		$fpc = fopen("stat_cnt.txt", "w");
		fwrite($fp, "bezirk");
		fwrite($fpc, "bezirk");
		$yws = array_keys($all_yw);
		sort($yws);
		foreach($yws as $yw) {
			fwrite($fp, ",$yw");
			fwrite($fpc, ",$yw");
		}
		fwrite($fp, "\n");
		fwrite($fpc, "\n");

		$bezirk_names = array();
		$q = $this->model->q("
			select b.id, b.type, group_concat(b.name order by a.depth DESC separator ' -> ') as path
			from fs_bezirk_closure d
			join fs_bezirk_closure a on (a.bezirk_id = d.bezirk_id)
			join fs_bezirk b on (b.id = a.ancestor_id)
			where d.ancestor_id = 741 and d.bezirk_id != d.ancestor_id
			group by d.bezirk_id
			HAVING b.`type` != 7
			ORDER BY path");
		foreach($q as $line) {
			$bezirk_names[$line['id']] = $line['path'];
			echo $line['path'];
			fwrite($fp, '"'.$line['path'].'"');
			fwrite($fpc, '"'.$line['path'].'"');
			foreach($yws as $yw) {
				$cnt = 0;
				$sum = 0;
				if(array_key_exists($line['id'], $bezirk_yw_sum)
				   && array_key_exists($yw, $bezirk_yw_sum[$line['id']])) {
					$sum = $bezirk_yw_sum[$line['id']][$yw];
					$cnt = $bezirk_yw_cnt[$line['id']][$yw];
				}
				fwrite($fp, ",$sum");
				fwrite($fpc, ",$cnt");
			}
			fwrite($fp, "\n");
			fwrite($fpc, "\n");
		}
		fclose($fp);
		fclose($fpc);
	}

	public function out_fs_by_bezirk_age()
	{
		$fp = fopen("stat_fs_bezirk.csv", "w");
		$foodsaver = $this->model->q("
				SELECT
				COUNT(*) as cnt,
				CASE
				WHEN age < 18 THEN 'unknown'
				WHEN age >=18 AND age <=25 THEN '18-25'
				WHEN age >=26 AND age <=33 THEN '26-33'
				WHEN age >=34 AND age <=41 THEN '34-41'
				WHEN age >=42 AND age <=49 THEN '42-49'
				WHEN age >=50 AND age <=57 THEN '50-57'
				WHEN age >=58 AND age <=65 THEN '58-65'
				WHEN age >=66 AND age <=73 THEN '66-73'
				WHEN age >=74 AND age < 200 THEN '74+'
				WHEN age >= 200 THEN 'invalid'
				WHEN age IS NULL THEN 'unknown'
				END AS ageband, geschlecht, bezirk_id
				FROM
				(
				 SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(geb_datum, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(geb_datum, '00-%m-%d')) AS age,
				 id, geschlecht, bezirk_id FROM fs_foodsaver WHERE rolle >= 1 AND bezirk_id >= 1
				) as tbl
				GROUP BY ageband, geschlecht, bezirk_id
				");
		$parents = $this->get_parent_bezirke();
		foreach($foodsaver as $fs)
		{
			foreach($parents[$fs['bezirk_id']] as $parent)
			{
				$cnt = $ages[$parent][$fs['ageband']][$fs['geschlecht']];
				if(!$cnt)
				{
					$cnt = 0;
				}
				$ages[$parent][$fs['ageband']][$fs['geschlecht']] = $cnt + $fs['cnt'];
			}
		}
		$agebands = array('18-25','26-33','34-41','42-49','50-57','58-65','66-73','74+','unknown','invalid');
		fwrite($fp, 'bezirk,');
		fwrite($fp, implode(',', $agebands));
		fwrite($fp, ',');
		fwrite($fp, implode(',', $agebands));
		fwrite($fp, ',');
		fwrite($fp, implode(',', $agebands));
		fwrite($fp, "\n");

		$q = $this->model->q("
			select b.id, b.type, group_concat(b.name order by a.depth DESC separator ' -> ') as path
			from fs_bezirk_closure d
			join fs_bezirk_closure a on (a.bezirk_id = d.bezirk_id)
			join fs_bezirk b on (b.id = a.ancestor_id)
			where d.ancestor_id = 741 and d.bezirk_id != d.ancestor_id
			group by d.bezirk_id
			HAVING b.`type` != 7
			ORDER BY path");
		foreach($q as $line) {
			echo $line['path'];
			fwrite($fp, '"'.$line['path'].'"');
			$bzid = $line['id'];
			foreach($agebands as $ageband)
			{
				fwrite($fp, "," . $ages[$bzid][$ageband][0]);
			}
			foreach($agebands as $ageband)
			{
				fwrite($fp, "," . $ages[$bzid][$ageband][1]);
			}
			foreach($agebands as $ageband)
			{
				fwrite($fp, "," . $ages[$bzid][$ageband][2]);
			}
			fwrite($fp, "\n");
		}
	}

	public function out_fs_by_bezirk_register()
	{
		$fp = fopen("stat_fs_bezirk_register.csv", "w");
		$foodsaver = $this->model->q("
				SELECT
				COUNT(id) as cnt,
				YEARWEEK(anmeldedatum) as yw, bezirk_id
				FROM
				fs_foodsaver WHERE rolle >= 1 AND bezirk_id >= 1
				GROUP BY yw, bezirk_id
				");
		$parents = $this->get_parent_bezirke();
		$all_yw = array();
		foreach($foodsaver as $fs)
		{
			$all_yw[$fs['yw']] = True;
			foreach($parents[$fs['bezirk_id']] as $parent)
			{
				$cnt = $ages[$parent][$fs['yw']];
				if(!$cnt)
				{
					$cnt = 0;
				}
				$ages[$parent][$fs['yw']] = $cnt + $fs['cnt'];
			}
		}
		fwrite($fp, 'bezirk,');
		$yws = array_keys($all_yw);
		sort($yws);
		foreach($yws as $yw) {
			fwrite($fp, ",$yw");
		}
		fwrite($fp, "\n");

		$q = $this->model->q("
			select b.id, b.type, group_concat(b.name order by a.depth DESC separator ' -> ') as path
			from fs_bezirk_closure d
			join fs_bezirk_closure a on (a.bezirk_id = d.bezirk_id)
			join fs_bezirk b on (b.id = a.ancestor_id)
			where d.ancestor_id = 741 and d.bezirk_id != d.ancestor_id
			group by d.bezirk_id
			HAVING b.`type` != 7
			ORDER BY path");
		foreach($q as $line) {
			echo $line['path'];
			fwrite($fp, '"'.$line['path'].'"');
			foreach($yws as $yw) {
				$sum = 0;
				if(array_key_exists($line['id'], $ages)
				   && array_key_exists($yw, $ages[$line['id']])) {
					$sum = $ages[$line['id']][$yw];
				}
				fwrite($fp, ",$sum");
			}
			fwrite($fp, "\n");
		}
	}

	public function out_betriebe_eintrag()
	{
		// array of arrays -> [bezirk_id] = array(parent1, parent2, ..)
		$bezirk_parents = $this->get_parent_bezirke();
		// 2 dimensional array [bezirk_id][yearweek] = sum
		$bezirk_yw_cnt = array();
		$all_yw = array();
		$q = $this->model->q('
			SELECT b.id, b.name, YEARWEEK( btr.added ) as yw, COUNT(btr.id) as cnt
			FROM fs_bezirk b
			INNER JOIN fs_betrieb btr ON ( btr.bezirk_id = b.id ) 
			WHERE btr.betrieb_status_id = 3
			GROUP BY b.id, YEARWEEK( btr.added )');
		foreach($q as $line) {
			$all_yw[$line['yw']] = True;
			foreach($bezirk_parents[$line['id']] as $bzid) {
				if(!array_key_exists($bzid, $bezirk_yw_cnt)
				   || !array_key_exists($line['yw'], $bezirk_yw_cnt[$bzid])) {
					$bezirk_yw_cnt[$bzid][$line['yw']] = 0;
				}
				$bezirk_yw_cnt[$bzid][$line['yw']] += $line['cnt'];
			}
		}
		$fp = fopen("betriebe_added.txt", "w");
		fwrite($fp, "bezirk");
		$yws = array_keys($all_yw);
		sort($yws);
		foreach($yws as $yw) {
			fwrite($fp, ",$yw");
		}
		fwrite($fp, "\n");

		$bezirk_names = array();
		$q = $this->model->q("
			select b.id, b.type, group_concat(b.name order by a.depth DESC separator ' -> ') as path
			from fs_bezirk_closure d
			join fs_bezirk_closure a on (a.bezirk_id = d.bezirk_id)
			join fs_bezirk b on (b.id = a.ancestor_id)
			where d.ancestor_id = 741 and d.bezirk_id != d.ancestor_id
			group by d.bezirk_id
			HAVING b.`type` != 7
			ORDER BY path");
		foreach($q as $line) {
			$bezirk_names[$line['id']] = $line['path'];
			echo $line['path'];
			fwrite($fp, '"'.$line['path'].'"');
			foreach($yws as $yw) {
				$cnt = 0;
				if(array_key_exists($line['id'], $bezirk_yw_cnt)
				   && array_key_exists($yw, $bezirk_yw_cnt[$line['id']])) {
					$cnt = $bezirk_yw_cnt[$line['id']][$yw];
				}
				fwrite($fp, ",$cnt");
			}
			fwrite($fp, "\n");
		}
		fclose($fp);
	}
}
