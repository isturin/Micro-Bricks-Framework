<?php

  namespace MB;

  class Field extends Diagnostics
  {
    private $field, $fieldName, $validators;

    public function __construct( $field, $fieldName, $validators )
    {
      $this->field = $field;
      $this->fieldName = $fieldName;
      $this->validators = $validators;
    }


  }