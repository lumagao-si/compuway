
<?php
$imagemLogo = "src/images/compuway.logo.png";
$imagemBanner = "src/images/banner-compuway.png";
$imagemFachada = "src/images/compuway-fachada.png";

$imagensCatalogo = [
    "T.I. em Hardware" => "src/images/curso-hardware.png",
    "Excel 2016" => "src/images/curso-excel.png",
    "Excel Avançado" => "src/images/curso-excel.png",
    "Power BI" => "src/images/curso-power-bi.png",
    "Recursos Humanos" => "src/images/curso-rh.png",
    "Auxiliar de Escritório" => "src/images/curso-auxiliar-escritorio.png",
    "Word 2016" => "src/images/curso-word-2016.png",
    "Designer Gráfico" => "src/images/curso-design-grafico.png",
    "Operador de Microcomputador e CompuKids" => "src/images/curso-pacote-office.png",
    "Excel Financeiro" => "src/images/curso-excel.png",
];

$catalogoCursos = [
    ["Introdução à Informática", "10h", "Conheça os fundamentos da informática, os componentes básicos do computador, a utilização do teclado e mouse, organização de arquivos e conceitos essenciais para começar a usar a tecnologia com confiança.", "Fundamentos da informática; identificação dos componentes; uso do teclado e mouse; arquivos e pastas; cuidados e boas práticas."],
    ["Windows 10", "24h", "Aprenda a utilizar o sistema operacional Windows, organizar seu ambiente de trabalho, administrar arquivos e pastas e personalizar recursos úteis do computador.", "Área de trabalho; menu Iniciar; configurações; arquivos e pastas; atalhos; ferramentas e recursos do sistema."],
    ["Word 2016", "12h", "Desenvolva documentos bem organizados e profissionais, trabalhando com formatação, edição de texto, tabelas, imagens e recursos de apresentação de documentos.", "Interface e edição; formatação; parágrafos; listas; tabelas; imagens; configuração e impressão de documentos."],
    ["Excel 2016", "16h", "Aprenda a criar planilhas, organizar informações, utilizar fórmulas e funções, formatar dados e construir gráficos para apoiar tarefas do dia a dia.", "Planilhas; células e referências; formatação; fórmulas; funções básicas; classificação; filtros; gráficos."],
    ["PowerPoint 2016", "12h", "Crie apresentações claras e envolventes utilizando slides, textos, imagens, elementos visuais, transições e recursos de apresentação.", "Estrutura de slides; temas; textos e imagens; elementos visuais; transições; animações; apresentação de slides."],
    ["Internet", "12h", "Explore recursos da internet, aprenda a navegar, pesquisar informações, utilizar serviços online e adotar práticas básicas de segurança digital.", "Navegadores; pesquisa; sites; downloads; e-mail e serviços online; segurança e privacidade."],
    ["CDA", "35h", "Formação conforme a proposta CDA da Compuway, com atividades e conteúdos orientados ao desenvolvimento das competências previstas no curso.", "A carga horária e o nome CDA foram informados no catálogo da escola. Os tópicos específicos poderão ser detalhados pela Compuway."],
    ["Atendimento ao Cliente", "16h", "Desenvolva habilidades de comunicação, escuta, cordialidade e resolução de situações para oferecer um atendimento eficiente e profissional.", "Comunicação; escuta ativa; postura profissional; necessidades do cliente; resolução de situações; qualidade no atendimento."],
    ["Técnicas de Vendas", "18h", "Conheça etapas e estratégias de venda, abordagem, identificação de necessidades, apresentação de soluções, negociação e relacionamento com clientes.", "Abordagem; sondagem; apresentação; objeções; negociação; fechamento; pós-venda."],
    ["Atendimento de Farmácia", "24h", "Conheça rotinas de atendimento no ambiente de farmácia, organização, comunicação com clientes e práticas de atuação dentro dos limites da função.", "Rotinas de farmácia; atendimento; organização; comunicação; ética e responsabilidades; noções de produtos e procedimentos."],
    ["Operador de Caixa", "12h", "Aprenda as rotinas de caixa, atendimento, registro de compras, organização de operações e procedimentos comuns no comércio.", "Rotina de caixa; atendimento; registro de produtos; meios de pagamento; conferência; fechamento e organização."],
    ["Marketing Pessoal", "28h", "Trabalhe sua comunicação, postura, apresentação, imagem profissional e estratégias para fortalecer sua presença em contextos profissionais.", "Imagem profissional; comunicação; postura; relacionamento; apresentação pessoal; planejamento de desenvolvimento."],
    ["Técnicas de Administração", "15h", "Conheça conceitos e práticas administrativas, organização de processos, planejamento e apoio às rotinas de empresas e equipes.", "Organização; planejamento; processos; comunicação; rotinas administrativas; apoio à gestão."],
    ["Contabilidade e Matemática Financeira", "24h", "Desenvolva noções de registros, cálculos e conceitos financeiros que apoiam a compreensão de operações e rotinas de negócios.", "Conceitos contábeis básicos; cálculos; porcentagens; operações financeiras; organização e leitura de informações."],
    ["Recursos Humanos", "12h", "Conheça práticas de gestão de pessoas e rotinas de RH, incluindo processos de recrutamento, integração, comunicação e apoio aos colaboradores.", "Rotinas de RH; recrutamento e seleção; integração; comunicação; organização de documentos; gestão de pessoas."],
    ["Operador de Telemarketing", "20h", "Desenvolva técnicas de comunicação por telefone, organização de atendimento, abordagem, escuta e condução de conversas profissionais.", "Comunicação telefônica; abordagem; roteiro; escuta; objeções; registro e qualidade no atendimento."],
    ["Auxiliar de Escritório", "16h", "Aprenda a apoiar rotinas de escritório, organizar documentos, lidar com informações, comunicação e tarefas administrativas do cotidiano.", "Organização; documentos; atendimento; comunicação; rotinas administrativas; ferramentas de escritório."],
    ["Photoshop", "10h", "Conheça recursos de edição e tratamento de imagens, composição, ajustes visuais e criação de peças gráficas utilizando ferramentas do Photoshop.", "Interface; seleção; camadas; ajustes; tratamento; composição; exportação."],
    ["Corel", "16h", "Explore ferramentas de desenho vetorial e composição para criar materiais gráficos, formas, textos e peças visuais.", "Interface; formas; curvas; cores; textos; composição; organização e exportação de arte."],
    ["Ilustrador", "13h", "Desenvolva ilustrações e elementos gráficos, trabalhando com formas, composição, cores e recursos de desenho vetorial.", "Ferramentas de desenho; formas; cores; composição; elementos vetoriais; organização de projetos."],
    ["Técnicas de Publicidade e Propaganda", "12h", "Conheça fundamentos de comunicação publicitária, planejamento de mensagens, público-alvo e criação de ideias para divulgação.", "Comunicação; público-alvo; mensagem; meios de divulgação; criatividade; planejamento de campanhas."],
    ["Marketing", "12h", "Conheça fundamentos de marketing, identificação de público, divulgação, relacionamento e estratégias para apresentar produtos e serviços.", "Fundamentos; público; produto e serviço; divulgação; canais; relacionamento e planejamento."],
    ["Excel Avançado", "24h", "Aprofunde seus conhecimentos em planilhas com funções, recursos de análise, organização de dados e ferramentas que agilizam tarefas.", "Funções avançadas; recursos de análise; filtros; tabelas; gráficos; organização e produtividade."],
    ["Youtuber", "12h", "Conheça etapas de planejamento e produção de conteúdo em vídeo, desde ideias e gravação até apresentação e publicação responsável.", "Planejamento; roteiro; gravação; apresentação; edição introdutória; publicação e responsabilidade digital."],
    ["Criação de Games", "12h", "Explore conceitos de criação de jogos, lógica, personagens, cenários, regras e etapas de desenvolvimento de experiências interativas.", "Ideias e regras; personagens; cenários; lógica de jogo; interação; teste e melhoria."],
    ["Robótica", "32h", "Conheça conceitos de robótica e tecnologia por meio de atividades envolvendo construção, lógica, componentes e resolução de desafios.", "Conceitos de robótica; componentes; lógica; montagem orientada; desafios e testes."],
    ["Digitação", "", "Pratique técnicas de digitação, posicionamento, ritmo e precisão para melhorar a produtividade na utilização do computador.", "Postura; posicionamento; teclas; ritmo; precisão; exercícios de prática."],
    ["T.I. em Hardware", "", "Conheça componentes, montagem, manutenção preventiva, diagnóstico e cuidados essenciais com computadores.", "Componentes; montagem; manutenção preventiva; diagnóstico; cuidados e segurança."],
    ["Power BI", "", "Aprenda a organizar dados, construir visualizações, elaborar relatórios e criar painéis que apoiem a análise de informações.", "Importação e organização de dados; visualizações; relatórios; painéis; interpretação."],
];

