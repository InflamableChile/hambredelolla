<?php namespace flow\settings;
if ( ! defined( 'WPINC' ) ) die;
/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014 Looks Awesome
 */

class FFSettingsUtils {
	public static function YepNope2ClassicStyleSafe($array, $key, $not_parsed_result = false){
		return isset($array[$key]) ? self::YepNope2ClassicStyle($array[$key], $not_parsed_result) : $not_parsed_result;
	}

    public static function YepNope2ClassicStyle($str, $not_parsed_result = false) {
        if (isset($str)){
            return ($str == 'yep') ? true : false;
        }
        return $not_parsed_result;
    }

	public static function notYepNope2ClassicStyleSafe($array, $key, $not_parsed_result = true){
		return isset($array[$key]) ? self::notYepNope2ClassicStyle($array[$key], $not_parsed_result) : $not_parsed_result;
	}

    public static function notYepNope2ClassicStyle($str, $not_parsed_result = true) {
        if (isset($str)){
            return ($str == 'nope') ? true : false;
        }
        return $not_parsed_result;
    }
} 