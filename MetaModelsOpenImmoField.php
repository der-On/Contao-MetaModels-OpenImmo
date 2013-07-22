<?php
class MetaModelsOpenImmoField
{
    public $attribute = null;
    public $field = null;
    public $conditionField = null;
    public $conditionValue = null;
    public $defaultValue = null;

    public function __construct($attribute, $field, $defaultValue = null, $conditionField = null, $conditionValue = null)
    {
        $this->attribute = $attribute;
        $this->field = $field;
        $this->defaultValue = $defaultValue;
        $this->conditionField = $conditionField;
        $this->conditionValue = $conditionValue;
    }

    /**
     * @param null $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return null
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param null $conditionField
     */
    public function setConditionField($conditionField)
    {
        $this->conditionField = $conditionField;
    }

    /**
     * @return null
     */
    public function getConditionField()
    {
        return $this->conditionField;
    }

    /**
     * @param null $conditionValue
     */
    public function setConditionValue($conditionValue)
    {
        $this->conditionValue = $conditionValue;
    }

    /**
     * @return null
     */
    public function getConditionValue()
    {
        return $this->conditionValue;
    }

    /**
     * @param null $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return null
     */
    public function getField()
    {
        return $this->field;
    }


    /**
     * @param null $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return null
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @return bool
     */
    public function hasCondition()
    {
        return (!empty($this->conditionField));
    }

    /**
     * @return bool
     */
    public function hasDefaultValue()
    {
        return (!empty($this->defaultValue));
    }
}