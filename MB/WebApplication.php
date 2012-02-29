<?php

  namespace MB;

  abstract class WebApplication extends Application
  {
    protected $name = '';
    protected $map = Array();

    /**
     * @var Brick
     */
    private $brick;

    /**
     * @var Action
     */
    private $action;

    public function __construct()
    {
      $paramsArray = explode( '/', $_SERVER['REQUEST_URI'] );
      parent::__construct( $paramsArray );
    }



    public function execute()
    {
      $this->log( __( 'Web приложение запущено' ) );
      echo $this->main();
      $this->log( __( 'Web приложение выполнено' ) );

      $this->showLog();
    }

    protected function showLog()
    {
      if( $this->logEnabled )
      {
        echo '<hr />';
        $log = Registry::get( 'log' );
        foreach( $log AS $item )
        {
          echo $item['time'] . ': ' . $item['message'] . '<br />';
        }
      }
    }

    public function main()
    {

      if( !Session::load() )
      {
        //todo
      }

      $isAuth = Session::isAuth() ? 'auth' : 'guest';
      $brickName = '';
      $brickClassName = '';
      $chm = '';
      $appName = 'MB';
      foreach( $this->map AS $mask => $bricks )
      {
        $maskArr = explode( ':', $mask, 2 );
        if( $maskArr[0] == $isAuth OR $maskArr[0] = '*' )
        {
          if( preg_match( $maskArr[1], $_SERVER['REQUEST_URI'] ) )
          {
            $bricksArr = explode( ':', $bricks, 3 );
            if( !empty( $bricksArr[2] ) )
            {
              $appName = $bricksArr[2];
            }
            $brickName = ucfirst( $bricksArr[0] );
            $brickClassName = "\\{$appName}\\bricks\\{$brickName}";
            $chm = $bricksArr[1];
            break;
          }
        }
      }

      if( empty( $brickName ) )
      {
        $this->error( __( "Неизвестный кирпич" ) );
      }
      elseif( empty( $chm ) )
      {
        $this->error( __( "Ошибка мэппинга" ) );
      }

      $this->brick = new $brickClassName();
      $actionName = $this->brick->getActionName();

      if( empty( $actionName ) )
      {
        return $this->makeError( $chm );
      }

      $actionClassName = "\\{$appName}\\bricks\\{$brickName}\\actions\\{$actionName}";
      $this->action = new $actionClassName();

      if( !$this->action->applyFilters() )
      {
        return $this->makeError( $chm );
      }

      $this->action->loadBrick( $this->brick );

      // do ASYNC
      if( !empty( $_SERVER['REQUEST_METHOD'] ) AND !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
        $_SERVER['REQUEST_METHOD'] == 'POST' AND $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
      )
      {
        //todo
      }

      // do POST
      if( $_SERVER['REQUEST_METHOD'] == 'POST' )
      {
        if( !$this->action->post() )
        {
          //todo
        }
      }

      // do GET
      //todo
      $actionBody = $this->action->get();

      if( file_exists( "../{$this->name}/chm/{$chm}.php" ) )
      {
        require "../{$this->name}/chm/{$chm}.php";
      }
      elseif( file_exists( "../MB/chm/{$chm}.php" ) )
      {
        require "../MB/chm/{$chm}.php";
      }
      else
      {
        $this->makeError( "Error" );
      }
    }

    protected function makeError( $chm, $text = '' )
    {
      $action = new \MB\bricks\Errors\actions\Show();
      $actionBody = $action->get( $text );
      require "../chm/{$chm}.php";
    }
  }

