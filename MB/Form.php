<?php

  namespace MB;

  class Form
  {
    private $fields;
    protected function getPostInput( $name )
    {
      $value = !empty( $_POST[$name] ) ? trim( $_POST[$name] ) : '';
      if( get_magic_quotes_gpc() )
      {
        $value = stripslashes( $value );
      }

      return $value;
    }

    protected function getPostCheckbox( $name )
    {
      return !empty( $_POST[$name] ) ? 1 : 0;
    }

  }

