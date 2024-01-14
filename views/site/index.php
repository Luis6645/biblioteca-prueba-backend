<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Documentación de la API';
?>

<div class="site-api-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">¡Bienvenido a Mi API!</h1>
        <p class="lead">Explora e integra con nuestra poderosa API.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Comenzando</h2>
                        <p class="card-text">
                            Bienvenido a la documentación de mi API. Aquí encontrarás información detallada sobre cómo utilizar los servicios API para mejorar tu aplicación.
                        </p>
                        <?= Html::a('Explorar Endpoints de la API', ['site/endpoints'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
