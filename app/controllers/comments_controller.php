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

	function view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Comentario no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('comment', $this -> Comment -> findBySlug($slug));
	}

	function add() {
		if (!empty($this -> data)) {
			$this -> Comment -> create();
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó el comentario', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el comentario. Por favor, intente de nuevo.', true));
			}
		}
		$users = $this -> Comment -> User -> find('list');
		$this -> set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Comentario no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó el comentario', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el comentario. Por favor, intente de nuevo.', true));
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
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Comment -> delete($id)) {
			$this -> Session -> setFlash(__('Comentario eliminado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue eliminado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = false;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comentario archivado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue archivado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = true;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comentario archivado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue archivado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Comment -> find($type, $findParams);
		} else {
			return null;
		}
	}

	function admin_beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}

	function admin_index() {
		$this -> Comment -> recursive = 0;
		$this -> set('comments', $this -> paginate());
	}

	function admin_view($slug = null) {
		if (!$slug) {
			$this -> Session -> setFlash(__('Comentario no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('comment', $this -> Comment -> findBySlug($slug));
	}

	function admin_add() {
		if (!empty($this -> data)) {
			$this -> Comment -> create();
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó el comentario', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el comentario. Por favor, intente de nuevo.', true));
			}
		}
		$users = $this -> Comment -> User -> find('list');
		$this -> set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash(__('Comentario no válido', true));
			$this -> redirect(array('action' => 'index'));
		}
		if (!empty($this -> data)) {
			if ($this -> Comment -> save($this -> data)) {
				$this -> Session -> setFlash(__('Se guardó el comentario', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el comentario. Por favor, intente de nuevo.', true));
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
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Comment -> delete($id)) {
			$this -> Session -> setFlash(__('Comentario eliminado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue eliminado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setInactive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = false;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comentario archivado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue archivado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_setActive($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('ID de comentario no válida', true));
			$this -> redirect(array('action' => 'index'));
		}
		$oldData = $this -> Comment -> read(null, $id);
		$oldData["Comment"]["active"] = true;
		if ($this -> Comment -> save($oldData)) {
			$this -> Session -> setFlash(__('Comentario archivado', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('El comentario no fue archivado', true));
		$this -> redirect(array('action' => 'index'));
	}

	function admin_requestFind($type, $findParams, $key) {
		if ($key == Configure::read("key")) {
			return $this -> Comment -> find($type, $findParams);
		} else {
			return null;
		}
	}

}
