#!/usr/bin/env bash
###############################################################################
# ALDAR GROUP — Database Restore Script
# Imports the seed backup into the server's MySQL database.
#
# Usage (on the EC2 server):
#   cd /var/www/aldar-api
#   bash deploy/restore-db.sh
#
# This will:
#   1. Drop all existing tables in the 'aldar' database
#   2. Import the full dump (schema + seeded data)
#   3. Run any pending migrations on top
###############################################################################
set -euo pipefail

APP_DIR="${1:-$(pwd)}"
cd "$APP_DIR"

# Read DB credentials from .env
DB_DATABASE=$(grep -E '^DB_DATABASE=' .env | cut -d= -f2)
DB_USERNAME=$(grep -E '^DB_USERNAME=' .env | cut -d= -f2)
DB_PASSWORD=$(grep -E '^DB_PASSWORD=' .env | cut -d= -f2)
DB_HOST=$(grep -E '^DB_HOST=' .env | cut -d= -f2)
DB_PORT=$(grep -E '^DB_PORT=' .env | cut -d= -f2)

DUMP_FILE="${APP_DIR}/deploy/database-seed-backup.sql"

if [ ! -f "$DUMP_FILE" ]; then
    echo "❌ Dump file not found: ${DUMP_FILE}"
    exit 1
fi

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ALDAR API — Database Restore"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  Database : ${DB_DATABASE}"
echo "  Host     : ${DB_HOST}:${DB_PORT}"
echo "  User     : ${DB_USERNAME}"
echo "  Dump     : ${DUMP_FILE}"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

read -rp "⚠️  This will REPLACE all data in '${DB_DATABASE}'. Continue? [y/N] " confirm
if [[ ! "$confirm" =~ ^[Yy]$ ]]; then
    echo "Aborted."
    exit 0
fi

echo ""
echo "[1/4] Dropping all existing tables..."
# Generate and execute DROP statements for all tables
TABLES=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -e "SHOW TABLES;" -s --skip-column-names 2>/dev/null)
if [ -n "$TABLES" ]; then
    mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -e "SET FOREIGN_KEY_CHECKS=0;" 2>/dev/null
    for table in $TABLES; do
        mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -e "DROP TABLE IF EXISTS \`${table}\`;" 2>/dev/null
    done
    mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" -e "SET FOREIGN_KEY_CHECKS=1;" 2>/dev/null
    echo "  → Dropped $(echo "$TABLES" | wc -w | tr -d ' ') tables."
else
    echo "  → Database is empty, nothing to drop."
fi

echo "[2/4] Importing seed backup..."
mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < "$DUMP_FILE" 2>/dev/null
echo "  → Import complete."

echo "[3/4] Running any pending migrations..."
php artisan migrate --force
echo "  → Migrations complete."

echo "[4/4] Clearing caches..."
php artisan config:cache
php artisan route:cache

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ✅ Database restored successfully!"
echo ""
echo "  Admin login:"
echo "    Email:    admin@aldargroup.com"
echo "    Password: Admin@12345"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
