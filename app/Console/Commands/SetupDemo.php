<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
class SetupDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:demo';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all of the required commands to setup a demo';
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
        //$this->call('db:wipe');//kill content from database
        $this->call('aimeos:setup');//setup default db from aimeos
        $this->call('migrate');//migrate project migration
        $this->call('db:seed');//Add content to db
        $this->call('storage:link');//Create link
        $this->call('optimize');//Remove old cache and create another
        $this->line('');
        $this->warn('Demo Setup completed successfully!');
        $this->line('');
        $this->info('For visiting installed demo site');
        $this->comment('For Admin use:');
        $this->line('  user: admin@demo.com');
        $this->line('  password: admin');
        $this->comment('For Client use:');
        $this->line('  user: client@demo.com');
        $this->line('  password: client');
        $this->line('');
        return 0;
    }
}