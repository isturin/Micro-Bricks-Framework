<?php

  namespace MB;

  class Diagnostics
  {
    final public function log( $text )
    {
      if( !Registry::exist( 'Diagnostics', 'beginTime' ) )
      {
        !Registry::set( 'Diagnostics', 'beginTime', microtime( true ) );
      }

      Registry::addItem( 'Diagnostics', 'log', Array(
        'time'    => sprintf( '%07.1fms', ( ( ( microtime( true ) - Registry::get( 'Diagnostics', 'beginTime' ) ) * 10000 ) / 10 ) ),
        'message' => $text
      ) );
    }

    protected function showLog( $html = false )
    {
      $log = Registry::get( 'Diagnostics', 'log' );
      if( !empty( $log ) AND is_array( $log ) )
      {
        foreach( $log AS $item )
        {
          fwrite( STDOUT, "\n" . $item['time'] . ': ' . $item['message'] );
        }
      }
    }
  }


