<?php

  namespace MB;

  /**
   * Class Db. Singlton
   */
  final class DB
  {
    static private $instance;

    static function &getInstance()
    {
      if( self::$instance === null )
      {
        self::$instance = mysql_connect( Registry::get( 'conf', 'mysql', 'host' ),
          Registry::get( 'conf', 'mysql', 'user' ), Registry::get( 'conf', 'mysql', 'pass' ) );

        if( self::$instance !== false )
        {
          mysql_select_db( Registry::get( 'conf', 'mysql', 'dbname' ), self::$instance );
          mysql_query( 'SET NAMES utf8', self::$instance );
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

