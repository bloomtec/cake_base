<?php
class CommentsController extends AppController {

	var $name = 'Comments';

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function index() {
		$this -> Comment -> recursive = 0;
		$this -> set('comments', $this -> paginate());
	}

	

	function add() {
		if (!empty($this -> data)) {
			$this -> Comment -> create();
			$this -> data["Comment"]["user_id"] = $this -> Auth -> user("id");
			
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('The comment has been saved', true));
				echo $this -> Comment -> id;
			} else {
				echo false;
			}
		}
		Configure::write('debug',0);
		exit(0);
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('The comment has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Comment -> read(null, $id);
		}
		$users = $this -> Comment -> User -> find('list');
		$this -> set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for comment', true));
			//$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Comment -> delete($id)) {
			$this -> Session -> setFlash(__('Comment deleted', true));
			echo true;
			//$this -> redirect(array('action' => 'index'));
		}else{
			echo false;
		}
		
		Configure::write('debug',0);
		exit(0);
	}

	function admin_index() {
		$this -> Comment -> recursive = 0;
		$this -> set('comments', $this -> paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Invalid comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('comment', $this -> Comment -> findBySlug($slug));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Comment -> create();
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('The comment has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		$users = $this -> Comment -> User -> find('list');
		$this -> set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Invalid comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('The comment has been saved', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Comment -> read(null, $id);
		}
		$users = $this -> Comment -> User -> find('list');
		$this -> set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Comment -> delete($id)) {
			$this -> Session -> setFlash(__('Comment deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Comment was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = false;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comment archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Comment was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for comment', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = true;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comment archived', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Comment was not archived', true));
		$this -> redirect(array('action' => 'index'));
	}
}
