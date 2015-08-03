<?php

/**
*　テンプレートファイルの描画処理とSmarty変数の割り当てを行う
*/
class AssignSmarty {
	private $common;
	private $smarty;
	private $dispTpl;
	
	/**コンストラクタでテンプレートの読み込み、Smartyパラメータのアサイン、ページの表示を行う。
	* $common : 共通部分のPHPファイル名
	* $dispTpl: 描画するテンプレートファイル名
	* $smartyArgs : Smartyにアサインする変数を持つリスト。偶数番目には割り当て名、奇数番目には値を入れる
	*/
	function __construct($common, $dispTpl, $smartyArgs) {
		//共通テンプレートの読み込み
		$this->common = $common;
		require_once($this->common);
		
		//Smartyオブジェクト生成
		require_once('Smarty.class.php');
		$smarty = new Smarty();
		
		//Smartyにパラメータをアサイン
		for($i=1; $i<count($smartyArgs); $i++) {
			$smartyArgsName = $smartyArgs[$i++];
			$smartyArgsValue= $smartyArgs[$i];
			$smarty->assign($smartyArgsName, $smartyArgsValue);
		}
		
		//ページの表示
		$this->$dispTpl = $dispTpl;
		$smarty->display($this->$dispTpl);
	}
}
