<?php
include "media.php";
include "idst.php";
ob_start();
define('API_KEY','Token');
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}



$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text1 = $message->text;
$file = $message->document;
$file_id = $message->document->file_id;
$photo = $message->audio;
$photo_id = $message->audio->file_id;
$voice = $message->voice;
$voice_id = $message->voice->file_id;
$video = $message->video;
$video_id = $message->video->file_id;
$get_text = file_get_contents("text.txt");
$type = $message->chat->type;
$new = $message->new_chat_member;
$from_id = $message->from->id;

$inlineqt = $update->inline_query->query;
bot('answerInlineQuery',[
        'inline_query_id'=>$update->inline_query->id,    
        'results' => json_encode([[
            'type'=>'article',
            'id'=>base64_encode(rand(5,555)),
            'title'=>'مشاركة مع اصدقائك',
            'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"اهلا بك عزيزي ☘ في بوت ال MediaFire 📥 يمكنك مشاركت ملفاتك 📁 والحصول على رابط تحميلها 📫 وارسال رابط التحميل الى مستخدمي تليجرام 🎈"],
            'reply_markup'=>['inline_keyboard'=>[
                [
                ['text'=>'للدخول الى البوت اضغط هنا ♻️','url'=>'https://telegram.me/MediaFire_Bot']
                ],
                [
                ['text'=>'تابع جديدنا ✨', 'url'=>'https://telegram.me/Set_Web'] 
                ],
                [
                ['text'=>'مطور البوت 🕴', 'url'=>'https://telegram.me/omar_real'] 
                ]
             ]]
        ]])
    ]);


if($new){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>'عذرا ❌ لا يمكنك اضافتي لمجموعات 👥✨',
'reply_to_message_id'=>$message->message_id
]);


bot('kickChatMember', [
'chat_id'=>$chat_id,
'user_id'=>305554427
]);
}

$get_k = file_get_contents('ids.txt');
$users = explode("\n", $get_k);
if($text1 == "/start" && !in_array($chat_id, $users)){
file_put_contents('ids.txt', "\n" . $chat_id, FILE_APPEND);
}

if($text1 != "/start" && $text1 != "/bc" && $text1 != $data && $chat_id == $sudo_id){
file_put_contents('bc.txt', $text1);
}

$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@Set_Web&user_id=".$from_id);
 
 if (strpos($inch , '"status":"left"') !== false ){
bot('sendMessage', [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'text'=>"عذرا ❗يجب عليك الدخول للقناة 🕴🔹\n لكي يمكنك استخدام البوت 🤖🍁" . "\n\n" . "Sorry 📪 You can't Use❗️This bot 🤖\nYou have to ❌ join to the bot channel ♻️",
'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'اضغط هنا للدخول ☘', 'url'=>"https://telegram.me/set_web"]
        ],
         [
          ['text'=>'Click here to join ❇️' , 'url'=>"https://telegram.me/set_web"]
        ],
]

])
]);
}

if($file){
file_put_contents('media.php', "<?php" . "\n" . '$id_file[] = ' . "'$file_id'" . ";");
}

if($voice){
file_put_contents('media.php', "<?php" . "\n" . '$id_voice[] = ' . "'$voice_id'" . ";");
}

if($photo){
file_put_contents('media.php', "<?php" . "\n" . '$id_photo[] = ' . "'$photo_id'" . ";");
}

if($video){
file_put_contents('media.php', "<?php" . "\n" . '$id_video[] = ' . "'$video_id'" . ";");
}

if($text1 && $type == "private" && $text1 != "/start"){
file_put_contents("text.txt", $text1);
}

$users = count($start_ids);
$sudo = 325384922; // ايدي المطور

if($text1 == "/start" && !in_array($chat_id, $start_ids)){
file_put_contents('idst.php', "\n" . '$start_ids[] = ' . $chat_id. ";", FILE_APPEND);
}

if($text1 == "المشتركين" && $chat_id == $sudo){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"العدد هوة: $users"
]);
}

