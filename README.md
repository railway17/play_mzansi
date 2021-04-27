# CodeIgniter Rest Server With JWT Authentication

A fully RESTful server implementation for CodeIgniter using JWT for Authentication
## Notes

- Import Database from /db/rest_jwt.db
- Test it with postman/insomnia
- Create post method from postman for user authentication "http://localhost/ci-rest-jwt/api/auth/login"
- Add this to body multipart form :
	
	username = dodi
	
	password = dodi123
- If your authentication success you will get generated token response
- To test it, go Create post method from postman "http://localhost/ci-rest-jwt/api/main/test" and then you can attach that generated token you've got to the header authentication bearer token. see example bellow :

	Authentication: Bearer "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjIiLCJ1c2VybmFtZSI6ImRvZGk"

Please use this repo after creating `uploads` directory in the root