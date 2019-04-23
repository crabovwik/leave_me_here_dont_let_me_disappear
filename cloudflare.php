<?php

// set_real_ip_from ...;

$ip_v4_list = file_get_contents('https://www.cloudflare.com/ips-v4');
$ip_v6_list = file_get_contents('https://www.cloudflare.com/ips-v6');

$ip_list = [];
if ($ip_v4_list) {
	$ip_list  = array_merge($ip_list, explode("\n", $ip_v4_list));
}

if ($ip_v6_list) {
	$ip_list = array_merge($ip_list, explode("\n", $ip_v6_list));
}

$ip_list = array_map('trim', $ip_list);
$ip_list = array_filter($ip_list);

$result = '';
foreach ($ip_list as $ip) {
	$result .= "set_real_ip_from {$ip};\n";
}

echo $result;
