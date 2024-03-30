<?php
	
	require_once('./model/clothe.php');

	Class fishController
	{
		public function getAll(){
			$clothe = new fish();

			$resp = $clothe->showAll();
			return $resp;
		}

		public function showAllPurchased(){
			$clothe = new fish();

			$resp = $clothe->getAllPurchased();
			return $resp;
		}		

		public function getclothe($id){
			$clothe = new fish();

			$resp = $clothe->findById($id);
			return $resp;
		}

		public function buy($id){
			$clothe = new fish();

			$clothe->addToList($id);
		}

		public function destroy(){
			$clothe = new fish();

			$clothe->removeAllPurchased();
		}
	}

?>