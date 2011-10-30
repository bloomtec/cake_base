$(function(){		
	bCart = {};

	bCart.add = function(botonAdd) { //shop-cart-item-yes-gift
		var rel = $(botonAdd).attr('rel'); // Model:foreignKey:isGift;
		rel = rel.split(":");
		//sizeId = $('.ids-tallas option:selected').attr('id');
		BJS.JSONP('/bcart/shopCarts/addToCart', {
			'data[ShopCartItem][model_name]' : rel[0],
			'data[ShopCartItem][foreign_key]' : rel[1],
			'data[ShopCartItem][is_gift]' : rel[2]
			//'data[ShopCartItem][size_id]' : sizeId
		}, function(cart) {
			if (cart) {
				// Escribe mensaje de confirmacion con link al checkout
				 $(botonAdd).siblings('.add-cart-confirm').html('Producto agregado <a class="go-to-cart" href="/bcart/shopCarts/viewCart" >ir a pagar</a>').show();
				bCart.refresh();
				setTimeout(function(){
					$('.add-cart-confirm').css({visibility:'hidden'});
				},3000);
			} else {
				//
			}
		});
	}
	bCart.resumeRefresh=function(){
		BJS.JSON('/bcart/shopCarts/getResume',{},function(shopCart){
			if(shopCart) $('span.cart-num-items').html(shopCart.ShopCart.items);
			 if(shopCart) $('span.cart-price-total').html(shopCart.ShopCart.total);
		});
	}

	bCart.addGift = function() {
		// Igual al anterior pero con is gif en 1
	}

	bCart.markAsGift = function() {

	}

	bCart.remove = function(itemId) {
		BJS.JSON('/bcart/shopCarts/removeFromCart/'+itemId,{},function(shopcart){
			if(shopcart){
				bCart.refresh();
			}else{
						
			}
		});
	}
	bCart.removeAll = function(itemId) {
		BJS.JSON('/bcart/shopCarts/removeAllFromCart',{},function(shopcart){
			if(shopcart){
				bCart.refresh();
			}else{
						
			}
		});
	}
	bCart.getItems = function() {

	}

	bCart.updateItem = function(itemId,fieldName ,value) {
		BJS.JSON('/bcart/shopCarts/updateShopCartItem/'+itemId+'/'+fieldName+'/'+value,{},function(data){
			if(data){
				bCart.refresh();
			}else{
						
			}
		});
	}

	bCart.updateItems = function() {

	}

	bCart.refresh = function() {
		BJS.get("/bcart/shopCarts/refresh",{},function(data){
			if(data){
				$('.shop-cart-list-container').html(data);
				bCart.resumeRefresh();
			}else{
						
			}
		});
	}
	bCart.resumeRefresh();
	$('.add-to-cart').live('click',function(e){
		e.preventDefault();
		bCart.add(this);
	});
	
	$('.item-quantity').live('change',function(){
		var value=$(this).val();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bCart.updateItem(itemId,'quantity',value);
	});
	
	$('.remove-from-cart').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bCart.remove(itemId);
	});
	
	$('.remove-all').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bCart.removeAll(itemId);
	});
});