<?php
/*
=====================================================
 php_folder_viewer - by TCSE
-----------------------------------------------------
 Версия: v1.0 от 2004-10-29
-----------------------------------------------------
 Copyright (c) 2004 TCSE http://tcse-cms.com/
=====================================================
 Автор скрипта: Николай Чуяков nikolay@chuyakov.ru
=====================================================
 Файл: index.php
-----------------------------------------------------
 Назначение: Просмотр всех файлов и папок внутри каталога. Просто откройте данный файл в браузере.
=====================================================
*/

$col="<p align=\"center\"><font class=\"col\">Chew_and_Talik &copy; 2004.</font></p>";
$self=basename($PHP_SELF);
$dn=opendir('.');
$dir=dirname("$SERVER_NAME$PHP_SELF");
print"
<html>
<head>
<title>Обзор каталога $dir </title>
<style>
.col {
        text-decoration: none;
        color: #000000;
        font-size: 12pt;
        font-weight:bold;
        font-family: sans-serif;
}

A {
        text-decoration: none;
        color: #000080;
        font-size: 15pt;
        font-style: underline;
        font-family: sans-serif;
}

A:Hover {
        color: #f00000;

}
</style>
</head>
<body>

";
while($file=readdir($dn)):
   switch($file):
     case(".."):
       print"<a href=\"$file\"><font face=\"tahoma\" color=\"#808080\" size=\"+2\"><b>$SERVER_NAME / </b></font></a><br><Font color=\"#0000080\" size=\"+2\">$dir</font><br>\n";break;
     case("."):
       print""; break;       //  не выдавать ссылки наверх.
     case("$self"):
       print"" ;break;       // не показывать этот файл в списке
     case("index.html"):
       print"" ;break;       // не показывать index.html
     default:
      print"<a href=\"$file\" title=\"Download.\">$file</a><br>\n";break;
   endswitch;
endwhile;
print"
$col <br>
</body>\n</html>";
// print"http://$SERVER_NAME$PHP_SELF";
?>