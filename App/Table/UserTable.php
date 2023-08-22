<?php

namespace App\Table;
use App\Core\Table\Table;
use App\Modele\UserModele;

class UserTable extends Table{

    protected $table = "users";


    public function createUser(UserModele $user)
    {
        $ok = $this->create([
            'username' => $user->getUsername(),
            'userlogin' => $user->getUserlogin(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
            'statut' => $user->getStatut()
        ]);
        $user->setId($ok);
        if ($ok) {
            header(('Location: ?page=users&created=1'));
            exit();
        }
    }

    public function updateUser(UserModele $user)
    {
        $ok = $this->update([
            'username' => $user->getUsername(),
            'userlogin' => $user->getUserlogin(),
            'password' => $user->getPassword(),
            'statut' => $user->getStatut()
        ], $user->getId());

        if ($ok) {
            header(('Location: ?page=index&edit=1'));
            exit();
        }
    }
}