if($text1== "/start" && !in_array($h[1], $h) && !strpos($inch , '"status":"left"') !== false ){
bot('sendmessage', [
'chat_id'=>$chat_id,
    'text'=>'اهلا ✨ بك اختر اللغة 🔻 التي تناسبك 💡' . "\n\n" . 'Welcome ✨ chose the language 🔻 that suits you 💡',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Arabic 🇮🇶', 'callback_data'=>"back"]
        ],
        [
         ['text'=>'English 🇱🇷', 'callback_data'=>"back_en"]
        ],
         [
         ['text'=>'Persian 🇮🇷', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
  ]);
}


if ($text1=="/sudo" && !strpos($inch , '"status":"left"') !== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"المطور 🚹",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>"OmarReal", 'url'=>"https://telegram.me/omar_real"]
],
[
['text'=>'الصفحة الرئيسية 📩', 'callback_data'=>'back']
]

]
])
]);
}

if($text1=="/channel" && !strpos($inch , '"status":"left"') !== false){
   bot('sendmessage',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'تابعنا عبر الروابط للتالية 📩',
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'القناة الرسمية ✅', 'url'=>"https://telegram.me/set_web"]
        ],
        [
        ['text'=>'تيم EVS ✨', 'url'=>"https://telegram.me/TeamEVS"]
        ],
        [
        ['text'=>'فريق لمسة 💡', 'url'=>"https://telegram.me/touch_t"]
        ]
      ]
    ])
        ]);

         }
         
if ($text1 == "/bc" && $chat_id == 325384922){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>'ارسل 📩 ما تريد نشره الان ✨🚹',
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'ارسال ✅', 'callback_data'=>"bc"]
        ],
]
])
]);
}


if(isset($update->callback_query)){
    $callbackMessage = '';
    var_dump(bot('answerCallbackQuery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>$callbackMessage
    ]));
    $chat_id = $update->callback_query->message->chat->id;
    $message_id = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    
if($data == "bc"){
bot('editMessageText', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'تم النشر ✅',
]);



$d = file_get_contents('bc.txt');
for($y=0;$y<count($start_ids); $y++){

bot('sendMessage', [
'chat_id' => $start_ids[$y],
'text' => $d
]);

}
}

if ($data == "lang"){
	bot('editMessageText', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
    'text'=>'اهلا ✨ بك اختر اللغة 🔻 التي تناسبك 💡' . "\n\n" . 'Welcome ✨ chose the language 🔻 that suits you 💡',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Arabic 🇮🇶', 'callback_data'=>"back"]
        ],
        [
         ['text'=>'English 🇱🇷', 'callback_data'=>"back_en"]
        ],
         [
         ['text'=>'Persian 🇮🇷', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
  ]);
}
	
	
	
if($data=="channel" && !strpos($inch , '"status":"left"') !== false){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'تابعنا عبر الروابط للتالية 📩',
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'القناة الرسمية ✅', 'url'=>"https://telegram.me/set_web"]
        ],
        [
        ['text'=>'تيم EVS ✨', 'url'=>"https://telegram.me/TeamEVS"]
        ],
        [
        ['text'=>'فريق لمسة 💡', 'url'=>"https://telegram.me/touch_t"]
        ],
        [
        ['text'=>'الصفحة الرئيسية 📩️', 'callback_data'=>"back"]
        ]
      ]
    ])
        ]);

         }
         
    if($data=="back"){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
 'text'=>'اهلا بك عزيزي ☘ في بوت ال MediaFire 📥 يمكنك مشاركت ملفاتك 📁 والحصول على رابط تحميلها 📫 وارسال رابط التحميل الى مستخدمي تليجرام 🎈',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'قائمة الرفع 📋', 'callback_data'=>"list"]
        ],
        [
         ['text'=>'تابع جديدنا 📪', 'callback_data'=>"channel"]
        ],
        [
         ['text'=>'تغيير اللغة 📚', 'callback_data'=>"lang"]
        ],
        [
          ['text'=>'مطور البوت 🚹','url'=>'https://telegram.me/omar_real'],
          ['text'=>'هل لديك سؤال ❔','url'=>'https://telegram.me/Math_Support_Bot']
        ],
        [
        ['text'=>'شارك البوت 🚹', 'switch_inline_query'=>""]
        ],
      ]
    ])
  ]);
}

if($data=="list"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"اختر الان 📧 ما تريد مشاركته 📪",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'مشاركة ملف 📁', 'callback_data'=>"q1"]
        ],
        [
        ['text'=>'مشاركة فيديو 🎥', 'callback_data'=>"video"]
        ],
       [
        ['text'=>'مشاركة بصمة 📣', 'callback_data'=>"voice"]
        ],
       [
        ['text'=>'مشاركة موسيقى 🎵', 'callback_data'=>"photo"]
        ],
        [
          ['text'=>'عودة ◀️', 'callback_data'=>"back"]
        ]
      ]
    ])
        ]);
}

