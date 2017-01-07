<?php
     define('BOT_TOKEN','ãÍá Êæ˜ä');
	 
     $update = json_decode(urldecode(file_get_contents('php://input')));
     $chat_id = $update->message->chat->id;
     $chat_name = $update->message->chat->first_name;
     $msg_id = $update->message->message_id;
     $msg_text = $update->message->text;
     $shorten = json_decode(urldecode(file_get_contents('https://api-ssl.bitly.com/v3/shorten?access_token=f2d0b4eabb524aaaf22fbc51ca620ae0fa16753d&longUrl='.$msg_text)));
     $short_ok = $shorten->status_code;
     $short = str_replace('http://','',$shorten->data->url);
     $shorten2 = json_decode(urldecode(file_get_contents('https://do0.ir/send.php?key=oysof&ver=2.5&type=get&L='.$msg_text)));
     $short2_ok = $shorten2->success;
     $short2 = 'do0.ir/'.$shorten2->short;
	 define('API_TELEGRAM','https://api.telegram.org/bot'.BOT_TOKEN.'/');
function typing($chat_id)
{
file_get_contents(API_TELEGRAM.'sendChatAction?chat_id='.$chat_id.'&action=typing');
}

function sendMessage($chat_id,$text,$message_id)
{
file_get_contents(API_TELEGRAM.'sendMessage?chat_id='.$chat_id.'&text='.$text.'&reply_to_message_id='.$message_id.'&disable_web_page_preview=true');
}

if ($msg_text == '/start') 
{
typing($chat_id);
sendMessage($chat_id,"ÓáÇã $chat_name ?????");
}
elseif ($short_ok == '200' && $short2_ok = 'true')
{
typing($chat_id);
sendMessage($chat_id,$short,$msg_id);
sendMessage($chat_id,$short2,$msg_id);
}
else
{
typing($chat_id);
sendMessage($chat_id,'??ÎØÇ??áØÝÇ íå áíä˜ ÈÝÑÓÊíÏ.??ÏÞÊ ˜äíÏ áíä˜ ÈÇ http:// íÇ https:// ÔÑæÚ ÔæÏ??',$msg_id);
}
?>
