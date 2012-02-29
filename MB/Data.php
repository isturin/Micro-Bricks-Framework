<?php

  namespace MB;

  class Data extends Diagnostics
  {
    final protected function dbQuery( $sql )
    {
      $startQueryTime = microtime( true );
      $res = mysql_query( $sql, DB::getInstance() );
      if( mysql_errno() != 0 )
      {
        self::log( __( 'SQL Ошибка: ' ) . mysql_error() );
      }
      self::log( "SQL: {$sql} [" . sprintf( '%07.1fms', ( ( ( microtime( true ) - $startQueryTime ) * 10000 ) / 10 ) ) . ']' );
      return $res;
    }

    final protected function dbGetItems()
    {
      $args = func_get_args();
      $sql = array_shift( $args );
      if( count( $args ) > 0 )
      {
        self::dbPrepareParams( $args );
        $keys = Array();

        for( $i = 0; $i < count( $args ); $i++ )
        {
          $keys[] = "[{$i}]";
        }

        $sql = str_replace( $keys, $args, $sql );
      }

      $res = self::dbQuery( $sql );

      $items = Array();
      if( $res )
      {
        $numItems = mysql_num_rows( $res );
        for( $i = 0; $i < $numItems; $i++ )
        {
          $items[] = mysql_fetch_assoc( $res );
        }
        mysql_free_result( $res );
      }

      return $items;
    }

    final protected function dbGetItemById( $tbl, $id, $fields = '*' )
    {
      $items = self::dbGetItems( "SELECT {$fields} FROM {$tbl} WHERE ID = [0] LIMIT 1;", $id );
      return !empty( $items[0] ) ? $items[0] : Array();
    }

    final protected function dbGetItemByCondition( $tbl, $condition, $fields = '*' )
    {
      $items = self::dbGetItems( "SELECT {$fields} FROM {$tbl} WHERE {$condition} LIMIT 1;" );
      return !empty( $items[0] ) ? $items[0] : Array();
    }

    final protected function dbInsert( $tbl, $fields, $values )
    {
      self::dbPrepareParams( $values );
      $sql = "INSERT INTO {$tbl} ( " . implode( ', ', $fields ) . " ) VALUES ( " . implode( ', ', $values ) . ");";
      return self::dbQuery( $sql );
    }

    final protected function dbUpdate( $tbl, $fields, $values, $where = false )
    {
      self::dbPrepareParams( $values );
      $sql = "UPDATE {$tbl} SET ";
      $lastKey = count( $fields ) - 1;
      foreach( $fields AS $key => $field )
      {
        $sql .= $field . ' = ' . $values[$key];
        if( $key < $lastKey )
        {
          $sql .= ', ';
        }
      }
      $sql .= $where !== false ? " WHERE {$where} ;" : ';';

      return self::dbQuery( $sql );
    }

    final protected function dbLastInsertId()
    {
      self::log( __( 'SQL: Получение последнего ID' ) );
      $startQueryTime = microtime( true );
      $ID = mysql_insert_id( DB::getInstance() );
      self::log(
        'SQL: ' . sprintf( '%07.1fms', ( ( ( microtime( true ) - $startQueryTime ) * 10000 ) / 10 ) ) . 'ms' );
      return $ID;
    }

    final protected function dbPrepareParams( &$params )
    {
      foreach( $params AS &$param )
      {
        if( mb_strtoupper( $param, 'UTF-8' ) != 'NULL' )
        {
          $param = "'" . mysql_real_escape_string( $param, DB::getInstance() ) . "'";
        }
      }
    }

    final protected function dbGetCache( $key )
    {
      $data = self::dbGetItemByCondition( 'mb_cache', "name = '{$key}'", 'value' );
      return !empty( $data['value'] ) ? $data['value'] : '';
    }

    final protected function dbSetCache( $key, $value )
    {
      $data = self::dbGetItemByCondition( 'mb_cache', "name = '{$key}'", 'name' );
      if( isset( $data['name'] ) )
      {
        $status = self::dbUpdate( 'mb_cache', Array( 'value' ), Array( $value ), "name = '{$key}'" );
      }
      else
      {
        $status = self::dbInsert( 'mb_cache', Array(
          'name',
          'value'
        ), Array(
          $key,
          $value
        ) );
      }

      return $status;
    }
  }