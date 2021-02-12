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
  cat <<-EOF > .env
APP_KEY=
APP_ENV=local
APP_DEBUG=true
EOF
  php artisan key:generate
  php artisan migrate:fresh --seed
fi

# マイグレーション
php artisan migrate

# CMDの実行
if [ $# != 1 ]; then exec "$@"; fi
