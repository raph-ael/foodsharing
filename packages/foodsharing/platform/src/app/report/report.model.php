<?php
class ReportModel extends Model
{
	public function addBetriebReport($fsid,$reason_id,$reason,$message,$betrieb_id = 0)
	{
		return $this->insert('
			INSERT INTO `fs_report`
			(
				`foodsaver_id`, 
				`reporter_id`, 
				`reporttype`, 
				`betrieb_id`, 
				`time`, 
				`committed`, 
				`msg`,
				`tvalue`
			) 
			VALUES 
			(
				'.$this->intval($fsid).',
				'.$this->intval(fsId()).',
				'.$this->intval($reason_id).',
				'.$this->intval($betrieb_id).',
				NOW(),
				0,
				'.$this->strval($message).',
				'.$this->strval($reason).'
			)
		');
	}
	
	public function getFoodsaverBetriebe($fsid)
	{
		return $this->q('

			SELECT 	b.id, b.name
			FROM 	'.PREFIX.'betrieb_team t,
					'.PREFIX.'betrieb b
			WHERE 	t.betrieb_id = b.id
			AND 	t.foodsaver_id = '.(int)$fsid.'
				
		');
	}
	
	public function delReport($id)
	{
		return $this->del('DELETE FROM `'.PREFIX.'report` WHERE id = '.(int)$id.' ');
	}
	
	public function confirmReport($id)
	{
		return $this->update('
			UPDATE `'.PREFIX.'report` SET  committed = 1 WHERE id = '.(int)$id.' 
		');
	}
	
	public function getReportedSavers()
	{
		return $this->q('
			SELECT 	fs.name,
					CONCAT(fs.nachname," (",COUNT(rp.foodsaver_id),")") AS nachname,
					fs.photo,
					fs.id,
					fs.sleep_status,
					COUNT(rp.foodsaver_id) AS count,
					CONCAT("/?page=report&sub=foodsaver&id=",fs.id) AS `href`
				
			FROM 	'.PREFIX.'foodsaver fs,
					'.PREFIX.'report rp
				
			WHERE 	rp.foodsaver_id = fs.id
				
			GROUP 	BY rp.foodsaver_id
				
			ORDER BY count DESC, fs.name
		');
	}
	
	public function getReportStats()
	{
		$ret = $this->qCol('
			SELECT 	COUNT(`id`)
			FROM 	'.PREFIX.'report
			GROUP BY `committed`
		');
		
		$new = 0;
		$com = 0;
		if(isset($ret[0]))
		{
			$new = $ret[0];
		}
		if(isset($ret[1]))
		{
			$com = $ret[1];
		}
		
		return array(
			'com' => $com,
			'new' => $new		
		);
	}
	
	public function getReportedSaver($id)
	{
		if($fs = $this->qRow('
			SELECT 	`id`,
					`name`,
					`nachname`,
					`photo`,
					sleep_status

			FROM 	`'.PREFIX.'foodsaver`
				
			WHERE 	id = '.(int)$id.'
		'))
		{
			$fs['reports'] = $this->q('

				SELECT 
					r.id,
	            	r.`msg`,
	            	r.`tvalue`,
	            	r.`reporttype`,
					r.`time`,
					UNIX_TIMESTAMP(r.`time`) AS time_ts,
					CONCAT("a",r.`time`) AS time_class,
					
					rp.id AS rp_id,
					rp.name AS rp_name,
					rp.nachname AS rp_nachname,
					rp.photo AS rp_photo
					
          
				FROM
	            	`'.PREFIX.'report` r
					
	         	LEFT JOIN
	            	`'.PREFIX.'foodsaver` fs ON r.foodsaver_id = fs.id 
					
				LEFT JOIN
	            	`'.PREFIX.'foodsaver` rp ON r.reporter_id = rp.id 
				
				WHERE
					r.foodsaver_id = '.(int)$id.'
					
	          	ORDER BY 
					r.`time` DESC
					
			');
			
			return $fs;
		}
	}
	
	public function getReport($id)
	{
		$report = $this->qRow('
			SELECT 
				r.id,
            	r.`msg`,
            	r.`tvalue`,
            	r.`reporttype`,
				r.`time`,
				r.committed,
				r.betrieb_id,
				UNIX_TIMESTAMP(r.`time`) AS time_ts,
				CONCAT("a",r.`time`) AS time_class,
				
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.nachname AS fs_nachname,
				fs.photo AS fs_photo,
				
				rp.id AS rp_id,
				rp.name AS rp_name,
				rp.nachname AS rp_nachname,
				rp.photo AS rp_photo
				
          
			FROM
            	`'.PREFIX.'report` r
				
         	LEFT JOIN
            	`'.PREFIX.'foodsaver` fs ON r.foodsaver_id = fs.id 
				
			LEFT JOIN
            	`'.PREFIX.'foodsaver` rp ON r.reporter_id = rp.id 

			WHERE
				r.`id` = '.(int)$id.'
		');
		
		if($report['betrieb_id'] > 0)
		{
			if($betrieb = $this->qRow('SELECT id, name FROM '.PREFIX.'betrieb WHERE id = '.(int)$report['betrieb_id']))
			{
				$report['betrieb'] = $betrieb;
			}
		}
		
		return $report;
	}
	
	public function getReports($committed = '0')
	{
		$ret = $this->q('
			SELECT 
				r.id,
            	r.`msg`,
            	r.`tvalue`,
            	r.`reporttype`,
				r.`time`,
				UNIX_TIMESTAMP(r.`time`) AS time_ts,
				CONCAT("a",r.`time`) AS time_class,
				
				fs.id AS fs_id,
				fs.name AS fs_name,
				fs.nachname AS fs_nachname,
				fs.photo AS fs_photo,
				fs.stadt AS fs_stadt,


				
				rp.id AS rp_id,
				rp.name AS rp_name,
				rp.nachname AS rp_nachname,
				rp.photo AS rp_photo
				
          
			FROM
            	`'.PREFIX.'report` r
				
         	LEFT JOIN
            	`'.PREFIX.'foodsaver` fs ON r.foodsaver_id = fs.id 
				
			LEFT JOIN
            	`'.PREFIX.'foodsaver` rp ON r.reporter_id = rp.id 
			
			WHERE
				r.committed = '.$committed.'
				
          	ORDER BY 
				r.`time` DESC
		');
		return $ret;
	}
}
