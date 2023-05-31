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

public class Appointment extends JFrame implements ActionListener {
	
	private JTextField textName, textSurname, textCPF, textName2, textCRM;
	private JButton buttonText, buttonGenerate, buttonClear;
	private JComboBox comboBoxDay, comboBoxMonth, comboBoxYear, comboBoxHour, 
		comboBoxMinute;
	private JTextArea mainText;
	
	private String[] selectDay = {"--", "01", "02", "03", "04", "05", "06", "07", "08", "09",
			"10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23",
			"24", "25", "26", "27", "28", "29", "30", "31"};
	private String[] selectMonth = {"--", "01", "02", "03", "04", "05", "06", "07", "08", "09",
			"10", "11", "12"};
	private String[] selectYear = {"--","2023","2024", "2025", "2026", "2027"};
	private String[] selectHour = {"--", "00", "01", "02", "03", "04", "05", "06", "07", "08",
			"09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"};
	private String[] selectMinute = {"--", "00", "05", "10", "15", "20", "25", "30", "35", "40", "45",
			"50", "55"};
	
	private String[] code = {"0","1","2","3","4","5","6","7","8","9","!","@","#","$","&","*","a","b",
			"c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x",
			"y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T",
			"U","V","W","X","Y","Z"};
	
	private String firstName, Surname, CPF, doctorName, CRM;

