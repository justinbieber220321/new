<?php

use App\Contracts\Facades\ChannelLog;
use App\Helpers\Supports\Url;
use App\Model\Entities\Deposit;
use App\Model\Entities\Withdraw;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

if (!function_exists('getConfig')) {
    function getConfig($key, $default = '')
    {
        return config('config.' . $key, $default);
    }
}

if (!function_exists('getConfigFrontend')) {
    function getConfigFrontend($key, $default = '')
    {
        return config('config.frontend.' . $key, $default);
    }
}

if (!function_exists('getConfigBackend')) {
    function getConfigBackend($key, $default = '')
    {
        return config('config.backend.' . $key, $default);
    }
}

if (!function_exists('delFlagOn')) {
    function delFlagOn()
    {
        return getConfig('del_flag.active', 0);
    }
}

if (!function_exists('delFlagOff')) {
    function delFlagOff()
    {
        return getConfig('del_flag.disable', 1);
    }
}

if (!function_exists('statusOn')) {
    function statusOn()
    {
        return getConfig('user.status.active', 1);
    }
}

if (!function_exists('statusOff')) {
    function statusOff()
    {
        return getConfig('user.status.block', 2);
    }
}

if (!function_exists('statusOnAlias')) {
    function statusOnAlias()
    {
        return getConfig('status_alias.active');
    }
}

if (!function_exists('statusOffAlias')) {
    function statusOffAlias()
    {
        return getConfig('status_alias.disable');
    }
}

if (!function_exists('genderBoy')) {
    function genderBoy()
    {
        return getConfig('gender.boy', 1);
    }
}

if (!function_exists('genderGirl')) {
    function genderGirl()
    {
        return getConfig('gender.girl', 0);
    }
}

if (!function_exists('genderBoyAlias')) {
    function genderBoyAlias()
    {
        return transF('form.' . getConfig('gender_alias.boy'));
    }
}

if (!function_exists('genderGirlAlias')) {
    function genderGirlAlias()
    {
        return transF('form.' . getConfig('gender_alias.girl'));
    }
}

if (!function_exists('getBackendPagination')) {
    function getBackendPagination($perPage = '')
    {
        $perPage = empty($perPage) ? getConfig('pagination.backend', 20) : $perPage;
        return $perPage;
    }
}

if (!function_exists('getFrontendPagination')) {
    function getFrontendPagination($perPage = '')
    {
        $perPage = empty($perPage) ? getConfig('pagination.frontend', 20) : $perPage;
        return $perPage;
    }
}

if (!function_exists('transMessage')) {
    function transMessage($key, $params = [], $default = '')
    {
        return empty(trans('messages.' . $key, $params)) ? $default : trans('messages.' . $key, $params);
    }
}

if (!function_exists('backendRouter')) {
    /**
     * @param $routeName
     * @param array $params
     * @return mixed
     */
    function backendRouter($routeName, $params = [])
    {
        return route('backend.' . $routeName, $params);
    }
}

if (!function_exists('backendRouterName')) {
    /**
     * @param $routeName
     * @return mixed
     */
    function backendRouterName($routeName)
    {
        return 'backend.' . $routeName;
    }
}

if (!function_exists('frontendRouter')) {
    /**
     * @param $routeName
     * @param array $params
     * @return mixed
     */
    function frontendRouter($routeName, $params = [])
    {
        return route('frontend.' . $routeName, $params);
    }
}

if (!function_exists('frontendRouterName')) {
    /**
     * @param $routeName
     * @return mixed
     */
    function frontendRouterName($routeName)
    {
        return 'frontend.' . $routeName;
    }
}

/* Redirect */
if (!function_exists('backSystemError')) {
    function backSystemError($msg = '')
    {
        $msg = empty($msg) ? transMessage('system_error') : $msg;
        return redirect()->back()->with('notification_error', $msg);
    }
}

