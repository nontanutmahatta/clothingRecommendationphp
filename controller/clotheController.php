<?php
	
	require_once('./model/clothe.php');

	Class fishController
	{
		public function getAll(){
			$fish = new fish();

			$resp = $fish->showAll();
			return $resp;
		}

		public function showAllPurchased(){
			$fish = new fish();

			$resp = $fish->getAllPurchased();
			return $resp;
		}		

		public function getfish($id){
			$fish = new fish();

			$resp = $fish->findById($id);
			return $resp;
		}

		public function buy($id){
			$fish = new fish();

			$fish->addToList($id);
		}

		public function destroy(){
			$fish = new fish();

			$fish->removeAllPurchased();
		}
	}

?>