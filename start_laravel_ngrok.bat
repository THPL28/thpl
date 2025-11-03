@echo off
title Laravel + ngrok

REM Navega até a pasta do projeto
cd /d C:\Users\THPL\Desktop\Desenvolvimento\thpl

REM Inicia o Laravel em uma janela separada
start cmd /k "php artisan serve"

REM Espera 3 segundos para o Laravel subir
timeout /t 3 /nobreak

REM Inicia o ngrok na porta 8000 em outra janela
start cmd /k "ngrok http 8000"

REM Mensagem final
echo Laravel e ngrok iniciados!
pause
