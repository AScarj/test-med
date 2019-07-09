<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biomaterial".
 *
 * @property int $id
 * @property string $name_biomaterial
 * @property int $test_tube_id
 *
 * @property TestTube $testTube
 */
class Biomaterial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'biomaterial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_biomaterial', 'test_tube_id'], 'required'],
            [['test_tube_id'], 'default', 'value' => null],
            [['test_tube_id'], 'integer'],
            [['name_biomaterial'], 'string', 'max' => 254],
            [['test_tube_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestTube::className(), 'targetAttribute' => ['test_tube_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_biomaterial' => 'Название биоматериала',
            'test_tube_id' => 'Пробирка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestTube()
    {
        return $this->hasOne(TestTube::className(), ['id' => 'test_tube_id']);
    }
}
