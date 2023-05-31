import java.sql.PreparedStatement;
import javax.swing.JOptionPane;
import java.sql.SQLException;
import java.sql.Connection;
import java.sql.ResultSet;

public class UserDAO {
	
	Connection conn;
	
	public ResultSet userAuthentication(UserDTO objUserDTO) {
		conn = new ConnectionDAO().connectJDBC();

		try {
			String sql = "SELECT * FROM hospital_geral_staff WHERE usernameMed = ? AND passwordMed = ?";
			
			PreparedStatement pstm = conn.prepareStatement(sql);
			pstm.setString(1, objUserDTO.getUsername());
			pstm.setString(2, objUserDTO.getPassword());
			
			ResultSet res = pstm.executeQuery();
			
			return res;
		}
		catch (SQLException e) {
			JOptionPane.showMessageDialog(null, "UserDAO: "+e);
			
			return null;
		}
	}
	
}