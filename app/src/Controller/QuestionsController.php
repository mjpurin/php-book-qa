<?php
namespace App\Controller;

class QuestionsController extends AppController{
	public function initialize(){
		parent::initialize();
		$this->loadModel('Answers');
	}
	public function index(){
		$questions=$this->paginate($this->Questions->find(),[
			'order'=>['Questions.id'=>'DESC']
		]);
		$this->set(compact('questions'));
	}
	public function add(){
		$question=$this->Questions->newEntity();
		if($this->request->is('post')){
			$question=$this->Questions->patchEntity($question,$this->request->getData());
			$question->user_id=1; //@TODO ユーザー管理機能実装時に修正する
			if($this->Questions->save($question)){
				$this->Flash->success('質問を投稿しました');
				return $this->redirect(['action'=>'index']);
			}
			$this->Flash->error('質問の投稿に失敗しました');
		}
		$this->set(compact('question'));
	}
	public function view(int $id){
		$question=$this->Questions->get($id);
		$answers=$this->Answers->find()->where(['Answers.question_id'=>$id])->orderAsc('Answers.id')->all();
		$this->set(compact('question','answers'));
	}
}