if (!function_exists('backSystemSuccess')) {
    function backSystemSuccess($msg = '')
    {
        $msg = empty($msg) ? transMessage('success') : $msg;
        return redirect()->back()->with('notification_success', $msg);
    }
}

if (!function_exists('backSuccess')) {
    function backSuccess($msg = '')
    {
        $msg = empty($msg) ? transMessage('success') : $msg;
        return redirect()->back()->with('notification_success', $msg);
    }
}

if (!function_exists('backError')) {
    function backError($msg = '')
    {
        $msg = empty($msg) ? transMessage('system_error') : $msg;
        return redirect()->back()->with('notification_error', $msg);
    }
}

if (!function_exists('backRouteSuccess')) {
    function backRouteSuccess($routeName = '', $msg = '', $params = [])
    {
        $msg = empty($msg) ? transMessage('success') : $msg;
        return redirect()->route($routeName, $params)->with('notification_success', $msg);
    }
}

if (!function_exists('backRouteError')) {
    function backRouteError($routeName = '', $msg = '', $params = [])
    {
        $msg = empty($msg) ? transMessage('system_error') : $msg;
        return redirect()->route($routeName, $params)->with('notification_error', $msg);
    }
}
/* End redirect */

if (!function_exists('arrayGet')) {
    function arrayGet($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (!function_exists('arrayLast')) {
    function arrayLast($array)
    {
        return !empty($array) ? $array[count($array)-1] : null;
    }
}

if (!function_exists('sql_binding')) {

    function sql_binding($sql, $bindings)
    {
        $boundSql = str_replace(['%', '?'], ['%%', '%s'], $sql);
        foreach ($bindings as &$binding) {
            if ($binding instanceof \DateTime) {
                $binding = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $binding = "'$binding'";
            }
        }
        $boundSql = vsprintf($boundSql, $bindings);
        return $boundSql;
    }
}

if (!function_exists('numberFormatByDot')) {

    function numberFormatByDot($value)
    {
        return number_format($value, 0, ',', '.');
    }
}

if (!function_exists('formatPriceCurrency')) {

    function formatPriceCurrency($value = null)
    {
        $result = is_null($value) ? '' : number_format((float)$value, 2, ',', ' ');

        if (substr($result, -3) == ',00') {
            return substr($result, 0, strlen($result) - 3);
        }

        if (substr($result, -2) == ',0') {
            return substr($result, 0, strlen($result) - 2);
        }

        return $result;
    }
}

if (!function_exists('getSTTBackend')) {

    function getSTTBackend($entities, $index)
    {
        return getBackendPagination() * ($entities->currentPage() -1) + 1 + $index;
    }
}

if (!function_exists('frontendGetSTT')) {

    function frontendGetSTT($entities, $index)
    {
        return getFrontendPagination() * ($entities->currentPage() -1) + 1 + $index;
    }
}

if (!function_exists('getBackUrl')) {

    function getBackUrl()
    {
        return Url::getBackUrl();
    }
}

if (!function_exists('addBackUrl')) {

    function addBackUrl($routeName, $params = [])
    {
        return Url::addbackurl($routeName, $params);
    }
}

if (!function_exists('trimValuesArray')) {

    function trimValuesArray($arr = [])
    {
        return array_map('trim', $arr);
    }
}

if (!function_exists('logErrorNotFound')) {

    function logErrorNotFound($msg = '')
    {
        $msg = empty($msg) ? "Not found entity" : '';
        return Log::error($msg);;
    }
}

if (!function_exists('logError')) {

    function logError($msg = '', $params = [])
    {
        return ChannelLog::write('error', $msg, $params);
    }
}

if (!function_exists('convertViToEn')) {
    function convertViToEn($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);

        return $str;
    }
}

if (!function_exists('getPathUploadDocument')) {
    function getPathUploadDocument($str)
    {
        $str = convertViToEn($str);
        $str = strtolower($str);

        $string = str_replace(' ', '-', $str); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('getFileNameDocument')) {
    /**
     * @return string
     * Get file name document for upload document PDF lession
     */
    function getFileNameDocument($file)
    {
        $arrTmp = explode('/', $file);
        $arrTmp2 = explode('_', arrayLast($arrTmp));
        $documents['name'] = arrayLast($arrTmp2);
        $documents['path'] = $file;

        return $documents;
    }
}

if (!function_exists('frontendGetUserId')) {

    function frontendGetUserId()
    {
        return empty(\Auth::guard()->user()) ? '' : \Auth::guard()->user()->id;
    }
}

if (!function_exists('getCurrentUser')) {

    function getCurrentUser()
    {
        return empty(\Auth::guard()->user()) ? '' : \Auth::guard()->user();
    }
}

if (!function_exists('getCurrentUserId')) {

    function getCurrentUserId()
    {
        return empty(\Auth::guard()->user()) ? '' : \Auth::guard()->user()->id;
    }
}

if (!function_exists('toHome')) {

    function toHome()
    {
        return redirect()->route('home');
    }
}

if (!function_exists('frontendGetTextQuestionColor')) {

    function frontendGetTextQuestionColor($dapAn, $dapAnDung, $isSubmited)
    {
        return $isSubmited && $dapAn == $dapAnDung ? "text-right" : "text-wrong";
    }
}

if (!function_exists('getStartTimeExaming')) {

    function getStartTimeExaming()
    {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('getEndTimeExaming')) {

    function getEndTimeExaming()
    {
        $deadline = getConfigFrontend('de_thi.time_test');
        $time = date("Y-m-d H:i:s", strtotime("+$deadline minutes"));
        return $time;
    }
}

if (!function_exists('frontendIsUserAccessCourse')) {

    function frontendIsUserAccessCourse($courseID)
    {
        return Auth::guard()->user() && (Auth::guard()->user())->allowAccessCourse($courseID);
    }
}

if (!function_exists('frontendIsUserAccessDeThi')) {

    function frontendIsUserAccessDeThi($ctDeThi)
    {
        return Auth::guard()->user() && (Auth::guard()->user())->allowAccessDeThi($ctDeThi);
    }
}

if (!function_exists('isPast')) {
    function isPast($time)
    {
        return strtotime($time) < strtotime(now());
    }
}

if (!function_exists('isFuture')) {
    function isFuture($time)
    {
        return strtotime($time) > strtotime(now());
    }
}

// Auth
if (!function_exists('backendGuard')) {
    function backendGuard()
    {
        return Auth::guard('admins');
    }
}

if (!function_exists('backendCurrentUser')) {
    function backendCurrentUser()
    {
        return Auth::guard('admins')->user();
    }
}

if (!function_exists('frontendGuard')) {
    function frontendGuard()
    {
        return Auth::guard('users');
    }
}

if (!function_exists('frontendCurrentUser')) {
    function frontendCurrentUser()
    {
        return Auth::guard('users')->user();
    }
}

if (!function_exists('frontendCurrentUserId')) {
    function frontendCurrentUserId()
    {
        return frontendCurrentUser() ? frontendCurrentUser()->id : '';
    }
}

if (!function_exists('frontendIsLogin')) {
    /**
     * @return mixed
     */
    function frontendIsLogin()
    {
        return frontendGuard()->check();
    }
}

if (!function_exists('backendIsLogin')) {
    /**
     * @return mixed
     */
    function backendIsLogin()
    {
        return backendGuard()->check();
    }
}
// End auth

if (!function_exists('extractNameFromEmail')) {

    function extractNameFromEmail($email)
    {
        $parts = explode("@", $email);
        $username = arrayGet($parts, 0);
        return $username;
    }
}

if (!function_exists('getSiteName')) {

    function getSiteName()
    {
        return getConfig('system.SITE_NAME');
    }
}

if (!function_exists('getSiteTitle')) {

    function getSiteTitle()
    {
        return getConfig('system.SITE_TITLE');
    }
}

if (!function_exists('getSitePhone')) {

    function getSitePhone()
    {
        return getConfig('system.SITE_PHONE');
    }
}

if (!function_exists('getSiteMetaTitle')) {

    function getSiteMetaTitle()
    {
        return getConfig('system.META_TITLE');
    }
}

if (!function_exists('getSiteMetaDescription')) {
    function getSiteMetaDescription()
    {
        return getConfig('system.META_DESCRIPTION');
    }
}

if (!function_exists('getEnvX')) {

    function getEnvX($key, $default = '')
    {
        return empty(getConfig('system.' . $key)) ? $default : getConfig('system.' . $key);
    }
}

if (!function_exists('getUpdDate')) {

    function getUpdDate()
    {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('getRouteName')) {

    function getRouteName()
    {
        return \Request::route()->getName();
    }
}

if (!function_exists('getPathImageDefault')) {

    function getPathImageDefault()
    {
        return "/theme/image/profile/default-user.png";
    }
}

if (!function_exists('convertViToEn')) {

    function convertViToEn($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);

        return $str;
    }
}

if (!function_exists('createSlug')) {

    function createSlug($text, $delimiter = '-')
    {
        $text = trim(convertViToEn($text));

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

if (!function_exists('getAddressXrp')) {

    function getAddressXrp()
    {
        return getConfig('coin_base.addressXrp');
    }
}

if (!function_exists('checkHash')) {

    /**
     * @param $normal
     * @param $hashed
     * @return bool
     */
    function checkHash($normal, $hashed)
    {
        return Hash::check($normal, $hashed);
    }
}

if (!function_exists('genOtp')) {
    function genOtp()
    {
        return rand(10000000, 99999999);
    }
}

if (!function_exists('transB')) {

    function transB($key, $params = [], $default = '')
    {
        return empty(trans('backend_text.' . $key, $params)) ? $default : trans('backend_text.' . $key, $params);
    }
}

if (!function_exists('transF')) {

    function transF($key, $params = [], $default = '')
    {
        return empty(trans('frontend_text.' . $key, $params)) ? $default : trans('frontend_text.' . $key, $params);
    }
}

if (!function_exists('transTheme')) {

    function transTheme($key, $params = [], $default = '')
    {
        return empty(trans('theme_text.' . $key, $params)) ? $default : trans('theme_text.' . $key, $params);
    }
}

if (!function_exists('hasRequiredOtpLogin')) {

    function hasRequiredOtpLogin()
    {
        return getConfig('system.LOGIN_CONFIRM_OTP') == getConfig('otp-login.on');
    }
}

if (!function_exists('encode')) {
    function encode($string, $key)
    {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;
        $hash = '';
        for ($i = 0; $i < $strLen; $i++) {
            $ordStr = ord(substr($string, $i, 1));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
        }
        return $hash;
    }
}

if (!function_exists('decode')) {
    function decode($string, $key)
    {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;
        $hash = '';
        for ($i = 0; $i < $strLen; $i += 2) {
            $ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $hash .= chr($ordStr - $ordKey);
        }
        return $hash;
    }
}

if (!function_exists('getTotalDeposit')) {
    function getTotalDeposit($id, $currency = 'USDT')
    {
        return Deposit::where('user_id', '=', $id)
            ->where('currency', '=', $currency)
            ->sum('number');
    }
}

if (!function_exists('getTotalWithdraw')) {
    function getTotalWithdraw($id, $currency = 'USDT')
    {
        return Withdraw::where('user_id', '=', $id)
            ->where('currency', '=', $currency)
            ->sum('number');
    }
}

if (!function_exists('getBalance')) {
    function getBalance($id, $currency = 'USDT')
    {
        return getTotalDeposit($id, $currency) - getTotalWithdraw($id, $currency);
    }
}

if (!function_exists('userAllChildsIds')) {
    function userAllChildsIds(\App\Model\Entities\User $user)
    {
        $all_ids = [];
        if ($user->childrenRecursive->count() > 0) {
            $tmp = $user->childrenRecursive;
            foreach ($tmp as $child) {
                $all_ids[] = $child->user_id;
                $all_ids = array_merge($all_ids, is_array(userAllChildsIds($child)) ? userAllChildsIds($child) : []);
            }
        }
        return $all_ids;
    }
}

if (!function_exists('callApi')) {
    function callApi($link)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $link);
        $content = json_decode($response->getBody(), true);

        return $content;
    }
}

/**
 * Get balance real time from api
 */
if (!function_exists('getBalanceRealtime')) {
    function getBalanceRealtime()
    {
        if (!frontendIsLogin()) {
            return 0;
        }

        $dateTo = date('Y-m-d', strtotime('+1 day', time()));
        $date = date_create(date('Y-m-d'));
        date_sub($date, date_interval_create_from_date_string("365 days"));
        $past = date_format($date, "Y-m-d");
        $endpoint = "https://login.nuxgame.com/api/stat/user_list?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint);
        $dataApi = json_decode($response->getBody(), true);
        $dataUser = [];
        $email = frontendCurrentUser()->email;
//        $email = 'lehung1321@gmail.com'; // fake, not commit
        foreach ($dataApi as $item) {
            if (arrayGet($item, 'email') == $email) {
                $dataUser = $item;
                break;
            }
        }
        $balance = arrayGet($dataUser, 'balance', 0);

        return $balance;
    }
}

if (!function_exists('getDataApi')) {
    function getDataApi() {
        $dateTo = date('Y-m-d', strtotime('+1 day', time()));
        $past =  date('Y-m-d', strtotime('Last Sunday', time()));
        $endpoint = "https://login.nuxgame.com/api/stat/casino_report?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint);
        $dataApi = json_decode($response->getBody(), true);
        return $dataApi;
    }
}

if (!function_exists('getBet')) {
    function getBet($entityUser, $dataApi = [])
    {
        if (!frontendIsLogin()) {
            return 0;
        }

        $dataApi = $dataApi ? $dataApi : getDataApi();

        $userId = $entityUser->user_id;
        $myBet= 0;
        $myWin = 0;
        $myGgr = 0;
        $totalTeamBet = 0;
        $teamWin = 0;
        $teamGgr = 0;

        $idCon = userAllChildsIds($entityUser);

        $countUserDirect = User::delFlagOn()->statusOn()->where('player_code', frontendCurrentUser()->user_id)->count();
        $countUser = 0;
        foreach ($dataApi as $item) {
            if (arrayGet($item, 'user_id') == $userId) {
                $myWin = arrayGet($item, 'wins');
                $myGgr = arrayGet($item, 'ggr');
                $myBet = arrayGet($item, 'turnover', 0);
            }

            if (in_array(arrayGet($item, 'user_id'),  $idCon)) {
                $teamWin += arrayGet($item, 'wins', 0);
                $teamGgr += arrayGet($item, 'ggr', 0);
                $totalTeamBet += arrayGet($item, 'turnover', 0);

                if (arrayGet($item, 'turnover', 0) >= 100) {
                    $countUser++;
                }
            }
        }

        $result = [
            'totalTeamBet' => $totalTeamBet,
            'myBet' => $myBet,
            'myWin' => $myWin,
            'teamWin' => $teamWin,
            'myGgr' => $myGgr,
            'teamGgr' => $teamGgr,
            'countUserDirect' => $countUserDirect,
            'countUser' => $countUser,
        ];

        return $result;
    }
}

if (!function_exists('renderNumber')) {
    function renderNumber($n1, $n2 = 0)
    {
        return formatPriceCurrency((int)$n1 - (int)$n2);
    }
}

