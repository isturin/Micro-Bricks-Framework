<?php

  namespace MB;

  final class Registry
  {
    private static $data = Array();

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function exist()
    {
      return !!self::get( func_get_args() );
    }

    public static function get()
    {
      $arglist = func_get_args();
      $target = &self::$data;
      while( $current = array_shift( $arglist ) )
      {
        if( !isset( $target[$current] ) )
        {
          return null;
        }
        $target = &$target[$current];
      }
      return $target;
    }

    public static function set()
    {
      $arglist = func_get_args();
      $target = &self::$data;
      while( $current = array_shift( $arglist ) )
      {
        if( count( $arglist ) == 1 )
        {
          $target[$current] = array_shift( $arglist );
          break;
        }
        if( !isset( $target[$current] ) )
        {
          $target[$current] = array();
        }
        $target = &$target[$current];
      }
    }
  }

