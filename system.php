<?php

  error_reporting( E_ALL );
  ini_set( 'display_errors', 1 );
  ini_set( 'html_errors', 'On' );

  function __autoload( $className )
  {
    require_once '../' . str_replace( '\\', '/', $className ) . '.php';
  }

  function __( $str )
  {
    return $str;
  }

  \MB\Diagnostics::begin();





