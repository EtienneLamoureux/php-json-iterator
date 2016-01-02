<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\PhpJsonIterator\Iterators;

use AppendIterator;

class JsonFilesIterator extends AppendIterator
{

    public function __construct(NeedleFactory $needleFactory, array $jsonFileHandles, array $options = null)
    {
	parent::__construct();

	foreach ($jsonFileHandles as $jsonFileHandle)
	{
	    $this->append(new JsonFileIterator($needleFactory, $jsonFileHandle, $options));
	}
    }

}