if($data=="video"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"حسنا ارسل 📩 لي الفديو 🎥 الخاص بك 💎",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'التالي 🔹️', 'callback_data'=>"msg_video"]
        ],
        [
          ['text'=>'عودة ◀️', 'callback_data'=>"list"]
        ]
      ]
    ])
        ]);
}

if($data=="voice"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"حسنا ارسل 📩 لي البصمة 🔔 الخاص بك 💎",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'التالي 🔹️', 'callback_data'=>"msg_voice"]
        ],
        [
          ['text'=>'عودة ◀️', 'callback_data'=>"list"]
        ]
      ]
    ])
        ]);
}

if($data=="photo"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>" حسنا ارسل 📩 لي الموسيقى 🎵 الخاص بك 💎",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'التالي 🔹️', 'callback_data'=>"msg_photo"]
        ],
        [
          ['text'=>'عودة ◀️', 'callback_data'=>"list"]
        ]
      ]
    ])
        ]);
}


if($data=="q1"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"حسنا ارسل 📩 لي الملف 📁 الخاص بك 💎",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'التالي 🔹️', 'callback_data'=>"msg_file"]
        ],
        [
          ['text'=>'عودة ◀️', 'callback_data'=>"list"]
        ]
      ]
    ])
        ]);
}

if($data=="photo2"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'رائع ✨ الان ارسل الرابط  ♻️ الى اصدقائك ليتلقو مشاركتك 🚹 ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'قائمة المشاركة 📋  ️', 'callback_data'=>"list"]
],
]
])
]);
bot("sendmessage", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اضغط هنا](https://telegram.me/MediaFire_Bot?start=$id_photo[0]) 🔶 للدخول الى الرابط ~🔺",
]);
}

if($data == "msg_file"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"اختر النص الذي سوف يضهر فوق الرابط ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'انهاء ❇️️', 'callback_data'=>"q2"]
        ],
        [
        ['text'=>'قائمة التحويلات 🗒', 'callback_data'=>"list"]
        ]
      ]
    ])
]);
}

if($data == "msg_photo"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"اختر النص الذي سوف يضهر فوق الرابط ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'انهاء ❇️️', 'callback_data'=>"photo2"]
        ],
        [
        ['text'=>'قائمة التحويلات 🗒', 'callback_data'=>"list"]
        ]
      ]
    ])
]);
}

if($data == "msg_voice"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"اختر النص الذي سوف يضهر فوق الرابط ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'انهاء ❇️️', 'callback_data'=>"voice2"]
        ],
        [
        ['text'=>'قائمة التحويلات 🗒', 'callback_data'=>"list"]
        ]
      ]
    ])
]);
}

if($data == "msg_video"){
bot('EditMessageText', [
'chat_id'=>$chat_id, 
'text'=>"اختر النص الذي سوف يضهر فوق الرابط ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'انهاء ❇️️', 'callback_data'=>"video2"]
        ],
        [
        ['text'=>'قائمة التحويلات 🗒', 'callback_data'=>"list"]
        ]
      ]
    ])
]);
}

if($data=="video2"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'رائع ✨ الان ارسل الرابط  ♻️ الى اصدقائك ليتلقو مشاركتك 🚹 ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'قائمة المشاركة 📋  ️', 'callback_data'=>"list"]
],
]
])
]);
bot("sendmessage", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اضغط هنا](https://telegram.me/MediaFire_Bot?start=$id_video[0]) 🔶 للدخول الى الرابط ~🔺",
]);
}

if($data=="voice2"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'رائع ✨ الان ارسل الرابط  ♻️ الى اصدقائك ليتلقو مشاركتك 🚹 ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'قائمة المشاركة 📋  ️', 'callback_data'=>"list"]
],
]
])
]);
bot("sendmessage", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text"  . "\n\n" . "[اضغط هنا](https://telegram.me/MediaFire_Bot?start=$id_voice[0]) 🔶 للدخول الى الرابط ~🔺",
]);
}
if($data == "q2"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'رائع ✨ الان ارسل الرابط  ♻️ الى اصدقائك ليتلقو مشاركتك 🚹 ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'قائمة المشاركة 📋  ️', 'callback_data'=>"list"]
],
]
])
]);
bot('sendmessage', [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اضغط هنا](https://telegram.me/MediaFire_Bot?start=$id_file[0]) 🔶 للدخول الى الرابط ~🔺",
]);
}



