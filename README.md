User API Documnetation


In order to get all users send request to 

localhost/developer-api-task-credoweb/api/users/read.php


In order to get a specific user send request to 

localhost/developer-api-task-credoweb/api/users/read_one.php?id=1

The id param is the id of the user to be selected


In order to create new user send request to 

localhost/developer-api-task-credoweb/api/users/create.php

with parameters like 

	{
	   "email": "test.test@test.test",
       "firstName": "Test",
       "lastName": "Test"
	}
	
	
In order to update user send request to 

localhost/developer-api-task-credoweb/api/users/update.php

with parameters like 

	{
	   "id" : 1,
	   "email": "test.test@test.test",
       "firstName": "Test",
       "lastName": "Test"
	}
	
	
In order to delete user send request to 

localhost/developer-api-task-credoweb/api/users/delete.php?

with parameters like 

	{
		"id" : 1
	}

	
In order to search for user by email, First Name and Last Name send request to 

localhost/developer-api-task-credoweb/api/users/search.php?word= and the word to search by

