<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class FinishSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cowork:finishsetup';

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

        if ( File::isDirectory(public_path('install-scripts/articles')) ) {
            File::copyDirectory(public_path('install-scripts/articles'), public_path('uploads/articles'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/default-imgs')) ) {
            File::copyDirectory(public_path('install-scripts/default-imgs'), public_path('uploads/default-imgs'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/listings')) ) {
            File::copyDirectory(public_path('install-scripts/listings'), public_path('uploads/listings'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/ourclients')) ) {
            File::copyDirectory(public_path('install-scripts/ourclients'), public_path('uploads/ourclients'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/properties')) ) {
            File::copyDirectory(public_path('install-scripts/properties'), public_path('uploads/properties'), true);
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
        if ( File::isDirectory(public_path('install-scripts/testimonials')) ) {
            File::copyDirectory(public_path('install-scripts/testimonials'), public_path('uploads/testimonials'), true);
        }
        if ( File::isDirectory(public_path('install-scripts/users')) ) {
            File::copyDirectory(public_path('install-scripts/users'), public_path('uploads/users'), true);
        }
        echo trans('Moved Successfully!!!');
    }
}