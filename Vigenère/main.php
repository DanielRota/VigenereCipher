<?php

$_lettere_maiuscole = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$_lettere_minuscole = "abcdefghijklmnopqrstuvwxyz";
$_caratteri_speciali = "#$%&*/<=>@\^_|";
$_punteggiatura = "!()+,-.:;?[]{}";
$_cifre = "0123456789";
$msg = $_POST['testo-originale'];
$verme = $_POST['verme'];
$msg_copia = $msg;
$chars = str_split($msg);

function cifra($verme, $array, $pos, $char)
{
    $index_nuovo_char = strpos($array, strval($char)) + strpos(array_contenitore($verme[$pos]), strval($verme[$pos]));

    if ($index_nuovo_char >= strlen($array)) {
        return $array[$index_nuovo_char - strlen($array)];
    } else {
        return $array[$index_nuovo_char];
    }
}

function decifra($verme, $array, $pos, $char)
{
    $index_nuovo_char = strpos($array, strval($char)) - strpos(array_contenitore($verme[$pos]), strval($verme[$pos]));

    if ($index_nuovo_char < 0) {
        return $array[strlen($array) + $index_nuovo_char];
    } else {
        return $array[$index_nuovo_char];
    }
}

function calcola_verme($msg, $verme)
{
    $verme = str_replace(' ', '', $verme);
    $lunghezza_msg = strlen($msg);
    $lunghezza_verme = strlen($verme);

    if ($lunghezza_msg < $lunghezza_verme) {
        $verme = substr($verme, 0, -($lunghezza_verme - $lunghezza_msg));
    } else if ($lunghezza_msg > $lunghezza_verme) {
        $verme = str_repeat($verme, floor($lunghezza_msg / $lunghezza_verme)) . substr($verme, 0, ($lunghezza_msg % $lunghezza_verme));
    }

    return $verme;
}

function array_contenitore($char)
{
    $_lettere_maiuscole = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $_lettere_minuscole = "abcdefghijklmnopqrstuvwxyz";
    $_caratteri_speciali = "#$%&*/<=>@\^_|";
    $_punteggiatura = "!()+,-.:;?[]{}";
    $_cifre = "0123456789";

    if (str_contains($_lettere_maiuscole, strval($char))) {
        return $_lettere_maiuscole;
    } else if (str_contains($_lettere_minuscole, strval($char))) {
        return $_lettere_minuscole;
    } else if (str_contains($_caratteri_speciali, strval($char))) {
        return $_caratteri_speciali;
    } else if (str_contains($_punteggiatura, strval($char))) {
        return $_punteggiatura;
    } else if (str_contains($_cifre, strval($char))) {
        return $_cifre;
    } else {
        return null;
    }
}

if ($msg == "" || $verme == "") {
    header("location: http://localhost/Vigen%C3%A8re/index.html");
}

