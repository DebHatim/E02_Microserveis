# CREAR USUARI PER POST

# url
http://localhost/api/usuari

# estructura
{
"nom": "jaime",
"email": "jaime@gmail.com"
}

# CREAR LOCALITZACIO PER POST

# url
http://localhost/api/localitzacio

# estructura
{
"nom": "Lloc",
"direccio": "Omplir direccio",
"ciutat": "Mataro",
"capacitat": 300
}

# CREAR ESPECTACLE PER POST

# url
http://localhost/api/espectacle

# estructura
{
"nom": "NOM EXEMPLE",
"poster": "https://cdn-p.smehost.net/sites/a8928da38df6414aae98564041b07ae0/wp-content/uploads/2024/10/image-31.png",
"horainici": "2025-5-23 20:00:00",
"horafinal": "2025-5-24 00:00:00",
"localitzacio": "Lloc"
}

# CREAR SEIENT PER POST

# url
http://localhost/api/seient

# estructura
{
"numero": 4,
"fila": 1,
"tipus": "Normal",
"localitzacio": "Lloc"
}

# CREAR ENTRADA PER POST

# url
http://localhost/api/entrada

# estructura
{
"ref": "123412341234123",
"preu": 90.00,
"espectacle": "CHROMAKOPIA",
"seient": 4,
"estat": "Disponible"
}

# CREAR COMPRA PER POST

# url
http://localhost/api/compra

# estructura
{
"usuari": "jaime.com",
"metodepagament": "Yen",
"ref": "123412341234123"
}

# ELIMINAR USUARI PER DELETE

# url
http://localhost/api/usuari

# estructura
{
"email": "jaime@gmail.com"
}

# ELIMINAR LOCALITZACIO PER DELETE

# url
http://localhost/api/localitzacio

# estructura
{
"nom": "Mercadona"
}

# ELIMINAR ESPECTACLE PER DELETE

# url
http://localhost/api/espectacle

# estructura
{
"nom": "The Ruby Experience"
}

# ELIMINAR SEIENT PER DELETE

# url
http://localhost/api/seient

# estructura
{
"id": 2
}

# ELIMINAR ENTRADA PER DELETE

# url
http://localhost/api/entrada

# estructura
{
"ref": "323161395451321"
}

# ELIMINAR COMPRA PER DELETE

# url
http://localhost/api/compra

# estructura
{
"id": 1
}

# ACTUALITZAR USUARI PER UPDATE

# url
http://localhost/api/usuari

# estructura
{
"id": 1,
"nom": "HATIM2",
"email": "hatim2@gmail.com",
"telefon": 123123123,
}

# ACTUALITZAR LOCALITZACIO PER UPDATE

# url
http://localhost/api/localitzacio

# estructura
{
"id": 1,
"nom": "Paris",
"direccio": "por aqui al lado",
"ciutat": "Europa",
"capacitat": 200,
}

# ACTUALITZAR ESPECTACLE PER UPDATE

# url
http://localhost/api/espectacle

# estructura
{
"id": 1,
"nom": "Long. Live. A$AP",
"poster": "https://fiu-original.b-cdn.net/fontsinuse.com/use-images/171/171398/171398.jpeg?filename=91gcxyWHyiL._SL1500_.jpg",
"horaInici": "2025-6-21 14:00:00",
"horaFinal": "2025-5-21 18:30:00",
"localitzacio": "Paris"
}

# ACTUALITZAR SEIENT PER UPDATE

# url
http://localhost/api/seient

# estructura
{
"id": 1,
"fila": "1",
"numero": "5",
"tipus": "VIP",
"localitzacio": "Paris"
}

# ACTUALITZAR ENTRADA PER UPDATE

# url
http://localhost/api/entrada

# estructura no he puesto compra_id asi lo dejo que solo se cambie al comprar
{
"id": 1,
"ref": "987698769876987",
"estat": "Disponible",
"preu": 90.00,
"espectacle": "Long. Live. A$AP",
"seient_id": 1
}

# ACTUALITZAR COMPRA PER UPDATE

# url
http://localhost/api/compra

# estructura
{
"id": 1,
"dataCompra": "2025-5-23 20:00:00",
"metodepagament": "PalPay",
"usuari": "hatim2@gmail.com"
}