<?php
namespace Foodsharing\Bootstrap\Http\Controllers;

use App\Repositories\Backend\Access\User\UserRepository as BackendUserRepo;

class BootstrapController extends BaseController
{
    public static $static = [];

    public function bootIndex()
    {
        $this->route();
        $this->filepointer('/index.php');
    }

    public function bootXhrApp()
    {
        $this->route();
        $this->filepointer('/xhrapp.php');
    }

    public function bootXhr()
    {
        $this->route();
        $this->filepointer('/xhr.php');
    }

    public function uploadphp()
    {
        $this->route();
        $this->filepointer('/upload.php');
    }

    public function partner()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'partner'
        ]);
    }

    public function ueberUns()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'about'
        ]);
    }

    public function team()
    {
        $this->staticRoute([
            'page' => 'team'
        ]);
    }

    public function groups()
    {
        $this->staticRoute([
            'page' => 'groups'
        ]);
    }

    public function dashboard()
    {
        $this->staticRoute([
            'page' => 'dashboard'
        ]);
    }

    public function faq()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'faq'
        ]);
    }

    public function fuerUnternehmen()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'fuer_unternehmen'
        ]);
    }

    public function leeretonne()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'leeretonne'
        ]);
    }

    public function fairteilerrettung()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'fairteillerrettung'
        ]);
    }

    public function unterstuetzung()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'unterstuetzung'
        ]);
    }

    public function impressum()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'impressum'
        ]);
    }

    public function ratgeber()
    {
        $this->staticRoute([
            'page' => 'content',
            'sub' => 'ratgeber'
        ]);
    }

    public function recovery()
    {
        $this->staticRoute([
            'page' => 'login',
            'sub' => 'passwordReset'
        ]);
    }

    public function login(BackendUserRepo $userRepository)
    {
        BootstrapController::$static['user_repo'] = $userRepository;

        $this->staticRoute([
            'page' => 'login'
        ]);
    }

    public function karte()
    {
        $this->staticRoute([
            'page' => 'map'
        ]);
    }

    public function news()
    {
        $this->staticRoute([
            'page' => 'blog'
        ]);
    }

    public function machMit()
    {
        $this->staticRoute([
            'page' => 'join'
        ]);
    }

    public function fairteiler()
    {
        $this->staticRoute([
            'page' => 'fairteiler'
        ]);
    }


    public function statistik()
    {
        $this->staticRoute([
            'page' => 'statistics'
        ]);
    }

    public function event()
    {
        $this->staticRoute([
            'page' => 'register'
        ]);
    }

    public function eventEn()
    {
        $this->staticRoute([
            'page' => 'register',
            'lang' => 'en'
        ]);
    }

    public function wuppdays()
    {
        return redirect('https://project.yunity.org');
    }

    public function emptyPage()
    {
        return '';
    }

    public function essenskorb($id = false)
    {
        $this->staticRoute([
            'page' => 'basket',
            'uri' => 1
        ]);
    }

    public function blog($id)
    {
        $this->staticRoute([
            'page' => 'blog',
            'sub' => 'read',
            'id' => (int)$id
        ]);
    }

    public function profile($id)
    {
        $this->staticRoute([
            'page' => 'profile',
            'id' => $id
        ]);
    }
}