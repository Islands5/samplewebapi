<?php
require 'vendor/autoload.php';
include './functions.php';
$app = new \Slim\Slim();

$app->get('/', function () {
    echo "test ok!!";
});

$app->get('/all', function() {
    $stmt = get_values('select id, name, kana, sex, division, age from employee');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});

/*
 *  年齢に関するAPI
 *  path age/between/変数1/変数2
 *  変数1は小さい方の年齢
 *  変数2は大きい方の年齢
 *  返り値 JSON
 *
*/
$app->get('/age/between/:under/:top', function($under, $top) {
    $sql = "SELECT id, name, kana, sex, division, age FROM employee WHERE age BETWEEN ? AND ?";
    $stmt = get_values($sql);
    $stmt->execute(array($under, $top));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});

/*
 *  ある年齢以上を検索してJSONで返すAPI
 *  path /morethan/変数1
 *  変数1
 *  返り値 JSON
 *
*/
$app->get('/age/morethan/:age', function($age) {
    $sql = "SELECT id, name, kana, sex, division, age FROM employee WHERE age >= ?";
    $stmt = get_values($sql);
    $stmt->execute(array($age));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});
/*
 *  ある年齢以下を検索してJSONで返すAPI
 *  path /lessthan/変数1
 *  変数1
 *  返り値 JSON
 *
*/
$app->get('/age/lessthan/:age', function($age) {
    $sql = "SELECT id, name, kana, sex, division, age FROM employee WHERE age <= ?";
    $stmt = get_values($sql);
    $stmt->execute(array($age));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});
/*
 *  部署に関するAPI
 *  path /division/変数1
 *  変数1 部署名
 *  返り値 変数1と同じになる部署名JSON
 *
*/
$app->get('/division/:name', function($name) {
    $sql = "SELECT id, name, kana, sex, division, age FROM employee WHERE division = ?";
    $stmt = get_values($sql);
    $stmt->execute(array($name));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});
/*
 *  性別による検索をし、JSONで返すAPI
 *  path /sex/変数1
 *  変数1 性別
 *  返り値 変数1と同じになる性別のJSONデータを返す
 *
*/
$app->get('/sex/:sex', function($sex) {
    $sql = "SELECT id, name, kana, sex, division, age FROM employee WHERE sex = ?";
    $stmt = get_values($sql);
    $stmt->execute(array($sex));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = array();
    foreach($result as $row) {
	$rows[] = $row;
    }
    $json = json_encode($rows);
    print($json);
});

$app->contentType("application/json; charset=utf-8");
$app->run(array('debug'=>true));
