<?php

namespace app\services;

use Firebase\JWT\JWT;

/**
 * Clase AuthService
 *
 * Esta clase proporciona servicios relacionados con la generación y decodificación de tokens.
 *
 * @package app\services
 */
class AuthService
{
    /**
     * Genera un token encriptado que contiene información específica.
     *
     * @return string El token encriptado.
     */
    public static function generateToken()
    {
        // Generar un IV (Vector de Inicialización) aleatorio
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        // Generar un token JWT (JSON Web Token)
        $jwtToken = self::generateTokenJWT();

        // Estructura del token como un array o JSON, según tus preferencias
        $tokenData = [
            'jwt' => $jwtToken,
            'key' => $_ENV['KEY_JWT'],
            'random' => random_int(1, 50),
            'tiempoDuracion' => time() + 60
        ];

        // Convertir el array a JSON
        $tokenJson = json_encode($tokenData);

        // Codificar el JSON y agregar el IV al principio
        $encodedData = openssl_encrypt($tokenJson, 'aes-256-cbc', $_ENV['SECRET_JWT'], 0, $iv);
        $encodedData = base64_encode($iv . $encodedData);

        return $encodedData;
    }

    /**
     * Genera un token JWT (JSON Web Token) utilizando un algoritmo específico.
     *
     * @return string El token JWT generado.
     */
    public static function generateTokenJWT()
    {
        $data = ['id' => $_ENV['JTI_JWT']];
        return (string) JWT::encode($data, $_ENV['SECRET_JWT'], 'HS256'); // 'HS256' es el algoritmo utilizado
    }

    /**
     * Decodifica un token encriptado y devuelve la información contenida.
     *
     * @param string $token El token encriptado a decodificar.
     * @return array|null La información contenida en el token o null si hay un error.
     */
    public static function decodificarToken($token)
    {
        // Decodificar el token base64 y extraer el IV
        $decodedToken = base64_decode($token);
        $iv = substr($decodedToken, 0, openssl_cipher_iv_length('aes-256-cbc'));

        // Extraer el dato cifrado (sin el IV)
        $encryptedData = substr($decodedToken, openssl_cipher_iv_length('aes-256-cbc'));

        try {
            // Descifrar el dato y deserializar el JSON
            $decodedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $_ENV['SECRET_JWT'], 0, $iv);
            $tokenData = json_decode($decodedData, true);

            return $tokenData;
        } catch (\Exception $e) {
            // Manejar posibles errores
            return null;
        }
    }
}
