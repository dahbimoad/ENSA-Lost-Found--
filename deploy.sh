#!/bin/bash

# DigitalOcean Deployment Script for Laravel

echo "🚀 Starting Laravel deployment..."

# Install dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
echo "🎨 Building frontend assets..."
npm ci
npm run build

# Clear and cache Laravel configurations
echo "⚙️ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink for file uploads
echo "🔗 Setting up storage..."
# Create storage directories if they don't exist
mkdir -p storage/app/public/items
mkdir -p storage/logs
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
# Remove existing symlink if it exists
if [ -L "public/storage" ]; then
    rm public/storage
fi
# Create the symlink
php artisan storage:link
# Verify the symlink was created
if [ -L "public/storage" ]; then
    echo "✅ Storage symlink created successfully"
else
    echo "❌ Failed to create storage symlink"
fi

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# php artisan db:seed --force

echo "✅ Deployment completed successfully!"
