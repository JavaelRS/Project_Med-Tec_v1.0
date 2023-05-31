import javax.swing.JOptionPane;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Connection;

public class ConnectionDAO {
	
	public Connection connectJDBC() {
		
		String url = "jdbc:mysql://localhost:3306/medtec?useSSL=false";
		String user = "root";
		String password = null;
		
		Connection conn = null;
		
		try {
			conn = DriverManager.getConnection(url, user, password);
		}
		catch (SQLException e) {
			JOptionPane.showMessageDialog(null, e.getMessage(), "AutoDoc Connection", 
					JOptionPane.WARNING_MESSAGE);
		}
		
		return conn;
	}

}