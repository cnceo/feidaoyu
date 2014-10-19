<?php

/**
 * 购物车*
 */
class cart extends Controller {

    /**
     * 读取购物车产品
     */
    public function defshow() {
        // echo '2222';
        $this->_globals();
        $r["logs"] = $_SESSION["shopcart"];
        foreach ($r["logs"] as $key => $val) {
            $totalprice += $val["tprice"];
            $r["logs"][$key]["classname"] = $this->mBasic->getName("categorys", $val["class_id"], "ename");
        }
        $this->result["totalprice"] = $totalprice;
        $this->result["shopcart"] = $r["logs"];
        $this->tplname = "cart";
        $this->result["sites"]["pagetitle"] = "购物车" . $this->result["sites"]["sitename"];
    }

    /**
     * 添加到购物车
     */
    public function addcart() {
        // echo '11111';
        $this->_globals();
        $time = time();
        $rand = rand(1, 99);
        $time .=$rand;
        if ($_GET["vps"] == 'vps') {
            $row = $this->mProduct->getRow($_GET["id"]);
            $skey = $row["id"];
            if ($_SESSION["shopcart"][$skey]) {
                $_SESSION["shopcart"][$skey + $time] = $_SESSION["shopcart"][$skey];
                $_SESSION["shopcart"][$skey + $time]["tprice"] = $_GET["year"] * $row["price"];
                $_SESSION["shopcart"][$skey + $time]["year"] = $_GET["year"];
                $_SESSION["shopcart"][$skey + $time]["ptype"] = $_GET["vps"];
            } else {
                $_SESSION["shopcart"][$skey] = $row;
                $_SESSION["shopcart"][$skey]["tprice"] = $_GET["year"] * $row["price"];
                $_SESSION["shopcart"][$skey]["year"] = $_GET["year"];
                $_SESSION["shopcart"][$skey]["ptype"] = $_GET["vps"];
            }
        } else {
            $row = strtolower($_GET["domain"]);
            if ($_SESSION["shopcart"][$row]) {
                /* 	      		$_SESSION["shopcart"][$row]["tprice"] = ($_GET["year"]+1)*$_GET["price"];
                  $_SESSION["shopcart"][$row]["year"] = $_GET["year"]+1; */
            } else {
                $_SESSION["shopcart"][$row]["domain"] = $row;
                $_SESSION["shopcart"][$row]["price"] = $_GET["price"];
                $_SESSION["shopcart"][$row]["tprice"] = $_GET["year"] * $_GET["price"];
                $_SESSION["shopcart"][$row]["year"] = $_GET["year"];
                $_SESSION["shopcart"][$row]["ptype"] = $_GET["vps"];
            }
        }
        
        header("LOCATION:/cart.html");
        exit();
    }

    public function addcarts() {
        $this->_globals();
        $time = time();
        $rand = rand(1, 99);
        $time .=$rand;
        foreach ($_POST["sdomain"] as $key => $val) {
            $row = strtolower($val);
            if ($_SESSION["shopcart"][$row]) {
                
            } else {
                $_SESSION["shopcart"][$row]["domain"] = $row;

                $_SESSION["shopcart"][$row]["price"] = $_POST["price"][$key];
                $_SESSION["shopcart"][$row]["tprice"] = $_POST["price"][$key];
                $_SESSION["shopcart"][$row]["year"] = $_POST["year"][$key];
            }
        }
        if ($_SESSION["shopcart"]) {
            $msg["status"] = 'true';
        }
        echo json_encode($msg);
        die();
    }

    /**
     * 删除购物车的商品
     */
    public function delProduct() {
        $k = $_POST["k"];
        unset($_SESSION["shopcart"][$k]);
        $msg["does"] = 0;
        if (count($_SESSION["shopcart"]) > 0) {
            $msg["does"] = 1;
        }
        echo json_encode($msg);
        die();
    }

    /**
     * //清空购物车
     */
    public function clearCart() {
        unset($_SESSION["shopcart"]);
        $msg["does"] = 1;
        echo json_encode($msg);
        die();
    }

    /**
     * 更改年份
     */
    public function addyear() {
        $k = $_POST["k"];
        $_SESSION["shopcart"][$k]["year"] = $_POST["year"];
        if ($_POST["ptype"] == 'vps') {
            if ($_POST["year"] == '2') {
                $_SESSION["shopcart"][$k]["tprice"] = $_POST["year"] * $_POST["tprice"] * 0.85;
            } elseif ($_POST["year"] == '3') {
                $_SESSION["shopcart"][$k]["tprice"] = $_POST["year"] * $_POST["tprice"] * 0.80;
            } else {
                $_SESSION["shopcart"][$k]["tprice"] = $_POST["year"] * $_POST["tprice"];
            }
        } else {
            $_SESSION["shopcart"][$k]["tprice"] = $_POST["year"] * $_POST["tprice"];
        }
        $msg["does"] = 1;
        echo json_encode($msg);
        die();
    }

    private function _globals() {
        $this->loadModel(array("Product", "Basic"));
        $this->result["yearlist"] = array(
            1 => "1年",
            2 => "2年",
            3 => "3年"
        );
    }

}

?>