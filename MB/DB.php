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
        self::$instance = mysql_connect( Config::get( 'mysql', 'host' ),
                                         Config::get( 'mysql', 'user' ),  Config::get( 'mysql', 'pass' ) );

        if( self::$instance !== false )
        {
          mysql_select_db(  Config::get( 'mysql', 'dbname' ), self::$instance );
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

