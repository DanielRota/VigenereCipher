Daniel Rota 5IC - Sistemi e Reti - ITIS P. Paleocapa A.S. 2022/2023

<h1>CIFRARIO DI VIGENÈRE</h1>

<h2>INTRODUZIONE GENERALE</h2>

L'algoritmo di cifratura rientra nei cifrari a sostituzione monoalfabetica e rappresenta una generalizzazione del Cifrario di Cesare.

<h2>FUNZIONAMENTO</h2>

Esso basa il proprio funzionamento su una chiave simmetrica, detta <i>Verme</i>. Questa stringa, ricevuta in input dall'utente, viene inizialmente modificata, in modo da presentare la stessa lunghezza del messaggio che si intende cifrare. Ad esempio, se il messaggio da cifrare è 'ciao', e il Verme è 'ab', questo verrà ripetuto diventando 'abab'.

Dopo aver stabilito la Chiave vengono eseguite una serie di iterazioni, ognuna delle quali prende in esame un singolo carattere del messaggio da cifrare. Viene calcolato l'<i>Offset</i> di ogni carattere appartenente alla Chiave, ad esempio quello del carattere "e" corrisponde a 5, mentre quello del carattere "b" a 1; al carattere del messaggio dell'iterazione corrente, viene quindi sommato l'Offset del carattere del Verme avente lo stesso indice.

Esempio:

- Messaggio: 'ciao'
- Verme: 'abc'

La chiave viene inizialmente modificata, in modo che presenti la stessa lunghezza del messaggio, diventa quindi 'abca'.

Messaggio e Chiave vengono divisi carattere per carattere; nella prima iterazione rientrano le lettere "c" e "a". L'Offset del primo carattere del Verme corrisponde a 0, mentre quello del carattere "c" a 2, eseguendo la somma dei due indici si ottiene nuovamente 2, il risultato della prima iterazione rimarrà pertanto invariato rispetto alla lettera del messaggio da cifrare. Gli input della seconda iterazione sono i caratteri "i" e "b", con Offset rispettivamente 8 e 1, dalla somma degli indici risulta il carattere "j", e così via per le lettere rimanenti. 

Si ottiene infine il messaggio cifrato: 'cjco'.
