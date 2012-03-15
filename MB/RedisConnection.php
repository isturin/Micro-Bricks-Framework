<?php

  namespace MB;

  /**
   *
   */
  final class RedisConnection
  {
    static private $instance;

    static function &getInstance()
    {
      if( self::$instance === null )
      {
        self::$instance = new Redis();
        self::$instance->connect( Config::get( 'redis', 'host' ), Config::get( 'redis', 'port' ) );
        self::$instance->select( Config::get( 'redis', 'dbID' ) );
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

