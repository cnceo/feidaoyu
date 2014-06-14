<?
	class Language
	{
		public $lang;
		
		public function __construct()
		{
			//$this->lang = $this->loadLang();
		}
		
		private function loadLang()
		{
			require_once("../cache/lang."._LANG.".php");
			if(!$lang)
			{
				$this->getLang();
			}
			else
			{
				$this->lang = $lang;
			}
		}
		
		private function getLang()
		{
			//file("../lang/");
		}
	}
?>