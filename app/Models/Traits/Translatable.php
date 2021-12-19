<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'RU';

    public function __($originFieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;

        if ($locale === 'EN') {
            $fieldName = $originFieldName . '_en';
        } else {
            $fieldName = $originFieldName;
        }

        $attributes = array_keys($this->attributes);

        if (!in_array($fieldName, $attributes)) {
            throw new \LogicException('no such attribute for model ' . get_class($this));
        }

        if ($locale === 'EN' && (is_null($this->$fieldName) || empty($this->$fieldName))) { //если поле перевода пустое или равно null возвращаем значение, которе есть в БД
            return $this->$originFieldName;
        }

        return $this->$fieldName;
    }
}
