import java.awt.event.ActionListener;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.awt.event.ActionEvent;
import java.awt.BorderLayout;
import java.awt.FlowLayout;
import java.awt.Dimension;
import javax.swing.*;

import com.itextpdf.text.Font;

public class Login extends JFrame implements ActionListener {
	
	private JTextField username, password;
	private JButton login;

	public Login() {
		
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setLocation(400, 200);
		this.setLayout(new BorderLayout());
		this.setTitle("AutoDoc - Login");
		this.setResizable(false);
		this.setSize(600, 300);
		
		JPanel panel1 = new JPanel();
		
		JPanel panel2 = new JPanel();
		panel2.setLayout(new FlowLayout());
		
		ImageIcon img = new ImageIcon("assets/autodoc.png"); 
		
		JLabel logo = new JLabel();
		logo.setIcon(img);
		
		JLabel labelUsername = new JLabel("Usuário                  ");
		labelUsername.setFont(new java.awt.Font("Consolas", Font.ITALIC, 20));
		
		username = new JTextField();
		username.setFont(new java.awt.Font("Consolas", Font.NORMAL, 18));
		username.setPreferredSize(new Dimension(280, 25));
		
		JLabel labelPassword = new JLabel("Senha                   ");
		labelPassword.setFont(new java.awt.Font("Consolas", Font.ITALIC, 20));
		
		password = new JTextField();
		password.setFont(new java.awt.Font("Consolas", Font.NORMAL, 18));
		password.setPreferredSize(new Dimension(280, 25));
		
		login = new JButton("Entrar");
		login.setFont(new java.awt.Font("Consolas", Font.NORMAL, 18));
		login.setPreferredSize(new Dimension(110, 30));
		login.addActionListener(this);
		login.setFocusable(false);
		
		panel1.add(logo);
		
		panel2.add(labelUsername);
		panel2.add(username);
		panel2.add(labelPassword);
		panel2.add(password);
		panel2.add(login);
		
		this.add(panel1, BorderLayout.WEST);
		this.add(panel2, BorderLayout.CENTER);
		
		this.setVisible(true);
	}

	public void actionPerformed(ActionEvent e) {
		
		if (e.getSource() == login) {
			
			try {
				String user, pass;
				
				user = username.getText();
				pass = password.getText();
				
				UserDTO objUserDTO = new UserDTO();
				objUserDTO.setUsername(user);
				objUserDTO.setPassword(pass);
				
				UserDAO objUserDAO = new UserDAO();
				ResultSet resUserDAO = objUserDAO.userAuthentication(objUserDTO);
				
				if (resUserDAO.next()) {
					new Application();
					
					this.dispose();
				}
				else {
					JOptionPane.showMessageDialog(null, "Usuário ou senha incorretos.", "Erro", 
							JOptionPane.WARNING_MESSAGE);
					
					username.setText("");
					password.setText("");
				}
			}
			catch (SQLException error) {
				JOptionPane.showMessageDialog(null, "Login: "+e);
			}
			
		}
	}

}
