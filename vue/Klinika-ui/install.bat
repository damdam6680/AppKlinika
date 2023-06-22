@echo off
echo Instalowanie zalezności...

call npm install

call npm update --force

echo Uruchamianie serwera...
call npm run dev