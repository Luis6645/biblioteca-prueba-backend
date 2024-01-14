<?php

namespace app\models;

use app\services\AuthService;
use yii\base\BaseObject;
use yii\web\IdentityInterface;

/**
 * Modelo AuthToken para la autenticación mediante tokens.
 */
class AuthToken extends BaseObject implements IdentityInterface
{
    public $id;
    public $accessToken;

    /**
     * Busca la identidad basada en el ID.
     *
     * @param int|string $id El ID del usuario (no utilizado en este caso).
     * @return null No se utiliza en este contexto.
     */
    public static function findIdentity($id)
    {
        return null;
    }

    /**
     * Busca la identidad basada en el token de acceso.
     *
     * @param string $token El token de acceso a ser verificado.
     * @param string|null $type No utilizado en este caso.
     * @return static|null La identidad del usuario o null si el token no es válido.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $decoded = AuthService::decodificarToken($token);

            if (
                isset($decoded['tiempoDuracion']) && $decoded['tiempoDuracion'] >= time() &&
                isset($decoded['jwt']) && $decoded['jwt'] === AuthService::generateTokenJWT() &&
                isset($decoded['key']) && $decoded['key'] === $_ENV['KEY_JWT'] &&
                isset($decoded['random']) && $decoded['random'] >= 1 && $decoded['random'] <= 50
            ) {
                return new static(['id' => null, 'accessToken' => $token]);
            }

            // El token ha expirado o no es válido
            return null;
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            // La firma del token no coincide, el token no es válido
            return null;
        } catch (\Exception $e) {
            // Otro tipo de error al decodificar el token
            return null;
        }
    }

    /**
     * Devuelve el ID del usuario.
     *
     * @return int|string El ID del usuario.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Devuelve la clave de autenticación (no utilizada en este caso).
     *
     * @return null No se utiliza en este contexto.
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * Valida la clave de autenticación (no utilizada en este caso).
     *
     * @param string $authKey La clave de autenticación a ser validada.
     * @return bool Siempre retorna true en este caso.
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
}
