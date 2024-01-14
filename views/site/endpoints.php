<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Endpoints de la API';
?>

<div class="site-endpoints">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Endpoints de la API</h1>
        <p class="lead">Aquí encontrarás la lista de endpoints disponibles en la API.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div id="endpointsAccordion">

                    <!-- Token de Acceso -->
                    <div class="card">
                        <div class="card-header" id="tokenHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#tokenCollapse" aria-expanded="false" aria-controls="tokenCollapse">
                                    Token de Acceso
                                </button>
                            </h2>
                        </div>
                        <div id="tokenCollapse" class="collapse" aria-labelledby="tokenHeading" data-parent="#endpointsAccordion">
                            <div class="card-body">
                                <!-- Obtener Token -->
                                <div class="card">
                                    <div class="card-header" id="tokenGetHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#tokenGetCollapse" aria-expanded="false" aria-controls="tokenGetCollapse">
                                                Obtener Token de Acceso (GET)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="tokenGetCollapse" class="collapse" aria-labelledby="tokenGetHeading" data-parent="#tokenCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/auth/generate-token`<br>Descripción: Genera un nuevo token de acceso.<br>Autenticación: No requerida.<br>
                                                Respuesta Exitosa (Código 200): Devuelve el token de acceso en formato JSON.<br>
                                                <small>Ejemplo de uso: `GET web/auth/generate-token`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Autores -->
                    <div class="card">
                        <div class="card-header" id="autoresHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#autoresCollapse" aria-expanded="false" aria-controls="autoresCollapse">
                                    Autores
                                </button>
                            </h2>
                        </div>
                        <div id="autoresCollapse" class="collapse" aria-labelledby="autoresHeading" data-parent="#endpointsAccordion">
                            <div class="card-body">
                                <!-- GET -->
                                <div class="card">
                                    <div class="card-header" id="autoresGetHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#autoresGetCollapse" aria-expanded="false" aria-controls="autoresGetCollapse">
                                                Obtener todos los autores (GET)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="autoresGetCollapse" class="collapse" aria-labelledby="autoresGetHeading" data-parent="#autoresCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/autor`<br>Descripción: Obtiene la lista completa de autores en la biblioteca.<br>Autenticación: No requerida.<br>Respuesta Exitosa (Código 200): Devuelve la lista de autores en formato JSON.<br>
                                                <small>Ejemplo de uso: `GET web/autor`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- POST -->
                                <div class="card">
                                    <div class="card-header" id="autoresPostHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#autoresPostCollapse" aria-expanded="false" aria-controls="autoresPostCollapse">
                                                Agregar un nuevo autor (POST)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="autoresPostCollapse" class="collapse" aria-labelledby="autoresPostHeading" data-parent="#autoresCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/autor/create`<br>Descripción: Agrega un nuevo autor a la biblioteca.<br>Autenticación: Requerida (Token).<br>Datos de Solicitud: Debe incluir los datos del autor en formato JSON en el cuerpo de la solicitud.<br>
                                                Ejemplo de Cuerpo de Solicitud:
                                                ```json
                                                {
                                                "nombre": "Nombre del Autor",
                                                "fecha_nacimiento": "1990-01-01",
                                                "nacionalidad": "Nacionalidad del Autor"
                                                }
                                                ```
                                                Respuesta Exitosa (Código 201): Devuelve los detalles del autor recién creado en formato JSON.<br>Respuesta en Caso de Error (Código 422): Si hay errores de validación.<br>
                                                <small>Ejemplo de uso: `POST web/autor/create`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- PUT -->
                                <div class="card">
                                    <div class="card-header" id="autoresPutHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#autoresPutCollapse" aria-expanded="false" aria-controls="autoresPutCollapse">
                                                Actualizar un autor existente (PUT)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="autoresPutCollapse" class="collapse" aria-labelledby="autoresPutHeading" data-parent="#autoresCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/autor/update`<br>Descripción: Actualiza la información de un autor existente mediante su identificador.<br>Autenticación: Requerida (Token).<br>Datos de Solicitud: Debe incluir los datos actualizados del autor en formato JSON en el cuerpo de la solicitud.<br>
                                                Ejemplo de Cuerpo de Solicitud:
                                                ```json
                                                {
                                                "nombre": "Nuevo Nombre del Autor",
                                                "fecha_nacimiento": "1995-02-15",
                                                "nacionalidad": "Nueva Nacionalidad del Autor"
                                                }
                                                ```
                                                Respuesta Exitosa (Código 200): Devuelve los detalles del autor actualizado en formato JSON.<br>Respuesta en Caso de Error (Código 404): Si el autor no existe.<br>
                                                <small>Ejemplo de uso: `PUT web/autor/update?id=65a2fb5b8a2c00008f003f32`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- DELETE -->
                                <div class="card">
                                    <div class="card-header" id="autoresDeleteHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#autoresDeleteCollapse" aria-expanded="false" aria-controls="autoresDeleteCollapse">
                                                Eliminar un autor (DELETE)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="autoresDeleteCollapse" class="collapse" aria-labelledby="autoresDeleteHeading" data-parent="#autoresCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/autor/delete`<br>Descripción: Elimina un autor mediante su identificador.<br>Autenticación: Requerida (Token).<br>Respuesta Exitosa (Código 204): No devuelve contenido.<br>Respuesta en Caso de Error (Código 404): Si el autor no existe.<br>
                                                <small>Ejemplo de uso: `DELETE web/autor/delete?id=65a2fb5b8a2c00008f003f32`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Libros -->
                    <div class="card">
                        <div class="card-header" id="librosHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#librosCollapse" aria-expanded="false" aria-controls="librosCollapse">
                                    Libros
                                </button>
                            </h2>
                        </div>

                        <div id="librosCollapse" class="collapse" aria-labelledby="librosHeading" data-parent="#endpointsAccordion">
                            <div class="card-body">
                                <!-- GET -->
                                <div class="card">
                                    <div class="card-header" id="librosGetHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#librosGetCollapse" aria-expanded="false" aria-controls="librosGetCollapse">
                                                Obtener todos los libros (GET)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="librosGetCollapse" class="collapse" aria-labelledby="librosGetHeading" data-parent="#librosCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/libros`<br>Descripción: Obtiene la lista completa de libros en la biblioteca.<br>Autenticación: No requerida.<br>Respuesta Exitosa (Código 200): Devuelve la lista de libros en formato JSON.<br>
                                                <small>Ejemplo de uso: `GET web/libros`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- POST -->
                                <div class="card">
                                    <div class="card-header" id="librosPostHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#librosPostCollapse" aria-expanded="false" aria-controls="librosPostCollapse">
                                                Agregar un nuevo libro (POST)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="librosPostCollapse" class="collapse" aria-labelledby="librosPostHeading" data-parent="#librosCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/libro/create`<br>Descripción: Agrega un nuevo libro a la biblioteca.<br>Autenticación: Requerida (Token).<br>Datos de Solicitud: Debe incluir los datos del libro en formato JSON en el cuerpo de la solicitud.<br>
                                                Ejemplo de Cuerpo de Solicitud:
                                                ```json
                                                {
                                                "titulo": "Título del Libro",
                                                "autor_id": "65a2fb5b8a2c00008f003f32",
                                                "ano_publicacion": "2020",
                                                "genero": "Género del Libro",
                                                "descripcion": "Descripción del Libro"
                                                }
                                                ```
                                                Respuesta Exitosa (Código 201): Devuelve los detalles del libro recién creado en formato JSON.<br>Respuesta en Caso de Error (Código 422): Si hay errores de validación.<br>
                                                <small>Ejemplo de uso: `POST web/libro/create`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- PUT -->
                                <div class="card">
                                    <div class="card-header" id="librosPutHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#librosPutCollapse" aria-expanded="false" aria-controls="librosPutCollapse">
                                                Actualizar un libro existente (PUT)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="librosPutCollapse" class="collapse" aria-labelledby="librosPutHeading" data-parent="#librosCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/libro/update`<br>Descripción: Actualiza la información de un libro existente mediante su identificador.<br>Autenticación: Requerida (Token).<br>Datos de Solicitud: Debe incluir los datos actualizados del libro en formato JSON en el cuerpo de la solicitud.<br>
                                                Ejemplo de Cuerpo de Solicitud:
                                                ```json
                                                {
                                                "titulo": "Nuevo Título del Libro",
                                                "ano_publicacion": "2022",
                                                "genero": "Nuevo Género del Libro",
                                                "descripcion": "Nueva Descripción del Libro"
                                                }
                                                ```
                                                Respuesta Exitosa (Código 200): Devuelve los detalles del libro actualizado en formato JSON.<br>Respuesta en Caso de Error (Código 404): Si el libro no existe.<br>
                                                <small>Ejemplo de uso: `PUT web/libro/update?id=65a2fb5b8a2c00008f003f32`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <!-- DELETE -->
                                <div class="card">
                                    <div class="card-header" id="librosDeleteHeading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#librosDeleteCollapse" aria-expanded="false" aria-controls="librosDeleteCollapse">
                                                Eliminar un libro (DELETE)
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="librosDeleteCollapse" class="collapse" aria-labelledby="librosDeleteHeading" data-parent="#librosCollapse">
                                        <div class="card-body">
                                            <p>Ruta: `web/libro/delete`<br>Descripción: Elimina un libro mediante su identificador.<br>Autenticación: Requerida (Token).<br>Respuesta Exitosa (Código 204): No devuelve contenido.<br>Respuesta en Caso de Error (Código 404): Si el libro no existe.<br>
                                                <small>Ejemplo de uso: `DELETE web/libro/delete?id=65a2fb5b8a2c00008f003f32`</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>