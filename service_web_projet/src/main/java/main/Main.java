package main;

import jakarta.xml.ws.Endpoint;
import ws.UserServiceImpl;

public class Main {

    public static void main(String[] args) {
        // Adresse du service web SOAP
        String address = "http://localhost:8581/userService";

        // Création de l'implémentation du service
        UserServiceImpl userService = new UserServiceImpl();

        // Publication du service web SOAP à l'adresse spécifiée
        Endpoint.publish(address, userService);

        // Confirmation que le service a été publié avec succès
        System.out.println("Service web SOAP UserService publié à : " + address);
    }
}
