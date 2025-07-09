# 🛒 e-commerce API REST

API REST para la gestión de productos, diseñada para servir como backend de una aplicación móvil.

## 🏗️ Arquitectura y Patrones de Diseño

Este proyecto implementa **arquitectura hexagonal (Ports & Adapters)** en Symfony. Esta elección permite desacoplar el dominio de la infraestructura, facilitando la escalabilidad, el testing y la mantenibilidad. Los casos de uso y la lógica de negocio residen en el núcleo de la aplicación, mientras que los detalles de frameworks, bases de datos o servicios externos se gestionan en los adaptadores.

**Patrones utilizados:**

-   **Repository:** Abstracción del acceso a datos, permitiendo cambiar la fuente de persistencia sin afectar el dominio.
-   **DTO (Data Transfer Object):** Estandariza la transferencia de datos entre capas.
-   **Dependency Injection:** Facilita la inversión de dependencias y el testeo.

## 🚀 Instrucciones para levantar el proyecto en local

1. **Instalar dependencias:**
    ```bash
    composer install
    ```
2. **Edita .env.dev:**

```
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data_%kernel.environment%.db"
APP_AUTH_TOKEN=admintoken
```

3. **Crear la base de datos y cargar fixtures (desarrollo):**

```

   php bin/console doctrine:database:create --env=dev
   php bin/console doctrine:schema:create --env=dev
   php bin/console doctrine:fixtures:load --env=dev --no-interaction
```

4. **Crear la base de datos y cargar fixtures (testing):**

    ```bash
    php bin/console doctrine:database:create --env=test
    php bin/console doctrine:schema:create --env=test
    php bin/console doctrine:fixtures:load --env=test --no-interaction
    ```

5. **Levantar ambiente local:**
    ```bash
    symfony server:start
    # o
    php -S localhost:8000 -t public
    ```
6. **Levantar ambiente de testing:**
    ```bash
    # Ejecutar tests
    ./bin/phpunit
    ```

## 🚀 Listado de Endpoints

-   Listado de Productos

    ```
    GET /products

    GET /products?name=nombre_a_buscar&page=1&limit=5
    ```

-   Creacion de Producto

    ```
    POST /products
    ```

    Cuerpo de la peticion

    ```javascript
    {
      "name": "Producto A",
      "price": 80.66,
      "taxRate": 21
    }
    ```

    Encabezados (Headers):

    ```
    Authorization: Bearer admintoken
    Content-Type: application/json
    ```

## 🙏 Agradecimientos

Gracias a **sudespacho .net** por considerarme en el proceso de selección. ¡Ha sido un placer participar!
