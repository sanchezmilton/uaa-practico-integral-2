# Rutas

-   Inicio: "/"
-   Ingresar: "/ingresar"
-   Registrar: "/registrar"
-   Carrito: "/carrito"
-   Envios "/envios"

# Entidades

-   Auth (firebase)
    -   email
    -   password
-   Clients (web service)
    -   id
    -   email
    -   password
    -   first_name
    -   last_name
    -   address
    -   card_number
    -   card_description
-   Products (web app)
    -   id
    -   description
    -   price
-   Carts (web app)
    -   id
    -   id_client
-   Products_Carts (web app)
    -   id_product
    -   id_cart
    -   amount

## Objetos

-   Carritos (session)

    -   products: {
        id;
        description;
        amount;
        }[]

-   Un cliente realiza una compra (relación uno-a-muchos entre Clientes y Compras)
-   Una compra se relaciona con un pedido (relación uno-a-uno entre Compras y Pedidos)
-   Un pedido NO se relaciona con una entrega (ya que una entrega se relaciona directamente con la compra)
-   Un envío se relaciona con una compra (relación uno-a-uno entre Entregas y Compras)
