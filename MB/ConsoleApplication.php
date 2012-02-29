<?php

  namespace MB;

  abstract class ConsoleApplication extends Application
  {
    protected $argv = Array();

    public function __construct( $params )
    {
      parent::__construct( $params );
      $this->argv = $params;
    }

    protected function getFixedParam( $position )
    {
      return isset( $this->argv[intval( $position )] ) ? $this->argv[intval( $position )] : '';
    }

    protected function existFixedParam( $position )
    {
      return isset( $this->argv[intval( $position )] ) ? true : false;
    }

    public function execute()
    {
      $this->log( __( 'Консольное приложение запущено' ) );
      $this->main();
      $this->log( __( 'Консольное приложение выполнено' ) );

      $this->showLog();
    }

    abstract function main();
  }

