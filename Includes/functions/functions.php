<?php
    /*
		Title Function That Echo The Page Title In Case The Page Has The Variable $pageTitle And Echo Default Title For Other Pages
	*/
	if (!function_exists('getTitle')) {
		function getTitle()
		{
			global $pageTitle;
			if (isset($pageTitle))
				echo $pageTitle . "| Bếp ăn Vô tri";
			else
				echo "Bếp ăn Vô tri";
		}
	}
	

	/*
		Hàm này trả về số mục trong một bảng nhất định
	*/