if ($_POST['action'] == 'Cifra') {
    if (isset($msg) && isset($verme)) {
        if (isset($_POST['rdb-spazi-vuoti'])) {
            $msg = str_replace(' ', '', $msg);
        }
        $verme = calcola_verme($msg, $verme);
        foreach ($chars as $char) {
            $pos = strpos(strval($msg), strval($char));
            $modified = false;
            if (isset($_POST['rdb-lettere-maiuscole']) && str_contains($_lettere_maiuscole, strval($char))) {
                $risultato_lettere_maiuscole = cifra($verme, $_lettere_maiuscole, $pos, $char);
                $msg[$pos] = $risultato_lettere_maiuscole;
                $modified = true;
            } else if (isset($_POST['rdb-lettere-minuscole']) && str_contains($_lettere_minuscole, strval($char))) {
                $risultato_lettere_minuscole = cifra($verme, $_lettere_minuscole, $pos, $char);
                $msg[$pos] = $risultato_lettere_minuscole;
                $modified = true;
            } else if (isset($_POST['rdb-caratteri-speciali']) && str_contains($_caratteri_speciali, strval($char))) {
                $risultato_caratteri_speciali = cifra($verme, $_caratteri_speciali, $pos, $char);
                $msg[$pos] = $risultato_caratteri_speciali;
                $modified = true;
            } else if (isset($_POST['rdb-punteggiatura']) && str_contains($_punteggiatura, strval($char))) {
                $risultato_punteggiatura = cifra($verme, $_punteggiatura, $pos, $char);
                $msg[$pos] = $risultato_punteggiatura;
                $modified = true;
            } else if (isset($_POST['rdb-numeri']) && str_contains($_cifre, strval($char))) {
                $risultato_numero = cifra($verme, $_cifre, $pos, $char);
                $msg[$pos] = $risultato_numero;
                $modified = true;
            }
            if (isset($_POST['rdb-elimina-non-cifrati']) && $modified == false) {
                if ($char == ' ') {
                    continue;
                } else {
                    $msg = substr_replace($msg, '', $pos, 1);
                }
            }
        }
    }
} else if ($_POST['action'] == 'Decifra') {
    foreach ($chars as $char) {
        $pos = strpos(strval($msg), strval($char));
        $modified = false;
        if (isset($_POST['rdb-lettere-maiuscole']) && str_contains($_lettere_maiuscole, strval($char))) {
            $risultato_lettere_maiuscole = decifra($verme, $_lettere_maiuscole, $pos, $char);
            $msg[$pos] = $risultato_lettere_maiuscole;
            $modified = true;
        } else if (isset($_POST['rdb-lettere-minuscole']) && str_contains($_lettere_minuscole, strval($char))) {
            $risultato_lettere_minuscole = decifra($verme, $_lettere_minuscole, $pos, $char);
            $msg[$pos] = $risultato_lettere_minuscole;
            $modified = true;
        } else if (isset($_POST['rdb-caratteri-speciali']) && str_contains($_caratteri_speciali, strval($char))) {
            $risultato_caratteri_speciali = decifra($verme, $_caratteri_speciali, $pos, $char);
            $msg[$pos] = $risultato_caratteri_speciali;
            $modified = true;
        } else if (isset($_POST['rdb-punteggiatura']) && str_contains($_punteggiatura, strval($char))) {
            $risultato_punteggiatura = decifra($verme, $_punteggiatura, $pos, $char);
            $msg[$pos] = $risultato_punteggiatura;
            $modified = true;
        } else if (isset($_POST['rdb-numeri']) && str_contains($_cifre, strval($char))) {
            $risultato_numero = decifra($verme, $_cifre, $pos, $char);
            $msg[$pos] = $risultato_numero;
            $modified = true;
        }
        if (isset($risultato_numero)) {
            $msg[$pos] = $risultato_numero;
            $modified = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Algoritmo di Vigenère</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
            padding-left: 30px;
        }

        h5 {
            font-size: 1.6rem;
            line-height: 110%;
            margin: 1.68rem 0 1.68rem 0;
        }

        input[type="text"][disabled] {
            background-color: white;
            color: black;
            border-color: lightgray;
        }

        input[type="number"][disabled] {
            background-color: white;
            color: black;
            border-color: lightgray;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <div>
            <h5 class="title">ALGORITMO DI VIGENÈRE</h5>
        </div>
        <div>
            <form method="post">
                <label class="label">Verme</label>
                <input type="text" name="verme" class="input" value="<?php echo $verme ?>" style="width:300px"
                    disabled><br><br>
                <label class="label">Testo Originale</label>
                <input type="text" name="testo-originale" class="input" value="<?php echo $msg_copia ?>"
                    style="width:300px" disabled><br><br>
                <label class="label">Risultato</label>
                <input type="text" class="input" value="<?php echo $msg ?>" style="width:300px" disabled><br><br>
                <a class="icon-text" href="index.html" style="color: #00bfff">
                    <span class="icon">
                        <i class="bi bi-house-door-fill"></i>
                    </span>
                    <span><b>Torna Indietro</b></span>
                </a>
            </form>
        </div>
    </div>
</body>

</html>