<?php


class MigrateControl extends ConsoleControl
{   
  private $model;
  private $fs_db;
  private $source_table;
  
  public function __construct()
  {
    $this->source_table = 'foodsharing_at';
// WARNING: CH does not contain last login field! Change query below!!
    //$this->source_table = 'foodsharing_ch';
    //$this->source_table = 'foodsharing_de';
    $this->model = new MigrateModel();
    $this->fs_db = new mysqli(DB_HOST, DB_USER, DB_PASS, $this->source_table);
    $this->fs_db->set_charset('utf8');
  }

  private function resizeAvatar($img)
  {
    $folder = ROOT_DIR . 'tmp_mfs/';
    if(file_exists($folder . $img))
    {
      $image = new fImage($folder . $img);

      try {

        $folder = ROOT_DIR . 'mfs-out/';

        $image->move($folder, false);
        // make 35x35
        copy($folder . $img, $folder . 'mini_q_' . $img);
        $image = new fImage($folder . 'mini_q_' . $img);
        $image->cropToRatio(1, 1);
        $image->resize(35, 35);
        $image->saveChanges();

        // make 75x75
        copy($folder . $img, $folder . 'med_q_' . $img);
        $image = new fImage($folder . 'med_q_' . $img);
        $image->cropToRatio(1, 1);
        $image->resize(75, 75);
        $image->saveChanges();

        // make 50x50
        copy($folder . $img, $folder . '50_q_' . $img);
        $image = new fImage($folder . '50_q_' . $img);
        $image->cropToRatio(1, 1);
        $image->resize(75, 75);
        $image->saveChanges();

        // make 130x130
        copy($folder . $img, $folder . '130_q_' . $img);
        $image = new fImage($folder . '130_q_' . $img);
        $image->cropToRatio(1, 1);
        $image->resize(130, 130);
        $image->saveChanges();

        // make 150x150
        copy($folder . $img, $folder . 'q_' . $img);
        $image = new fImage($folder . 'q_' . $img);
        $image->cropToRatio(1, 1);
        $image->resize(150, 150);
        $image->saveChanges();

        return $img;

      } catch (Exception $e) {
      }
    }
    return '';
  }


  private function fetch_and_convert_image($img) {
    $path = "http://media.myfoodsharing.org/live/at/profiles/pictures/200/";
    $target = ROOT_DIR . 'tmp_mfs/';
    $photo = uniqid() . '.' . strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if(strlen($img) < 3) {
      return "";
    }
    if(file_put_contents($target.$photo, fopen($path.$img, 'r'))) {
	    $this->resizeAvatar($photo);
	    return $target.$photo;
    } else {
      return "";
    }
  }
 
  public function fs_user()
  {
    $this->model->update("UPDATE fs_foodsaver SET fs_id = NULL");
    $this->model->begin_transaction();
    if($result = $this->fs_db->query("SELECT p.zipcode as plz, c.name as stadt, p.lat as lat, p.lng as lon, p.picture as fs_picture, u.email as email, p.firstname as name, p.lastname as nachname, p.street as anschrift, p.phone as telefon, p.mobile as handy, if(p.gender=false,1,2) as geschlecht, p.birthdate as geb_datum, u.id as fs_id, u.created as anmeldedatum, 1 as active, if (u.last_login is null, current_date(), u.last_login) as last_login, u.password as fs_password, p.type as profile_type, p.organisation_name as organisation_name, p.organisation_fax as organisation_fax, p.organisation_email as organisation_email, p.organisation_vr as organisation_vr, p.organisation_logo as organisation_logo, p.company_name as company_name, p.company_fax as company_fax, p.company_email as company_email, p.company_hrg as company_hrg, p.company_logo as company_logo FROM users u LEFT JOIN profiles p ON u.id = p.user_id LEFT JOIN cities c ON p.city_id = c.id WHERE u.deleted = 0 AND p.deleted = 0 AND u.role_id in (2, 3, 4)")) {
      $bar = $this->progressbar($result->num_rows);
      $cur_user_cnt = 0;
      while($row = $result->fetch_object()) {
        $cur_user_cnt++;
        $bar->update($cur_user_cnt);
        $photo = $this->fetch_and_convert_image($row->fs_picture);
        $org_photo = $this->fetch_and_convert_image($row->organisation_logo);
        $comp_photo = $this->fetch_and_convert_image($row->company_logo);
        $custom_data = serialize($row);
        $plz = $row->plz;
        if(strlen($plz) > 5 || strlen($plz) < 4) {
          $plz = "";
        }
        $lat = floatval($row->lat);
        $lon = floatval($row->lon);
        if(($lat == 0 && $lon == 0) || $lat == 1.0 || $lon == 1.0 || abs($lat) > 90 || abs($lon) > 180) {
          $lat = "0";
          $lon = "0";
        } else {
          $lat = strval($lat);
          $lon = strval($lon);
        }
				if(strlen($row->telefon) > 30)
					$telefon = "";
				else
					$telefon = $row->telefon;

				if(strlen($row->handy) > 50)
					$handy = "";
				else
					$handy = $row->handy;

			  $stadt = substr($row->stadt, 0, 50);
        $optional_data = "";
        $utype = 0;
        if($row->profile_type == 1 || $row->profile_type == 2) {
          $optional_data = $custom_data;
          $utype = 1;
        }

        $this->model->insert("INSERT INTO fs_foodsaver (plz, stadt, lat, lon, photo, email, name, nachname, anschrift, telefon, handy, geschlecht, geb_datum, fs_id, anmeldedatum, active, data, about_me_public, token, last_login, fs_password, type) VALUES ("
        ."'".$this->model->safe($plz)."', "
        ."'".$this->model->safe($stadt)."', "
        ."'".$lat."', "
        ."'".$lon."', "
        ."'".$photo."', "
        ."'".$this->model->safe($row->email)."', "
        ."'".$this->model->safe($row->name)."', "
        ."'".$this->model->safe($row->nachname)."', "
        ."'".$this->model->safe($row->anschrift)."', "
        ."'".$this->model->safe($telefon)."', "
        ."'".$this->model->safe($handy)."', "
        .$row->geschlecht.", "
        ."'".$this->model->safe($row->geb_datum)."', "
        .$row->fs_id.", "
        ."'".$this->model->safe($row->anmeldedatum)."', "
        ."1, '$this->source_table import ".$this->model->safe($optional_data)."', '', '', "
        ."'".$this->model->safe($row->last_login)."', "
        ."'".$this->model->safe($row->fs_password)."', "
        .$utype.") ON DUPLICATE KEY UPDATE fs_id=".$row->fs_id);
      }
    }
    $this->model->commit();
  }

