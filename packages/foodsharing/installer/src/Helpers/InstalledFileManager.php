<?php

namespace Foodsharing\Installer\Helpers;


class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return int
     */
    public function create()
    {
        //file_put_contents(storage_path('installed'), '');
    }

    /**
     * Update installed file.
     *
     * @return int
     */
    public function update()
    {
        return $this->create();
    }
}