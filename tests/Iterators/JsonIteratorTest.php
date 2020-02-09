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

    public function testGivenFlatJsonObjectsThenParseOneByOne() {
        $json = $this::buildTestJson(5, self::FLAT_JSON_OBJECT_AS_STRING);
        $iterator = JsonIteratorFactory::buildJsonIterator($json);

        $this->goThroughIterator($iterator);

        $this->assertEquals(5, $this->counter);
    }

    protected static function buildTestJson($nbObjects, $jsonObject) {
        $jsonObjects = array_fill(0, $nbObjects, $jsonObject);
        $json = implode(",", $jsonObjects);

        return $json;
    }

    protected function goThroughIterator($iterator) {
        foreach ($iterator as $parsedJsonObject) {
            // Here you can do something with $parsedJsonObject as an array, 
            // has it had gone through json_decode already
            $this->counter++;
        }
    }

}
