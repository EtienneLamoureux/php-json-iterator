<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

class JsonFileIterator extends JsonIterator
{

    protected $jsonFileHandle;

    public function __construct($jsonFileHandle, array $options = null)
    {
	$this->jsonFileHandle = $jsonFileHandle;

	$jsonString = file_get_contents($jsonFileHandle);
	parent::__construct($jsonString, $options);
    }

    public function __destruct()
    {
	parent::__destruct();
	//unlink($this->jsonFileHandle);
    }

}
