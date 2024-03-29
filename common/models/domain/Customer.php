<?php

namespace common\models\domain;

use common\models\query\CustomerQuery;
use Lcobucci\JWT\Signer\Hmac\Sha512;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\base\Exception;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $status
 * @property string $gender
 * @property integer $language_id
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $logged_at
 * @property integer $created_at
 * @property integer $updated_at
 */
class Customer extends ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const ID_PREFIX = 'y2aa-customer-';

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $repeat_password;

    /**
     * @var
     */
    public $avatar;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $id = (int)$token->getClaim('id', 0);
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['customer.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('common', 'Status.Active'),
            self::STATUS_INACTIVE => Yii::t('common', 'Status.Inactive'),
        ];
    }

    /**
     * @return array
     */
    public static function getGenderList()
    {
        return [
            self::GENDER_MALE => Yii::t('common', 'Gender.Male'),
            self::GENDER_FEMALE => Yii::t('common', 'Gender.Female'),
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'auth_key' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString()
            ],
            'password_reset_token' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'password_reset_token'
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generateRandomString(40);
                }
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'avatar',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url',
                'filesStorage' => 'customerProfileFileStorage',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['first_name', 'last_name', 'email', 'password', 'gender', 'status', 'repeat_password', 'language_id'];
        $scenarios['update'] = ['first_name', 'last_name', 'email', 'password', 'gender', 'status', 'repeat_password', 'language_id'];
        $scenarios['update-profile'] = ['first_name', 'last_name', 'email', 'password', 'gender', 'repeat_password', 'avatar'];
        $scenarios['check'] = ['id', 'first_name', 'last_name', 'email', 'gender', 'avatar', 'language_id', 'created_at'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['password', 'repeat_password'], 'string', 'on' => ['create']],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password', 'on' => ['create']],
            [['password', 'repeat_password'], 'required', 'on' => ['create']],
            [['password_reset_token'], 'unique'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'string', 'min' => 3, 'max' => 255],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => '\common\models\domain\Customer',
                'message' => Yii::t('common', 'Customer.EmailTaken'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => $this->id]]);
                }
            ],
            ['gender', 'default', 'value' => null],
            ['gender', 'in', 'range' => [Customer::GENDER_MALE, Customer::GENDER_FEMALE]],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['language_id'], 'integer'],
            ['language_id', 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            ['avatar', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('common', 'Model.FirstName'),
            'last_name' => Yii::t('common', 'Model.LastName'),
            'email' => Yii::t('common', 'Model.Email'),
            'auth_key' => Yii::t('common', 'Model.AuthKey'),
            'password_hash' => Yii::t('common', 'Model.PasswordHash'),
            'password_reset_token' => Yii::t('common', 'Model.PasswordResetToken'),
            'gender' => Yii::t('common', 'Model.Gender'),
            'status' => Yii::t('common', 'Model.Status'),
            'language_id' => Yii::t('common', 'Model.LanguageId'),
            'logged_at' => Yii::t('common', 'Model.LoggedAt'),
            'avatar' => Yii::t('common', 'Model.Avatar'),
            'avatar_path' => Yii::t('common', 'Model.Avatar'),
            'avatar_url' => Yii::t('common', 'Model.Avatar'),

            'id' => Yii::t('common', 'Model.Id'),
            'created_at' => Yii::t('common', 'Model.CreatedAt'),
            'updated_at' => Yii::t('common', 'Model.UpdatedAt'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return string
     */
    public function getPublicIdentity()
    {
        $fullname = $this->getFullName();

        if (empty($fullname)) {
            return $this->email;
        } else {
            return $fullname;
        }
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        return false;
    }

    /**
     * Return related language
     * @return ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id']);
    }

    /**
     * @param null $default
     * @param bool $scheme
     * @return bool|null|string
     */
    public function getAvatar($default = null, $scheme = false)
    {
        return $this->avatar_path
            ? Url::to(($this->avatar_base_url . '/' . $this->avatar_path), $scheme)
            : $default;
    }

    /**
     * Get a token for login with customer data
     * @return mixed
     */
    public function getTokenForLogin()
    {
        $signer = new Sha512();

        $token = Yii::$app->jwt->getBuilder()
            ->setIssuedAt(time())
            ->set('id', $this->id)
            ->set('name', $this->getFullName())
            ->set('first_name', $this->first_name)
            ->set('last_name', $this->last_name)
            ->set('email', $this->email)
            ->set('gender', $this->gender)
            ->set('language_id', $this->language_id)
            ->set('created_at', $this->created_at)
            ->sign($signer, Yii::$app->jwt->key)
            ->getToken();

        return $token;
    }

}
