$(function(){	
	BJS = {};

	BJS.get = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "GET",
			cache : false,
			data : params,
			success : callback
		});
	}

	BJS.post = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "POST",
			cache : false,
			data : params,
			success : callback
		});
	}

	BJS.JSON = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "GET",
			cache : false,
			dataType : "json",
			data : params,
			success : callback
		});
	}

	BJS.JSONP = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "POST",
			cache : false,
			dataType : "json",
			data : params,
			success : callback
		});
	}
	BJS.setParam = function(param, value) {
		/* añande o modifica un parametro de la forma param:value */
		var url = document.URL;
		var params = url.substring(url.indexOf("/", 0));
		if (params.substring(0, 2) == "//") {
			params = params.substring(params.indexOf("/", 2));
		}
		if (params.slice(-1) != "/") {
			params += "/";
		}
		paramInUrl = params.indexOf(param + ":");// desde donde esta el
		// parametro
		if (paramInUrl >= 0) {
			var indexValue = paramInUrl + param.length + 1/*
															 * incluyo los dos
															 * puntos
															 */;
			var urlTillValue = params.substring(0, indexValue);
			var newValue = params.substring(indexValue, params.indexOf("/",
					paramInUrl));
			var urlAfterValue = params.substring(indexValue + newValue.length);
			return urlTillValue + value + urlAfterValue;
		} else {
			return params + param + ":" + value;
		}
	}
	
	bCart = {};

	bCart.add = function(botonAdd) { //shop-cart-item-yes-gift
		var rel = $(botonAdd).parents('.shop-cart-item').attr('rel'); // Product:1;
		rel = rel.split(":");
		//sizeId = $('.ids-tallas option:selected').attr('id');
		BJS.JSONP('/shopCarts/addToCart', {
			'data[ShopCartItem][model_name]' : rel[0],
			'data[ShopCartItem][foreign_key]' : rel[1],
			'data[ShopCartItem][is_gift]' : rel[2]
			//'data[ShopCartItem][size_id]' : sizeId
		}, function(cart) {
			if (cart) {
				// Escribe mensaje de confirmacion con link al checkout
				bCart.resumeRefresh();
				$('.add-cart-confirm').html('Producto agregado <a class="go-to-cart" href="/shopCarts/viewCart" >ir a pagar</a>').show();
				refreshCufon();
				setTimeout(function(){
					$('.add-cart-confirm').css({visibility:'hidden'});
				},3000);
			} else {
				//
			}
		});
	}
	bCart.resumeRefresh=function(){
		BJS.JSON('/shopCarts/getResume',{},function(shopCart){
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
		BJS.JSON('/shopCarts/removeFromCart/'+itemId,{},function(shopcart){
			if(shopcart){
				bCart.refresh();
			}else{
						
			}
		});
	}
	bCart.removeAll = function(itemId) {
		BJS.JSON('/shopCarts/removeAllFromCart',{},function(shopcart){
			if(shopcart){
				bCart.refresh();
			}else{
						
			}
		});
	}
	bCart.getItems = function() {

	}

	bCart.updateItem = function(itemId,fieldName ,value) {
		BJS.JSON('/shopCarts/updateShopCartItem/'+itemId+'/'+fieldName+'/'+value,{},function(data){
			if(data){
				bCart.refresh();
			}else{
						
			}
		});
	}

	bCart.updateItems = function() {

	}

	bCart.refresh = function() {
		BJS.get("/shopCarts/refresh",{},function(data){
			if(data){
				$('.shop-cart-list-container').html(data);
				bCart.resumeRefresh();
				refreshCufon();	
			}else{
						
			}
		});
	}

	$('.add-to-cart').live('click',function(e){
		e.preventDefault();
		bloomCart.add(this);
	});
	$('.remove-from-cart').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bloomCart.remove(itemId);
	});
	$('.remove-all').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bloomCart.removeAll(itemId);
	});
});