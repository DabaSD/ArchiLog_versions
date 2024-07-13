package ws;

import connexion.DatabaseManager;
import jakarta.jws.WebService;
import metier.User;

import java.security.SecureRandom;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Base64;
import java.util.Date;
import java.util.List;

@WebService
public class UserServiceImpl implements UserService {

    // Simulation d'une base de données ou d'une liste en mémoire
    private List<User> userList = new ArrayList<>();

    @Override
    public List<User> getUsers() {
        List<User> userList = new ArrayList<>();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, login, password, token, dateCreation FROM user";
            PreparedStatement statement = conn.prepareStatement(query);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                User user = new User();
                user.setId(resultSet.getLong("id"));
                user.setLogin(resultSet.getString("login"));
                user.setPassword(resultSet.getString("password"));
                user.setToken(resultSet.getString("token"));
                user.setDateCreation(resultSet.getDate("dateCreation"));
                userList.add(user);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return userList;
    }

    @Override
    public User getUserById(Long id) {
        User user = null;
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, login, password, token, dateCreation FROM user WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setLong(1, id);
            ResultSet resultSet = statement.executeQuery();

            if (resultSet.next()) {
                user = new User();
                user.setId(resultSet.getLong("id"));
                user.setLogin(resultSet.getString("login"));
                user.setPassword(resultSet.getString("password"));
                user.setToken(resultSet.getString("token"));
                user.setDateCreation(resultSet.getDate("dateCreation"));
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return user;
    }


    @Override
    public void addUser(User user) {
//        user.setDateCreation(new Date());
        Date dateCreation = new Date();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "INSERT INTO user (login, password, dateCreation) VALUES (?, ?, ?)";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, user.getLogin());
            statement.setString(2, user.getPassword());
            statement.setTimestamp(3, new java.sql.Timestamp(dateCreation.getTime()));
            statement.executeUpdate();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }


    @Override
    public void deleteUser(Long id) {
        if (id != null) {
            try (Connection conn = DatabaseManager.getConnection()) {
                String query = "DELETE FROM user WHERE id = ?";
                PreparedStatement statement = conn.prepareStatement(query);
                statement.setLong(1, id);
                statement.executeUpdate();
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
        } else {
           return;
        }
    }


    @Override
    public void updateUser(User user) {
        if (user != null && user.getId() != null) {
            try (Connection conn = DatabaseManager.getConnection()) {
                String query = "UPDATE user SET login = ?, password = ? WHERE id = ?";
                PreparedStatement statement = conn.prepareStatement(query);
                statement.setString(1, user.getLogin());
                statement.setString(2, user.getPassword());
                statement.setLong(3, user.getId());
                statement.executeUpdate();
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
        } else {
            return;
        }
    }



    @Override
    public boolean auth(String login, String password) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT COUNT(*) FROM user WHERE login = ? AND password = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, login);
            statement.setString(2, password);

            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                int count = resultSet.getInt(1);
                return count > 0;
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return false;
    }


    @Override
    public String generateToken(Long id) {
        String token = java.util.UUID.randomUUID().toString();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "UPDATE user SET token = ? WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, token);
            statement.setLong(2, id);
            statement.executeUpdate();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return token;
    }

    public boolean isTokenValid(Long id, String token) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT COUNT(*) FROM user WHERE id = ? AND token = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setLong(1, id);
            statement.setString(2, token);

            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                int count = resultSet.getInt(1);
                return count > 0;
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return false;
    }

}
