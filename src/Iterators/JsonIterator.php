<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\PhpJsonIterator\Iterators;

use Iterator;

class JsonIterator implements Iterator
{

    protected $needle;
    protected $jsonString;
    protected $cursorPosition;
    protected $nextCursorPosition;

    public function __construct($jsonString, array $options = null)
    {
	$this->jsonString = $jsonString;

	$this->setDefaultOptions($options);
	$this->needleFactory($options['firstTopLevelString']);

	if ($options['jsonHasSquareBrackets'])
	{
	    $this->jsonString = substr($this->jsonString, 1, -1);
	}
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
	$this->getNextCursorPosition();
	$elementLength = ($this->nextCursorPosition - $this->cursorPosition);
	$currentElement = substr($this->jsonString, $this->cursorPosition, $elementLength);

	return json_decode($currentElement, true);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
	return null;
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
	$this->cursorPosition = ($this->nextCursorPosition + 1);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
	$this->cursorPosition = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
	if ($this->cursorPosition >= strlen($this->jsonString))
	{
	    return false;
	}

	return true;
    }

    protected function needleFactory($firstTopLevelString = null)
    {
	$this->needle = ',{';

	if ($firstTopLevelString != null)
	{
	    $this->needle .= '"' . $firstTopLevelString . '"';
	}
    }

    protected function getNextCursorPosition()
    {
	$this->nextCursorPosition = strpos($this->jsonString, $this->needle, $this->cursorPosition);

	if ($this->nextCursorPosition == false)
	{
	    $this->nextCursorPosition = strlen($this->jsonString);
	}

	return $this->nextCursorPosition;
    }

    protected function setDefaultOptions(array &$options)
    {
	if (!isset($options['jsonHasSquareBrackets']))
	{
	    $options['jsonHasSquareBrackets'] = TRUE;
	}

	if (!isset($options['firstTopLevelString']))
	{
	    $options['firstTopLevelString'] = null;
	}
    }

    public function __destruct()
    {
	unset($this->jsonString);
	$this->jsonString = '';
    }

}
