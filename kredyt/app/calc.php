<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów (zabezpieczone funkcją isset przed błędami na nowszych wersjach PHP)
$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
$years  = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
$rate   = isset($_REQUEST['rate']) ? $_REQUEST['rate'] : null;

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($amount) && isset($years) && isset($rate))) {
    //sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $amount == "") {
    $messages [] = 'Nie podano kwoty kredytu';
}
if ( $years == "") {
    $messages [] = 'Nie podano liczby lat';
}
if ( $rate == "") {
    $messages [] = 'Nie podano oprocentowania';
}

if (empty( $messages )) {
    
    // sprawdzenie, czy przekazane parametry są liczbami
    if (! is_numeric( $amount )) {
        $messages [] = 'Kwota kredytu nie jest liczbą';
    }
    
    if (! is_numeric( $years )) {
        $messages [] = 'Liczba lat nie jest liczbą';
    }   
    
    if (! is_numeric( $rate )) {
        $messages [] = 'Oprocentowanie nie jest liczbą';
    }

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
    
    //konwersja parametrów na int / float
    $amount = floatval($amount);
    $years = intval($years);
    $rate = floatval($rate);
    
    //wykonanie operacji (wzór na raty stałe)
    $monthlyRate = ($rate / 100) / 12;
    $months = $years * 12;

    if ($monthlyRate == 0) {
        $result = $amount / $months;
    } else {
        $result = $amount * ($monthlyRate * pow(1 + $monthlyRate, $months)) / (pow(1 + $monthlyRate, $months) - 1);
    }
    
    $result = round($result, 2);
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$amount,$years,$rate,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';