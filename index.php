<?php
	/* 外部から入力された値をそのままSQLの一部にするのは危険 */

	echo "<TT>\n" ;

	if(! isset($_GET['PARAM'])){
		printf('<A HREF="./?PARAM=%s">正解</A><HR>',"SECRET") ;
		printf('<A HREF="./?PARAM=%s">不正解</A><HR>',"HOEHOE") ;
		printf('<A HREF="./?PARAM=%s">攻撃</A><HR>',"' OR ''='") ;
		printf('<A HREF="./?PARAM=%s">不正解</A><HR>',"HOEHOE") ;
		printf('<A HREF="./?PARAM=%s">攻撃</A><HR>',"' OR ''='") ;
		printf('<A HREF="./?PARAM=%s">不正解</A><HR>',"HOEHOE") ;
		printf('<A HREF="./?PARAM=%s">攻撃</A><HR>',"' OR ''='") ;
	}else{
		if(
			(!$con = mysql_connect('localhost','mysql')) ||
			(!mysql_select_db('mysql',$con))
		){
			die(mysql_error()) ;
		}else{
			$passwd = $_GET['PARAM'] ;

			$sql = sprintf("SELECT COUNT(*) FROM tbl_passwd WHERE passwd='%s'",$passwd) ;
			printf("SELECT COUNT(*) FROM tbl_passwd WHERE passwd='<FONT COLOR=#FF0000>%s</FONT>'",$passwd) ;
			echo '<HR>' ;
			if(!$result = mysql_query($sql,$con)){
				die(mysql_error()) ;
			}else{
				if($row = mysql_fetch_array($result)){
					if($row[0] == 0){
						echo '該当なし' ;
					}else{
						echo '該当しました' ;
					}
				}else{
					echo '該当なし' ;
				}
			}
		}

		if($con){ mysql_close($con) ; }
	}
	echo "</TT>\n" ;

	/*
		mysql> desc tbl_passwd ;
		+--------+-------------+------+-----+---------+-------+
		| Field  | Type        | Null | Key | Default | Extra |
		+--------+-------------+------+-----+---------+-------+
		| passwd | varchar(32) | YES  |     | NULL    |       |
		+--------+-------------+------+-----+---------+-------+
		1 row in set (0.00 sec)

		mysql> select * from tbl_passwd ;
		+--------+
		| passwd |
		+--------+
		| SECRET |
		+--------+
		1 row in set (0.00 sec)
	*/
?>
