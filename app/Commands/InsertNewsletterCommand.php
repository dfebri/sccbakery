<?php namespace sccbakery\Commands;

use sccbakery\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class InsertNewsletterCommand extends Command implements SelfHandling {

    public $email;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($email)
	{
        $this->email    = $email;
		//
	}
	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        echo $this->email;
		//
	}

}
