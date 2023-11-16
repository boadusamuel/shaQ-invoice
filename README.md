
#  Invoicing REST Backend API

## Setup
1. **Clone Repository:**
   ```bash
   git clone https://github.com/boadusamuel/shaQ-invoice.git
   ```
   
2. **Install composer dependencies:**
   ```bash
   cd shaQ-invoice
   composer install
   ```
   
3. **Copy Env file:**
   ```bash
   cp .env.example .env
   ```
   
4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```
   Make sure to update the .env file with your database configuration settings before running the application.


5. **Migrate and Seed Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```
This will seed the database with default data of which a **User** will be created for **authentication** and **authorization**.

6. **Run Application:**
   ```bash
   php artisan serve
   ```

## User Authentication

##  Login

### Endpoint
- **URL:** `/login`

### Request
- **Method:** POST

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
    "email": "admin@email.com",
    "password": "password"
  }
  ```

### Response
- **Status Code:** `200 OK`
#### Body
- **Type:** json
``` json
{
    "success": true,
    "data": {
        "token": "1|4HGQlEOQhyrRaRCKxNfII5AStFKE4lFgun6iiz0v8488f6fe",
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@email.com"
        }
    }
}
```

 Logout
-----------

### Endpoint

-   URL: `/logout`

### Authorization

-   Type: Bearer Token
-   Token: (Include the user's token in the Authorization header)

### Request

-   Method: POST

#### Headers

-   Accept: `application/json`

### Response
- **Status Code:** `204  NO CONTENT`


##  Items

Items for which invoices could be generated for.

###  Get List of Items

#### Endpoint
- **URL:** `/items`

#### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

#### Request
- **Method:** GET

##### Headers
- **Accept:** `application/json`

##### Query Params
- **name:** George
- **perPage:** 10
- **page:** 1


### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Milo",
            "price": "14.00",
            "quantity": 20,
            "description": "Cocoa Powder",
            "createdAt": "2023-11-15 17:21:46",
            "updatedAt": "2023-11-15 18:17:29"
        },
        {
            "id": 11,
            "name": "Maggi",
            "price": "14.00",
            "quantity": 20,
            "description": "Cube",
            "createdAt": "2023-11-15 18:17:41",
            "updatedAt": "2023-11-15 18:17:41"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1.0/items?page=1",
        "last": "http://localhost:8000/api/v1.0/items?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1.0/items?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1.0/items",
        "per_page": 20,
        "to": 11,
        "total": 11
    }
}
```

##  Add Item Quantity

### Endpoint
- **URL:** `/items/:itemId/increment-quantity`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)


### Request
- **Method:** PUT

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "quantity": 20
  }
  ```

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Nano tape",
        "price": 1.58,
        "quantity": 420,
        "description": "Solid Tape.",
        "createdAt": "2023-11-14 19:38:21",
        "updatedAt": "2023-11-14 20:11:03"
    }
}
```
##  Update Item

### Endpoint
- **URL:** `/items/:itemId/`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** PUT

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "quantity": 20,
      "price": 14
  }

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Nano tape",
        "price": 14,
        "quantity": 20,
        "description": "Solid Tape.",
        "createdAt": "2023-11-14 19:38:21",
        "updatedAt": "2023-11-14 20:11:03"
    }
}
```
##  Get Item

### Endpoint
- **URL:** `/items/:itemId/`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** GET

#### Headers
- **Accept:** `application/json`

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Nano tape",
        "price": 14,
        "quantity": 20,
        "description": "Solid Tape.",
        "createdAt": "2023-11-14 19:38:21",
        "updatedAt": "2023-11-14 20:11:03"
    }
}
```

##  Create Item

### Endpoint
- **URL:** `/items`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** POST

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "name": "Maggi",
      "quantity": 20,
      "price": 14,
      "description": "Solid Tape."
  }

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Nano tape",
        "price": 14,
        "quantity": 20,
        "description": "Solid Tape.",
        "createdAt": "2023-11-14 19:38:21",
        "updatedAt": "2023-11-14 20:11:03"
    }
}
```

##  Get Customers

### Endpoint
- **URL:** `/customers`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** GET

#### Headers
- **Accept:** `application/json`

#### Query Params
- **name:** George
- **perPage:** 2
- **page:** 2

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Trent Fahey",
            "phone": "+19294922535",
            "createdAt": "2023-11-15 17:21:46",
            "updatedAt": "2023-11-15 17:21:46"
        },
        {
            "id": 2,
            "name": "Valerie Reichert",
            "phone": "+1-541-608-1705",
            "createdAt": "2023-11-15 17:21:46",
            "updatedAt": "2023-11-15 17:21:46"
        },
        {
            "id": 11,
            "name": "samuel",
            "phone": "0244449933",
            "createdAt": "2023-11-15 18:22:41",
            "updatedAt": "2023-11-15 18:22:41"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1.0/customers?page=1",
        "last": "http://localhost:8000/api/v1.0/customers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1.0/customers?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1.0/customers",
        "per_page": 20,
        "to": 11,
        "total": 11
    }
}
```

