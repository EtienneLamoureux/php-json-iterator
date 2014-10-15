<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\PhpJsonIterator;

use Crystalgorithm\PhpJsonIterator\iterator\JsonFileIterator;
use Crystalgorithm\PhpJsonIterator\iterator\JsonFilesIterator;
use Crystalgorithm\PhpJsonIterator\iterator\JsonIterator;

class JsonIteratorFactory
{

    public static function buildJsonIterator($json, array $options = null)
    {
	return new JsonIterator($json, $options);
    }

    public static function buildJsonFileIterator($jsonFileHandle, array $options = null)
    {
	return new JsonFileIterator($jsonFileHandle, $options);
    }

    public static function buildJsonFilesIterator($jsonFileHandles, array $options = null)
    {
	return new JsonFilesIterator($jsonFileHandles, $options);
    }

}
