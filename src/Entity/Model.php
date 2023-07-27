<?php

namespace App\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;

abstract class Model
{
  abstract public static function getRequiredFields(): array;
  abstract public static function fromArray(array $data): static;
  abstract public function toArray(): array;

  public function update(array $array): static
  {
      $propertyAccessor = PropertyAccess::createPropertyAccessor();
      $requiredFields = static::getRequiredFields();

      foreach ($array as $key => $value) {
          $isFieldRequired = in_array($key, $requiredFields);
          if (!$isFieldRequired || $array[$key]) {
              $propertyAccessor->setValue($this, $key, $value);
          }
      }

      return $this;
  }
}