## Get Customer

### Endpoint
- **URL:** `/customers/:customerId`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** GET

#### Headers
- **Accept:** `application/json`

### Response
- **Status Code:** 200 OK
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Trent Fahey",
        "phone": "+19294922535",
        "createdAt": "2023-11-15 17:21:46",
        "updatedAt": "2023-11-15 17:21:46"
    }
}
```

##  Create Customer

### Endpoint
- **URL:** `/customers`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** POST

#### Headers
- **Accept:** `application/json`


#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "name": "samuel",
      "phone": "0244449933"
  }

### Response

-   Status Code: 201 CREATED

#### Body

-   Type: json
```json
{
    "success": true,
    "data": {
        "id": 11,
        "name": "samuel",
        "phone": "0244449933",
        "createdAt": "2023-11-15 18:22:41",
        "updatedAt": "2023-11-15 18:22:41"
    }
}
```


##  Generate Invoice

### Endpoint
- **URL:** `/invoices`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** POST

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "customerId": 1,
      "issueDate": "2023-11-14",
      "dueDate": "2023-11-14",
      "items": [
          {
              "itemId": 1,
              "price": "11",
              "quantity": 10,
              "description": "Nice to have"
          },
          {
              "itemId": 2,
              "price": "20.4",
              "quantity": 10,
              "description": "quality show"
          }
      ]
  }
  ```

### Response

-   Status Code: 201 CREATED

#### Body

-   Type: json
```json
{
    "success": true,
    "data": {
        "id": 27,
        "invoiceNumber": "INV00027",
        "total": "124.00",
        "customer": {
            "id": 1,
            "name": "Prof. Devin Renner",
            "phone": "630.530.2149",
            "createdAt": "2023-11-15 07:44:25",
            "updatedAt": "2023-11-15 07:44:25"
        },
        "items": [
            {
                "id": 75,
                "itemName": "Otha Cruickshank",
                "unitPrice": "11.00",
                "quantity": 2,
                "amount": "22.00",
                "description": "Nice to have"
            },
            {
                "id": 76,
                "itemName": "Gonzalo Deckow",
                "unitPrice": "20.40",
                "quantity": 5,
                "amount": "102.00",
                "description": "quality show"
            }
        ],
        "issueDate": "2023-11-14",
        "dueDate": "2023-11-14",
        "createdAt": "2023-11-15 10:22:32"
    }
}
```

##  Update Invoice Items

### Endpoint
- **URL:** `/invoices/:invoiceId/items`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** PUT

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "items": [
          {
              "itemId": 1,
              "price": "20",
              "quantity": 10,
              "description": "Nice to have"
          },
          {
              "itemId": 2,
              "price": "20.4",
              "quantity": 5,
              "description": "quality show"
          }
      ]
  }
  ```

### Response
- **Status Code:** 200 OK

#### Body
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 44,
        "invoiceNumber": "INV00044",
        "total": "302.00",
        "customer": {
            "id": 1,
            "name": "Prof. Devin Renner",
            "phone": "630.530.2149",
            "createdAt": "2023-11-15 07:44:25",
            "updatedAt": "2023-11-15 07:44:25"
        },
        "items": [
            {
                "id": 99,
                "itemName": "Otha Cruickshank",
                "unitPrice": "20.00",
                "quantity": 10,
                "amount": "200.00",
                "description": "Nice to have"
            },
            {
                "id": 103,
                "itemName": "Gonzalo Deckow",
                "unitPrice": "20.40",
                "quantity": 5,
                "amount": "102.00",
                "description": "quality show"
            }
        ],
        "issueDate": "2023-11-14",
        "dueDate": "2023-11-15",
        "createdAt": "2023-11-15 14:18:28"
    }
}
```

### Error Response - Update Invoice Items Insufficient Stock
- **Status Code:** 422 UNPROCESSABLE CONTENT

