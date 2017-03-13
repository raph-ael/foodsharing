<?php
class StatisticsModel extends Model
{
	public function getStatGesamt()
	{
		return $this->qRow('
	
				SELECT
					SUM(`stat_fetchweight`) AS fetchweight,
					SUM(`stat_fetchcount`) AS fetchcount,
					SUM(`stat_postcount`) AS postcount,
					SUM(`stat_betriebcount`) AS betriebcount,
					SUM(`stat_korpcount`) AS korpcount,
					SUM(`stat_botcount`) AS botcount,
					SUM(`stat_fscount`) AS fscount,
					SUM(`stat_fairteilercount`) AS fairteilercount
	
				FROM
					'.PREFIX.'bezirk
	
				WHERE
					`id` = 741
		');
	}
	
	public function getStatCities()
	{
		return $this->q('
			SELECT
				`id`,
				`name`,
				`stat_fetchweight` AS fetchweight,
				`stat_fetchcount` AS fetchcount,
				`stat_postcount`AS postcount,
				`stat_betriebcount` AS betriebcount,
				`stat_korpcount` AS korpcount,
				`stat_botcount` AS botcount,
				`stat_fscount` AS fscount,
				`stat_fairteilercount` AS fairteilercount
			FROM
				'.PREFIX.'bezirk
	
			WHERE
				`type` IN(1,8)
	
			ORDER BY fetchweight DESC
			LIMIT 10
		');
	}
	
	public function getStatFoodsaver()
	{
		return $this->q('
			SELECT
				`id`,
				`name`,
				`nachname`,
				`stat_fetchweight` AS fetchweight,
				`stat_fetchcount` AS fetchcount
			FROM
				'.PREFIX.'foodsaver
	
			ORDER BY fetchweight DESC
			LIMIT 10
		');
	}
}