<?php

  namespace MB;

  /**
   *
   */
  abstract class WebApplication extends Application
  {
    /**
     * @var string
     */
    private $schema = '';

    /**
     * @var string
     */
    private $subDomain = '';

    /**
     *
     */
    final public function __construct()
    {
      parent::__construct( explode( '/', $_SERVER['REQUEST_URI'] ) );
    }

    /**
     *
     */
    public function execute()
    {
      Diagnostics::log( "Web application \"{$this->name}\" started" );
      $this->main();
      Diagnostics::log( "Web application \"{$this->name}\" executed" );

      Diagnostics::showLog( DIAGNOSTICS_LOG_MODE_HTML );
    }

    public function main()
    {
      //todo: start Session

      $this->subDomain = $this->getSubdomain();

      //scan map
      $scheme = '';
      $brickName = '';

      $subDomainKey = $this->getSubdomainKey();
      $authState = 'auth';  //todo: get from Session state
      foreach( $this->map[$subDomainKey] AS $mask => $alias )
      {
        $maskParts = explode( ':', $mask, 2 );
        if( $maskParts[0] == $authState OR $maskParts[0] = '*' )
        {
          if( preg_match( $maskParts[1], $_SERVER['REQUEST_URI'] ) )
          {
            $aliasParts = explode( ':', $alias, 2 );
            $scheme = !empty( $aliasParts[1] ) ? $aliasParts[1] : $this->name;
            $brickName = $aliasParts[0];
            break;
          }
        }
      }

      //get brick
      $this->brick = $this->getBrick( $this->name, $brickName );
      if( !is_object( $this->brick ) )
      {
        $this->brick = $this->getBrick( 'MB', $brickName );
        if( !is_object( $this->brick ) )
        {
          $this->error( 'brick' );//todo: set text or error type
        }
      }

      $actionName = $this->brick->getActionName();

      //get action
      $this->action = $this->getAction( $this->name, $brickName, $actionName );
      if( !is_object( $this->action ) )
      {
        $this->brick = $this->getAction( 'MB', $brickName, $actionName );
        if( !is_object( $this->action ) )
        {
          $this->error( 'action' );//todo: set text or error type
        }
      }

      if( !$this->action->applyFilters() )
      {
        return $this->error( 'filter' );//todo: set text or error type
      }

      // do ASYNC
      if( !empty( $_SERVER['REQUEST_METHOD'] ) AND !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) AND
        $_SERVER['REQUEST_METHOD'] == 'POST' AND $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
      )
      {
        //todo: async processing
      }

      // do POST
      if( $_SERVER['REQUEST_METHOD'] == 'POST' )
      {
        if( !$this->action->post() )
        {
          //todo: post processing
        }
      }

      // do GET
      $this->drawSchema( $scheme, $this->action->get() );
    }

    /**
     * @return string
     */
    private function getSubdomain()
    {
      $subdomain = substr( $_SERVER['HTTP_HOST'], 0, strrpos( $_SERVER['HTTP_HOST'], Config::get( $this->name, 'domain' ) ) );

      if( strpos( $subdomain, 'www.' ) === 0 )
      {
        $subdomain = substr( $subdomain, 4 );
      }
      else if( $subdomain == 'www' )
      {
        $subdomain == '';
      }

      return $subdomain;
    }

    /**
     * @return string
     */
    private function getSubdomainKey()
    {
      $subDomainKey = 'root';
      if( !empty( $this->subDomain ) )
      {
        if( isset( $this->map[$this->subDomain] ) )
        {
          $subDomainKey = $this->subDomain;
        }
        else
        {
          $subDomainKey = '*';
        }
      }

      return $subDomainKey;
    }

    /**
     * @param $scheme
     * @param $actionContent
     */
    private function drawSchema( $scheme, $actionContent )
    {
      $path = "../{$this->name}/schemes/{$scheme}.php";
      if( file_exists( $path ) )
      {
        require $path;
      }
      else
      {
        $path = "../MB/schemes/{$scheme}.php";
        if( file_exists( $path ) )
        {
          require $path;
        }
        else
        {
          $this->error( 'scheme' );
        }
      }
    }

    protected function error( $text = '' )
    {
      //todo error processing
      Diagnostics::showLog( DIAGNOSTICS_LOG_MODE_HTML );
      return parent::error( $text );
    }

  }

