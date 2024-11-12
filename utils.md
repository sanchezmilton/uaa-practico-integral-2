# Índice

- [Formularios](#formularios)
  - [Enviar un formulario con jQuery](#enviar-un-formulario-con-jquery)
    - [Configuración](#configuración)
    - [Registrar o Ingresar](#registrar-o-ingresar)
  - [Enviar un formulario con Vue.js](#enviar-un-formulario-con-vuejs)
    - [Configuración](#configuración-1)
    - [Registrar o Ingresar](#registrar-o-ingresar-1)
- [Firebase](#firebase)
  - [Scripts de configuración](#scripts-de-configuración)
  - [Firebase con jQuery](#firebase-con-jquery)
    - [Registrar o Ingresar](#registrar-o-ingresar-2)
  - [Firebase con Vue.js](#firebase-con-vuejs)
    - [Registrar o Ingresar](#registrar-o-ingresar-3)
- [Seguridad](#seguridad)
  - [Sanitizar input (previene XSS)](#sanitizar-input-previene-xss)
  - [Preparar datos (previene SQL Injection)](#preparar-datos-previene-sql-injection)
  - [Captcha](#captcha)
    - [Generar captcha](#generar-captcha)
    - [Validar captcha](#validar-captcha)
    - [Usar captcha](#usar-captcha)
- [HTML5 y estilos](#html5-y-estilos)
  - [Etiquetas más usadas de HTML5](#etiquetas-más-usadas-de-html5)
  - [Reglas más usadas de CSS3](#reglas-más-usadas-de-css3)
  - [Bootstrap](#bootstrap)
    - [Configuración](#configuración-2)
    - [Componentes](#componentes)

---

# Formularios

## Enviar un formulario con JQuery

#### Configuración

```html
<head>
  <!-- ... -->
  <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"
  ></script>
</head>
```

#### Registrar o Ingresar

```html
<body>
  <!-- ... -->
  <input type="email" id="email" />
  <input type="password" id="password" />
  <input type="button" id="register" value="Registrar" />
  <!-- ... -->
  <script type="text/javascript">
    // Cuando el documento esté listo...
    $(document).ready(function () {
      // Se declara la función ´register´
      $("#register").click(function () {
        // Inputs del formulario
        let email = $("#email").val();
        let password = $("#password").val();

        // Se envían los datos a la página php por medio de un post,
        // en formato ´x-www-form-urlencoded´
        $.post(
          "register.php",
          {
            email: email,
            password: password,
          },
          function (data) {
            if (data === "error") {
              alert("Ocurrió un error al registrarse, intente de nuevo.");
            } else if (data === "success") {
              alert("Registro exitoso");
            }
          }
        );
      });
    });
  </script>
</body>
```

## Enviar un formulario con Vue.js

#### Configuración

```html
<head>
  <!-- ... -->
  <!-- CDN de Vue.js -->
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <!-- Componente -->
  <script src="register-form.js"></script>
</head>
```

#### Registrar o Ingresar

```html
<body>
  <!-- Root de la app -->
  <div id="app" style="margin-bottom: 100px;">
    <register-form></register-form>
  </div>
  <!-- Script iuicial -->
  <script>
    new Vue({
      el: "#app",
    });
  </script>
</body>
```

```javascript
Vue.component("register-form", {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    // Se declara la función ´register´
    async register() {
      try {
        const formData = new URLSearchParams();
        formData.append("email", this.user.email);
        formData.append("password", this.user.password);

        const response = await fetch("register.php", {
          method: "POST",
          headers: {
            // Enviar como x-www-form-urlencoded
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: formData.toString(),
        });

        const data = await response.text();
        if (data === "error") {
          alert("Ocurrió un error al registrarse, intente de nuevo.");
        } else if (data === "success") {
          alert("Registro exitoso");
        }
      } catch (error) {
        alert("Ocurrió un error con la solicitud.");
      }
    },
  },
  template: `
        <div>
			<input type="email" v-model="user.email" name="email" id="email" required>
			<input type="password" v-model="user.password" name="password" id="password" required>
			<button @click="register" name="register" id="register">Registrar</button>
		</div>
			`,
});
```

# Firebase

## Scripts de configuración

```html
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-auth.js"></script>
<script>
  // Configuración de Firebase
  const firebaseConfig = {
    apiKey: "AIzaSyDYCPou3eV1kmW1Gy9eVILAix7BSOf9HEM",
    authDomain: "practica-interfaces-e5ed9.firebaseapp.com",
    projectId: "practica-interfaces-e5ed9",
    storageBucket: "practica-interfaces-e5ed9.appspot.com",
    messagingSenderId: "370558884082",
    appId: "1:370558884082:web:a124edc9215b89b6f5186b",
    measurementId: "G-7VYPHB8FM9",
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
```

## Firebase con jQuery

#### Registrar o Ingresar

```javascript
async function register() {
  let email = $("#email").val();
  let password = $("#password").val();

  try {
    const data = firebase
      .auth()
      .createUserWithEmailAndPassword(email, password);
    // ingresar: signInWithEmailAndPassword

    // Enviar las credenciales a una página php
    $.post(
      "register.php",
      { email: email, password: password },
      function (data) {
        if (data === "error") {
          alert("Ocurrió un error al registrarse, intente de nuevo.");
        } else if (data === "success") {
          alert("Registro exitoso");
        }
      }
    );
  } catch (error) {
    alert("Ocurrió un error con la solicitud.");
  }
}
```

## Firebase con Vue.js

#### Registrar o Ingresar

```javascript
Vue.component("register-form", {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    // Se declara la función ´register´
    async register() {
      try {
        const data = firebase
          .auth()
          .createUserWithEmailAndPassword(email, password);
        // ingresar: signInWithEmailAndPassword

        // Enviar las credenciales a una página php
        try {
          const formData = new URLSearchParams();
          formData.append("email", this.user.email);
          formData.append("password", this.user.password);

          const response = await fetch("register.php", {
            method: "POST",
            headers: {
              // Enviar como x-www-form-urlencoded
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: formData.toString(),
          });

          const data = await response.text();
          if (data === "error") {
            alert("Ocurrió un error al registrarse, intente de nuevo.");
          } else if (data === "success") {
            alert("Registro exitoso");
          }
        } catch (error) {
          alert("Ocurrió un error con la solicitud.");
        }
      } catch (error) {
        alert("Ocurrió un error con la solicitud.");
      }
    },
  },
  template: `
        <div>
			<input type="email" v-model="user.email" name="email" id="email" required>
			<input type="password" v-model="user.password" name="password" id="password" required>
			<button @click="register" name="register" id="register">Registrar</button>
		</div>
			`,
});
```

# Seguridad

## Sanitizar input (previene XSS)

```php
<?php

function sanitize_email($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitize_string($string) {
    return htmlspecialchars(strip_tags(trim($string)));
}

function sanitize_integer($integer) {
    return filter_var(trim($integer), FILTER_SANITIZE_NUMBER_INT);
}

function sanitize_float($float) {
    return filter_var(trim($float), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function sanitize_date($date_input) {
    $date = DateTime::createFromFormat('Y-m-d', trim($date_input));
    if ($date && $date->format('Y-m-d') === trim($date_input)) {
        return $date->format('Y-m-d'); // Devuelve la fecha en formato Y-m-d
    }
    return null; // O manejar error de fecha no válida
}

function sanitize_url($url) {
    return filter_var(trim($url), FILTER_SANITIZE_URL);
}

function sanitize_phone($phone_input) {
    return preg_replace('/[^0-9]/', '', trim($phone_input)); // Solo permite dígitos
}

function sanitize_array($array_input) {
    return array_map('sanitize_string', $array_input);
}

?>
```

## Preparar datos (previene SQL injection)

```php
<?php
	$stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");

    // Usar la función password_hash para almacenar contraseñas de forma segura
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Ejecutar la consulta con datos seguros
    $stmt->execute([
		'email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => $hashed_password,
    ]);
?>
```

## Captcha

#### Generar captcha

```php
<?php
	session_start();

	function randomText($length) {
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$key = '';
		for($i=0;$i<$length;$i++) {
		$key .= $pattern[rand(0,35)];
		}
		return $key;
	}

	$_SESSION['tmptxt'] = randomText(5);
	$captcha = imagecreatefromgif("bgcaptcha.gif");
	$colText = imagecolorallocate($captcha, 0, 0, 0);
	imagestring($captcha, 5, 16, 7, $_SESSION['tmptxt'], $colText);

	header("Content-type: image/gif");
	imagegif($captcha);
?>
```

#### Validar captcha

```php
<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$user_input = $_POST['captcha_input'];
		$captcha_text = $_SESSION['tmptxt'];

		if ($user_input === $captcha_text) {
			echo "Captcha verificado con éxito.";
		} else {
			echo "Captcha incorrecto. Inténtalo de nuevo.";
		}
	}
?>
```

#### Usar captcha

```html
<body>
  <!-- ... -->
  <!-- Mostrar la imagen del captcha -->
  <img src="captcha.php" alt="Captcha" id="captcha-image" />
  <input type="text" id="captcha-input" name="captcha_input" required />

  <!-- ... -->
  <script>
    // Actualizar el captcha al hacer clic en la imagen
    document.getElementById("captcha-image").onclick = function () {
      this.src = "captcha.php?" + Math.random(); // Agrega un parámetro aleatorio para evitar caché
    };
  </script>
</body>
```

### HTML5 y estilos

## Etiquetas más usadas de HTML5

```html
<!--
Etiquetas comunes de HTML:

Estructura:
- <html>: Raíz de un documento HTML.
- <head>: Contiene metadatos y enlaces a scripts y estilos.
- <title>: Título del documento.
- <body>: Contenido principal del documento.

Encabezados:
- <h1>: Encabezado principal.
- <h2>: Subencabezado.
- <h3>: Tercer nivel de encabezado.
- <h4>: Cuarto nivel de encabezado.
- <h5>: Quinto nivel de encabezado.
- <h6>: Sexto nivel de encabezado.

Texto:
- <p>: Párrafo.
- <br>: Salto de línea.
- <hr>: Línea horizontal (separador).
- <strong>: Texto importante (negrita).
- <em>: Texto enfatizado (cursiva).
- <small>: Texto de menor tamaño.
- <mark>: Texto resaltado.
- <blockquote>: Cita en bloque.
- <cite>: Referencia a una fuente.

Listas:
- <ul>: Lista desordenada.
- <ol>: Lista ordenada.
- <li>: Elemento de lista.
- <dl>: Lista de definición.
- <dt>: Término de la lista de definición.
- <dd>: Definición del término.

Enlaces e imágenes:
- <a>: Enlace (anchor).
- <img>: Imagen.
- <figure>: Contenido gráfico.
- <figcaption>: Leyenda de un <figure>.

Otros:
- <div>: Contenedor genérico.
- <span>: Contenedor en línea genérico.
- <table>: Tabla.
- <tr>: Fila de una tabla.
- <td>: Celda de una tabla.
- <th>: Encabezado de celda de tabla.
- <form>: Formulario.
- <input>: Campo de entrada.
- <button>: Botón.
- <label>: Etiqueta para un control de formulario.
- <select>: Menú desplegable.
- <option>: Opción en un menú desplegable.
-->
```

## CSS

### Importar un archivo CSS al documento

```html
<head>
  <!-- ... -->
  <link rel="stylesheet" href="ruta/a/tu/estilo.css" />
</head>
```

### Reglas más usadas de CSS3

```css
/*
Reglas CSS más utilizadas:

1. Selectores:
   - Elemento: p { ... }  // Selecciona todos los <p>
   - Clase: .clase { ... } // Selecciona elementos con la clase "clase"
   - ID: #id { ... }       // Selecciona el elemento con el ID "id"
   - Atributo: [type="text"] { ... } // Selecciona elementos con un atributo específico

2. Propiedades de texto:
   - font-family: 'Arial', sans-serif; // Tipografía
   - font-size: 16px;                  // Tamaño de fuente
   - font-weight: bold;                 // Negrita
   - color: #333;                       // Color del texto
   - text-align: center;                // Alineación del texto
   - line-height: 1.5;                  // Altura de línea

3. Propiedades de fondo:
   - background-color: #fff;            // Color de fondo
   - background-image: url('imagen.jpg'); // Imagen de fondo
   - background-size: cover;             // Ajustar imagen al tamaño del contenedor

4. Espaciado y diseño:
   - margin: 20px;                      // Margen externo
   - padding: 10px;                     // Relleno interno
   - width: 100%;                       // Ancho del elemento
   - height: auto;                      // Alto del elemento

5. Bordes y sombras:
   - border: 1px solid #ccc;            // Borde
   - border-radius: 5px;                // Bordes redondeados
   - box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); // Sombra del cuadro

6. Display y posicionamiento:
   - display: block;                     // Mostrar como bloque
   - display: inline;                    // Mostrar en línea
   - position: relative;                 // Posicionamiento relativo
   - position: absolute;                 // Posicionamiento absoluto
   - top: 10px;                          // Posicionamiento vertical
   - left: 20px;                         // Posicionamiento horizontal

7. Transformaciones y efectos:
   - transform: rotate(10deg);          // Rotación
   - transform: translateY(10px);       // Traslación
   - transition: all 0.3s;              // Suaviza las transiciones

8. Flexbox y grid:
   - display: flex;                      // Usar flexbox
   - flex-direction: row;               // Dirección de los elementos flexibles
   - display: grid;                      // Usar grid
   - grid-template-columns: repeat(3, 1fr); // Crear columnas en grid
*/
```

## Bootstrap

#### Configuración

```html
<head>
  <!-- ... -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
    crossorigin="anonymous"
  />
</head>
```

#### Componentes

- https://getbootstrap.com/docs/5.3/components/
