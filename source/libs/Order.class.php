<?php
class Orders
{
	public $mDb;

	public function __construct()
	{
		//$this->mDb->debug = true;
	}
	public function getList($cateid,$size=_PAGES)
	{
		$sql = "SELECT * FROM ".get_table("orders");
		if($_GET["orderno"]) $sqlv[] = " orderno LIKE '%".$_GET["orderno"]."%'";
		if($_GET["contact"]) $sqlv[] = " (contact LIKE '%".$_GET["contact"]."%' OR mobile LIKE '%".$_GET["contact"]."%' ) ";
		if($_GET["quantity"]) $sqlv[] = " (quantity LIKE '%".$_GET["quantity"]."%' OR price_total LIKE '%".$_GET["quantity"]."%' ) ";
		if($_GET["telphone"]) $sqlv[] = " (quantity LIKE '%".$_GET["address"]."%' OR address LIKE '%".$_GET["address"]."%' ) ";
		if($_GET["status"] || $_GET["status"]=='0') $sqlv[] = " status = '".$_GET["status"]."' ";
		if($_GET["uid"]) $sqlv[] = " uid = '".$_GET["uid"]."' ";
		if($cateid)
		{
			if(is_array($cateid))
		    {
		    	$cateid =  implode(",",$cateid);
		    }
		    $sqlv[] = " class_id IN ($cateid)";
		}
		if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);

