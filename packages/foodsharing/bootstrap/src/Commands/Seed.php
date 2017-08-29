<?php

namespace Foodsharing\Bootstrap\Commands;

use Foodsharing\Data\Repositories\FoodsaverRepo;
use Illuminate\Console\Command;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fs:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the Database with funny Data';


    private $repo_foodsaver;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FoodsaverRepo $fs_repo)
    {
        parent::__construct();

        $this->repo_foodsaver = $fs_repo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /*
         * Add users
         */
        $users = [
            [
                'name' => 'Peter',
                'surname' => 'Foodsharer',
                'role' => 0
            ],
            [
                'name' => 'Jesus',
                'surname' => 'Foodsaver',
                'role' => 1
            ],
            [
                'name' => 'Jürgen',
                'surname' => 'Betrieb-Admin',
                'role' => 2
            ],
            [
                'name' => 'Sabine',
                'surname' => 'Botschafter',
                'role' => 3
            ],
            [
                'name' => 'Klaus',
                'surname' => 'Orgateam',
                'role' => 4
            ],
            [
                'name' => 'Hans',
                'surname' => 'Admin',
                'role' => 5
            ]
        ];

        $table_out = [];

        foreach ($users as $user) {

            $email = strtolower($user['surname']) . '@' . 'fs.com';

            $foodsaver = $this->repo_foodsaver->addNew($email,'password',$user['name'],$user['surname'],$user['role'],4);

            $out = [
                $user['surname'],
                $email,
                'password',
                'Nein'
            ];

            if($user['role'] >= 4) {

                $out[3] = 'Ja';
                $foodsaver->orgateam = 1;
            }
            $foodsaver->plz = '50969';
            $foodsaver->stadt = 'Köln';
            $foodsaver->lat = '50.9123661';
            $foodsaver->lon = '6.944518600000038';
            $foodsaver->anschrift = 'Bauerbankstraße 9';
            $foodsaver->geb_datum = '2017-08-01';
            $foodsaver->verified = 1;
            $foodsaver->save();

            $table_out[] = $out;
        }

        $this->table(['Benutzer-Rolle','E-Mail Adresse','Passwort','Orga-Rechte'], $table_out);

    }

    private function seedUser() {

        $this->line('Create new User');

        /*
         * Get Data
         */
        $name = $this->ask('What is the username?');
        $email = $this->ask('E-Mail address?',str_slug($name) . '@supermann.com');
        $password = $this->ask('The Password?');

        /*
         * 0,
				'.(int)$data['type'].',
				0,
				'.$this->strval($data['plz']).',
				'.$this->strval($data['email']).',
				'.$this->strval($this->encryptMd5($data['email'], $data['pw'])).',
				'.$this->strval($data['name']).',
				'.$this->strval($data['surname']).',
				'.$this->strval($data['str'].' '.trim($data['nr'])).',
				'.$this->strval($data['phone']).',
				'.$this->intval($newsletter).',
				'.$this->intval($data['gender']).',
				NOW(),
				'.$this->strval($data['city']).',
				'.$this->strval($data['lat']).',
				'.$this->strval($data['lon']).',
				'.$this->strval($token).',
				'.$this->strval($data['avatar']).'
         */

        $this->repo_foodsaver->addNew($email,$password,$name,'',1, 4);

        /*
        $userdb->insertNewUser([
            'type' => 1,
            'plz' => '',
            'email' => $email,
            'pw' => $password,
            'name' => $name,
            'surname' => '',
            'str' => '',
            'nr' => '',
            'phone' => '',
            'gender' => 1,
            'city' => '',
            'lat' => '',
            'lon' => '',
            'avatar' => '',
            'newsletter' => 1

        ], $token);
        */

    }

    private function loadFsModel($name) {

        require_once __DIR__ . '/../homegrown/config.inc.php';
        require_once __DIR__ . '/../homegrown/lib/db.class.php';
        require_once __DIR__ . '/../homegrown/lib/Manual.class.php';
        require_once __DIR__ .'/../homegrown/app/core/core.model.php';
        require_once __DIR__ .'/../homegrown/app/' . $name . '/' . $name .'.model.php';

        $classname =  camel_case($name) . 'Model';

        $host = config('database.connections.mysql.host');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');

        return new $classname($host, $user, $pass, $database);

    }
}
