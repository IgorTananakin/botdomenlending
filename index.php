<?php

// определяем кодировку
header('Content-type: text/html; charset=utf-8');
// Создаем объект бота
$bot = new Bot();
// Обрабатываем пришедшие данные
$bot->init('php://input');

/**
 * Class Bot
 */
class Bot
{
    // <bot_token> - созданный токен для нашего бота от @BotFather
    private $botToken = "1560780841:AAGccQzBWfKa4xSzWst5AEaH_6pcuD4wBsU";
    // адрес для запросов к API Telegram
    private $apiUrl = "https://api.telegram.org/bot";
    // админы
    private $ADMIN = [659025951, 169024420, 122815990, 569032193, 472611922,2119437597,802243803,1295698464];

    public function init($data_php)
    {
        // создаем массив из пришедших данных от API Telegram
        $data = $this->getData($data_php);
        // id чата отправителя
        $chat_id = $data['message']['chat']['id'];
        //включаем логирование будет лежать рядом с этим файлом
        //$this->setFileLog($data, "log.txt");
        // стартовая кнопка
        $justKeyboard = $this->getKeyBoard([
            [
                ["text" => "Создать лендинг"],
                ["text" => "Существующие лендинги"],

            ]
        ]);
        // Кнопка отмены
        $otmena = $this->getKeyBoard([
            [
                ["text" => "Отмена"]
            ]
        ]);

        // Кнопка назад
        $nazad = $this->getKeyBoard([
            [
                ["text" => "Назад"]
            ]
        ]);
        //Существующие лендинги
        $landing = $this->getKeyBoard([
            [
                ["text" => "Удалить"],
				["text" => "Удалить по поиску"],
                ["text" => "Отмена"],

            ]
        ]);

        if (array_key_exists('message', $data)) {
            // пришла команда /start
            if ($data['message']['text'] == "/start") {
                //  проверка на существование файла
                if ($this->fwd($chat_id) == false) {
                    $this->fwclose($chat_id);
                }

                // проверка на админа
                $textAd = $this->isAdmin($chat_id);
                if ($textAd == "Привет админ") {

                    $dataSend = array(
                        'text' => "Приветствую Админ, выберите действие.",
                        'chat_id' => $chat_id,
                        'reply_markup' => $justKeyboard,
                    );
                    $this->requestToTelegram($dataSend, "sendMessage");
                } else {
                    $this->sendMessage($chat_id, $textAd);
                }
            }
        }
        // проверка на админа
        $textAd = $this->isAdmin($chat_id);
        if ($textAd == "Привет админ" || $message != "/start") {
            $message = $data['message']['text'];


            $file = file_get_contents("file/$chat_id.txt");

            // Создать лендинг
            if ($message == "Создать лендинг") {
                $dataSend = array(
                    'text' => "Введите название лендинга",
                    'chat_id' => $chat_id,
                    'reply_markup' => $otmena,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fpwrite($chat_id, "1");

            }

            // проверка названия и ввод реф ссылки
            if ($message != "Отмена" && $file == "1") {

                if (!preg_match('/[a-z]/i', $message)) {
                    $dataSend = array(
                        'text' => "Название не на латинице,попробуйте ещё раз",
                        'chat_id' => $chat_id,
                        'reply_markup' => $otmena,
                    );
                    $this->requestToTelegram($dataSend, "sendMessage");
                } elseif (file_exists("$message")) {
                    $dataSend = array(
                        'text' => "Название занято,попробуйте ещё раз",
                        'chat_id' => $chat_id,
                        'reply_markup' => $otmena,
                    );
                    $this->requestToTelegram($dataSend, "sendMessage");
                } elseif (!file_exists("$message")) {
                    $dataSend = array(
                        'text' => "Название подходит,введите название промокода",
                        'chat_id' => $chat_id,
                        'reply_markup' => $otmena,
                    );
                    $this->requestToTelegram($dataSend, "sendMessage");
                    $message = mb_strtolower($message);
                    $this->fpwrite($chat_id, "`|$message");
                }
            }

			if ($file == "deleteSearch" && $message) {
				if ($message != "Назад" || $message != "Отмена") {
					$siteName = $message;
					$found = false;
					$callback = "Сайт не найден";
					if (mb_stripos($siteName, "https://") !== false) $siteName = mb_substr($siteName, 8);
						if (mb_stripos($siteName, ".lineorg.com/") !== false) $siteName = mb_substr($siteName, 0, mb_strlen($siteName) - 13);
					if (mb_stripos($siteName, ".lineorg.com") !== false) $siteName = mb_substr($siteName, 0, mb_strlen($siteName) - 12);
					$files = glob("*"); // get all file names
					foreach ($files as $value) { // iterate files
						if ($value != "Andrey.php" && $value != "index.php" && $value != "www" && $value != "logo.png" && $value != ".htaccess" && $value != "landing" && $value != "test.php" && $value != "lineorg" && $value != "file" && $value != "cgi-bin") {
							if ($value == $siteName) {
								$callback = "Сайт найден!";
								$found = true;
								break;
							}
						}
					}
					if ($found) {
						 if ($this->dirDel($siteName)) $callback = "Лендинг " . $siteName . " успешно удален!";
						 else $callback = "Ошибка удаления!";
					}
					$dataSend = [
						'text' => $callback,
						'chat_id' => $chat_id,
						'reply_markup' => $justKeyboard,
					];
					$this->requestToTelegram($dataSend, "sendMessage");
				}
				$this->fwclose($chat_id);
			}

            if (false !== strpos("$file", '`') && $message != "Отмена") {
                list($x, $name) = explode("|", $file);

                $dataSend = array(
                    'text' => "Введите реф ссылку бонуса",
                    'chat_id' => $chat_id,
                    'reply_markup' => $otmena,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fpwrite($chat_id, "@|$name|$message");
            }
            if (false !== strpos("$file", '@') && $message != "Отмена") {
                list($x, $name, $ref_bonus) = explode("|", $file);

                $dataSend = array(
                    'text' => "Введите реф ссылку приложения",
                    'chat_id' => $chat_id,
                    'reply_markup' => $otmena,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fpwrite($chat_id, "<|$name|$ref_bonus|$message");
            }
            // создания папки и формирования страницы
            if (false !== strpos("$file", '<') && $message != "Отмена") {

                list($x, $name, $promokod, $ref_bonus) = explode("|", $file);
                mkdir("$name/", 0700);
                $promokodk = "$promokod";
                $href = "$ref_bonus";
                $html = "<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge' />
		<meta name='viewport' content='width=device-width, initial-scale=1.0' />
<link type='Image/x-icon' href='https://lineorg.com/landing/new_version/assets/img/header/LB.ico' rel='icon'>
		<title>Linebet</title>
		<!-- Swiper slider css -->
		<link
			rel='stylesheet'
			href='https://unpkg.com/swiper@7/swiper-bundle.min.css'
		/>
		<!-- Custom css -->
		<link rel='stylesheet' href='https://lineorg.com/landing/new_version/assets/css/styles.css' />
        <script>
        // Чтение файла с динамическим брендированием
var allText = '';
function readTextFile(file)
{
	
    var rawFile = new XMLHttpRequest();
    rawFile.open('GET', file, false);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                 allText = rawFile.responseText;
                
            }
        }
    }
    rawFile.send(null);
}

//определения языка	
var lang = window.navigator.language || navigator.userLanguage;	
lang = lang.substr(0,2);
	
var arr=/(?:ru|en|sr|ka|az|uz|mn|bn)/gi;	
if(!lang.match(arr)){
	lang = 'en';
};
var FileLang = 'https://lineorg.com/landing/BannerFootball/lang/' + lang + '/main.php';
readTextFile(FileLang);	
//console.log(lang);
var Banner = allText.split(';');

var Button = Banner[0];
var Football = Banner[1].split('|');
var UFC = Banner[2].split('|');
var Linebet = Banner[3].split('|');
var Cazino = Banner[4].split('|');
var Hulk = Banner[5].split('|');
var copy_custom = Banner[6];    
        </script>
	</head>
	<body>
		<!-- Swiper slider -->
		<div class='swiper lineorg-slider__wrapper'>
			<div class='swiper-wrapper'>
				<!-- First -->
				<div class='swiper-slide lineorg-slider__slide'>
					<div class='container'>
						<div class='lineorg-slider__header'>
							<nav>
								<ul>
									<li class='lineorg-slider__logo'>
										<a href='/'>
											<img src='https://lineorg.com/landing/new_version/assets/img/header/linebet-logo.png' alt='' />
										</a>
									</li>
									<li class='lineorg-slider__google'>
										<a href='$message'
											><img
												src='https://lineorg.com/landing/new_version/assets/img/header/google-play-logo.png'
												alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
						<div class='lineorg-slider__main'>
							<div class='lineorg-slider__main_row'>
								<div class='lineorg-slider__main_col img'>
									<img src='https://lineorg.com/landing/new_version/assets/img/main/first.png' alt='' />
								</div>
								<div class='lineorg-slider__main_col info first'>
									<h1><script>document.write(Football[0]);</script></h1>
									<ul>
                                        <script>document.write(Football[1]);</script>
									</ul>
									<div class='lineorg-slider__main_bonus-row'>
										<div class='lineorg-slider__main_bonus-col bonus'>
											<a class='lineorg-slider__main_bonus' href='$href'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>$promokodk</p>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='lineorg-slider__footer'>
							<nav>
								<ul>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/visa.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mastercard.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mir.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/webmoney.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/gpay.png' alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					<img
						class='lineorg-slider__bg'
						src='https://lineorg.com/landing/new_version/assets/img/bg/first.jpg'
						alt=''
					/>
				</div>
				<!-- Second -->
				<div class='swiper-slide lineorg-slider__slide'>
					<div class='container'>
						<div class='lineorg-slider__header'>
							<nav>
								<ul>
									<li class='lineorg-slider__logo'>
										<a href='/'>
											<img src='https://lineorg.com/landing/new_version/assets/img/header/linebet-logo.png' alt='' />
										</a>
									</li>
									<li class='lineorg-slider__google'>
										<a href='$message'
											><img
												src='https://lineorg.com/landing/new_version/assets/img/header/google-play-logo.png'
												alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
						<div class='lineorg-slider__main'>
							<div class='lineorg-slider__main_row'>
								<div class='lineorg-slider__main_col img'>
									<img src='https://lineorg.com/landing/new_version/assets/img/main/second.png' alt='' />
								</div>
								<div class='lineorg-slider__main_col info second'>
									<h1><script>document.write(UFC[0]);</script></h1>
									<ul>
										<script>document.write(UFC[1]);</script>
									</ul>
									<div class='lineorg-slider__main_bonus-row'>
										<div class='lineorg-slider__main_bonus-col bonus'>
											<a class='lineorg-slider__main_bonus' href='$href'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>$promokodk</p>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='lineorg-slider__footer'>
							<nav>
								<ul>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/visa.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mastercard.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mir.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/webmoney.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/gpay.png' alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					<img
						class='lineorg-slider__bg'
						src='https://lineorg.com/landing/new_version/assets/img/bg/second.jpg'
						alt=''
					/>
				</div>
				<!-- Third -->
				<div class='swiper-slide lineorg-slider__slide'>
					<div class='container'>
						<div class='lineorg-slider__header'>
							<nav>
								<ul>
									<li class='lineorg-slider__logo'>
										<a href='/'>
											<img src='https://lineorg.com/landing/new_version/assets/img/header/linebet-logo.png' alt='' />
										</a>
									</li>
									<li class='lineorg-slider__google'>
										<a href='$message'
											><img
												src='https://lineorg.com/landing/new_version/assets/img/header/google-play-logo.png'
												alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
						<div class='lineorg-slider__main'>
							<div class='lineorg-slider__main_row'>
								<div class='lineorg-slider__main_col img'>
									<img src='https://lineorg.com/landing/new_version/assets/img/main/third.png' alt='' />
								</div>
								<div class='lineorg-slider__main_col info third'>
									<h1><script>document.write(Linebet[0]);</script></h1>
									<ul>
                                        <script>document.write(Linebet[1]);</script>
									</ul>
									<div class='lineorg-slider__main_bonus-row'>
										<div class='lineorg-slider__main_bonus-col bonus'>
											<a class='lineorg-slider__main_bonus' href='$href'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>$promokodk</p>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='lineorg-slider__footer'>
							<nav>
								<ul>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/visa.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mastercard.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mir.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/webmoney.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/gpay.png' alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					<img
						class='lineorg-slider__bg'
						src='https://lineorg.com/landing/new_version/assets/img/bg/third.jpg'
						alt=''
					/>
				</div>
				<!-- Fourth -->
				<div class='swiper-slide lineorg-slider__slide'>
					<div class='container'>
						<div class='lineorg-slider__header'>
							<nav>
								<ul>
									<li class='lineorg-slider__logo'>
										<a href='/'>
											<img src='https://lineorg.com/landing/new_version/assets/img/header/linebet-logo.png' alt='' />
										</a>
									</li>
									<li class='lineorg-slider__google'>
										<a href='$message'
											><img
												src='https://lineorg.com/landing/new_version/assets/img/header/google-play-logo.png'
												alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
						<div class='lineorg-slider__main'>
							<div class='lineorg-slider__main_row'>
								<div class='lineorg-slider__main_col img'>
									<img src='https://lineorg.com/landing/new_version/assets/img/main/fourth.png' alt='' />
								</div>
								<div class='lineorg-slider__main_col info fourth'>
									<h1><script>document.write(Cazino[0]);</script></h1>
									<ul>
                                        <script>document.write(Cazino[1]);</script>
									</ul>
									<div class='lineorg-slider__main_bonus-row'>
										<div class='lineorg-slider__main_bonus-col bonus'>
											<a class='lineorg-slider__main_bonus' href='$href'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>$promokodk</p>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='lineorg-slider__footer'>
							<nav>
								<ul>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/visa.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mastercard.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mir.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/webmoney.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/gpay.png' alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					<img
						class='lineorg-slider__bg'
						src='https://lineorg.com/landing/new_version/assets/img/bg/fourth.jpg'
						alt=''
					/>
				</div>
				<!-- Fifth -->
				<div class='swiper-slide lineorg-slider__slide'>
					<div class='container'>
						<div class='lineorg-slider__header'>
							<nav>
								<ul>
									<li class='lineorg-slider__logo'>
										<a href='/'>
											<img src='https://lineorg.com/landing/new_version/assets/img/header/linebet-logo.png' alt='' />
										</a>
									</li>
									<li class='lineorg-slider__google'>
										<a href='$message'
											><img
												src='https://lineorg.com/landing/new_version/assets/img/header/google-play-logo.png'
												alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
						<div class='lineorg-slider__main'>
							<div class='lineorg-slider__main_row'>
								<div class='lineorg-slider__main_col img'>
									<img src='https://lineorg.com/landing/new_version/assets/img/main/fifth.png' alt='' />
								</div>
								<div class='lineorg-slider__main_col info fifth'>
									<h1><script>document.write(Hulk[0]);</script></h1>
									<ul>
                                        <script>document.write(Hulk[1]);</script>
									</ul>
									<div class='lineorg-slider__main_bonus-row'>
										<div class='lineorg-slider__main_bonus-col bonus'>
											<a class='lineorg-slider__main_bonus' href='$href'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>$promokodk</p>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='lineorg-slider__footer'>
							<nav>
								<ul>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/visa.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mastercard.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/mir.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/webmoney.png' alt=''
										/></a>
									</li>
									<li>
										<a href='#'
											><img src='https://lineorg.com/landing/new_version/assets/img/footer/gpay.png' alt=''
										/></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					<img
						class='lineorg-slider__bg'
						src='https://lineorg.com/landing/new_version/assets/img/bg/fifth.jpg'
						alt=''
					/>
				</div>
			</div>
			<!-- Scrollbar -->
			<div class='swiper-scrollbar lineorg-slider__scrollbar'></div>
		</div>
		<!-- Loader -->
		<div class='lineorg-loader__wrap'>
			<div class='lineorg-loader'>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
        <script src='https://unpkg.com/swiper@7/swiper-bundle.min.js'></script>
		<!-- Custom script -->
		<script src='https://lineorg.com/landing/new_version/assets/js/app.js'></script>
	</body>
</html>

";
                $this->create($name, $html);

                $dataSend = array(
                    'text' => "Готово, https://$name.lineorg.com/",
                    'chat_id' => $chat_id,
                    'reply_markup' => $justKeyboard,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fwclose($chat_id);
            }

            if ($message == "Существующие лендинги" || $message == "Назад") {

                $files = glob("*"); // get all file names
                $inline_keyboard = [];
//           $i = 0;
                foreach ($files as $value) { // iterate files
//               if($i < 10) { 
                    if ($value != "Andrey.php" && $value != "index.php" && $value != "www" && $value != "logo.png" && $value != ".htaccess" && $value != "landing" && $value != "test.php" && $value != "lineorg" && $value != "file" && $value != "cgi-bin")
                        $inline_keyboard[] = [
                            [
                                "text" => "https://$value.lineorg.com/",
                                "url" => "https://$value.lineorg.com/",
                                "callback_data" => "$value"
                            ]
                        ];
//                   $i++;
//               }
                }
                $keyboard = array(
                    "inline_keyboard" => $inline_keyboard,
                    "resize_keyboard" => true
                );
                $arrdf = json_encode($keyboard);
                $dataSend = array(
                    'text' => "Лендинги",
                    'chat_id' => $chat_id,
                    'reply_markup' => $arrdf,
                );
                $this->requestToTelegram($dataSend, "sendMessage");

                $dataSend = array(
                    'text' => "Нажмите на кнопку с сайтом, чтобы открыть в браузере",
                    'chat_id' => $chat_id,
                    'reply_markup' => $landing,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                if (empty($files)) {
                    $this->sendMessage($chat_id, "файлов нет");
                }
                $this->fpwrite($chat_id, "landing");
            }
            // Удаление/показ
            if (isset($data['callback_query'])) {
                $chat_id = $data['callback_query']['from']['id']; // Чат куда отправлять ответ
                $a = $data['callback_query']['data']; // Здесь указано что было передано в кнопке (callback_data) у нажатой кнопки

                $path = "$a/index.php";
                unlink($path);
                rmdir($a);

                $this->sendMessage($chat_id, "Лендинг: " . $a . " удалён");
            }


            if ($message == "Удалить") {
                $files = glob("*"); // get all file names
                $inline_keyboard = [];

                foreach ($files as $value) { // iterate files

                    if ($value != "Andrey.php" && $value != "index.php" && $value != "www" && $value != "lineorg" && $value != ".htaccess" && $value != "landing" && $value != "logo.png" && $value != "test.php" && $value != "file" && $value != "cgi-bin")
                        $inline_keyboard[] = [
                            [
                                "text" => "https://$value.lineorg.com/",
                                "callback_data" => "$value"
                            ]
                        ];
                    $i++;

                }
                $keyboard = array(
                    "inline_keyboard" => $inline_keyboard,
                    "resize_keyboard" => true
                );
                $arrdf = json_encode($keyboard);
                $dataSend = array(
                    'text' => "Лендинги",
                    'chat_id' => $chat_id,
                    'reply_markup' => $arrdf,
                );
                $this->requestToTelegram($dataSend, "sendMessage");

                $dataSend = array(
                    'text' => "Нажмите на кнопку с сайтом, чтобы удалить",
                    'chat_id' => $chat_id,
                    'reply_markup' => $nazad,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fpwrite($chat_id, "delete");
            }

			if ($message == "Удалить по поиску") {
				$dataSend = array(
                    'text' => "Введите название сайта, чтобы удалить",
                    'chat_id' => $chat_id,
                    'reply_markup' => $nazad,
                );
				$this->fpwrite($chat_id, 'deleteSearch');
				$this->requestToTelegram($dataSend, "sendMessage");
			}
			
			if ($message =="123") {
				$siteName = $message;
				if (stripos($message, 'https://') !== false) $siteName = substr($siteName, 7); 
				$dataSend = array(
					'text' => $siteName,
					'chat_id' => $chat_id,
					'reply_markup' => $nazad,
				);
				$this->requestToTelegram($dataSend, "sendMessage");
			}

            if ($message == "Отмена") {
                $dataSend = array(
                    'text' => "Отмена действий",
                    'chat_id' => $chat_id,
                    'reply_markup' => $justKeyboard,
                );
                $this->requestToTelegram($dataSend, "sendMessage");
                $this->fwclose($chat_id);
            }


        } else {
            $this->sendMessage($chat_id, $textAd);
        }

    }


    // Очистка файла
    private function fwclose($id)
    {
        $fd = fopen("file/$id.txt", 'w+') or die("не удалось создать файл");
        $str = "";
        fwrite($fd, $str);
        fclose($fd);
    }

    // Запись в файл
    private function fpwrite($id, $text)
    {
        $fd = fopen("file/$id.txt", 'w+') or die("не удалось создать файл");
        $str = $text;
        fwrite($fd, $str);
        fclose($fd);
    }

    // Создание папки
    private function create($id, $text)
    {
        $fd = fopen("$id/index.php", 'w+') or die("не удалось создать файл");
        $str = $text;
        fwrite($fd, $str);
        fclose($fd);
    }

    //проверка существование файла
    private function fwd($id)
    {
        $fd = fopen("file/$id.txt", 'r');
        return $fd;
        fclose($fd);
    }

    //клавиатура
    private function getKeyBoard($data)
    {
        $keyboard = array(
            "keyboard" => $data,
            "one_time_keyboard" => false,
            "resize_keyboard" => true
        );
        return json_encode($keyboard);
    }


    // проверка на админа
    private function isAdmin($chat_id)
    {
        if (in_array($chat_id, $this->ADMIN)) {
            $text = "Привет админ";
        } else {
            $text = "Нед доступа";
        }
        return $text;
    }

    // функция отправки текстового сообщения
    private function sendMessage($chat_id, $text)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'text' => $text,
            "parse_mode" => "markdown",
        ], "sendMessage");
    }

    // функция логирования в файл
    private function setFileLog($data, $file)
    {
        $fh = fopen($file, 'a') or die('can\'t open file');
        ((is_array($data)) || (is_object($data))) ? fwrite($fh, print_r($data, TRUE) . "\n") : fwrite($fh, $data . "\n");
        fclose($fh);
    }

    /**
     * Парсим что приходит преобразуем в массив
     * @param $data
     * @return mixed
     */
    private function getData($data)
    {
        return json_decode(file_get_contents($data), TRUE);
    }

    /** Отправляем запрос в Телеграмм
     * @param $data
     * @param string $type
     * @return mixed
     */
    private function requestToTelegram($data, $type)
    {
        $result = null;

        if (is_array($data)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $this->botToken . '/' . $type);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            curl_close($ch);
        }
        return $result;
    }

	private function dirDel($dir) {  
		$d = opendir($dir);  
		while(($entry = readdir($d)) !== false) { 
			if ($entry != "." && $entry != "..") { 
				if (is_dir($dir . "/" . $entry)) dirDel($dir . "/" . $entry);  
				else  unlink ($dir . "/" . $entry);  
			} 
		} 
		closedir($d);
		return rmdir($dir);  
	} 

}