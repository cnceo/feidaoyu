<?php
	class Buys
	{
		public $mDb;
		public $mProd;
		private $mCart;
	
		public function __construct()
		{
			//$this->mDb->debug = true;
			$this->mCart = $_SESSION["cart"];
		}
	
		public function myCart($uid)
		{
			
		}
		/*添加到购物车*/
		public function addCart($pid,$num,$buytype="default")
		{
			if($buytype == "package")  ///打包销售
			{
				$rs = $this->mProd->getPackagesSaleList($pid);
				foreach ($rs as $val)
				{
					$this->addCart($val["pid"],$val["quantity"]);
				}
			}
			else if($this->mCart["plist"][$buytype.$pid])
			{
				$this->mCart["plist"][$buytype.$pid]["buys"] = $this->mCart["plist"][$buytype.$pid]["buys"] + $num;
				if($this->mCart["plist"][$buytype.$pid]["give_integral"] ="-1")
				{
					$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["price"];
				}
				else
				{
					$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["give_integral"];
				}
				$this->mCart["plist"][$buytype.$pid]["subtotal_point"] = $this->mCart["plist"][$buytype.$pid]["point"] * $this->mCart["plist"][$buytype.$pid]["buys"];
				$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["price"] * $this->mCart["plist"][$buytype.$pid]["buys"];
				$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["weight"] * $this->mCart["plist"][$buytype.$pid]["buys"];
				if($this->mCart["plist"][$buytype.$pid]["weight_unit"]=="2")
				{
					$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["subtotal_weight"] / 1000;
				}
				
			}
			else
			{
				$this->mCart["plist"][$buytype.$pid] = $this->mProd->getRow($pid);
				if(!$this->mCart["plist"][$buytype.$pid])return false;
				//print_r($this->mCart["plist"][$buytype.$pid]);
				$this->mCart["plist"][$buytype.$pid]["buytype"] = $buytype;
				if($this->mCart["plist"][$buytype.$pid])
				{
					$this->mCart["plist"][$buytype.$pid]["priceold"] = $this->mCart["plist"][$buytype.$pid]["price"];
		 			
		 			if($buytype=="freetrial")///免费试用
		 			{
		 				$freetrial = $this->mProd->getProductSalePriceInfo(6,$pid,"point");
		 				if($freetrial)
		 				{
			 				$this->mCart["plist"][$buytype.$pid]["usepoint"] =  $freetrial["point"];
			 				$this->mCart["plist"][$buytype.$pid]["buys"] = $num;
			 				$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["subtotal_point"] =  $this->mCart["plist"][$buytype.$pid]["point"] = 0;
							$this->mCart["plist"][$buytype.$pid]["subtotal_use_point"] = $this->mCart["plist"][$buytype.$pid]["usepoint"] * $this->mCart["plist"][$buytype.$pid]["buys"];
		 				}
		 				else
		 				{
		 					$this->addCart($pid,$num);
		 				}
		 			}
		 			else if($buytype=="tgou") ///团购
		 			{
		 				$tgou = $this->mProd->getProductSalePriceInfo(4,$pid,"price");
		 				
		 				if($tgou)
		 				{
		 					$this->mCart["plist"][$buytype.$pid]["price"] = $tgou["price"];
							$this->mCart["plist"][$buytype.$pid]["buys"] = $num;
							if($this->mCart["plist"][$buytype.$pid]["give_integral"] ="-1")
							{
								$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["price"];
							}
							else
							{
								$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["give_integral"];
							}
							$this->mCart["plist"][$buytype.$pid]["subtotal_point"] = $this->mCart["plist"][$buytype.$pid]["point"] * $this->mCart["plist"][$buytype.$pid]["buys"];
							$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["price"] * $this->mCart["plist"][$buytype.$pid]["buys"];
		 				}
		 				else
		 				{
		 					$this->addCart($pid,$num);
		 				}
		 			}
		 			else if($buytype=="point")   //积分换购
		 			{
		 				$point = $this->mProd->getProductSalePriceInfo(5,$pid,"price");
		 				
		 				if($point)
		 				{
		 					$this->mCart["plist"][$buytype.$pid]["usepoint"] =  $point["point"];
		 					$this->mCart["plist"][$buytype.$pid]["price"] = $point["price"];
							$this->mCart["plist"][$buytype.$pid]["buys"] = $num;
							$this->mCart["plist"][$buytype.$pid]["subtotal_use_point"] = $this->mCart["plist"][$buytype.$pid]["usepoint"] * $this->mCart["plist"][$buytype.$pid]["buys"];
							$this->mCart["plist"][$buytype.$pid]["subtotal_point"] = 0;
							$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["price"] * $this->mCart["plist"][$buytype.$pid]["buys"];
							
		 				}
		 				else
		 				{
		 					$this->addCart($pid,$num);
		 				}
		 			}
		 			else
		 			{
		 				$this->mCart["plist"][$buytype.$pid]["priceold"] = $price["def"] = $this->mCart["plist"][$buytype.$pid]["price"];
						$discount = $this->mProd->getProductSalePrice(1,$pid,"price");
						//echo $discount."<br>";
			 			$discount = $this->mCart["plist"][$buytype.$pid]["price"]*$discount/100;
			 			//echo $discount;      
						//$discount = $this->result["log"]["price"]*$discount/100;
						if($discount) $price["dis"]= $discount;
						$special = $this->mProd->getProductSalePrice(2,$pid,"price");
						if($special) $price["spe"]= $special;
						$countdown = $this->mProd->getProductSalePrice(3,$pid,"price");
						if($countdown) $price["ct"]= $countdown;
						sort($price);
						//print_r($price);
						$this->mCart["plist"][$buytype.$pid]["price"] = $price[0];
						$this->mCart["plist"][$buytype.$pid]["buys"] = $num;
						if($this->mCart["plist"][$buytype.$pid]["give_integral"] ="-1")
						{
							$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["price"];
						}
						else
						{
							$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["give_integral"];
						}
						$this->mCart["plist"][$buytype.$pid]["subtotal_point"] = $this->mCart["plist"][$buytype.$pid]["point"] * $this->mCart["plist"][$buytype.$pid]["buys"];
						$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["price"] * $this->mCart["plist"][$buytype.$pid]["buys"];
					
		 			}
		 			//计算重量
		 			$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["weight"] * $this->mCart["plist"][$buytype.$pid]["buys"];
					if($this->mCart["plist"][$buytype.$pid]["weight_unit"]=="2")
					{
						$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["subtotal_weight"] / 1000;
					}
		 			
					
					/*$price["def"] = $this->mCart["plist"][$buytype.$pid]["price"];
					$this->mCart["plist"][$buytype.$pid]["priceold"] = $price["def"];
					$discount = $this->mProd->getProductSalePrice(1,$pid,"price");
					$discount = $this->result["log"]["price"]*$discount/100;
					if($discount) $price["dis"]= $discount;
					$special = $this->mProd->getProductSalePrice(2,$pid,"price");
					if($special) $price["spe"]= $special;
					$countdown = $this->mProd->getProductSalePrice(3,$pid,"price");
					if($countdown) $price["ct"]= $countdown;
					sort($price);
					$this->mCart["plist"][$buytype.$pid]["price"] = $price[0];
					$this->mCart["plist"][$buytype.$pid]["buys"] = $num;
					if($this->mCart["plist"][$buytype.$pid]["give_integral"] ="-1")
					{
						$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["price"];
					}
					else
					{
						$this->mCart["plist"][$buytype.$pid]["point"] = 	$this->mCart["plist"][$buytype.$pid]["give_integral"];
					}
					$this->mCart["plist"][$buytype.$pid]["subtotal_point"] = $this->mCart["plist"][$buytype.$pid]["point"] * $this->mCart["plist"][$buytype.$pid]["buys"];
					$this->mCart["plist"][$buytype.$pid]["subtotal_amount"] = $this->mCart["plist"][$buytype.$pid]["price"] * $this->mCart["plist"][$buytype.$pid]["buys"];
					$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["weight"] * $this->mCart["plist"][$buytype.$pid]["buys"];
					if($this->mCart["plist"][$buytype.$pid]["weight_unit"]=="2")
					{
						$this->mCart["plist"][$buytype.$pid]["subtotal_weight"] = $this->mCart["plist"][$buytype.$pid]["subtotal_weight"] / 1000;
					}*/
				}
			}
			$this->getCartTotal();
			//print_r($this->mCart);
			$_SESSION["cart"] = $this->mCart;
		}
		
		public function modifyCart($pid,$num)
		{
			$this->mCart["plist"][$pid]["buys"] = $num;
			$this->mCart["plist"][$pid]["subtotal_point"] = $this->mCart["plist"][$pid]["point"] * $this->mCart["plist"][$pid]["buys"];
			$this->mCart["plist"][$pid]["subtotal_amount"] = $this->mCart["plist"][$pid]["price"] * $this->mCart["plist"][$pid]["buys"];
			$this->mCart["plist"][$pid]["subtotal_weight"] = $this->mCart["plist"][$pid]["weight"] * $this->mCart["plist"][$pid]["buys"];
			if($this->mCart["plist"][$pid]["weight_unit"]=="2")
			{
				$this->mCart["plist"][$pid]["subtotal_weight"] = $this->mCart["plist"][$pid]["subtotal_weight"] / 1000;
			}
			$this->getCartTotal();
			$_SESSION["cart"] = $this->mCart;
		}
		
		public function delCart($pid)
		{
			if($pid=="all")
			{
				unset($_SESSION["cart"]);
			}
			else
			{
	
				unset($this->mCart["plist"][$pid]);
				$this->getCartTotal();
				$_SESSION["cart"] = $this->mCart;
			}
		}
		
		private function getCartTotal()
		{
			unset($this->mCart["plist"][0]);
			$this->mCart["prod_total"] = count($this->mCart["plist"]);
			$total_price = $total_point = $total_weight = $total_use_point = 0;
 			foreach ($this->mCart["plist"] as $val)
 			{
 				$total_price = $total_price+$val["subtotal_amount"];
 				$total_point = $total_point+$val["subtotal_point"];
 				$total_use_point = $total_use_point+$val["subtotal_use_point"];
 				$total_weight = $total_weight+$val["subtotal_weight"];
 			}
 			$this->mCart["total_package"] = $this->getPackageTotal();
 			$this->mCart["total_price"] = $total_price;
 			$this->mCart["total_point"] = $total_point;
 			$this->mCart["total_use_point"] = $total_use_point;
 			$this->mCart["total_weight"] = $total_weight;
		}
		
		public function getPackageTotal()
		{
 			$package = 0;
			$tmplist = $this->mCart["plist"];
			foreach ($this->mCart["plist"] as $val)
 			{
 				if($val["buytype"]=="default")
 				{
 					$ids[] = $val["id"];
 				}
 			}
 			
 			$ruleinfo = $this->mProd->getPackagesSaleListByPID($ids,"no");
 			foreach ($ruleinfo as $val)
 			{
 				$rules[$val["id"]][] = $val;
 			}
 			
 			foreach ($rules as $key => $rule)
 			{
 				$mapping[$key] = array();
 				foreach ($rule as $r)
 				{
 					if($tmplist["default".$r["pid"]]["buys"]>=$r["quantity"])
 					{
 						$mapping[$key] = true;
 					}
 					else
 					{
 						$mapping[$key] = false;
 						break;
 					}
 				}
 				if($mapping[$key] == true)
 				{
 					$price = 0;
 					foreach ($rule as $r)
	 				{
	 					$tmplist["default".$r["pid"]]["buys"] = $tmplist["default".$r["pid"]]["buys"]-$r["quantity"];
	 					$price = $price + $tmplist["default".$r["pid"]]["price"]*$r["quantity"];
	 					$discount = $r["discount"];
	 				}
	 				echo $price;
	 				$package = $package + $price*(100-$discount)/100;
 				}
 			}
 			return $package;
		}
		
		public function checkCart()
		{
			foreach ($this->mCart["plist"]as $val)
			{
				$tpinfo = $this->mProd->getRow($val["id"]);
				if($val["buys"]>$tpinfo["quantity"])return false;
			}
			return true;
		}
	
	}

?>