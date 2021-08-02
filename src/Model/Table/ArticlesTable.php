<?php

namespace PlexusCorp\Experiment\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;

class ArticlesTable extends Table
{
    public function findPublished(Query $query, array $options): Query
    {
        $query->where([
            $this->getAlias() . '.published' => 1
        ]);
        return $query;
    }
}
