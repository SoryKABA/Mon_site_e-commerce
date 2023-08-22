<?php

if (!empty($_POST)) {

   $ok = App::getInstance()->getTable('user')->delete((int)$_POST['id']);
   if ($ok) {
        header("Location: ?page=users&success=1");
        exit();
   }
}