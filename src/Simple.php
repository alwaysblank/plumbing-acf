<?php namespace Livy\Plumbing\ACF;
  
class Simple
{
    /**
     * Get an ACF Field, but safely.
     *
     * @param string $field
     * @param mixed $id // Pass an id if you want fields from a different object (or options)
     * @param bool $format // Pass bool false to recieve unformatted field data
     * @return mixed
     */
    public static function getField($field, $id = false, $format = true)
    {
        if (!function_exists('get_field')) :
            return false;
        else :
            return get_field($field, $id, $format);
        endif;
    }

    /**
     * Get an ACF Field Object, but safely.
     *
     * @param string $field
     * @param int|null $id // Pass an id if you want fields from a different object (or options)
     * @return mixed
     */
    public static function getFieldObj($field, $id = null)
    {
        if (!function_exists('get_field_object')) :
            return false;
        else :
            if ($id !== null) :
                return get_field_object($field, $id);
            elseif ($id === null) :
                return get_field_object($field);
            endif;
        endif;
    }

    /**
     * Get a bunch of fields, as defined in an array.
     *
     * Each item in the array should be defined as follows:
     *
     *  key               The unique ACF identifier for this field,
     *                    i.e. `field_5a0a10c0c4bae`
     *
     *  value             An array that *must* contain a `name` value,
     *                    but may additionally contain any of the other
     *                    following values:
     *
     *  'name'            This is required, and is the name you'll
     *                    be able to reference this field with.
     *
     *  'id'              The ID of the post object this value is
     *                    on. If it is on an options page, this value
     *                    should be (string) `option`. Otherwise, it
     *                    should be an integer. Defaults to current
     *                    post object.
     *
     *  'callback'        String or anonmymous function that the value
     *                    will be passed through before returning.
     *
     *  'callback_args'   Value(s) that will be passed to the callback,
     *                    in addtion to the current value.
     *
     *  'default'         Value that will be processed and returned if the
     *                    field cannot be retrieved or does not exist.
     *
     * @param array $array
     * @param string $return  Only accepts the values "object" or "value".
     * @return array
     */
    public static function getFields($array, $return = 'value')
    {
        $col = [];
        switch ($return) :
            case 'object':
                $func = 'getFieldObj';
                break;
            case 'value':
                $func = 'getField';
                break;
            default:
                return 'false';
            break;
        endswitch;

        foreach ($array as $field => $args) :
            $tmp = self::$func($field, ($args['id'] ?? false), ($args['format'] ?? true));

            /**
             * If the return value indicates the field does not exist, check to
             * see if there's a default. If yes, set the value for this field
             * to that default. If not, continue (which has the effect of
             * removing this field from the array ultimately returned).
             */
            if (!$tmp) :
                if (array_key_exists('default', $args)) :
                    $tmp = $args['default'];
                else :
                    continue;
                endif;
            endif;

            /**
             * If a callback is defined, run the returned value through that
             * callback. This callback is only given the current field value,
             * unless callback args have been defined, in which case those
             * will be passed along with the current value.
             */
            if (array_key_exists('callback', $args)) :
                $callback = $args['callback'];
                if (array_key_exists('callback_args', $args)) :
                    $call_args = $args['callback_args'];
                else :
                    $call_args = [];
                endif;
                $tmp = call_user_func_array($callback, array_merge([$tmp], $call_args));
            endif;

            $col[($args['name'] ?? $field)] = $tmp;

            /**
             * This is probably not strictly necessary, but better safe than sorry.
             */
            unset($tmp);
        endforeach;

        if (function_exists('collect') &&  class_exists('\\Illuminate\\Support\\Collection')) {
            return collect($col);
        } else {
            return $col;
        }
    }
}
