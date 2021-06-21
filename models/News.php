<?php

class News {
  public static function create($options)
  {
    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'INSERT INTO news '
            . '(title, subject, pub_date)'
            . 'VALUES '
            . '(:title, :subject, :pub_date)';
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
            $result->bindParam(':subject', $options['subject'], PDO::PARAM_STR);
            $result->bindParam(':pub_date', $options['pub_date'], PDO::PARAM_STR);
        

    if ($result->execute()) {
        // Если запрос выполенен успешно, возвращаем id добавленной записи
        return $db->lastInsertId();
    }
    // Иначе возвращаем 0
    return 0;

  }
  public static function getAll()
  {
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'SELECT * FROM News ';

    // Используется подготовленный запрос
    $result = $db->prepare($sql);
    // $result->bindParam(':id', $id, PDO::PARAM_INT);

    // Указываем, что хотим получить данные в виде массива
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // Выполняем запрос
    $result->execute();

    // Возвращаем данные
    return $result->fetchAll();
  }
    public static function deleteById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM news WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function updateById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE news
            SET 
                title = :title,
                subject = :subject
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':subject', $options['subject'], PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM news WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }
}
