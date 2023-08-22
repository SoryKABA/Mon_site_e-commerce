<?php

if (!empty($_POST)) {

   $ok = App::getInstance()->getTable('category')->delete((int)$_POST['id']);
   if ($ok) {
        header("Location: ?page=category&success=1");
        exit();
   }
}