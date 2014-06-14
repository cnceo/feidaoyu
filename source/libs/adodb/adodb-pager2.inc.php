<?php
class Page {

    var $sql;
    var $totalnum;
    var $totalpage;
    var $size;
    var $current;
    var $key;
    //var $navchar = array ('|<<', '<<', '<', '>', '>>', '>>|');
    var $navchar = array ('首页', '上页', '上页', '下页', '下页', '末页');
    var $separator = array ('[', ']');
    var $groupsize;
    var $result;

    /*
    * @param key string 分页区别标记
    * @param int size 每页记录数
    * @param int groupsize 每组页码数
    * @param int current 当前页码
    */
    function Page ($key='', $size=10, $groupsize=0, $current=1)
    {
        $this->size = isset ($_GET['size' . $key]) ? (int)$_GET['size' . $key] : $size;
        $this->groupsize = isset ($_GET['groupsize' . $key]) ? (int)$_GET['groupsize' . $key] : $groupsize;
        $this->current = isset ($_GET['page' . $key]) ? (int)$_GET['page' . $key] : $current;
        $this->key = &$key;
    }

    /*
    * @param object adodb 数据库连接
    * @param string sql 要执行的sql语句
    */
    function execute ($adodb, $sql)
    {
        $recordSet = $adodb->PageExecute ($sql, $this->size, $this->current);
        $rs = array ();
        if (isset ($recordSet->fields)) {
            while (!$recordSet->EOF) {
                $rs[] = $recordSet->fields;
                $recordSet->MoveNext();
            }
            $this->totalnum = $recordSet->MaxRecordCount();
            $this->totalpage = $recordSet->LastPageNo() < 0 ? 0 : $recordSet->LastPageNo();
            $this->current = $recordSet->AbsolutePage() < 1 ? 1 : $recordSet->AbsolutePage();
        } else {
            $this->totalnum = 0;
            $this->totalpage = 0;
            $this->current = 0;
        }
        $this->result = $rs;
    }

    /*
    *设置链接头信息
    * @param string remove 要移除的变量名成
    */
    function _setLinkhead ($remove)
    {
        parse_str ($_SERVER['QUERY_STRING'], $query);
        foreach ($query as $k => $v) {
            if (empty ($v) === true && $v != 0) {
                unset ($query[$k]);
            }
        }
        if ($remove == 'page') {
            if (isset ($query['page' . $this->key])) unset ($query['page' . $this->key]);
            foreach ($query as $k => $v) $tmp[] = $k . '=' . $v;
            $tmp[] = 'page' . $this->key . '=';
        } elseif ($remove == 'size') {
            if (isset ($query['size' . $this->key])) unset ($query['size' . $this->key]);
            foreach ($query as $k => $v) $tmp[] = $k . '=' . $v;
            $tmp[] = 'size' . $this->key . '=';
        } elseif ($remove == 'groupsize') {
            if (isset ($query['groupsize' . $this->key])) unset ($query['groupsize' . $this->key]);
            foreach ($query as $k => $v) $tmp[] = $k . '=' . $v;
            $tmp[] = 'groupsize' . $this->key . '=';
        } else {
        }

		/*if(_URL_=="")
		{
			print_r($tmp);
			$yfg_link = implode('/', $tmp);
	        $yfg_link = str_replace("=","/",$yfg_link);
	        $yfg_link = str_replace(array("type","model/","lang/","cate/","article/index/"),"",$yfg_link);
	        //$yfg_link = substr($yfg_link,1);
	        echo $url = $_SERVER['PHP_SELF'];
	        print_r($_SERVER);
	        return $yfg_link;
		}
		else
		{
			//$pattern = array("/page\/\d+\/{0,1}/","/page\/");
	        $pattern = "/page\/\d+\/{0,1}/";
			$replace = "";
			$url = $_SERVER['PHP_SELF'];
			$url = preg_replace($pattern, $replace, $url);
			$yfg_link = implode('/', $tmp);
	        $yfg_link = str_replace("=","/",$yfg_link);
	        return $url .$yfg_link;
		}*/
		$url =  preg_replace("/&page=([0-9]+)/","",$_SERVER["REDIRECT_URL"]);
		$url .=  "&page=";
		return $url;

    }

    /*设置前页后页等链接显示
    * @param array navchar 显示内容
    */
    function setNavchar ($navchar) {
        $this->navchar = &$navchar;
    }

