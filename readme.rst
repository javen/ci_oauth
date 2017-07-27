###################
OAuth Server API
###################

***************************
Deploy/Develop Requirements
***************************
* PHP 5.4 or greater
* CodeIgniter 3.0+
* MySQL 5.5/5.6
* Apache 2

`Test Server <http://52.55.178.57/oauth/>`

*******************
Register an account
*******************

**POST** http://localhost/oauth/register/create 

**Header** Content-Type: application/json

**Body** ``{"username": 18811066874, "password": 1234}``

**************************
Generate a Bearer token
**************************

**POST** http://localhost/oauth/token/generate  

**Header** Content-Type: application/json  

**Body** ``{"username": 18811066874, "password": 1234}`` 

**Response**   
::

	{
		"username": 18811066874,
		"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY"
	}


*******************
Upload an mp3 file to server
*******************

**POST** http://localhost/oauth/recordings/upload

**Header**
::

	Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY

**Body** form-data ``key/value: filename test_record.mp3``

**Response**
::

	{
		"url": "http://localhost/oauth/recordings/uploaded?file_name=test_record.mp3",
		"status": "success"
	} 


************
Get the mp3 file with the token
************

**GET** http://localhost/oauth/recordings/uploaded?file_name=test_record.mp3

**Header**
::

	Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY 


*********
Thanks to
*********

-  `CodeIgniter <https://codeigniter.com/docs>`_
-  `RestServer <https://github.com/chriskacerguis/codeigniter-restserver>`_
-  `JWT <https://github.com/firebase/php-jwt>`_