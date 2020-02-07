<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class QuestionsTable extends Table{
	public function initialize(array $config){
		parent::initialize($config);
		$this->setTable('questions');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('Answers',['foreignKey'=>'question_id']);

	}
}
