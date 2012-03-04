<?php

  namespace MB;

  /**
   *
   */
  abstract class Application extends Diagnostics
  {
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $map = Array();

    /**
     * @var array
     */
    protected $params = Array();

    /**
     * @var int
     */
    protected $mode;

    /**
     * @var Brick
     */
    protected $brick;

    /**
     * @var Action
     */
    protected $action;

    /**
     * @param array $params
     */
    public function __construct( $params = Array() )
    {
      //reset autoloader
      spl_autoload_register( Array( $this, 'loader' ) );

      //fill params map
      $cnt = count( $params );
      for( $i = 0; $i < $cnt; $i++ )
      {
        $this->params[$params[$i]] = isset( $params[$i + 1] ) ? $params[$i + 1] : '';
      }
    }

    /**
     * @param string $className
     */
    private function loader( $className )
    {
      $path = '../' . str_replace( '\\', '/', $className ) . '.php';
      if( file_exists( $path ) )
      {
        require_once $path;
      }
      else
      {
        $this->error( 'loader: ' . $className );
      }
    }

    /**
     * @param string $paramName
     * @return string
     */
    protected function getParam( $paramName )
    {
      return isset( $this->params[$paramName] ) ? $this->params[$paramName] : '';
    }

    /**
     * @param string $paramName
     * @return bool
     */
    protected function existParam( $paramName )
    {
      return isset( $this->params[$paramName] ) ? true : false;
    }

    /**
     * @param $applicationName
     * @param $brickName
     * @return null|Brick
     */
    protected function getBrick( $applicationName, $brickName )
    {
      $brickClassName = "\\{$applicationName}\\bricks\\{$brickName}";
      if( !class_exists( $brickClassName ) )
      {
        $pathToBrick = '../' . str_replace( '\\', '/', $brickClassName ) . '.php';
        if( file_exists( $pathToBrick ) )
        {
          require_once $pathToBrick;
        }
      }

      if( class_exists( $brickClassName ) )
      {
        return new $brickClassName();
      }
      else
      {
        return null;
      }

    }

    /**
     * @param $applicationName
     * @param $brickName
     * @param $actionName
     * @return null|Action
     */
    protected function getAction( $applicationName, $brickName, $actionName )
    {
      $actionClassName = "\\{$applicationName}\\bricks\\{$brickName}\\actions\\{$actionName}";
      if( !class_exists( $actionClassName ) )
      {
        $pathToAction = '../' . str_replace( '\\', '/', $actionClassName ) . '.php';
        if( file_exists( $pathToAction ) )
        {
          require_once $pathToAction;
        }
      }

      if( class_exists( $actionClassName ) )
      {
        return new $actionClassName( $this->brick );
      }
      else
      {
        return null;
      }
    }

    /**
     * @param string $text
     */
    protected function error( $text = '' )
    {
      echo 'Error: ' . $text . '<br />';
      exit;
    }

    /**
     * @abstract
     *
     */
    abstract public function execute();
  }

