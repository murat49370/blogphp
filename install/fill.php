<?php

use App\Connection;

require dirname(__DIR__) . '/vendor/autoload.php';
require 'config.php';


$faker = Faker\Factory::create('fr_FR');

$pdo = Connection::get_pdo();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE comment');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$password = password_hash('admin', PASSWORD_DEFAULT);
$pdo->exec("INSERT INTO user VALUES (NULL, 'admin@admin.com', '{$password}', 'Jhon', 'Doe', 'Admin', '{$faker->date} {$faker->time}', 'admin')");
$pdo->exec("INSERT INTO user VALUES (NULL, 'louis@gmail.org', '{$password}', 'Louis', 'Michel', 'Michou', '{$faker->date} {$faker->time}', 'waiting')");
$pdo->exec("INSERT INTO category VALUES (NULL, 'Defaut', 'defaut')");
$pdo->exec("INSERT INTO category VALUES (NULL, 'News', 'news')");


for ($i = 0; $i < 25; $i ++)
{
    try
    {
        $pdo->exec("INSERT INTO post SET post_create='{$faker->date} {$faker->time}',
        post_modified='{$faker->date} {$faker->time}',
        post_title='{$faker->sentence($nbWords = 6)}',
        post_slug='{$faker->slug()}',
        post_short_content='{$faker->paragraph(1)}',
        post_content='{$faker->paragraphs(rand(3, 6), true)}',
        post_status='publish',
        post_main_image='https://placeimg.com/600/200/animals',
        post_small_image='https://placeimg.com/380/230/animals',
        user_id=1");
    }
    catch (Exception $e)
    {
        die('erreur : ' . $e->getMessage());
    }
}

$pdo->exec('INSERT INTO post_category SET post_id=1, category_id=1');
$pdo->exec('INSERT INTO post_category SET post_id=2, category_id=2');
$pdo->exec('INSERT INTO post_category SET post_id=3, category_id=1');
$pdo->exec('INSERT INTO post_category SET post_id=4, category_id=2');
$pdo->exec('INSERT INTO post_category SET post_id=2, category_id=1');
$pdo->exec('INSERT INTO post_category SET post_id=3, category_id=2');


for ($i = 0; $i < 25; $i ++)
{
    try
    {
        $randId = rand(1, 15);
        $pdo->exec("INSERT INTO comment SET 
        comment_author_name='{$faker->name}',
        comment_author_email='{$faker->email}',
        comment_content='{$faker->paragraphs(rand(1, 2), true)}',
        comment_create='{$faker->date} {$faker->time}',
        comment_status='publish',
        post_id=$randId
        ");
    }
    catch (Exception $e)
    {
        die('erreur : ' . $e->getMessage());
    }

}






