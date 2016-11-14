<?php
/*
=====================================================
 php_folder_viewer - by TCSE
-----------------------------------------------------
 Версия: v1.2 от 2016-11-13
-----------------------------------------------------
 Copyright (c) 2016 TCSE http://tcse-cms.com/
=====================================================
 Автор скрипта: Николай Чуяков nikolay@chuyakov.ru
 Доработка: Виталий Чуяков mail@tcse-cms.com
=====================================================
 Файл: index.php
-----------------------------------------------------
 Назначение: Просмотр всех файлов и папок внутри каталога. Просто откройте данный файл в браузере.
=====================================================
*/

$col="<br><br><p align=\"center\"><font class=\"well\">tcse-cms.com &copy; 2016.</font></p>";
$self=basename($PHP_SELF);
$dn=opendir('.');
$dir=dirname("$SERVER_NAME$PHP_SELF");
print"

<html>
  <head>
  <title>Обзор каталога $dir </title>

  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

  <link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" rel=\"stylesheet\" >
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>


  </head>

<body>
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4\">
        <div class=\"list-group\">
          <p><br></p>
          ";
          while($file=readdir($dn)):
             switch($file):
               case(".."):
                 print"<a href=\"$file\" class=\"list-group-item list-group-item-info\" title=\"На уровень выше.\"><font face=\"tahoma\" color=\"#808080\" size=\"+2\"><b>$SERVER_NAME <i class=\"fa fa-level-up fa-2x\"></i> </b></font></a><Font color=\"#0000080\" size=\"+2\">$dir</font>\n";break;
               case("."):
                 print""; break;       //  не выдавать ссылки наверх.
               case("$self"):
                 print"" ;break;       // не показывать этот файл в списке
               case("index.html"):
                 print"" ;break;       // не показывать index.html
               default:
                print"<a href=\"$file\" class=\"list-group-item\" title=\"Download.\">$file</a>\n";break;
             endswitch;
          endwhile;
          print"
          $col <br>
        </div>
      </div>
    </div>
  </div>

</body>\n</html>";
// print"http://$SERVER_NAME$PHP_SELF";
?>