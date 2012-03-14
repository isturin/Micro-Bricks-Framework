<?php

  namespace MB;

  /**
   *
   */
  final class Registry
  {
    /**
     * @var array
     */
    private static $data = Array();

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * @static
     * @param $key1[, $key2[, ...[, $keyN]]]
     * @return bool|null
     */
    public static function exist( $key1 /* [, $key2[, ...[, $keyN]]] */ )
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
      return !!$target;
    }

    /**
     * @static
     * @param $key1[, $key2[, ...[, $keyN]]]
     * @return mixed|null
     */
    public static function get( $key1 /* [, $key2[, ...[, $keyN]]] */ )
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

    /**
     * @static
     * @param $key1[, $key2[, ...[, $keyN]]]
     * @param $value
     */
    public static function set( $key1 /* [, $key2[, ...[, $keyN]]] */, $value )
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

    /**
     * @static
     * @param $key1[, $key2[, ...[, $keyN]]]
     * @param $value
     */
    public static function addItemToArray( $key1 /* [, $key2[, ...[, $keyN]]] */, $value )
    {
      $arglist = func_get_args();
      $target = &self::$data;
      while( $current = array_shift( $arglist ) )
      {
        if( count( $arglist ) == 1 )
        {
          $target[$current][] = array_shift( $arglist );
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

