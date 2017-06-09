###################
OAuth Server API
###################

*******************
Register an account
*******************

POST http://localhost/oauth/register/create <p>
Header Content-Type: application/json  <p>
Body {"username": 18811066874, "password": 1234} 

**************************
Generate a Bearer token
**************************

POST http://localhost/oauth/token/generate <p>
Header Content-Type: application/json <p>
Body {"username": 18811066874, "password": 1234} <p>
Response <p>
{<p>
"username": 18811066874,<p>
"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY"<p>
} <p>

*******************
Upload an mp3 file to server
*******************

POST http://localhost/oauth/mp3/upload <p>
Header<p>
Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY<p>
Content-Type:application/json<p>
Body {"username": 18811066874, "password": 1234}
Response<p>
{<p>
"url": "http://localhost/oauth/mp3/uploaded?file_name=test_record.mp3",<p>
"status": "success"<p>
} 

************
Get the mp3 file via token
************

GET http://localhost/oauth/mp3/uploaded?file_name=test_record.mp3 <p>
Header<p>
Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY<p>
Content-Type:application/json 

*********
Thanks to
*********

-  `CodeIgniter <https://codeigniter.com/docs>`_
-  `RestServer <https://github.com/chriskacerguis/codeigniter-restserver>`_
-  `JWT <https://github.com/firebase/php-jwt>`_