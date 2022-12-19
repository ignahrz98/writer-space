<?php
	/**
	*	@titulo 		Controlador para la session.
	*	@descripcion	Evitar mostrar partes del sistema según exista o no la session
	**/

	class Session
	{
		var $status = false;

		var $no_session_allow = array(	'leer',
										'acceder',
										'registro',
										'buscador');

		var $session_forbidden = array(	'acceder',
										'registro');

		public function session_allow($vista)
		{
			return $this->status;
		}

		public function session_forbidden($vista)
		{
			foreach ($this->session_forbidden as $key => $value) 
			{
				if ($value == $vista) 
				{
					$this->status = true;
				}
			}

			return $this->status;
		}

		public function no_session_allow($vista)
		{
			foreach ($this->no_session_allow as $key => $value) 
			{
				if ($value == $vista) 
				{
					$this->status = true;
				}
			}

			return $this->status;
		}

		public function no_session_forbidden($vista)
		{
			return $this->status;
		}
	}
?>