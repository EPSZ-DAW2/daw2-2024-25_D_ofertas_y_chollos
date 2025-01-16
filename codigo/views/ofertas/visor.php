<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $recientes array */
/* @var $destacados array */
/* @var $patrocinados array */
/* @var $personalizados array */
/* @var $paginationRecientes yii\data\Pagination */
/* @var $paginationDestacados yii\data\Pagination */
/* @var $paginationPatrocinados yii\data\Pagination */
/* @var $paginationPersonalizados yii\data\Pagination */

$this->title = 'Visor de Ofertas';

$this->registerCss("
    /* Estilos generales para la página */
    .visor-container {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    .visor-title {
        font-size: 32px;
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    /* Estilos para las secciones */
    .section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 24px;
        color: #444;
        text-transform: uppercase;
        margin-bottom: 15px;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }

    /* Estilos para las ofertas */
    .ofertas-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .oferta-card {
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        width: 300px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .oferta-card:hover {
        transform: scale(1.05);
    }

    /* Estilos para el título y la descripción de cada oferta */
    .oferta-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .oferta-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .oferta-fecha {
        font-size: 13px;
        color: #999;
        margin-bottom: 15px;
    }

    .oferta-link {
        display: inline-block;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #007bff;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .oferta-link:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Estilos de paginación (si es necesario) */
    .pagination {
        text-align: center;
        margin-top: 30px;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 5px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }
");

?>

<div class="visor-container">
    <h1 class="visor-title">Visor de Ofertas</h1>

    <div class="section">
        <h2 class="section-title">Ofertas Recientes</h2>
        <div class="ofertas-list">
            <?php foreach ($recientes as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
   
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Destacadas</h2>
        <div class="ofertas-list">
            <?php foreach ($destacados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Patrocinadas</h2>
        <div class="ofertas-list">
            <?php foreach ($patrocinados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Personalizadas</h2>
        <div class="ofertas-list">
            <?php foreach ($personalizados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
