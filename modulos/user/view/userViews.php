<?php
	class userViews{
		var $path = '';
		
		public function __construct(){
			$this->path = HTML . 'user/';
		}
		
		function show($view = ''){
			$html = $this->path . $view . '.html';
			if ( is_file($html) ) {
				if($view == 'index'){
					$template = file_get_contents(TEMPLATE);
						$content = array(
							'{TITULO}' => 'Truequeala | Bienvenido',
							'{CONTENIDO}' => file_get_contents($html)
						);
						echo str_replace(array_keys($content), array_values($content), $template);
				}else{
					echo file_get_contents($html);
				}
			}else{
				header('Location: ' .WEB_RAIZ.'404');
			}
		}
		
	}
?>