<?php
// /**
//  * Created by PhpStorm.
//  * User: Kim
//  * Date: 6/22/2015
//  * Time: 12:05 PM
//  */
// ?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            overflow: hidden;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        
        .footer_login {
            margin-bottom : 5px;
        } 
        
        .login-container {
            position: relative;
            z-index: 2;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
        }
        .login-container img {
            max-height: 80px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            background: #ffcc00;
            color: #000;
            cursor: pointer;
        }
        .network-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        .network-animation span {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: move 10s linear infinite;
        }
        @keyframes move {
            0% {
                transform: translateY(0) translateX(0);
            }
            100% {
                transform: translateY(-100vh) translateX(100vw);
            }
        }
    </style>
</head>

<body>
    <div class="network-animation"></div>
    <div class="login-container">
        <div class = "login_error">
            {!! $errors->first('email') !!}
			{!! $errors->first('password') !!}
        </div> 
        <img src="{{ URL::asset('resources/assets/images/'.$website_logo) }}" alt="Logo">
        <h2>ADMIN LOGIN ACCESS</h2>
        <!--<form action="_admin/login/dologin" method="post" id="formlogin">-->
            {!! Form::open(array('url' => '_admin/login/dologin', 'method'=>'post', 'id' => 'formlogin')) !!}
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="LOGIN">
            <label class="errorText"></label>
		    {!! Form::close() !!}
		    <div id="footer_login">Development by <b>SCC</b></div>
        <!--</form>-->
        
        <!--<p id="errorText" style="color: red;">{!! $errors->first('email') !!} {!! $errors->first('password') !!}</p>-->
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const networkContainer = document.querySelector(".network-animation");
            for (let i = 0; i < 30; i++) {
                let span = document.createElement("span");
                span.style.top = Math.random() * 100 + "vh";
                span.style.left = Math.random() * 100 + "vw";
                span.style.animationDuration = Math.random() * 5 + 5 + "s";
                networkContainer.appendChild(span);
            }
        });
    </script>
</body>





