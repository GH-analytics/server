<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SyncHangouts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sync-hangouts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Start moving all hangouts.json data into the database.';

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
	public function fire()
	{
            // get command line argument for file name and place it
            // should be located in for processing.
            $file = storage_path() . '/uploads/' . $this->argument('filename');
            
            // Pass to Hangouts class to parse the data.
            new Analytics\Hangout\Hangouts($file);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('filename', InputArgument::REQUIRED, 'Hangouts.json file to be parsed.'),
		);
	}

}
