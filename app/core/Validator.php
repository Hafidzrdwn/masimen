<?php

namespace App\Core;

class Validator
{
  protected array $data;
  protected array $rules;
  protected array $messages;
  protected array $errors = [];
  protected static ?QueryBuilder $qb = null; 

  protected function __construct(array $data, array $rules, array $messages = [])
  {
    $this->data = $data;
    $this->rules = $rules;
    $this->messages = $messages;
  }

  public static function make(array $data, array $rules, array $messages = []): self
  {
    if (self::needsDatabase($rules)) {
      self::$qb = new QueryBuilder();
    }

    $validator = new self($data, $rules, $messages);
    $validator->validate();
    return $validator;
  }

  private static function needsDatabase(array $rules): bool
  {
    foreach ($rules as $ruleSet) {
      if (strpos($ruleSet, 'unique') !== false) {
        return true;
      }
    }
    return false;
  }

  private function validate(): void
  {
    foreach ($this->rules as $field => $rules) {
      $rules = explode('|', $rules);
      foreach ($rules as $rule) {
        [$ruleName, $parameter] = array_pad(explode(':', $rule, 2), 2, null);
        $methodName = 'validate' . ucfirst($ruleName);

        if (method_exists($this, $methodName)) {
          $this->$methodName($field, $this->data[$field] ?? null, $parameter);
        }
      }
    }
  }

  // --- Kumpulan Method Validasi ---

  protected function validateRequired(string $field, $value): void
  {
    if (is_null($value) || trim($value) === '') {
      $this->addError($field, 'required', "The {$field} field is required.");
    }
  }

  protected function validateEmail(string $field, $value): void
  {
    if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->addError($field, 'email', "The {$field} field must be a valid email address.");
    }
  }

  protected function validateMin(string $field, $value, string $parameter): void
  {
    if ($value && strlen(trim($value)) < (int)$parameter) {
      $this->addError($field, 'min', "The {$field} field must be at least {$parameter} characters.");
    }
  }

  protected function validateMax(string $field, $value, string $parameter): void
  {
    if ($value && strlen(trim($value)) > (int)$parameter) {
      $this->addError($field, 'max', "The {$field} field must not exceed {$parameter} characters.");
    }
  }

  protected function validateUnique(string $field, $value, string $parameter): void
  {
    if ($value && self::$qb) {
      [$table, $column] = explode(',', $parameter);
      $result = self::$qb->table($table)->where($column, '=', $value)->get();
      if (!empty($result)) {
        $this->addError($field, 'unique', "The {$field} has already been taken.");
      }
    }
  }

  // --- Method Helper ---

  private function addError(string $field, string $rule, string $defaultMessage): void
  {
    if (!isset($this->errors[$field])) {
      $this->errors[$field] = $this->messages["{$field}.{$rule}"] ?? $defaultMessage;
    }
  }

  public function fails(): bool
  {
    return !empty($this->errors);
  }

  public function errors(): array
  {
    return $this->errors;
  }

  public function validated(): array
  {
    if ($this->fails()) {
      throw new \Exception('Validation failed!');
    }
    return array_intersect_key($this->data, $this->rules);
  }
}
