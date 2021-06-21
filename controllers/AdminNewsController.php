<?php

class AdminNewsController extends AdminBase {
  public function actionIndex() {
    // Проверка доступа
    self::checkAdmin();

    // Получаем список товаров
    $newsList = News::getAll();

    // Подключаем вид
    require_once(ROOT . '/views/admin_news/index.php');
    return true;
  }
  public function actionCreate() {
    self::checkAdmin();

    if (isset($_POST['submit'])) {
      $options['title'] = $_POST['title'];
      $options['subject'] = $_POST['subject'];
      $options['pub_date'] = date("Y-m-d");
      
      $errors = false;
      
      if ((!isset($options['title'])|| empty($options['title']))
        && (!isset($options['subject'])|| empty($options['subject']))
      ) {
        $errors[] = 'Заполните поля';
      }

      if ($errors == false) {
        $news = News::create($options);
        $usersList = Subscriber::sendAll($options, $news);
        if ($news) {
          header("Location: /admin/news");

        }
      }
    }

    // Подключаем вид
   require_once(ROOT . '/views/admin_news/create.php');
    return true;
  }
  public function actionDelete($id)
  {
      // Проверка доступа
      self::checkAdmin();

      // Обработка формы
      if (isset($_POST['submit'])) {
          // Если форма отправлена
          // Удаляем товар
          News::deleteById($id);
          echo $id;

          // Перенаправляем пользователя на страницу управлениями товарами
          header("Location: /admin/news");
      }

      // Подключаем вид
      require_once(ROOT . '/views/admin_news/delete.php');
      return true;
}
public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $news = News::getById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['title'] = $_POST['title'];
            $options['subject'] = $_POST['subject'];     
            News::updateById($id, $options);  
            // Сохраняем изменения
            // if () {


                // // Если запись сохранена
                // // Проверим, загружалось ли через форму изображение
                // if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                  //  move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
            //     }
            // }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/news");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/update.php');
        return true;
    }

}
