<?php
namespace Foodsharing\Refactor;

use Foodsharing\Bootstrap\Http\Controllers\BootstrapController;
use Illuminate\Auth\SessionGuard;

class Helper {

    public function __construct()
    {

    }

    /*
     * Static function to encrypt user passwords in the old version
     */
    public static function encryptMd5($email,$pass)
    {
        $email = strtolower($email);
        return md5($email.'-lz%&lk4-'.$pass);
    }

    /*
     * in some places we need the nulled date
     */
    public static function dbDate($timestamp = false)
    {
        if($timestamp === false)
        {
            $timestamp = time();
        }

        return date('Y-m-d H:i:s', $timestamp);
    }

    public static function get_platform_dir()
    {
        return base_path('packages/foodsharing/platform/src');
    }

    /*
     * Method mirror the foodsharing user as backend user for laravel
     * if admin = 1 in fs_foodsaver table
     */
    public static function mirrorUser($email, $password, $data)
    {
        $map_user_roles = [
            /*
             * foodsharer
             */
            0 => [3],

            /*
             * foodsaver
             */
            1 => [3,4],

            /*
             * store admin
             */
            2 => [3,4,5],

            /*
             * armbassador
             */
            3 => [3,4,5,6],

            /*
             * management
             */
            4 => [3,4,5,6,7],

            /*
             * admin
             */
            5 => [1,3,4,5,6,7],
        ];

        if(isset($map_user_roles[$data['rolle']]))
        {
            $user_repo = BootstrapController::$static['user_repo'];

            $data = [
                'data' => [
                    'first_name' => $data['name'],
                    'last_name' => $data['nachname'],
                    'email' => $email,
                    'password' => $password,
                    'status' => 1,
                    'confirmed' => 1,
                    'confirmation_email' => false
                ],
                'roles' => [
                    'assignees_roles' => $map_user_roles[$data['rolle']]
                ]
            ];

            if($user = $user_repo->findByEmail($email))
            {
                $user_repo->update($user, $data, false);
                $user_repo->updatePassword($user, ['password' => $password], false);
            }
            else
            {
                $user_repo->create($data, false);
            }

            $user = $user_repo->findByEmail($email);

            access()->loginUsingId((int) $user->id);
        }
    }

    public function logout()
    {
        \Auth::logout();
    }
}
