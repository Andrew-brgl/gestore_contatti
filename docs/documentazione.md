# Documentazione del progetto Gestore Contatti

## 1. Descrizione del progetto

Il progetto consiste nella realizzazione della base di una web application
per la gestione di contatti e delle relative informazioni.

L'applicazione è stata sviluppata utilizzando Laravel come framework
backend e PostgreSQL come sistema di gestione della base di dati.

In questa prima fase del progetto il lavoro si è concentrato principalmente
sulla progettazione della base di dati, sulla sua implementazione tramite
Laravel Migrations e sulla definizione dei relativi modelli Eloquent.

## 2. Requisiti principali

Il sistema deve permettere di memorizzare e gestire le informazioni
relative ai contatti, eventi e gli inviti dei vari contatti agli eventi.

 - un contatto può essere invitato ad un evento come ospite speciale (ovvero le persone che saliranno sul palco a parlare) oppure come semplice invitato
 - un semplice invitato una volta ricevuto l'invito puo decidere se: confermare e venire di persona, delegare un' altra persona oppure confermare a nome di un intero gruppo ed in questo caso deve specificare il numero di persone che verranno all'evento
 - bisogna poter tenere traccia di quante volte un invitato abbia accettato l'invito e di quante volte si sia effettivamente presentato all'evento


## 3. Progettazione della base di dati

Lo schema ER utilizzato per la progettazione della base di dati è il seguente:

[Schema ER](schema_ER.pdf)

Precisazioni e specificazioni riguardanti lo schema ER:

- l'entità delegato non è intesa come una persona fisica, ma come la persona che sostituisce l'invitato X **solamente** all'evento Z;
- i campi con l'asterisco sono intesi come campi obbligatori, mentre gli altri sono opzionali;
- gli attributi sottolineati rappresentano le **superchiavi** dello schema. Nell'implementazione vengono tradotti in vincoli `UNIQUE`. Quando una superchiave è composta da più attributi, il vincolo riguarda la loro combinazione, non ciascun attributo preso singolarmente. La chiave primaria utilizzata nell'implementazione è invece il campo `id`, aggiunto a ogni tabella del dominio, come spiegato nella sezione seguente.

## 4. Implementazione

Descrizione di ciò che è stato realizzato:

- definizione dei vincoli;
- schema ER;
- database PostgreSQL;
- migration Laravel;
- modelli Eloquent.

### 4.1. Convenzioni per i nomi di tabelle e relazioni

Nel passaggio dallo schema ER all'implementazione sono state adottate le
best practice e le convenzioni di Laravel per la scelta dei nomi.
Le tabelle che rappresentano le entità hanno nomi in inglese, al plurale
e in `snake_case`, come `contacts`, `categories`, `events` ed `event_types`.
I modelli Eloquent hanno invece nomi al singolare in `PascalCase`, come
`Contact`, `Category`, `Event` ed `EventType`. In questo modo Eloquent può
ricavare automaticamente il nome della tabella dal modello, secondo le
[convenzioni documentate da Laravel](https://laravel.com/docs/13.x/eloquent#table-names).

Per le associazioni molti-a-molti sono state create tabelle ponte.
I nomi `category_contact` e `contact_event` seguono la
convenzione che unisce i nomi singolari dei due modelli in ordine
alfabetico. Le tabelle `contact_invitation_receive` e
`contact_invitation_confirm` aggiungono rispettivamente i suffissi
`receive` e `confirm` per distinguere la ricezione dalla conferma
dell'invito. Questi nomi sono specificati esplicitamente nei metodi
`belongsToMany`, come consentito dalla
[documentazione sulle relazioni molti-a-molti](https://laravel.com/docs/13.x/eloquent-relationships#many-to-many).

Queste scelte rendono più immediata la lettura dello schema e del codice,
riducono la necessità di configurazioni personalizzate e facilitano la
manutenzione da parte di chi conosce Laravel.

### 4.2. Chiavi primarie e vincoli di unicità

Rispetto allo schema ER, ogni tabella del dominio, comprese le tabelle
ponte, è stata dotata di un campo `id` come chiave primaria (**PK**),
definito nelle migration con `$table->id()`.

Questa scelta segue la convenzione di Eloquent, che utilizza `id` come
chiave primaria predefinita e non supporta nativamente chiavi primarie
composte nei modelli.

### 4.3. Nomi e riferimenti delle chiavi esterne

Le chiavi esterne (**FK**) sono state chiamate usando il nome singolare
dell'entità referenziata in `snake_case`, seguito dal suffisso `_id`.
Per esempio, `event_type_id` indica un riferimento alla colonna `id`
della tabella `event_types`. Questa convenzione rende riconoscibile la
destinazione del collegamento ed è coerente con le relazioni Eloquent.