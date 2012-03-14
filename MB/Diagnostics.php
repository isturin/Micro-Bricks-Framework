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
     * @param int $importantly
     */
    static public function log( $text, $importantly = DIAGNOSTICS_LOG_IMPORTANTLY_NORMAL )
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
        'isImportantly' => $importantly
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
        switch ( $logMode )
        {
          case DIAGNOSTICS_LOG_MODE_HTML:
            echo '<hr />';
            foreach( $log AS $item )
            {
              switch ( $item['isImportantly'] )
              {
                case DIAGNOSTICS_LOG_IMPORTANTLY_ERROR:
                  echo  "{$item['time']}: <span style=\"color: red; font-weight: bolder; background-color: yellow;\">{$item['message']}</span><br />";
                  break;

                case DIAGNOSTICS_LOG_IMPORTANTLY_WARNING:
                  echo  "{$item['time']}: <span style=\"color: orange; font-weight: bolder; background-color: yellow;\">{$item['message']}</span><br />";
                  break;

                case DIAGNOSTICS_LOG_IMPORTANTLY_NOTICE:
                  echo  "{$item['time']}: <span style=\"font-weight: bolder;\">{$item['message']}</span><br />";
                  break;

                case DIAGNOSTICS_LOG_IMPORTANTLY_NORMAL:
                default:
                  echo  "{$item['time']}: <span>{$item['message']}</span><br />";
                  break;
              }
            }
            break;

          case DIAGNOSTICS_LOG_MODE_TEXT:
          default:
            foreach( $log AS $item )
            {
              fwrite( STDOUT, "\n" . $item['time'] . ': ' . $item['message'] );
            }
            break;
        }
      }
    }

  }


