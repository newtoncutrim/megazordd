<?php
     $user = "eventoho_hoje";
    $password = "hoje897";
    try{
      $conn = new PDO('mysql:host=localhost;dbname=eventoho_certificados', $user, $password);  
    }catch (PDOException $e){
        echo $e;
    }
    if(isset($_GET['codigo'])){
        $codigo = addslashes($_GET['codigo']);
        $consulta = $conn->prepare("SELECT * FROM participantes where codigo = :codigo");
        $consulta->bindParam(':codigo', $codigo);
        $consulta->execute();
        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
        if(count($linha)>0){
            echo "MAIOR";
            var_dump($linha);
        }else{
            echo "MENOR";
        }
    }
    
?>