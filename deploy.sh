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
echo "🔗 Creating storage symlink..."
php artisan storage:link

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# php artisan db:seed --force

echo "✅ Deployment completed successfully!"
