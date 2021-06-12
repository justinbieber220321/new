<?php

namespace App\Helpers\Supports;

class Url
{
    const _BACKURL = '_backUrl';
    const QUERY = '_o';
    const OLD_QUERY = '_o_';
    protected $_old = 0;

    public static function addBackUrl($url, $params = [])
    {
        // create key
        $key = self::_createKey();
        $params[self::QUERY] = $key;

        $queryString = request()->getQueryString();

        // store session
        $paramsQuery = self::_getAllParams($queryString);
        $fullUrl = request()->url() . '?'. http_build_query($paramsQuery);
        self::_storeSession($key, $fullUrl);

        // url target
        $params = array_merge($paramsQuery, $params);
        return $url . '?' . http_build_query($params);
    }

    /**
     * all params url with end of array is _o
     * @param $queryString
     * @return mixed
     */
    protected static function _getAllParams($queryString) // string => arr with _o is end of element
    {
        parse_str($queryString, $arrQueryStr); // string to array
        $tmp = array_get($arrQueryStr, self::QUERY, false);
        if ($tmp) {
            $keys = array_keys($arrQueryStr);
            if (array_get($keys, 0, '') == self::QUERY) {
                $arrQueryStr = array_slice($arrQueryStr, 1);
                $arrQueryStr[self::QUERY] = $tmp;
            }
        }
        return $arrQueryStr;
    }

    /**
     * @param null $urlDefault
     * @return mixed|string
     */
    public static function getBackUrl($urlDefault = null)
    {
        $allSession = session()->all();
        $listBackUrl = array_get($allSession, '_backUrl', []);
        $oldKey = request()->get(self::QUERY, false);

        if (!$oldKey) {
            if (is_null($urlDefault)) {
                $controller = strtolower(trim(class_basename(\Route::current()->controller)));
                $module = substr($controller, 0, - strlen('controller'));
                $urlDefault = backendRouter($module .'s.list');
            }
            return $urlDefault;
        }

        return array_get($listBackUrl, $oldKey);
    }

    protected static function _storeSession($key, $value)
    {
        session([self::_BACKURL . '.' . $key => $value]);
    }

    /**
     * create value _o
     * @return int: self::QUERY
     */
    protected static function _createKey()
    {
        return time() + rand(10, 100);
    }

    protected static function _parseQueryStringToArray($queryString, $params = [])
    {
        parse_str($queryString, $result);
        return array_merge($result, $params);
    }
}