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
					"date_created"=>timestampToGeezDating($row['date_created'])
				);
	        //"news_text"=>$row['news_text'],
	        //"news_author_id"=>$row['news_author_id'],

	      //  "last_modified"=>$row['last_modified']);
			}
			return $return;
		}

    function writeNews($news_title, $news_text, $news_author, $email_notification=0){
	    $return = array();
	    $news_title = nl2br(mysql_real_escape_string(addslashes(trim($news_title))));
	    $news_text = nl2br($news_text);
	    $news_text = mysql_real_escape_string(addslashes(trim($news_text)));
	    $news_author = (int) $news_author;
	    $timestamp = time();

	    if($news_author !=0){
	      $query = mysql_query("INSERT into news(news_title,news_text,news_author_id,date_created,last_modified)
				VALUES('$news_title','$news_text','$news_author','$timestamp','$timestamp')");

	      if($query){
	        $return['error'] = 0;
	        $return['last_id'] = mysql_insert_id();
	}
	      else{
	        $return['error'] = 0;
	        $return['err_msg'] = "Database Error. Please Try again Later";
	      }
	    }
	    else{
	      $return['error'] = 1;
	      $return['err_msg'] = "User not verified";
	    }
	    return json_encode($return);
	  }

		function editNews($news_id,$news_title,$news_text,$newsEditor){
	    $return=array();

	    $news_title=nl2br(mysql_real_escape_string($news_title));
	    $news_text=nl2br($news_text);
	    $news_text=mysql_real_escape_string($news_text);

	    $query=mysql_query("UPDATE news SET news_title='$news_title', news_text='$news_text', news_author_id='$newsEditor'
	       WHERE news_id='$news_id'");
	    if($query){
	      $return['error']=0;
	    }else{
	      $return['error']=1;
	      $return['err_msg']="Edit couldn't be completed";
	    }
	    echo mysql_error();
	    return json_encode($return);
	  }
?>
