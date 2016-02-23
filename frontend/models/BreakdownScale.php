<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "breakdown_scales".
 *
 * @property integer $id
 * @property integer $breakdown_color_id
 * @property integer $breakdown_id
 * @property string $size
 * @property string $code
 * @property integer $scale
 */
class BreakdownScale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'breakdown_scales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['breakdown_color_id', 'breakdown_id', 'scale'], 'integer'],
            [['size', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'breakdown_color_id' => Yii::t('app', 'Breakdown Color ID'),
            'breakdown_id' => Yii::t('app', 'Breakdown ID'),
            'size' => Yii::t('app', 'Size'),
            'code' => Yii::t('app', 'Code'),
            'scale' => Yii::t('app', 'Scale'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreakdownColor()
    {
        return $this->hasOne(BreakdownColors::className(), ['id' => 'breakdown_color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreakdown()
    {
        return $this->hasOne(Breakdowns::className(), ['id' => 'breakdown_id']);
    }
    
    public function getDetails()
    {
      return $this->hasMany(BreakdownDetail::className(), ['breakdown_color_id' => 'id']);
    }
    
    public function getScale()
    {
      return $this->hasMany(BreakdownScale::className(), ['breakdown_color_id' => 'id']);
    }
}
