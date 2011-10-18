$(function() {
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

	bloomCart = {};

	bloomCart.add = function(botonAdd) { //shop-cart-item-yes-gift
		var rel = $(botonAdd).parents('.shop-cart-item').attr('rel'); // Product:1;
		rel = rel.split(":");
		sizeId = $('.ids-tallas option:selected').attr('id');
		BJS.JSONP('/shopCarts/addToCart', {
			'data[ShopCartItem][model_name]' : rel[0],
			'data[ShopCartItem][foreign_key]' : rel[1],
			'data[ShopCartItem][is_gift]' : rel[2],
			'data[ShopCartItem][size_id]' : sizeId
		}, function(cart) {
			console.log(cart);
			if (cart) {
				// Escribe mensaje de confirmacion con link al checkout
				bloomCart.resumeRefresh();
				$('.add-cart-confirm').html('Producto agregado <a class="twCenMt ir" href="/shopCarts/viewCart" >ir a pagar</a>').css({'visibility':'visible'});
				refreshCufon();
				setTimeout(function(){
					$('.add-cart-confirm').css({visibility:'hidden'});
				},3000);
			} else {
				//
			}
		});
	}
	bloomCart.resumeRefresh=function(){
		BJS.JSON('/shopCarts/getResume',{},function(shopCart){
			if(shopCart) $('span.cart-num-items').html(shopCart.ShopCart.items);
			 if(shopCart) $('span.cart-price-total').html(shopCart.ShopCart.total);
		});
	}

	bloomCart.addGift = function() {
		// Igual al anterior pero con is gif en 1
	}

	bloomCart.markAsGift = function() {

	}

	bloomCart.remove = function(itemId) {
		BJS.JSON('/shopCarts/removeFromCart/'+itemId,{},function(shopcart){
			if(shopcart){
				bloomCart.refresh();
			}else{
						
			}
		});
	}
	bloomCart.removeAll = function(itemId) {
		BJS.JSON('/shopCarts/removeAllFromCart',{},function(shopcart){
			if(shopcart){
				bloomCart.refresh();
			}else{
						
			}
		});
	}
	bloomCart.getItems = function() {

	}

	bloomCart.updateItem = function(itemId,fieldName ,value) {
		BJS.JSON('/shopCarts/updateShopCartItem/'+itemId+'/'+fieldName+'/'+value,{},function(data){
			if(data){
				bloomCart.refresh();
			}else{
						
			}
		});
	}

	bloomCart.updateItems = function() {

	}

	bloomCart.refresh = function() {
		BJS.get("/shopCarts/refresh",{},function(data){
			if(data){
				$('.shop-cart-list-container').html(data);
				bloomCart.resumeRefresh();
				refreshCufon();	
			}else{
						
			}
		});
	}
	bloomCart.resumeRefresh();
	// CLASES DE LAS FUENTES
	
	refreshCufon();

	// EFECTO HOVER DE LAS MARCAS
	$(".brands-menu li a img").hover(function() {
		$(this).attr("src", "/img/uploads/" + $(this).attr("rel"));
	}, function() {
		$(this).attr("src", "/img/uploads/" + $(this).attr("image"));
	});
	$("select.filter").change(
			function() {
				document.location.href = BJS.setParam($(this).attr('rel'), $(
						this).find("option:selected").val());
			});
	$('a.order').click(function(e) {
		e.preventDefault();
		document.location.href = BJS.setParam('orden', $(this).attr('rel'));

	});

	// OVERLAY
	$("a[rel='#overlay']").overlay({
		mask : 'black',
		onBeforeLoad : function() {
			var wrap = this.getOverlay().find(".contentWrap");
			wrap.load(this.getTrigger().attr("href"));
		},
		onLoad:function(){
			refreshCufon();
		}
	});
	
	/**
	 * Comentarios
	 * --> id del link :: escribir-comentario
	 */
	$("#escribir-comentario").click(function(e){
		e.preventDefault();
		BJS.post("/users/isLoggedIn", null, function(info){
			if(info == "true") {
				$('#create-comment').css('visibility','visible');
			} else {
				$('#user-info').css('visibility','visible');
			}
		});
	});
	$("#enviar-comentario").click(function(e){
		$("#CommentAddForm").submit();
	});
	
	/**
	 * Funcionalidad Carrito
	 */
	// Aplicar cupon
	$("#set-coupon").live('submit', function(e){
		e.preventDefault();
		BJS.post('/shop_carts/setCoupon/' + $("#get-serial").val(), null, function(data){
			bloomCart.refresh();
		});
	});
	$.tools.validator.localize("es", {
		'*'			: 'datos no validos',
		':email'  	: 'email no valido',
		':number' 	: 'el campo debe ser numerico',
		':url' 		: 'URL no valida',
		'[max]'	 	: 'Arvon on oltava pienempi, kuin $1',
		'[min]'		: 'Arvon on oltava suurempi, kuin $1',
		'[required]'	: 'campo obligatorio'
	});
	// Continuar con la orden
	$(".envio-form").click(function(e){
		e.preventDefault();
		$("#OrderGetAddressInfoForm").submit();		
	});
	
	// Página envío
	$(".mailing-form").click(function(e){
		$("#PagosOnlineForm").submit();
	});
	
	// Seguir Comprando
	$(".seguir-comprando").click(function(e){
		BJS.post('/users/keepShopping/', null, function(redirect){
			window.location.replace(redirect);
		});
	});
	
	// Añadir al carrito un ítem
	$(".add-to-cart").click(function(e){
		bloomCart.add(this);
	});
	$('input.gift-control').live('click',function(){
		var value=$(this).is(':checked');
		if(value){
			value=1;
		}else{
			value=0;
		}
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bloomCart.updateItem(itemId,'is_gift',value);
	});
	$('.item-quantity').live('change',function(){
		var value=$(this).val();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		bloomCart.updateItem(itemId,'quantity',value);
	});
	$('.quitar a').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		console.log(itemId);
		bloomCart.remove(itemId);
	});
	$('.quitar-todos a').live('click',function(e){
		e.preventDefault();
		var itemId=$(this).parents('.shop-cart-item').attr('rel');
		console.log(itemId);
		bloomCart.removeAll(itemId);
	});
	
	$('.buscador').submit(function(e){
		e.preventDefault();
		$('#overlay2').overlay({
			mask : 'black',
			load:true,
			onBeforeLoad : function() {
			var wrap = this.getOverlay().find(".contentWrap");
			wrap.load('/products/search/'+$('#query').val());
			},
			onLoad:function(){
				refreshCufon();
			}
		}).load();
	});

});
function refreshCufon(){
	Cufon.replace('.tahoma', {
		fontFamily : 'Tahoma',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#ffaedc'}

	});
	Cufon.replace('.japan', {
		fontFamily : 'Japan',
		trim : "simple"
	});

	Cufon.replace('.twCenMt', {
		fontFamily : 'TwCenMt',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#00CFB5'}
	});
	
	Cufon.replace('.halo', {
		fontFamily : 'HaloHandLetter',
		trim : "simple"
	});	
}