<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Crystalgorithm\PhpJsonIterator\Iterators;

use PHPUnit_Framework_TestCase;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;

final class JsonIteratorTest extends PHPUnit_Framework_TestCase {

    const FLAT_JSON_OBJECT_AS_STRING = '{"foo":"bar","fizz":"buzz"}';
    const NESTED_JSON_OBJECT_AS_STRING = '{"foo":"bar","fizz":{"id":1,"nested":true}}';

    protected $counter;

    protected function setUp() {
        $this->counter = 0;
    }

    /**
     * If you're dealing with flat JSON objects (no nested objects), you can 
     * build the iterator with no addiitonal parameters.
     */
    public function testGivenJsonArrayOfFlatObjectsThenParseOneByOne() {
        $json = $this::buildTestJson(5, self::FLAT_JSON_OBJECT_AS_STRING);
        $iterator = JsonIteratorFactory::buildJsonIterator($json);

        $this->goThroughIterator($iterator);

        $this->assertEquals(5, $this->counter);
    }

    /**
     * If you're dealing with JSON objects that contain nested JSON objects, 
     * you have to provide the first key of the top-level object as an 
     * additional parameter. 
     * If your collection of objects do not have a standard schema, or fields 
     * are listed in a random order, this project cannot help you.
     */
    public function testGivenJsonArrayOfNestedObjectsThenParseOneByOne() {
        $json = $this::buildTestJson(5, self::NESTED_JSON_OBJECT_AS_STRING);
        $iterator = JsonIteratorFactory::buildJsonIterator($json, array("firstTopLevelString" => "foo"));

        $this->goThroughIterator($iterator);

        $this->assertEquals(5, $this->counter);
    }

    /**
     * The iterator supports incorrect JSON arrays (with no start nor end brackets).
     */
    public function testCommaSeparatedJsonObjectsThenParseOneByOne() {
        $jsonObjects = array_fill(0, 5, self::FLAT_JSON_OBJECT_AS_STRING);
        $json = implode(",", $jsonObjects);
        $iterator = JsonIteratorFactory::buildJsonIterator($json, array("jsonHasSquareBrackets" => false));

        $this->goThroughIterator($iterator);

        $this->assertEquals(5, $this->counter);
    }

    protected static function buildTestJson($nbObjects, $jsonObject) {
        $jsonObjects = array_fill(0, $nbObjects, $jsonObject);
        $json = implode(",", $jsonObjects);

        return "[" . $json . "]";
    }

    protected function goThroughIterator($iterator) {
        foreach ($iterator as $parsedJsonObject) {
            // Here you can do something with $parsedJsonObject as an array, 
            // has it had gone through json_decode already
            $this->counter++;
        }
    }

}
