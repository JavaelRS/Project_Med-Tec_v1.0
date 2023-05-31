import java.time.format.DateTimeFormatter;
import com.itextpdf.text.pdf.PdfWriter;
import java.awt.event.ActionListener;
import com.itextpdf.text.FontFactory;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Document;
import java.awt.event.ActionEvent;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Element;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.Image;
import javax.swing.*;
import java.time.*;
import java.awt.*;
import java.io.*;

public class Application extends JFrame implements ActionListener {
	
	//Declaração de variáveis globais para ActionListeners
	private JTextField textName, textSurname, textCPF, textName2, textCRM;
	private JButton buttonText, buttonGenerate, buttonClear;
	private JMenuItem diagnosis, appointment,rDiagnosis, rPrescription, rAppointment;
	private JPanel panel1, mainPanel, dePanel, dPanel;
	private JComboBox comboBoxF;
	private JTextArea mainText;
	private CardLayout cardL;
	
	private String[] selectFile = {"Selecionar Tipo", "Laudo Médico", "Prescrição Médica"};
	private String[] selectSex = {"Selecionar", "Masculino", "Feminino"};
	
	private String[] code = {"0","1","2","3","4","5","6","7","8","9","!","@","#","$","&","*","a","b",
			"c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x",
			"y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T",
			"U","V","W","X","Y","Z"};
	
	private String firstName, Surname, CPF, doctorName, CRM, docT = "Documento";
	
