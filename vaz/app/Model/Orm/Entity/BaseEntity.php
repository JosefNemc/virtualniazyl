<?php

namespace App\Entity;

use App\Entity\BaseEntity as CoreBaseEntity;
use Doctrine\Common\Collections\Collection;
use Nette\Utils\Strings;


abstract class BaseEntity
{

    private $reflection;

    public function getData()
    {
        $data = [];
        foreach ($this->reflection->getProperties() as $property) {
            list($class, $propName) = explode('::$', $property);
            if (Strings::startsWith($class,'Kdyby\GeneratedProxy\__CG__')) {
                continue;
            }
            $data[$propName] = $this->{$propName};
        }
        return $data;
    }

    public function getNonobjectData() {
        $data = $this->getData();
        foreach ($data as $key => &$value) {
            if ($value instanceof CoreBaseEntity) {
                $value = $value->id;
            }
            if (is_array($value) || $value instanceof Collection) {
                $collection = $value;
                $value = [];
                foreach ($collection as $key => &$collectionValue) {
                    if ($collectionValue instanceof CoreBaseEntity) {
                        $value[] = $collectionValue->id;
                    }
                }
            }
        }
        return $data;
    }


    public function assign($values, $whitelist = NULL)
    {
        $properties = [];
        foreach ($this->reflection->getProperties() as $property) {
            $properties[] = $property->name;
        }
        foreach ($values as $key => $value) {
            if (in_array($key, $properties) && ($whitelist === NULL || in_array($key, $whitelist))) {
                $this->{$key} = $value !== '' ? $value : NULL;
            }
        }
    }

}