    /*
    *设置分隔符
    * @param array separator 分隔符
    */
    function setSeparator ($separator) {
        $this->separator = &$separator;
    }

    //获得总数量
    function getTotalnum () {
        return $this->totalnum;
    }

    //获得总页数
    function getTotalpage () {
        return $this->totalpage;
    }

    //获得当前页码
    function getCurrent () {
        return $this->current;
    }

    //获得取出的数据
    function getResult () {
        return $this->result;
    }

    //显示设置每页记录条数的菜单
    function sizeMenu () {
        $linkhead = $this->_setLinkhead ('size');
        ob_start ();
        echo "<select onchange=\"window.location='" . $linkhead . "'+this.value\">";
        for ($i = 1; $i <= 15; $i ++) {
            if ($i == $this->size) echo "<option value='" . $i . "' selected>" . $i . "</option>";
            else echo "<option value='" . $i . "'>" . $i . "</option>";
        }
        echo "</select>";
        $jump = ob_get_contents ();
        ob_end_clean ();
        return $jump;
    }

    //显示设置每组页面链接数的菜单
    function groupsizeMenu () {
        if ($this->totalpage <= 1) return '&nbsp;';
        $linkhead = $this->_setLinkhead ('groupsize');
        ob_start ();
        echo "<select onchange=\"window.location='" . $linkhead . "'+this.value\">";
        for ($i = 0; $i <= 7; $i ++) {
            if ($i != $this->groupsize) echo "<option value='" . $i . "'>" . (2 * $i + 1) . "</option>";
            else echo "<option value='" . $i . "' selected>" . (2 * $i + 1) . "</option>";
        }
        echo "</select>";
        $jump = ob_get_contents ();
        ob_end_clean ();
        return $jump;
    }

    //显示页面跳转菜单
    function jump () {
        if ($this->totalpage <= 1) return '&nbsp;';
        $linkhead = $this->_setLinkhead ('page');
        ob_start ();
        echo "<select onchange=\"window.location='" . $linkhead . "'+this.value\">";
        for ($i = 1; $i <= $this->totalpage; $i ++) {
            if ($i != $this->current) echo "<option value='" . $i . "'>" . $i . "</option>";
            else echo "<option value='" . $i . "' selected>" . $i . "</option>";
        }
        echo "</select>";
        $jump = ob_get_contents ();
        ob_end_clean ();
        return $jump;
    }

    //显示本页记录开始结束条数
    function fromto () {
        $from = ($this->current -1) * $this->size + 1;
        $to = ($this->current * $this->size > $this->totalnum) ? $this->totalnum : $this->current * $this->size;
        if ($from != $to) return "第" . $from . "-" . $to . "条";
        else return "第" . $from . "条";
    }

	 //显示搜索页面链接
    function searchlinks () {
         if ($this->totalpage <= 1) return '&nbsp;';
        $linkhead = $this->_setLinkhead ('page');
        $current = $this->current;
        $totalpage = $this->totalpage;
        ob_start ();
        if ($current > 1)
        {
        	echo "<a title='首 页' href='" . $linkhead ."1'>首 页 </a>&nbsp;";
        	echo "<a class='uppage' title='第" . ($current-1) . "页' href='" . $linkhead . ($current-1) . "'> 上一页</a>&nbsp;";
        }
        if ($totalpage < 11)
        {
	        for ($i = 1; $i <= $totalpage; $i ++)
	        {
	            if ($i != $this->current) echo "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>&nbsp;";
	            //else echo "<option value='" . $i . "' selected<b>" . $i . "</b></option>&nbsp;";
	             else echo "<b>" . $i . "</b>&nbsp;";
	        }
        }
        else
        {
	        if ($current < 5)
	        {
		        for ($i = 1; $i < 10; $i ++) {
		            if ($i != $this->current) echo "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>&nbsp;";
		            //else echo "<option value='" . $i . "' selected><b>" . $i . "</b></option>&nbsp;";
		            else echo "<b>" . $i . "</b>&nbsp;";
		        }
	        }else
	        {
		        if ($current+4 >= $totalpage)
		        {
		            $endpage =	$totalpage;
		        }
		        else
		        {
		        	$endpage =	$current+4 ;
		        }
		        $startpage = $current-5;
		        if($startpage<1)$startpage=1;
		        for ($i = $startpage; $i <= $endpage; $i ++)
		         {
		            if ($i != $this->current) echo "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>&nbsp;";
		            //else echo "<option value='" . $i . "' selected><b>" . $i . "</b></option>&nbsp;";
		            else echo "<b>" . $i . "</b>&nbsp;";
		        }
	        }
        }
     /*   if ($current < $totalpage)
        {
        	 echo "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>>> </a>&nbsp;";
        }*/
        if ($current < $totalpage)
        {
        	 echo "<a class='nextpage' title='第" . ($current+1) . "页' href='" . $linkhead . ($current+1) . "'>下一页 </a>&nbsp;";
        }
        $searchlinks = ob_get_contents ();
        ob_end_clean ();
        return $searchlinks;
    }