if($data=="channel_en" && !strpos($inch , '"status":"left"') !== false){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'Contact us 🚹 by this channels ♻️',
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'Official channel ✅', 'url'=>"https://telegram.me/set_web"]
        ],
        [
        ['text'=>'EvsTeam ✨', 'url'=>"https://telegram.me/TeamEVS"]
        ],
        [
        ['text'=>'TouchTeam💡', 'url'=>"https://telegram.me/touch_t"]
        ],
        [
        ['text'=>'Home 🏠', 'callback_data'=>"back_en"]
        ]
      ]
    ])
        ]);

         }
         
    if($data=="back_en"){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
 'text'=>'Hi 💌 My dear welcome to ✨ MediaFire Bot 🤖 You can share your files 📁 to telegram users 🚹 from this bot',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Share list 📋', 'callback_data'=>"list_en"]
        ],
        [
         ['text'=>'Contact Us  📪', 'callback_data'=>"channel_en"]
        ],
        [
         ['text'=>'Change the lang 📚', 'callback_data'=>"lang"]
        ],
        [
        ['text'=>'Share The Bot 🤖', 'switch_inline_query'=>""]
        ],
        [
          ['text'=>'Bot sudo  🚹','url'=>'https://telegram.me/omar_real']
          ],
          [
          ['text'=>'Do you have a question  ❔','url'=>'https://telegram.me/Math_Support_Bot']
        ],
      ]
    ])
  ]);
}

if($data=="list_en"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"Choose Now 📧 what you want to share  📪",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'Share file 📁', 'callback_data'=>"q1_en"]
        ],
        [
        ['text'=>'Share video 🎥', 'callback_data'=>"video_en"]
        ],
       [
        ['text'=>'Share voice 📣', 'callback_data'=>"voice_en"]
        ],
       [
        ['text'=>'Share music 🎵', 'callback_data'=>"photo_en"]
        ],
        [
          ['text'=>'Back ◀️', 'callback_data'=>"back_en"]
        ]
      ]
    ])
        ]);
}

if($data=="video_en"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"ok ✨ send me your video ➖🎥",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'Next🔹️', 'callback_data'=>"msg_video_en"]
        ],
        [
          ['text'=>'Back ◀️', 'callback_data'=>"list_en"]
        ]
      ]
    ])
        ]);
}

if($data=="voice_en"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"ok ✨ send me your voice ➖🔔",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'Next🔹️', 'callback_data'=>"msg_voice_en"]
        ],
        [
          ['text'=>'Back ◀️', 'callback_data'=>"list_en"]
        ]
      ]
    ])
        ]);
}

if($data=="photo_en"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"ok ✨ send me your song ➖🎵",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'Next🔹️', 'callback_data'=>"msg_photo_en"]
        ],
        [
          ['text'=>'Back ◀️', 'callback_data'=>"list_en"]
        ]
      ]
    ])
        ]);
}


if($data=="q1_en"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"ok ✨ send me your file ➖📁",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'Next🔹️', 'callback_data'=>"msg_file_en"]
        ],
        [
          ['text'=>'Back ◀️', 'callback_data'=>"list_en"]
        ]
      ]
    ])
        ]);
}

if($data=="photo2_en"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'Nice ✨ Now Send the link ♻️ to your friends ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'Back To Share List 📋  ️', 'callback_data'=>"list_en"]
],
]
])
]);
bot("sendmessage", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[Clic here](https://telegram.me/MediaFire_Bot?start=$id_photo[0]) 🔶 For join to the link ~🔺",
]);
}

if($data == "msg_file_en"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"Type the text that will be on the link ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'Finish ✨', 'callback_data'=>"q2_en"]
        ],
        [
        ['text'=>'Convert list 🗒', 'callback_data'=>"list_en"]
        ]
      ]
    ])
]);
}

if($data == "msg_photo_en"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"Type the text that will be on the link ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'Finish ✨', 'callback_data'=>"photo2_en"]
        ],
        [
        ['text'=>'Convert list 🗒', 'callback_data'=>"list_en"]
        ]
      ]
    ])
]);
}

