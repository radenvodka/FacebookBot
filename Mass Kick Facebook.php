<?php
error_reporting(0);
/**
 * @Author: Eka Syahwan
 * @Date:   2017-11-06 22:54:36
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2018-04-16 22:35:25
 */
class Modules
{
  public function sdata($url = null , $custom = null){
    mkdir('cookies'); // pleas don't remove
    $ch     = array();
    $mh     = curl_multi_init();
    $total    = count($url);
    $allrespons = array();
    for ($i = 0; $i < $total; $i++) {
      if($url[$i]['cookies']){
        $cookies    = $url[$i]['cookies'];
      }else{
        $cookies    = 'cookies/shc-'.md5($this->cookies())."-".time().'.txt'; 
      }
      $ch[$i]       = curl_init();
      $threads[$ch[$i]]   = array(
        'proses_id' => $i,
        'url'     => $url[$i]['url'],
        'cookies'   => $cookies, 
        'note'    => $url[$i]['note'],
      );
        curl_setopt($ch[$i], CURLOPT_URL, $url[$i]['url']);
      if($custom[$i]['gzip']){
        curl_setopt($ch[$i], CURLOPT_ENCODING , "gzip");
      }
      if($custom[$i]['debug_header']){
        curl_setopt($ch[$i], CURLOPT_HEADER , true);
      }else{
          curl_setopt($ch[$i], CURLOPT_HEADER, false);
      }
        curl_setopt($ch[$i], CURLOPT_COOKIEJAR,  $cookies);
          curl_setopt($ch[$i], CURLOPT_COOKIEFILE, $cookies);
        if($custom[$i]['rto']){
          curl_setopt($ch[$i], CURLOPT_TIMEOUT, $custom[$i]['rto']);
        }else{
          curl_setopt($ch[$i], CURLOPT_TIMEOUT, 60);
        }
        if($custom[$i]['header']){
          curl_setopt($ch[$i], CURLOPT_HTTPHEADER, $custom[$i]['header']);
        }
        if($custom[$i]['post']){
          if(is_array($custom[$i]['post'])){
            $query = http_build_query($custom[$i]['post']);
          }else{
            $query = $custom[$i]['post'];
          }
          curl_setopt($ch[$i], CURLOPT_POST, true);
          curl_setopt($ch[$i], CURLOPT_POSTFIELDS, $query);
        }
        if($custom[$i]['proxy']){
          curl_setopt($ch[$i], CURLOPT_PROXY,   $custom[$i]['proxy']['ip']);
          curl_setopt($ch[$i], CURLOPT_PROXYPORT, $custom[$i]['proxy']['port']);
          if( $custom[$i]['proxy']['type'] ){
            curl_setopt($ch[$i], CURLOPT_PROXYTYPE, $custom[$i]['proxy']['type']);
          }
        }
        curl_setopt($ch[$i], CURLOPT_VERBOSE, false);
        curl_setopt($ch[$i], CURLOPT_CONNECTTIMEOUT , 0);
        curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch[$i], CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch[$i], CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch[$i], CURLOPT_SSL_VERIFYHOST, false); 
          if($custom[$i]['uagent']){
          curl_setopt($ch[$i], CURLOPT_USERAGENT, $custom[$i]['uagent']);
        }else{
        curl_setopt($ch[$i], CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) CriOS/42.0.2311.47 Mobile/12F70 Safari/600.1.4");
        }
        curl_multi_add_handle($mh, $ch[$i]);
    }
    $active = null;
    do {
        $mrc = curl_multi_exec($mh, $active);
        while($info = curl_multi_info_read($mh))
        {  
          $threads_data = $threads[$info['handle']];
          $result     = curl_multi_getcontent($info['handle']);
            $info       = curl_getinfo($info['handle']);
            $allrespons[]   = array(
              'data'    => $threads_data, 
              'respons'   => $result,
              'json'    => json_decode($result,true),
              'info'    => array(
                'url'     => $info['url'],
                'http_code' => $info['http_code'], 
              ),
            );
            curl_multi_remove_handle($mh, $info['handle']);
        }
        usleep(100);
    } while ($active);
    curl_multi_close($mh);
    return $allrespons;
  }
  public function cookies($length = 60) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString.time().rand(10000000,99999999);
  }
  public function session_remove($arrayrespons){
    foreach ($arrayrespons as $key => $value) {
      unlink($value['data']['cookies']);
    }
  }
}
$sdata = new Modules();


////////////////////////////// CONFIG /////////////////////////

$cookies = 'cookies you';
$idGroups = '1720663744881691';
$postDataRemove = 'fb_dtsg=AQFhMfleovD0%3AAQGDvMRoxR3b&confirm=true&__user=100006429181824&__a=1&__dyn=7AgNe-4am2d2u6aJGeFxqeCwDKEKEW8x2C-C267UqwWhE98nwgU6C7WUC3eEbbyEjKewXyUdUOdwJKdwAxi5-u58O5U7SidwBx62q3PxqrUfovwb6u0w899UhCK6oc828wgovy88E5S48SexeEgy9E6m8HgoUhyo8KV8vBofEgxa9whKl3846&__req=10&__be=1&__pc=PHASED%3ADEFAULT&__rev=3733004&jazoest=265817010477102108101111118684858658171681187782111120825198&__spin_r=3733004&__spin_b=trunk&__spin_t=1521395896';


while (TRUE) {
  $head[] = array(
  'header' => array(
    "cookie: ".$cookies,
    "upgrade-insecure-requests: 1",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36"
  ), 
);
$url[] = array(
  'url' => 'https://web.facebook.com/ajax/browser/list/group_confirmed_members/?gid='.$idGroups.'&order=default&view=list&limit=200&sectiontype=all_members&cursor=&start=15&dpr=1.5&__user=&__a=1&__dyn=&__req=8y&__be=1&__pc=PHASED%3ADEFAULT&__rev=3732955&__spin_r=3732955&__spin_b=trunk&__spin_t=1521394076', 
);

$respons = $sdata->sdata($url,$head);
foreach ($respons as $key => $value) {
  preg_match_all('/"MEMBERS_TAB_MEMBER_CLICK","(.*?)"/', $value['respons'] , $jso);
  foreach ($jso[1] as $key => $value) {
    if($value != "100006429181824" || $value != "100007098106047" || $value != "100001124946987" || $value != "100008477988543" || $value !="100008988107617"){
      $data[] = $value;
    }
  }
}

unset($head);unset($url);

foreach ($data as $key => $idMember) {
    $head[] = array(
    'header' => array(
      "cookie: ".$cookies,
      "upgrade-insecure-requests: 1",
      "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36"
    ), 
    'post' => $postDataRemove,
  );
  $url[] = array(
    'url' => 'https://web.facebook.com/ajax/groups/members/remove.php?group_id='.$idGroups.'&uid='.$idMember.'&is_undo=0&source=profile_browser&dpr=1.5', 
    'note' => $idMember,
  );
}

$respons = $sdata->sdata($url,$head);
foreach ($respons as $key => $value) {
  echo "[+] USER ID : ".$value[data][note]." => KCIKED ! (".$value[info][http_code].")\r\n";
}

unset($head);unset($url); unset($data);
}