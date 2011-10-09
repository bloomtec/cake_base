<?php
class CouponBatchesController extends AppController {

	var $name = 'CouponBatches';

	function admin_add() {
		if (!empty($this -> data)) {
			debug($this->data);
			$this -> CouponBatch -> create();
			if ($this -> CouponBatch -> save($this -> data)) {
				for($i=$this->data['CouponBatch']['quantity']; $i > 0; $i--) {
					$coupon_made = false;
					while(!$coupon_made) {
						$coupon_made = $this->CouponBatch->Coupon->createCoupon($this->CouponBatch->id);
					}
				}
				$this -> Session -> setFlash(__('The coupon batch has been made', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The coupon batch could not be made. Please, try again.', true));
			}
		}
	}

	function admin_index() {
		$this -> CouponBatch -> recursive = 0;
		$this -> set('couponBatches', $this -> paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid coupon batch', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('couponBatch', $this -> CouponBatch -> read(null, $id));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid id for coupon batch', true));
			$this -> redirect(array('action' => 'index'));
		}
		if ($this -> CouponBatch -> delete($id)) {
			$this -> Session -> setFlash(__('Coupon batch deleted', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Coupon batch was not deleted', true));
		$this -> redirect(array('action' => 'index'));
	}

}
