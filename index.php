<?php

include('functions.php');

$index = file_get_contents('index.html');

$main_content = make_main_content($index);

make_basic_page($page_name, $main_content);

?>