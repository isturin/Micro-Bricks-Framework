<?php

  namespace MB;

  abstract class ConsoleApplication extends Application
  {
    protected $argv = Array();

    final public function __construct( $params )
    {
      $this->argv = $params;
      parent::__construct( $params );
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
      Diagnostics::log( __( 'Консольное приложение запущено' ) );
      $this->main();
      Diagnostics::log( __( 'Консольное приложение выполнено' ) );

      Diagnostics::showLog();
    }

    abstract function main();
  }

