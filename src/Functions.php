<?php namespace Livy\Plumbing\ACF;

/**
 * Get a field.
 *
 * @param string $field
 * @param string|int $id
 * @param boolean $format
 * @return mixed
 */
function field($field, $id = false, $format = true)
{
    return Simple::getField($field, $id, $format);
}

/**
 * Get the field object.
 *
 * @param string $field
 * @param string|int $id
 * @return mixed
 */
function fieldObject($field, $id = null)
{
    return Simple::getFieldObj($field, $id);
}

/**
 * Get several fields.
 *
 * @param array $array
 * @param string $return
 * @return array
 */
function fields($array, $return = 'value')
{
    return Simple::getFields($array, $return);
}