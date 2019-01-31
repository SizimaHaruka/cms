<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\Table;
use Cake\Utility\Text;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsToMany('tags');
    }
    public function beforeSave($ecent, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug){
          $sluggedTitle = Text::slug($entity->title);
          $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }
    public function validationDefault(Validator $validator)
    {
      $validator
      ->allowEmptyString('title', false)
      ->minLength('title', 10)
      ->maxLength('title',255)

      ->allowEmptyString('body', false)
      ->minLength('body', 10);

      return $validator;
    }
}
