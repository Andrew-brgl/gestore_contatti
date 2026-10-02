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

 - un contatto puo essere invitato ad un evento come ospite speciale (ovvero le persone che saliranno sul palco a parlare) oppure come semplice invitato
 - un semplice invitato una volta ricevuto l'invito puo decidere se: confermare e venire di persona, delegare un altra persona, confermare a nome di un intero gruppo ed in questo caso deve specificare il numero di persone che verranno
 - bisogna tenere poter tenere traccia di quante volte un invitato abbia accettato l'invito e di quante volte si sia effettivamente presentato all'evento


## 3. Progettazione della base di dati

Lo schema ER utilizzato per la progettazione della base di dati è il seguente:

[Schema ER](schema_ER.pdf)

Descrizione delle entità e delle relazioni principali.

## 4. Implementazione

Descrizione di ciò che è stato effettivamente realizzato:
- database PostgreSQL;
- migration Laravel;
- modelli Eloquent;
- relazioni;
- vincoli;
- eventuali scelte progettuali.