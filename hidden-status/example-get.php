<?php
require_once("sdata-modules.php");
/**
 * @Author: Eka Syahwan
 * @Date:   2017-12-11 17:01:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2018-06-10 18:12:33
 */

$access_token = 'EAACEdEose0cBAF6GZAtGvUH35ZCH4oqxPSYZC5KgDQIduabvdIBy0ZCvRRZCUigMuWcSD6yubRh8yVOv9N5ZCoZCZCbZATv4BboV247zwz5zK4KPq5SkPvnQERkBm3WrIg6Divtno4a8ULIs2WTBJovTVgMmcVBFNq5M7iDfOGvNOZA90CwMucUeR1yrDCz2PCbHXpkgDxNBz1QgZDZD';
$cookies 		= 'sb=vPhxWpQfQbIorDEyKRqRsyR9; datr=vPhxWnwZUjE38srn1oJFQuca; locale=id_ID; dpr=1.25; m_pixel_ratio=1.25; c_user=100006429181824; xs=40%3AnfKI_byBZX95-Q%3A2%3A1528569854%3A2927%3A11262; pl=n; wd=1536x759; fr=0gh7cjnIyBmKuQQFK.AWXzJxynF74670Mcb6ukDtpRVaQ.Bacfi8.ad.Fsc.0.0.BbHMgq.AWVGuaiz; act=1528613014108%2F16; presence=EDvF3EtimeF1528613018EuserFA21B06429181824A2EstateFDt3F_5b_5dG528613018324CEchFDp_5f1B06429181824F195CC';

$prof_id 		= ''; // id profile fb

####################  STATUS ##############
$url[] = array(
	'url' => 'https://graph.facebook.com/v3.0/me?fields=feed&access_token='.$access_token, 
);
$result = $sdata->sdata($url);
$result = json_decode($result[0][respons],true);

foreach ($result[feed][data] as $key => $ids) {
	$ids = explode("_", $ids['id']);
	//if(!preg_match("/".$ids[id]."/", file_get_contents("log.txt"))){
		$data['id'][] = $ids[1];
	//}
}

#############################################

unset($url);

foreach ($data['id'] as $key => $value_id) {
	$hea[] = array(
	'header' => array(
	    "cache-control: no-cache",
	    "connection: keep-alive",
	    "content-type: application/x-www-form-urlencoded",
	    "cookie: ".$cookies,
	    "host: www.facebook.com",
	    "origin: https://www.facebook.com",
	    "referer: https://www.facebook.com/eka.syahwan.id",
	    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36"), 
	    'post' => 'av='.$prof_id.'&options_button_id=u_fetchstream_6_t&story_location=profile_self&initial_action_name=HIDE_FROM_TIMELINE&hideable_token=MzI1MTC3MLWwMDM0MTWzNK5zzSsJLkksKS12LkpNLMnMzwsuyS-qrKszNDAwMDAzMbI0tDC0MDKpqzOoAwA&story_permalink_token=S%3A_I'.$prof_id.'%3A'.$value_id.'&nctr[_mod]=pagelet_timeline_recent&__user='.$prof_id.'&__a=1&__dyn=7AgNe-4amaAxd2u6aJGeFxqeCwDKEyGgS8zQC-C267Uqzob4q2i5U4e1FDxtu9xK5WwADKaxeUW2ei4GDgdUHzobrCCx3yosgmVV8-cxu5od8cEiwBx61zUK5p8nAgqx-Euxm4E6qum2S2G68y2iu4rGUogoxu2N3QWwgFojgmKbyEky8-uazu2Oq6ogUK8GE_Wx28Cx6789EOEyh7yVe4oC23QF8mDhm4S2eh4yEOm9BK9zU-4Kq7oG49UPCxi4oyuFUO7EOipUCh2FUzCDK3y&__req=3s&__be=1&__pc=PHASED%3ADEFAULT&__rev=3990744&fb_dtsg=AQFWXxMKd41T%3AAQG77fwy6ITb&jazoest=26581708788120777510052498458658171555510211912154738498&__spin_r=3990744&__spin_b=trunk&__spin_t=1528612448&ft[tn]=WW-R-R&ft[top_level_post_id]='.$value_id.'&ft[tl_objid]='.$value_id.'&ft[throwback_story_fbid]='.$value_id.'&ft[page_id]=759863570703626&ft[page_insights][759863570703626][page_id]=759863570703626&ft[page_insights][759863570703626][role]=1&ft[page_insights][759863570703626][actor_id]='.$prof_id.'&ft[page_insights][759863570703626][psn]=EntStatusCreationStory&ft[page_insights][759863570703626][attached_story][role]=1&ft[page_insights][759863570703626][attached_story][page_id]=759863570703626&ft[page_insights][759863570703626][attached_story][post_context][story_fbid]=1855712924452013&ft[page_insights][759863570703626][attached_story][post_context][publish_time]=1528378490&ft[page_insights][759863570703626][attached_story][post_context][story_name]=EntStatusCreationStory&ft[page_insights][759863570703626][attached_story][post_context][object_fbtype]=266&ft[page_insights][759863570703626][attached_story][actor_id]=759863570703626&ft[page_insights][759863570703626][attached_story][psn]=EntStatusCreationStory&ft[page_insights][759863570703626][attached_story][sl]=4&ft[page_insights][759863570703626][attached_story][dm][isShare]=0&ft[page_insights][759863570703626][attached_story][dm][originalPostOwnerID]=0&ft[page_insights][759863570703626][sl]=4&ft[page_insights][759863570703626][dm][isShare]=0&ft[page_insights][759863570703626][dm][originalPostOwnerID]=0&ft[page_insights][759863570703626][targets][0][page_id]=759863570703626&ft[page_insights][759863570703626][targets][0][actor_id]='.$prof_id.'&ft[page_insights][759863570703626][targets][0][role]=1&ft[page_insights][759863570703626][targets][0][post_id]=1855712924452013&ft[page_insights][759863570703626][targets][0][share_id]=0&ft[fbfeed_location]=10&ft[thid]='.$prof_id.'%3A306061129499414%3A2%3A0%3A1530428399%3A-490538002364026967&confirmed=1',
	);
	$url[] = array(
		'url' => 'https://web.facebook.com/ajax/feed/filter_action/dialog_direct_action/?dpr=1.5',
		'note' => $value_id,
	);
}
$result = $sdata->sdata($url , $hea);
foreach ($result as $key => $value) {
	echo "[+] ".$value[data][note]." > ";
	if(preg_match("/Kiriman ini telah disembunyikan dari linimasa Anda/",  $value[respons])){
		echo "Status telah disembunyikan\r\n";
	}else{
		echo "Status gagal disembunyikan\r\n";
	}

	$f = fopen("log.txt", "a+");
	fwrite($f, $value[data][note]."\r\n");
	fclose($f);
}
sleep(30);