<?php namespace App\Http\Controllers\PontoEletronico;


use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Session;
use App\Usuario;
use App\Ponto;

class DashboardController extends PontoEletronicoController {
    
    public function __construct()
    {
        $this->middleware('authPainelMiddleware');
        
    }
    
    public function index(){
        
        // dd(Date('Y-m-d'));

        $hoje = Date('Y-m-d');


        // dd($hoje);
        // dd(Session::get('login.ponto.painel.usuario_id'));
        
        // $usuario_id = Session::get('login.ponto.usuario_id');
        $usuario_id = Session::get('login.ponto.painel.usuario_id');

        $admin = Session::get('login.ponto.painel.admin');
        
         

        // dd($admin);

        $usuario = Usuario::find($usuario_id);
        
        $registros = Ponto::where(['usuario_id' => $usuario_id, 'data' => $hoje])->orderBy('id', 'ASC')->get();

        // $total = $registros->entrada->count();

        $total = 0;
        
        foreach($registros as $registro){
             if(!empty($registro->entrada) AND !empty($registro->saida)){
                $total++; 
             }
        }

        // dd($total);

        return view('pontoeletronico/registro/index')
        ->with('usuario', $usuario)
        ->with('registros', $registros)
        ->with('admin', $admin)
        ->with('total', $total);
        
            
    }
    
}