    //显示页面链接
    function pageLinks () {
        if ($this->totalpage <= 0) return '&nbsp;';
        $linkhead = $this->_setLinkhead ('page');

        $current = $this->current;
        $totalpage = $this->totalpage;
        $groupsize = $this->groupsize;
        $pagemin = ($current != 1) ? $this->separator[0] . "<a title='第1页' href='" . $linkhead . "1'>" . $this->navchar[0] . "</a>" . $this->separator[1] : $this->separator[0] . "<a title='第" . $current . "页'>" . $this->navchar[0] . "</a>" . $this->separator[1];
        $pagemax = ($current != $totalpage) ? $this->separator[0] . "<a title='第" . $totalpage . "页' href='" . $linkhead . $totalpage . "'>" . $this->navchar[5] . "</a>" . $this->separator[1] : $this->separator[0] . "<a title='第" . $current . "页'>" . $this->navchar[5] . "</a>" . $this->separator[1];
        $prev = ($current != 1) ? $this->separator[0] . "<a title='第" . ($current - 1) . "页' href='" . $linkhead . ($current - 1) . "'>" . $this->navchar[2] . "</a>" . $this->separator[1] : $this->separator[0] . "<a title='第" . $current . "页'>" . $this->navchar[2] . "</a>" . $this->separator[1];
        $next = ($current != $totalpage) ? $this->separator[0] . "<a title='第" . ($current + 1) . "页' href='" . $linkhead . ($current + 1) . "'>" . $this->navchar[3] . "</a>" . $this->separator[1] : $this->separator[0] . "<a title='第" . $current . "页'>" . $this->navchar[3] . "</a>" . $this->separator[1];
        $gprev = $this->separator[0] . "<a title='第" . ($current - $groupsize) . "页' href='" . $linkhead . ($current - $groupsize) . "'>" . $this->navchar[1] . "</a>" . $this->separator[1];
        $gnext = $this->separator[0] . "<a title='第" . ($current + $groupsize) . "页' href='" . $linkhead . ($current + $groupsize) . "'>" . $this->navchar[4] . "</a>" . $this->separator[1];

        ob_start ();
        if ($groupsize != 0) {
            if ($current == 1) {}
            elseif ($current <= (1 + $groupsize)) {
                echo $prev;
                for ($i = 1; $i < $current; $i ++) {
                    echo $this->separator[0] . "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>" . $this->separator[1];
                }
            } elseif ($current > (1 + $groupsize)) {
                echo $pagemin;
                echo $gprev;
                echo $prev;
                echo ' ... ';
                for ($i = ($current - $groupsize); $i < $current; $i ++) {
                    echo $this->separator[0] . "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>" . $this->separator[1];
                }
            } else {}
        } else {
            echo $pagemin;
            echo $prev;
        }

        echo $this->separator[0] . "<a title='第" . $current . "页'>" . $current . "</a>" . $this->separator[1];

        if ($groupsize != 0) {
            if ($current == $totalpage) {}
            elseif ($current >= ($totalpage - $groupsize)) {
                for ($i = ($current + 1); $i <= $totalpage; $i ++) {
                    echo $this->separator[0] . "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>" . $this->separator[1];
                }
                echo $next;
            } elseif ($current < ($totalpage-$groupsize)) {
                for ($i = ($current + 1); $i <= ($current + $groupsize); $i ++) {
                    echo $this->separator[0] . "<a title='第" . $i . "页' href='" . $linkhead . $i . "'>" . $i . "</a>" . $this->separator[1];
                }
                echo ' ... ';
                echo $next;
                echo $gnext;
                echo $pagemax;
            } else {
            }
        } else {
            echo $next;
            echo $pagemax;
        }

        $pageLinks = ob_get_contents ();
        ob_end_clean ();
        return $pageLinks;
    }
}

?>