@echo off
echo Watching for changes in Tailwind CSS files...
cd /d "%~dp0"
call node_modules\.bin\tailwindcss.cmd -i ./assets/css/tailwind-source.css -o ./assets/css/tailwind.css --watch
