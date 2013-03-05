<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
	}
	public function index()
	{
		if ($this->session->userdata('id'))
		{
			redirect('inicio');
		}else
		{
			$this->load->view('usuarios/login');
		}
	}
	public function validar()
	{
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>'); 
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');
		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('min_length','El Campo %s debe tener mas de 5 caracteres');
		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 12 caracteres');
		if ($this->form_validation->run() == FALSE)
        {
           $this->load->view('usuarios/login');
        }
        else
        {
           $this->login($usuario,$clave);
        }
	}
	public function login($usuario,$clave)
	{
		if($datos = $this->usuario->entrar($usuario,$clave))
		{
				foreach ($datos as $row)
				{
				    $session = array
				    (
				    	'id' => $row->id ,
				    	'nombre' =>$row->nombre ,
				    	'usuario' => $row->usuario  
				    );
				    $this->session->set_userdata($session);
				}
			redirect('inicio');
		}else
		{
			$msj['error'] = '<div class="alert alert-error">Usuario o Contraseña Icorrectos</div>';
			$this->load->view('usuarios/login', $msj);
		}
	}
	public function logout()
	{
		 $session = array
				    (
				    	'id' => "" ,
				    	'nombre' =>"",
				    	'usuario' => ""  
				    );
				    $this->session->unset_userdata($session);
		redirect('usuarios'); 
	}
}/* End of file login.php */

/* Location: ./application/controllers/usuarios/login.php */