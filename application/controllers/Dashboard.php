<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('Saldo_model');
	}
	public function index()
	{
		$id_usuario = $this->session->userdata("id");
		$data = array (
			'saldo' =>  $this->Saldo_model->consulta($id_usuario)
		);
		//print_r($data);
		$this->load->view('dashboard', $data);
		$this->load->view('depositar');
		$this->load->view('retirar');
	}
	public function deposito($id_usuario,$monto){
		$saldo = $this->Saldo_model->consulta($id_usuario);
		$saldo = $saldo->monto;
		//echo $saldo;
		$newsaldo = $saldo + $monto;
		//echo $newsaldo;
		$data = array(
			'monto' => $newsaldo
		);
		$resultado = $this->Saldo_model->updateSaldo($id_usuario,$data);
		print_r($resultado);
	}
	public function retiro($id_usuario,$monto){
		$saldo = $this->Saldo_model->consulta($id_usuario);
		$saldo = $saldo->monto;
		//echo $saldo;
		$newsaldo = $saldo - $monto;
		//echo $newsaldo;
		$data = array(
			'monto' => $newsaldo
		);
		$resultado = $this->Saldo_model->updateSaldo($id_usuario,$data);
		print_r($resultado);
	}
	public function consulta($id_usuario){
		$usuario = $this->Saldo_model->consulta($id_usuario);
		echo $usuario->monto;
	}
}
