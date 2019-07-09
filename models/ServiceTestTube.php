<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_test_tube".
 *
 * @property int $id
 * @property int $service_id
 * @property int $test_tube
 *
 * @property Service $service
 * @property TestTube $testTube
 */
class ServiceTestTube extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_test_tube';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['service_id', 'test_tube'], 'required'],
            [['service_id', 'test_tube'], 'default', 'value' => null],
            [['service_id', 'test_tube'], 'integer'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['test_tube'], 'exist', 'skipOnError' => true, 'targetClass' => TestTube::className(), 'targetAttribute' => ['test_tube' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => '№ услуги',
            'test_tube' => 'Пробирка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestTube()
    {
        return $this->hasOne(TestTube::className(), ['id' => 'test_tube']);
    }
}
