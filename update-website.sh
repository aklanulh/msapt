#!/bin/bash
# Script untuk update website di Hostinger
# Jalankan script ini setiap kali ingin update website

echo "=== MSAPT Website Update Started ==="

# 1. Git pull latest changes
echo "1. Pulling latest changes from repository..."
git pull origin master

# 2. Fix nested directory issue if exists
echo "2. Checking for nested directory..."
if [ -d "public_html" ]; then
    echo "Found nested directory, fixing..."
    cp -r public_html/* . 2>/dev/null || true
    cp -r public_html/.* . 2>/dev/null || true
    rm -rf public_html
    echo "✅ Nested directory fixed"
fi

# 3. Run auto deployment
echo "3. Running auto deployment..."
php auto-deploy.php

echo "=== ✅ Website Update Completed ==="
echo "Check your website: https://msapt.co.id"
