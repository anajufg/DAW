<?php
function carregaPergunta($id) {
$file = __DIR__ . '/../data/questions.json';
if (!file_exists($file)) return null;
$json = file_get_contents($file);
$arr = json_decode($json, true);
if (!isset($arr[$id])) return null;
return $arr[$id];
}


function totalQuestions() {
$file = __DIR__ . '/../data/questions.json';
if (!file_exists($file)) return 0;
$json = file_get_contents($file);
$arr = json_decode($json, true);
return count($arr);
}
?>