#### Body
- **Type:** json
```json
{
    "message": "Insufficient stock for the selected item with ItemId: 2. Available Stock: 4900",
    "errors": {
        "items": [
            "Insufficient stock for the selected item with ItemId: 2. Available Stock: 4900"
        ]
    }
}
```

##  Update Invoice

### Endpoint
- **URL:** `/invoices/:invoiceId`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** PUT

#### Headers
- **Accept:** `application/json`

#### Body
- **Type:** raw (json)
- **Content-Type:** `application/json`
- **Body:**
  ```json
  {
      "customerId": 1,
      "issueDate": "2023-11-14",
      "dueDate": "2023-11-15"
  }
  ```

### Response
- **Status Code:** 200 OK
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 11,
        "invoiceNumber": "INV00011",
        "total": "130.00",
        "customer": {
            "id": 2,
            "name": "John Doe",
            "phone": "+1234567890",
            "createdAt": "2023-11-01 12:34:56",
            "updatedAt": "2023-11-01 12:34:56"
        },
        "items": [
            {
                "id": 21,
                "itemName": "Product A",
                "unitPrice": "30.00",
                "quantity": 3,
                "amount": "90.00",
                "description": "New description"
            },
            {
                "id": 22,
                "itemName": "Product B",
                "unitPrice": "20.00",
                "quantity": 2,
                "amount": "40.00",
                "description": "Updated description"
            }
        ],
        "issueDate": "2023-11-14",
        "dueDate": "2023-11-30",
        "createdAt": "2023-11-10 15:45:00",
        "updatedAt": "2023-11-11 09:30:15"
    }
}
```

## Delete Invoice

### Endpoint
- **URL:** `/invoices/:invoiceId`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** DELETE

#### Headers
- **Accept:** `application/json`

### Response
- **Status Code:** `204 No Content`


## Get Invoice

### Endpoint
- **URL:** `/invoices/:invoiceId`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** GET

#### Headers
- **Accept:** `application/json`

### Response
- **Status Code:** 200 OK
- **Type:** json
```json
{
    "success": true,
    "data": {
        "id": 11,
        "invoiceNumber": "INV00011",
        "total": "130.00",
        "customer": {
            "id": 2,
            "name": "John Doe",
            "phone": "+1234567890",
            "createdAt": "2023-11-01 12:34:56",
            "updatedAt": "2023-11-01 12:34:56"
        },
        "items": [
            {
                "id": 21,
                "itemName": "Product A",
                "unitPrice": "30.00",
                "quantity": 3,
                "amount": "90.00",
                "description": "New description"    
            },
            {
                "id": 22,
                "itemName": "Product B",
                "unitPrice": "20.00",
                "quantity": 2,
                "amount": "40.00",
                "description": "Updated description"
            }
        ],
        "issueDate": "2023-11-14",
        "dueDate": "2023-11-30",
        "createdAt": "2023-11-10 15:45:00",
        "updatedAt": "2023-11-11 09:30:15"  
    }
}
```

##  Get Invoices

### Endpoint
- **URL:** `/invoices`

### Authorization
- **Type:** Bearer Token
- **Token:** (Include the user's token in the Authorization header)

### Request
- **Method:** GET

#### Headers
- **Accept:** `application/json`

### Query Params
- **customerId:** 1

### Response
- **Status Code:** 200 OK
- **Type:** json
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "invoiceNumber": "INV00001",
            "total": "3.00",
            "customer": {
                "id": 5,
                "name": "Mr. Seamus Tromp",
                "phone": "+13398755812",
                "createdAt": "2023-11-15 17:21:46",
                "updatedAt": "2023-11-15 17:21:46"
            },
            "issueDate": "2021-04-17",
            "dueDate": "1998-08-09",
            "createdAt": "2023-11-15 17:21:46"
        },
        {
            "id": 2,
            "invoiceNumber": "INV00002",
            "total": "2.00",
            "customer": {
                "id": 4,
                "name": "Lindsey Wiza",
                "phone": "940-998-0817",
                "createdAt": "2023-11-15 17:21:46",
                "updatedAt": "2023-11-15 17:21:46"
            },
            "issueDate": "2023-09-16",
            "dueDate": "2015-09-19",
            "createdAt": "2023-11-15 17:21:46"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1.0/invoices?page=1",
        "last": "http://localhost:8000/api/v1.0/invoices?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1.0/invoices?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1.0/invoices",
        "per_page": 20,
        "to": 11,
        "total": 11
    }
}
```







