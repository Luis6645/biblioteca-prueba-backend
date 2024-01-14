<?php

namespace app\controllers;

use app\common\yii\BaseController;
use app\models\Autor;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\BadRequestHttpException;

/**
 * Controlador AutorController
 *
 * Este controlador maneja las operaciones CRUD para la entidad Autor.
 *
 * @package app\controllers
 */
class AutorController extends BaseController
{
    /**
     * @var string La clase del modelo que este controlador maneja.
     */
    public $modelClass = 'app\models\Autor';

    /**
     * Muestra una lista de autores con información simplificada y la lista de libros asociados a cada autor.
     *
     * @return array La lista de autores con información y la lista de libros asociados.
     * @throws NotFoundHttpException Si hay un error al obtener la lista de autores.
     */
    public function actionIndex()
    {
        try {
            // Obtener todos los autores
            $autores = Autor::find()->all();

            // Crear una respuesta personalizada con la lista de autores y sus libros
            $response = [];
            foreach ($autores as $autor) {
                // Cargar la relación 'libros' junto con el modelo 'Autor'
                $autor->populateRelation('libros', $autor->getLibros()->all());

                // Agregar información del autor y sus libros a la respuesta
                $response[] = [
                    'id' => $autor->_id,
                    'nombre' => $autor->nombre,
                    'fecha_nacimiento' => $autor->fecha_nacimiento,
                    'nacionalidad' => $autor->nacionalidad,
                    'libros' => $autor->libros,
                ];
            }

            return $response;
        } catch (\Exception $e) {
            throw new NotFoundHttpException("Error al obtener la lista de autores.", 0, $e);
        }
    }


    /**
     * Muestra los detalles de un autor específico.
     *
     * @param int $id El ID del autor.
     * @return mixed El autor encontrado con detalles de sus libros.
     * @throws NotFoundHttpException Si el autor no se encuentra.
     */
    public function actionView($id)
    {
        try {
            $autor = Autor::findOne($id);

            if (!$autor) {
                throw new NotFoundHttpException("Autor con ID $id no encontrado.");
            }

            // Cargar la relación 'libros' junto con el modelo 'Autor'
            $autor->populateRelation('libros', $autor->getLibros()->all());

            // Crear una respuesta personalizada
            $response = [
                'id' => $autor->_id,
                'nombre' => $autor->nombre,
                'fecha_nacimiento' => $autor->fecha_nacimiento,
                'nacionalidad' => $autor->nacionalidad,
                'libros' => $autor->libros,
            ];

            return $response;
        } catch (\Exception $e) {
            throw new NotFoundHttpException("Error al obtener el autor.", 0, $e);
        }
    }

    /**
     * Crea un nuevo autor con los datos proporcionados.
     *
     * @return mixed El nuevo autor creado.
     * @throws ServerErrorHttpException Si hay un error al crear el autor.
     */
    public function actionCreate()
    {
        try {
            $rawData = Yii::$app->request->getRawBody();
            $data = json_decode($rawData, true);

            // Llama a un método estático en el modelo para crear un autor.
            $autor = Autor::createAutor($data);
            return $autor;
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al crear el autor.", 0, $e);
        }
    }

    /**
     * Actualiza los datos de un autor existente.
     *
     * @param int $id El ID del autor a actualizar.
     * @return mixed El autor actualizado.
     * @throws ServerErrorHttpException Si hay un error al actualizar el autor.
     */
    public function actionUpdate($id)
    {
        try {
            $rawData = Yii::$app->request->getRawBody();
            $data = json_decode($rawData, true);

            // Llama a un método estático en el modelo para actualizar un autor.
            return Autor::updateAutor($id, $data);
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al actualizar el autor.", 0, $e);
        }
    }

    /**
     * Elimina un autor específico.
     *
     * @param int $id El ID del autor a eliminar.
     * @return array El resultado de la operación de eliminación.
     * @throws NotFoundHttpException Si el libro no se encuentra.
     * @throws BadRequestHttpException Si la solicitud es incorrecta.
     * @throws ServerErrorHttpException Si ocurre un error durante la eliminación.
     */
    public function actionDelete($id)
    {
        try {
            // Llama a un método estático en el modelo para eliminar un autor.
            $result = Autor::deleteAutor($id);
            return ['success' => $result];
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al eliminar el autor.", 0, $e);
        }
    }
}
