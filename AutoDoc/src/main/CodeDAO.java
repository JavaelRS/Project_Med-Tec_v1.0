import java.sql.PreparedStatement;
import javax.swing.JOptionPane;
import java.sql.Connection;

public class CodeDAO {
	
	Connection conn;
	PreparedStatement pstm;
	
	public void sendCodeDatabase(CodeDTO objCodeDTO) {
		
		String sql = "INSERT codes(code, cpf) VALUES (?,?)";
		
		conn = new ConnectionDAO().connectJDBC();
		
		try {
			pstm = conn.prepareStatement(sql);
			pstm.setString(1, objCodeDTO.getCode());
			pstm.setString(2, objCodeDTO.getCpf());
			
			pstm.execute();
			pstm.close();
		} 
		catch (Exception error) {
			JOptionPane.showMessageDialog(null, "CodeDAO: "+error);
		}
	}
	
}