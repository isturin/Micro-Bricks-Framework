<?php

  namespace MB\models;

  /**
   *
   */
  class Session extends \MB\Model
  {
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
  }