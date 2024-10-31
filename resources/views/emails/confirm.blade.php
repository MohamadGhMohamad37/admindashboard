<!DOCTYPE html>
<html>
<head>
    <title>Email confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .content{
            width: 100%;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#e6eaed;
        }
        .card{
            width: 70%;
            box-shadow:-6px 4px 17px 1px #495057;
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding:40px;
            border-radius:12px;
        }
        .content .card i.fa-solid.fa-lock {
            font-size: 70px;
            border: 10px solid #28a745;
            border-radius: 50%;
            padding: 40px;
            color: #28a745;
        }
        hr{
            border: 1px solid #e6eaed;
            width: 75%;
        }
        .card p span{
            color: #606060;
        }
    </style>
</head>
<body>
    <section class="content">
        <div class="card">
            <i class="fa-solid fa-lock"></i>
            <h1>Hello</h1>
            <p>Welcome to our website (website name) We do (website description)</p>
            <p>You have registered an account on: <span>{{$date}}</span> and time <span>{{$time}}</span>.</p>
            <p>The email you entered is: <span>{{$email}}</span></p>
            <hr>
            <p>Please verify your account by clicking the link below.</p>
            <a href="{{ url('verify/emai/' . $token) }}"><button type="button" class="btn btn-outline-success">click her</button>
            </a>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
