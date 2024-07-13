package rest;

import jakarta.ws.rs.*;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import metier.Categorie;
import connexion.DatabaseManager;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

@Path("/categories")
public class CategorieRessource {

    @GET
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Categorie> getAllCategories() {
        List<Categorie> categories = new ArrayList<>();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, libelle FROM categorie";
            PreparedStatement statement = conn.prepareStatement(query);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                Categorie categorie = new Categorie();
                categorie.setId(resultSet.getLong("id"));
                categorie.setLibelle(resultSet.getString("libelle"));
                categories.add(categorie);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return categories;
    }

    @GET
    @Path("/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Categorie getCategorieById(@PathParam("id") Long id) {
        Categorie categorie = null;
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, libelle FROM categorie WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setLong(1, id);
            ResultSet resultSet = statement.executeQuery();

            if (resultSet.next()) {
                categorie = new Categorie();
                categorie.setId(resultSet.getLong("id"));
                categorie.setLibelle(resultSet.getString("libelle"));
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return categorie;
    }

    @POST
    @Consumes({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response addCategorie(Categorie categorie) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "INSERT INTO categorie (libelle) VALUES (?)";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, categorie.getLibelle());
            statement.executeUpdate();
            return Response.status(Response.Status.CREATED).entity(categorie).build();
        } catch (SQLException ex) {
            ex.printStackTrace();
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }

    @PUT
    @Path("/{id}")
    @Consumes({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response updateCategorie(@PathParam("id") Long id, Categorie categorie) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "UPDATE categorie SET libelle = ? WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, categorie.getLibelle());
            statement.setLong(2, id);
            statement.executeUpdate();
            return Response.status(Response.Status.OK).entity(categorie).build();
        } catch (SQLException ex) {
            ex.printStackTrace();
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }

    @DELETE
    @Path("/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response deleteCategorie(@PathParam("id") Long id) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "DELETE FROM categorie WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setLong(1, id);
            statement.executeUpdate();
            return Response.status(Response.Status.NO_CONTENT).build();
        } catch (SQLException ex) {
            ex.printStackTrace();
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }
}
