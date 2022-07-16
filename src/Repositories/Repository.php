<?php

namespace src\Repositories;

use mysqli;

/**
 * An example of a base class to reduce database connectivity configuration for each repository subclass.
 */
class Repository
{

	protected mysqli $mysqlConnection;

	private string $hostname;
	private string $username;
	private string $databaseName;
	private string $databasePassword;


	public function __construct()
	{
		// Note: in a real application we'd want to use environment variables to store credentials and any other environment specific data.

		$this->hostname = 'lcpbq9az4jklobvq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
		$this->username = 'sp7pf1v1cwjlg2bc';
		$this->databaseName = 'tmmdncx1erpi8twe';
		$this->databasePassword = 'i5vw5b2po4anfbpe';

		$con=$this->mysqlConnection = new mysqli($this->hostname, $this->username, $this->databasePassword, $this->databaseName);
		if ($this->mysqlConnection->connect_error) {
			die('Connection failed: ' . $this->mysqlConnection->connect_error);
		}
	}





}
