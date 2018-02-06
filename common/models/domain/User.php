<?php

namespace common\models\domain;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $status
 * @property string $root
 * @property string $gender
 * @property integer $language_id
 * @property integer $logged_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password
 * @property string $repeat_password
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property array $_groups
 */
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const ROOT_YES = 'yes';
    const ROOT_NO = 'no';

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * @var
     */
    public $_groups;

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
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'auth_key' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString()
            ],
            'password_reset_token' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'password_reset_token'
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generateRandomString(40);
                }
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'avatar',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url',
                'filesStorage' => 'userProfileFileStorage',
            ]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username', 'email', 'password', 'gender', 'status', 'root', 'repeat_password', 'language_id', '_groups'];
        $scenarios['update'] = ['username', 'email', 'password', 'gender', 'status', 'root', 'repeat_password', 'language_id', '_groups'];
        $scenarios['update-profile'] = ['username', 'email', 'password', 'gender', 'repeat_password', 'avatar'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'filter', 'filter' => '\yii\helpers\Html::encode'],
            ['username', 'required'],
            ['username', 'string', 'min' => 3, 'max' => 50],
            ['username', 'unique',
                'targetClass' => '\common\models\domain\User',
                'message' => Yii::t('common', 'User.UsernameTaken'),
                'filter' =>
                    function ($query) {
                        $query->andWhere(['not', ['id' => $this->id]]);
                    }
            ],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['password', 'repeat_Password'], 'string', 'on' => ['create']],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password', 'on' => ['create']],
            [['password', 'repeat_password'], 'required', 'on' => ['create']],
            [['password_reset_token'], 'unique'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'string', 'min' => 3, 'max' => 255],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => '\common\models\domain\User',
                'message' => Yii::t('common', 'User.EmailTaken'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => $this->id]]);
                }
            ],
            ['gender', 'default', 'value' => null],
            ['gender', 'in', 'range' => [User::GENDER_MALE, User::GENDER_FEMALE]],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            ['root', 'default', 'value' => self::ROOT_NO],
            ['root', 'in', 'range' => [self::ROOT_YES, self::ROOT_NO]],
            [['language_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
            ['_groups', 'each', 'rule' => ['integer']],
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
            'username' => Yii::t('common', 'Model.Username'),
            'auth_key' => Yii::t('common', 'Model.AuthKey'),
            'password_hash' => Yii::t('common', 'Model.PasswordHash'),
            'password_reset_token' => Yii::t('common', 'Model.PasswordResetToken'),
            'email' => Yii::t('common', 'Model.Email'),
            'gender' => Yii::t('common', 'Model.Gender'),
            'status' => Yii::t('common', 'Model.Status'),
            'language_id' => Yii::t('common', 'Model.LanguageId'),
            'root' => Yii::t('common', 'Model.Root'),
            'logged_at' => Yii::t('common', 'Model.LoggedAt'),
            'avatar' => Yii::t('common', 'Model.Avatar'),
            'avatar_path' => Yii::t('common', 'Model.Avatar'),
            'avatar_url' => Yii::t('common', 'Model.Avatar'),
            'password' => Yii::t('common', 'Model.Password'),
            'repeat_password' => Yii::t('common', 'Model.RepeatPassword'),

            'id' => Yii::t('common', 'Model.Id'),
            'created_at' => Yii::t('common', 'Model.CreatedAt'),
            'updated_at' => Yii::t('common', 'Model.UpdatedAt'),
        ];
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
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
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
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
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
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
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
        if ($this->username) {
            return $this->username;
        }

        return $this->email;
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
     * @return array
     */
    public static function getRootList()
    {
        return [
            self::ROOT_YES => Yii::t('common', 'Root.Yes'),
            self::ROOT_NO => Yii::t('common', 'Root.No'),
        ];
    }

    /**
     * Return the current user is root or no
     * @return boolean
     */
    public function isRoot()
    {
        return ($this->root == self::ROOT_YES);
    }

    /**
     * Return related language
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        // delete and save all new permissions
        $allowedScenario = ['create', 'update'];

        if (in_array($this->getScenario(), $allowedScenario)) {
            UserGroup::deleteAll(['user_id' => $this->id]);

            if ($this->_groups) {
                foreach ($this->_groups as $group) {
                    $groupPermission = new UserGroup();
                    $groupPermission->user_id = $this->id;
                    $groupPermission->group_id = $group;
                    $groupPermission->save();
                }
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        UserGroup::deleteAll(['user_id' => $this->id]);

        return parent::beforeDelete();
    }

    /**
     * Return related permissions
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])->viaTable(UserGroup::tableName(), ['user_id' => 'id']);
    }

    /**
     * Check if user has access to permission
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        $query = '
        SELECT COUNT(*)
        FROM user u
        INNER JOIN `user_group` ug ON ug.user_id = u.id
        INNER JOIN `group` g ON g.id = ug.group_id
        INNER JOIN `group_permission` gp ON gp.group_id = ug.group_id
        INNER JOIN `permission` p ON p.id = gp.permission_id
        WHERE
        u.id = :user_id
        AND p.action = :action
        AND g.status = :group_status
        AND p.status = :permission_status
        ';

        $count = (int)Yii::$app->db->createCommand($query, [
            'user_id' => Yii::$app->user->id,
            'action' => $permission,
            'group_status' => Group::STATUS_ACTIVE,
            'permission_status' => Permission::STATUS_ACTIVE,
        ])->queryScalar();

        return ($count > 0);
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

}
