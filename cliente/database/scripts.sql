CREATE TABLE IF NOT EXISTS Endereco (
    idEndereco INT NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(45) NOT NULL,
    estado VARCHAR(45) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    PRIMARY KEY (idEndereco)
);

CREATE TABLE IF NOT EXISTS Cliente (
    idCliente INT NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    dataNascimento DATE NOT NULL,
    idEndereco INT NOT NULL,
    PRIMARY KEY (idCliente),
    FOREIGN KEY (idEndereco) references Endereco(idEndereco)
);

