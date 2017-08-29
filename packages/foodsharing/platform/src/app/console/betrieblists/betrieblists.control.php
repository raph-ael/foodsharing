<?php
class BetrieblistsControl extends ConsoleControl
{   
    private $model;
    
    public function __construct()
    {       
        error_reporting(E_ALL);
        ini_set('display_errors','1');
        $this->model = new BetrieblistsModel();
    }

    private function queryBezirk($address)
    {
        $URL="http://open.mapquestapi.com/nominatim/v1/search?format=json&addressdetails=1&limit=1";
        $valid_query_elements = array('country', 'city', 'street');
        if(!in_array('country', $address))
        {
            $address['country'] = "Germany";
        }
        foreach($address as $k=>$v)
        {
            if(in_array($k, $valid_query_elements))
            {
                $URL.="&$k=".urlencode($v);
            }
        }
        $res = file_get_contents($URL);

        $obj = json_decode($res, true);
        foreach(array('suburb', 'city_district', 'city') as $field)
        {
            $bids = $this->model->q('SELECT b.id, b.`name` FROM fs_bezirk b LEFT JOIN fs_bezirk_closure bc ON b.id = bc.bezirk_id WHERE bc.`ancestor_id` = 741 AND `name` LIKE "%'.$this->model->safe($obj[0]['address'][$field]).'%" ORDER BY bc.depth DESC, b.`name`');
            if($bids)
                break;
        }
        return $bids;
    }

    private function implode_r($a)
    {
        $r = array();
        foreach($a as $e)
        {
          $r[] = implode(', ', $e);
        }
        return implode('; ', $r);
    }

    public function checkRegion()
    {
        $betriebe = $this->model->q('SELECT `id`, `bezirk_id`, `stadt`, `name`, `str`, `hsnr` FROM fs_betrieb WHERE `bezirk_id` IN (SELECT `bezirk_id` FROM fs_bezirk_closure WHERE `ancestor_id` = 31)');
        foreach($betriebe as $betrieb)
        {
            $bezirke = array((array('id' => 31, 'name'=>'Hamburg')));
            $address = $betrieb['str']." ".$betrieb['hsnr'];
            $bezirke = $this->queryBezirk(array('city' => $betrieb['stadt'], 'street' => $address));
            if(!$bezirke || $bezirke[0]['id'] != $betrieb['bezirk_id'])
            {
                $guess = $this->implode_r($bezirke);
                echo $betrieb['id'].", ".$betrieb['name'].", ".$address.", ".$betrieb['stadt'].", ".$betrieb['bezirk_id'].", \"".$guess."\"\n";
            }
            sleep(1);
        }
    }
    
    public function updateconversations()
    {
        $betriebe = $this->model->q('SELECT id, `name`, team_conversation_id, springer_conversation_id FROM fs_betrieb');
        
        $msg = loadModel('msg');
        
        foreach ($betriebe as $betrieb)
        {
            $cid = $betrieb['team_conversation_id'];
            if((int)($betrieb['team_conversation_id']) == 0)
            {
                $cid = $this->model->insert('INSERT INTO fs_conversation (`name`, `locked`) VALUES('.$this->model->strval("Team ".$betrieb['name']).', 1)');
                if($cid > 0)
                {
                    $this->model->update('UPDATE fs_betrieb SET team_conversation_id = '.$cid.' WHERE id = '.$betrieb['id']);
                }
            }
            $sid = $betrieb['springer_conversation_id'];
            if((int)($betrieb['springer_conversation_id']) == 0)
            {
                $sid = $this->model->insert('INSERT INTO fs_conversation (`name`, `locked`) VALUES('.$this->model->strval("Springer ".$betrieb['name']).', 1)');
                if($sid > 0)
                {
                    $this->model->update('UPDATE fs_betrieb SET springer_conversation_id = '.$sid.' WHERE id = '.$betrieb['id']);
                }
            }

            fs_info("Updating ".$betrieb['name']." (C: $cid, S: $sid)");
            $team = $this->model->getBetriebTeam($betrieb['id']);
            $springer = $this->model->getBetriebSpringer($betrieb['id']);
            $teamIds = array();
            if($team) {
              foreach ($team as $user)
              {
                $teamIds[] = $user['id'];
              }
            }
            $springerIds = array();
            if($springer) {
              foreach($springer as $user)
              {
                $springerIds[] = $user['id'];
              }
            }
            
            $msg->setConversationMembers($cid, $teamIds);
            $msg->setConversationMembers($sid, $springerIds);
        }
    }
}
