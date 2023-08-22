<?php

namespace App\Table;
use App\Core\Table\Table;
use App\Modele\CustomerModele;

class CustomerTable extends Table{

    protected $table = "customers";


    public function createCustomer(CustomerModele $customer)
    {
        $ok = $this->create([
            'customername' => $customer->getCustomername(),
            'customermail' => $customer->getCustomermail(),
            'customerpassword' => $customer->getCustomerpassword()
        ]);
        $customer->setId($ok);
        if ($ok) {
            header(('Location: index.php?page=index'));
            exit();
        }
    }

    public function updateCustomer(CustomerModele $customer)
    {
        $ok = $this->update([
            'customername' => $customer->getCustomername(),
            'customermail' => $customer->getCustomermail(),
            'customerpassword' => $customer->getCustomerpassword()
        ], $customer->getId());

        if ($ok) {
            header(('Location: index.php?page=index'));
            exit();
        }
    }
}