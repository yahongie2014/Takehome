<?php
/*
 * i work on simple helper function like Laravel Framework it make me next Taylor Otwell LOL!!! XD Just Kidding
*/

use Includes\FactoryDB;

function getResult()
{
    $model = new FactoryDB();
    $arrinner = array(
        0 => [
            "baseKey" => "id",
            "foreignKey" => "product_id",
            "relatedTable" => "products",
        ],
        1 => [
            "baseKey" => "id",
            "foreignKey" => "rate_id",
            "relatedTable" => "shipping_rates",
        ]

    );
    $Selectedcolumns = "`cart`.`product_id` as ProductID ,`cart`.`id` as CartID ,`cart`.`vat` as CartVat,
    `cart`.`rate_id` as ShippingID,`cart`.`shipping` as CartShipping,`cart`.`price` as CartPrice ,
    `cart`.`total` as CartTotal, `shipping_rates`.`country` as ShippingCountry, `shipping_rates`.`rate` as ShippingPrice,
    `products`.`Item_type` as ProductName ,`products`.`weight` as ProductWeight";
    $relation = $model->morphToMany("cart", $arrinner, "$Selectedcolumns");

    return $relation;
}

function excute()
{
    if (isset($_POST['cmd'])) {
        exec('php coder createCart  --product="Blouse","T-shirt","Pants","Sweatpants","Jacket","Shoes"');
    }

}

function url($string)
{
    $SITEURL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    return $SITEURL . $string;
}

function dd($string)
{
    return var_dump($string) and die();
}

function view($string)
{
    return header('Location: ' . $string);
}

function check_success($check)
{
    $siteurl = urlencode($_SERVER['SERVER_NAME']);
    $check = json_decode($siteurl, true);
    return $check;
}

function http_respond($data = array())
{
    if (is_callable('fastcgi_finish_request')) {
        session_write_close();
        fastcgi_finish_request();
        return;
    }

    ignore_user_abort(true);
    ob_start();
    $serverProtocol = filter_input(INPUT_SERVER, 'SERVER_PROTOCOL', FILTER_SANITIZE_STRING);
    header($serverProtocol . ' 200 OK');
    header('Content-Encoding: none');
    header('Content-Length: ' . ob_get_length());
    header('Connection: close');
    ob_end_flush();
    ob_flush();
    flush();
}

function get_ip_address()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP))
                    return $ip;
            }
        } else {
            if (filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && filter_var($_SERVER['HTTP_X_FORWARDED'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && filter_var($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && filter_var($_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_FORWARDED'];
    return $_SERVER['REMOTE_ADDR'];
}


function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";
    // First get the platform?
    if (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    } elseif (preg_match('/iphone|IPhone/i', $u_agent)) {
        $platform = 'IPhone Web';
    } elseif (preg_match('/android|Android/i', $u_agent)) {
        $platform = 'Android Web';
    } else if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $u_agent)) {
        $platform = 'Mobile';
    } else if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern,
        'ip_address' => get_ip_address()
    );
}