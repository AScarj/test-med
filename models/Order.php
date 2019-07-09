<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $patient_id
 * @property int $service_id
 * @property string $order_date
 *
 * @property Patient $patient
 * @property OrderService $services
 */
class Order extends \yii\db\ActiveRecord
{

    public $services;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_id', 'services'], 'required'],
            [['patient_id'], 'default', 'value' => null],
            [['order_date'], 'default', 'value' => date("Y-m-d")],
            [['patient_id'], 'integer'],
            [['order_date', 'services'], 'safe'],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_id' => 'Пациент',
            'services' => 'Услуга',
            'order_date' => 'Дата оказания услуги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesOrder()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])->viaTable('order_service', ['order_id' => 'id']);
    }


    /**
     * Сохранение (добавление) услуг в отдельной таблице
     * Сохранение происходит после сохранения заказа
     */
    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        if(isset($this->services[0]) && is_array($this->services)){                                                     //Если переменная существует и является массивом
            if (OrderService::find()->where(['order_id' => $this->id])->one() !== null) {                               //Если есть хоть одна запись с id записи
                OrderService::deleteAll(['order_id' => $this->id]);                                                     //Удалить все записи у которых system_id равна id записи
            }
            foreach ($this->services as $service) {                                                                     //Перебираем весь массив владельцев, которые должны быть присвоены системе
                $model = new OrderService();                                                                            //Создаем новую модель владельца системы
                $model->order_id = $this->id;                                                                           //Добавляем id системы (объекта)
                $model->service_id = $service;                                                                          //Добавляем id пользователя (владельца)
                $model->save();                                                                                         //Сохраняем
            }
        }elseif(!$this->services && $this->services == null){                                                           //Если пользователь передал пустую строку с владельцами, удалить всех владельцев у системы
            OrderService::deleteAll(['order_id' => $this->id]);                                                         //Удалить все записи у которых system_id равна id записи
        }

    }
}
