<div id="header">
    <div id='right-tab'>
        <div class='wrapper'
        <a><img src="/img/carrito.png"/></a>
        <?php echo $this->element('resume-cart', array('plugin' => 'bcart'));?>
        <br>
        <a class='go-cart' href='/bcart/view'> ir al carrito</a>
        <ul class='nav-usuario'>
            <?php if ($session->read('Auth.User.id')) { ?>
            <li><a class='mi-cuenta perfil' href='/users/profile'>Mi cuenta</a></li>
            <li>/ <a class='mi-cuenta perfil' href='/users/logout'>Salir</a></li>
            <?php } else { ?>
            <li><a class='mi-cuenta login' href='/users/login'>Ingresar</a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="wrapper">
    <a class="logo_header" href="/">Excelenter</a>
    <?php echo $form->create('Product', array('controller' => 'products', 'action' => 'searchResults'))?>
    <input type="text" class="input_buscar" placeholder="Buscar..." name='data[query]'/>
    <input type="submit" class="submit" value=""/>
    </form>
    <ul id="main_menu">
        <li>
            <a href="/">INICIO</a>
        </li>
        <!--<li>
            <a href="#">PRODUCTOS</a>
            <div class="desplegable">

                <ul class="izq">
                    <li>
                        <a href="/categorias/procesadores">Procesadores</a>
                    </li>
                    <li>
                        <a href="/categorias/tarjetas-madre">Tarjeras madre</a>
                    </li>
                    <li>
                        <a href="/categorias/memorias">Memorias</a>
                    </li>
                    <li>
                        <a href="/categorias/discos-duros">Discos duros</a>
                    </li>
                    <li>
                        <a href="/categorias/tarjetas-de-video">Tarjetas de video</a>
                    </li>
                    <li>
                        <a href="/categorias/tarjetas-de-sonido">Tarjetas de sonido</a>
                    </li>
                    <li>
                        <a href="/categorias/torres">Torres</a>
                    </li>
                    <li>
                        <a href="/categorias/monitores">Monitores</a>
                    </li>
                    <li>
                        <a href="/categorias/otras-tarjetas">Otras Tarjetas</a>
                    </li>
                    <li>
                        <a href="/categorias/software">Software</a>
                    </li>
                </ul>
                <ul class="der">
                    <li>
                        <a href="/categorias/gamers">Gamers</a>
                    </li>
                    <li>
                        <a href="/categorias/computadores-de-escritorio">Computadores de escritorio</a>
                    </li>
                    <li>
                        <a href="/categorias/computadores-portatiles">Computadores portátiles</a>
                    </li>
                    <li>
                        <a href="/categorias/accesorios">Accesorios</a>
                    </li>
                    <li>
                        <a href="/categorias/impresoras">Impresoras</a>
                    </li>
                    <li>
                        <a href="/categorias/dispositivos-usb">Dispositivos usb</a>
                    </li>
                    <li>
                        <a href="/categorias/cables">Cables</a>
                    </li>
                    <li>
                        <a href="/categorias/periféricos">Periféricos</a>
                    </li>
                    <li>
                        <a href="/categorias/camaras-web-y-digitales">Camaras web y digitales</a>
                    </li>
                </ul>
                <div style="clear: both"></div>
            </div>
        </li>-->
        <!--<li>
            <a href="/mi-pc">ARMA TU PC</a>
        </li>-->
        <li>
            <a href="/pages/empresa">EMPRESA</a>
        </li>
        <li class="ultimo">
            <a href="/contacto">CONTÁCTO</a>
        </li>
        <div style="clear: both"></div>
    </ul>
</div>
</div>