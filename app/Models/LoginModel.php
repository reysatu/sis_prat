<?php namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{ 

    function verificar($usuario,$password){
      $db=db_connect();
      $mostrar=$db->query("SELECT * 
                            FROM usuario 
                            WHERE Login='".$usuario."' and Clave='".$password."' and deleted_at is null
                              ");
      $row = $mostrar->getRow();
      if (isset($row)){ return $row;}
      else{ return false;}

  	}
}