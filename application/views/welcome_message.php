<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tropo QA OAuth Server</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Tropo Test OAuth Server API</h1>

	<div id="body">

		<h3>Register an account:</h3>
		<code>
			<strong>POST</strong> http://localhost/oauth/register/create <br>
			<strong>Header</strong> Content-Type: application/json       <br>
			<strong>Body</strong> {"username": 18811066874, "password": 1234}
		</code>

		<h3>Generate a Bearer token:</h3>
		<code>
			<strong>POST</strong> http://localhost/oauth/token/generate  <br>
			<strong>Header</strong> Content-Type: application/json       <br>
			<strong>Body</strong> {"username": 18811066874, "password": 1234} <br>
			<strong>Response</strong>                                    <br>
			{                                           <br>
			  "username": 18811066874,                  <br>
			  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY" <br>
			}        
		</code>

		<h3><strong>POST</strong> an mp3 file to server:</h3>
		<code>
			<strong>POST</strong> http://localhost/oauth/mp3/upload      <br>
			<strong>Header</strong> <br>
			Authorization:Bearer 
			eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY <br>

			<strong>Body</strong> form-data key/value: <strong>file/test_record.mp3</strong> <br>

			<strong>Response</strong>                                    <br>
			{											<br>
				"url": "http://localhost/oauth/mp3/uploaded?file_name=test_record.mp3", <br>
				"status": "success"                     <br>
			}
		</code>

		<h3>Get the mp3 file with the token:</h3>          
		<code>
			<strong>GET</strong> http://localhost/oauth/mp3/uploaded?file_name=test_record.mp3 <br>
			<strong>Header</strong> <br>Authorization:Bearer                 
				   eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6MTg4MTEwNjY4NzQsImlhdCI6MTQ5NzAyMjI3MywiZXhwIjoxNDk3MTA4NjczfQ.L4u_hrS59OcOpSLyp_v_ag5-yA_p-LT16yRwIoa46sY <br>
		</code>

		<p>Contribute to the project on <a href='https://github.com/javen/ci_oauth'>github</a>.</p>
	</div>

	<p class="footer">This page is using MySQL5.6, PHP5.6, Apache2.4, CodeIgniter 3.1.2.</p>
</div>

</body>
</html>