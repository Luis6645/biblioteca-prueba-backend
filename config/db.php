<?php

return [
    /**
     * Configuración de la conexión a la base de datos MongoDB.
     */
    'class' => \yii\mongodb\Connection::class,

    /**
     * La cadena de conexión DSN para la base de datos MongoDB.
     * Se obtiene de la variable de entorno 'URL_BD'.
     * 
     * @var string
     */
    'dsn' => $_ENV['URL_BD'],

    /**
     * El nombre predeterminado de la base de datos.
     * Se obtiene de la variable de entorno 'NAME_BD'.
     * 
     * @var string
     */
    'defaultDatabaseName' => $_ENV['NAME_BD'],
];
