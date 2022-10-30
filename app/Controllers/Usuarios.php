<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Usuarios extends BaseController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    public function index()
    {
        $data = ['titulo' => 'Listando os usuários do sistema'];

        return view('Usuarios/index', $data);
    }

    public function recuperaUsuarios()
    {
        if (!$this->request->isAJAX())
        {
            return redirect()->back();
        }

        $atributos = [
            'id', 'nome', 'email', 'ativo', 'imagem'
        ];

        $usuarios = $this->usuarioModel->select($atributos)
            ->findAll();

        $data = [];

        foreach ($usuarios as $usuario)
        {
            $data[] = [
                'imagem' => $usuario->imagem,
                 'nome' => anchor("usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário '.esc($usuario->nome).' "'),
                 'email' => esc($usuario->email),
                 'ativo' => $usuario->ativo == true ? '<i class="fa fa-unlock-alt text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-warning"></i>&nbsp;Inativo',
            ];
        }

        $retorno = [
            'data' => $data
        ];

        return $this->response->setJSON($retorno);
    }

    public function exibir(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);
        $data = [ 'titulo' => "Detalhando o usuário " .  esc($usuario->nome), 'usuario' => $usuario];
        
        return view('Usuarios/exibir', $data);
    }

    public function editar(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);
        $data = [ 'titulo' => "Editando o usuário " .  esc($usuario->nome), 'usuario' => $usuario];
        
        return view('Usuarios/editar', $data);
    }

    public function atualizar()
    {
        if (!$this->request->isAJAX())
        {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        // Validamos a existência do usuário
        $usuario = $this->buscaUsuarioOu404($post['id']);

        // Se não foi informado a senha removemos do $post
        // Se não fizermos dessa forma o hash_password fará o hash de uma string vazia
        if (empty($post['password']))
        {
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // Preenchemos os atributos do usuário com os valores do POST
        $usuario->fill($post);

        if ($usuario->hasChanged() == false)
        {
            $retorno['info'] = 'Não há dados para serem atualizados';
            return $this->response->setJSON($retorno);
        }

        if ($this->usuarioModel->protect(false)->save($usuario))
        {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor, verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->usuarioModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    /**
     * Método que recupera o usuário
     * 
     * @param integer $id
     * @return Exception|object
     */
    private function buscaUsuarioOu404(int $id = null)
    {
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
        }

        return $usuario;
    }
}
