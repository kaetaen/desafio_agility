<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Config;

class AgilityDataController extends Controller
{
    public function agilityTables (Request $request)
    {
        $agility_api_key = config('agility_api_key.value');
        if (!$agility_api_key) {
            return "Defina um valor válido para a váriavel de ambient AGILITY_API_KEY no arquivo .env";
        }
        // Faz a busca na API, com métodos GET e POST
        $get_test = Http::get('http://eagle-backend-dev.somosagility.com.br/getTeste');
        $post_test = Http::post('http://eagle-backend-dev.somosagility.com.br/postTeste', [
            'key' => $agility_api_key
        ])->json();

        // Mescla o conteúdo do retorno dos dois endpoints: get e post, num só array
        $all_content = array_merge($get_test['user'], $post_test['user']['entries']);
        // Valida se o array possui um 'customer' Agility para exibir um estilo diferenciado
        $has_agility_customer = false;

        // Regra de negócio para requisição do tipo Post
        if ($request->isMethod('post'))
        {
            $input = $request->only(['nome', 'email', 'empresa']);
            $has_agility_customer = false;
            $filtered_content = [];
            
            foreach ($all_content as $content) {
                if (
                    $content['name'] == $input['nome'] &&
                    $content['email'] == $input['email'] &&
                    $content['customer'] == $input['empresa']
                )
                {
                    if ($content['customer'] == 'Agility') {
                        $has_agility_customer = true;
                    } 
                    
                    $filtered_content = collect($all_content)->where('name', $input['nome']);
                }
            }
            
            return view('agility_tables', ['content' => $filtered_content, 'has_agility_customer' => $has_agility_customer]);
        }

        // Regra de negócio para requisição do tipo Get
        elseif ($request->isMethod('get'))
        {
            return view('agility_tables', ['content' => $all_content, 'has_agility_customer' => $has_agility_customer]);  
        }
    }
}
