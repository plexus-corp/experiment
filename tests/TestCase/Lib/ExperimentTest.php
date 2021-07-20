<?php

namespace PlexusCorp\Test\TestCase\Lib;

use PlexusCorp\Experiment\Lib\Experiment;

class ExperimentTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->Experiment = new Experiment();
    }

    public function testAdd10()
    {
        $result = $this->Experiment->add10(1);
        $this->assertEqual(11, $result);
    }

}
