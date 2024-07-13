package rest;

import jakarta.ws.rs.*;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import metier.Article;
import connexion.DatabaseManager;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

@Path("/articles")
public class ArticleRessource {

    @GET
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Article> getAllArticles() {
        List<Article> articles = new ArrayList<>();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, titre, contenu, dateCreation, dateModification, categorie FROM article";
            PreparedStatement statement = conn.prepareStatement(query);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                Article article = new Article();
                article.setId(resultSet.getLong("id"));
                article.setTitre(resultSet.getString("titre"));
                article.setContenu(resultSet.getString("contenu"));
                article.setDateCreation(resultSet.getDate("dateCreation"));
                article.setDateModification(resultSet.getDate("dateModification"));
                article.setCategorie(resultSet.getLong("categorie"));
                articles.add(article);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return articles;
    }

    @GET
    @Path("/categories")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<String> getArticleCategories() {
        List<String> categories = new ArrayList<>();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT DISTINCT categorie FROM article";
            PreparedStatement statement = conn.prepareStatement(query);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                categories.add(resultSet.getString("categorie"));
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return categories;
    }

    @GET
    @Path("/categories/{category}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Article> getArticlesByCategory(@PathParam("category") Long category) {
        List<Article> articles = new ArrayList<>();
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "SELECT id, titre, contenu, dateCreation, dateModification, categorie FROM article WHERE categorie = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setLong(1, category);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                Article article = new Article();
                article.setId(resultSet.getLong("id"));
                article.setTitre(resultSet.getString("titre"));
                article.setContenu(resultSet.getString("contenu"));
                article.setDateCreation(resultSet.getDate("dateCreation"));
                article.setDateModification(resultSet.getDate("dateModification"));
                article.setCategorie(resultSet.getLong("categorie"));
                articles.add(article);
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return articles;
    }

    @POST
    @Consumes({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response addArticle(Article article) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "INSERT INTO article (titre, contenu, dateCreation, dateModification, categorie) VALUES (?, ?, ?, ?, ?)";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, article.getTitre());
            statement.setString(2, article.getContenu());
            statement.setTimestamp(3, new java.sql.Timestamp(article.getDateCreation().getTime()));
            statement.setTimestamp(4, new java.sql.Timestamp(article.getDateModification().getTime()));
            statement.setLong(5, article.getCategorie());
            statement.executeUpdate();
            return Response.status(Response.Status.CREATED).entity(article).build();
        } catch (SQLException ex) {
            ex.printStackTrace();
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }

    @PUT
    @Path("/{id}")
    @Consumes({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response updateArticle(@PathParam("id") Long id, Article article) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "UPDATE article SET titre = ?, contenu = ?, dateCreation = ?, dateModification = ?, categorie = ? WHERE id = ?";
            PreparedStatement statement = conn.prepareStatement(query);
            statement.setString(1, article.getTitre());
            statement.setString(2, article.getContenu());
            statement.setTimestamp(3, new java.sql.Timestamp(article.getDateCreation().getTime()));
            statement.setTimestamp(4, new java.sql.Timestamp(article.getDateModification().getTime()));
            statement.setLong(5, article.getCategorie());
            statement.setLong(6, id);
            statement.executeUpdate();
            return Response.status(Response.Status.OK).entity(article).build();
        } catch (SQLException ex) {
            ex.printStackTrace();
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }

    @DELETE
    @Path("/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Response deleteArticle(@PathParam("id") Long id) {
        try (Connection conn = DatabaseManager.getConnection()) {
            String query = "DELETE FROM article WHERE id = ?";
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
