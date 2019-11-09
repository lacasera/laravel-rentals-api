## Laravel Rentals Api

###Overview
```
An api that allows users to register, add properties they want to rent out.

In this project, I tried to be as SOLID as possible.
```


#### Setup
1. clone project and install dependencies
2. create an env file from the .env.example
3. create a database and update the .env file
4. run the project.


#### Endpoints

##### Api base '/api/v1'


|  METHOD       | URI     | DESCRIPTION    | PROTECTED |
| :------------- | :---------- | :----------- | :----------------|
|  POST| `register`   | creates a new user   |  no |
|  POST| `login`   | Authenticates a registered user   |  no |
|  POST| `logout`   | logs out a user   |no |
|  GET | `me`   | gets user information an authenticated users information  | yes |
|  GET | `me/listings`   |  gets a user's properties  | yes |
|  PATCH | `/properties/{id}/state`   |  Publishes or Unpulishes a property | yes |
|  PATCH | `/properties`   |  gets all published properties | no |
|  PATCH | `/properties/{id}`   |  updates a specific property| yes |
|  GET | `/properties/{id}`   |  gets a specific property | no |
|  DELETE | `/properties/{id}`   |  deletes a specific property | yes |
|  POST | `/properties/{id}/book`   |  book a specific property | yes |


NB: Property images are uploaded to cloudinay