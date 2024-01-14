<?php

namespace app\controllers;

use app\common\yii\BaseController;
use app\models\Libro;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\BadRequestHttpException;

/**
 * Controlador LibroController
 *
 * Este controlador maneja las operaciones CRUD para la entidad Libro.
 *
 * @package app\controllers
 */
class LibroController extends BaseController
{
    /**
     * @var string La clase del modelo que este controlador maneja.
     */
    public $modelClass = 'app\models\Libro';

    /**
     * Muestra todos los libros.
     *
     * @return mixed Los libros encontrados.
     */
    public function actionIndex()
    {
        // Realizar una consulta que incluya la relación con el autor
        $libros = Libro::find()->with('autor')->all();

        // Procesar los datos para la respuesta
        $data = [];
        foreach ($libros as $libro) {
            $data[] = [
                'titulo' => $libro->titulo,
                'autor' => $libro->autor ? $libro->autor->nombre : null,
                'autor_id' => $libro->autor_id,
                'ano_publicacion' => $libro->ano_publicacion,
                'genero' => $libro->genero,
                'descripcion' => $libro->descripcion,
            ];
        }

        return $data;
    }

    /**
     * Muestra los detalles de un libro específico.
     *
     * @param int $id El ID del libro.
     * @return mixed El libro encontrado.
     * @throws NotFoundHttpException Si el libro no se encuentra.
     */
    public function actionView($id)
    {
        try {
            // Realizar una consulta que incluya la relación con el autor
            $libro = Libro::find()->with('autor')->where(['_id' => $id])->one();

            if (!$libro) {
                throw new NotFoundHttpException("Libro con ID $id no encontrado.");
            }

            // Devolver los datos deseados (por ejemplo, el nombre del autor)
            $data = [
                'titulo' => $libro->titulo,
                'autor' => $libro->autor ? $libro->autor->nombre : null,
                'autor_id' => $libro->autor_id,
                'ano_publicacion' => $libro->ano_publicacion,
                'genero' => $libro->genero,
                'descripcion' => $libro->descripcion,
            ];

            return $data;
        } catch (\Exception $e) {
            throw new NotFoundHttpException("Libro no encontrado.");
        }
    }

    /**
     * Crea un nuevo libro con los datos proporcionados.
     *
     * @return mixed El nuevo libro creado.
     * @throws ServerErrorHttpException Si ocurre un error durante la creación.
     */
    public function actionCreate()
    {
        try {
            $rawData = Yii::$app->request->getRawBody();
            $data = json_decode($rawData, true);

            return Libro::createLibro($data);
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al actualizar el autor.", 0, $e);
        }
    }

    /**
     * Actualiza los datos de un libro existente.
     *
     * @param int $id El ID del libro a actualizar.
     * @return mixed El libro actualizado.
     * @throws ServerErrorHttpException Si ocurre un error durante la actualización.
     */
    public function actionUpdate($id)
    {
        try {
            $rawData = Yii::$app->request->getRawBody();
            $data = json_decode($rawData, true);

            // Llama a un método estático en el modelo para actualizar un autor.
            return Libro::updateLibro($id, $data);
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al actualizar el autor.", 0, $e);
        }
    }

    /**
     * Elimina un libro específico.
     *
     * @param int $id El ID del libro a eliminar.
     * @return array El resultado de la operación de eliminación.
     * @throws NotFoundHttpException Si el libro no se encuentra.
     * @throws BadRequestHttpException Si la solicitud es incorrecta.
     * @throws ServerErrorHttpException Si ocurre un error durante la eliminación.
     */
    public function actionDelete($id)
    {
        try {
            $result = Libro::deleteLibro($id);

            return ['success' => $result];
        } catch (BadRequestHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Error al eliminar el libro.");
        }
    }
}
