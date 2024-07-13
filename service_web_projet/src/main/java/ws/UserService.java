package ws;


import jakarta.jws.WebMethod;
import jakarta.jws.WebParam;
import jakarta.jws.WebService;
import metier.User;

import java.util.List;

@WebService
public interface UserService {
    @WebMethod
    List<User> getUsers();

    @WebMethod
    User getUserById(@WebParam(name = "id") Long id);

    @WebMethod
    void addUser(@WebParam(name = "user") User user);

    @WebMethod
    void deleteUser(@WebParam(name = "id") Long id);

    @WebMethod
    void updateUser(@WebParam(name = "user") User user);

    @WebMethod
    boolean auth(@WebParam(name = "login") String login, @WebParam(name = "password") String password);

    @WebMethod
    String generateToken(@WebParam(name = "id") Long id);
}
