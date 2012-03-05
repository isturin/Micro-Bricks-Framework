<?php

  error_reporting( E_ALL );
  ini_set( 'display_errors', 1 );
  ini_set( 'html_errors', 'On' );

  //DEFINES
  //application mode
  define( 'APPLICATION_MODE_DEVELOP', 1 );
  define( 'APPLICATION_MODE_STAGE', 2 );
  define( 'APPLICATION_MODE_PRODUCTION', 3 );

  //diagnostics log mode
  define( 'DIAGNOSTICS_LOG_MODE_HTML', 1 );
  define( 'DIAGNOSTICS_LOG_MODE_TEXT', 2 );

  //other
  define( 'CURRENT_TIMESTAMP', time() );

  //base loader
  function __autoload( $className )
  {
    require_once '../' . str_replace( '\\', '/', $className ) . '.php';
  }

  //temporary stub for gnu texts
  function __( $str )
  {
    return $str;
  }

  //create begin label for diagnostics
  \MB\Diagnostics::begin();




