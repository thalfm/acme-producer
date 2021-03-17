CREATE TABLE IF NOT EXISTS Endereco (
    idEndereco INT NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(45) NOT NULL,
    estado VARCHAR(45) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    PRIMARY KEY (idEndereco)
);

CREATE TABLE IF NOT EXISTS Fatura (
   idFatura INT NOT NULL,
   cpf VARCHAR(11) NOT NULL,
   dataVencimento DATE NOT NULL,
   dataLeitura DATE NOT NULL,
   valorLeitura DECIMAL(12,2) NOT NULL,
   valorConta DECIMAL(12,2) NOT NULL,
   idEndereco INT NOT NULL,
   PRIMARY KEY (idFatura),
   FOREIGN KEY (idEndereco) references Endereco(idEndereco)
);