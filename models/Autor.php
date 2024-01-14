<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

/**
 * Clase Autor
 *
 * Esta clase representa el modelo para la entidad Autor.
 * Extiende la clase ActiveRecord de Yii2 para interactuar con MongoDB.
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $nombre
 * @property string $fecha_nacimiento
 * @property string $nacionalidad
 *
 * @package app\models
 */
class Autor extends ActiveRecord
{
    /**
     * Devuelve el nombre de la colección de MongoDB asociada a este modelo.
     *
     * @return string El nombre de la colección.
     */
    public static function collectionName()
    {
        return 'autores';
    }

    /**
     * Define las reglas de validación para los atributos del modelo.
     *
     * @return array Reglas de validación.
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_nacimiento', 'nacionalidad'], 'required'],
        ];
    }

    /**
     * Devuelve los atributos de este modelo.
     *
     * @return array Los atributos del modelo.
     */
    public function attributes()
    {
        return [
            '_id', // MongoDB primary key
            'nombre',
            'fecha_nacimiento',
            'nacionalidad',
        ];
    }

    /**
     * Establece la relación de uno a muchos con la entidad Libro.
     *
     * @return \yii\mongodb\ActiveQuery La relación con los libros asociados.
     */
    public function getLibros()
    {
        return $this->hasMany(Libro::class, ['autor_id' => '_id']);
    }

    /**
     * Maneja el error durante la creación o actualización del autor.
     *
     * @param \yii\mongodb\ActiveRecord $model El modelo que causó el error.
     * @param string $action La acción que se intentó realizar (crear o actualizar).
     * @return array Mensaje de error y detalles adicionales.
     */
    private static function handleError($model, $action)
    {
        $errors = $model->errors;
        return ['error' => "Error al $action el autor", 'messages' => $errors];
    }

    /**
     * Crea un nuevo autor con los atributos proporcionados.
     *
     * @param array $attributes Atributos del nuevo autor.
     * @return Autor|array El nuevo autor creado o mensaje de error.
     */
    public static function createAutor($attributes)
    {
        $autor = new Autor($attributes);

        if ($autor->validate() && $autor->save()) {
            return $autor;
        } else {
            return self::handleError($autor, 'crear');
        }
    }

    /**
     * Actualiza los atributos de un autor existente.
     *
     * @param string $id El ID del autor a actualizar.
     * @param array $attributes Nuevos atributos para el autor.
     * @return Autor|array El autor actualizado o mensaje de error.
     */
    public static function updateAutor($id, $attributes)
    {
        $autor = Autor::findOne($id);

        if ($autor) {
            $autor->setAttributes($attributes);

            if ($autor->save()) {
                return $autor;
            } else {
                return self::handleError($autor, 'actualizar');
            }
        }

        return null;
    }

    /**
     * Elimina un autor específico.
     *
     * @param string $id El ID del autor a eliminar.
     * @return bool Indica si la eliminación fue exitosa.
     */
    public static function deleteAutor($id)
    {
        $autor = Autor::findOne($id);

        if ($autor) {
            $autor->delete();
            return true;
        }

        return false;
    }
}
