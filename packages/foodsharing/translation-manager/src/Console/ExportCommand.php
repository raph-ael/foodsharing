<?php namespace Foodsharing\TranslationManager\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\NamespacedItemResolver;
use Symfony\Component\Console\Input\InputArgument;
use Foodsharing\TranslationManager\Events\TranslationsPublished;
use Foodsharing\TranslationManager\Manager;

class ExportCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'translations:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export translations to PHP files';

    /** @var \Foodsharing\TranslationManager\Manager */
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $group = $this->argument('group');

        $this->manager->exportTranslations($group);

        $errors = $this->manager->errors();
        event(new TranslationsPublished($group, $errors));

        $this->mirrorOldLanguageFiles($group);

        $this->info("Done writing language files for " . (($group == '*') ? 'ALL groups' : $group . " group"));
    }

    /*
     * This Method will writedown language files to the old homegrown app
     */
    private function mirrorOldLanguageFiles($group)
    {
        //NamespacedItemResolver::class;
        $languages = config('translation-manager.locales');
        $language_path = base_path('resources/lang');

        foreach($languages as $language)
        {
            $path = $language_path . '/' . $language;

            $files = [$path . '/' . $group . '.php'];

            $glob = '*.php';
            if($group != '*')
            {
                $glob = $group . '.php';
            }

            $files = glob($path . '/' . $glob);

            if(!empty($files))
            {

                $old_language_path = base_path('packages/foodsharing/platform/src/lang/' . $language);

                if(!is_dir($old_language_path))
                {
                    mkdir($old_language_path);
                }

                foreach ($files as $file) {
                    /*
                     * parse old fs appname
                     */
                    $f = explode('/', $file);
                    $f = end($f);
                    $app = str_replace('.php', '', $f);

                    /*
                     * Nur language files konvertieren
                     * die fs_ als prefix im dateinamen haben
                     */
                    if (substr($app, 0, 3) == 'fs_') {
                        $app = substr($app, 3);
                        //$content = file_get_contents($file);
                        $language_vars = $this->getVarsFromLanguageFile($file);
                        $old_language_vars = [];


                        foreach ($language_vars as $key => $value) {
                            /*
                             * wenn : im string
                             * suche nach string variablen :name
                             * und ersetze mit {name}
                             */
                            if (strpos($value, ':') !== false) {

                                $search = false;
                                preg_match('/:[A-Za-z0-9]\w+/', $value, $search);

                                if (!empty($search)) {
                                    $replace = [];
                                    foreach ($search as $s) {
                                        $replace[] = '{' . strtolower(substr($s, 1)) . '}';
                                    }

                                    $value = str_replace($search, $replace, $value);
                                }
                            }

                            $old_language_vars[$key] = $value;
                        }

                        /*
                         * scaffold filecontent and write to old platform path
                         */
                        $file_content = '$g_lang = array_merge($g_lang, ' . var_export($old_language_vars, true) . ');' . "\n";

                        $file_beginning = '<?php ' . "\n" . 'global $g_lang;' . "\n";

                        $old_filename = $app . '.lang.php';

                        if ($app == 'core')
                        {
                            $file_beginning = '<?php ' . "\n" . '$g_lang = [];' . "\n";
                            $old_filename = $language . '.php';
                        }

                        file_put_contents(
                            $old_language_path .
                            '/' .
                            $old_filename,
                            $file_beginning . $file_content
                        );
                    }
                }
            }
        }
    }

    private function getVarsFromLanguageFile($file)
    {
        return include $file;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('group', InputArgument::REQUIRED, 'The group to export ("*" for all).'),
        );
    }
}
