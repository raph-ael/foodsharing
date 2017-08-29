<?php
class TeamControl extends Control
{	
	public function __construct()
	{
		
		$this->model = new TeamModel();
		$this->view = new TeamView();
		
		parent::__construct();
		
		addScript('/js/jquery.qrcode.min.js');
	}
	
	public function index()
	{
		addBread(s('team'),'/team');
		addTitle(s('team'));
                
                # Three types of pages:
                # a) /team - displays vorstand
                # b) /team/ehemalige - displays Ehemalige
                # c) /team/{:id} - displays specific user
                
                if($id = $this->uriInt(2)){
                    # Type c, display user
                    if($user = $this->model->getUser($id))
                    {
                        addTitle($user['name']);
                        addBread($user['name']);
                        addContent($this->view->user($user));

                        if($user['contact_public'])
                        {
                                addContent($this->view->contactForm($user));
                        }
                    }
                    else
                    {
                        go('/team');
                    }
                } else {                
                    if ($teamType = $this->uriStr(2)){
                        if ($teamType == "ehemalige"){
                            # Type b, display "Ehemalige"
                            addBread(s('Ehemalige'),'/team/ehemalige');
                            addTitle(s('Ehemalige'));
                            $this->displayTeamContent(1564, 54);
                        } else {
                            addContent("Page not found");
                        } 
                    }
                    else {
                        # Type a, display "Vorstand" and "Aktive" 
                        addContent("<div id='vorstand'>");
                        $this->displayTeamContent(1373, 39);
                        addContent("</div><div id='aktive'>");
                        $this->displayTeamContent(1565, 53);
                        addContent("</div>");
                    }                    
                }
	}
        
        private function displayTeamContent($bezirkId, $contentId){
            if($team = $this->model->getTeam($bezirkId))
            {
                $db = loadModel('content');
                addContent($this->view->teamlist($team, $db->getContent($contentId)));
            }
        }
}