	public Application() {
		
		//Criação básica da janela do aplicativo
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setLayout(new BorderLayout());
		this.setTitle("AutoDoc v1.0");
		this.setLocation(2, 7);
		this.setResizable(false);
		this.setSize(1360, 720);
		
		//Criação da barra de menu para a navegação de funções do aplicativo
		JMenuBar menu = new JMenuBar();
		
		JMenu file = new JMenu("Arquivo");
		
		JMenu addFiles = new JMenu("Novo Documento");
		JMenu readFiles = new JMenu("Arquivos armazenados");
		
		diagnosis = new JMenuItem("Laudo / Prescrição");
		appointment = new JMenuItem("Consulta");
		rDiagnosis = new JMenuItem("Láudos Médicos");
		rPrescription = new JMenuItem("Prescrições Médicas");
		rAppointment = new JMenuItem("Consultas");
		
		//ActionListeners para botões, itens de menu, etc, receberem comandos
		diagnosis.addActionListener(this);
		appointment.addActionListener(this);
		rDiagnosis.addActionListener(this);
		rPrescription.addActionListener(this);
		rAppointment.addActionListener(this);
		
		//Criação dos painéis
		panel1 = new JPanel();
		panel1.setLayout(new BoxLayout(panel1, BoxLayout.Y_AXIS));
		
		cardL = new CardLayout();
		
		mainPanel = new JPanel();
		mainPanel.setLayout(cardL);
		mainPanel.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		mainPanel.setBackground(new Color(234, 234, 234));
		
		dePanel = new JPanel();
		dePanel.setLayout(new BorderLayout());
		dePanel.setBackground(new Color(234, 234, 234));
		
		dPanel = new JPanel();
		dPanel.setLayout(null);
		dPanel.setBackground(new Color(234, 234, 234));
		
		//Configuração do painel do documento
		JLabel label1 = new JLabel("- Novo Documento -");
		label1.setFont(new Font("Consolas", Font.ITALIC, 35));
		label1.setLocation(new Point(410, 20));
		label1.setSize(360, 40);
		
		JLabel labelBack1 = new JLabel();
		labelBack1.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack1.setLocation(80, 80);
		labelBack1.setSize(945, 120);
		
		JLabel labelBack2 = new JLabel();
		labelBack2.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack2.setLocation(80, 215);
		labelBack2.setSize(945, 80);
		
		JLabel labelBack3 = new JLabel();
		labelBack3.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack3.setLocation(80, 312);
		labelBack3.setSize(945, 320);
		
		JLabel labelName = new JLabel("Nome do Paciente:");
		labelName.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelName.setLocation(new Point(120, 100));
		labelName.setSize(220, 30);
		
		JLabel labelSurname = new JLabel("Sobrenome do Paciente:");
		labelSurname.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelSurname.setLocation(new Point(120, 155));
		labelSurname.setSize(270, 30);
		
		JLabel labelCPF = new JLabel("CPF:");
		labelCPF.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelCPF.setLocation(new Point(700, 100));
		labelCPF.setSize(80, 30);
		
		JLabel labelName2 = new JLabel("Nome do Médico:");
		labelName2.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelName2.setLocation(new Point(120, 243));
		labelName2.setSize(220, 30);
		
		JLabel labelCRM = new JLabel("CRM/PR:");
		labelCRM.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelCRM.setLocation(new Point(750, 243));
		labelCRM.setSize(160, 30);
		
		textName = new JTextField();
		textName.setFont(new Font("Consolas", Font.PLAIN, 18));
		textName.setLocation(330, 95);
		textName.setSize(300, 30);
		
		textSurname = new JTextField();
		textSurname.setFont(new Font("Consolas", Font.PLAIN, 18));
		textSurname.setLocation(390, 150);
		textSurname.setSize(300, 30);
		
		textCPF = new JTextField();
		textCPF.setFont(new Font("Consolas", Font.PLAIN, 18));
		textCPF.setLocation(753, 95);
		textCPF.setSize(200, 30);

		textName2 = new JTextField();
		textName2.setFont(new Font("Consolas", Font.PLAIN, 18));
		textName2.setLocation(310, 240);
		textName2.setSize(410, 30);
		
		textCRM = new JTextField();
		textCRM.setFont(new Font("Consolas", Font.PLAIN, 18));
		textCRM.setLocation(840, 240);
		textCRM.setSize(120, 30);
		
		mainText = new JTextArea(30, 30);
		mainText.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		mainText.setFont(new Font("Consolas", Font.PLAIN, 15));
		mainText.setLocation(120, 322);
		mainText.setWrapStyleWord(true);
		mainText.setLineWrap(true);
		mainText.setSize(600, 300);
		
		JLabel labelDoc = new JLabel("Documento");
		labelDoc.setFont(new Font("Consolas", Font.ITALIC, 22));
		labelDoc.setLocation(new Point(820, 340));
		labelDoc.setSize(120, 30);
		
		comboBoxF = new JComboBox(selectFile);
		comboBoxF.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxF.setLocation(778, 370);
		comboBoxF.setSize(190, 30);
		
		buttonText = new JButton("Gerar Texto");
		buttonText.setFont(new Font("Consolas", Font.PLAIN, 18));
		buttonText.setFocusable(false);
		buttonText.setLocation(790, 450);
		buttonText.setSize(170, 28);
		buttonText.addActionListener(this);
		
		buttonClear = new JButton("Limpar Tudo");
		buttonClear.setFont(new Font("Consolas", Font.PLAIN, 18));
		buttonClear.setFocusable(false);
		buttonClear.setLocation(795, 490);
		buttonClear.setSize(160, 28);
		buttonClear.addActionListener(this);
		
		buttonGenerate = new JButton("Gerar Documento");
		buttonGenerate.setFont(new Font("Consolas", Font.PLAIN, 20));
		buttonGenerate.setFocusable(false);
		buttonGenerate.setLocation(768, 580);
		buttonGenerate.setSize(210, 28);
		buttonGenerate.addActionListener(this);
		
		dPanel.add(label1);
		dPanel.add(labelBack1);
		dPanel.add(labelBack2);
		dPanel.add(labelBack3);
		dPanel.add(labelName);
		dPanel.add(textName);
		dPanel.add(labelSurname);
		dPanel.add(textSurname);
		dPanel.add(labelCPF);
		dPanel.add(textCPF);
		dPanel.add(labelName2);
		dPanel.add(textName2);
		dPanel.add(labelCRM);
		dPanel.add(textCRM);
		dPanel.add(mainText);
		dPanel.add(labelDoc);
		dPanel.add(comboBoxF);
		dPanel.add(buttonText);
		dPanel.add(buttonClear);
		dPanel.add(buttonGenerate);
		
		ImageIcon img1 = new ImageIcon("assets/autodoc.png");
		ImageIcon img2 = new ImageIcon("assets/background2.png");
		ImageIcon img3 = new ImageIcon("assets/java-logo.png");
		
		JLabel logo = new JLabel();
		logo.setIcon(img1);
		
		JLabel background = new JLabel();
		background.setIcon(img2);
		
		JLabel java = new JLabel();
		java.setIcon(img3);
		
		addFiles.add(diagnosis);
		addFiles.add(appointment);
		
		readFiles.add(rDiagnosis);
		readFiles.add(rPrescription);
		readFiles.add(rAppointment);
		
		file.add(addFiles);
		file.add(readFiles);
		
		menu.add(file);
		
		//panel1.add(logo);
		panel1.add(java);
		
		dePanel.add(background, BorderLayout.CENTER);
		
		mainPanel.add(dePanel, "dePanel");
		mainPanel.add(dPanel, "dPanel");
		
		this.add(panel1, BorderLayout.WEST);
		this.add(mainPanel, BorderLayout.CENTER);
		this.setJMenuBar(menu);
		
		this.setVisible(true);
	}
	
