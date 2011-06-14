<?php
class fish extends Controller { 
	function fish()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
	} 
	function login(){  
		$this->load->library('SimpleLoginSecure');
		if($this->session->userdata('logged_in')) {  
			redirect('/fish','refresh');
		}else{
			$data['attempt'] = $this->uri->segment(3); 
			$this->load->view('login_view',$data); 
			return; 
		} 
	} 
	function send_login(){
		$this->load->library('SimpleLoginSecure'); 
		if($this->simpleloginsecure->login($_POST['username'], $_POST['pass'])) {
			redirect('/fish','refresh');
			// 'passed';	
		}else{
			redirect('/fish/login/f','refresh');			
		}
	}
	function logout(){
		$this->load->library('SimpleLoginSecure');
		// logout
		$this->simpleloginsecure->logout();
		$this->load->view('login_view',$data);
	}
	function modify_line(){ 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url);
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$batch_ID = $direct_array[1];
			$this->db->where('batch_ID', $batch_ID);
			$query = $this->db->get('fish');
			$data['batch_found']  = "";
			if ($query->num_rows() > 0){
  				$selected_batch = $query->row_array();
				$data['batch_found'] = 1;
			} 
			$this->db->where('batch_ID', $selected_batch['father_ID']);
			$data['father'] = $this->db->get('fish');
			$this->db->where('batch_ID', $selected_batch['mother_ID']);
			$data['mother'] = $this->db->get('fish'); 
			$this->db->order_by("strain", "asc"); 
			$data['all_strains'] = $this->db->get('strain');			
			$this->db->order_by("promoter", "asc"); 
			$data['all_transgenes'] = $this->db->get('transgene'); 
			
			$this->db->where('transgene_ID', $selected_batch['transgene_ID']);
			$query = $this->db->get('transgene');
			if ($query->num_rows() > 0){
				$data['selected_transgene'] = $query->row_array();
			}
			$this->db->where('mutant_ID', $selected_batch['mutant_ID']);
			$query = $this->db->get('mutant');
			if ($query->num_rows() > 0){
				$data['selected_mutant'] = $query->row_array(); 
			}			
			$this->db->order_by("mutant", "asc"); 
			$data['all_mutants'] = $this->db->get('mutant');
			$this->db->order_by("last_name", "asc"); 
			$data['all_users'] = $this->db->get('users');
			$this->db->order_by("name", "asc"); 
			$data['all_fish'] = $this->db->get('fish'); 
			$data['all_tanks'] = $this->db->get('tank'); 			
			$this->db->select("tank.*, cast(mid(location,1,LOCATE('-',location)-1) as UNSIGNED) as sort_1,
		  cast(mid(location,LOCATE('-',location)+1,LOCATE('-',location,LOCATE('-',location))-1) as UNSIGNED) as sort_2,
		  cast(mid(location,LOCATE('-',location,LOCATE('-',location)+1)+1) as UNSIGNED) as sort_3",FALSE);
			$this->db->from('tank');
			$this->db->join('tank_assoc', 'tank.tank_ID = tank_assoc.tank_ID','left');
			$this->db->where('batch_ID', $selected_batch['batch_ID']);
			$this->db->order_by("sort_1,sort_2,sort_3", 'asc');
			$query = $this->db->get(); 
			if ($query->num_rows() > 0){
				$index = "0";
				foreach ($query->result_array() as $temp){	 
					$data['current_tanks'][$index] = $temp;  
					$this->db->where('tank_ID', $temp['tank_ID']);
					$tank_count_check = $this->db->get('tank_assoc');
					if ($tank_count_check->num_rows() > 0){
						foreach ($tank_count_check->result_array() as $temp_c){	 
							$data['current_tanks'][$index]['multiple_batch'][] = $temp_c['batch_ID'];
						}
					} 
					$index++;
				}
			}
			  
			$url = $this->config->item('base_url');
			output_fields($selected_batch, $batch_ID,$data,$url);
		}elseif ($direct_array[0] == "n"){		 	 
			 $this->db->order_by("strain", "asc"); 
			$data['all_strains'] = $this->db->get('strain');			
			$this->db->order_by("promoter", "asc"); 
			$data['all_transgenes'] = $this->db->get('transgene');
			$this->db->order_by("mutant", "asc"); 
			$data['all_mutants'] = $this->db->get('mutant');
			$this->db->order_by("last_name", "asc"); 
			$data['all_users'] = $this->db->get('users');
			$this->db->order_by("name", "asc"); 
			$data['all_fish'] = $this->db->get('fish');	 
			$this->CI =& get_instance();
			$data['loggedin_user_ID'] = $this->CI->session->userdata('user_ID'); 
			output_fields_new($selected_batch, $batch_ID,$data);
		}elseif ($direct_array[0] == "r"){
			$batch_ID = $direct_array[1];
			$this->db->where('batch_ID', $batch_ID);
			$query = $this->db->get('fish');
			if ($query->num_rows() > 0){
  				$selected_batch = $query->row_array();
			}	
			output_fields_remove($selected_batch, $batch_ID);			
		}
	} 
	function modify_users(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url);
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$user_ID = $direct_array[1];
			$this->db->where('user_ID', $user_ID);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0){
  				$selected_user = $query->row_array();
			}
			$this->db->order_by("lab", "asc"); 
			$labs = $this->db->get('labs');
			output_user_fields($selected_user,$url,$labs);
		}elseif ($direct_array[0] == "n"){		 	 
			$this->db->order_by("lab", "asc"); 
			$labs = $this->db->get('labs');			 
			output_user_fields_new($url,$labs);
		}elseif ($direct_array[0] == "r"){
			$user_ID = $direct_array[1];
			$this->db->where('user_ID', $user_ID);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0){
  				$selected_user = $query->row_array();
			}	
			user_fields_remove($selected_user);			
		}
	} 
	function modify_mutant(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$mutant_ID = $direct_array[1];
			$this->db->where('mutant_ID', $mutant_ID);
			$query = $this->db->get('mutant');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			} 
			output_mutant_fields($selected,$url);
		}elseif ($direct_array[0] == "n"){ 
			output_mutant_fields_new($url);
		}elseif ($direct_array[0] == "r"){
			$mutant_ID = $direct_array[1];
			$this->db->where('mutant_ID', $mutant_ID);
			$query = $this->db->get('mutant');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			}	
			mutant_fields_remove($selected);			
		}
	} 
	function modify_strain(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$strain_ID = $direct_array[1];
			$this->db->where('strain_ID', $strain_ID);
			$query = $this->db->get('strain');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			} 
			output_strain_fields($selected,$url);
		}elseif ($direct_array[0] == "n"){ 
			output_strain_fields_new($url);
		}elseif ($direct_array[0] == "r"){
			$strain_ID = $direct_array[1];
			$this->db->where('strain_ID', $strain_ID);
			$query = $this->db->get('strain');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			}	
			strain_fields_remove($selected);			
		}
	} 
	function modify_lab(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$strain_ID = $direct_array[1];
			$this->db->where('lab', $strain_ID);
			$query = $this->db->get('labs');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			} 
			output_lab_fields($selected,$url);
		}elseif ($direct_array[0] == "n"){ 
			output_lab_fields_new($url);
		}elseif ($direct_array[0] == "r"){
			$strain_ID = $direct_array[1];
			$this->db->where('lab', $strain_ID);
			$query = $this->db->get('labs');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			}	
			lab_fields_remove($selected);			
		}
	} 
	function modify_tank(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$tank_ID = $direct_array[1];
			$this->db->where('tank_ID', $tank_ID);
			$query = $this->db->get('tank');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			} 
			output_tank_fields($selected,$url);
		}elseif ($direct_array[0] == "n"){ 
			output_tank_fields_new($url);
		}elseif ($direct_array[0] == "r"){
			$tank_ID = $direct_array[1];
			$this->db->where('tank_ID', $tank_ID);
			$query = $this->db->get('tank');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			}	
			tank_fields_remove($selected);			
		}
	} 
	function modify_search(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3)); 
		$search_ID = $direct_array[1];
		$this->db->where('search_ID', $search_ID);
		$query = $this->db->get('saved_searches');
		if ($query->num_rows() > 0){
			$selected = $query->row_array();
		}	
		search_fields_remove($selected);			
		 
	} 
	function modify_transgene(){		 
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$direct_array = explode('_',$this->uri->segment(3));
		if ($direct_array[0] == "u"){			
			$transgene_ID = $direct_array[1];
			$this->db->where('transgene_ID', $transgene_ID);
			$query = $this->db->get('transgene');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			} 
			output_transgene_fields($selected,$url);
		}elseif ($direct_array[0] == "n"){ 
			output_transgene_fields_new($url);
		}elseif ($direct_array[0] == "r"){
			$transgene_ID = $direct_array[1];
			$this->db->where('transgene_ID', $transgene_ID);
			$query = $this->db->get('transgene');
			if ($query->num_rows() > 0){
  				$selected = $query->row_array();
			}	
			transgene_fields_remove($selected);			
		}
	} 
	function add_tanks(){
		require 'function.php';
		$temp = $_POST['tanks'];
		$tanks = array_unique($temp);
			if (is_array($tanks)){
				foreach ($tanks as $value){
					$data = "";
					$data = array(
						'batch_ID' => $_POST['batch_ID'],
						'tank_ID' => $value,
						'description' => ''					 
					);	  
					$this->db->insert('tank_assoc', $data);	
					//echo $this->db->_error_message();	  
				}
			}	
			redirect('fish/modify_line/u_' . $_POST['batch_ID'], 'refresh');
	}
	function remove_tanks(){
		require 'function.php';
		$temp = $_POST['tanks'];
		$tanks = array_unique($temp);
			if (is_array($tanks)){
				foreach ($tanks as $value){	 
					$this->db->where('tank_ID', $value);
					$this->db->delete('tank_assoc'); 
				}
			} 
			redirect('fish/modify_line/u_' . $_POST['batch_ID'], 'refresh');
	}
	function moreinfo(){
		$line_ID =  $this->uri->segment(3) ;
		$this->db->where('line_ID', $line_ID);
		$query = $this->db->get('line_item');
		if ($query->num_rows() > 0){
			$line_item = $query->row_array();
		}
		$html .=  '<div style="padding-top:50px; padding-left:50px; background-color:#F5EEDE; height:630px;">';
		$html .= '<h3>Description:</h3> ' . $line_item['description'];
		$html .= '<h3>Comment:</h3> ' . $line_item['comment'];
		$html .='</div>';
		echo $html;
	}
	function db_update_user(){
		$type = $this->uri->segment(3);
		if($type == "u"){  
				 $user = array(
					'db_reference_name' => $_POST['db_reference_name'],
					'lab' => $_POST['lab'],
					'office_location' => $_POST['office_location'],
					'lab_location' => $_POST['lab_location'],
					'lab_phone' => $_POST['lab_phone'],
					'emergency_phone' => $_POST['emergency_phone'],
					'email' => $_POST['email'],
					'first_name' => $_POST['first_name'],
					'middle_name' => $_POST['middle_name'],
					'last_name' => $_POST['last_name'],
					'username' => $_POST['username'],
					'admin_access' => $_POST['admin_access'] 
				);
				if ($_POST['passcheck']){ 
					$this->load->library('SimpleLoginSecure');
					//get the password hash from the simpleloginsecure library
					$user['user_pass'] = $this->simpleloginsecure->get_pass_hash(); 
				}
				$this->db->update('users', $user, "user_ID = " . $_POST['user_ID']);				 
			}elseif ($type == "i"){ 
				$this->load->library('SimpleLoginSecure');
				$this->simpleloginsecure->create($_POST['username'], $_POST['user_pass']);
				$this->CI =& get_instance();
				$user_ID = $this->session->userdata('last_user_ID'); 
			}elseif ($type == "r"){ 
				$this->db->where('user_ID', $_POST['user_ID']);
				$this->db->delete('users');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_mutant(){
		$type = $this->uri->segment(3);
		if($type == "u"){ 
				 $mutant = array(
					'mutant' => $_POST['mutant'],
					'allele' => $_POST['allele'],
					'gene' => $_POST['gene'],
					'reference' => $_POST['reference'],
					'strain' => $_POST['strain'],
					'cross_ref' => $_POST['cross_ref'] 
				);
				$this->db->update('mutant', $mutant, "mutant_ID = " . $_POST['mutant_ID']);				 
			}elseif ($type == "i"){ 
				 $mutant = array(
					'mutant' => $_POST['mutant'],
					'allele' => $_POST['allele'],
					'gene' => $_POST['gene'],
					'reference' => $_POST['reference'],
					'strain' => $_POST['strain'],
					'cross_ref' => $_POST['cross_ref'] 
				);
				$this->db->insert('mutant', $mutant);	
			}elseif ($type == "r"){ 
				$this->db->where('mutant_ID', $_POST['mutant_ID']);
				$this->db->delete('mutant');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3/2";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_strain(){
		$type = $this->uri->segment(3);
		if($type == "u"){ 
				 $strain = array(
					'strain' => $_POST['strain'],
					'source' => $_POST['source'],
					'source_contact_info' => $_POST['source_contact_info'],
					'comments' => $_POST['comments'] 
				);
				$this->db->update('strain', $strain, "strain_ID = " . $_POST['strain_ID']);				 
			}elseif ($type == "i"){ 
				$strain = array(
					'strain' => $_POST['strain'],
					'source' => $_POST['source'],
					'source_contact_info' => $_POST['source_contact_info'],
					'comments' => $_POST['comments'] 
				);
				$this->db->insert('strain', $strain);	
			}elseif ($type == "r"){ 
				$this->db->where('strain_ID', $_POST['strain_ID']);
				$this->db->delete('strain');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3/2";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_transgene(){
		$type = $this->uri->segment(3);
		if($type == "u"){ 
				 $transgene = array(
				    'transgene' => $_POST['transgene'],
					'promoter' => $_POST['promoter'],
					'gene' => $_POST['gene'],
					'reference' => $_POST['reference'],
					'strain' => $_POST['strain'],
					'allele' => $_POST['allele'],
					'comment' => $_POST['comment'] 
				);
				$this->db->update('transgene', $transgene, "transgene_ID = " . $_POST['transgene_ID']);				 
			}elseif ($type == "i"){ 
				$transgene = array(
				    'transgene' => $_POST['transgene'],
					'promoter' => $_POST['promoter'],
					'gene' => $_POST['gene'],
					'reference' => $_POST['reference'],
					'strain' => $_POST['strain'],
					'allele' => $_POST['allele'],
					'comment' => $_POST['comment'] 
				);
				$this->db->insert('transgene', $transgene);	
			}elseif ($type == "r"){ 
				$this->db->where('transgene_ID', $_POST['transgene_ID']);
				$this->db->delete('transgene');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3/2";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_lab(){
		$type = $this->uri->segment(3);
		if($type == "u"){ 
				 $lab = array(
					'lab' => $_POST['lab'] 					 
				);
				$this->db->update('labs', $lab, "lab = " . $_POST['lab']);				 
			}elseif ($type == "i"){ 
				$lab = array(
					'lab' => $_POST['lab'] 
				);
				$this->db->insert('labs', $lab);	
			}elseif ($type == "r"){ 
				$this->db->where('lab', $_POST['lab']);
				$this->db->delete('labs');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3/2";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_tank(){
		$type = $this->uri->segment(3);
		if($type == "u"){ 
				 $tank = array(
					'size' => $_POST['size'], 
					'location' => $_POST['location'], 
					'room' => $_POST['room'], 	
					'comments' => $_POST['comments']				 
				);
				$this->db->update('tank', $tank, "tank_ID = " . $_POST['tank_ID']);				 
			}elseif ($type == "i"){ 
				$tank = array(
					'size' => $_POST['size'], 
					'location' => $_POST['location'], 
					'room' => $_POST['room'],	
					'comments' => $_POST['comments']	
				);
				$this->db->insert('tank', $tank);	
			}elseif ($type == "r"){ 
				$this->db->where('tank_ID', $_POST['tank_ID']);
				$this->db->delete('tank');
			}			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/3/1";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update_recipients(){
			$type = $this->uri->segment(3);
			$this->db->empty_table('report_recipients'); 
			foreach ($_POST['users'] as $value){
				$recipients = array(
					'user_ID' => $value,
					'report_ID' => $_POST['report']  
				);
				$this->db->insert('report_recipients', $recipients);	
			} 		 			 
			echo '<script language="javascript">
			location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/4"; 
			</script>';
	}
	function db_update_search(){ 
			$this->db->where('search_ID', $_POST['search_ID']);
			$this->db->delete('saved_searches');		 			 
			echo '<script language="javascript">
			parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/2";
			self.parent.Shadowbox.close();
			</script>';
	}
	function db_update(){		 
			$this->load->library('SimpleLoginSecure');  
		 	$type = $this->uri->segment(3); 
			if($type == "u"){
				$this->db->where('strain_ID', $_POST['strain_ID']);			
				$query = $this->db->get('strain');			
				if ($query->num_rows() > 0){
					$strain = $query->row_array();
				}
				$this->db->where('mutant_ID', $_POST['mutant_ID']);			
				$query = $this->db->get('mutant');			
				if ($query->num_rows() > 0){
					$mutant = $query->row_array();
				}
				if ($_POST['birthday'] != ""){	
					$birthday_array = explode('/',$_POST['birthday']);
					$birthday = mktime(0,0,0,$birthday_array[0],$birthday_array[1],$birthday_array[2]);
				}
				if ($_POST['death_date'] != ""){
					$death_date_array = explode('/',$_POST['death_date']);
					$death_date = mktime(0,0,0,$death_date_array[0],$death_date_array[1],$death_date_array[2]); 
				}
				$fish = array(
					'gender' => $_POST['gender'],
					'name' => $_POST['name'],
					'status' => $_POST['status'],
					'birthday' => $birthday,
					'death_date' => $death_date,
					'mother_ID' => $_POST['mother_ID'],
					'father_ID' => $_POST['father_ID'],
					'user_ID' => $_POST['user_ID'],
					'comments' => $_POST['comments'],
					'strain_ID' => $_POST['strain_ID'],
					'mutant_ID' => $_POST['mutant_ID'],
					'generation' => $_POST['generation'],
					'mutant_genotype_wildtype' => $_POST['mutant_genotype_wildtype'],
					'mutant_genotype_heterzygous' => $_POST['mutant_genotype_heterzygous'],
					'mutant_genotype_homozygous' => $_POST['mutant_genotype_homozygous'],
					'starting_nursery' => $_POST['starting_nursery'],
					'current_adults' => $_POST['current_adults'],
					'transgene_ID' => $_POST['transgene_ID'],
					'starting_adults' => $_POST['starting_adults'],
					'current_nursery' => $_POST['current_nursery'],					
					'transgene_genotype_wildtype' => $_POST['transgene_genotype_wildtype'],
					'transgene_genotype_heterzygous' => $_POST['transgene_genotype_heterzygous'],
					'transgene_genotype_homozygous' => $_POST['transgene_genotype_homozygous']
				);
				$this->db->update('fish', $fish, "batch_ID = " . $_POST['batch_ID']);
				$log_message = "\n" . "Update Batch " . "\n" . "Batch Number: " . $_POST['batch_ID'] . "\n" .
				'Username: ' . $this->session->userdata('username') . "\n";				 
				log_message('error', $log_message); 
				redirect("fish/modify_line/u_" . $_POST['batch_ID'], "refresh");			 
			}elseif ($type == "i"){
				$this->db->where('strain_ID', $_POST['strain_ID']);			
				$query = $this->db->get('strain');			
				if ($query->num_rows() > 0){
					$strain = $query->row_array();
				}
				$this->db->where('mutant_ID', $_POST['mutant_ID']);			
				$query = $this->db->get('mutant');			
				if ($query->num_rows() > 0){
					$mutant = $query->row_array();
				}
				if ($_POST['birthday'] != ""){	
					$birthday_array = explode('/',$_POST['birthday']);
					$birthday = mktime(0,0,0,$birthday_array[0],$birthday_array[1],$birthday_array[2]); 
				}
				if ($_POST['death_date'] != ""){
					$death_date_array = explode('/',$_POST['death_date']);
					$death_date = mktime(0,0,0,$death_date_array[0],$death_date_array[1],$death_date_array[2]);
				}
				$fish = array(
					'gender' => $_POST['gender'],
					'name' => $_POST['name'],
					'status' => $_POST['status'],
					'birthday' => $birthday,
					'death_date' => $death_date,
					'mother_ID' => $_POST['mother_ID'],
					'father_ID' => $_POST['father_ID'],
					'user_ID' => $_POST['user_ID'],
					'comments' => $_POST['comments'],
					'strain_ID' => $_POST['strain_ID'],
					'mutant_ID' => $_POST['mutant_ID'],
					'generation' => $_POST['generation'],
					'mutant_genotype_wildtype' => $_POST['mutant_genotype_wildtype'],
					'mutant_genotype_heterzygous' => $_POST['mutant_genotype_heterzygous'],
					'mutant_genotype_homozygous' => $_POST['mutant_genotype_homozygous'],
					'starting_nursery' => $_POST['starting_nursery'],
					'current_nursery' => $_POST['current_nursery'],
					'current_adults' => $_POST['current_adults'],
					'transgene_ID' => $_POST['transgene_ID'],
					'starting_adults' => $_POST['starting_adults'],
					'transgene_genotype_wildtype' => $_POST['transgene_genotype_wildtype'],
					'transgene_genotype_heterzygous' => $_POST['transgene_genotype_heterzygous'],
					'transgene_genotype_homozygous' => $_POST['transgene_genotype_homozygous']
				);
				$this->db->insert('fish', $fish);
				echo '<script language="javascript">
				alert("Batch Number ' . mysql_insert_id() . ' has been added!");
				</script>';	
				echo '<script language="javascript">
						if (self.parent.document.getElementById("tabs") == null){
							parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/show_all";
						}else{
							parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/1";;
						} 
						self.parent.Shadowbox.close();
						</script>'; 
			}elseif ($type == "r"){
				$this->db->where('batch_ID', $_POST['batch_ID']);
				$this->db->delete('fish');
				$this->db->where('batch_ID', $_POST['batch_ID']);
				$this->db->delete('tank_assoc');
				$log_message = "\n" . "Delete Batch " . "\n" . "Batch Number: " . $_POST['batch_ID'] . "\n" .
				'Username: ' . $this->session->userdata('username') . "\n";				 
				log_message('error', $log_message); 
				echo '<script language="javascript">
						if (self.parent.document.getElementById("tabs") == null){
							parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/show_all";
						}else{
							parent.location.href = "' . $this->config->item('base_url') . 'index.php/fish/index/blank/1";;
						} 
						self.parent.Shadowbox.close();
						</script>'; 
			} 
	}
	function show_all(){
		require 'function.php';
		$url = $this->config->item('base_url');
		libraries($url); 
		$this->db->select('mutant.*,mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele,fish.*,users.*,strain.strain as strain_name');
		$this->db->from('fish');
		$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
		$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
		$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
		$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
		$this->db->where('status like', 'Alive'); 
		$all_fish = $this->db->get(); 
		$this->CI =& get_instance();
		$admin_access = $this->CI->session->userdata('admin_access');
		
		show_all_fish($url,$all_fish,$admin_access);
	}
	function index(){
		$this->load->library('SimpleLoginSecure'); 
		
		$this->simpleloginsecure->login($_SESSION['username'], '');  
		$this->CI =& get_instance();
		$data['admin_access'] = $this->CI->session->userdata('admin_access');
		 
	 	require 'function.php';	 
		$data['url_var_3'] = $this->uri->segment(3);
		$data['url_var_4'] = $this->uri->segment(4);
		$data['url_var_5'] = $this->uri->segment(5);
		if ($data['url_var_3'] == "showt"){
			$_SESSION['show_tanks'] = true;	
		}elseif ($data['url_var_3'] == "hidet"){
			$_SESSION['show_tanks'] = "";	
		}
		if ($data['url_var_3'] == "nsearch"){
			$birthday_array = explode('/',$_POST['birthday']);
			$birthday = mktime(0,0,0,$birthday_array[0],$birthday_array[1],$birthday_array[2]);
			 
			$saved_search = array(
					'search_name' => $_POST['search_name'], 
					'batch_ID' => $_POST['batch_ID'], 
					'mylab' => $_POST['mylab'], 
					'gender' => $_POST['gender'], 
					'status' => $_POST['status'],
					'birthday' => $birthday,
					'mother_ID' => $_POST['mother_ID'],
					'father_ID' => $_POST['father_ID'],
					'user_ID' => $_POST['user_ID'],
					'comments' => $_POST['comments'],
					'strain_ID' => $_POST['strain_ID'],
					'mutant_ID' => $_POST['mutant_ID'],
					'generation' => $_POST['generation'],
					'mutant_genotype_wildtype' => $_POST['mutant_genotype_wildtype'],
					'mutant_genotype_heterzygous' => $_POST['mutant_genotype_heterzygous'],
					'mutant_genotype_homozygous' => $_POST['mutant_genotype_homozygous'], 
					'transgene_ID' => $_POST['transgene_ID'], 
					'transgene_genotype_wildtype' => $_POST['transgene_genotype_wildtype'],
					'transgene_genotype_heterzygous' => $_POST['transgene_genotype_heterzygous'],
					'transgene_genotype_homozygous' => $_POST['transgene_genotype_homozygous'],
					'lab' => $_POST['lab'],
					'tank_ID' => $_POST['tank_ID'],
					'mutant_allele' => $_POST['mutant_allele'],
					'transgene_allele' => $_POST['transgene_allele']
			);
			$this->db->insert('saved_searches', $saved_search); 
			redirect('/fish/index/blank/2','refresh');
		}
		
		$this->db->select('mutant.*,mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele,fish.*,users.* db_reference_name');
		$this->db->from('fish');
		$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
		$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
		$this->db->join('users', 'fish.user_ID = users.user_ID','left outer'); 
		$data['all_fish'] = $this->db->get(); 
		
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->get('users');	
		if ($query->num_rows() > 0){
			$data['loggedin_user'] = $query->row_array();
		}	
		$this->db->select('mutant.*,mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele, fish.*,users.*,strain.strain as strain_name,db_reference_name');
		$this->db->from('fish');
		$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
		$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
		$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
		$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
		$this->db->where('lab like', $data['loggedin_user']['lab']);
		$this->db->where('status like', 'Alive');
		$data['all_lab_fish'] = $this->db->get(); 
		 
		$this->db->select('lab');
		$data['all_labs'] = $this->db->get('labs');		
		$this->db->order_by("last_name", "asc"); 
		$data['all_users'] = $this->db->get('users'); 
		$this->db->order_by("strain", "asc"); 
		$data['all_strains'] = $this->db->get('strain');			
		$this->db->order_by("promoter", "asc"); 
		$data['all_transgenes'] = $this->db->get('transgene');
		$this->db->distinct('allele');
		$this->db->order_by("allele", "asc"); 
		$data['all_transgene_allele'] = $this->db->get('transgene');
		
		$this->db->order_by("mutant", "asc"); 
		$data['all_mutants'] = $this->db->get('mutant');
		$this->db->distinct('allele');
		$this->db->order_by("allele", "asc"); 
		$data['all_mutant_allele'] = $this->db->get('mutant');  
		$data['all_tanks'] = $this->db->get('tank');
		$data['all_searches'] = $this->db->get('saved_searches'); 
		$data['all_report_recipients'] = $this->db->get('report_recipients');
		foreach ($data['all_labs']->result() as $row){			
			$this->db->select('sum(current_adults) as fish_count,lab');
			$this->db->from('fish');
			$this->db->join('users', 'fish.user_ID = users.user_ID');
			$this->db->where('lab =', $row->lab);
			$this->db->where('status =', 'Alive');
			$this->db->or_where('status =', 'Sick');
			$this->db->group_by('lab');
			$data['current_count'][$row->lab] = $this->db->get();
		} 
		foreach ($data['all_labs']->result() as $row){			
			$this->db->select('sum(current_nursery) as fish_count,lab');
			$this->db->from('fish');
			$this->db->join('users', 'fish.user_ID = users.user_ID');
			$this->db->where('lab like ', $row->lab);
			$this->db->where('status like ', 'Alive');
			$this->db->or_where('status like ', 'Sick');
			$this->db->group_by('lab');
			$data['nurseryq_count'][$row->lab] = $this->db->get();
		}  
		$data['datefilter'] = $this->db->query("SELECT DISTINCT CONCAT(FROM_UNIXTIME(date_taken, '%M'),' ',FROM_UNIXTIME(date_taken, '%Y'))  as groupby,
		 date_taken FROM stat_survival_track group by groupby ORDER BY date_taken desc");
 
		$this->db->select('lab,STAT.batch_ID,STAT.current_adults,STAT.starting_adults,STAT.starting_nursery,STAT.status,STAT.survival_precent, STAT.birthday, STAT.date_taken');
		$currmonth = mktime(0,1,1,date('m',time()),1,date('Y',time()));
		if ($data['datefilter']->num_rows() > 0){
			$current_month = $data['datefilter']->row_array();
		} 
		$this->db->from('stat_survival_track STAT');
		$this->db->join('fish FS', 'FS.batch_ID = STAT.batch_ID');
		$this->db->join('users', 'FS.user_ID = users.user_ID');
		$this->db->where('date_taken >=', $currmonth);
		$data['track_percentage'] = $this->db->get();
		 
		$this->db->select('batch_ID, username, status, lab,current_adults, starting_adults,starting_nursery,starting_nursery, birthday');
		$this->db->from('fish');
		$this->db->join('users', 'fish.user_ID = users.user_ID');
		$this->db->where('status not like', 'Dead'); 
		$this->db->where(array('starting_adults !=' => ''));  
		$this->db->where(array('current_adults !=' => ''));
		$data['current_survival'] = $this->db->get(); 
		
		$this->load->view('fish_view',$data); 		
	}
	function filter_track_survival(){
		require 'function.php';	
		$url = $this->config->item('base_url');
		libraries($url);		
		
		//$this->db->select('batch_ID,current_adults,starting_adults,starting_nursery,status,survival_precent, birthday, date_taken,  (' . time() . ' - birthday) / (60 * 60 * 24)  as days_old');
		$this->db->select('date_taken,  (' . time() . ' - FS.birthday) / (60 * 60 * 24)  as days_old, FS.*,users.*');
	 	$this->db->from('stat_survival_track STAT');
		$this->db->join('fish FS', 'FS.batch_ID = STAT.batch_ID');
		$this->db->join('users', 'FS.user_ID = users.user_ID');
		$this->db->where('date_taken =', $this->uri->segment(3));
		$this->db->order_by("date_taken", "desc");
		$data['track_percentage'] = $this->db->get(); 
		$data['date_taken'] = $this->uri->segment(3);
		
		$this->load->library('SimpleLoginSecure');   
		$this->CI =& get_instance();
		$data['admin_access'] = $this->CI->session->userdata('admin_access');
		
		track_percentage_filtered($data,$url);	
	} 
	function batch_summary(){	  
	 	require 'function.php';
		$_SESSION['report_data'] = ""; 
		$url = $this->config->item('base_url');
		libraries($url);
		$report_array = explode('_',$this->uri->segment(3));
		$select = "fish.*,strain.strain, mutant.mutant, mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele, db_reference_name,users.username";
	 	if ($report_array[1] == "m"){
			$this->db->where('username', $this->session->userdata('username'));
			$query = $this->db->get('users');	
			if ($query->num_rows() > 0){
  				$logged_in = $query->row_array();
			}	
			$this->db->select($select);
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->where('fish.user_ID',$logged_in['user_ID']);
			$data['fish_report'] = $this->db->get(); 
			$report_array[0] = $logged_in['first_name'] . ' ' . $logged_in['last_name'];
		}elseif ($report_array[1] == "ml"){
			$this->db->where('username', $this->session->userdata('username'));			
			$query = $this->db->get('users');			 
			if ($query->num_rows() > 0){
				$current_lab = $query->row_array();
			}		 
			$this->db->where('lab',$current_lab['lab']);
			$query = $this->db->get('users');			
			 
			$this->db->select($select);
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->where('lab',$current_lab['lab']);
			$data['fish_report']  = $this->db->get();					 
		 
			$report_array[0] = $current_lab['lab'];
		}elseif ($report_array[1] == "u"){ 
			$this->db->where('user_ID', $report_array[0]);
			$query = $this->db->get('users');	
			if ($query->num_rows() > 0){
  				$user_array = $query->row_array();
			}
			$this->db->select($select);
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->where('users.user_ID',$report_array[0]);			 
			$data['fish_report'] = $this->db->get();	
			$report_array[0] = $user_array['first_name'] . ' ' . $user_array['last_name'];
		}elseif ($report_array[1] == "l"){	
			$this->db->select($select);
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->where('lab',$report_array[0]);
			$data['fish_report']  = $this->db->get();		 
		} 
		if ($data['fish_report']->num_rows() > 0){
			$url = $this->config->item('base_url');			
			output_batch_summary($data,$url,$report_array);	
		}else{
			echo 'No Results!';	
		}
	}
	function quantity_summary(){	  
	 	require 'function.php';
		$_SESSION['report_data'] = "";
		$url = $this->config->item('base_url');
		libraries($url);
		$report_array = explode('_',$this->uri->segment(3));
		$user_select = "db_reference_name,count(batch_ID) as total_batches, sum(starting_adults) as starting_adults,sum(current_adults) as current_adults,sum(starting_nursery) as starting_nursery, sum(starting_nursery) as starting_nursery";
	 	$mutant_select = "fish.mutant_ID,mutant, count(batch_ID) as total_batches, sum(starting_adults) as starting_adults,sum(current_adults) as current_adults,sum(starting_nursery) as starting_nursery, sum(starting_nursery) as starting_nursery";
		$strain_select = "fish.strain_ID,strain, count(batch_ID) as total_batches, sum(starting_adults) as starting_adults,sum(current_adults) as current_adults,sum(starting_nursery) as starting_nursery, sum(starting_nursery) as starting_nursery";
		$transgene_select = "fish.transgene_ID,promoter, count(batch_ID) as total_batches, sum(starting_adults) as starting_adults,sum(current_adults) as current_adults,sum(starting_nursery) as starting_nursery, sum(starting_nursery) as starting_nursery";
	 	if ($report_array[1] == "m"){
			$this->db->where('username', $this->session->userdata('username'));
			$query = $this->db->get('users');	
			if ($query->num_rows() > 0){
  				$logged_in = $query->row_array();
			}	
			//user report
			$this->db->select($user_select);
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID',''); 
			$this->db->where('fish.user_ID',$logged_in['user_ID']);
			$this->db->group_by('fish.user_ID');
			$data['user_quant'] = $this->db->get();	
			//mutant report
			$this->db->select($mutant_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left');
			$this->db->where('fish.user_ID',$logged_in['user_ID']);			 
			$this->db->where(array('fish.mutant_ID !=' => ''));
			$this->db->group_by('mutant');
			$data['mutant_quant'] = $this->db->get();	
			//strain report
			$this->db->select($strain_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left');
			$this->db->where('fish.user_ID',$logged_in['user_ID']);
			$this->db->where(array('strain !=' => ''));		 
			$this->db->group_by('fish.strain_ID');
			$data['strain_quant'] = $this->db->get();			
			//transgene report
			$this->db->select($transgene_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left');
			$this->db->where('fish.user_ID',$logged_in['user_ID']);
			$this->db->where(array('promoter !=' => ''));	
			$this->db->group_by('fish.transgene_ID');
			$data['transgene_quant'] = $this->db->get();
			$report_array[0] = $logged_in['first_name'] . ' ' . $logged_in['last_name'];
		}elseif ($report_array[1] == "ml"){
			$this->db->where('username', $this->session->userdata('username'));			
			$query = $this->db->get('users');			
			if ($query->num_rows() > 0){
				$current_lab = $query->row_array();
			} 
			//user report
			$this->db->select($user_select);
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID',''); 
			$this->db->where('users.lab',$current_lab['lab']);
			$this->db->group_by('lab');
			$data['user_quant'] = $this->db->get();				
			//mutant report
			$this->db->select($mutant_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left');
			$this->db->where('users.lab',$current_lab['lab']);
			$this->db->where(array('fish.mutant_ID !=' => ''));
			$this->db->group_by('mutant');
			$data['mutant_quant'] = $this->db->get();	
			//strain report
			$this->db->select($strain_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left');
			$this->db->where('users.lab',$current_lab['lab']);
			$this->db->where(array('strain !=' => ''));	
			$this->db->group_by('fish.strain_ID');
			$data['strain_quant'] = $this->db->get();			
			//transgene report
			$this->db->select($transgene_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left');
			$this->db->where('users.lab',$current_lab['lab']);
			$this->db->where(array('promoter !=' => ''));
			$this->db->group_by('fish.transgene_ID');
			$data['transgene_quant'] = $this->db->get();
			$report_array[0] = $current_lab['lab'];
		}elseif ($report_array[1] == "u"){ 
			$this->db->where('user_ID', $report_array[0]);
			$query = $this->db->get('users');	
			if ($query->num_rows() > 0){
  				$user_array = $query->row_array();
			}	
			//user report
			$this->db->select($user_select);
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID',''); 
			$this->db->where('fish.user_ID',$report_array[0]);
			$this->db->group_by('fish.user_ID');
			$data['user_quant'] = $this->db->get();	
			//mutant report
			$this->db->select($mutant_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left');
			$this->db->where('fish.user_ID',$report_array[0]);
			$this->db->where(array('fish.mutant_ID !=' => ''));
			$this->db->group_by('mutant');
			$data['mutant_quant'] = $this->db->get();	
			//strain report
			$this->db->select($strain_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left');
			$this->db->where('fish.user_ID',$report_array[0]);
			$this->db->where(array('strain !=' => ''));	
			$this->db->group_by('fish.strain_ID');
			$data['strain_quant'] = $this->db->get();			
			//transgene report
			$this->db->select($transgene_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left');
			$this->db->where('fish.user_ID',$report_array[0]);
			$this->db->where(array('promoter !=' => ''));
			$this->db->group_by('fish.transgene_ID');
			$data['transgene_quant'] = $this->db->get();			
			$report_array[0] = $user_array['first_name'] . ' ' . $user_array['last_name'];
		}elseif ($report_array[1] == "l"){			 
			//user report
			$this->db->select($user_select);
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID',''); 
			$this->db->where('users.lab',$report_array[0]);
			$this->db->group_by('lab');
			$data['user_quant'] = $this->db->get();				
			//mutant report
			$this->db->select($mutant_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left');
			$this->db->where('users.lab',$report_array[0]);
			$this->db->where(array('fish.mutant_ID !=' => ''));
			$this->db->group_by('mutant');
			$data['mutant_quant'] = $this->db->get();	
			//strain report
			$this->db->select($strain_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left');
			$this->db->where('users.lab',$report_array[0]);
			$this->db->where(array('strain !=' => ''));	
			$this->db->group_by('fish.strain_ID');
			$data['strain_quant'] = $this->db->get();			
			//transgene report
			$this->db->select($transgene_select);
			$this->db->distinct();
			$this->db->from('fish'); 
			$this->db->join('users', 'fish.user_ID = users.user_ID','left'); 
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left');
			$this->db->where('users.lab',$report_array[0]);
			$this->db->where(array('promoter !=' => ''));
			$this->db->group_by('fish.transgene_ID');
			$data['transgene_quant']  = $this->db->get();		 
		}
		$url = $this->config->item('base_url');
		output_quantity_summary($data,$url,$report_array);
		
	}
	function export_range_report(){	   
		require 'function.php';	
		$vars =  explode('_',$this->uri->segment(3));
		$start_date = $vars[0];
		$end_date = $vars[1];
		if ($start_date && $end_date){			 
			$date_array = explode('-',$start_date);
			$start = mktime(0,0,0,$date_array[0],$date_array[1],$date_array[2]);
			$date_array = "";
			$date_array = explode('-',$end_date);
			$end = mktime(0,0,0,$date_array[0],$date_array[1],$date_array[2]);
			$this->db->where('record_date >', $start);
			$this->db->where('record_date <', $end);
			$line_items = $this->db->get('line_item');
			$url = $this->config->item('base_url');
			excel_output($line_items,$url);
		}		
		$this->load->view('csavings_view',$data);		
	}
	function export(){	   
		require 'function.php';	
		$url = $this->config->item('base_url');	
		$output_type = $this->uri->segment(3);
		if($output_type == "all"){
			$this->db->select('fish.*,users.*, strain.strain as strain_name,mutant.mutant, mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele, db_reference_name');
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');	
			$query = $this->db->get();			
			excel_output_lab_all($query,$url);	
		}elseif($output_type == "batch_summary"){			 		 
			excel_batch_output($_SESSION['report_data'],$url);	
		}elseif($output_type == "quantity_summary"){ 
			excel_quantity_output($_SESSION['report_data'],$url);
		}elseif($output_type == "survival_stat"){			 
			excel_survival_stat($_SESSION['percent_report_data'],$url);
		}elseif($output_type == "survival_current"){			  
			excel_current_survival($_SESSION['current_report_data'],$url);
		}elseif($output_type == "search_results"){			 
			excel_search_results($_SESSION['report_data'],$url);
		}elseif($output_type == "lab"){	
			$this->CI =& get_instance();  
			$this->db->where(array('username like ' =>  $this->CI->session->userdata('username')));
			$query = $this->db->get('users');
			if ($query->num_rows() > 0){
  				$userdata = $query->row_array();
			}
			$this->db->select('fish.*,users.*, strain.strain as strain_name,mutant.mutant,mutant.allele as mutant_allele, transgene.*, transgene.allele as transgene_allele,db_reference_name');
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
			$this->db->where(array('lab like ' =>  $userdata['lab']));	
			$this->db->where(array('status like ' =>  'Alive'));	
			$query = $this->db->get();			
			excel_output_lab_all($query,$url);	
		}
	}
	function main(){
		ini_set('display_errors', 'On');
		require 'function.php';
		 
	} 
	/*function print_prev(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);
		$tableID = "line_items";
		sort_tables($tableID,'1'); 
		echo '<table>' . $_SESSION['preview_array'] . '</table>';	
	}*/
	function print_prev_all(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);		 
        all_lines_prev($url);
	}
	function print_prev_lab(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);		 
        all_lab_prev($url);
	}
	function print_prev_batchsum(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);		 
        batch_summary_prev($url);
	}
	function print_prev_search(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);		 
        search_prev($url);
	}
	function print_prev_quantsum(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);		 
        quantity_summary_prev($url,$_SESSION['report_data']);
	}	
	function print_prev_survivalstat(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);  
        survivalstat_prev($url,$_SESSION['percent_report_data']);
	}
	function print_prev_currentstat(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url); 
        survivalcurrent_prev($url,$_SESSION['current_report_data']);
	}
	
	function date_range_report(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);
		echo  '<div style=" height:640px;background-color:#fff;">';
	    $attributes = array('id' => 'range_form_ID','name' => 'range_form');
		echo form_open('csavings/date_range_report', $attributes);
				$html =  '<div style=" padding-left:15px; border-bottom-style:solid; background-color:#F5EEDE; "><h2>Select date range:</h2>				 
				<table><tr><td>';
				$html .= 'Start:<br>';
				$html .= output_cal_func('start_date', $_POST['start_date'],'start_date') ;
				$html .= '</td><td>';
				$html .= 'End:<br>';
				$html .= output_cal_func('end_date', $_POST['end_date'],'end_date') ;
				$html .= '</td><td>
				 <input type="image" onclick="range_form.submit();" src="' . $this->config->item('base_url') . 'assets/Pics/Next-32.png" name="doit" />
				 </td></tr></table><br></div>
				 </form>';
				echo $html;	
				if ($_POST['start_date'] && $_POST['end_date']){			 
					$date_array = explode('/',$_POST['start_date']);
					$start = mktime(0,0,0,$date_array[0],$date_array[1],$date_array[2]);
					$date_array = "";
					$date_array = explode('/',$_POST['end_date']);
					$end = mktime(0,0,0,$date_array[0],$date_array[1],$date_array[2]);
					$this->db->where('record_date >=', $start);
					$this->db->where('record_date <=', $end + 1);
					$line_items = $this->db->get('line_item');
					$url = $this->config->item('base_url');
					range_report($local,$line_items,$url,$_POST['start_date'],$_POST['end_date']);
				}
		echo '</div>';
	} 
	function submit_search_data(){  
		$attributes = array('id' => 'search_ID','name' => 'search_f');
		echo form_open('fish/search_data', $attributes); 
		echo '<input type="submit"><input type="text" name="temp"></form>';
		echo '<script language="javascript">
		var form_var = self.parent.document.search_form;
		form_var.action = "fish/search_data/";  
		var shadowbox_form = document.search_f;
		for(i=0; i<form_var.elements.length; i++){ 
			var name_var = form_var.elements[i].name;
			var val_var = form_var.elements[i].value; 
			if (form_var.elements[i].type == "text"){ 
				  if(val_var){			 		
					var newinput = document.createElement("input");
					shadowbox_form.appendChild(newinput);	
					newinput.name = form_var.elements[i].name;
					newinput.value = form_var.elements[i].value;
				  }
			}else if (form_var.elements[i].type == "checkbox"){
				if (form_var.elements[i].checked == true){
					var newinput = document.createElement("input");
					shadowbox_form.appendChild(newinput);	
					newinput.name = form_var.elements[i].name;
					newinput.value = "1"; 
				 }else if(form_var.elements[i].checked == false){ 
				 }
			}else if(form_var.elements[i].type == "select-one"){ 			
			 	if(form_var.elements[i].selectedIndex){ 
					var newinput = document.createElement("input");
					shadowbox_form.appendChild(newinput);	
					newinput.name = form_var.elements[i].name;
					newinput.value = form_var.elements[i].options[form_var.elements[i].selectedIndex].value; 
				}
			}  			 
		}  
		document.search_f.submit();				 
		</script> ';
	}
	function load_search_data(){ 
		$attributes = array('id' => 'search_ID','name' => 'search_f');
		echo form_open('fish/search_data', $attributes); 
		$search_ID = $this->uri->segment(3);
		$this->db->where(array('search_ID like ' => $search_ID));
		$criteria = $this->db->get('saved_searches');
		$fields = $this->db->list_fields('saved_searches');  
		echo '<input type="submit"><input type="text" name="temp"></form>';
		echo '<script language="javascript">
	 	var shadowbox_form = document.search_f;';
		foreach ($criteria->result() as $row){ 
			foreach ($fields as $field) {
				if ($row->$field && $field != "search_ID" && $field != "search_name"){
					if ($field == "mutant_genotype_wildtype" || $field == "mylab" || $field == "mutant_genotype_heterzygous" || $field == "mutant_genotype_homozygous" || $field == "transgene_genotype_wildtype" || $field == "transgene_genotype_heterzygous" || $field == "transgene_genotype_homozygous"){
						echo 'var newinput = document.createElement("input");
								shadowbox_form.appendChild(newinput);	
								newinput.name = "' . $field . '";
								newinput.value = "1";   ';
					}else{
						echo 'var newinput = document.createElement("input");
								shadowbox_form.appendChild(newinput);	
								newinput.name = "' . $field . '";
								newinput.value = "' . $row->$field . '";   ';
					} 
				}
			} 
		}  
		echo 'shadowbox_form.submit();	'; 
		echo '</script> ';
	}
	function search_data(){
		require 'function.php'; 
		$url = $this->config->item('base_url');
		libraries($url);
		$nocriteria = 1;
		$this->load->library('SimpleLoginSecure');
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->get('users');	
		if ($query->num_rows() > 0){
			$logged_in = $query->row_array();
		} 	 
		foreach ($_POST as $key => $value){
			if ($key == "strain_ID" || $key == "mutant_ID" || $key == "transgene_ID" || $key == "user_ID" || $key == "comments"){
				$key = "fish." . $key; 
			}elseif ($key == "tank_ID"){ 
				$key = "tank." . $key; 
			}elseif ($key == "birthday"){
				$birthday_array = explode("/",$value);
				$value = mktime(0,0,0,$birthday_array[0],$birthday_array[1],$birthday_array[2]); 
			}elseif ($key == "death_date"){
				$death_date = explode("/",$value);
				$value = mktime(0,0,0,$death_date[0],$death_date[1],$death_date[2]); 
			} 
			$select .= $key . ','; 
			if ($value){
				if ($key == "fish.comments"){
					$this->db->where($key . ' like ', $value);
					$nocriteria = 0;
				}elseif ($key == "mylab"){ 
					$this->db->where('lab like ', $logged_in['lab']);
				}elseif ($key == "mutant_allele" || $key == "transgene_allele"){ 
					$this->db->where(str_replace('_','.',$key) . ' =', $value);
					$nocriteria = 0;
				}else{
					$this->db->where($key . ' =', $value);
					$nocriteria = 0;
				}
			}
		}  
		if ($nocriteria == 0){ 		
			$select = substr($select,0,strlen($select) - 1); 
			$where = substr($select,0,strlen($select) - 4);
			$this->db->select('transgene.allele as transgene_allele,mutant.allele as mutant_allele,mutant.mutant,fish.*,strain.strain,transgene.promoter,users.*,db_reference_name',false); 
			$this->db->from('fish');
			$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
			$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
			$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
			$this->db->join('users', 'fish.user_ID = users.user_ID','left outer'); 
			if ($_POST['tank_ID']){
				$this->db->join('tank_assoc', 'tank_assoc.batch_ID = fish.batch_ID','left outer');
				$this->db->join('tank', 'tank.tank_ID = tank_assoc.tank_ID','left outer');
			}
			$query = $this->db->get();
			output_search_results($query,$url);
		}else{
			echo 'No criteria was selected.  Please go back and select a field to search by.';
		}
	} 
	function print_prev_label(){
		require 'function.php';
		 
		$url = $this->config->item('base_url');
		$text1 = "";
		$text2 = "";
		$batch_ID = $this->uri->segment(3); 
		$this->db->select('mutant.*,fish.*,users.*,strain.*,db_reference_name');
		$this->db->from('fish');
		$this->db->join('mutant', 'fish.mutant_ID = mutant.mutant_ID','left outer');
		$this->db->join('transgene', 'fish.transgene_ID = transgene.transgene_ID','left outer');
		$this->db->join('users', 'fish.user_ID = users.user_ID','left outer');
		$this->db->join('strain', 'fish.strain_ID = strain.strain_ID','left outer');
		$this->db->where('batch_ID', $batch_ID);
		$query = $this->db->get(); 				
		if ($query->num_rows() > 0){
			$temp_object = $query->row_array(); 
		}
		$this->db->where('transgene_ID',$temp_object['transgene_ID']);
		$query = $this->db->get("transgene"); 
		if ($query->num_rows() > 0){
			$transgene = $query->row_array();
		}
		$this->db->where('mutant_ID',$temp_object['mutant_ID']);
		$query = $this->db->get("mutant"); 
		if ($query->num_rows() > 0){
			$mutant = $query->row_array();
		}
		$this->db->where('user_ID',$temp_object['user_ID']);
		$query = $this->db->get("users");
		if ($query->num_rows() > 0){
			$name_array = $query->row_array();
		} 
		$date = "";
		if ($temp_object['birthday']){	
			$date = date('m/d/Y', $temp_object['birthday']);
		}
		$text = "Birthday: " . $date;  
		$text1 = "<strong>PI</strong>: " . $name_array['lab'];
		$text1 .= "   <strong>User</strong>: "	 . $name_array['username'] . "<br>";	
		$text .= "<br>Name: " . $temp_object['name'];
		$text .= "<br>Strain: " . $temp_object['strain'];	
		if ($mutant){			 
			$text .= "<br>Mutant: " . $mutant . " : ";
			if ($temp_object['mutant_genotype_wildtype']){
				$text .= '_+/+';		 
			}
			if ($temp_object['mutant_genotype_heterzygous']){
				$text .= '_+/-';
			}		
			if ($temp_object['mutant_genotype_homozygous']){
				$text .= '_-/-'; 
			}	
		}
		if ($transgene['promoter']){
			$text .= "<br>Trangene: " . $transgene['promoter'] . " : ";
			if ($temp_object['transgene_genotype_wildtype']){
				$text .= '_+/+';		 
			}
			if ($temp_object['transgene_genotype_heterzygous']){
				$text .= '_+/-';
			}		
			if ($temp_object['transgene_genotype_homozygous']){
				$text .= '_-/-'; 
			}	
		} 
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');   
		$barcodeOptions = array('text' => $batch_ID, 'barHeight' => '10','barThickWidth' => '6', 'barThinWidth' => '3','font' => '2','fontSize' => '18'); 
		$bc = Zend_Barcode::factory(
			'code39',
			'image',
			$barcodeOptions,
			array()
		);
	 	$res = $bc->draw();
		$curpath = getcwd(); 
	 	imagepng($res, $curpath . '/tmp/' . $batch_ID . ".png"); 
		  echo '<style type="text/css">
			@media print {
			input#btnPrint {
			display: none;
			}
			}
		</style> ';
		echo  "<div style=\"height:400px; background:#ffffff; \"><div style=\" font-size:10px; background:#ffffff; \">
		<div style=\"margin-left:-20px\; font-family:Verdana, Geneva, sans-serif\">
		<img align=\"left\"  src=\"" . $url . "assets/tmp/" . $batch_ID . ".png\"alt=\"barcode\" />
		</div><br>
		<br>
		<div>
		 " . $text1 . "\n";	 
		echo   $text . '</div>
		</div>
		<input type="button" id="btnPrint" value="Print Label" onClick="self.print();"></div>'; 	 
	} 
}


?>