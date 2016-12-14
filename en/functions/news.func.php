<?php
function newsExists($news_id){
  $return = array();
  $news_id=(int) $news_id;

  if($news_id != 0){
		//echo $news_id;
    $query= mysql_query("SELECT news_id FROM news WHERE news_id=$news_id");
    $num_rows=mysql_num_rows($query);
      if($num_rows != 0){
        //$row = mysql_fetch_assoc($query);
        return true;
        // $return['last_activity'] = $row['last_activity'];
      }else{
        return false;
      }
    }else{
      return false;
    }
}
	function getNews($news_id){
		$return = array();
		$news_id=(int) $news_id;

		if($news_id != 0){
			$query = mysql_query("SELECT * from news where news_id=$news_id");
			$num_rows=mysql_num_rows($query);

			if($num_rows != 0){
				$row = mysql_fetch_assoc($query);
				$return['error'] = 0;
				$return['news_id'] = $row['news_id'];
				$return['news_title'] = $row['news_title'];
				$return['news_text'] = $row['news_text'];
				$return['date_created'] = $row['date_created'];
				}
				else
				{
				$return['error'] = 1;
				$return['err_msg'] = "Can't Find Article !";
				}
			}
			return $return;
		}

		function getNewses($limit=0, $order=0){
			$return=array();
			$limit=(int) $limit;
			$order=(int) $order;
			$addon="";
			$geezMonthName=array('01'=>'ጥሪ', '02'=>'የካቲት','03'=>'መጋቢት','04'=> 'ሚያዝያ', '05'=>'ግንቦት', '06'=>'ሰነ', '07'=>'ሓምለ','08'=>'ነሓሰ','09'=>'መስከረም', '10'=>'ጥቅምቲ','11'=>'ሕዳር', '12'=>'ታሕሳስ');
			
			$mainQuery = "SELECT * from news";
			if($order !=0 && $limit !=0){
				$addon=" ORDER BY news_id ASC LIMIT $limit";
			}else if($order != 0 && $limit == 0){
				$addon=" ORDER BY news_id ASC";
			}else if($order == 0 && $limit != 0){
				$addon=" ORDER BY news_id DESC LIMIT $limit";
			}else if($order == 0 && $limit == 0){
					$addon=" ORDER BY news_id DESC";
			}
			$query=mysql_query($mainQuery.$addon);
	    while($row=mysql_fetch_assoc($query)){
	      $return[]=array(
	        "news_id"=>$row['news_id'],
	        "news_title"=>$row['news_title'],
					"date_created"=>gmdate("d",$row['date_created'])." ".$geezMonthName[gmdate("m",$row['date_created'])]." ".gmdate("Y",$row['date_created'])
				);
	        //"news_text"=>$row['news_text'],
	        //"news_author_id"=>$row['news_author_id'],

	      //  "last_modified"=>$row['last_modified']);
			}
			return $return;
		}
?>
