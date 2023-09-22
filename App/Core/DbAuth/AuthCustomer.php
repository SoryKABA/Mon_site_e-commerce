<?php 

namespace App\Core\DbAuth;


class AuthCustomer extends DbAuth{

    protected $db;

    public function login($adressMail, $password)
    {
        $customer = $this->db->prepare("SELECT * FROM customers WHERE customerlogin = ?", [$adressMail], null, true);
        if ($customer) {
            if (password_verify($password, $customer->password)) {
                if ($customer->statut === 0) {
                    
                    $_SESSION['auth'] = $customer->id;
                    return true;
                }
            }
        }
        return false;
    }
}