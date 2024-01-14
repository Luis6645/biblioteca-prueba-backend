<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Controlador SiteController
 *
 * Este controlador maneja las acciones relacionadas con la aplicación, como la visualización de la página de inicio
 * y la información de los puntos finales (endpoints) de la API.
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Muestra la página de inicio.
     *
     * @return string La vista de la página de inicio.
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Muestra la información sobre los endpoints de la API.
     *
     * @return string La vista con la información de los endpoints.
     */
    public function actionEndpoints()
    {
        return $this->render('endpoints');
    }
}
