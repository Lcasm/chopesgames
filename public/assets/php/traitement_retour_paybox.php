<? php
// ON TRAVAILLERA ICI EN PHP ‘CLASSIQUE’, pas d’appel au framework (appels BDD via PDO)
$MontantEuros = $_GET['Montant'];
$Reference = $_GET['Reference'];
$Erreur = $_GET['Erreur'];
if ($Erreur == "00000") /* PAIEMENT OK (PayBox appelle par ailleurs le script renseigné dans $pbx_effectue, exemple : accepte.php) */
{ 
/* EN LOCAL : A TESTER 'A LA MAIN' (en forçant des valeurs pour $Reference etc…)
(il faut que le site soit hébergé pour que traitementretourpaybox.php puisse être appelé par PayBox */

/* ICI on fera un UPDATE sur la commande concernée par le paiement :
- Validé : vraie
- Montant payé
- Mode paiement
…
- On enverra un mail de confirmation au client … etc…
*/

}

/* SI PAIEMENT KO : il n’y a rien à faire
le serveur PayBox appelle automatiquement suivant les cas, le script $pbx_annule (ex. annule.php) ou $pbx_refuse (ex. refuse.php)
*/

?>