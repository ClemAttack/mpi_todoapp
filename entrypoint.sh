#!/bin/sh
set -e

echo "==> Starting Laravel container"

# Storage link (idempotent)
php artisan storage:link --force 2>/dev/null || true

# Migrations
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "==> Running migrations"
    php artisan migrate --force
fi

# Seeders
if [ "$RUN_SEEDERS" = "true" ]; then
    echo "==> Running seeders"
    php artisan db:seed --force
fi

echo "==> Launching Apache"
exec apache2-foreground
