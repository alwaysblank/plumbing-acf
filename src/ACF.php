<?php namespace Murmur\WP;
  
  class ACF
  {
    /**
     * Get an ACF Field, but safely.
     * 
     * @param string $field 
     * @param int|bool $id // Pass an id if you want fields from a different object (or options)
     * @param bool $format // Pass bool false to recieve unformatted field data
     * @return mixed
     */
    static function getField($field, $id = false, $format = true)
    {
      if(!function_exists('get_field')) : return false; 
      else : return get_field($field, $id, $format); endif;
    }

    /**
     * Get an ACF Field Object, but safely.
     * 
     * @param string $field 
     * @param int|null $id // Pass an id if you want fields from a different object (or options)
     * @return mixed
     */
    static function getFieldObj($field, $id = null)
    {
      if(!function_exists('get_field_object')) : return false; 
      else :
        if($id !== null) : return get_field_object($field, $id);
        elseif($id === null) : return get_field_object($field); endif;
      endif;
    }

    /**
     * Get a bunch of fields, as defined in an array.
     * 
     * @param array $array 
     * @param 'object'|'value' $return
     * @return array
     */
    static function getFields($array, $return = 'value')
    {
      $col = [];
      switch ($return) :
        case 'object': $func = 'getFieldObj'; break;
        case 'value': $func = 'getField'; break;    
        default: return 'false'; break;
      endswitch;
      foreach ($array as $field => $args) :
        $tmp = self::$func($field, ($args['id'] ?? false), ($args['format'] ?? true));
        if(!$tmp) : continue; endif;
        if(array_key_exists('callback', $args)) :
          $callback = $args['callback'];
          if(array_key_exists('callback_args', $args)) : $call_args = $args['callback_args'];
          else : $call_args = []; endif;
          $tmp = call_user_func_array($callback, array_merge([$tmp], $call_args));
        endif;
        $col[($args['name'] ?? $field)] = $tmp;
        unset($tmp);
      endforeach;
      return $col;
    }
  }