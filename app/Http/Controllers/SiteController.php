<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function get_index()
    {
        return view('site.index');
    }

    public function get_projetos()
    {
        $projetos = [
            [
                'titulo' => 'Sistema de Gestão Escolar',
                'descricao' => 'Plataforma completa para controle acadêmico.',
                'imagem' => '/images/projetos/escola.png',
                'link' => '#'
            ],
            [
                'titulo' => 'E-commerce de Roupas',
                'descricao' => 'Loja online com pagamento integrado.',
                'imagem' => '/images/projetos/ecommerce.png',
                'link' => '#'
            ],
            [
                'titulo' => 'Dashboard Financeiro',
                'descricao' => 'Painel para análise de dados financeiros.',
                'imagem' => '/images/projetos/dashboard.png',
                'link' => '#'
            ],
        ];

        return view('site.projetos', compact('projetos'));
    }

    public function get_contato()
    {
        return view('site.contato');
    }


    public function get_sobre()
    {
        return view('site.sobre');
    }

     public function post_enviar(Request $request)
    {
        // Validação
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:5',
        ]);

        // Salva no banco
        Contato::create([
            'nome' => $request->name,
            'email' => $request->email,
            'assunto' => $request->subject,
            'mensagem' => $request->message,
        ]);

        // Retorno de sucesso
        return response()->json(['success' => true, 'message' => 'Mensagem enviada com sucesso!']);
    }

}
