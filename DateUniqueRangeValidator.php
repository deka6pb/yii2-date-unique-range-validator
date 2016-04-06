<?php

namespace deka6pb\validators;

use yii\db\ActiveQuery;
use yii\db\Query;
use yii\validators\Validator;

class DateUniqueRangeValidator extends Validator
{
    /**
     * @var string the name of the ActiveRecord class that should be used to validate the existence
     * of the current attribute value. It not set, it will use the ActiveRecord class of the attribute being validated.
     * @see targetAttribute
     */
    public $targetClass;
    public $to;
    public $uniqueAttributes = [];

    /**
     * @param \yii\base\Model $model
     * @param array|null $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        $targetClass = $this->targetClass === null ? get_class($model) : $this->targetClass;

        $from = $attribute;
        $to = $this->to;

        /* @var ActiveQuery $query */
        $query = $targetClass::find();
        $query = $query->andWhere(['between', $from, $model->$attribute, $model->{$to}]);
        $query = $query->orWhere(['between', $to, $model->$attribute, $model->{$to}]);

        foreach($this->uniqueAttributes AS $uniqueAttribute) {
            $query->andFilterWhere([$uniqueAttribute => $model->$uniqueAttribute]);
        }

        if ($query->exists()) {
            $this->addError($model, $attribute, 'Промежуток дат должен быть уникальным');
        }
    }
}