if($data == "msg_voice_en"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"Type the text that will be on the link ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'Finish ✨️', 'callback_data'=>"voice2_en"]
        ],
        [
        ['text'=>'Convert list 🗒', 'callback_data'=>"list_en"]
        ]
      ]
    ])
]);
}

if($data == "msg_video_en"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"Type the text that will be on the link ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'Finish ✨', 'callback_data'=>"video2_en"]
        ],
        [
        ['text'=>'Convert list 🗒', 'callback_data'=>"list_en"]
        ]
      ]
    ])
]);
}

if($data=="video2_en"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'Nice ✨ Now Send the link ♻️ to your friends ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'Back To Share List 📋  ️', 'callback_data'=>"list_en"]
],
]
])
]);
bot("sendmessage", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[Clic here](https://telegram.me/MediaFire_Bot?start=$id_video[0]) 🔶 For join to the link ~🔺",
]);
}

if($data=="voice2_en"){
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'Nice ✨ Now Send the link ♻️ to your friends ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'Back To Share List 📋  ️', 'callback_data'=>"list_en"]
],
]
])
]);
bot('editmessagetext', [
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'Nice ✨ Now Send the link ♻️ to your friends ‼️',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'Back To Share List 📋  ️', 'callback_data'=>"list_en"]
],
]
])
]);
bot('sendMessage', [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text"  . "\n\n" . "[Clic here](https://telegram.me/MediaFire_Bot?start=$id_voice[0]) 🔶 For join to the link ~🔺",
]);
}
if($data == "q2_en"){
bot('sendmessage', [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[Clic here](https://telegram.me/MediaFire_Bot?start=$id_file[0]) 🔶 For join to the link ~🔺",
]);
}

if($data=="channel_pe" && !strpos($inch , '"status":"left"') !== false){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'تماس با ما 🚹 های این کانال ♻️',
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'کانال رسمی ✅', 'url'=>"https://telegram.me/set_web"]
        ],
        [
        ['text'=>'EVS تیم ✨', 'url'=>"https://telegram.me/TeamEVS"]
        ],
        [
        ['text'=>'لمسی تیم💡', 'url'=>"https://telegram.me/touch_t"]
        ],
        [
        ['text'=>'خانه 🏠', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
        ]);

         }
         
    if($data=="back_pe"){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
 'text'=>'سلام 💌 خوش آمدید عزیز من به ✨ ربات لینک 🤖 شما می توانید فایل های خود را به اشتراک بگذارید 📁 تلگراف به کاربران 🚹 از این ربات',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'لیست اشتراک 📋', 'callback_data'=>"list_pe"]
        ],
        [
         ['text'=>'تماس با ما 📪', 'callback_data'=>"channel_pe"]
        ],
        [
         ['text'=>'تغییر زبان 📚', 'callback_data'=>"lang"]
        ],
        [
['text'=>'ربات ارسال 🚹', 'switch_inline_query'=>""]
],
        [
          ['text'=>'توسعه دهنده ربات 🚹','url'=>'https://telegram.me/omar_real']
          ],
          [
          ['text'=>'سوالی داری ❔','url'=>'https://telegram.me/Math_Support_Bot']
        ],
      ]
    ])
  ]);
}

if($data=="list_pe"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"اکنون را انتخاب کنید 📧 آنچه شما می خواهید برای به اشتراک گذاشتن 📪",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'اشتراک فایل 📁', 'callback_data'=>"q1_pe"]
        ],
        [
        ['text'=>'به اشتراک گذاری ویدئو 🎥', 'callback_data'=>"video_pe"]
        ],
       [
        ['text'=>'اشتراک گذاری صدای 📣', 'callback_data'=>"voice_pe"]
        ],
       [
        ['text'=>'به اشتراک گذاری موسیقی 🎵', 'callback_data'=>"photo_pe"]
        ],
        [
          ['text'=>'بازگشت ◀️', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
        ]);
}

if($data=="video_pe"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"خوب ✨ من ویدئو های خود را ارسال ➖🎥",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'بعد🔹️', 'callback_data'=>"msg_video_pe"]
        ],
        [
          ['text'=>'بازگشت ◀️', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
        ]);
}

if($data=="voice_pe"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"خوب ✨ من صدای خود را ارسال ➖🔔",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'بعد🔹️', 'callback_data'=>"msg_voice_pe"]
        ],
        [
          ['text'=>'بازگشت ◀️', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
        ]);
}

