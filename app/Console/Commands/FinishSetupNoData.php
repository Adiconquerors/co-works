<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class FinishSetupNoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cowork:finishsetupnodata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will finish the final setup for the application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Let us move our sample images for demo data to the installed location.
         */

        if ( File::isDirectory(public_path('install-scripts/default-imgs')) ) {
            File::copyDirectory(public_path('install-scripts/default-imgs'), public_path('uploads/default-imgs'), true);
        }
      
        if ( File::isDirectory(public_path('install-scripts/settings')) ) {
            File::copyDirectory(public_path('install-scripts/settings'), public_path('uploads/settings'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/space-types')) ) {
            File::copyDirectory(public_path('install-scripts/space-types'), public_path('uploads/space-types'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/sub_space_types')) ) {
            File::copyDirectory(public_path('install-scripts/sub_space_types'), public_path('uploads/sub_space_types'), true);
        }
        
        
        echo trans('Moved Successfully!!!');
    }
}