<?php

  namespace MB\models;

  /**
   *
   */
  class Session extends \MB\Model
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
     * @param string $sessionName
     * @return bool
     */
    public static function load( \string $sessionName )
    {
      if( self::$isStarted === null )
      {
        session_name( $sessionName );
        session_set_cookie_params( \MB\Registry::get( 'conf', 'session', 'longTimeout' ), '/', $sessionName, 'session_name' );
        session_write_close();
        session_set_save_handler( Array( '\MB\models\Session', 'open' ),
                                  Array( '\MB\models\Session', 'close'),
                                  Array( '\MB\models\Session', 'read' ),
                                  Array( '\MB\models\Session', 'write' ),
                                  Array( '\MB\models\Session', 'destroy' ),
                                  Array( '\MB\models\Session', 'gc' ) );
        register_shutdown_function( 'session_write_close' );
        session_start();

        $sessionID = self::get( 'sessionID' );
        self::$isStarted = $sessionID == session_id();
      }

      return self::$isStarted;
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
     * @param string $sessionID
     * @return array
     */
    static public function read( \string $sessionID )
    {
      //todo
      return Array();
    }

    /**
     * @static
     * @param string $sessionID
     * @param array $data
     * @return bool
     */
    static public function write( \string $sessionID, array $data )
    {
      //todo
      return true;
    }

    /**
     * @static
     * @param string $sessionID
     * @return bool
     */
    static public function destroy( \string $sessionID )
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

    /**
     * @static
     * @param string $key
     * @return bool
     */
    static public function exist( \string $key )
    {
      return isset( $_SESSION[$key] );
    }
  }