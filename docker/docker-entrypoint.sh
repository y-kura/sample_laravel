#!/bin/bash
cd /sample

composer install

# .envの作成
if [ ! -f .env ]; then
  echo "APP_KEY=" > .env
  php artisan key:generate
fi

# DBの起動待ち
export PGPASSWORD=postgres
until psql -h db -U postgres -c '\l'; do
  echo "postgres waiting"
  sleep 1
done

# マイグレーション
php artisan migrate

# CMDの実行
exec "$@"
