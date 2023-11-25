<cfcomponent>

  <!--- Returns customer ID, if any, based on username/password --->
  <cffunction name="getCustomerID" access="remote" returntype="numeric">
    <cfargument name="username" type="string" required="Yes">
    <cfargument name="password" type="string" required="Yes">
    
    <!--- Query the database --->
    <cfquery datasource="VenueDB" name="CustomerQuery">
      SELECT idCustomer
      FROM Customers
      WHERE sUsername = '#username#'
      AND sPassword = '#password#'
    </cfquery>
    
    <!--- Return customer ID (-1 if no record found) --->
    <cfif CustomerQuery.RecordCount eq 1>
      <cfreturn Val(CustomerQuery.idCustomer)>
    <cfelse>
      <cfreturn -1>
    </cfif>
  </cffunction>

  
  <!--- Determines whether a given username is already in use --->
  <cffunction name="isUsernameAvailable" access="remote" returntype="boolean">
    <cfargument name="username" type="string" required="Yes">
    
    <!--- Query the database --->
    <cfquery datasource="VenueDB" name="CustomerQuery">
      SELECT idCustomer
      FROM Customers
      WHERE sUsername = '#username#'
    </cfquery>
    
    <!--- Return true if no records found; false otherwise --->
    <cfreturn CustomerQuery.RecordCount eq 0>
  </cffunction>


  <!--- Creates a new customer record --->
  <cffunction name="createNewCustomer" access="remote" returntype="numeric">
    <cfargument name="username" type="string" required="Yes">
    <cfargument name="password" type="string" required="Yes">
    <cfargument name="firstName" type="string" required="Yes">
    <cfargument name="lastName" type="string" required="Yes">
    <cfargument name="telephone" type="string" required="Yes">
    <cfargument name="email" type="string" required="Yes">
    
    <!--- Insert new record into the database --->
    <cfquery datasource="VenueDB">
      INSERT INTO Customers (
        sUsername,
        sPassword,
        sFirstName,
        sLastName,
        sTelephone
      ) VALUES (
        '#username#',
        '#password#',
        '#firstName#',
        '#lastName#',
        '#telephone#'
      )
    </cfquery>
    
    <!--- Return the just-inserted customer ID --->
    <cfreturn getCustomerID(username, password)>
  </cffunction>
  
</cfcomponent>