		$sql .="  ORDER BY id DESC";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
	}

	public function getSalesList($size=_PAGES)
	{
		$group_format = "%W";
		if($_GET["group"]) $group_format = $_GET["group"];
		$sql = "SELECT count(id) AS num, SUM(order_total) AS total,MIN(createtime) AS date_start , MAX(createtime) AS date_end  FROM ".get_table("orders");
		if($_GET["date_start"]) $sqlv[] = " createtime >= '".$_GET["date_start"]." 00:00:00'";
		if($_GET["date_end"]) $sqlv[] = " createtime <= '".$_GET["date_end"]." 12:59:59'";
		if($_GET["status"]) $sqlv[] = " status = '".$_GET["status"]."' ";
		if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);

		$sql .="  GROUP by DATE_FORMAT(createtime,'$group_format')";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
	}

	public function getNewList($limit=20)
	{
		$sql = "SELECT * FROM ".get_table("orders")." ORDER BY id DESC LIMIT $limit";
		$rs = $this->mDb->getall($sql);
		return $rs;
	}

	public function getCityDorpList($pid=0,$type=null)
	{
		$sql = "SELECT * FROM ".get_table("citys")." WHERE pid=$pid";
		$rs = $this->mDb->getall($sql);
		if(!empty($type))
		{
			$cate = array();
			foreach ($rs as $val)
				{
					$cate[$val["id"]] = $val["name"];
				}
			$rs = $cate;
		}
		return $rs;
	}

	public function getCitybyId($id)
	{
		$sql = "SELECT name FROM ".get_table("citys")." WHERE id=$id";
		$name = $this->mDb->getone($sql);
		return $name;
	}

   public function createOrder()
   {
   		$orderno = strtoupper("b".date("Ymd").random(4));
   		$msg["status"] = false;
 		$msg["orderno"] = $orderno;
   		//使用优惠券
   		if($_POST["voucher"])
   		{
   			$useflag = $this->useVoucher($_SESSION["login_user"]["id"],$_POST["voucher"]);
   			$msg["message"] = "无效优惠券";
   			if(!$useflag)return $msg;
   		}

   		//使用积分
   		if($_SESSION["cart"]["total_use_point"])
   		{
	   		if($_SESSION["cart"]["total_use_point"] <= $_SESSION["login_user"]["points"])
	   		{
	   			$this->mDb->execute("UPDATE ".get_table("customers")." SET points=points-".$_SESSION["cart"]["total_use_point"]." WHERE id=".$_SESSION["login_user"]["id"]);
	   		}
	   		else
	   		{
	   			$msg["message"] = "您的积分余额不足完成本次订单";
	   			return $msg;
	   		}
   		}
   		$sql = "INSERT INTO ".get_table("orders")."(orderno,uid,province,city,county,address,postcode,contact,mobile,telphone,price_total,shiptype,paytype,shipcost,
   		content,order_package,order_point,order_use_point,order_weight,voucher,voucher_value,order_total)VALUES
   		('$orderno','".$_SESSION["login_user"]["id"]."','".$_POST["province"]."','".$_POST["city"]."','".$_POST["county"]."','".$_POST["address"]."','".$_POST["postcode"]."','".$_POST["contact"]."','".$_POST["mobile"]."','".$_POST["telphone"]."','".$_SESSION["cart"]["total_price"]."','".$_POST["shiptype"]."','".$_POST["paytype"]."','".$_POST["shipcost"]."','".$_POST["content"]."',
   		'".$_SESSION["cart"]["total_package"]."','".$_SESSION["cart"]["total_point"]."','".$_SESSION["cart"]["total_use_point"]."','".$_SESSION["cart"]["total_weight"]."','".$_POST["voucher"]."','".$_POST["voucher_value"]."','".($_SESSION["cart"]["total_price"]+$_POST["shipcost"]-$_POST["voucher_value"])."')";

   		$this->mDb->execute($sql);
   		$order_id = $this->mDb->Insert_ID();
   		$buys = 0;
   		foreach ($_SESSION["cart"]["plist"] as $val)
   		{
   			$buys = $buys + $val["buys"];
   			$sql = "INSERT INTO  ".get_table("orderprodlist")."(order_id,pid,cprodname,price,buys,subtotal_amount,buytype)VALUES('$order_id','".$val["id"]."','".$val["cprodname"]."','".$val["price"]."','".$val["buys"]."','".$val["subtotal_amount"]."','".$val["buytype"]."')";
   			$this->mDb->execute($sql);
   			$this->updateProdut($val["id"],$val["buys"],$val["buytype"]);
   		}
   		$sql = "UPDATE  ".get_table("orders")." SET quantity='$buys' WHERE id=".$order_id;
   		$this->mDb->execute($sql);
   		$msg["status"] = true;
   		unset($_SESSION["cart"]);
   		return $msg;
   }

   public function updateProdut($id,$quantity,$buytype)
   {
   		$sql = "UPDATE ".get_table("products")." SET sold_quantity=sold_quantity+$quantity WHERE id=".$id;
   		$this->mDb->execute($sql);
   }

   public function getNewListByUid($uid)
   {
   		$sql ="SELECT * FROM ".get_table("orders")." WHERE uid=".$uid." ORDER BY createtime DESC";
   		$rs = $this->mDb->getAll($sql);
   		return $rs;
   }


	public function getListByUid($uid,$size=_PAGES)
	{
		$sql = "SELECT * FROM ".get_table("orders");
		if($_GET["status"]=="close") $sqlv[] = " status >= 10 ";
		if($_GET["orderno"]) $sqlv[] = " orderno like '%".$_GET["orderno"]."%' ";
		if($_GET["createtime"]) $sqlv[] = " createtime '".$_GET["createtime"]."' ";
		$sqlv[] = " uid=$uid";
		if(is_array($sqlv))
		{
			$sql .=" WHERE ".implode("AND",$sqlv);
		}
		$sql .=" ORDER BY createtime DESC";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
	}

	public function getListInfoByUid($uid)
   {
   		$sql ="SELECT COUNT(*) AS num,status FROM ".get_table("orders")." WHERE uid=".$uid." GROUP BY status";
   		$rs = $this->mDb->getAll($sql);
   		/*foreach ($rs as $val)
   		{
   			$arr[$val["status"]] = $val["num"];
   		}
   		return $arr;*/
   		return $rs;
   }

   public function getOrderinfo($orderno)
   {
   		$sql ="SELECT * FROM ".get_table("orderprodlist")." WHERE order_id='$orderno'";
   		$rs = $this->mDb->getrow($sql);
   		return $rs;
   }

   public function getOrderlistinfo($order_id)
   {
   		$sql ="SELECT *,t2.sku FROM ".get_table("orderprodlist")." t1,".get_table("products")." t2  WHERE t1.pid=t2.id AND t1.order_id='$order_id'";
   		$rs = $this->mDb->getall($sql);
   		return $rs;
   }

   public function getStatusList()
   {
   	return array("0"=>"订单审核中",
   				 "1"=>"审核通过",
   				 "2"=>"仓库备货打包中",
   				 "3"=>"已出库，请注意查收",
   				 "4"=>"客户已签收",
   				 "5"=>"客户拒收",
   				 "6"=>"订单成功",
   				 "10"=>"客户作废",
   				 "11"=>"百万宝贝作废");
   }

   public function getTimeList()
   {
   	return array("%Y"=>"年",
   				 "%m"=>"月",
   				 "%W"=>"周",
   				 "%d"=>"日");
   }

   public function getPayflagList()
   {
   	return array( "1"=>"未付款",
   				 "2"=>"已付款");
   }

   public function saveAddressPost($uid)
   {
   		$sqlv[] = " uid = '$uid'";
   		foreach ($_POST as $key =>$val)
		{
			if(!in_array($key,array("id","address_id")))
			{
				$sqlv[] = " $key = '".sb_addslashes($val)."'";
			}
		}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("address")." SET ".implode(",",$sqlv);

		}
		else
		{
			$sql = "UPDATE ".get_table("address")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
		}

		$rs = $this->mDb->execute($sql);
		return $rs;
   }

   public function saveProcessPost()
   {
   		$sql = "UPDATE ".get_table("orders")." SET status='".$_POST["status"]."' WHERE id=".$_POST["id"];
   		$rs = $this->mDb->execute($sql);
   		$status = $this->getStatusList();
   		$_POST["content"] = "更改状态为〖".$status[$_POST["status"]]."〗<br>".$_POST["content"];
   		$sql ="INSERT INTO ".get_table("order_logs")."(order_id,uid,truename,content)VALUES('".$_POST["id"]."','".$_SESSION["login_admin"]["id"]."','".$_SESSION["login_admin"]["truename"]."','".$_POST["content"]."')";
   		$rs = $this->mDb->execute($sql);
   		return $rs;
   }

    public function savenvaliidPost()
   {
   		$sql = "UPDATE ".get_table("orders")." SET status='10' WHERE uid='".$_SESSION["login_user"]["id"]."' AND orderno='".$_POST["orderno"]."'";
   		$rs = $this->mDb->execute($sql);
   		if($rs)
   		{
	   		$_POST["content"] = "用户作废订单";
	   		$sql ="INSERT INTO ".get_table("order_logs")."(order_id,uid,truename,content)VALUES('".$_POST["id"]."','".$_SESSION["login_user"]["id"]."','".$_SESSION["login_user"]["username"]."','".$_POST["content"]."')";
	   		$rs = $this->mDb->execute($sql);
   		}
   		return $rs;
   }

    public function getProcesslog($order_id)
   {
   		$sql = "SELECT * FROM ".get_table("order_logs")."  WHERE order_id=".$order_id;
   		$rs = $this->mDb->getall($sql);
   		return $rs;
   }


   public function getAddress($id)
   {
   		$sql = "SELECT * FROM ".get_table("address")." WHERE id=$id";
   		$rs = $this->mDb->getrow($sql);
   		return $rs;
   }

    public function getAddressByUid($uid)
   {
   		$sql = "SELECT * FROM ".get_table("address")." WHERE uid=$uid ORDER BY def DESC";
   		$rs = $this->mDb->getrow($sql);
   		return $rs;
   }

   public function getCountAddressByUid($uid)
   {
   		$sql = "SELECT COUNT(*) FROM ".get_table("address")." WHERE uid=$uid";
   		$rs = $this->mDb->getone($sql);
   		return $rs;
   }

   public function DelAddress($uid,$id)
   {
   		$sql = "DELETE FROM ".get_table("address")." WHERE uid=$uid AND id=$id";
   		$rs = $this->mDb->execute($sql);
   		return $rs;
   }

   public function cateAddressList($uid,$type=null)
	{
		$sql = "SELECT * FROM ".get_table("address")." WHERE uid=$uid LIMIT 10";
		$rs = $this->mDb->getall($sql);
		if(!empty($type))
		{
			$cate = array();
			$i=1;
			foreach ($rs as $val)
				{
					if(!$val["title"])$val["title"]= "我的地址".$i;
					$cate[$val["id"]] = $val["title"];
					$i++;
				}
			$rs = $cate;
		}
		return $rs;
	}

	public function checkBuy($uid,$pid)
	{
		$sql = "SELECT t1.id FROM ".get_table("orders")." t1, ".get_table("orderprodlist")." t2 WHERE t1.id=t2.order_id AND t2.pid='$pid' AND t1.uid='$uid'";
		return $this->mDb->getOne($sql);
	}

	public function getExpressList()
	{
		$sql = "SELECT * FROM ".get_table("express");
		return  $this->mDb->getAll($sql);
	}

	public function getExpressRow($id)
	{
		$sql = "SELECT * FROM ".get_table("express")." WHERE id=".$id;
		$rs = $this->mDb->getrow($sql);
		$sql = "SELECT * FROM ".get_table("express_rules")." WHERE eid=".$id;
		$rs["rules"] = $this->mDb->getall($sql);
		return $rs;
	}

	public function getExpressRule($id,$total,$weight,$area)
	{
		$sql = "SELECT * FROM ".get_table("express_rules")." WHERE eid=$id";
		$rs = $this->mDb->getall($sql);
		$price = 0;
		foreach ($rs as $vals)
		{
			if ($vals["type"] == "total")
			{
				$val = $total;
			}
			else if ($vals["type"] == "weight")
			{
				$val = $weight;
			}
			else
			{
				$val = $area;
			}
			switch ($vals["rule"])
				{
					case "<":
						if($val < $vals["val"]) $price = $price+$vals["price"];
						//echo "1 $val < ".$vals["val"]." ".$price."<hr>";
						break;
					case "<=":
						if($val <= $vals["val"]) $price = $price+$vals["price"];
						//echo "2 $val <= ".$vals["val"]." ".$price."<hr>";
						break;
					case "=":
						if($vals["val"] = $val) $price = $price+$vals["price"];
						//echo "3 ".$vals["val"]." = ".$val." ".$price."<hr>";
						break;
					case ">=":
						if($val  >=  $vals["val"]) $price = $price+$vals["price"];
						//echo "4 $val >= ".$vals["val"]." ".$price."<hr>";
						break;
					case ">":
						if($val > $vals["val"]) $price = $price+$vals["price"];
						//echo "5 $val > ".$vals["val"]." ".$price."<hr>";
						break;
				}
		}
		return $price;
	}

	public function saveExpressPost()
	{
		foreach ($_POST as $key =>$val)
		{
			if(!in_array($key,array("id","ep_rules")))
			{
				$sqlv[] = " $key = '".sb_addslashes($val)."'";
			}
		}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("express")." SET ".implode(",",$sqlv);
		}
		else
		{
			$sql = "UPDATE ".get_table("express")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
			$eid = $_POST["id"];
		}
		$rs = $this->mDb->execute($sql);
		if(!$eid)
		{
			$eid = $this->mDb->Insert_ID();
		}
		$this->mDb->execute("DELETE FROM ".get_table("express_rules")." WHERE eid=".$eid);
		foreach ($_POST["ep_rules"] as $val)
		{
			$sql = "INSERT INTO ".get_table("express_rules")." SET eid='$eid',type='".$val["type"]."',rule='".$val["rule"]."',val='".$val["val"]."',price='".$val["price"]."'";
			$this->mDb->execute($sql);
		}
		return $rs;
	}

   public function ExpressDel($id)
   {
   		$sql = "DELETE  FROM ".get_table("express")." WHERE id=".$id;
 		$rs = $this->mDb->execute($sql);
 		$sql = "DELETE  FROM ".get_table("express_rules")." WHERE eid=".$id;
 		$this->mDb->execute($sql);
 		return $rs;
   }

   public function getPaymentList($status)
	{
		$sql = "SELECT * FROM ".get_table("payment");
		if($status)
		{
			$sql .= " WHERE status=$status";
		}
		return  $this->mDb->getAll($sql);
	}

	public function getPaymentRow($id)
	{
		$sql = "SELECT * FROM ".get_table("payment")." WHERE id=".$id;
		$rs = $this->mDb->getrow($sql);
		$sql = "SELECT * FROM ".get_table("Payment_rules")." WHERE eid=".$id;
		$rs["rules"] = $this->mDb->getall($sql);
		return $rs;
	}

	public function getypeRow($id,$table,$name)
	{
		$sql = "SELECT $name FROM ".get_table("$table")." WHERE id=".$id;
		$rs = $this->mDb->getone($sql);
		return $rs;
	}

	public function getUniRow($table,$id)
	{
		$sql = "SELECT * FROM ".get_table($table)." WHERE id=".$id;
		$rs = $this->mDb->getrow($sql);
		return $rs;
	}

	public function savePaymentPost()
	{
		foreach ($_POST as $key =>$val)
		{
			if(!in_array($key,array("id","ep_rules")))
			{
				$sqlv[] = " $key = '".sb_addslashes($val)."'";
			}
		}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("payment")." SET ".implode(",",$sqlv);
		}
		else
		{
			$sql = "UPDATE ".get_table("payment")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
		}
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

   public function PaymentDel($id)
   {
   		$sql = "DELETE  FROM ".get_table("payment")." WHERE id=".$id;
 		$rs = $this->mDb->execute($sql);
 		return $rs;
   }

   public function getVoucherTypeRow($id)
	{
		$sql = "SELECT * FROM ".get_table("vouchertype")." WHERE id=".$id;
		$rs = $this->mDb->getrow($sql);
		return $rs;
	}

	public function checkVoucher($uid,$vno)
	{
		$sql = "SELECT t1.*,t2.* FROM ".get_table("voucherts")." t1, ".get_table("vouchertype")." t2  WHERE t1.uid=$uid AND t1.vid=t2.id AND t1.vno='$vno' ORDER BY t1.id DESC";
		$rs = $this->mDb->getrow($sql);
		return $rs;
	}

	public function sendVoucher($typeid,$vid)
	{
		$vinfo = $this->getVoucherTypeRow($vid);
		if($typeid=="1")
		{
			$sql = "SELECT id FROM ".get_table("customers");
			if($_POST["customer_group_id"]>0) $sqlv[] = " customer_group_id = ".$_GET["customer_group_id"];
			if($sqlv)$sql .=" WHERE ".implode("AND",$sqlv);
			$sql .="  ORDER BY id DESC";
			$rs = $this->mDb->getall($sql);
			foreach ($rs as $val)
			{
				$vno = strtoupper(random(12));
				$sql = "INSERT INTO ".get_table("voucherts")." SET vno='$vno',uid=".$val["id"].",vid=$vid";
				$this->mDb->execute($sql);
			}
		}
	}


   public function voucherDel($type,$id)
   {
   		$sql = "DELETE  FROM ".get_table("vouchertype")." WHERE id=".$id;
   		if($type=="voucher")
   		{
   			$sql = "DELETE  FROM ".get_table("vouchers")." WHERE id=".$id;
   		}
 		$rs = $this->mDb->execute($sql);
 		return $rs;
   }

   public function getVoucherTypeList($size=_PAGES)
	{
		$sql = "SELECT * FROM ".get_table("vouchertype");
		$sql .=" ORDER BY createtime DESC";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
	}

  public function getVoucherList($id)
   {
   		$sql = "SELECT * FROM ".get_table("voucherts")." WHERE vid=$id";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
   }

   public function getVoucherListbyUid($uid)
   {
   		$sql = "SELECT t1.*,t2.* FROM ".get_table("voucherts")." t1, ".get_table("vouchertype")." t2  WHERE t1.uid=$uid AND t1.vid=t2.id ORDER BY t1.id DESC";
		$pager    = new Page;
		$get_page = is_numeric($_GET["page"]) ? $get_page : 1;
  		$pagesize = $_GET["pagesize"] ? $_GET["pagesize"] : $size;
		$pager->Page($key='', $pagesize, $groupsize=0, $current=$get_page);
		$pager->execute($this->mDb,$sql);
		$pages['link']  = $pager->pageLinks();
		$pages['frontlink']  = $pager->searchlinks();
		$pages['fromto']  = $pager->fromto();
		$pages['total'] = $pager->getTotalpage();
		$pages['current'] = $pager->getCurrent();
		$pages['totalnum'] = $pager->getTotalnum();
		$pages['jump'] = $pager->jump();
		$pages['pagenum'] = $pagesize;
		$rs  = $pager->getResult();
		$r["logs"] = $rs;
		$r["pages"] = $pages;
		return $r;
   }

   public function useVoucher($uid,$vnum)
   {
   	$sql = "SELECT * FROM ".get_table("voucherts")."  WHERE uid=$uid AND vno='$vnum' AND  flag=0";
   	$rs = $this->mDb->getrow($sql);
   	if($rs)
   	{
   		$sql = "UPDATE ".get_table("voucherts")." SET SET flag=1,usetime=NOW() WHERE uid=$uid AND vno='$vnum'";
   		$this->mDb->execute($sql);
   	}
   	else return $rs;
   }


   public function saveVoucherTypePost()
	{
		foreach ($_POST as $key =>$val)
		{
			if(!in_array($key,array("id")))
			{
				$sqlv[] = " $key = '".sb_addslashes($val)."'";
			}
		}
		if(!$_POST["id"])
		{
			$sql = "INSERT INTO ".get_table("vouchertype")." SET ".implode(",",$sqlv);
		}
		else
		{
			$sql = "UPDATE ".get_table("vouchertype")." SET ".implode(",",$sqlv)." WHERE id=".$_POST["id"];
		}
		$rs = $this->mDb->execute($sql);
		return $rs;
	}

	public function getOrderTotalByUid($uid)
	{
		$sql = "SELECT COUNT(*) FROM ".get_table("orders")." WHERE uid=$uid";
		return $this->mDb->getone($sql);
	}

	public function getOrderListByflag($status,$type=null)
	{
		$sql = "SELECT * FROM ".get_table("orders")." WHERE status=$status";
		$rs = $this->mDb->getall($sql);
		if(!empty($type))
		{
			$cate = array();
			foreach ($rs as $val)
				{
					$cate[$val["orderno"]] = $val["orderno"]." ".$val["contact"];
				}
			$rs = $cate;
		}
		return $rs;
	}

}
?>