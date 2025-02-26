<?php
/*
=====================================================
 php_folder_viewer - by TCSE
-----------------------------------------------------
 Версия: v1.4 от 2025-02-26
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

$col = "<br><br><p align=\"center\"><font class=\"well\">tcse-cms.com &copy; 2016 - 2025.</font></p>";
$self = basename($PHP_SELF);
$dn = opendir('.');
$dir = dirname("$SERVER_NAME$PHP_SELF");

// Функция для определения иконки по типу файла
function getFileIcon($file) {
    $extensions = [
        'txt' => 'fa-file-text-o fa-fw',
        'pdf' => 'fa-file-pdf-o fa-fw',
        'doc' => 'fa-file-word-o fa-fw',
        'docx' => 'fa-file-word-o fa-fw',
        'xls' => 'fa-file-excel-o fa-fw',
        'xlsx' => 'fa-file-excel-o fa-fw',
        'ppt' => 'fa-file-powerpoint-o fa-fw',
        'pptx' => 'fa-file-powerpoint-o fa-fw',
        'jpg' => 'fa-file-image-o fa-fw',
        'jpeg' => 'fa-file-image-o fa-fw',
        'png' => 'fa-file-image-o fa-fw',
        'gif' => 'fa-file-image-o fa-fw',
        'mp3' => 'fa-file-audio-o fa-fw',
        'mp4' => 'fa-file-video-o fa-fw',
        'zip' => 'fa-file-archive-o fa-fw',
        'rar' => 'fa-file-archive-o fa-fw',
        '7z' => 'fa-file-archive-o fa-fw',
    ];

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    return isset($extensions[$ext]) ? $extensions[$ext] : 'fa-file-o fa-fw';
}

// Сортировка файлов
$filesAndDirs = [];
while ($file = readdir($dn)) {
    switch ($file) {
        case(".."):
        case("."):
        case("$self"):
        case("index.php"):
            break;
        default:
            $filesAndDirs[] = $file;
            break;
    }
}
closedir($dn);

// Подсчет количества файлов и папок
$fileCount = count($filesAndDirs);

// Сортировка по алфавиту или расширению
$sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? SORT_DESC : SORT_ASC;

if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'alpha') {
        sort($filesAndDirs, $sortOrder);
    } elseif ($_GET['sort'] == 'ext') {
        usort($filesAndDirs, function ($a, $b) use ($sortOrder) {
            $extA = pathinfo($a, PATHINFO_EXTENSION);
            $extB = pathinfo($b, PATHINFO_EXTENSION);
            return $sortOrder == SORT_DESC ? strcmp($extB, $extA) : strcmp($extA, $extB);
        });
    }
}

print "
<html>
  <head>
  <title>Обзор каталога $dir </title>

  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
  <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>
  <script>
    // Реализация фильтрации в реальном времени
    $(document).ready(function() {
      $('#search').on('input', function() {
          var query = $(this).val().toLowerCase();
          $('.file-item').each(function() {
              var fileName = $(this).text().toLowerCase();
              if (fileName.includes(query)) {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });
      });
    });
  </script>
  </head>

<body>
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4\">
        <div class=\"list-group\">
          <p><br></p>
          <!-- Форма поиска -->
          <input type=\"text\" id=\"search\" placeholder=\"Поиск...\" class=\"form-control\">
          <!-- Ссылки на сортировку -->
          <a href=\"?sort=alpha&order=" . ($sortOrder == SORT_ASC ? "desc" : "asc") . "\" class=\"list-group-item list-group-item-success\" title=\"Сортировать по алфавиту\"><i class=\"fa " . ($sortOrder == SORT_ASC ? "fa-sort-alpha-asc" : "fa-sort-alpha-desc") . "\"></i> Сортировать по алфавиту</a>
          <a href=\"?sort=ext&order=" . ($sortOrder == SORT_ASC ? "desc" : "asc") . "\" class=\"list-group-item list-group-item-warning\" title=\"Сортировать по расширению\"><i class=\"fa " . ($sortOrder == SORT_ASC ? "fa-sort" : "fa-sort-desc") . "\"></i> Сортировать по расширению</a>
          <!-- Ссылка на уровень выше -->
          <a href=\"$dir/..\" class=\"list-group-item list-group-item-info\" title=\"На уровень выше.\">
            <font face=\"tahoma\" color=\"#808080\" size=\"+2\">
              <b>$SERVER_NAME <i class=\"fa fa-level-up fa-2x\"></i> </b>
              (Всего файлов и папок: $fileCount)
            </font>
          </a>
          ";
          // Вывод списка файлов и папок
          foreach ($filesAndDirs as $item) {
              if (is_dir($item)) {
                  print "<a href=\"$item\" class=\"list-group-item file-item\"><i class=\"fa fa-folder-o fa-fw text-info\"></i> $item</a>\n";
              } else {
                  print "<a href=\"$item\" class=\"list-group-item file-item\"><i class=\"fa " . getFileIcon($item) . "\"></i> $item</a>\n";
              }
          }
          print "
          $col <br>
        </div>
      </div>
    </div>
  </div>

</body>\n</html>";
?>
