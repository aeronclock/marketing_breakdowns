<?php

namespace app\models;

use Yii;

// relations
use app\modules\master\models\Customer;
use common\models\User;
use app\models\BreakdownColor;
use app\models\BreakdownScale;

// behaviors
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use yii\db\Expression;
/**
 * This is the model class for table "breakdowns".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $style
 * @property string $body
 * @property string $drawsing
 * @property string $description
 * @property string $purchase_order_number
 * @property string $delivery_date
 * @property string $receive_date_1
 * @property string $receive_date_2
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property MasterCustomers $customer
 */
class Breakdown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'breakdowns';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['delivery_date', 'receive_date_1', 'receive_date_2', 'created_at', 'updated_at'], 'safe'],
            [['style', 'body', 'drawsing', 'purchase_order_number'], 'string', 'max' => 255]
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'style' => Yii::t('app', 'Style'),
            'body' => Yii::t('app', 'Body'),
            'drawsing' => Yii::t('app', 'Drawsing'),
            'description' => Yii::t('app', 'Description'),
            'purchase_order_number' => Yii::t('app', 'Purchase Order Number'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'receive_date_1' => Yii::t('app', 'Receive Date 1'),
            'receive_date_2' => Yii::t('app', 'Receive Date 2'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    
    public function getUserCreate()
    {
      return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getUserUpdate()
    {
      return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
    public function getColors()
    {
      return $this->hasMany(BreakdownColor::className(), ['breakdown_id' => 'id']);
    }
    
    public function getScales()
    {
      return $this->hasMany(BreakdownScale::className(), ['breakdown_id' => 'id']);
    }
}
