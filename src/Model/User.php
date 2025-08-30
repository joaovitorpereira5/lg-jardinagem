<?php

Class User {
   
    private int $id;
    private string $email;
    private string $senha;

    public function __construct(string $email, string $senha)
    {$this->email = $email;$this->senha = $senha;}

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    private function getSenha(): string {
        return $this->senha;
    }
	

}