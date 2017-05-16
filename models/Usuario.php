<?php

namespace app\models;

use Yii;
use app\components\UsuariosHelper;
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
    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_FORM = 'form';

    public $passwordForm;
    public $passwordConfirmForm;
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
            [['nombre', 'tipo'], 'required'],
            [['password'], 'required', 'on' => [self::SCENARIO_DEFAULT]],
            [['nombre'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nombre'], 'unique'],
            [
                ['passwordForm', 'passwordConfirmForm'],
                'required',
                'on' => [self::SCENARIO_FORM],
            ],
            [
                ['passwordForm'],
                'compare',
                'compareAttribute' => 'passwordConfirmForm',
                'on' => [self::SCENARIO_FORM],
            ],
        ];
        if (UsuariosHelper::isAdmin()) {
            $rules = [['tipo'], 'string', 'max' => 1];
            $rules = [['tipo'], 'in', 'range' => ['U', 'A']];
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // if (!UsuariosHelper::isAdmin())
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
            'passwordForm' => 'Contraseña',
            'passwordConfirmForm' => 'Confirmar contraseña',
        ];
    }

    public function getIsAdmin()
    {
        return $this->tipo === 'A';
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($this->scenario === self::SCENARIO_FORM) {
            $this->password =
                Yii::$app->security->generatePasswordHash($this->passwordForm);
        }
        return true;
    }
}
