<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Ofertas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #343a40;
            padding: 0.5rem 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }

        nav a:hover {
            background-color: #495057;
        }

        .container {
            display: flex;
            margin: 1rem;
        }

        .sidebar {
            flex: 1;
            max-width: 250px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 1rem;
            margin-right: 1rem;
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 0.5rem 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .content {
            flex: 3;
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 1rem;
        }

        .highlight {
            text-align: center;
            background-color: #e9ecef;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .highlight h2 {
            color: #007bff;
        }

        .offers {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
        }

        .offer {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1rem;
            width: 30%;
            text-align: center;
        }

        .offer button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .offer button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
            text-align: center;
            margin-top: 1rem;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .footer-links {
            margin: 1rem 0;
        }

        .etiquetas-widget {
            background-color: #f1f1f1;
            border-bottom: 1px solid #ccc;
            text-align: center;
            padding: 10px;
        }

        .etiqueta-link {
            margin: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
            display: inline-block;
        }

        .etiqueta-link:hover {
            background-color: #0056b3;
        }

        .sin-estilo {
            text-decoration: none;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
        }

    </style>
</head>
<?php

use yii\helpers\Url;
use app\views\etiquetas\EtiquetasWidget; ?>

<body>
    <header>
        <h1>Bienvenido a <a href="/index.php" class="sin-estilo">Ofertas y Chollos</a></h1>
    </header>

    <div class="navbar">
     <?= EtiquetasWidget::widget() ?>
    </div>

    <nav>
        <a href="/test/index">Test</a>
        <a href="#">Ofertas</a>
        <a href="#">Anuncios</a>
        <a href="#">Categorías</a>
        <a href="#">Mi Perfil</a>
        <a href="#">Logout</a>
        <a href="/usuarios/registro">Registro</a>
        <a href="/usuarios/ficha-usuarios-admin">Gestion Usuarios</a>


    </nav>

    <div class="container">
        <?= $content ?>
        <aside class="sidebar">
            <h3>Categorías</h3>
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

        <main class="content">
            <div class="highlight">
                <h2>Ofertas exclusivas que no querrás perderte</h2>
                <p>Aprovecha los mejores precios del mercado.</p>
            </div>

            <div class="offers">
                <div class="offer">
                    <h3>Oferta 1</h3>
                    <p>Descripción breve de la oferta 1.</p>
                    <button>Ver más</button>
                </div>
                <div class="offer">
                    <h3>Oferta 2</h3>
                    <p>Descripción breve de la oferta 2.</p>
                    <button>Ver más</button>
                </div>
                <div class="offer">
                    <h3>Oferta 3</h3>
                    <p>Descripción breve de la oferta 3.</p>
                    <button>Ver más</button>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div class="footer-links">
            <a href="#">Política de Privacidad</a> |
            <a href="#">Términos y Condiciones</a> |
            <a href="#">Contacto</a>
        </div>
        <p>© 2025 Ofertas y Chollos. Todos los derechos reservados.</p>
    </footer>
</body>

</html>