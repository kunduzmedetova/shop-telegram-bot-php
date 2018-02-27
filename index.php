<?php
/**
 * 
 *
 * @author - Medetova Kunduz
 */
header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");

// дебаг
if(true){
	error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_DEPRECATED));
	ini_set('display_errors', 1);
}

// создаем переменную бота
$token = "--Your Token";
$bot = new \TelegramBot\Api\Client($token,null);

if($_GET["bname"] == "--Bot Name"){
	$bot->sendMessage("--User Name", "Выберите язык");
}

// если бот еще не зарегистрирован - регистируем
if(!file_exists("registered.trigger")){ 
	/**
	 * файл registered.trigger будет создаваться после регистрации бота. 
	 * если этого файла нет значит бот не зарегистрирован 
	 */
	 
	// URl текущей страницы
	$page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$result = $bot->setWebhook($page_url);
	if($result){
		file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
	} else die("ошибка регистрации");
}

// Команды бота


$bot->command("start", function ($message) use ($bot) {
	$user = $message->getFrom()->getUsername();
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_test', 'text' => '🇺🇿 O`zbekcha'],
				['callback_data' => 'n', 'text' => '🇸🇮 Русский (demo)']
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Выберите язык", false, null,null,$keyboard);
	$bot->sendMessage("212439850", "Hurmatli admin, yangi foydalanuvchi qo`shildi @$user");//toadminmessage
});

// помощ
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - помощь
';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});


// Кнопки у сообщений


