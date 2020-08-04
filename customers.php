<?php
class Customers{ 
	private const DB_HOST 		= "localhost";
	private const DB_USER 		= "root";
	private const DB_PASSWORD	= "";
	private const DB_NAME 		= "wordpress522x200425121810";
	private $conn;

	public const user_login		= "yellowadmin";
	public const user_pass		= "f94b86e108ae7374b36cd8c8bd2212d0";

	public function __construct($form_id="", $emailfield="", $namefield="", $q="")
	{
		if (isset($_GET['page'])) {
    		$page = $_GET['page'];
    		$this->page = $page;
		} else {
    		$page = 1;
    		$this->page = $page;
		}
		$this->no_of_records_per_page = 20;
		$this->offset = ($page-1) * $this->no_of_records_per_page;

		$this->conn = new mysqli($this::DB_HOST, $this::DB_USER, $this::DB_PASSWORD, $this::DB_NAME);
		if( is_null($q) ){
			$this->stmt = ' SELECT a.entry_id, a.value AS email, b.datestamp, c.value AS name 
						FROM `wpcj_cf_form_entry_values` AS a, 
							`wpcj_cf_form_entries` AS b, 
							`wpcj_cf_form_entry_values` AS c 
						WHERE a.entry_id=b.id AND a.field_id="'.$emailfield.'" AND 
							b.form_id="'.$form_id.'" AND 
							a.entry_id=c.entry_id AND 
							c.field_id="'.$namefield.'" 
					';
		} else{
			$this->stmt = ' SELECT a.entry_id, a.value AS email, b.datestamp, c.value AS name 
						FROM `wpcj_cf_form_entry_values` AS a, 
							`wpcj_cf_form_entries` AS b, 
							`wpcj_cf_form_entry_values` AS c 
						WHERE a.entry_id=b.id AND a.field_id="'.$emailfield.'" AND 
							b.form_id="'.$form_id.'" AND 
							a.entry_id=c.entry_id AND 
							c.field_id="'.$namefield.'" AND 
							a.value LIKE "%'.$q.'%"
					';
		}
		$this->q = $q;
		$this->form_id = $form_id;
	}

	public function pagination()
	{
		$no_of_records_per_page = $this->no_of_records_per_page;
		$page = $this->page;
		$total_pages_sql = $this->conn->query($this->stmt) or die($this->conn->error);
		$total_rows = $total_pages_sql->num_rows;
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		echo "<p><strong>Page: <span style='padding:7px 10px; background:#EEB220;'>".$page."</span></strong></p>";
		if( !(isset($_GET['q'])) ){
			echo '<ul class="pagination">';
    		echo '<li><a href="?page=1">First</a></li>';
    		echo '<li class="'; if($page <= 1){ echo 'disabled'; } echo '">';
    	    echo '<a href="'; if($page <= 1){ echo '#'; } else { echo '?page=' .($page - 1); } echo '">Prev</a>';
    		echo '</li>';
			echo '<li class="'; if($page >= $total_pages){ echo 'disabled'; } echo '">';
    	    echo '<a href="'; if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } echo '">Next</a>';
    		echo '</li>';
			echo '<li><a href="?page=' . $total_pages . '">Last</a></li>';
			echo '</ul>';
		} else{
			$url = $_SERVER['PHP_SELF'] . '?q=' . $_GET['q'] . '&form_id=' . $_GET['form_id'];
			echo '<ul class="pagination">';
    		echo '<li><a href="'.$url.'&page=1">First</a></li>';
    		echo '<li class="'; if($page <= 1){ echo 'disabled'; } echo '">';
    	    echo '<a href="'; if($page <= 1){ echo '#'; } else { echo $url.'&page=' .($page - 1); } echo '">Prev</a>';
    		echo '</li>';
			echo '<li class="'; if($page >= $total_pages){ echo 'disabled'; } echo '">';
    	    echo '<a href="'; if($page >= $total_pages){ echo '#'; } else { echo $url."&page=".($page + 1); } echo '">Next</a>';
    		echo '</li>';
			echo '<li><a href="'.$url.'&page=' . $total_pages . '">Last</a></li>';
			echo '</ul>';
		}
	}

	public function getList()
	{
		$stmt = $this->stmt . ' ORDER BY b.datestamp DESC
					LIMIT ' . $this->offset . ', ' . $this->no_of_records_per_page;
		$result = $this->conn->query($stmt) or die($this->conn->error);
		if( $result->num_rows > 0 ){
			while( $row = $result->fetch_assoc() ){
				echo "<tr>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['datestamp']."</td>";
				echo "<td><a target='_blank' href='profile_".$this->form_id.".php?entry_id=".$row['entry_id']."'>View</a></td>";
				echo "</tr>";
			}
		} else{
			echo "<h3 style='text-align:center;'><em>You have no records yet</em></h3>";
		}
	}

	public function getUserProfile($entry_id, $form_id)
	{
		if( isset($entry_id) ){
			$stmt = 'SELECT slug, value FROM `wpcj_cf_form_entry_values` a, `wpcj_cf_form_entries` b WHERE a.entry_id="'.$entry_id.'" AND b.id="'.$entry_id.'" AND b.form_id="'.$form_id.'"' ;
			$result = $this->conn->query($stmt) or die($this->conn->error);
			$index = array();
			$values = array();
			while( $row = $result->fetch_assoc() ){
				$index[] = $row['slug'];
				$values[] = $row['value'];
			}
			$index[] = "none";
			$values[] = "";
			$records = array_combine($index, $values);
			return $records;
		} else{
			header("Location: investment_form.php");
		}
	}

	public function search()
	{
		$stmt = $this->stmt . ' ORDER BY b.datestamp DESC
					LIMIT ' . $this->offset . ', ' . $this->no_of_records_per_page;
		$result = $this->conn->query($stmt) or die($this->conn->error);
		if( $result->num_rows > 0 ){
			while( $row = $result->fetch_assoc() ){
				echo "<tr>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['datestamp']."</td>";
				echo "<td><a target='_blank' href='profile_".$this->form_id.".php?entry_id=".$row['entry_id']."'>View</a></td>";
				echo "</tr>";
			}
		} else{
			echo "<h3 style='text-align:center;'><em>No records found</em></h3>";
		}
	}

	public function logout()
	{
		$url = "'logout.php'";
		$btn = '<a href="#"><button class="btn btn-danger" onclick="window.location.assign('.$url.')">Logout</button></a>';
		return $btn;
	}

	public function __destruct()
	{
		$this->conn->close();
	}
}
//$login_yt0$