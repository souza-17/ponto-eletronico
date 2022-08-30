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
        
        $hoje = Date('Y-m-d');

        // dd(Session::get('login.ponto.painel.usuario_id'));
        
        // $usuario_id = Session::get('login.ponto.usuario_id');
        $usuario_id = Session::get('login.ponto.painel.usuario_id');

        $admin = Session::get('login.ponto.painel.admin');
        
        // dd($admin);

        $usuario = Usuario::find($usuario_id);
        
        $registros = Ponto::where(['usuario_id' => $usuario_id, 'data' => $hoje])->orderBy('id', 'ASC')->get();
        
        return view('pontoeletronico/registro/index')->with('usuario', $usuario)->with('registros', $registros)->with('admin', $admin);
        
            
    }
    
}