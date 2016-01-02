<?php

namespace Crystalgorithm\PhpJsonIterator;

class NeedleFactory
{

    public function __construct()
    {

    }

    function build($firstTopLevelString = null)
    {
	$this->needle = ',{';

	if ($firstTopLevelString != null)
	{
	    $this->needle .= '"' . $firstTopLevelString . '"';
	}
    }

}
