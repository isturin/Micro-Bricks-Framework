<?php

  namespace MB;

  final class Session extends Data
  {
    protected static $sessionStarted = false;

    private function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function open()
    {
    }

    public static function close()
    {
      //todo: close session
      return true;
    }

    public static function destroy()
    {
      //todo: destroy session
      return true;
    }

    public static function gc()
    {
    }

    public static function read( $sessionID )
    {
      $keyName = 'sess:' . $sessionID;
      $data = self::kvGet( $keyName );

      return $data;
    }

    public static function write( $sessionID, $data )
    {
      self::kvSet( "sess:{$sessionID}", $data );

      return true;
    }

    public static function load()
    {
      if( !self::$sessionStarted )
      {
        //ini_set( 'session.save_handler', 'user' );
        //session_name( Registry::get( 'conf', Registry::get( 'appname' ), 'session_name' ) );
        //session_set_cookie_params( (int)Registry::get( 'conf', 'session', 'longTimeout' ), '/', Registry::get( 'appname' ), 'session_name' );

        session_write_close();
        session_set_save_handler( Array(
          '\MB\Session',
          'open'
        ), Array(
          '\MB\Session',
          'close'
        ), Array(
          '\MB\Session',
          'read'
        ), Array(
          '\MB\Session',
          'write'
        ), Array(
          '\MB\Session',
          'destroy'
        ), Array(
          '\MB\Session',
          'gc'
        ) );
        register_shutdown_function( 'session_write_close' );
        session_start();

        $sid = self::get( 'sid' );

        //todo
        if( !empty( $sid ) AND !empty( $uid ) )
        {
          if( $sid == self::getId() )
          {
            self::set( 'lastTouch', time() );
          }
          else
          {
            self::logout();
            //todo
            return false;
          }
        }

        self::$sessionStarted = true;
      }

      return $_SESSION;
    }

    public function get( $key )
    {
      return isset( $_SESSION[$key] ) ? $_SESSION[$key] : false;
    }

    public function set( $key, $data = false )
    {
      if( is_array( $key ) )
      {
        $_SESSION = array_merge( $_SESSION, $key );
      }
      else
      {
        $_SESSION[$key] = $data;
      }
    }

    public function remove( $key )
    {
      if( $key and isset( $_SESSION[$key] ) )
      {
        unset( $_SESSION[$key] );
      }
    }

    public function getId()
    {
      return session_id();
    }

    public static function del( $uid = false, $appname = false )
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
    }

    public static function checkUserSession( $uid, $appname )
    {
      return !!self::dbGetCache( "sess:{$appname}:{$uid}" );
    }

    public static function setCookie( $name, $value, $expire )
    {
      return setcookie( Registry::get( 'appname' ) . $name, $value, $expire, INI_GET( 'session.cookie_path' ),
        INI_GET( 'session.cookie_domain' ) );
    }

    public static function getCookie( $name )
    {
      $key = Registry::get( 'appname' ) . $name;
      return isset( $_COOKIE[$key] ) ? $_COOKIE[$key] : false;
    }

    public static function getUserSession( $uid, $appname )
    {
      return self::decode( self::dbGetCache( "sess:{$appname}:{$uid}" ) );
    }

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

    public static function isAuth()
    {
      return self::get( 'uid' ) AND self::get( 'sid' ) AND self::get( 'sid' ) == self::getId();
    }

    private static function encode( $array )
    {
      return serialize( $array );
    }

    private static function decode( $data )
    {
      return unserialize( $data );
    }

    public static function logout()
    {
      $uid = self::get( 'uid' );
      self::del();
      self::setCookie( 'uid', $uid, time() - 3600 );
      Registry::set( 'isAuth', false );
    }
  }

