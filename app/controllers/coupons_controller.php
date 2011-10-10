<?php
class CouponsController extends AppController {

	var $name = 'Coupons';

	function admin_index() {
		$this -> Coupon -> recursive = 0;
		$this -> set('coupons', $this -> paginate());
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for coupon', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> Coupon -> delete($id)) {
			$this -> Session -> setFlash(__('Coupon deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Coupon was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
