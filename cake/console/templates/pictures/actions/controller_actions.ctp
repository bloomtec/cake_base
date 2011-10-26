<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.console.libs.template.objects
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php if(!$admin): ?>
	
	function <?php echo $admin ?>beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
<?php endif;?>
	
	function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->paginate());
	}

	function <?php echo $admin ?>view($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid <?php echo strtolower($singularHumanName) ?>', true));
			$this->redirect(array('action' => 'index'));
<?php else: ?>
			$this->flash(__('Invalid <?php echo strtolower($singularHumanName); ?>', true), array('action' => 'index'));
<?php endif; ?>
		}
		$this-><?php echo $currentModelName ?>->recursive = 0;
		<?php $parent_id=strtolower(substr($currentModelName,0,strpos($currentModelName, 'Picture')))."_id";?>
		$this->set('<?php echo $pluralName ?>', $this-><?php echo  $currentModelName ?>->find('all',array('conditions'=>array('<?php echo $parent_id?>'=>$id))));
		$this->set('parent_id',$id);
			<?php $parentModel=substr($currentModelName,0,strpos($currentModelName, 'Picture'));?>
		$parent=$this-><?php echo $currentModelName ?>-><?php echo $parentModel ?>->read(null,$id); 
			 if (isset($parent['<?php echo $parentModel ?>']['name'])){
			 	 $this->set('parentName',$parent['<?php echo $parentModel ?>']['name']);
			}else{
			  if (isset($parent['<?php echo $parentModel;?>']['title'])) $this->set('parentName',$parent['<?php echo $parentModel ?>']['title']);
			}		 
	}
<?php if($admin):  $compact = array(); ?>
	
	function <?php echo $admin ?>add() {
		if (!empty($this->data)) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved', true));
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('<?php echo ucfirst(strtolower($currentModelName)); ?> saved.', true), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.', true));
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}
<?php endif; ?>
<?php if($admin):  $compact = array(); ?>
	
	function <?php echo $admin; ?>edit($id = null) {
		if (!$id && empty($this->data)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid <?php echo strtolower($singularHumanName); ?>', true));
			$this->redirect(array('action' => 'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), array('action' => 'index'));
<?php endif; ?>
		}
		if (!empty($this->data)) {
			if ($this-><?php echo $currentModelName; ?>->save($this->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved', true));
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.', true), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.', true));
<?php endif; ?>
			}
		}
		if (empty($this->data)) {
			$this->data = $this-><?php echo $currentModelName; ?>->read(null, $id);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}
<?php endif;?>
<?php if($admin): ?>
	
	function <?php echo $admin; ?>delete($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid id for <?php echo strtolower($singularHumanName); ?>', true));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), array('action' => 'index'));
<?php endif; ?>
		}
		$toDelete=$this-><?php  echo $currentModelName; ?>->read(null,$id);
		if ($this-><?php echo $currentModelName; ?>->delete($id)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted', true));
			<?php $parent_id=strtolower(substr($currentModelName,0,strpos($currentModelName, 'Picture')))."_id";?>
			$this->redirect(array('action'=>'view',$toDelete['<?php  echo $currentModelName; ?>']['<?php echo $parent_id; ?>']));
<?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted', true), array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted', true));
<?php else: ?>
		$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted', true), array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}
<?php endif; ?>	
<?php if($modelObj->activable && $admin): ?>
	
	function <?php echo $admin; ?>setInactive($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid id for <?php echo strtolower($singularHumanName); ?>', true));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), array('action' => 'index'));
<?php endif; ?>
		}
		$oldData=$this-><?php echo $currentModelName; ?>->read(null,$id);
		$oldData["<?php echo $currentModelName; ?>"]['is_active']=false;
		if ($this-><?php echo $currentModelName; ?>->save($oldData)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> archived', true));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> archived', true), array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not archived', true));
<?php else: ?>
		$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not archived', true), array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}
<?php endif; ?>
<?php if($modelObj->activable && $admin): ?>
	
	function <?php echo $admin; ?>setActive($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid id for <?php echo strtolower($singularHumanName); ?>', true));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), array('action' => 'index'));
<?php endif; ?>
		}
		$oldData=$this-><?php echo $currentModelName; ?>->read(null,$id);
		$oldData["<?php echo $currentModelName; ?>"]['is_active']=true;
		if ($this-><?php echo $currentModelName; ?>->save($oldData)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> archived', true));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> archived', true), array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not archived', true));
<?php else: ?>
		$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not archived', true), array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}
<?php endif;?>
<?php if($modelObj->sortable && $admin): ?>
	
	function <?php echo $admin; ?>reOrder(){
    	foreach($this->data["Item"] as $id=>$position){
    		$this-><?php echo $currentModelName; ?>->id=$id;
    		$this-><?php echo $currentModelName; ?>->saveField("sort",$position); 
    	}
		echo true;
		Configure::write('debug', 0);
		$this->autoRender = false;
		exit();
	}
<?php endif;?>
<?php if($modelObj->isPicture && $admin):?>
	
	function <?php echo $admin; ?>uploadfy_add() {
	<?php $parent_id=strtolower(substr($currentModelName,0,strpos($currentModelName, 'Picture')))."_id"; ?>
		if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['<?php echo $currentModelName; ?>']['<?php echo $parent_id; ?>']=$_POST["parent_id"];
				$picture['<?php echo $currentModelName; ?>']['path']=$_POST["name"];
				$this-><?php echo $currentModelName; ?>->create();
				$this-><?php echo $currentModelName; ?>->save($picture);
				echo $this-><?php echo $currentModelName; ?>->id;
			}else{
				
				echo false;
			}
			
		}else{function <?php echo $admin; ?>uploadfy_add() {
	<?php $parent_id=strtolower(substr($currentModelName,0,strpos($currentModelName, 'Picture')))."_id"; ?>
		if($_POST["name"]&&$_POST["folder"]){
			if(isset($_POST['parent_id'])){
				$picture['<?php echo $currentModelName; ?>']['<?php echo $parent_id; ?>']=$_POST["parent_id"];
				$picture['<?php echo $currentModelName; ?>']['path']=$_POST["name"];
				$this-><?php echo $currentModelName; ?>->create();
				$this-><?php echo $currentModelName; ?>->save($picture);
				echo $this-><?php echo $currentModelName; ?>->id;
			}else{
				
				echo false;
			}
			
		}else{
			echo false;
		}
		
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
			echo false;
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
<?php endif;?>