<?php
DEFINE("CHANNEL_ACCESS_TOKEN","fP+JfiO9YOKkddAPqTRWrcZWE6k1H7VMgNRLEq2ZW8rK+qsw1vwe9bS9N+pD5jdYoO8j7KERUIUnTr7Al6N/xZbQUvSbLcUeLL22ff7Bylx0lAFfU3rTAOQxkz3Ra7MbKYthsHhjWQvR8UBKtbUTzgdB04t89/1O/w1cDnyilFU=");
DEFINE("CHANNEL_SECRET","679973fb96c4a04b00c214a2f17c5df8");


// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(CHANNEL_ACCESS_TOKEN);

// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => CHANNEL_SECRET]);

// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。政党であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

// 配列に格納された各イベントをループで処理
foreach($events as $event){
  // テキストを返信
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
