<?php
//PÁGINA FEITA PARA DEBUG, CHECAR SE A CONEXÃO E ENTRE OUTROS DO BANCO ESTÁ CORRETA

// Ativa todos os erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Teste de Conexão com o Banco de Dados</h2>";

$caminho_absoluto = __DIR__ . '\php\dataContext.php';

echo "<p>Verificando arquivo em:<br><code>" . htmlspecialchars($caminho_absoluto) . "</code></p>";

if (file_exists($caminho_absoluto)) {
    echo "<p style='color:green'>✔ Arquivo encontrado!</p>";
    
    // Inclui o arquivo
    require_once $caminho_absoluto;
    
    // Verifica se a função existe
    if (function_exists('conectar')) {
        echo "<p style='color:green'>✔ Função 'conectar()' disponível</p>";
        
        try {
            $pdo = conectar();
            echo "<p style='color:green'>✔ Conexão estabelecida com sucesso!</p>";
            
            // Teste simples
            $result = $pdo->query("SELECT 1+1 AS resultado");
            if ($result) {
                $row = $result->fetch();
                echo "<p>Teste de consulta OK: 1+1 = " . $row['resultado'] . "</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>Erro na conexão: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red'>❌ A função 'conectar()' não foi encontrada no arquivo</p>";
    }
} else {
    echo "<p style='color:red'>❌ Arquivo não encontrado</p>";
    echo "<h3>O que verificar:</h3>";
    echo "<ol>
          <li>O arquivo realmente existe no caminho acima?</li>
          <li>O nome do arquivo está exatamente 'dbContext.php' (sem diferenças de maiúsculas/minúsculas)?</li>
          <li>A pasta 'php' está no mesmo nível do arquivo testedb.php?</li>
          </ol>";
    
    // Debug adicional
    echo "<h3>Informações do sistema:</h3>";
    echo "<pre>DIR: " . __DIR__ . "\n";
    echo "Listando arquivos em " . __DIR__ . "\\php:\n";
    
    if (is_dir(__DIR__ . '\php')) {
        print_r(scandir(__DIR__ . '\php'));
    } else {
        echo "A pasta php não existe!";
    }
    echo "</pre>";
}
?>