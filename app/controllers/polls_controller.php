<?php
class PollsController extends AppController {

	var $name = 'Polls';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function add($model=null, $foreign_key = null, $votacion = null) {
		$this->layout="ajax";
		if($model && $foreign_key && $votacion) {
			if(
				$poll = $this->Poll->find(
					'first',
					array(
						'recursive'=>-1,
						'conditions'=>array(
							'Poll.user_id' => $this->Session->read('Auth.User.id'),
							'Poll.foreign_key' => $foreign_key,
							'Poll.model' => $model
						)
					)
				)
			) {
				$this->Poll->read(null,$poll['Poll']['id']);
			}else{
				$this->Poll->create();
			}
			
			$this->Poll->set('user_id', $this->Session->read("Auth.User.id"));
			$this->Poll->set('model', $model);
			$this->Poll->set('foreign_key', $foreign_key);
			$this->Poll->set('vote', $votacion);
			if ($this->Poll->save()) {
				$polls = $this->Poll->find(
					'list',
					array(
						'conditions'=>array(
							'Poll.foreign_key'=>$foreign_key,
							'Poll.model' => $model
						),
						'fields'=>array('Poll.vote')
					)
				);
				$total = 0.0;
				foreach($polls as $poll) {
					$total = $total + $poll['vote'];
				}
				$result = $total / count($polls);
				echo $result;
			} else {
				echo false;
			}
		}
		exit(0);
	}
	
	function getPolls( $model = null, $foreign_key = null) {
		$this->layout="ajax";
		$polls = $this->Poll->find(
			'list',
			array(
				'conditions'=>array(
					'Poll.foreign_key'=>$foreign_key,
					'Poll.model' => $model
				),
				'fields'=>array('Poll.vote')
			)
		);
		$total = 0.0;
		if(!empty($polls)) {
			foreach($polls as $poll) {
				$total = $total + $poll['vote'];
			}
			$result = $total / count($polls);
			echo $result;
		} else {
			echo "0";
		}		
		exit(0);
	}

}