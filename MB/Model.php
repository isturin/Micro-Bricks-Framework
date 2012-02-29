<?php

  namespace MB;

  abstract class Model extends Data
  {
    protected $data = Array(), $newData = Array();

    protected $tableName = '';

    public function __construct( $tableName, $objectID, $dbRow = false )
    {
      $this->tableName = $tableName;
      if( $dbRow === false )
      {
        $dbRow = $this->dbGetItemById( $tableName, $objectID );
      }

      if( !empty( $dbRow['ID'] ) )
      {
        $this->data = $dbRow;
      }
      else
      {
        $this->data = Array( 'isRemoved' => 1 );
      }
    }

    public function getConversion( $field, $value )
    {
      return $value;
    }

    public function __get( $field )
    {
      return isset( $this->data[$field] ) ? $this->getConversion( $field, $this->data[$field] ) : false;
    }

    public function setConversion( $field, $value )
    {
      return $value;
    }

    public function __set( $field, $value )
    {
      $this->newData[$field] = $this->setConversion( $field, $value );
    }
  }