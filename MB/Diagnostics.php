<?php

  namespace MB;

  /**
   *
   */
  final class Diagnostics
  {
    /**
     * @static
     *
     */
    static public function begin()
    {
      if( !Registry::exist( 'Diagnostics', 'beginTime' ) )
      {
        Registry::set( 'Diagnostics', 'beginTime', microtime( true ) );
      }
    }

    /**
     * @param string $text
     * @param bool $isImportantly
     */
    static public function log( $text, $isImportantly = false )
    {
      $beginTime = Registry::get( 'Diagnostics', 'beginTime' );
      if( $beginTime === null )
      {
        $beginTime = microtime( true );
        Registry::set( 'Diagnostics', 'beginTime', $beginTime );
      }

      Registry::addItemToArray( 'Diagnostics', 'log', Array(
        'time'          => sprintf( '%07.1fms', ( ( ( microtime( true ) - $beginTime ) * 10000 ) / 10 ) ),
        'message'       => $text,
        'isImportantly' => $isImportantly
      ) );
    }

    /**
     * @param int $logMode
     */
    static public function showLog( $logMode = DIAGNOSTICS_LOG_MODE_TEXT )
    {
      $log = Registry::get( 'Diagnostics', 'log' );
      if( !empty( $log ) AND is_array( $log ) )
      {
        if( $logMode == DIAGNOSTICS_LOG_MODE_HTML )
        {
          echo '<hr />';
          foreach( $log AS $item )
          {
            echo $item['time'] . ': ' .
                 '<span ' . ( !empty( $item['isImportantly'] ) ? 'style="color: red; font-weight: bolder; background-color: yellow;"' : '' ) .
                 '>' .  $item['message'] . '</span><br />';
          }
        }
        else
        {
          foreach( $log AS $item )
          {
            fwrite( STDOUT, "\n" . $item['time'] . ': ' . $item['message'] );
          }
        }
      }
    }

  }


