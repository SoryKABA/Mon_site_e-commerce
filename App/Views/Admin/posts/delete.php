<?php

if (!empty($_POST)) {

   $ok = App::getInstance()->getTable('post')->delete((int)$_POST['id']);
   if ($ok) {
        header("Location: ?page=index&success=1");
        exit();
   }
}