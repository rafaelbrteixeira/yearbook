<?php
class Pessoa
{
    private $login;
    private $senha;
    private $foto;
    private $nome;
    private $cidade;
    private $estado;
    private $email;
    private $descricao;
    private $idCidade;
    private $idEstado;
    
    public function getIdCidade() {
        return $this->idCidade;
    }

    public function getIdEstado() {
        return $this->idEstado;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    public function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }
}
?>
