<?php
$pc = 0;
$cc = 0;

$stringPostsJson = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$arryPostsObj = json_decode($stringPostsJson, true);

$jsonStringComments = file_get_contents('https://jsonplaceholder.typicode.com/comments');
$arryCommentsObj = json_decode($jsonStringComments, true);

require 'connect.php';

foreach ($arryPostsObj as $item) 
{	
    $sql = "INSERT INTO posts (userId, id, title, body) VALUES (?, ?, ?, ?)" ;
	$stmt = $connect -> prepare($sql);
	$stmt -> bind_param('iiss', $item['userId'], $item['id'], $item['title'], $item['body']);	
	$stmt -> execute();
	$pc +=1;
}

foreach ($arryCommentsObj as $item) 
{	
    $sql = "INSERT INTO comments (postId, id, name, email, body) VALUES (?, ?, ?, ?, ?)" ;
	$stmt = $connect -> prepare($sql);
	$stmt -> bind_param('iisss', $item['postId'], $item['id'], $item['name'], $item['email'], $item['body']);	
	$stmt -> execute();
	$cc +=1;
}

$connect -> close();
