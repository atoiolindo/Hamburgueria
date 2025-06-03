   <?php

   require_once: "../conexao.php";


   if (isset($_FILES['image'])) {
       $file = $_FILES['image'];
       $fileTmpName = $file['tmp_name'];
       $fileError = $file['error'];
       
       if ($fileError === 0) {
           
           $imageData = file_get_contents($fileTmpName);
           $imageData = $conn->real_escape_string($imageData); 
           
           $sql = "INSERT INTO imagens_blob (imagem) VALUES ('$imageData')";
           if ($conn->query($sql) === TRUE) {
               echo "Imagem armazenada com sucesso.";
           } else {
               echo "Erro ao armazenar no banco de dados: " . $conn->error;
           }
       } else {
           echo "Erro no upload do arquivo.";
       }
   }
   $conn->close();
   ?>
