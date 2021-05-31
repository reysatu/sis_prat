<?php
namespace App\Controllers;
use App\Models\LoginModel;
class LoginController extends BaseController
{
	public function index()
	{
		return view('login/login');
	}
	public function verificar(){
		$login=new LoginModel;
		$session = \Config\Services::session();
		$email=$this->request->getPostGet("user");
		$password=$this->request->getPostGet("password");
		$traer=$login->verificar($email,$password);
		if (!$traer) {return redirect()->to(site_url("LoginController"));}
		else{
			$datasesion = [
					'id'=>$traer->Id,
					'tipo'=>$traer->Id_Tipo,
					'dni'=>$traer->DNI,
					'nombre'=>$traer->Nombre,
					'login'=> True
				 ];
			$session->set($datasesion);
			return redirect()->to(site_url("InicioController"));
		}

	}

}
