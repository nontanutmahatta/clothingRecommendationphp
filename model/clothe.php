<?php
	
	
	Class Fish
	{
		public function showAll(){
			
			$clothes = file_get_contents('./assets/storage/fish.json');
			return $clothes;
		}

		public function getAllPurchased(){
			
			$clothes = file_get_contents('./assets/storage/purchased.json');
			return $clothes;
		}

		public function findById($id){
			
			$jsonClothes = Fish::showAll();
			$clothes = json_decode($jsonClothes);

			$clothePurchased = json_encode($clothes[$id]);

			return $clothePurchased;
		}

		public function addToList($id){
			

			$clothePurchased = json_decode(Fish::findById($id));

			$list = json_decode(file_get_contents('./assets/storage/purchased.json'));

			$ok = true;
			foreach ($list as $clothe) {
				if ($clothePurchased->id == $clothe->id) {
						$ok = false;
				}
			}

			if($ok){
				array_push($list, $clothePurchased);

				$jsonList = json_encode($list);

				file_put_contents('./assets/storage/purchased.json', $jsonList);
			}
		}

		public function removeAllPurchased(){

			file_put_contents('./assets/storage/purchased.json', '[]');
		}

	}

?>