	public String generateCode() {
		
		String medtecCode;
		
		int len = code.length;
		
		int random1 = (int) (Math.random() * len);
		int random2 = (int) (Math.random() * len);
		int random3 = (int) (Math.random() * len);
		int random4 = (int) (Math.random() * len);
		int random5 = (int) (Math.random() * len);
		int random6 = (int) (Math.random() * len);
		int random7 = (int) (Math.random() * len);
		int random8 = (int) (Math.random() * len);
		int random9 = (int) (Math.random() * len);
		int random10 = (int) (Math.random() * len);

		medtecCode = code[random1]+code[random2]+code[random3]+code[random4]+code[random5]+
				code[random6]+code[random7]+code[random8]+code[random9]+code[random10];

		return medtecCode;
	}

	public void actionPerformed(ActionEvent e) {
		
		LocalDate date = LocalDate.now();
		
		if (e.getSource() == buttonGenerate) {
			DateTimeFormatter form = DateTimeFormatter.ofPattern("ddMMyyyy");
			String formDate = date.format(form);
			
			String docType = "DOCUMENTO";
			
			if (this.docT == "Laudo")
				docType = "LAUDO MÉDICO";
			else if (this.docT == "Prescricao")
				docType = "PRESCRIÇÃO MÉDICA";
			
			this.firstName = textName.getText().trim();
			this.Surname = textSurname.getText().trim();
			this.CPF = textCPF.getText().trim();
			
			if (mainText.getText().isBlank())
				JOptionPane.showMessageDialog(null, "O texto do documento está vazio.", "Erro", 
						JOptionPane.WARNING_MESSAGE);
			else {
				try {
		            Document doc = new Document(PageSize.A4);
		            doc.setMargins(40f, 40f, 40f, 40f);
		            
		            String dir = "Directorio";
		            
		            String sendCode;
		            sendCode = generateCode();
		            
		            if (this.docT == "Laudo")
		            	dir = "arquivos/laudos/Laudo"+this.firstName+""+this.Surname+""+formDate+".pdf";
		            else if (this.docT == "Prescricao")
		            	dir = "arquivos/prescriçoes/Prescricao"+this.firstName+""+this.Surname+""+formDate+".pdf";
		            
		            PdfWriter.getInstance(doc, new FileOutputStream(dir));
		            
		            doc.open();
		            
		            Image img = Image.getInstance("assets/header.jpg");
		            img.scaleAbsolute(520f, 100f);
		            img.setAlignment(Element.ALIGN_CENTER);
		            
		            Paragraph title = new Paragraph(new Phrase(20F, docType, 
		            		FontFactory.getFont(FontFactory.HELVETICA, 16F)));
		            title.setAlignment(Element.ALIGN_CENTER);
		            
		            Paragraph text = new Paragraph(new Phrase(20F, mainText.getText(), 
		            		FontFactory.getFont(FontFactory.HELVETICA, 16F)));
		            text.setAlignment(Element.ALIGN_LEFT);
		            
		            doc.add(img);
		            doc.add(new Paragraph("\n\n"));
		            doc.add(title);
		            doc.add(new Paragraph("\n\n"));
		            doc.add(text);
		            doc.add(new Paragraph("\n\n"));
		            doc.add(new Paragraph("Código Med-Tec: "+sendCode));
		            doc.add(new Paragraph("\n\n"));
		            doc.add(new Paragraph("Verifique a autencidade deste documento no site da Med-Tec."));
		            doc.add(new Paragraph("\n\n"));
		            doc.add(new Paragraph("Hospital Geral - R. William Osler, 1849, Curitiba-PR"));
		               
		            JOptionPane.showMessageDialog(null, "Documento gerado com sucesso.", "AutoDoc", 
							JOptionPane.INFORMATION_MESSAGE);
		            
		            Runtime.getRuntime().exec(new String[]{"cmd.exe", "/c", "start", dir});
		            
		            doc.close();
		            
		            CodeDTO objCodeDTO = new CodeDTO();
		            objCodeDTO.setCode(sendCode);
		            objCodeDTO.setCpf(this.CPF);
		            
		            CodeDAO objCodeDAO = new CodeDAO();
		            objCodeDAO.sendCodeDatabase(objCodeDTO);
		        } 
				catch (Exception e1) {
		            e1.printStackTrace();
		        }
			}
		}
		
		else if (e.getSource() == rDiagnosis) {
			File files = new File("arquivos/laudos");
			
			try {
	            if (Desktop.isDesktopSupported())
	                Desktop.getDesktop().open(files);
	        } 
			catch (IOException ex) {
	            ex.printStackTrace();
	        }
		}
		
		else if (e.getSource() == rPrescription) {
			File files = new File("arquivos/prescriçoes");
			
			try {
	            if (Desktop.isDesktopSupported())
	                Desktop.getDesktop().open(files);
	        } 
			catch (IOException ex) {
	            ex.printStackTrace();
	        }
		}
		
		else if (e.getSource() == rAppointment) {
			File files = new File("arquivos/consultas");
			
			try {
	            if (Desktop.isDesktopSupported())
	                Desktop.getDesktop().open(files);
	        } 
			catch (IOException ex) {
	            ex.printStackTrace();
	        }
		}
		
		else if (e.getSource() == diagnosis) {
			cardL.show(mainPanel, "dPanel");
		}
		
		else if (e.getSource() == appointment) {
			new Appointment();
		}
		
		else if (e.getSource() == buttonText) {
			DateTimeFormatter form = DateTimeFormatter.ofPattern("dd/MM/yyyy");
			String formDate = date.format(form);
			
			this.firstName = textName.getText().trim();
			this.Surname = textSurname.getText().trim();
			this.CPF = textCPF.getText().trim();
			this.doctorName = textName2.getText();
			this.CRM = textCRM.getText().trim();
			
			if (this.firstName.isBlank() || this.Surname.isBlank() || this.CPF.isBlank() || 
					this.doctorName.isBlank() || this.CRM.isBlank() || 
					comboBoxF.getSelectedIndex() == 0) {
				JOptionPane.showMessageDialog(null, "Todos os campos devem ser preenchidos.", "Erro", 
						JOptionPane.WARNING_MESSAGE);
			}
			else if (comboBoxF.getSelectedIndex() == 1){
				mainText.setText("Declaro que o(a) paciente "+this.firstName.toUpperCase()+" "
					+this.Surname.toUpperCase()+", portador(a) do CPF "+this.CPF+" está em acompanhamento "
					+ "médico devido a diagnóstico de [Doença], "
					+ "cumprindo os critérios diagnósticos clássicos referentes ao comprometimento "
					+ "do [Área afetada].\n\nEste paciente deve ser mantido em tratamento de "
					+ "forma contínua com:\n\n  1. [Tratamento].\n\nCID "
					+ "(Classificação Internacional de Doenças) - [CID].\n\n"
					+ "Curitiba, "+formDate+".\n\nDr(a). "+this.doctorName+" - CRM/PR - "+this.CRM);
			}
			else if (comboBoxF.getSelectedIndex() == 2){
				mainText.setText("Dr(a). "+this.doctorName+"\nR. William Osler, 1849\nCuritiba,"
						+ " Paraná\nTelefone: (41) 1122-3344\nCRM/PR: "+this.CRM+"\n\nPara: "
						+this.firstName+" "+this.Surname+"\n[ Endereço ]\n"
						+ "[Cidade e UF]\n\n[Medicamento e peso] ___________"
						+ " [Qt. Comprimidos]\n\nTomar [Qnt.] comprimido(s), por via [Via], a cada"
						+ " [Horário] horas, por [Dias] dias.\n\nCuritiba, "+formDate);
			}
			
			if (comboBoxF.getSelectedIndex() == 1)
				this.docT = "Laudo";
			else if (comboBoxF.getSelectedIndex() == 2)
				this.docT = "Prescricao";
				
		}
		else if (e.getSource() == buttonClear) {
			textName.setText("");
			textSurname.setText("");
			textCPF.setText("");
			textName2.setText("");
			textCRM.setText("");
			mainText.setText("");
			comboBoxF.setSelectedIndex(0);
		}
	}
}