<?php 

class ProdutoController extends Controller{

	public function __construct(){
		header("Content-Type: application/json");
	}

	public function index(){

	}

	public function listar(){

		$resultados = array();

		$produto = new Produto();

		$resultados = $produto->select();

		if($resultados){
			echo json_encode($resultados);
		}else{
			RequestRest::response(500);
		}
		

	}

	public function add(){

		$dados = array();

		if(!empty(RequestRest::post())){

			$produto = new Produto();
			
			$dados = RequestRest::post();

			if($produto->insert($dados)){
				RequestRest::response(201, 'Criado');
			}else{
				RequestRest::response(500, 'Erro');
			}
		}

	}

	public function delete($id=NULL){

		$dados = array();
		$dados = RequestRest::delete();
		$id = !empty($id) ? $id : $dados['id'];

		if(!empty($id)){

			$produto = new Produto();
			
			if($produto->delete('where id = :id',"id={$id}")){
				RequestRest::response(204, 'Deletado');
			}else{
				RequestRest::response(500, 'Erro');
			}
		}

	}

	public function update(){

		$dados = array();

		if(!empty(RequestRest::put())){

			$produto = new Produto();
			
			$dados = RequestRest::put();

			if($produto->update($dados,'WHERE id = :id',"id={$dados['id']}")){
				RequestRest::response(201, 'Alterado');
			}else{
				RequestRest::response(500, 'Erro');
			}
		}

	}

}