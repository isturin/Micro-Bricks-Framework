<?php

  namespace MB\validators;

  class Required extends \MB\Validator
  {

    public function isValid( $value )
    {
      $status = false;
      if( !empty( $value ) )
      {
        $status = true;
      }

      return $status;
    }

    public function getErrorMessage( $fieldName )
    {
      return __( "%s: значение должно быть указано", $fieldName );
    }

    public function getClientValidator()
    {
      return '';
    }
  }