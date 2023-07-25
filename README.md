<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300"></a></p>

# BoolBnb

## Passaggi da seguire
- Installare le dipendenze del progetto
```
npm i
``` 
nel caso restituisca errore forzare
```
npm install --force
```    
```
composer i
 ```
- Creare un dabase da `phpMyAdmin`.
- Duplicare e compilare il file `.env` collegandolo al proprio database:
- Generare una nuova chiave "`APP_KEY`" lanciando il comando 
```
php artisan key:generate
```
- Nel file `.env` cambiare il `FILESYSTEM_DISK` da "local" a "**Public**"
- Lanciare il server utilizzando: 
```
npm run dev
```
```
php artisan serve
```
- Creare il Symlink "storage" nella cartella public con il seguente comando
```
php artisan storage:link
```
- Lanciare nel proprio db le migration necessarie al funzionamento dell'app.
```
php artisan migrate
```

---
# 13 luglio 2023

5 fake users sono:

- CassioSabbatini@admin.it

- MichelangeloMazzi@admin.it

- AthosPadovano@admin.it

- TommasoCalabrese@admin.it

- AnnaDellucci@admin.it

  Per tutti la password è: `0000`

---

Per poter popolare le tabelle con dati Fake, dopo aver lanciato le migration utilizzare il comando 
```
php artisan db:seed
```

per aggiornare le tabelle e ripopolarle
```
php artisan migrate:refresh --seed
```

Una volta sacaricato il progetto inserire nel file .env la propria api key del tomtom nel campo `API_TT_KEY`
https://developer.tomtom.com/user/me/apps

Se durante la fase di creazione di un nuovo appartamento l'immagine non viene visualizzata, assicurarsi che nel file `.env` la costante `FILESYSTEM_DISK` sia inpostata su public


---
installare il vue-router
```
npm i vue-router@4 --force
```
---
aggiornamento 24 luglio impementazione mappa Tom-Tom 
```
npm i --force
```
---
--------------------------
AGGIORNAMENTO AL 25/07/2023
## Implementato sistema di pagamento con Braintree
Installare le dipendenze necessarie utilizzando il comando:

```
composer require braintree/braintree_php
```

- Registrarsi a Braintree per recuperare le proprie credenziali
- Dal file `.env.example` recuperarare le seguenti variabili, inserirle nel `.env` e valorizzarle con i propri dati  :
```
BT_ENVIRONMENT = 'sandbox'
BT_MERCHANT_ID = ''
BT_PUBLIC_KEY = ''
BT_PRIVATE_KEY = ''
```
- Come dati della carta di credito inserire i seguenti 
```
Numero carta : 4242 4242 4242 4242
Data di scadenza : Una qualsiasi 
```



