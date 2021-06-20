<?php
class NewsController 
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex($id)
    {
        // Подключаем вид
        $news = News::getById($id);
        require_once(ROOT . '/views/news/index.php');
        return true;
    }


}
?>