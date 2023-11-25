<%@ WebService Language="C#" Class="UserCheck" %>

using System.Web.Services;
using System;
using System.Data.Odbc;

[WebService(Namespace="http://nateweiss.com/fsg/webservices")]
public class UserCheck : WebService {


  [WebMethod(Description="Returns customer ID, if any, based on username/password")]
  public int getCustomerID(string username, string password) {

    // Query the database
    string sql = " SELECT idCustomer FROM Customers " +
      "WHERE sUsername = '" + username + "' " +
      "AND sPassword = '" + password + "'";
    OdbcConnection connection = new OdbcConnection("DSN=VenueDB");
    OdbcCommand command = new OdbcCommand(sql, connection);
    connection.Open();
    Int32 customerID = Convert.ToInt32(command.ExecuteScalar());
    connection.Close();   

    // Return customer ID (-1 if no record found)
    if (customerID == 0) {
      return -1;
    } else {
      return customerID;
    }
  }


  [WebMethod(Description="Determines whether a given username is already in use")]
  public bool isUsernameAvailable(string username) {

    // Query the database
    string sql = " SELECT idCustomer FROM Customers " +
      "WHERE sUsername = '" + username + "' ";;
    OdbcConnection connection = new OdbcConnection("DSN=VenueDB");
    OdbcCommand command = new OdbcCommand(sql, connection);
    connection.Open();
    Int32 customerID = Convert.ToInt32(command.ExecuteScalar());
    connection.Close();   

    // Return true if no record found; false otherwise
    if (customerID == 0) {
      return true;
    } else {
      return false;
    }
  }


  [WebMethod(Description="Creates a new customer record")]
  public int createNewCustomer(string username, string password, string firstName, string lastName, string telephone, string email) {

    // Prepare connection
    string sql = " INSERT INTO Customers(sUsername, sPassword, sFirstName, sLastName, sTelephone) " +
    "VALUES ('"+ username +"', '"+ password +"', '"+ firstName +"', '"+ lastName +"', '"+ telephone +"')";
    OdbcConnection connection = new OdbcConnection("DSN=VenueDB");
    OdbcCommand command = new OdbcCommand(sql, connection);
    connection.Open();
    
    // Execute query
    command.ExecuteNonQuery();
    connection.Close();   
  
    // Return the ID number for the just-inserted record
    return getCustomerID(username, password);
  }
  
}
