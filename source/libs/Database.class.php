<?php
    /**
	* Databases 数据库封装类
	* @package   Seabig Software Inc.
	* @Author by Vince Shen<vince@seabig.cn>. All rights reserved.
	* @version  v1.5 2011-12-12 23:29
	*/
    require_once("adodb/adodb.inc.php");
	class Databases
	{
		public $mMasterDb;
		public $mSlaveDb;
		public $mLogDb;
		public $mMemc;
        private $version;
        private $group = null;
        private $dns = null;
        public $debug;
     
		public function __construct()
		{
			global $_DB;
			$this->_DB = $_DB;
			$this->Memcache($this->_DB["MEM_CACHE"]);
			$this->dns = _DBNAME;
			$this->debug = _DB_DEBUG;
		}
		
		public function &Execute($sql,$inputarr=false)
		{
			$this->getGroup($sql);
			if (preg_match("/^(INSERT)?(UPDATE)?(DELETE)?/i", trim($sql)))
			{
				$this->getGroup($sql);
				if(!$this->mMasterDb)$this->loadMasterDb($this->_DB[$this->dns]["MASTER"]);
				$this->version++;
				//echo "<hr>".$this->version;
		        $this->mMemc->set('version_'.$this->group,$this->version);
				return $this->mMasterDb->Execute($sql,$inputarr);
			}
			else
			{
				if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
				{
					return $res;
				}
				else
				{
					if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
					$rs = $this->mSlaveDb->Execute($sql,$inputarr);
					$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
					return $rs;
				}
			}
		}
		
		public function &_Execute($sql,$inputarr=false)
		{
			$this->getGroup($sql);
			if (preg_match("/^(INSERT)?(UPDATE)?(DELETE)?/i", trim($sql)))
			{
				$this->getGroup($sql);
				if(!$this->mMasterDb)$this->loadMasterDb($this->_DB[$this->dns]["MASTER"]);
				$this->version++;
				//echo "<hr>".$this->version;
		        $this->mMemc->set('version_'.$this->group,$this->version);
				return $this->mMasterDb->_Execute($sql,$inputarr);
			}
			else
			{
				if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
				{
					return $res;
				}
				else
				{
					if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
					$rs = $this->mSlaveDb->_Execute($sql,$inputarr);
					$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
					return $rs;
				}
			}
		}
		
		public function &GetRow($sql,$inputarr=false)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->GetRow($sql,$inputarr);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function GetArray($sql,$inputarr=false)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->GetArray($sql,$inputarr);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function &GetAll($sql, $inputarr=false)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->GetAll($sql,$inputarr);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function &GetAssoc($sql, $inputarr=false,$force_array = false, $first2cols = false)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->GetAssoc($sql, $inputarr,$force_array, $first2cols);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function GetOne($sql,$inputarr=false)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->GetOne($sql,$inputarr);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function &SelectLimit($sql,$nrows=-1,$offset=-1, $inputarr=false,$secs2cache=0)
		{
			$this->getGroup($sql);
			if($res = $this->mMemc->get($this->group.'_'.$this->version.'_'.md5($sql)))
			{
				return $res;
			}
			else
			{
				if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
				$rs = $this->mSlaveDb->SelectLimit($sql,$nrows,$offset, $inputarr,$secs2cache);
				$this->mMemc->set($this->group.'_'.$this->version.'_'.md5($sql),$rs);
				return $rs;
			}
		}
		
		public function Insert_ID()
		{
			return $this->mMasterDb->Insert_ID();
		}
		
		public function PO_Insert_ID($table="", $id="")
		{
			return $this->mMasterDb->PO_Insert_ID($table,$id);
		}
		
		public function Affected_Rows()
		{
			return $this->mMasterDb->Affected_Rows();
		}
		
		public function PageExecute($sql, $nrows, $page, $inputarr=false, $secs2cache=0) 
		{
			if(!$this->mSlaveDb)$this->loadSlaveDb($this->_DB[$this->dns]["SLAVE"]);
			return $this->mSlaveDb->PageExecute($sql, $nrows, $page, $inputarr, $secs2cache=0); 
		}
		
		private function getGroup($sql)
		{
			//preg_match('/\s+?(INTO|FROM|DELETE|UPDATE)\s+(.*?)($|\s+)/i', $sql, $arr);
			//preg_match('/(\s+)?(INTO|FROM|DELETE|UPDATE)\s+(.*?)($|\s+)/i', $sql, $arr);
			preg_match('/.*(INTO|FROM|DELETE|UPDATE)\s+(.*?)($|\(|\s+)/i', $sql, $arr); 
			$this->group = HS_KEY."_".$arr[2];
			//echo "<hr>group:".$this->group;
			//print_r($arr[2]);
			$this->version = 1;
			if($version = $this->mMemc->get('version_'.$this->group))
			{
				$this->version = $version;
			}
			//echo "<hr>version:".$this->version;
		}
		
		private function loadMasterDb($db)
		{
			if (!$this->mMasterDb)
			{
				$mdb = NewADOConnection($db["dbtype"]);
				$mdb->Connect($db["host"], $db["username"],$db["password"], $db["dbname"]);
				$mdb->debug=($this->debug)?"1":"0";
				$mdb->query("SET CHARACTER SET ".$db["dbchar"]);
				$this->mMasterDb = $mdb;
			}
		}

		private  function loadSlaveDb($db)
		{
			if (!$this->mSlaveDb)
			{
				$mdb = NewADOConnection($db["dbtype"]);
				$mdb->Connect($db["host"], $db["username"],$db["password"], $db["dbname"]);
				$mdb->debug=($this->debug)?"1":"0";
				$mdb->query("SET CHARACTER SET ".$db["dbchar"]);
				$this->mSlaveDb = $mdb;
			}
		}
		
		private function Memcache($memc)
		{
			if (!$this->mMemc)
			{
				$this->mMemc = new Memcache;
				//$this->mMemc->connect($memc["host"], $memc["port"]);
				foreach ($memc as $key)
				{
					$this->mMemc->addServer($key["host"], $key["port"]);
				}
			}
		}
	}
?>