$catalogoPacotes = [
    ["Operador de Microcomputador e CompuKids", "121h", "Uma formação que reúne fundamentos de informática, sistema operacional e ferramentas de escritório, com conteúdos adicionais voltados à proposta CompuKids.", ["Introdução à Informática (10h)", "Windows 10 (24h)", "Word 2016 (12h)", "Excel 2016 (16h)", "PowerPoint 2016 (12h)", "Internet 9 (12h)", "CDA (35h)"]],
    ["Atendimento de Farmácia", "96h", "Um conjunto de conteúdos voltados ao atendimento, vendas, rotinas de farmácia, operação de caixa e desenvolvimento de postura profissional.", ["Atendimento ao Cliente (16h)", "Técnicas de Vendas (18h)", "Atendimento de Farmácia (24h)", "Operador de Caixa (12h)", "Marketing Pessoal (28h)"]],
    ["Gestão de Negócio e Vendas", "85h ou 87h", "Formação que reúne administração, conceitos financeiros, recursos humanos, vendas ou telemarketing e rotinas de escritório. A duração pode variar conforme a opção de vendas ou telemarketing.", ["Técnicas de Administração (15h)", "Contabilidade e Matemática Financeira (24h)", "Recursos Humanos (12h)", "Técnicas de Vendas (18h) ou Operador de Telemarketing (20h)", "Auxiliar de Escritório (16h)"]],
    ["Designer Gráfico", "63h", "Pacote voltado à criação visual, reunindo edição de imagens, desenho vetorial, ilustração, publicidade e fundamentos de marketing.", ["Photoshop (10h)", "Corel (16h)", "Ilustrador (13h)", "Técnicas de Publicidade e Propaganda (12h)", "Marketing (12h)"]],
    ["Excel Financeiro", "40h", "Uma formação que combina Excel 2016 e recursos avançados para ampliar o domínio de planilhas, fórmulas, organização e análise de informações.", ["Excel 2016 (16h)", "Excel Avançado (24h)"]],
    ["Tecnokids", "94h", "Pacote de tecnologia e criatividade com edição gráfica, produção de conteúdo, criação de jogos e robótica.", ["Photoshop (20h)", "Corel (18h)", "Youtuber (12h)", "Criação de Games (12h)", "Robótica (32h)"]],
    ["Pacote elaborado para DB e WD", "", "Pacote específico indicado no documento da Compuway, reunindo informática, ferramentas de escritório e digitação.", ["Introdução à Informática", "Windows", "Word 2016", "Excel 2016", "PowerPoint", "Internet", "Digitação"]],
];

function slugCatalogo($texto) { $texto = iconv("UTF-8", "ASCII//TRANSLIT", $texto); $texto = strtolower($texto); $texto = preg_replace("/[^a-z0-9]+/", "-", $texto); return trim($texto, "-"); }
?>
