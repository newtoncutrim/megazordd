<?php

namespace App\Traits;

trait FormatMoneyTrait
{

    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ($this->getColumns() as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = $attributes[$key] ? number_format($this->attributes[$key], 2, ',', '.') : 0;                
            }
        }
        return $attributes;
    }

    public function getAttributeValue($key)
    {
        if (in_array($key, $this->getColumns())) {
            return $this->attributes[$key] ? number_format($this->attributes[$key], 2, ',', '.') : 0;
        }
        return parent::getAttributeValue($key);
    }

    protected function getColumns()
    {
        return property_exists($this, 'toMoney') ? $this->toMoney : [];
    }
}
