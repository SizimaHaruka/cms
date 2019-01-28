<?php
// src/Model/Table/ArticlesTable.php
namespeace App\Model\Table;

use Cake\ORM\Table;
class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBenhavior('Timestamp');
    }
}
