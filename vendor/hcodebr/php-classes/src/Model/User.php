<?php

namespace Hcode\Model;

use \Exception;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

    const SESSION = "User";

    public static function login($login, $password){

        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN" => $login
        ));

        if (count($results) === 0) {
            throw new Exception("Usuário inexistente ou inválido!");
        }

        $data = $results[0];

        /* Função que Verifica se o HASH da senha digitada bate com a do Banco */
        if (password_verify($password, $data["despassword"]) === true){
            $user = new User();

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;
            
        }
        else{
            throw new Exception("Usuário inexistente ou inválido!");
        }
    }

}

?>