// Обработка кнопок у сообщений
$bot->on(function($update) use ($bot, $callback_loc, $find_command){
	$callback = $update->getCallbackQuery();
	$message = $callback->getMessage();
	$chatId = $message->getChat()->getId();
	$data = $callback->getData();
	
	if($data == "data_test"){
		$bot->answerCallbackQuery( $callback->getId(),true);
        $bot->sendMessage($chatId,"Siz O`zbek tilini tanladingiz!");
        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [[["text" => "🛒 Mahsulotlar ro`yxati"],["text" => "🏢 Biz haqimizda"]],
            [["text" => "👥 Guruh"],["text" => "⚙️ Sozlamalar"]],
            [["text" => "📞📨 Bog`lanish"]]],true, true);
        $bot->sendMessage($message->getChat()->getId(), "Asosiy menyu", false, null,null, $keyboard);
	}
	
	//catalog Oziq_ ovqat mahsulotlari
	if($data == "data_cat1"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat61', 'text' => 'Yormalar'],
			],
			[
				['callback_data' => 'data_cat62', 'text' => 'Un'],
			],
			[
				['callback_data' => 'data_cat63', 'text' => 'Shakar, Novvot, Tuz'],
			],
			[
				['callback_data' => 'data_cat64', 'text' => 'Makaron mahsulotlari'],
			],
			[
				['callback_data' => 'data_cat65', 'text' => 'Yog`- moy mahsulotlari'],
			],
			[
				['callback_data' => 'data_cat66', 'text' => 'Asal, Sut, Yogurt'],
			],
			[
				['callback_data' => 'data_cat67', 'text' => 'Margarin, Sariyog`'],
			],
			[
				['callback_data' => 'data_cat68', 'text' => 'Yarim tayyor mahsulotlar'],
			],
			[
				['callback_data' => 'data_cat69', 'text' => 'Ketchup, Mayonez'],
			],
			[
				['callback_data' => 'data_cat70', 'text' => 'Preprava, Kukuruz'],
			],
			[
				['callback_data' => 'data_cat71', 'text' => 'Smechka, Chipslar'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Oziq-ovqat mahsulotlari katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog Choy mahsulotlari
	if($data == "data_choy"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat23', 'text' => 'Choy kg'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Choy pachka'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Kofe'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Choy katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	
	//catalog xojalik mahsulotlari
	if($data == "data_cat989"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat23', 'text' => 'Paket'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Gugurt, Zajigalka'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Krem, Tish pasta'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Lampochka, Batareyka'],
			]
		]
	);
	$bot->sendMessage($message->getChat()->getId(), "Kandolat mahsulotlar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog Choy mahsulotlari
	if($data == "data_kand"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat23', 'text' => 'Vafli, Pechene'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Zvachka, Chococrem'],
			],
			[
				['callback_data' => 'data_cat24', 'text' => 'Shokalat dona va kg'],
			]
		]
	);
	$bot->sendMessage($message->getChat()->getId(), "Kandolat mahsulotlar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog Go`sht mahsulotlari
	if($data == "data_gosht"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_pod44', 'text' => 'Tovuq go`shti'],
			],
			[
				['callback_data' => 'data_pod44', 'text' => 'Kalbasa mahsulotlari'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Go`sht mahsulotlari katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog konserva mahsulotlari
	if($data == "data_kon"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_pod1', 'text' => 'Sabzavot va meva konservalari'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Go`sht konservalari'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Konserva mahsulotlari katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog konserva mahsulotlari
	if($data == "data_bola"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_pod1', 'text' => 'Bolalar anjomlari'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Bolalar kiyimlari'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Bolalar ovqatlari'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Bolalar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//catalog konserva mahsulotlari
	if($data == "data_toz"){
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_pod1', 'text' => 'Quruq salfetka, namli salfetka'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Tualet qog`ozi'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Shampun, Sovun'],
			],
			[
				['callback_data' => 'data_pod2', 'text' => 'Britva'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Bolalar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	}
	//napitok
	if($data == "data_cat4"){
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat_ru1', 'text' => 'Sok'],
			],
			[
				['callback_data' => 'data_cat2', 'text' => 'Suvlar'],
			],
			[
				['callback_data' => 'data_cat3', 'text' => 'Gazli napitkalar'],
			],
			[
				['callback_data' => 'data_cat4', 'text' => 'Yaxna ichimliklar'],
			],
			[
				['callback_data' => 'data_cat4', 'text' => 'Energetik ichimliklar'],
			]
		]
	);


	$bot->sendMessage($message->getChat()->getId(), "Ichimliklar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);
	
	}
	
}, function($update){
	$callback = $update->getCallbackQuery();
	if (is_null($callback) || !strlen($callback->getData()))
		return false;
	return true;
});

// Отлов любых сообщений +обрабтка reply-кнопок
$bot->on(function($Update) use ($bot){
	
	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();
	
	
	
	if(mb_stripos($mtext, "🛒 Mahsulotlar ro`yxati") !== false){
		
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_cat1', 'text' => '🧀 Oziq-ovqat mahsulotlari'],
			],
			[
				['callback_data' => 'data_choy', 'text' => '☕️ Choy, kofe'],
			],
			[
				['callback_data' => 'data_cat4', 'text' => '🍼 Ichimliklar (suv,..)'],
			],
			[
				['callback_data' => 'data_toz', 'text' => '👕 Tozalik uchun'],
			],
			[
				['callback_data' => 'data_gosht', 'text' => '🍖 Go`sht mahsulotlari'],
			],
			[
				['callback_data' => 'data_kand', 'text' => '🎂🍰 Kandolat mahsulotlari (shirinliklar,..)'],
			],
			[
				['callback_data' => 'data_bola', 'text' => '👧🏻👦 Bolalar uchun'],
			],
			[
				['callback_data' => 'data_kon', 'text' => '🏘 Konserva mahsulotlari'],
			],
			[
				['callback_data' => 'data_cat989', 'text' => '🏘 Xo`jalik mollari'],
			],
			[
				['callback_data' => 'data_cat9', 'text' => 'Boshqalar'],
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "O`rikzor mahsulotlar katalogi 🍅🍏🍐👠🍇🌯🍶", false, null,null,$keyboard);

	}
	
		
	if(mb_stripos($mtext,"📞📨 Bog`lanish") !== false){
        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [[
			["text" => "📞 Telefon"],
			["text" => "📨 Email", "url"=> "test@mail.ru"]],
            [["text" => "🌍 Web sayt"],
			["text" => "❓ Qayta aloqa", "request_contact" => true]],
            [["text" => "🔙 Bosh menyu"]]],true, true);
        $bot->sendMessage($message->getChat()->getId(), "Aloqa menyusi", false, null,null, $keyboard);
	
	}
	
	
	if(mb_stripos($mtext,"🔙 Bosh menyu") !== false){
		$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [[["text" => "🛒 Mahsulotlar ro`yxati"],["text" => "🏢 Biz haqimizda"]],
            [["text" => "👥 Guruh"],["text" => "⚙️ Sozlamalar"]],
            [["text" => "📞📨 Bog`lanish"]]],true, true);
        $bot->sendMessage($message->getChat()->getId(), "Sizning menu", false, null,null, $keyboard);
		}
	
	if(mb_stripos($mtext,"📞 Telefon") !== false){
		$bot->sendMessage($message->getChat()->getId(), "Telegram: @urikzar_bazar_bot");
		$bot->sendMessage($message->getChat()->getId(), "Phone: +99893********");
	}
	if(mb_stripos($mtext,"📨 Email") !== false){
		$bot->sendMessage($message->getChat()->getId(), "test@mail.ru");
		$bot->sendMessage("318156487", "test@mail.ru");
		$bot->sendMessage("318156487", "$mtext, $cid");
		$bot->sendMessage("212439850", "test");
		$bot->sendMessage("212439850", "$qip, $cid");
	}
	if(mb_stripos($mtext,"❓ Qayta aloqa") !== false){
		$bot->sendMessage("318156487", "$message->getChat()->getId()");
		$bot->sendMessage("212439850", "$message->getChat()->getId()");
	}
	if(mb_stripos($mtext,"👥 Guruh") !== false){
		$bot->sendMessage($message->getChat()->getId(), "O`z tanishlaringizga jo`nating va chegirmalarga ega bo`ling: https://t.me/urikzar_bazar_bot?start=$cid");
	}
	if(mb_stripos($mtext,"🌍 Web sayt") !== false){
		$bot->sendMessage($message->getChat()->getId(), "https://www.test.ru");
	}
	if(mb_stripos($mtext,"⚙️ Sozlamalar") !== false){
		
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'data_test', 'text' => '🇺🇿 O`zbekcha'],
				['callback_data' => 'data_test2', 'text' => '🇸🇮 Русский']
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Выберите язык", false, null,null,$keyboard);

	}
	
	if(mb_stripos($mtext,"🏢 Biz haqimizda") !== false){
		$bot->sendMessage($message->getChat()->getId(), "Ушбу хизмат оркали Ўзбекистоннинг хоҳлаган жойидан Ўрикзор бозоридаги нархларни билишингиз ва  буюртма беришингиз мумкин.");
	}
	
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});

// запускаем обработку
$bot->run();

echo "бот";