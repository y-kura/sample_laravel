#!/bin/bash
cd /sample

composer install

# DBの起動待ち
export PGPASSWORD=postgres
until psql -h db -U postgres -c '\l'; do
  echo "postgres waiting"
  sleep 1
done

# 初回のみ
if [ ! -f .env ]; then
  echo "APP_KEY=" > .env
  php artisan key:generate
  php artisan migrate:fresh --seed
fi

# マイグレーション
php artisan migrate

# CMDの実行
exec "$@"
