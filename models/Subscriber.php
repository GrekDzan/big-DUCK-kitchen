<?php

class Subscriber {
  public static function create($options)
  {
    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'INSERT INTO subscribers '
            . '(email)'
            . 'VALUES '
            . '(:email)';

    // Получение и возврат результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->bindParam(':email', $options['email'], PDO::PARAM_STR);


    if ($result->execute()) {
        // Если запрос выполенен успешно, возвращаем id добавленной записи
        return $db->lastInsertId();
    }
    // Иначе возвращаем 0
    return 0;

  }
  public static function sendAll($options, $newsIndex)
  {
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'SELECT * FROM subscribers';

    // Используется подготовленный запрос
    $result = $db->prepare($sql);
    // $result->bindParam(':id', $id, PDO::PARAM_INT);

    // Указываем, что хотим получить данные в виде массива
    $result->setFetchMode(PDO::FETCH_ASSOC);
    

    // Выполняем запрос
    $result->execute();

    // Возвращаем данные
    $result->fetchAll();
    foreach ($result as $subscriber) 
    {
        $message = "Новая новость от big DUCK kitchen: http://diplom/news/{$newsIndex}";
        $subject = 'Новая новость';
        $emailResult = mail($subscriber['email'], $subject, $message); 

    }
  }    
}
