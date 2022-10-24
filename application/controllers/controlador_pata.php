<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Welcome extends CI_Controller {
 
 public function index()
 {
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('main',[],true);
      $mpdf->WriteHTML($html);
      $mpdf->Output(); // opens in browser
      //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
 }
 

 function conteleccomparacion()
{
	$submit = $this->input->post('enviar');
	$depe_eleanio_actual = $this->input->post('depe_eleanio_actual');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadtablaseleccomparacion')
	{
		$this->modelo_factor_gei->creatablascomparacionelec();
		$this->modelo_factor_gei->droprtablascompelecactualypasado();
		$this->modelo_factor_gei->creatablascomparacionelec();
		redirect("control_factor_gei/conteleccomparacion");
	}
	else
	{
		// Carga combobox campus

		$data['catdepes']	= $this->modelo_factor_gei->catdepesxragraficoanioactual();

		// Genera las consultas por dependencias
		$data['resultdependencia'] = $this->modelo_factor_gei->graficaelecdepeyear();

		$data['depe_eleanio_actual'] = $depe_eleanio_actual;


	if(!empty($depe_eleanio_actual))
	{
		$data['Eneroelecactualyear'] = $this->modelo_factor_gei->Eneroelecactualyear($depe_eleanio_actual);
		$data['Febreroelecactualyear'] = $this->modelo_factor_gei->Febreroelecactualyear($depe_eleanio_actual);
		$data['Marzoelecactualyear'] = $this->modelo_factor_gei->Marzoelecactualyear($depe_eleanio_actual);
		$data['Abrilelecactualyear'] = $this->modelo_factor_gei->Abrilelecactualyear($depe_eleanio_actual);
		$data['Mayoelecactualyear'] = $this->modelo_factor_gei->Mayoelecactualyear($depe_eleanio_actual);
		$data['Junioelecactualyear'] = $this->modelo_factor_gei->Junioelecactualyear($depe_eleanio_actual);
		$data['Julioelecactualyear'] = $this->modelo_factor_gei->Julioelecactualyear($depe_eleanio_actual);
		$data['Agostoelecactualyear'] = $this->modelo_factor_gei->Agostoelecactualyear($depe_eleanio_actual);
		$data['Septiembreelecactualyear'] = $this->modelo_factor_gei->Septiembreelecactualyear($depe_eleanio_actual);
		$data['Octubreelecactualyear'] = $this->modelo_factor_gei->Octubreelecactualyear($depe_eleanio_actual);
		$data['Noviembreelecactualyear'] = $this->modelo_factor_gei->Noviembreelecactualyear($depe_eleanio_actual);
		$data['Diciembreelecactualyear'] = $this->modelo_factor_gei->Diciembreelecactualyear($depe_eleanio_actual);
	}	
	else{
		if(!!empty($depe_eleanio_actual))
	{
		$data['Eneroelecactualyear'] = $this->modelo_factor_gei->Eneroelecactualyear($depe_eleanio_actual);
		$data['Febreroelecactualyear'] = $this->modelo_factor_gei->Febreroelecactualyear($depe_eleanio_actual);
		$data['Marzoelecactualyear'] = $this->modelo_factor_gei->Marzoelecactualyear($depe_eleanio_actual);
		$data['Abrilelecactualyear'] = $this->modelo_factor_gei->Abrilelecactualyear($depe_eleanio_actual);
		$data['Mayoelecactualyear'] = $this->modelo_factor_gei->Mayoelecactualyear($depe_eleanio_actual);
		$data['Junioelecactualyear'] = $this->modelo_factor_gei->Junioelecactualyear($depe_eleanio_actual);
		$data['Julioelecactualyear'] = $this->modelo_factor_gei->Julioelecactualyear($depe_eleanio_actual);
		$data['Agostoelecactualyear'] = $this->modelo_factor_gei->Agostoelecactualyear($depe_eleanio_actual);
		$data['Septiembreelecactualyear'] = $this->modelo_factor_gei->Septiembreelecactualyear($depe_eleanio_actual);
		$data['Octubreelecactualyear'] = $this->modelo_factor_gei->Octubreelecactualyear($depe_eleanio_actual);
		$data['Noviembreelecactualyear'] = $this->modelo_factor_gei->Noviembreelecactualyear($depe_eleanio_actual);
		$data['Diciembreelecactualyear'] = $this->modelo_factor_gei->Diciembreelecactualyear($depe_eleanio_actual);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Electricidad';
		$data['subtitle'] = 'Comparativo de consumos x Dependencia ' .date('Y', strtotime('-1 year')).  ' -  ' .date('Y', strtotime('0 year')).  '';
		$data['body'] = 'consultaconcoselecxdepev3';
		//$mpdf = new \Mpdf\Mpdf(['debug' => true]);
		//$mpdf = new \Mpdf\Mpdf('utf-8', 'A4-L');
		//$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('main', $data,[],true);
		//$mpdf->WriteHTML($html);
		//$mpdf->Output(); // opens in browser
	 //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
}

}