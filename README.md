# AMACARS — Laravel + React

Il backend resta in Laravel (routing, database, modelli e pannello Filament). La home pubblica è stata spostata in React; Blade serve solo da pagina contenitore per montare l'app React.

## Prima di iniziare

- PHP 8.3 o superiore e Composer
- Node.js LTS e npm
- Il database già configurato per il progetto

## Installazione locale

1. Apri questa cartella nel terminale.
2. Installa le dipendenze PHP e JavaScript:

   ```bash
   composer install
   npm install
   ```

3. Crea il file di configurazione locale, se non esiste:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Su PowerShell, per copiare il file: `Copy-Item .env.example .env`.

4. Configura nel `.env` il database che usi davvero (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`). Non condividere il `.env` e non inserirlo su Git.
5. Esegui le migrazioni solo dopo aver verificato che il database indicato sia quello corretto:

   ```bash
   php artisan migrate
   ```

6. Crea il collegamento pubblico alle immagini caricate:

   ```bash
   php artisan storage:link
   ```

7. Avvia in due terminali separati:

   ```bash
   php artisan serve
   ```

   ```bash
   npm run dev
   ```

   Apri l'indirizzo mostrato da `php artisan serve`. Per una build da produzione usa `npm run build`.

## Immagini delle auto: cosa è stato corretto

Il campo Filament `images` salva i file nel disco `public`, normalmente sotto `storage/app/public/cars`. Nel database `car_images.image` deve contenere un percorso relativo, per esempio `cars/nome-file.jpg`, non un oggetto `CarImage` e non un URL completo.

I problemi nel vecchio Blade erano:

- `$car->images[0]` è un modello `CarImage`, non una stringa con il percorso del file. Il percorso corretto era `$car->images[0]->image`.
- La relazione può essere vuota; occorre controllare `isNotEmpty()`/`isNotEmpty` o usare un fallback.
- La home dello slider usava `$car->mileage`, mentre il campo del progetto è `km`.
- Se manca `public/storage`, gli URL `/storage/...` non raggiungono i file.
- La schermata di modifica auto non ricaricava e risalvava correttamente la lista dei percorsi immagini. La pagina di modifica è stata aggiornata per sincronizzare le righe `car_images`.

Ora Laravel carica la relazione `images` assieme alle auto e passa a React un array di URL pubblici. Il componente React mostra un segnaposto se non c'è una foto o se il browser riceve un errore nel caricarla.

Se alcune foto già caricate ancora non appaiono, controlla:

1. In `storage/app/public/cars` esiste il file effettivo?
2. In `car_images.image` il valore assomiglia a `cars/foto.jpg`?
3. Esiste il collegamento `public/storage`? Esegui `php artisan storage:link` se manca.
4. Apri l'URL dell'immagine direttamente nel browser. Se dà 404, è un problema di percorso/file/collegamento, non di React.
5. Se i file sono stati salvati in un'altra directory o in un altro server, spostali o aggiorna i percorsi nel database dopo aver fatto un backup.

## Dove si trova il codice React

- `resources/js/app.jsx`: componenti React della home (menu, slider, scheda auto, footer).
- `resources/views/app.blade.php`: contenitore HTML minimale e dati iniziali generati da Laravel.
- `app/Http/Controllers/HomeController.php`: legge le auto dal database e prepara i dati per React.
- `routes/web.php`: indirizzo `/` che richiama il controller.
- `resources/css/app.css`: stili Tailwind.
- `vite.config.js`: collega Vite, Laravel e React.

## Comandi principali

### Laravel / Artisan

```bash
php artisan serve                 # server di sviluppo
php artisan route:list            # mostra le rotte
php artisan make:controller NomeController
php artisan make:model Nome -m    # modello + migration
php artisan make:migration add_campo_to_cars_table
php artisan migrate               # applica migrazioni
php artisan migrate:status        # stato migrazioni
php artisan make:filament-resource Nome
php artisan storage:link          # collegamento file pubblici
php artisan optimize:clear        # pulisce cache di configurazione/rotte/view
php artisan test                  # test automatici
```

Non usare `migrate:fresh` su un database con dati da conservare: elimina tutte le tabelle e le ricrea.

### React / npm

```bash
npm install       # installa le dipendenze definite nel package.json
npm run dev       # Vite in sviluppo, aggiornamento rapido del browser
npm run build     # crea i file ottimizzati in public/build
npm run           # elenca gli script disponibili
```

Quando aggiungi una libreria React: `npm install nome-pacchetto`. Per rimuoverla: `npm uninstall nome-pacchetto`.

## React spiegato con esempi

### 1. Componenti

Un componente è una funzione che restituisce una parte dell'interfaccia. I componenti di questo sito sono `Navbar`, `CarCard`, `FeaturedSlider` e `Footer`.

```jsx
function Saluto({ nome }) {
    return <h1>Ciao {nome}!</h1>;
}

// Uso: <Saluto nome="Marco" />
```

`nome` è una prop: un dato ricevuto dal componente genitore. Le parentesi graffe `{nome}` inseriscono un valore JavaScript nell'HTML JSX.

### 2. JSX

JSX sembra HTML, ma è sintassi JavaScript. Alcune differenze:

- `className` al posto di `class`.
- `onClick={...}` per gli eventi.
- Le espressioni JavaScript vanno tra `{}`.
- Le liste di elementi si generano con `.map()` e ogni elemento deve avere una `key` stabile.

```jsx
{cars.map((car) => (
    <p key={car.id}>{car.brand} {car.model}</p>
))}
```

### 3. Stato con `useState`

Lo stato è un dato che può cambiare mentre la pagina è aperta. Quando cambia, React aggiorna la parte di interfaccia che dipende da esso.

```jsx
const [contatore, setContatore] = useState(0);

<button onClick={() => setContatore(contatore + 1)}>
    Cliccato {contatore} volte
</button>
```

Non modificare direttamente lo stato (per esempio `contatore++`): usa la funzione `setContatore`.

### 4. Effetti con `useEffect`

`useEffect` serve per attività esterne al semplice rendering, come timer, eventi o richieste HTTP. Se crei un timer, restituisci una funzione di pulizia per fermarlo quando non serve più. Lo slider del sito usa questo approccio per cambiare auto ogni cinque secondi.

### 5. Condizioni

```jsx
{car.images?.length > 0
    ? <img src={car.images[0]} alt={`${car.brand} ${car.model}`} />
    : <p>Foto non disponibile</p>}
```

`condizione ? A : B` sceglie tra due contenuti. `?.` evita un errore se `images` è `null`/`undefined`.

### 6. Laravel e React: chi fa cosa?

- **Laravel** valida le richieste, controlla l'accesso, legge/scrive nel database e gestisce i file.
- **React** costruisce la parte interattiva che l'utente vede nel browser.
- **Vite** compila JSX e CSS e aggiorna la pagina mentre sviluppi.
- In questo progetto Laravel prepara i dati delle auto e li passa alla pagina contenitore; React li usa per mostrare slider e schede. Non sono stati convertiti il pannello amministrativo Filament né i suoi form: restano gestiti da Laravel/Filament.

Per funzionalità nuove che devono salvare dati (per esempio un modulo contatti React), il browser dovrà inviare una richiesta HTTP a una rotta Laravel; Laravel deve validare e autorizzare la richiesta prima di salvare.

## Nota

Il numero WhatsApp è lasciato generico perché il progetto originale conteneva un segnaposto, non un numero reale. Imposta il numero aziendale nel formato internazionale, solo cifre, prima di pubblicare il sito.
