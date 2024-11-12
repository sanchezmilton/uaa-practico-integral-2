<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="login.css">

    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-auth.js"></script>
    <script>
        // Configuración de Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyAaWLIjFjySp5i5r1FtUXNW_XGnYQS_7cE",
            authDomain: "backend---interfaces.firebaseapp.com",
            databaseURL: "https://backend---interfaces-default-rtdb.firebaseio.com",
            projectId: "backend---interfaces",
            storageBucket: "backend---interfaces.appspot.com",
            messagingSenderId: "779545171534",
            appId: "1:779545171534:web:744d5fa34fbcb24852551f"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
    </script>

    <title>Ingreso | Sistema de pedidos</title>
</head>

<body class="card">
    <?php include "header.php"; ?>
    <main class="card-body">
        <form id="login-form">
            <fieldset>
                <label for="email_input" class="form-label">Email</label>
                <input type="email" class="form-control" id="email_input" placeholder="ejemplo@mail.com" required>
            </fieldset>
            <fieldset>
                <label for="password_input" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password_input" required>
            </fieldset>
            <fieldset>
                <label for="captcha" class="form-label">Captcha</label>
                <figure>
                    <img src="captcha.php" alt="Captcha" />
                    <input type="text" id="captcha" required />
                </figure>
            </fieldset>
            <button type="button" id="login_button">Ingresar</button>
        </form>
    </main>
    <?php include "footer.php"; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#login_button").click(function() {
                let email = $("#email_input").val();
                let password = $("#password_input").val();
                let captcha = $("#captcha").val();


                $.post(
                    "set-login.php", {
                        email,
                        captcha
                    },
                    function(data) {
                        if (data === "success") {
                            const data = firebase
                                .auth()
                                .signInWithEmailAndPassword(email, password).then(() => {
                                    alert("Ingreso exitoso");
                                    window.location = "delivery.php";
                                    return;
                                }, (error) => {
                                    console.error(error)
                                });
                            return;
                        }
                        console.error(data);
                        alert("Ocurrió un error al ingresar, intente de nuevo.");
                        return;
                    }
                );
            });
        });
    </script>
</body>

</html>