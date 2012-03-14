<?php

  namespace MB;

  /**
   *
   */
  final class Session
  {
    /**
     * @var bool
     */
    static private $isStarted;

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
     * @return bool
     */
    static public function open()
    {
      return true;
    }

    /**
     * @static
     * @return bool
     */
    static public function close()
    {
      return true;
    }

    /**
     * @static
     * @return bool
     */
    static public function destroy()
    {
      //todo
      return true;
    }

    /**
     * @static
     * @return bool
     */
    public static function gc()
    {
      //todo
      return true;
    }

    /**
     * @static
     * @param string $sessionID
     * @return array
     */
    public static function read( $sessionID )
    {
      return \MB\models\Session::read( $sessionID );
    }

    /**
     * @static
     * @param string $sessionID
     * @param array $data
     * @return bool
     */
    public static function write( $sessionID, $data )
    {
      return \MB\models\Session::write( $sessionID, $data );
    }

    /**
     * @static
     * @param string $sessionName
     * @return bool
     */
    public static function load( \string $sessionName )
    {
      if( self::$isStarted === null )
      {
        session_name( $sessionName );
        session_set_cookie_params( Registry::get( 'conf', 'session', 'longTimeout' ), '/', $sessionName, 'session_name' );
        session_write_close();
        session_set_save_handler( Array( '\MB\Session', 'open' ),
                                  Array( '\MB\Session', 'close'),
                                  Array( '\MB\Session', 'read' ),
                                  Array( '\MB\Session', 'write' ),
                                  Array( '\MB\Session', 'destroy' ),
                                  Array( '\MB\Session', 'gc' ) );
        register_shutdown_function( 'session_write_close' );
        session_start();

        $sessionID = self::get( 'sessionID' );
        self::$isStarted = $sessionID == session_id();
        if( !self::$isStarted )
        {
          self::logout();
        }
      }

      return self::$isStarted;
    }

    /**
     * @static
     * @param string $key
     * @return null
     */
    static public function get( \string $key )
    {
      return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }

    /**
     * @static
     * @param string $key
     * @param mixed $data
     */
    static public function set( \string $key, $data )
    {
      $_SESSION[$key] = $data;
    }

    /**
     * @static
     * @param string $key
     */
    static public function remove( \string $key )
    {
      if( isset( $_SESSION[$key] ) )
      {
        unset( $_SESSION[$key] );
      }
    }
         /*
    static public function del( $uid = false, $appname = false )
    {
      if( !$uid )
      {
        session_unset();
        $_SESSION = Array();
      }

      $uid = !$uid ? self::get( 'uid' ) : $uid;
      if( $uid > 0 )
      {
        $keyName = "sess:{$appname}:{$uid}";
        self::dbSetCache( $keyName, '' );
      }
    }*/
      /*
    public static function checkUserSession( $uid, $appname )
    {
      return !!self::dbGetCache( "sess:{$appname}:{$uid}" );
    }
     */

    /*
    public static function setCookie( $name, $value, $expire )
    {
      return setcookie( Registry::get( 'appname' ) . $name, $value, $expire, INI_GET( 'session.cookie_path' ),
                        INI_GET( 'session.cookie_domain' ) );
    }
    */

    /*
    public static function getCookie( $name )
    {
      $key = Registry::get( 'appname' ) . $name;
      return isset( $_COOKIE[$key] ) ? $_COOKIE[$key] : false;
    }
    */

    /*
    public static function getUserSession( $uid, $appname )
    {
      return self::decode( self::dbGetCache( "sess:{$appname}:{$uid}" ) );
    }
    */

    /*
    public static function setUserSession( $uid, $appname, $data )
    {
      $userData = self::getUserSession( $uid, $appname );
      if( $userData )
      {
        unset( $data['sid'] );
        unset( $data['lastTouch'] );
        unset( $data['lastLog'] );
        $userData = array_merge( $userData, $data );
        self::write( false, self::encode( $userData ), $uid, $appname, $data['isLongSession'] );
      }
    }
    */

    /*
    public static function isAuth()
    {
      return self::get( 'uid' ) AND self::get( 'sid' ) AND self::get( 'sid' ) == self::getId();
    }
    */

    /*
    private static function encode( $array )
    {
      return serialize( $array );
    }
    */

    /*
    private static function decode( $data )
    {
      return unserialize( $data );
    }
    */

    public static function logout()
    {
      //todo
      //self::del();
      //self::setCookie( 'uid', $uid, time() - 3600 );
    }
  }

