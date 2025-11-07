min js
npx terser js/*.js --compress --mangle --output js/min/min.js

npx terser js\script.js --compress --mangle --output js\min\script.min.js
npx terser js\vanta.js --compress --mangle --output js\min\vanta.min.js
npx terser js\loader.js --compress --mangle --output js\min\loader.min.js

min css
npx cleancss -o css/min/style.min.css css/*.css

min php
npx html-minifier-terser index.php -o index.min.php --collapse-whitespace --remove-comments --minify-css true --minify-js true



========================================================================================================================================



Get-ChildItem "C:\laragon\www\portfol\components" -Recurse -Filter "*.php" | Where-Object { $_.FullName -notmatch "\\min\\" } | ForEach-Object {
    $relPath = $_.FullName.Replace("C:\laragon\www\portfol\components\", "")
    $outPath = "C:\laragon\www\portfol\components\min\" + $relPath
    $outDir = Split-Path $outPath
    if (!(Test-Path $outDir)) { New-Item -ItemType Directory -Force -Path $outDir }
    npx html-minifier-terser $_.FullName -o $outPath --collapse-whitespace --remove-comments --minify-css true --minify-js true
}

Get-ChildItem "C:\laragon\www\portfol\pages" -Recurse -Filter "*.php" | Where-Object { $_.FullName -notmatch "\\min\\" } | ForEach-Object {
    $relPath = $_.FullName.Replace("C:\laragon\www\portfol\pages\", "")
    $outPath = "C:\laragon\www\portfol\pages\min\" + $relPath
    $outDir = Split-Path $outPath
    if (!(Test-Path $outDir)) { New-Item -ItemType Directory -Force -Path $outDir }
    npx html-minifier-terser $_.FullName -o $outPath --collapse-whitespace --remove-comments --minify-css true --minify-js true
}


# Copy index.php to a temp file
Copy-Item index.php index.temp.php

# Replace include paths to point to min folders
(Get-Content index.temp.php) -replace "include 'components/", "include 'components/min/" | Set-Content index.temp.php
(Get-Content index.temp.php) -replace "include 'pages/", "include 'pages/min/" | Set-Content index.temp.php

# Minify the temp file
npx html-minifier-terser index.temp.php -o index.min.php --collapse-whitespace --remove-comments --minify-css true --minify-js true

# Delete temp file
Remove-Item index.temp.php



name: Deploy to InfinityFree

on:
  push:
    branches:
      - master

jobs:
  ftp-deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Show repo contents
        run: ls -la

      - name: FTP Deploy
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          local-dir: ./
          server-dir: /htdocs/
          log-level: verbose
          security: strict    # ✅ use "loose" for InfinityFree
