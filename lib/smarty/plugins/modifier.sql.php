<?php

class SqlHighlighter {
	var $__sql_words = Array();
	var $stringtextColor, $numberColor, $backgroundColor;

	function SqlHighlighter( $sintax_file_path = "", $genericSintaxcolorColor="#002060", $informationSintaxcolorColor="#F00000", $manipolationSintaxcolorColor="#0000E6", $columnsSintaxcolorColor="#404000", $stringtextColor="#2222C0", $numberColor="#00B000", $backtickColor="#459898", $backgroundColor="#F8F8F8" ) {
		$this->stringtextColor = $stringtextColor;
		$this->numberColor = $numberColor;
		$this->backtickColor = $backtickColor;
		$this->backgroundColor = $backgroundColor;
		$this->__sql_words["find"] = Array();
		$this->__sql_words["replace"] = Array();
		$sintax_file_path = ROOT_DIR.'lib/SqlHighlighter/';
		$this->popolateReplacer( $sintax_file_path."SQL.sintax.generic.txt", "\\1<span style=\"color: {$genericSintaxcolorColor}; background-color: ".$this->backgroundColor.";\">\\2</span>\\3" );
		$this->popolateReplacer( $sintax_file_path."SQL.sintax.information.txt", "\\1<span style=\"color: {$informationSintaxcolorColor}; background-color: ".$this->backgroundColor.";\">\\2</span>\\3" );
		$this->popolateReplacer( $sintax_file_path."SQL.sintax.manipolation.txt", "\\1<span style=\"color: {$manipolationSintaxcolorColor}; background-color: ".$this->backgroundColor.";\">\\2</span>\\3" );
		$this->popolateReplacer( $sintax_file_path."SQL.sintax.columns.txt", "\\1<span style=\"color: {$columnsSintaxcolorColor}; background-color: ".$this->backgroundColor.";\">\\2</span>\\3" );
	}
	function popolateReplacer( $filename, $toReplace ) {
		$rf = @fopen($filename, "r");
		if(!$rf) {
			die("<hr /><b>class SqlHighlighter ERROR:</b><br /> <i>file</i> \"{$filename}\" <i>not found.</i>!<hr />");
		}
		$sql_arr = fread($rf, filesize($filename));
		fclose($rf);
		$sql_arr = explode("|", $sql_arr);
		$sql_word_starter = 0;
		$sql_word_end = count( $sql_arr );
		while( $sql_word_starter < $sql_word_end ) {
			$this->__sql_words["find"][] = "/(?i)(^|[^a-z0-9\_]){1}(".$sql_arr[$sql_word_starter++].")([^a-z0-9\_]|$){1}/";
			$this->__sql_words["replace"][] = $toReplace;
		}
	}
	function rewriteText( &$st, &$ar ) {
		foreach( $ar as $k => $v ) {
			$st = str_replace( $k, "<span style=\"color: ".$this->stringtextColor."; background-color: ".$this->backgroundColor.";\">".$v."</span>", $st );
		}
	}

	function highlight( $st ) {
		global $__remember_replacment_on_sql_string;
		$__remember_replacment_on_sql_string = Array();
		if( get_magic_quotes_gpc() ) {
			$st = stripslashes( $st );
		}
		$symbol__1 = "_replace[mono][".md5(microtime())."]";
		$symbol__2 = '_replace[double]['.md5(microtime()).']';
		$st = str_replace( '\\"', $symbol__2, str_replace( "\\'", $symbol__1, $st ) );
		$__replacer_function = create_function(
		'$replacement',
		'global $__remember_replacment_on_sql_string;
		$returned = md5($replacement[1].$replacement[2].$replacement[1]);
		$__remember_replacment_on_sql_string[$returned] = htmlentities($replacement[1].$replacement[2].$replacement[1]);
		return $returned;'
		);
		$st = preg_replace_callback( '/(")([^\a]*?)(")/i', "$__replacer_function", $st );
		$st = preg_replace_callback( "/(')([^\a]*?)(')/i", "$__replacer_function", $st );
		$st = preg_replace( "/([^a-zA-Z0-9\_]){1}([0-9]+)([^a-zA-Z0-9\_]{1}|$)/", "\\1<span style=\"color: ".$this->numberColor."; background-color: ".$this->backgroundColor.";\">\\2</span>\\3", $st );
		$st = preg_replace( "/(`)([^\a]*?)(`)/i", "\\1<span style=\"color: ".$this->backtickColor."; background-color: ".$this->backgroundColor.";\">\\2</span>\\3", $st );
		$st = preg_replace( $this->__sql_words["find"], $this->__sql_words["replace"], $st);
		if( count($__remember_replacment_on_sql_string) > 0 ) {
			$this->rewriteText( $st, $__remember_replacment_on_sql_string );
			$this->rewriteText( $st, $__remember_replacment_on_sql_string );
		}
		$st = str_replace( $symbol__2, '\\"', str_replace( $symbol__1, "\\'", $st ) );
		unset( $__remember_replacment_on_sql_string );
		return $st;
	}
}


function smarty_modifier_sql($string)
{
	$obj = new SqlHighlighter;
    $sql = $obj->highlight($string);
	 return $sql;
}

?>