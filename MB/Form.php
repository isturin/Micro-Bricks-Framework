<?php

  namespace MB;

  /**
   *
   */
  abstract class Form
  {
    /**
     * @var
     */
    protected $fields;

    /**
     * @param $name
     * @return string
     */
    protected function getPostInput( $name )
    {
      $value = !empty( $_POST[$name] ) ? trim( $_POST[$name] ) : '';
      if( get_magic_quotes_gpc() )
      {
        $value = stripslashes( $value );
      }

      return $value;
    }

    /**
     * @param $name
     * @return int
     */
    protected function getPostCheckbox( $name )
    {
      return !empty( $_POST[$name] ) ? 1 : 0;
    }

    /**
     * @abstract
     *
     */
    abstract function registerFields();

  }

