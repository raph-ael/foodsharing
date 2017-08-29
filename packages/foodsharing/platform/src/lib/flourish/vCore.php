<?php

class vCore 
{
	static $ids = array();
	
    public function id ($id) {
        $tmp_id = $id;
        $i = 0;
        while (isset(vCore::$ids[$tmp_id])) {
            $i ++;
            $tmp_id = $id . '_' . $i;
        }
        vCore::$ids[$tmp_id] = true;
        return $tmp_id;
    }
}