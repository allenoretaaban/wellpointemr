@echo off

rem Change to the directory containing this batch file.
cd "%~dp0"

if not exist alttiff.ocx goto bad
start regsvr32 alttiff.ocx
goto end
:bad
echo Error: Cannot find alttiff.ocx.
echo Note: Do not run install.bat directly from your unzip program.
echo You must create a folder and unzip everything into it.
echo Note: The current folder is:
cd
pause
:end

