<?php

/**
*　フォーム部分をオブジェクト化
*/
class Form {
	private $commonTpl;
	private $smarty;
	private $dispTpl;
	private $smartyArgsName;
	private $smartyArgs;
	
	//スマーティにアサインする可変引数以外の引数の数
	private static $DEFAULT_NUM_ARGS;
	
	//コンストラクタでテンプレートの読み込み、Smartyパラメータのアサイン、ページの表示を行う。
	function __construct($commonTpl, $dispTpl, ...$smartyArgs) {
		//共通テンプレートの読み込み
		$this->commonTpl = $commonTpl;
		require_once($this->commonTpl);
		
		//Smartyオブジェクト生成
		$smarty = new Smarty();
		
		//Smartyにパラメータをアサイン
		$DEFAULT_NUM_ARGS = 2;
		for($i=$DEFAULT_NUM_ARGS; $i < func_num_args(); $i++){
			//$smarty->assign(func_get_arg($i), func_get_arg($i++));
			echo func_get_arg($i);
		}
		
		//ページの表示
		$smarty->display($dispTpl);	
	}
}
