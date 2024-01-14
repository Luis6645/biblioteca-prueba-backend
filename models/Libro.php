<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

/**
 * Clase Libro
 *
 * Esta clase representa el modelo para la entidad Libro.
 * Extiende la clase ActiveRecord de Yii2 para interactuar con MongoDB.
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $titulo
 * @property \MongoDB\BSON\ObjectID|string $autor_id
 * @property int $ano_publicacion
 * @property string $genero
 * @property string $descripcion
 * @property Autor $autor Relación con el modelo Autor.
 *
 * @package app\models
 */
class Libro extends ActiveRecord
{
    /**
     * Devuelve el nombre de la colección de MongoDB asociada a este modelo.
     *
     * @return string El nombre de la colección.
     */
    public static function collectionName()
    {
        return 'libros';
    }

    /**
     * Define las reglas de validación para los atributos del modelo.
     *
     * @return array Reglas de validación.
     */
    public function rules()
    {
        return [
            [['titulo', 'autor_id', 'ano_publicacion', 'genero', 'descripcion'], 'required'],
            [['ano_publicacion'], 'match', 'pattern' => '/^\d{4}$/'],
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
            'titulo',
            'autor_id',
            'ano_publicacion',
            'genero',
            'descripcion',
        ];
    }

    /**
     * Convierte la cadena 'autor_id' a un ObjectID antes de la validación.
     *
     * @return bool Siempre devuelve verdadero.
     */
    public function beforeValidate()
    {
        // Convertir cadena a ObjectID si es necesario
        $this->autor_id = new \MongoDB\BSON\ObjectID($this->autor_id);

        return parent::beforeValidate();
    }

    /**
     * Establece la relación de uno a uno con la entidad Autor.
     *
     * @return \yii\mongodb\ActiveQuery La relación con el autor asociado.
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::class, ['_id' => 'autor_id']);
    }

    /**
     * Maneja el error durante la creación o actualización del libro.
     *
     * @param \yii\mongodb\ActiveRecord $model El modelo que causó el error.
     * @param string $action La acción que se intentó realizar (crear o actualizar).
     * @return array Mensaje de error y detalles adicionales.
     */
    private static function handleError($model, $action)
    {
        $errors = $model->errors;
        return ['error' => "Error al $action el libro", 'messages' => $errors];
    }

    /**
     * Crea un nuevo libro con los atributos proporcionados.
     *
     * @param array $attributes Atributos del nuevo libro.
     * @return Libro|array El nuevo libro creado o mensaje de error.
     */
    public static function createLibro($attributes)
    {
        // Validar que el autor exista antes de crear el libro
        $autorId = isset($attributes['autor_id']) ? $attributes['autor_id'] : null;

        if (!Autor::findOne($autorId)) {
            return ['error' => 'El autor especificado no existe.'];
        }

        $libro = new Libro($attributes);
        if ($libro->validate() && $libro->save()) {
            return $libro;
        } else {
            return self::handleError($libro, 'crear');
        }
    }

    /**
     * Actualiza los atributos de un libro existente.
     *
     * @param string $id El ID del libro a actualizar.
     * @param array $attributes Nuevos atributos para el libro.
     * @return Libro|array El libro actualizado o mensaje de error.
     */
    public static function updateLibro($id, $attributes)
    {
        // Validar que el autor exista antes de actualizar el libro
        $autorId = isset($attributes['autor_id']) ? $attributes['autor_id'] : null;
        if (!Autor::findOne($autorId)) {
            return ['error' => 'El autor especificado no existe.'];
        }

        $libro = Libro::findOne($id);
        if ($libro) {
            $libro->setAttributes($attributes);
            if ($libro->save()) {
                return $libro;
            } else {
                return self::handleError($libro, 'actualizar');
            }
        }
        return null;
    }

    /**
     * Elimina un libro específico.
     *
     * @param string $id El ID del libro a eliminar.
     * @return bool Indica si la eliminación fue exitosa.
     */
    public static function deleteLibro($id)
    {
        $libro = Libro::findOne($id);
        if ($libro) {
            $libro->delete();
            return true;
        }
        return false;
    }
}
