<?php

class FotosController extends Rest{


	private function post(){
		
		$dados = array();
		$dados = Rest::getData();

		$foto = new Foto();

		if($foto->insert($dados)){
			Rest::response(201);
		}else{
			Rest::response(500);
		}


	}

	private function put(){
		echo 'put';
	}

	private function delete($id = NULL){

		if(!empty($id)){

			$foto = new Foto();

			$resultados = $foto->select('SELECT * FROM galeria WHERE id = :id', "id={$id}");

			if($resultados){

				if($foto->delete('where id = :id',"id={$id}")){
					Rest::response(204);
				}else{
					Rest::response(500);
				}

			}else{

				Rest::response(500);
				
			}

			
		}
	}

	private function get($id=NULL){

		$resultados = array();
		$foto = new Foto();

		if(!$id){

			$resultados = $foto->select();

			if($resultados){
				echo json_encode($resultados);
			}else{
				Rest::response(500);
			}

		}else{

			$resultados = $foto->select('SELECT * FROM galeria WHERE id = :id', "id={$id}");

			if($resultados){
				echo json_encode($resultados);
			}else{
				Rest::response(500);
			}

		}
		
	}

	private function patch(){
		echo 'patch';
	}
	
}