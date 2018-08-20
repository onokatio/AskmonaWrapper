# AskMonaAPIwrapper
国産暗号通貨モナコインを投げられる掲示板Askmona.orgのAPIラッパーを作りました
## Askmona.orgのAPIのラッパーをPHPで書きました。

※あくまで公式リファレンス( https://askmona.org/developers )を使いやすくしただけです。公式リファレンスを完全に理解している方向けに説明をします。

# 基本的な使い方
デモをdemo.phpとして付属してあるので中身を読むことを推奨します。

## コンストラクト
```
Askmona(string $token, int $u_id, strinqig $devkey = '', int $app_id = 0);

$token ユーザーのシークレットキー
$u_id ユーザーのID
$devkey アプリケーションキー
$app_id アプリケーションID
```

## GET系のAPI向け
```
Askmona::get(string $url, array $query);

$url APIエンドポイントのv1/以下
$query GETリクエストの連想配列
```

## POST系のAPI向け
```
Askmona->post(string $url, array $query);

$url APIエンドポイントのv1/以下
$query POSTリクエストの連想配列
** ※app_id,u_id,nonce,time,auth_keyは自動で追加されます **
```

# 返り値に関して
公式APIを叩いた結果のjsonをオブジェクトにして返しています。
また、POSTの返り値オブジェクトには`_`という特別な名前のメンバが入っており、その中にはPOSTを呼んだインスタンスが代入されています。
なので、POSTしたらGETしたいときは`_`を参照すれば見やすいコードを書くことができます。

API本体はsrc/onokatio/AskmonaWrapper/Askmona.phpとなっています。
Namespaceはonokatio\AskmonaWrapperです。
適当な場所に置いてrequireしてください。

**Composer対応しました。onokatio/AskmonaWrapper:1.1でアクセス可能です。**
