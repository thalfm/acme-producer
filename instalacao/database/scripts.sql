CREATE TABLE IF NOT EXISTS Endereco (
    idEndereco INT NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(45) NOT NULL,
    estado VARCHAR(45) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    PRIMARY KEY (idEndereco)
);

CREATE TABLE IF NOT EXISTS Instalacao (
    idInstalacao INT NOT NULL,
    nome VARCHAR(200) NOT NULL,
    idEndereco INT NOT NULL,
    PRIMARY KEY (idInstalacao),
    FOREIGN KEY (idEndereco) references Endereco(idEndereco)
);

