<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge' />
		<meta name='viewport' content='width=device-width, initial-scale=1.0' />
<link type='Image/x-icon' href='https://lineorg.com/landing/new_version/assets/img/header/LB.ico' rel='icon'>
		<link type="Image/x-icon" href="https://lineorg.com/landing/new_version/assets/img/header/LB.ico" rel="icon">
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
										<a href='https://lb-aff.com//L?tag=d_1460549m_34671c_apk&site=1460549&ad=34671'
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
											<a class='lineorg-slider__main_bonus' href='https://lb-aff.com//L?tag=d_1460549m_22611c_sait&site=1460549&ad=22611&r=registration/'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>ZOOMBD</p>
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
										<a href='https://lb-aff.com//L?tag=d_1460549m_34671c_apk&site=1460549&ad=34671'
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
											<a class='lineorg-slider__main_bonus' href='https://lb-aff.com//L?tag=d_1460549m_22611c_sait&site=1460549&ad=22611&r=registration/'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>ZOOMBD</p>
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
										<a href='https://lb-aff.com//L?tag=d_1460549m_34671c_apk&site=1460549&ad=34671'
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
											<a class='lineorg-slider__main_bonus' href='https://lb-aff.com//L?tag=d_1460549m_22611c_sait&site=1460549&ad=22611&r=registration/'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>ZOOMBD</p>
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
										<a href='https://lb-aff.com//L?tag=d_1460549m_34671c_apk&site=1460549&ad=34671'
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
											<a class='lineorg-slider__main_bonus' href='https://lb-aff.com//L?tag=d_1460549m_22611c_sait&site=1460549&ad=22611&r=registration/'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>ZOOMBD</p>
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
										<a href='https://lb-aff.com//L?tag=d_1460549m_34671c_apk&site=1460549&ad=34671'
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
											<a class='lineorg-slider__main_bonus' href='https://lb-aff.com//L?tag=d_1460549m_22611c_sait&site=1460549&ad=22611&r=registration/'
												><script>document.write(Button);</script></a
											>
										</div>
										<div class='lineorg-slider__main_bonus-col promo'>
											<button class='lineorg-slider__main_promo'>
												<p>PROMOCODE:</p>
												<p>ZOOMBD</p>
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

