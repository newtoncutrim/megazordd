<?php
setlocale(LC_CTYPE,NULL);
header('Content-Type: text/html; charset=UTF-8');
		$user = "cmsdb";
		$password = 'e$pK$69v';
		try{
			$conn = new PDO('mysql:host=api.o2.ag;dbname=ingressos_2019', $user, $password);
    }catch (PDOException $e){
        echo $e;
    }
    if(isset($_GET['codigo'])){
        $codigo = addslashes($_GET['codigo']);
        $sql = "SELECT * FROM `tb_ingresso` AS ing
										INNER JOIN tb_carrinho_item AS item
										ON item.item_id = ing.fk_item_id
										WHERE 
										item.fk_lote_id >= 25 
										AND
										item.fk_lote_id <= 52 
										AND
										ing.ingresso_checkin = 1
										AND
									ingresso_codigo = '".$codigo."'";
        $consulta = $conn->prepare($sql);  
        $consulta->execute();
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);	


        if(count($linha)>0 && $linha['ingresso_nome'] != ''){
        	$nome = $linha['ingresso_nome']; 

        	$lotesParticipante = [49, 48, 34, 29, 27, 28, 52, 44, 39, 37, 38, 36, 40, 46, 50, 47, 31, 35, 30, 41, 43];
        	$lotesMB = [25, 32, 51];
        	$lotesPalestrante = [45,0];

        	$certificado = '';

        	if (in_array($linha['fk_lote_id'], $lotesParticipante)) { 
			    $certificado = 'participante.jpg';
			    $altura = '860';
			    $center = '2350';

			}
			if (in_array($linha['fk_lote_id'], $lotesMB)) { 
			    $certificado = 'mb.jpg';
			    $altura = '780';
			    $center = '2980';


			}
			if (in_array($linha['fk_lote_id'], $lotesPalestrante)) { 
			    $certificado = 'palestrante.jpg';
			    $altura = '990';
			    $center = '2300';

			}	
            header("Content-type: image/jpeg");
            $qtnI=0;
            $im = imagecreatefromjpeg($certificado);
            $grey = imagecolorallocate($im, 255, 255, 255);
            
            $text = utf8_encode(strtoupper($nome));
            $spl = str_split($text);
            for($i = 0;$i<count($spl);$i++){
                if($spl[$i]=="I"){
                    $qtnI = $qtnI + 30;
                }
            }
            $tamImg = $center/2;
            $tamString = ((strlen($text)*30)-$qtnI)/2;
            $center = $tamImg - $tamString;
            imagettftext($im, 55, 0, $center, $altura, $grey, "font/font/montserratbold.ttf",$text);
            imagejpeg($im);
            imagedestroy($im);
            
        }else{
            header('Location: https://eventohoje.com.br/certificado/2019/index.php?s=s');
			exit;
        }
    }
    
?>