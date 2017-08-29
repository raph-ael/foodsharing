<?php
class FoodsaverModel extends Model
{
	/**
	 * Lists foodsaver having a bezirk
	 *
	 * @param Integer $bezirk_id
	 */
	public function listFoodsaver($bezirk_id)
	{
		return $this->q('
			SELECT
				fs.id,
				fs.name,
				fs.nachname,
				fs.photo,
				fs.sleep_status,
				CONCAT("#",fs.id) AS href

			FROM
				'.PREFIX.'foodsaver fs,
				'.PREFIX.'foodsaver_has_bezirk hb

			WHERE
				fs.id = hb.foodsaver_id

            AND
                fs.deleted_at IS NULL

			AND
				hb.bezirk_id = '.(int)$bezirk_id.'

			ORDER BY
				fs.last_login DESC
		');
	}

	/**
	 * Adds a list of foodsaver to an defined bezirk
	 *
	 * @param array $foodsaver_ids
	 * @param integer $bezirk_id
	 */
	public function addFoodsaverToBezirk($foodsaver_ids, $bezirk_id)
	{
		$values = array();

		foreach ($foodsaver_ids as $id)
		{
			$values[] = '('.(int)$bezirk_id.','.(int)$id.',1)';
		}

		return $this->insert('
			INSERT IGNORE INTO '.PREFIX.'foodsaver_has_bezirk
			(
				bezirk_id,
				foodsaver_id,
				active
			)
			VALUES
			'.implode(',', $values).'
		');
	}

	public function delfrombezirk($bezirk_id, $foodsaver_id)
	{
		$this->del('
			DELETE FROM
				'.PREFIX.'botschafter

			WHERE
				bezirk_id = '.(int)$bezirk_id.'

			AND
				foodsaver_id = '.(int)$foodsaver_id.'
		');

		return $this->del('
			DELETE FROM
				'.PREFIX.'foodsaver_has_bezirk

			WHERE
				bezirk_id = '.(int)$bezirk_id.'

			AND
				foodsaver_id = '.(int)$foodsaver_id.'
		');
	}

	public function loadFoodsaver($fsid)
	{
		return $this->qRow('
			SELECT
				id,
				name,
				nachname,
				photo,
				rolle,
				geschlecht,
				last_login

			FROM
				'.PREFIX.'foodsaver

			WHERE
				id = '.(int)$fsid.'

            AND
                deleted_at IS NULL
		');
	}
}
