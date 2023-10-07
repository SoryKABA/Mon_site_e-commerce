<?php

use App\Core\SendMail\SendMail;


$mail = new SendMail(true);
$error = null;
$success = false;
if(!empty($_GET['id'])) {
    $client = App::getInstance()->getTable('customer')->find($_GET['id']);
    if (empty($_POST['message'])) {
        $error = "Le champ message ne doit pas être vide ";
    }
    if (!empty($_POST)) {
        if ($mail->sendMail($client->getCustomermail(), $client->getCustomername(), htmlentities(nl2br($_POST['message'])))) {
            $success = true;
        }
    }
}else {
    $clients = App::getInstance()->getTable('customer')->all();
    if (!empty($_POST)) {
        foreach ($clients as $client) {
            $message = htmlentities($_POST['message']) . "cliquez sur ce <a href='http://localhost:85/index.php?page=newposts'>lien</a> pour les voir";
            if ($mail->sendMail($client->getCustomermail(), $client->getCustomername(), $message)) {
                $success = true;
            }    
        }
    }
}


?>


<div class="container-fluid m-4">
   <div class="container">
    <?php if($success): ?>
            <div class="alert alert-success">
                Le message a été envoyé avec succès
            </div>
        <?php endif ?>
   </div>
    <?php if($error === null && $error): ?>
            <div class="alert alert-danger">
                <?= $error ?>   
            </div>
        <?php endif ?>
   </div>
    <div class="container">
        <form action="" method="POST" class="mx-4">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message à envoyer</label>
                <textarea class="form-control w-75" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="group-form my-2">
                <button class="btn btn-primary w-50">Envoyer</button>
            </div>    
        </form>
    </div>
</div>