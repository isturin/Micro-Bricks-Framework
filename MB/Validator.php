<?php

  namespace MB;

  abstract class Validator extends Diagnostics
  {
    protected $field, $test;

    final public function __construct( $field, $test )
    {
      $this->field = $field;
      $this->test = $test;
    }

    abstract public function getErrorMessage( $fieldName );

    abstract public function isValid( $value );

    abstract public function getClientValidator();
  }