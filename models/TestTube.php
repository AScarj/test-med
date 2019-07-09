<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_tube".
 *
 * @property int $id
 * @property string $test_tube_name
 *
 * @property Biomaterial[] $biomaterials
 * @property ServiceTestTube[] $serviceTestTubes
 */
class TestTube extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_tube';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_tube_name'], 'required'],
            [['test_tube_name'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_tube_name' => 'Название пробирки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiomaterials()
    {
        return $this->hasMany(Biomaterial::className(), ['test_tube_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTestTubes()
    {
        return $this->hasMany(ServiceTestTube::className(), ['test_tube' => 'id']);
    }
}
