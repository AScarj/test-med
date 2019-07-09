<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $name_service
 * @property int $biomaterial_id
 * @property string $price
 *
 * @property Order[] $orders
 * @property ServiceTestTube[] $serviceTestTubes
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_service'], 'required'],
            [['biomaterial_id'], 'default', 'value' => null],
            [['biomaterial_id'], 'integer'],
            [['price'], 'number'],
            [['name_service'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_service' => 'Название услуги',
            'biomaterial_id' => 'Биоматериал',
            'serviceTestTubes' => 'Пробирка',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTestTubes()
    {
        return $this->hasMany(ServiceTestTube::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiomaterial()
    {
        return $this->hasOne(Biomaterial::className(), ['id' => 'biomaterial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestTubes()
    {
        return $this->hasMany(TestTube::className(), ['id' => 'test_tube'])->viaTable('service_test_tube', ['service_id' => 'id']);
    }
}
