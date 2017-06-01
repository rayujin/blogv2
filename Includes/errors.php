<?php

class Errors extends Controller
{
	public function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		die('Acces interdit');
	}

	public function champsIncorrect()
	{
		$this->render('errorChampsIncorrect');
	}
}