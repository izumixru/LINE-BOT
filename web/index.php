<?php

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/composer/autoload_real.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getnv('CHANNEL_SECRET')]);

// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。政党であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(filie_get_contents('php://input'),$signature);

// 配列に格納された各イベントをループで処理
foreach($events as $event){
  // テキストを返信
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
