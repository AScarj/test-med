<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string $full_name
 * @property int $passport
 * @property int $gender
 * @property string $date_birth
 *
 * @property Order[] $orders
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @var array
     */
    const GENDER_MAN   = 0;
    const GENDER_WOMAN = 1;
    const GENDER_OTHER = 2;

    /**
     * @return array genders list
     */
    public static function genders()
    {
        return [
            self::GENDER_MAN => 'Мужчина',
            self::GENDER_WOMAN => 'Женщина',
            self::GENDER_OTHER => 'Прочий',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'passport', 'gender', 'date_birth'], 'required'],
            [['passport', 'gender'], 'default', 'value' => null],
            [['passport', 'gender'], 'integer'],
            [['date_birth'], 'safe'],
            [['full_name'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'full_name' => 'Ф.И.О',
            'passport' => 'Серия и номер пасспорта',
            'gender' => 'Пол',
            'date_birth' => 'Дата рождения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['patient_id' => 'id']);
    }
}
