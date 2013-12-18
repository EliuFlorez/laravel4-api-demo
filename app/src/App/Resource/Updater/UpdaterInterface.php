<?php

namespace App\Resource\Updater;

interface UpdaterInterface
{
	
	public function update($id, $input);
}