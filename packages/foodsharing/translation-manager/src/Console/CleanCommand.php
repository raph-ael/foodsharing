<?php namespace Foodsharing\TranslationManager\Console;

use Illuminate\Console\Command;
use Foodsharing\TranslationManager\Manager;

class CleanCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'translations:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean empty translations';

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
        $this->manager->cleanTranslations();
        $this->info("Done cleaning translations");
    }
}
