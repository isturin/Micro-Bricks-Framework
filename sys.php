<?php

    function __autoload( $className )
    {
      $nameArr = explode( '\\', $className );
      $path = "../" . implode( '/', $nameArr ) . ".php";
      if( file_exists( $path ) )
      {
        require_once $path;
      }
      else
      {
        //todo
      }
    }

    function __( $str )
    {
      return $str;
    }