if($data=="photo_pe"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"خوب ✨ من آهنگ خود را ارسال ➖🎵",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'بعد🔹️', 'callback_data'=>"msg_photo_pe"]
        ],
        [
          ['text'=>'بازگشت ◀️', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
        ]);
}


if($data=="q1_pe"){
   bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"خوب ✨ من فایل خود را ارسال ➖📁",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
        ['text'=>'بعد🔹️', 'callback_data'=>"msg_file_pe"]
        ],
        [
          ['text'=>'بازگشت ◀️', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
        ]);
}

if($data=="photo2_pe"){
bot("editmessagetext", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اینجا کلیک کنید](https://telegram.me/MediaFire_Bot?start=$id_photo[0]) 🔶 برای عضویت به لینک ~ 🔺",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'از نو 🔷️', 'callback_data'=>"photo_pe"]
        ],
        [
        ['text'=>'خانه 🏠 ️', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
]);
}

if($data == "msg_file_pe"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"متن را تایپ کنید که بر روی لینک ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'پایان ✨', 'callback_data'=>"q2_pe"]
        ],
        [
        ['text'=>'لیست اشتراک 🗒', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
]);
}

if($data == "msg_photo_pe"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"متن را تایپ کنید که بر روی لینک ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'پایان ✨', 'callback_data'=>"photo2_pe"]
        ],
        [
        ['text'=>'لیست اشتراک🗒', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
]);
}

if($data == "msg_voice_pe"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"متن را تایپ کنید که بر روی لینک ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'پایان ✨️', 'callback_data'=>"voice2_pe"]
        ],
        [
        ['text'=>'لیست اشتراک🗒', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
]);
}

if($data == "msg_video_pe"){
bot('editMessageText', [
'chat_id'=>$chat_id, 
'text'=>"متن را تایپ کنید که بر روی لینک ✨❕",
'message_id'=>$message_id,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'پایان ✨', 'callback_data'=>"video2_pe"]
        ],
        [
        ['text'=>'لیست اشتراک🗒', 'callback_data'=>"list_pe"]
        ]
      ]
    ])
]);
}

if($data=="video2_pe"){
bot("editmessagetext", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اینجا کلیک کنید](https://telegram.me/MediaFire_Bot?start=$id_video[0]) 🔶 برای عضویت به لینک ~ 🔺",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'از نو 🔷️', 'callback_data'=>"video_pe"]
        ],
        [
        ['text'=>'خانه 🏠', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
]);
}

if($data=="voice2_pe"){
bot("editmessagetext", [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text"  . "\n\n" . "[اینجا کلیک کنید](https://telegram.me/MediaFire_Bot?start=$id_voice[0]) 🔶 برای عضویت به لینک ~ 🔺",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'از نو 🔷️', 'callback_data'=>"voice_pe"]
        ],
        [
        ['text'=>'خانه 🏠', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
]);
}
if($data == "q2_pe"){
bot('editMessageText', [
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'message_id'=>$message_id,
'disable_web_page_preview'=>"true",
'text'=>"$get_text" . "\n\n" . "[اینجا کلیک کنید](https://telegram.me/MediaFire_Bot?start=$id_file[0]) 🔶 برای عضویت به لینک ~ 🔺",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
        [
          ['text'=>'از نو 🔷️', 'callback_data'=>"q1_pe"]
        ],
        [
        ['text'=>'خانه 🏠 ', 'callback_data'=>"back_pe"]
        ]
      ]
    ])
]);
}

}
$h = explode(" ", $text1);



if($text1 == in_array($h[1], $h) && !$data && !strpos($inch , '"status":"left"') !== false){
bot('sendVoice', [
'chat_id'=>$chat_id,
'voice'=>$h[1],
'caption'=>"By @MediaFire_Bot",
'reply_to_message_id'=>$message->message_id
]);
}

if($text1 == in_array($h[1], $h) && !$data && !strpos($inch , '"status":"left"') !== false){
bot('sendAudio', [
'chat_id'=>$chat_id,
'audio'=>$h[1],
'caption'=>"By @MediaFire_Bot",
'reply_to_message_id'=>$message->message_id
]);
}

if($text1 == in_array($h[1], $h) && !$data && !strpos($inch , '"status":"left"') !== false){
bot('sendVideo', [
'chat_id'=>$chat_id,
'video'=>$h[1],
'caption'=>"By @MediaFire_Bot",
'reply_to_message_id'=>$message->message_id
]);
}

exit;
