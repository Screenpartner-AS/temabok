<?php

abstract class Wt_Import_Export_For_Woo_RemoteAdapter
{
	public $id='';
	public $title='';
	public function __construct()
	{
		
	}
	abstract public function upload($local_file, $remote_file_name, $form_data, $out);
	abstract public function delete();
}