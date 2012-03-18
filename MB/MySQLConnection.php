<?php

  namespace MB;

  /**
   *
   */
  final class MySQLConnection
  {
    static private $instance;

    static function &getInstance()
    {
      if( self::$instance === null )
      {
        self::$instance = @mysqli_connect(
          Config::get( 'mysql', 'host' ),
          Config::get( 'mysql', 'user' ),
          Config::get( 'mysql', 'pass' ),
          Config::get( 'mysql', 'dbname' ) );

        if( self::$instance !== false )
        {
          mysqli_query( self::$instance, 'SET NAMES utf8' );
        }
        else
        {
          Diagnostics::log( mysqli_connect_error() , DIAGNOSTICS_LOG_IMPORTANTLY_ERROR );
        }
      }

      return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
  }

