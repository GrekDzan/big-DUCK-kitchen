<?php

use PHPMailer\PHPMailer\PHPMailer;
/**
 * Контроллер CartController
 */
class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProducts = Product::getLatestProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
        
    }

    /**
     * Action для страницы "Контакты"
     */
    public function actionContact()
    {
        require_once (ROOT. '/config/smtp.params.php');

        // Переменные для формы
        $userEmail = false;
        $userText = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Отправляем письмо администратору 
                $phpmailer = new PHPMailer();
                $phpmailer -> CharSet = "UTF-8";
                $phpmailer->isSMTP();
                $phpmailer->Host = $smtp_params['host'];
                $phpmailer->SMTPAuth = $smtp_params['smtp_auth'];
                $phpmailer->Port = $smtp_params['port'];
                $phpmailer->Username = $smtp_params['user_name'];
                $phpmailer->Password = $smtp_params['password'];

                $phpmailer->setFrom($userEmail, 'user');
                $phpmailer->addAddress($smtp_params['user_name'], 'big DUCK admin');
                $phpmailer->Subject = 'Тема письма';
                $phpmailer->Body = "Текст: {$userText}. От {$userEmail}";

                $phpmailer->send();
                $result = $phpmailer;
                
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
    
    /**
     * Action для страницы "О магазине"
     */
    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }
    
    public function actionNews()
    {
        // Подключаем вид
        $newsList = News::getAll();
        require_once(ROOT . '/views/site/news.php');
        return true;
        
    }

}
