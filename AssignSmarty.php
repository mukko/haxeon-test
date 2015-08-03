<?php

/**
*　テンプレートファイルの描画処理とSmarty変数の割り当てを行う
*/
class AssignSmarty {
	private $common;
	private $smarty;
	private $dispTpl;
	
	//スマーティにアサインする可変引数以外の引数の数
	private static $DEFAULT_NUM_ARGS;
	
	/**コンストラクタでテンプレートの読み込み、Smartyパラメータのアサイン、ページの表示を行う。
	* $common : 共通部分のPHPファイル名
	* $dispTpl: 描画するテンプレートファイル名
	* $smartyArgs : 偶数番目には割り当て名、奇数番目には値を入れる
	*/
	function __construct($common, $dispTpl, ...$smartyArgs) {
		//共通テンプレートの読み込み
		$this->common = $common;
		require_once($this->common);
		
		//Smartyオブジェクト生成
		$smarty = new Smarty();
		
		//Smartyにパラメータをアサイン
		$DEFAULT_NUM_ARGS = 2;
		for($i=$DEFAULT_NUM_ARGS; $i < func_num_args(); $i++){
			$smartyArgsName = func_get_arg($i++);
			$smartyArgsValue= func_get_arg($i);
			$smarty->assign($smartyArgsName, $smartyArgsValue);
		}
		
		//ページの表示
		$this->$dispTpl = $dispTpl;
		$smarty->display($this->$dispTpl);
	}
}
