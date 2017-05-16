<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $password
 *
 * @property Reservas[] $reservas
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'password'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['tipo'], 'string', 'max' => 1],
            [['tipo'], 'in', 'range' => ['U', 'A']],
            [['nombre'], 'unique'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Password',
            'tipo' => 'Tipo',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findPorNombre($nombre)
    {
        return self::findOne(['nombre' => $nombre]);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
