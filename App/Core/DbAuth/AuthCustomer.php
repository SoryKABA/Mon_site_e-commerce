<?php 

namespace App\Core\DbAuth;


class AuthCustomer extends DbAuth{

    protected $db;

    public function login($adressMail, $password)
    {
        $customer = $this->db->prepare("SELECT * FROM customers WHERE customermail = ?", [$adressMail], null, true);
        if ($customer) {
            if (password_verify($password, $customer->customerpassword)) {
                if ($customer->statut === 1) {
                    
                    $_SESSION['authe'] = $customer->id;
                    return true;
                }
            }
        }
        return false;
    }
}