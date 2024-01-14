<?php

namespace app\common\yii;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * Clase BaseController
 *
 * Esta es la clase base del controlador para APIs REST en la aplicación.
 * Extiende ActiveController de Yii2 y agrega comportamientos adicionales
 * para la negociación de contenido, autenticación usando tokens Bearer y
 * filtrado de verbos HTTP.
 *
 * @package app\common\yii
 */
class BaseController extends ActiveController
{
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    /**
     * Obtiene y devuelve los comportamientos del controlador.
     *
     * @return array Los comportamientos configurados para el controlador.
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Negociación de Contenido
        $behaviors['contentNegotiator']['formats']['application/json'] = \yii\web\Response::FORMAT_JSON;
        $behaviors['contentNegotiator']['formats']['application/xml'] = \yii\web\Response::FORMAT_XML;
        $behaviors['contentNegotiator']['formats']['text/html'] = \yii\web\Response::FORMAT_HTML;

        // Autenticación con Token Bearer
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only' => ['create', 'update', 'delete'],
        ];

        // Filtrado de Verbos HTTP
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'create' => ['POST'],
                'update' => ['PUT'],
                'delete' => ['DELETE'],
                'view' => ['GET'],
                'index' => ['GET'],
            ],
        ];

        return $behaviors;
    }
}
