<?php

use Illuminate\Database\Seeder;

class FsQuizSessionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_quiz_session')->delete();
        
        \DB::table('fs_quiz_session')->insert(array (
            0 => 
            array (
                'id' => 1,
                'foodsaver_id' => 4,
                'quiz_id' => 1,
                'status' => 1,
                'quiz_index' => 1,
                'quiz_questions' => 'a:10:{i:0;a:6:{s:2:"id";s:2:"15";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";s:7:"answers";a:1:{i:0;s:2:"53";}s:12:"userduration";i:13;s:4:"noco";i:0;}i:1;a:3:{s:2:"id";s:2:"75";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:2;a:3:{s:2:"id";s:2:"89";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:3;a:3:{s:2:"id";s:3:"112";s:8:"duration";s:2:"80";s:2:"fp";s:1:"2";}i:4;a:3:{s:2:"id";s:1:"1";s:8:"duration";s:3:"120";s:2:"fp";s:1:"3";}i:5;a:3:{s:2:"id";s:2:"39";s:8:"duration";s:2:"90";s:2:"fp";s:1:"2";}i:6;a:3:{s:2:"id";s:2:"95";s:8:"duration";s:2:"70";s:2:"fp";s:1:"1";}i:7;a:3:{s:2:"id";s:2:"79";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:8;a:3:{s:2:"id";s:2:"46";s:8:"duration";s:2:"70";s:2:"fp";s:1:"1";}i:9;a:3:{s:2:"id";s:2:"52";s:8:"duration";s:2:"80";s:2:"fp";s:1:"2";}}',
                'quiz_result' => NULL,
                'time_start' => '2017-08-25 22:17:31',
                'time_end' => '2017-08-25 22:18:31',
                'fp' => '0.00',
                'maxfp' => 2,
                'quest_count' => 10,
                'easymode' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'foodsaver_id' => 4,
                'quiz_id' => 2,
                'status' => 1,
                'quiz_index' => 1,
                'quiz_questions' => 'a:10:{i:0;a:6:{s:2:"id";s:2:"29";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";s:7:"answers";a:2:{i:0;s:3:"106";i:1;s:3:"105";}s:12:"userduration";i:12;s:4:"noco";i:0;}i:1;a:3:{s:2:"id";s:2:"87";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:2;a:3:{s:2:"id";s:2:"57";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:3;a:3:{s:2:"id";s:2:"90";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:4;a:3:{s:2:"id";s:2:"82";s:8:"duration";s:2:"90";s:2:"fp";s:1:"3";}i:5;a:3:{s:2:"id";s:2:"91";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:6;a:3:{s:2:"id";s:2:"34";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:7;a:3:{s:2:"id";s:2:"71";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:8;a:3:{s:2:"id";s:2:"73";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:9;a:3:{s:2:"id";s:2:"81";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}}',
                'quiz_result' => NULL,
                'time_start' => '2017-08-25 22:21:28',
                'time_end' => NULL,
                'fp' => '0.00',
                'maxfp' => 2,
                'quest_count' => 10,
                'easymode' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'foodsaver_id' => 4,
                'quiz_id' => 3,
                'status' => 1,
                'quiz_index' => 1,
                'quiz_questions' => 'a:10:{i:0;a:3:{s:2:"id";s:2:"49";s:8:"duration";s:2:"90";s:2:"fp";s:1:"1";}i:1;a:3:{s:2:"id";s:2:"51";s:8:"duration";s:2:"70";s:2:"fp";s:1:"2";}i:2;a:3:{s:2:"id";s:2:"98";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:3;a:3:{s:2:"id";s:3:"103";s:8:"duration";s:2:"50";s:2:"fp";s:1:"1";}i:4;a:3:{s:2:"id";s:2:"56";s:8:"duration";s:2:"90";s:2:"fp";s:1:"1";}i:5;a:3:{s:2:"id";s:2:"28";s:8:"duration";s:2:"50";s:2:"fp";s:1:"1";}i:6;a:3:{s:2:"id";s:3:"104";s:8:"duration";s:2:"90";s:2:"fp";s:1:"1";}i:7;a:3:{s:2:"id";s:3:"105";s:8:"duration";s:3:"110";s:2:"fp";s:1:"2";}i:8;a:3:{s:2:"id";s:2:"99";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:9;a:3:{s:2:"id";s:2:"24";s:8:"duration";s:2:"90";s:2:"fp";s:1:"2";}}',
                'quiz_result' => NULL,
                'time_start' => '2017-08-25 22:22:23',
                'time_end' => NULL,
                'fp' => '0.00',
                'maxfp' => 2,
                'quest_count' => 10,
                'easymode' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'foodsaver_id' => 3,
                'quiz_id' => 1,
                'status' => 1,
                'quiz_index' => 1,
                'quiz_questions' => 'a:10:{i:0;a:3:{s:2:"id";s:2:"11";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:1;a:3:{s:2:"id";s:3:"111";s:8:"duration";s:2:"90";s:2:"fp";s:1:"2";}i:2;a:3:{s:2:"id";s:2:"70";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:3;a:3:{s:2:"id";s:2:"93";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:4;a:3:{s:2:"id";s:2:"75";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:5;a:3:{s:2:"id";s:2:"60";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:6;a:3:{s:2:"id";s:1:"3";s:8:"duration";s:3:"120";s:2:"fp";s:1:"3";}i:7;a:3:{s:2:"id";s:1:"7";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:8;a:3:{s:2:"id";s:2:"41";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:9;a:3:{s:2:"id";s:2:"85";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}}',
                'quiz_result' => NULL,
                'time_start' => '2017-08-25 22:42:13',
                'time_end' => NULL,
                'fp' => '0.00',
                'maxfp' => 2,
                'quest_count' => 10,
                'easymode' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'foodsaver_id' => 3,
                'quiz_id' => 2,
                'status' => 1,
                'quiz_index' => 1,
                'quiz_questions' => 'a:10:{i:0;a:3:{s:2:"id";s:2:"59";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:1;a:3:{s:2:"id";s:2:"57";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:2;a:3:{s:2:"id";s:2:"45";s:8:"duration";s:2:"70";s:2:"fp";s:1:"3";}i:3;a:3:{s:2:"id";s:2:"92";s:8:"duration";s:3:"120";s:2:"fp";s:1:"1";}i:4;a:3:{s:2:"id";s:3:"114";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:5;a:3:{s:2:"id";s:2:"78";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:6;a:3:{s:2:"id";s:2:"50";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:7;a:3:{s:2:"id";s:2:"73";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:8;a:3:{s:2:"id";s:2:"82";s:8:"duration";s:2:"90";s:2:"fp";s:1:"3";}i:9;a:3:{s:2:"id";s:2:"30";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}}',
                'quiz_result' => NULL,
                'time_start' => '2017-08-25 22:42:49',
                'time_end' => NULL,
                'fp' => '0.00',
                'maxfp' => 2,
                'quest_count' => 10,
                'easymode' => 0,
            ),
            5 =>
                array (
                    'id' => 6,
                    'foodsaver_id' => 2,
                    'quiz_id' => 1,
                    'status' => 1,
                    'quiz_index' => 1,
                    'quiz_questions' => 'a:10:{i:0;a:3:{s:2:"id";s:2:"59";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:1;a:3:{s:2:"id";s:2:"57";s:8:"duration";s:2:"60";s:2:"fp";s:1:"3";}i:2;a:3:{s:2:"id";s:2:"45";s:8:"duration";s:2:"70";s:2:"fp";s:1:"3";}i:3;a:3:{s:2:"id";s:2:"92";s:8:"duration";s:3:"120";s:2:"fp";s:1:"1";}i:4;a:3:{s:2:"id";s:3:"114";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:5;a:3:{s:2:"id";s:2:"78";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:6;a:3:{s:2:"id";s:2:"50";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}i:7;a:3:{s:2:"id";s:2:"73";s:8:"duration";s:2:"60";s:2:"fp";s:1:"1";}i:8;a:3:{s:2:"id";s:2:"82";s:8:"duration";s:2:"90";s:2:"fp";s:1:"3";}i:9;a:3:{s:2:"id";s:2:"30";s:8:"duration";s:2:"60";s:2:"fp";s:1:"2";}}',
                    'quiz_result' => NULL,
                    'time_start' => '2017-08-25 22:42:49',
                    'time_end' => NULL,
                    'fp' => '0.00',
                    'maxfp' => 2,
                    'quest_count' => 10,
                    'easymode' => 0,
                ),
        ));
        
        
    }
}