
<div class="container" id="login-container">
    <h1>Přihlášení</h1>
    <form id="login-form" method="post" action="index.php">
    <input type="hidden" name="login" value="1">
    <div class="form-group">
            <label for="jmeno_login">Uživatelské jméno:</label>
            <input type="text" id="jmeno_login" name="jmeno_login" required>
        </div>

        <div class="form-group">
            <label for="heslo_login">Heslo:</label>
            <input type="password" id="heslo_login" name="heslo_login" required>
        </div>
        <div class="button-wrapper">
            <button type="submit" class="btn">Přihlásit se</button>
        </div>
    </form>
    <p>Nemáte účet? <a href="#" onclick="showRegister()">Vytvoření účtu</a></p>
</div>

<div class="container" id="register-container" style="display:none;">
    <h1>Registrace</h1>
    <form id="register-form" method="post" action="index.php">
    <input type="hidden" name="register" value="1">
    <div class="form-group">
            <label for="jmeno_registrace">Uživatelské jméno:</label>
            <input type="text" id="jmeno_registrace" name="jmeno_registrace" required>
        </div>

        <div class="form-group">
            <label for="heslo_registrace">Heslo:</label>
            <input type="password" id="heslo_registrace" name="heslo_registrace" required>
        </div>
        <div class="button-wrapper">
            <button type="submit" class="btn">Registrovat se</button>
        </div>
    </form>
    <p>Máte účet? <a href="#" onclick="showLogin()">Přihlášení</a></p>
</div>


<style>
body {
            background: rgb(0,212,255);
            background: linear-gradient(45deg, rgba(0,212,255,1) 0%, rgba(11,3,45,1) 100%);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Lato', sans-serif;
        }

        .container {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(17, 25, 40, 0.25);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.125);  
            padding: 38px;
            filter: drop-shadow(0 30px 10px rgba(0,0,0,0.125));
            width: 300px; /* Můžete přizpůsobit šířku kontejneru */
        }

        h1 {
            font-family: 'Righteous', sans-serif;
            color: rgba(255,255,255,0.98);
            text-transform: uppercase;
            font-size: 2.4rem;
            margin: 0 0 20px 0; /* Vymažte top a left úpravy a nastavte spodní margin */
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: rgba(255, 255, 255, 0.9);
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid rgba(0, 212, 255, 0.6);
            background: transparent;
            color: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 8px rgba(0, 152, 224, 0.6);
        }

        .button-wrapper {
            text-align: center;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: rgba(0, 212, 255, 0.9);
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.9);
            color: rgba(0, 212, 255, 0.9);
        }  
        </style>

<script src="./scripts/login.js"></script>

