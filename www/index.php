<?php
/*
=====================================================
 php_folder_viewer - by TCSE
-----------------------------------------------------
 ������: v1.0 �� 2004-10-29
-----------------------------------------------------
 Copyright (c) 2004 TCSE http://tcse-cms.com/
=====================================================
 ����� �������: ������� ������ nikolay@chuyakov.ru
=====================================================
 ����: index.php
-----------------------------------------------------
 ����������: �������� ���� ������ � ����� ������ ��������. ������ �������� ������ ���� � ��������.
=====================================================
*/

$col="<p align=\"center\"><font class=\"col\">Chew_and_Talik &copy; 2004.</font></p>";
$self=basename($PHP_SELF);
$dn=opendir('.');
$dir=dirname("$SERVER_NAME$PHP_SELF");
print"
<html>
<head>
<title>����� �������� $dir </title>
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
       print""; break;       //  �� �������� ������ ������.
     case("$self"):
       print"" ;break;       // �� ���������� ���� ���� � ������
     case("index.html"):
       print"" ;break;       // �� ���������� index.html
     default:
      print"<a href=\"$file\" title=\"Download.\">$file</a><br>\n";break;
   endswitch;
endwhile;
print"
$col <br>
</body>\n</html>";
// print"http://$SERVER_NAME$PHP_SELF";
?>