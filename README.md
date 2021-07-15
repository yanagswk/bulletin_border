# 環境構築

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# Docker コンテナの停止
docker-compose stop

# Docker コンテナの停止・削除
docker-compose down

```  

srcディレクトリにsrcを書いていく。

## 接続先
http://localhost:8080  


## Todo  
- 送信内容をテキストファイルで保存する。それを取得して表示するようにする。  

- 送信内容をDBに保存する。  

- index.php L22 : 75バイト以下の時の処理を考える。(if breakは使えない。)  

- index.php L106 : formタグをおくとレイアウトが崩れる。なんで？  

- 削除処理、更新処理追加  

- html、cssもうちょいなんとかする。

