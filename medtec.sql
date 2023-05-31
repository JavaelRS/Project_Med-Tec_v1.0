-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2023 às 21:07
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medtec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `codes`
--

CREATE TABLE `codes` (
  `ID` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `codes`
--

INSERT INTO `codes` (`ID`, `code`, `cpf`) VALUES
(5, 'BiD#uQ*D39', '111.222.333-80'),
(6, 'Xca*$SiBat', '111.222.333-80'),
(7, 'X7AjxwG5ms', '222.444.666-80'),
(8, 'TEa9fpi4m*', '111.222.333-80'),
(9, 'KVvmnBDuQS', '111.222.333-80'),
(10, '3r58OWs9HY', '111.222.333-80'),
(11, 'SA&fjTUYds', '234.534.853-80'),
(12, 'oNh$EvY6*u', '234.574.243-80'),
(13, '5ZE5bHGQiH', '324.637.825-80');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hg_consultas`
--

CREATE TABLE `hg_consultas` (
  `ID` int(11) NOT NULL,
  `statusCons` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nome_paciente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome_paciente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_paciente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_paciente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sexo_paciente` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `rg_paciente` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `cpf_paciente` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `texto_consulta` text COLLATE utf8_unicode_ci NOT NULL,
  `data_solicitada` datetime NOT NULL DEFAULT current_timestamp(),
  `data_consulta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `hg_consultas`
--

INSERT INTO `hg_consultas` (`ID`, `statusCons`, `nome_paciente`, `sobrenome_paciente`, `usuario_paciente`, `email_paciente`, `sexo_paciente`, `rg_paciente`, `cpf_paciente`, `data_nascimento`, `texto_consulta`, `data_solicitada`, `data_consulta`) VALUES
(12, 'Agendada', 'Rafael', 'Durand', 'rafael_durand', 'rafael.vidal204@gmail.com', 'M', '11.222.333-8', '111.222.333-80', '2002-04-20', 'ffes esf esf  fes fse sfe sef esfesf  esf esfesef ef es fes fe sfsef esf sefsefs fesfsefse fesfsfe sef s effesfsefse.', '2023-05-31 14:17:34', '2023-06-22 14:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hg_documents`
--

CREATE TABLE `hg_documents` (
  `ID` int(11) NOT NULL,
  `docName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `docType` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fileType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fileSize` int(11) NOT NULL,
  `dir` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patientUsername` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patientName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patientSurname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data_emissao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `hg_documents`
--

INSERT INTO `hg_documents` (`ID`, `docName`, `docType`, `fileType`, `fileSize`, `dir`, `patientUsername`, `patientName`, `patientSurname`, `data_emissao`) VALUES
(11, 'LaudoRafaelDurand22052023.pdf', 'Laudo Médico', 'application/pdf', 54995, 'C:/XAMPP/htdocs/hospital_geral/files/LaudoRafaelDurand22052023.pdf', 'rafael_durand', 'Rafael', 'Durand', '2023-05-30 09:36:20'),
(12, 'LaudoViniciusRabelo24052023.pdf', 'Laudo Médico', 'application/pdf', 54998, 'C:/XAMPP/htdocs/hospital_geral/files/LaudoViniciusRabelo24052023.pdf', 'vitrolo.macacas', 'Vinicius', 'Rabelo', '2023-05-30 09:41:13'),
(13, 'PrescricaoRafaelDurand24052023.pdf', 'Prescrição Médica', 'application/pdf', 54916, 'C:/XAMPP/htdocs/hospital_geral/files/PrescricaoRafaelDurand24052023.pdf', 'rafael_durand', 'Rafael', 'Durand', '2023-05-30 09:41:38'),
(14, 'PrescricaoViniciusRabelo24052023.pdf', 'Prescrição Médica', 'application/pdf', 54921, 'C:/XAMPP/htdocs/hospital_geral/files/PrescricaoViniciusRabelo24052023.pdf', 'vitrolo.macacas', 'Vinicius', 'Rabelo', '2023-05-30 09:42:04'),
(15, 'ConsultaViniciusRabelo24052023.pdf', 'Consulta Médica', 'application/pdf', 55012, 'C:/XAMPP/htdocs/hospital_geral/files/ConsultaViniciusRabelo24052023.pdf', 'vitrolo.macacas', 'Vinicius', 'Rabelo', '2023-05-30 09:42:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hg_patients`
--

CREATE TABLE `hg_patients` (
  `ID` int(11) NOT NULL,
  `usernamePat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwordPat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `date_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `hg_patients`
--

INSERT INTO `hg_patients` (`ID`, `usernamePat`, `passwordPat`, `firstName`, `surname`, `sex`, `email`, `rg`, `cpf`, `birthdate`, `date_joined`) VALUES
(10, 'rafael_durand', 'usuario13', 'Rafael', 'Durand', 'M', 'rafael.vidal204@gmail.com', '11.222.333-9', '222.444.666-80', '2002-04-20', '2023-05-14 11:28:46'),
(11, 'vitrolo.macacas', 'usuario21', 'Vinicius', 'Rabelo', 'M', 'falandoejogando@gmail.com', '22.444.333-9', '111.222.333-80', '2004-07-02', '2023-05-14 11:30:05'),
(22, 'vladimir_barros', 'usuario101', 'Vladimir', 'Barros', 'M', 'vbarros.nino@gmail.com', '22.444.333-9', '645.978.324-70', '2003-04-10', '2023-05-31 13:38:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hg_solicitacoes`
--

CREATE TABLE `hg_solicitacoes` (
  `ID` int(11) NOT NULL,
  `patientUsername` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patientName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patientSurname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `texto_solicitacao` text COLLATE utf8_unicode_ci NOT NULL,
  `data_emissao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `hg_solicitacoes`
--

INSERT INTO `hg_solicitacoes` (`ID`, `patientUsername`, `patientName`, `patientSurname`, `texto_solicitacao`, `data_emissao`) VALUES
(10, 'rafael_durand', 'Rafael', 'Durand', 'gsrdrg drgrd drg drg drg dr  drgrgd gdrg drg drgdrg dr gdr g drgdrgrd rdgdrg drg drgrdg drg drggdaedrhserrhd.', '2023-05-31 14:09:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hospital_geral_staff`
--

CREATE TABLE `hospital_geral_staff` (
  `ID` int(11) NOT NULL,
  `usernameMed` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwordMed` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `hospital_geral_staff`
--

INSERT INTO `hospital_geral_staff` (`ID`, `usernameMed`, `passwordMed`) VALUES
(3, 'pingolo', 'macacas'),
(5, 'bananilson', 'farofa13');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `hg_consultas`
--
ALTER TABLE `hg_consultas`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `hg_documents`
--
ALTER TABLE `hg_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `hg_patients`
--
ALTER TABLE `hg_patients`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `hg_solicitacoes`
--
ALTER TABLE `hg_solicitacoes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `hospital_geral_staff`
--
ALTER TABLE `hospital_geral_staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `codes`
--
ALTER TABLE `codes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `hg_consultas`
--
ALTER TABLE `hg_consultas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `hg_documents`
--
ALTER TABLE `hg_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `hg_patients`
--
ALTER TABLE `hg_patients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `hg_solicitacoes`
--
ALTER TABLE `hg_solicitacoes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `hospital_geral_staff`
--
ALTER TABLE `hospital_geral_staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
