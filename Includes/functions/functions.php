<?php
    /*
		Title Function That Echo The Page Title In Case The Page Has The Variable $pageTitle And Echo Default Title For Other Pages
	*/
	function getTitle()
	{
		global $pageTitle;
		if(isset($pageTitle))
			echo $pageTitle."| Bếp ăn Vô tri";
		else
			echo "Bếp ăn Vô tri";
	}

	/*
		Hàm này trả về số mục trong một bảng nhất định
	*/

    function countItems($item,$table)
	{
		global $con;
		$stat_ = $con->prepare("SELECT COUNT($item) FROM $table");
		$stat_->execute();
		
		return $stat_->fetchColumn();
	}

    /*
	
	** Chức năng kiểm tra danh mục
	** Function to Check Item In Database [Function with Parameters]
	** $select = the item to select [Example : user, item, category]
	** $from = the table to select from [Example : users, items, categories]
	** $value = The value of select [Example: Ossama, Box, Electronics]

	*/
	function checkItem($select, $from, $value)
	{
		global $con;
		$statment = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
		$statment->execute(array($value));
		$count = $statment->rowCount();
		
		return $count;
	}


  	/*
    	==============================================
    Kiểm tra đầu vào và xóa các khoảng trắng thừa
    	==============================================
	
	*/

  	function test_input($data) 
  	{
      	$data = trim($data);
      	$data = stripslashes($data);
      	$data = htmlspecialchars($data);
      	return $data;
  	}

?>

