<?php

namespace PlexusCorp\Experiment\Test\TestCase\Model\Table;

use PlexusCorp\Experiment\Model\Table\ArticlesTable;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;

class ArticlesTableTest extends TestCase
{
    protected $fixtures = ['plugin.PlexusCorp/Experiment.Articles'];

    public function setUp(): void
    {
        parent::setUp();
        $this->Articles = $this->getTableLocator()->get('PlexusCorp/Experiment.Articles');
    }

    public function testFindPublished(): void
    {
        //$query = $this->Articles->find('published')->all();
        $query = $this->Articles->find('published', ['fields' => ['id', 'title']]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->disableHydration()->toArray();

        $expected = [
            ['id' => 1, 'title' => 'First Article'],
            ['id' => 2, 'title' => 'Second Article'],
            ['id' => 3, 'title' => 'Third Article']
        ];

        $this->assertEquals($expected, $result);
    }

}
