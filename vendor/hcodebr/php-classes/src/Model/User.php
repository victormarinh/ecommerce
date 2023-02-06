<?php

namespace Hcode\Model;

use \Exception;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

    public static function login($login, $password){

        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_users deslogin = :LOGIN", array(
            ":LOGIN" => $login
        ));

        if (count($results) === 0) {
            throw new Exception("Usuário inexistente ou inválido!");
        }

        $data = $results[0];

        /* Função que Verifica se o HASH da senha digitada bate com a do Banco */
        if (password_verify($password, $data["despassword"]) === true){
            $user = new User();
        }
        else{
            throw new Exception("Usuário inexistente ou inválido!");
        }
    }

}

?>