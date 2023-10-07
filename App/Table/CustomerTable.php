<?php

namespace App\Table;
use App\Core\Table\Table;
use App\Modele\CustomerModele;

class CustomerTable extends Table{

    protected $table = "customers";


    public function createCustomer(CustomerModele $customer)
    {
        if ($this->showNewCustomer($customer->getCustomermail()) == null) {
            
            $ok = $this->create([
                'customername' => $customer->getCustomername(),
                'customermail' => $customer->getCustomermail(),
                'confirm' => rand(1000, 20000),
                'statut' => 0,
                'customerpassword' => password_hash($customer->getCustomerpassword(), PASSWORD_BCRYPT)
            ]);
            $customer->setId($ok);
            if ($ok) {
                header(('Location: index.php?page=index'));
                exit();
            }
        }else {
            return <<<HTML
            <div class="alert alert-danger">Ce compte existe déjà</div>
HTML;
        }
    }

    public function showNewCustomer($email)  
    {
        return $this->query("SELECT * FROM {$this->table} WHERE customermail = ?", [$email], true);
    }

    public function updateCustomer(CustomerModele $customer)
    {
        $ok = $this->update([
            'customername' => $customer->getCustomername(),
            'customermail' => $customer->getCustomermail(),
            'statut' => 1,
            'customerpassword' => password_hash($customer->getCustomerpassword(), PASSWORD_BCRYPT)
        ], $customer->getId());

        if ($ok) {
            header(('Location: index.php?page=index'));
            exit();
        }
    }

    public function updateCustomerPassword(CustomerModele $customer)
    {
        $ok = $this->query("UPDATE {$this->table} SET customerpassword = ? WHERE id = ?", [password_hash($customer->getCustomerpassword(), PASSWORD_DEFAULT), $customer->getId()], true);

        if ($ok) {
            header("Location: ?page=Clientlogin");
            http_response_code(301);
        }
    }
}