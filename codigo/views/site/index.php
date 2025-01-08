<?php

/** @var yii\web\View $this */

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index">

    
        <!-- CONTENEDOR LADO IZQUIERDO -->
        <div class = "contenedor-categorias">
            
            <aside class ="categorias">
                <p><a style="color: #000;" href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>"><strong>Categorías</strong></a></p>
                <ul>
                    <li><a href="#">Tecnología</a></li>
                    <li><a href="#">Hogar</a></li>
                    <li><a href="#">Moda</a></li>
                    <li><a href="#">Deportes</a></li>
                    <li><a href="#">Juguetes</a></li>
                    <li><a href="#">Automóvil</a></li>
                    <li><a href="#">Más...</a></li>
                </ul>
            </aside>

        </div>
        

        <!-- CONTENEDOR LADO DERECHO -->
        <div id = "contenedor-con-ofertas">

            <div class="jumbotron text-center bg-transparent">
                
                <h1 class="texto-inicial">Ofertas exclusivas que no querrás perderte</h1>
                <p style ="font-size: 20px; font-weight: bold;">Aprovecha los mejores precios del mercado</p>
            </div>
    
            <!--
            <div class="container">
                <div class="section">
                  <div class="row">
                    <div class="col s12 m4">
                      <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2> 
                        <h5 class="center">Acelera el desarrollo</h5>
                        <p class="light">Hemos creado un diseño predeterminado que incorpora nuestros componentes personalizados, con animaciones y transiciones mizadas para una experiencia fluida.</p>
                      </div>
                    </div>
                    <div class="col s12 m4">
                      <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                        <h5 class="center">Enfocado en la experiencia del usuario</h5>
                        <p class="light">Al usar principios de Material Design, creamos un sistema responsive unificado para una mejor experiencia en todas las aformas.</p >
                      </div>
                    </div>
                    <div class="col s12 m4">
                      <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                        <h5 class="center">Fácil de usar</h5>
                        <p class="light">Ofrecemos documentación detallada y ejemplos de código para que los nuevos usuarios puedan comenzar rápidamente.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>
            </div>-->
        </div>       
</div>