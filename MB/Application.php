<?php

  namespace MB;

  abstract class Application extends Diagnostics
  {
    protected $params = Array();

    public function __construct( $params = Array() )
    {
      //Load main config
      $conf = Array();
      require "../conf/main.conf.php";
      Registry::set( 'conf', $conf );

      //Init
      $this->log( __( 'Initialization' ) );

      //fill params map
      $cnt = count( $params );
      for( $i = 0; $i < $cnt; $i++ )
      {
        $this->params[$params[$i]] = isset( $params[$i + 1] ) ? $params[$i + 1] : '';
      }
    }

    protected function getParam( $paramName )
    {
      return isset( $this->params[$paramName] ) ? $this->params[$paramName] : '';
    }

    protected function existParam( $paramName )
    {
      return isset( $this->params[$paramName] ) ? true : false;
    }

    abstract function execute();
  }

