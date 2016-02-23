<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "master_customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $contact_person_name
 * @property string $contact_person_mail
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'contact_person_name', 'contact_person_mail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'contact_person_name' => 'Contact Person Name',
            'contact_person_mail' => 'Contact Person Mail',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
