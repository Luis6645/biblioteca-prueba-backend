<?php

namespace app\controllers;

use app\services\AuthService;
use yii\rest\Controller;

/**
 * Controlador AuthController
 *
 * Este controlador maneja las acciones relacionadas con la autenticación.
 *
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * Genera un token de acceso y lo devuelve como respuesta.
     *
     * @return array El token de acceso generado.
     */
    public function actionGenerateToken()
    {
        // Genera un token utilizando el servicio de autenticación.
        $token = AuthService::generateToken();

        // Devuelve el token de acceso en un formato específico.
        return ['access_token' => $token];
    }
}
