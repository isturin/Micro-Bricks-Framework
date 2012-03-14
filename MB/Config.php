<?php

  namespace MB;

  /**
   *
   */
  final class Config
  {
    /**
     * @var array
     */
    private static $data;

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
     * @return mixed|null
     */
    public static function get( $key1 /* [, $key2[, ...[, $keyN]]] */ )
    {
      if( self::$data === null )
      {
        $config = Array();
        require "../conf/config.php";
        self::$data = $config;
      }

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
  }

