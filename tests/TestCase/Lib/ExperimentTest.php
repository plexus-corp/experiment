<?php

namespace PlexusCorp\Tests\TestCase\Lib;

use PlexusCorp\Experiment\Lib\Experiment;
use Cake\TestSuite\TestCase;

class ExperimentTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->Experiment = new Experiment();
    }

    public function testAdd10()
    {
        $result = $this->Experiment->add10(1);
        $this->assertEquals(11, $result);
    }

}
