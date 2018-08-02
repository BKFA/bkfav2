Cài đặt Laravel Collective:
	B1: Chạy lệnh -> composer require laravelcollective/html
	B2: Thêm Provider và Aliases vào file config/app.php:
		// ...
    		'providers' => [
        		// ...
        		Collective\Html\HtmlServiceProvider::class,
        		// ...
    		],
    		// ...
    		'aliases' => [
        		// ...
        		'Form' => Collective\Html\FormFacade::class,
        		'Html' => Collective\Html\HtmlFacade::class,
        		// ...
    		],
    		// ...
	nếu start ứn dụng báo: Class 'Collective\Html\HtmlServiceProvider' not found 
		Gói HtmlServiceProvider cung cấp các phương thức đã xây dựng sẵn giúp chúng ta thao tác với form 1 cách dễ dàng hơn trong 			blade. Để cài đặt, cách bạn có thể thêm 1 dòng vào file composer.json:
			"require": {
        			"php": ">=5.5.9",
        			"laravel/framework": "5.1.*", //phiên bản laravel của ứng dụng
        			"laravelcollective/html": "^5.1"
    			},
 		Sau đó các bạn vào terminal và chạy lệnh: composer dumpautoload
Cài đặt gói Repository:
	composer require ozankurt/repoist --dev
_____________________________________________________________________________________________________

Gui mail xac nhan tai khoan dang ky:
    https://www.5balloons.info/user-email-verification-and-account-activation-in-laravel-5-5/


