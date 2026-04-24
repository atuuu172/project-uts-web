<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin - Kost Mawar Mulia</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.9)),
    url('https://images.unsplash.com/photo-1505691938895-1758d7feb511');
    background-size:cover;
    background-position:center;
}

/* CARD */
.login-box{
    background: rgba(20,30,50,0.85);
    backdrop-filter: blur(10px);
    padding:40px;
    border-radius:20px;
    width:350px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.7);
    border:1px solid rgba(255,215,0,0.3);
    text-align:center;
}

/* TITLE */
.title{
    font-size:24px;
    font-weight:700;
    color:#fff;
}

.subtitle{
    font-size:14px;
    color:#ccc;
    margin-bottom:20px;
}

/* INPUT */
.input-group{
    margin:15px 0;
}

.input-group input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    outline:none;
    background:#1e2a3a;
    color:white;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background: linear-gradient(45deg, gold, orange);
    color:black;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.05);
    box-shadow:0 0 20px gold;
}

/* FOOTER */
.footer{
    margin-top:20px;
    font-size:12px;
    color:#aaa;
}
</style>
</head>

<body>

<div class="login-box">
    <div class="title">Kost Mawar Mulia</div>
    <div class="subtitle">Admin Login</div>

    <form method="POST" action="proses_login.php">
        
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="footer">
        © Created by Ratu Agne Panggarena
    </div>
</div>

</body>
</html>