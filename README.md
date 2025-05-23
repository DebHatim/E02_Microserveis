# Arrancar projecte:
1. Crear base de dades E01_DebbounHatim_Entrada, usuari usr_generic amb contrassenya 2025@Thos i 
donarli permisos per la base de dades

CREATE DATABASE if not exists E01_DebbounHatim_Entrada;
-- CREATE USER 'usr_generic'@'localhost' IDENTIFIED BY '2025@Thos';
GRANT ALL PRIVILEGES ON `E01\_DebbounHatim\_Entrada`.* TO 'usr_generic'@'localhost';

3. A la terminal, executar: php bin/doctrine.php orm:schema-tool:create

4. Insertar per terminal: php src/Fixture/insert_inicial.php

# ###################
## PETICIO PDF
http://localhost/?ref=123456789123456

# ###################

## PETICIO DATA
http://localhost/?data=2025-05-19
# ###################

# URL CRUD
http://localhost/api/usuari o /api/localitzacio - /api/espectacle - /api/seient - /api/entrada - /api/compra

# ###################
## CONSULTAR AMB GETAA
# ###################

## USUARI

### Consultar tots els usuaris: 
http://localhost/api/usuari
### Consultar usuari amb id:
http://localhost/api/usuari/1

## LOCALITZACIO

### Consultar totes les localitzacions:
http://localhost/api/localitzacio
### Consultar localitzacio amb id:
http://localhost/api/localitzacio/1

## ESPECTACLE

### Consultar tots els espectacles:
http://localhost/api/espectacle
### Consultar espectacle amb id:
http://localhost/api/espectacle/1

## SEIENT

### Consultar tots els seients:
http://localhost/api/seient
### Consultar seient amb id:
http://localhost/api/seient/1

## ENTRADA

### Consultar totes les entrades:
http://localhost/api/entrada
### Consultar entrada amb id:
http://localhost/api/entrada/1

## COMPRA

### Consultar totes les compres:
http://localhost/api/compra
### Consultar compres amb id:
http://localhost/api/compra/1

# ###################
# CREAR PER POST
# ###################

### estructura usuari
{
"nom": "jaime",
"email": "jaime@gmail.com",
"telefon": "+34666111222"
}

### estructura localitzacio
{
"nom": "Lloc",
"direccio": "Omplir direccio",
"ciutat": "Mataro",
"capacitat": 300
}

### estructura espectacle
{
"nom": "NOM EXEMPLE",
"poster": "https://cdn-p.smehost.net/sites/a8928da38df6414aae98564041b07ae0/wp-content/uploads/2024/10/image-31.png",
"horainici": "2025-5-23 20:00:00",
"horafinal": "2025-5-24 00:00:00",
"localitzacio": "Lloc"
}

### estructura seient
{
"numero": 4,
"fila": 1,
"tipus": "Normal",
"localitzacio": "Lloc"
}

### estructura entrada
{
"ref": "123412341234123",
"preu": 90.00,
"espectacle": "CHROMAKOPIA",
"seient_id": 4
}

### estructura compra
{
"usuari": "jaime.com",
"metodepagament": "Yen",
"ref": "123412341234123"
}

# ###################
# ELIMINAR PER DELETE
# ###################

### estructura usuari
{
"email": "jaime@gmail.com"
}

### estructura localitzacio
{
"nom": "Mercadona"
}

### estructura espectacle
{
"nom": "The Ruby Experience"
}

### estructura seient
{
"id": 2
}

### estructura entrada
{
"ref": "323161395451321"
}

### estructura compra
{
"id": 1
}

# ###################
# ACTUALITZAR PER PUT
# ###################

### estructura usuari
{
"id": 1,
"nom": "HATIM2",
"email": "hatim2@gmail.com",
"telefon": "+34123123123",
}

### estructura localitzacio
{
"id": 1,
"nom": "Paris",
"direccio": "por aqui al lado",
"ciutat": "Europa",
"capacitat": 200,
}

### estructura espectacle
{
"id": 1,
"nom": "Long. Live. A$AP",
"poster": "https://fiu-original.b-cdn.net/fontsinuse.com/use-images/171/171398/171398.jpeg?filename=91gcxyWHyiL._SL1500_.jpg",
"horaInici": "2025-6-21 14:00:00",
"horaFinal": "2025-5-21 18:30:00",
"localitzacio": "Paris"
}

### estructura seient
{
"id": 1,
"fila": "1",
"numero": "5",
"tipus": "VIP",
"localitzacio": "Paris"
}

### estructura entrada, no he puesto compra_id asi lo dejo que solo se cambie al comprar
{
"id": 1,
"ref": "987698769876987",
"estat": "Disponible",
"preu": 90.00,
"espectacle": "Long. Live. A$AP",
"seient_id": 1
}

### estructura compra
{
"id": 1,
"dataCompra": "2025-5-23 20:00:00",
"metodepagament": "PalPay",
"usuari": "hatim2@gmail.com"
}