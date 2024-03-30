<?php
	
	
	Class Fish
	{
		public function showAll(){
			
			$fish = file_get_contents('./assets/storage/fish.json');
			return $fish;
		}

		public function getAllPurchased(){
			
			$fish = file_get_contents('./assets/storage/purchased.json');
			return $fish;
		}

		public function findById($id){
			
			$jsonfish = Fish::showAll();
			$fish = json_decode($jsonfish);

			$fishPurchased = json_encode($fish[$id]);

			return $fishPurchased;
		}

		public function addToList($id){
			

			$fishPurchased = json_decode(Fish::findById($id));

			$list = json_decode(file_get_contents('./assets/storage/purchased.json'));

			$ok = true;
			foreach ($list as $fish) {
				if ($fishPurchased->id == $fish->id) {
						$ok = false;
				}
			}

			if($ok){
				array_push($list, $fishPurchased);

				$jsonList = json_encode($list);

				file_put_contents('./assets/storage/purchased.json', $jsonList);
			}
		}

		public function removeAllPurchased(){

			file_put_contents('./assets/storage/purchased.json', '[]');
		}

	}

?>