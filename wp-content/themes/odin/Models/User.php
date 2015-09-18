<?php 
	class User{

		private $user_id;
		private $apelido;
		private $nome;
		private $sobrenome;
		private $email;
		private $senha;

		public function __construct($user_id, $apelido, $nome, $sobrenome, $email, $senha){
			
			$this->user_id = $user_id;
			$this->apelido = $apelido;
			$this->nome = $nome;
			$this->sobrenome = $sobrenome;
			$this->email = $email;
			$this->senha = $senha;

		}

		public function getUserId(){
			return $this->user_id;
		}

		public function getApelido(){
			return $this->apelido;
		}

		public function getNome(){
			return $this->nome;
		}
		
		public function getSobrenome(){
			return $this->sobrenome;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getSenha(){
			return $this->senha;
		}
	}
?>