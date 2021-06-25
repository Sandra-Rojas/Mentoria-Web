<?php

class m00001_initial
{
    //aplica cambio
    public function up()    
    {
        $db = \app\core\Application::$app->db;

        $sql = "CREATE TABLE `users2` (
            `id` int NOT NULL,
            `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
          
         $db->pdo->exec($sql);

         $sql ="ALTER TABLE `users2`
            ADD PRIMARY KEY (`id`);";
         $db->pdo->exec($sql);

         $sql ="ALTER TABLE `users2`
            MODIFY `id` int NOT NULL AUTO_INCREMENT;";
         $db->pdo->exec($sql);
          
    }

    //revierte cambio
    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql= "DROP TABLE `users2`;";
        $db->pdo->exec($sql);

    }
}