<?php
namespace Foodsharing\Bootstrap\Http\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function filepointer($file)
    {
        error_reporting(E_ALL);
        ini_set('display_errors','1');

        /*
         * make global vars accessable
         */
        global $g_lang;
        global $content_main;
        global $content_right;
        global $content_left;
        global $content_top;
        global $content_bottom;
        global $content_left_width;
        global $content_right_width;
        global $g_template;
        global $content_overtop;
        global $js;
        global $g_js_func;
        global $g_head;
        global $g_title;
        global $g_bread;
        global $g_data;
        global $g_form_valid;
        global $g_ids;
        global $g_script;
        global $g_css;
        global $g_add_css;
        global $hidden;
        global $g_meta;
        global $db;
        global $user;
        global $g_body_class;
        global $g_broadcast_message;
        global $quizinfo;

        /*
         * Load all the old Crap :)
         */
        try {
            require_once $this->getPlatformDir() . $file;
        }
        catch(Exception $e) {

            /*
             * later handle error with old app
             */
            throw $e;

            header('Location: /');
            exit();
        }


    }

    public function route() {
        /*
         * make foodsharing dir as current directory
         */
        chdir($this->getPlatformDir());

        /*
         * Hack the old autoloading
         */
        $files = glob($this->getPlatformDir() . '/lib/flourish/*.php');

        /*
         * unset dublicate progressbar file
         */
        unset($files[2]);

        $load_before = [
            $this->getPlatformDir() . '/lib/flourish/fException.php',
            $this->getPlatformDir() . '/lib/flourish/fExpectedException.php',
            $this->getPlatformDir() . '/lib/flourish/fUnexpectedException.php'
        ];

        foreach ($load_before as $file) {
            require_once $file;
        }

        foreach ($files as $file) {

            require_once $file;

        }
        unset($file);
        unset($files);

    }

    public function getPlatformDir()
    {
        return base_path('packages/foodsharing/platform/src');
    }


    function staticRoute($get_params = []) {

        foreach ($get_params as $key => $value) {
            $_GET[$key] = $value;
        }

        $this->route();

        $this->filepointer('/index.php');
    }

    function dynamicRroute($get_params = []) {

        foreach ($get_params as $key => $value) {
            $_GET[$key] = $value;
        }

        $_GET['uri'] = urlencode($_SERVER['REQUEST_URI']);

        $this->route();

        $this->filepointer('/index.php');
    }
}