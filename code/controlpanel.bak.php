<?php 

class ControlPanel 
{	
	var $default_settings = Array(
		'button_2_name' => '/',
		'button_3_name' => '/',
		'button_4_name' => '/',
		
		'button_2_link' => '',
		'button_3_link' => '',
		'button_4_link' => ''
	);
	
	function ControlPanel() 
	{
		add_action('admin_menu', array(&$this, 'admin_menu'));
		add_action('admin_head', array(&$this, 'admin_head'));
			
		if (!is_array(get_option('thuriot_theme')))
			add_option('thuriot_theme', $this->default_settings);
		
		$this->options = get_option('thuriot_theme');
	}
 
	function admin_menu() 
	{
		add_theme_page('Theme Control Panel', 'Theme CP', 'edit_themes', "thuriot_theme", array(&$this, 'optionsmenu'));
	}
 
	function admin_head() 
	{
		echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/code/controlpanel.css" type="text/css" media="screen" />';
	}
 
	function optionsmenu() 
	{
		$pages = get_pages();
		$wp = get_bloginfo('wpurl');
		
		$output = array();
		foreach ($pages as $post_item) {
			$title = get_the_title($post_item);
			$url = get_permalink($post_item);

			$url = substr( $url, strlen ( $wp ) + 1, -1 );

			array_push($output, $url );
		}	
		
		sort ( $output );
		
		if ($_POST['save_buttons'] == 'save') 
		{
			$this->options["button_2_name"] = $_POST['cp_button_2_name'];
			$this->options["button_2_link"] = $_POST['cp_button_2_link'];
			
			$this->options["button_3_name"] = $_POST['cp_button_3_name'];
			$this->options["button_3_link"] = $_POST['cp_button_3_link'];
			
			$this->options["button_4_name"] = $_POST['cp_button_4_name'];
			$this->options["button_4_link"] = $_POST['cp_button_4_link'];
			
			$buttons = array(
				$this->options["button_2_name"],
				$this->options["button_3_name"],
				$this->options["button_4_name"]			
			);
			
			if ( !$this->createButtons( $buttons ) ) 
			{
				echo '<div class="updated fade" id="wrong_message"><p>Settings <strong>not saved</strong> due to error while creating buttons.</p></div>';
			} else {
				update_option('thuriot_theme', $this->options);
				echo '<div class="updated fade" id="message"><p>Settings <strong>saved</strong>.</p></div>';
			}
		}
		
		
		echo '<script type="text/javascript">';
		echo '	function ButtonBoxChanged(id)';
		echo '	{';
		echo '		Field = document.getElementById("cp_button_"+id+"_name");';
		echo '		Box = document.getElementById("cp_button_"+id+"_link");	';	
		echo '		var string = Box.value.toLowerCase();';
		echo '		string = string.charAt(0).toUpperCase() + string.slice(1);';	
		echo '		Field.value = string;';
		echo '	}';
		echo '</script>';
		
		echo '<div class="wrap">';
			echo '<h2>Customize Theme Buttons</h2>';
			echo '<div id="formWrapper">';
				echo '<form action="" method="post" class="themeform">';
					echo '<input type="hidden" id="save_buttons" name="save_buttons" value="save">';
					
					echo '<table id="cp_Buttons_table">';
					echo '	<tr>';
						echo '		<th>&nbsp</th>';
						echo '		<th>Name</th>';
						echo '		<th>Link</th>';
					echo '	</tr>';
					echo '	<tr>';
						echo '		<td>Button 2</td>';
						echo '		<td><input name="cp_button_2_name" id="cp_button_2_name" type="text" value="'.$this->options["button_2_name"].'" /></td>';
						echo '		<td>'.get_bloginfo('url').'/<select name="cp_button_2_link" id="cp_button_2_link" onchange="ButtonBoxChanged(2)">';
						foreach($output as $page){
							if ( $page == $this->options["button_2_link"] ) 
							{
								echo '<option value="'.$page.'" selected="selected">'.$page.'</option>';
							} else {
								echo '<option value="'.$page.'">'.$page.'</option>';
							}
						}
						echo '</select>';
					echo '	</tr>';
					echo '	<tr>';
						echo '		<td>Button 3</td>';
						echo '		<td><input name="cp_button_3_name" id="cp_button_3_name" type="text" value="'.$this->options["button_3_name"].'" /></td>';
						echo '		<td>'.get_bloginfo('url').'/<select name="cp_button_3_link" id="cp_button_3_link" onchange="ButtonBoxChanged(3)">';
						foreach($output as $page){
							if ( $page == $this->options["button_3_link"] ) 
							{
								echo '<option value="'.$page.'" selected="selected">'.$page.'</option>';
							} else {
								echo '<option value="'.$page.'">'.$page.'</option>';
							}
						}
						echo '</select>';
					echo '	</tr>';
					echo '	<tr>';
						echo '		<td>Button 4</td>';
						echo '		<td><input name="cp_button_4_name" id="cp_button_4_name" type="text" value="'.$this->options["button_4_name"].'" /></td>';
						echo '		<td>'.get_bloginfo('url').'/<select name="cp_button_4_link" id="cp_button_4_link" onchange="ButtonBoxChanged(4)">';
						foreach($output as $page){
							if ( $page == $this->options["button_4_link"] ) 
							{
								echo '<option value="'.$page.'" selected="selected">'.$page.'</option>';
							} else {
								echo '<option value="'.$page.'">'.$page.'</option>';
							}
						}
						echo '</select>';
					echo '	</tr>';
					echo '	<tr>';
						echo '		<td id="submitTD" colspan="3"><p class="submit"><input type="submit" value="Save Changes" name="cp_save"/></p></td>';
					echo '	</tr>';
					echo '</table>';
				echo '</form>';
			echo '</div>';
		echo '</div>';
	}
	
	function createButtons( $buttons )
	{
		$success = true;
		
		foreach ($buttons as $key => $button) {
			$success &= $this->CreateButton( ( $key + 2 ), $button );
		}
		
		return $success;
	}
	
	function CreateButton($filename, $button_text)
	{
		$url = get_bloginfo('template_url');
		$wp = get_bloginfo('wpurl');
		$url = '../' . substr( $url, strlen ( $wp ) );
		
		$font = $url . '/images/Buttons/fonts/04B11.TTF';
		$font_size = 6;
		$angle = 0;
		$image_width = 100;
		$image_height = 25;
		
		switch ($filename) {
			case 2:
			case 3:
			case 4:
				$filename = $url . "/images/Buttons/Button_" . $filename . ".gif";
				break;
			default:
				return false;
		}
		
		try {
			$my_img = imagecreate( $image_width, $image_height );
			
			$backcolor = imagecolorallocate ($my_img, 100, 100,100);
			ImageColorTransparent($my_img, $backcolor);
			
			$text_color = imagecolorallocate( $my_img, 255, 255, 255 );
			
			
			$text_box = imagettfbbox($font_size,$angle,$font,$button_text);
			$text_width = $text_box[2]-$text_box[0]; // lower right corner - lower left corner
			$text_height = $text_box[3]-$text_box[1];

			$x = ($image_width/2) - ($text_width/2);
			$y = ($image_height/2) - ($text_height/2);
				
			imagettftext ($my_img,							//image
							$font_size,						//font size
							$angle,							//angle
							$x,								//x-position
							$y,								//y-position
							$text_color,					//color
							$font,							//font-file
							$button_text); 					//Text
				
			imagegif( $my_img, $filename ); 
			imagedestroy( $my_img );
		} catch (Exception $e) {
			return false;
		}

		return true;
	}
}

?>