	public Appointment() {
		
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setLayout(null);
		this.setTitle("AutoDoc Consulta v1.0");
		this.setLocation(190, 60);
		this.setResizable(false);
		this.setSize(1024, 620);
		
		JLabel label1 = new JLabel("- Nova Consulta -");
		label1.setFont(new Font("Consolas", Font.ITALIC, 35));
		label1.setLocation(new Point(350, 20));
		label1.setSize(360, 40);
		
		JLabel labelBack1 = new JLabel();
		labelBack1.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack1.setLocation(45, 80);
		labelBack1.setSize(920, 100);
		
		JLabel labelBack2 = new JLabel();
		labelBack2.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack2.setLocation(45, 190);
		labelBack2.setSize(920, 60);
		
		JLabel labelBack3 = new JLabel();
		labelBack3.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		labelBack3.setLocation(45, 262);
		labelBack3.setSize(920, 290);
		
		JLabel labelName = new JLabel("Nome do Paciente:");
		labelName.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelName.setLocation(new Point(80, 95));
		labelName.setSize(200, 30);
		
		JLabel labelSurname = new JLabel("Sobrenome do Paciente:");
		labelSurname.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelSurname.setLocation(new Point(80, 140));
		labelSurname.setSize(270, 30);
		
		JLabel labelCPF = new JLabel("CPF:");
		labelCPF.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelCPF.setLocation(new Point(670, 95));
		labelCPF.setSize(80, 30);
		
		JLabel labelName2 = new JLabel("Nome do Médico:");
		labelName2.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelName2.setLocation(new Point(80, 208));
		labelName2.setSize(220, 30);
		
		JLabel labelCRM = new JLabel("CRM/PR:");
		labelCRM.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelCRM.setLocation(new Point(720, 208));
		labelCRM.setSize(160, 30);
		
		JLabel labelDate = new JLabel("Data da Consulta");
		labelDate.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelDate.setLocation(new Point(735, 280));
		labelDate.setSize(180, 30);
		
		JLabel labelHour = new JLabel("Horário");
		labelHour.setFont(new Font("Consolas", Font.ITALIC, 20));
		labelHour.setLocation(new Point(780, 353));
		labelHour.setSize(130, 30);
		
		textName = new JTextField();
		textName.setFont(new Font("Consolas", Font.PLAIN, 18));
		textName.setLocation(274, 92);
		textName.setSize(300, 30);
		
		textSurname = new JTextField();
		textSurname.setFont(new Font("Consolas", Font.PLAIN, 18));
		textSurname.setLocation(330, 137);
		textSurname.setSize(300, 30);
		
		textCPF = new JTextField();
		textCPF.setFont(new Font("Consolas", Font.PLAIN, 18));
		textCPF.setLocation(720, 92);
		textCPF.setSize(200, 30);
		
		textName2 = new JTextField();
		textName2.setFont(new Font("Consolas", Font.PLAIN, 18));
		textName2.setLocation(250, 205);
		textName2.setSize(410, 30);
		
		textCRM = new JTextField();
		textCRM.setFont(new Font("Consolas", Font.PLAIN, 18));
		textCRM.setLocation(800, 205);
		textCRM.setSize(120, 30);
		
		mainText = new JTextArea(30, 30);
		mainText.setBorder(BorderFactory.createLineBorder(Color.GRAY));
		mainText.setFont(new Font("Consolas", Font.PLAIN, 15));
		mainText.setLocation(80, 275);
		mainText.setWrapStyleWord(true);
		mainText.setLineWrap(true);
		mainText.setSize(600, 260);
		
		comboBoxDay = new JComboBox(selectDay);
		comboBoxDay.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxDay.setLocation(720, 305);
		comboBoxDay.setSize(60, 30);
		
		comboBoxMonth = new JComboBox(selectMonth);
		comboBoxMonth.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxMonth.setLocation(790, 305);
		comboBoxMonth.setSize(60, 30);
		
		comboBoxYear = new JComboBox(selectYear);
		comboBoxYear.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxYear.setLocation(860, 305);
		comboBoxYear.setSize(70, 30);
		
		comboBoxHour = new JComboBox(selectHour);
		comboBoxHour.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxHour.setLocation(750, 377);
		comboBoxHour.setSize(60, 30);
		
		comboBoxMinute = new JComboBox(selectMinute);
		comboBoxMinute.setFont(new Font("Consolas", Font.ITALIC, 18));
		comboBoxMinute.setLocation(830, 377);
		comboBoxMinute.setSize(60, 30);
		
		buttonText = new JButton("Gerar Texto");
		buttonText.setFont(new Font("Consolas", Font.PLAIN, 18));
		buttonText.setFocusable(false);
		buttonText.setLocation(735, 430);
		buttonText.setSize(170, 22);
		buttonText.addActionListener(this);
		
		buttonClear = new JButton("Limpar Tudo");
		buttonClear.setFont(new Font("Consolas", Font.PLAIN, 18));
		buttonClear.setFocusable(false);
		buttonClear.setLocation(740, 460);
		buttonClear.setSize(160, 22);
		buttonClear.addActionListener(this);
		
		buttonGenerate = new JButton("Gerar Documento");
		buttonGenerate.setFont(new Font("Consolas", Font.PLAIN, 20));
		buttonGenerate.setFocusable(false);
		buttonGenerate.setLocation(720, 510);
		buttonGenerate.setSize(210, 24);
		buttonGenerate.addActionListener(this);
		
		this.add(label1);
		this.add(labelBack1);
		this.add(labelBack2);
		this.add(labelBack3);
		this.add(labelName);
		this.add(textName);
		this.add(labelSurname);
		this.add(textSurname);
		this.add(labelCPF);
		this.add(textCPF);
		this.add(labelName2);
		this.add(textName2);
		this.add(labelCRM);
		this.add(textCRM);
		this.add(mainText);
		this.add(labelDate);
		this.add(comboBoxDay);
		this.add(comboBoxMonth);
		this.add(comboBoxYear);
		this.add(labelHour);
		this.add(comboBoxHour);
		this.add(comboBoxMinute);
		this.add(buttonText);
		this.add(buttonClear);
		this.add(buttonGenerate);
		
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
		
		if (e.getSource() == buttonText) {
			DateTimeFormatter form = DateTimeFormatter.ofPattern("dd/MM/yyyy");
			String formDate = date.format(form);
			
			String day, month, year, hour, minute;
			
			day = comboBoxDay.getSelectedItem().toString();
			month = comboBoxMonth.getSelectedItem().toString();
			year = comboBoxYear.getSelectedItem().toString();
			hour = comboBoxHour.getSelectedItem().toString();
			minute = comboBoxMinute.getSelectedItem().toString();
			
			this.firstName = textName.getText().trim();
			this.Surname = textSurname.getText().trim();
			this.CPF = textCPF.getText().trim();
			this.doctorName = textName2.getText();
			this.CRM = textCRM.getText().trim();
			
			if (this.firstName.isBlank() || this.Surname.isBlank() || this.CPF.isBlank() || 
					this.doctorName.isBlank() || this.CRM.isBlank() || 
					comboBoxDay.getSelectedIndex() == 0 || comboBoxMonth.getSelectedIndex() == 0 || 
					comboBoxYear.getSelectedIndex() == 0 || comboBoxHour.getSelectedIndex() == 0 || 
					comboBoxMinute.getSelectedIndex() == 0) {
				JOptionPane.showMessageDialog(null, "Todos os campos devem ser preenchidos.", "Erro", 
						JOptionPane.WARNING_MESSAGE);
			}
			else {
				mainText.setText("Prezado(a) cliente "+this.firstName.toUpperCase()+" "
						+this.Surname.toUpperCase()+", portador(a) do CPF "+this.CPF+", "
						+ "informamos que sua consulta foi agendada para as "+hour+":"+minute+
						" do dia "+day+"/"+month+"/"+year+".\n\nCompareça ao Bloco A na data e "
						+ "horário informados portando seu Documento de Identificação (RG ou CNH)"
						+ ", Comprovante de Residência e este Documento.\n\nCaso não esteja "
						+ "disponível na data e horário agendados, favor entrar em contato conosco "
						+ "para reagendarmos a consulta.\n\nDr(a). "+this.doctorName+" - "
						+ "CRM/PR: "+this.CRM+".\n\nCuritiba, "+formDate);
			}
		}
		else if (e.getSource() == buttonClear) {
			textName.setText("");
			textSurname.setText("");
			textCPF.setText("");
			textName2.setText("");
			textCRM.setText("");
			mainText.setText("");
		}
		else if (e.getSource() == buttonGenerate) {
			DateTimeFormatter form = DateTimeFormatter.ofPattern("ddMMyyyy");
			String formDate = date.format(form);
			
			this.firstName = textName.getText().trim();
			this.Surname = textSurname.getText().trim();
			
			if (mainText.getText().isBlank())
				JOptionPane.showMessageDialog(null, "O texto do documento está vazio.", "Erro", 
						JOptionPane.WARNING_MESSAGE);
			else {
				try {
		            Document doc = new Document(PageSize.A4);
		            doc.setMargins(40f, 40f, 40f, 40f);
		            
		            String dir = "arquivos/consultas/Consulta"+this.firstName+""+this.Surname+""
		            +formDate+".pdf";
		            
		            String sendCode;
		            sendCode = generateCode();
		            
		            PdfWriter.getInstance(doc, new FileOutputStream(dir));
		            
		            doc.open();
		            
		            Image img = Image.getInstance("assets/header.jpg");
		            img.scaleAbsolute(520f, 100f);
		            img.setAlignment(Element.ALIGN_CENTER);
		            
		            Paragraph title = new Paragraph(new Phrase(20F, "CONSULTA MÉDICA", 
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
	}
}