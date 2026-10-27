<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Kredytowy</title>
<style>
    /* Style wyrównujące formularz aby było ładnie */
    form {
        margin: 20px;
    }
    label {
        display: inline-block;
        width: 120px; /* Jedna szerokość */
        margin-bottom: 5px; /* Jeden odstęp między wierszami */
    }
    input[type="submit"] {
        margin-top: 10px;
    }
</style>
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
    <label for="id_amount">Kwota kredytu: </label>
    <input id="id_amount" type="text" name="amount" value="<?php print($amount ?? ''); ?>" /><br />
    
    <label for="id_years">Liczba lat: </label>
    <input id="id_years" type="text" name="years" value="<?php print($years ?? ''); ?>" /><br />
    
    <label for="id_rate">Oprocentowanie: </label>
    <input id="id_rate" type="text" name="rate" value="<?php print($rate ?? ''); ?>" /><br />
    
    <input type="submit" value="Oblicz" />
</form> 

<?php
//wyświetlenie listy błędów, jeśli istnieją
if (isset($messages)) {
    if (count ( $messages ) > 0) {
        echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
        foreach ( $messages as $key => $msg ) {
            echo '<li>'.$msg.'</li>';
        }
        echo '</ol>';
    }
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Rata miesięczna: '.$result.' zł'; ?>
</div>
<?php } ?>

</body>
</html>