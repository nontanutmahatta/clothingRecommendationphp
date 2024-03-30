<?php
	require_once('./controller/clotheController.php');
	
	Class Functions
	{

		public function alreadyPurchased($id)
		{

			$fishController = new fishController();

			$list = json_decode($fishController->showAllPurchased());

			foreach ($list as $fish) {
				if($fish->id == $id){
					return  true;
				}
			}
		}

		public function getRecommendation($fishPurchased)
		{
			$fishController = new fishController();
			
			$available = json_decode($fishController->getAll());
			
			
			$purchasedCount = 0;
			foreach ($available as $fish) {
				if ($this->alreadyPurchased($fish->id)) {
					$purchasedCount++;
				}
			}
			$availableToRecommend = count($available) - $purchasedCount;
			if ($availableToRecommend < 3) {
				return false;
			}
			

			$points = [];
			$y = 0;
			
			do{
				$tempPts = 0;
				$tempId = 999;
				$tempIndex = 999;
				$i = 0;

				foreach ($available as $fish) {
					if($fishPurchased->id != $fish->id && !$this->alreadyPurchased($fish->id)){
						$pts = 0;
						$pts += ($fishPurchased->price == $fish->price)? 2 : 0;
						$pts += ($fishPurchased->origin == $fish->origin)? 1 : 0;
						$pts += ($fishPurchased->type != $fish->type)? 3 : 0;

						if($pts > $tempPts){
							$tempPts = $pts;
							$tempId = $fish->id;
							$tempIndex = $i;
						}
					}
					$i++;
				}
				array_push($points, $tempId);
				
				unset($available[$tempIndex]);

				$available = array_values($available);
			
				$y++;
				
			}while($y < 3);

			$top3 = [];

			$fish1 = json_decode($fishController->getfish($points[0]));
			$fish2 = json_decode($fishController->getfish($points[1]));
			$fish3 = json_decode($fishController->getfish($points[2]));

			array_push($top3, $fish1, $fish2, $fish3);

			return $top3;
		}
	}

?>