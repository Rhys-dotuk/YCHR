<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .main {
                font-family: 'Source Sans Pro', sans-serif;
                background-color: #ECF0F5;
                text-align: center;
                height: 450px;
            }
            .header {
                background-color: #3C8DBC;
                color: white;
            }
            .body {
                bottom: 100%;
            }
            .text-area {
                padding: 30px;
            }
            hr {
                width: 600px;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <div class="header">
                <div class="text-area">
                    <h2 class="title">HR Manager</h2>
                    <hr>
                    <small>This email has been sent to you to inform you that a user has </small>
                    <small>downloaded a file you uploaded to the HR Manager web application.</small>
                </div>
            </div>
            <div class="body">
                <div class="text-area">
                    <p>The user: &emsp; <strong> {{ $name }} </strong> &emsp; has just downloaded the file: &emsp; <strong> {{ $file_name }} </strong> &emsp; that you uploaded to
                    the HR Manager documents area.</p>
                </div>
            </div>
        </div>
    </body>
</html>