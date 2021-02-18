#!/bin/bash
cd /sample

composer install

# DBの起動待ち
export PGPASSWORD=postgres
until psql -h db -U postgres -c '\l'; do
  echo "Postgresの起動を待っています..."
  sleep 1
done

# .envの作成
if [ ! -f .env ]; then
  echo ".envファイルを作成"
  cat <<-EOF > .env
APP_KEY=
APP_ENV=local
APP_DEBUG=true
EOF
  php artisan key:generate
fi

# migrate:statusに「Yes」の文字があったら初期化済みとみなす
# ※マイグレーションしてない場合の出力例
# +------+--------------------------------+-------+
# | Ran? | Migration                      | Batch |
# +------+--------------------------------+-------+
# | No   | 2021_01_01_000000_create_table |       |
# +------+--------------------------------+-------+
php artisan migrate:status | grep "Yes" > /dev/null
if [ $? = 0 ]; then
  echo "マイグレーションを実行"
  php artisan migrate
else
  echo "DBを初期化"
  php artisan migrate:fresh --seed
fi

# CMDの実行
if [ $# != 1 ]; then exec "$@"; fi
