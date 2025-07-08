<?php
// conexao pela internet
    $servidor = "localhost";
    $usuario = "mascarenhas_alunos";
    $senha = "nsuB2z6vQmPsfeHBdV7U";
    $dbname = "mascarenhas_alunos";    


//$host = "localhost";
//$usuario = "mascarenhas_alunos";
//$senha = "nsuB2z6vQmPsfeHBdV7U";
//$database = "mascarenhas_alunos";



// conexao local
    //$servidor = "localhost";
    //$usuario = "root";
    //$senha = "";
	//$dbname = "tekkenlist";  
//Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);


if (!$conn) 
	{
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}
	echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
// 	echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

// mysqli_close($link);
    
//    if(!$conn)	{die("Falha na conexao: " . mysqli_connect_error());
//				}
//				else{//echo "Conexao realizada com sucesso";
//    }      
?> 