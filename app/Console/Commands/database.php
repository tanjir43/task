<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class database extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:database {refresh?} {fresh?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for refresh or create all migration file including template migrations';

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
     * @return int
     */
    public function handle()
    {
        $refresh = $this->argument('refresh');
        $fresh = $this->argument('fresh');
        $this->line('Migration starting...');

        $output = '';
        if (!empty($refresh) || !empty($fresh)) {
            Artisan::call('migrate:fresh');
            $output = Artisan::output();
            $this->line($output);
        }
        else{
            Artisan::call("migrate");
            $output = Artisan::output();
            $this->line($output);
        }

        $migrations = base_path('/database/migrations/');
        $infos = scandir($migrations);
        
        foreach ($infos as $info) {
            if (!in_array($info,['.','..']) &&  is_dir($migrations.$info)) {
                Artisan::call("migrate --path=/database/migrations/{$info}");
                $output_template = Artisan::output();
                if ($output != $output_template) {
                    $this->line("Migration starting for {$info}...");
                    $this->line($output_template);
                }
            }
        }
        $this->line('Migration done!');
    }
}