  private function fs_user_lookup($fs_id) {
    static $usermap = array();
    if(array_key_exists($fs_id, $usermap)) {
      return $usermap[$fs_id];
    }

    $res = (int)$this->model->qOne("SELECT id FROM fs_foodsaver WHERE fs_id = $fs_id");
    $usermap[$fs_id] = $res;
    return $res;
  }
  
  public function fs_chats()
  {
    $this->model->begin_transaction();
    if($result = $this->fs_db->query("SELECT id, created, modified, initial_sender_id, initial_recipient_id FROM conversations")) {
      $bar = $this->progressbar($result->num_rows);
      $usermap = array();
      $cur_msg_row = 0;
      while($row = $result->fetch_object()) {
        $cur_msg_row++;
        $bar->update($cur_msg_row);
        $sender_id = $this->fs_user_lookup($row->initial_sender_id);
        $recipient_id = $this->fs_user_lookup($row->initial_recipient_id);
        if($sender_id == false || $recipient_id == false)
          continue;

	$conversation_id = false;
        $mindate = '';
        $maxdate = '';
        $unread = 0;
        $last_foodsaver_id = 0;
        $last_message = '';
        $last_message_id = 0;
        if($conversation_id = $this->model->getConversationId($sender_id,$recipient_id)) {
          $msgs = $this->fs_db->query("SELECT conversation_id, sender_id, message, viewed, created FROM messages WHERE conversation_id = ".$row->id." AND deleted = 0");
          while($msg = $msgs->fetch_object()) {
              $body = str_replace(array('<br />','<br>','<br/>','<p>','</p>'),"\n",$msg->message);
              $body = strip_tags($body);
              $body = trim($body);
              $id = $this->model->addMsg($conversation_id,$this->fs_user_lookup($msg->sender_id),$body,$msg->created);
              $maxdate = $msg->created;
              $this->model->connectUser($conversation_id,$sender_id,$recipient_id, 0);
              $last_foodsaver_id = $this->fs_user_lookup($msg->sender_id);
              $last_message = $body;
              $last_message_id = $id;
          }
          $this->model->updateConversation(
            $conversation_id, 
            $maxdate, 
            $maxdate, 
            $last_foodsaver_id, 
            $last_message, 
            $last_message_id
          );
        }
      }
    }
    $this->model->commit();
  }
  
  public function chats()
  {
    fs_info('getold conversations');
    
    $count_complete = (int)$this->model->qOne('SELECT COUNT(id) FROM fs_message WHERE sender_id != 0 AND recip_id != 0');
    
    if($convs = $this->model->listOldConversations())
    {
      file_put_contents('convs.txt',print_r($convs,true));
      success(count($convs).' conversations found');
      $bar = $this->progressbar($count_complete);
      $x=0;
      $cur_msg_count = 0;
      foreach ($convs as $c)
      {
        $bar->update($cur_msg_count);
        $x++;
        
        $recip1 = array_shift($c);
        $recip2 = end($c);        

        if($conversation_id = $this->model->getConversationId($recip1,$recip2))
        {
          
          $mindate = '';
          $maxdate = '';
          $unread = 0;
          $last_foodsaver_id = 0;
          $last_message = '';
          $last_message_id = 0;
          
          if($messages = $this->model->listOldMessages($recip1,$recip2))
          {
            $i = 0;
            foreach ($messages as $msg)
            {
              $cur_msg_count++;
              $i++;
              if($i == 1)
              {
                $mindate = $msg['time'];
                //info($mindate);
              }
              
              $body = str_replace(array('<br />','<br>','<br/>','<p>','</p>'),"\n",$msg['msg']);
              $body = strip_tags($body);
              $body = trim($body);
              $id = $this->model->addMsg($conversation_id,$msg['sender_id'],$body,$msg['time']);
            
              if($i == count($messages))
              {
                $maxdate = $msg['time'];
                $unread = $msg['unread'];
                $last_foodsaver_id = $msg['sender_id'];
              
                $body = str_replace(array('<br />','<br>','<br/>','<p>','</p>'),"\n",$msg['msg']);
                $body = strip_tags($body);
                $body = trim($body);
              
                $last_message = $body;
                $last_message_id = $id;
                //info('max: '.$maxdate);
              }
              
            }
          }
          
          $this->model->connectUser($conversation_id,$recip1,$recip2,$unread);
          
          $this->model->updateConversation(
            $conversation_id, 
            $maxdate, 
            $mindate, 
            $last_foodsaver_id, 
            $last_message, 
            $last_message_id
          );
        }
      }
    }
    else
    {
      error('no conversations found');
    }
  }
}
