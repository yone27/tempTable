<?php
session_start();
error_reporting(0);
// Establecer Codificacion de la Pagina
header('Content-Type: text/html; charset=UTF-8');

chdir(dirname(__FILE__));
include_once("userBL.php");
chdir(dirname(__FILE__));
include_once("../base/basePL.php");
chdir(dirname(__FILE__));
include_once("../base/baseBL.php");
//chdir(dirname(__FILE__));
//include_once("../../../includes/myPresentationLayer.php");
chdir(dirname(__FILE__));
include_once("includes/myPresentationLayer.php");
chdir(dirname(__FILE__));
include_once("includes/myUtilities.php");


basePL::buildjs();
basePL::buildccs();

myUtilities::buildmyjs();
myUtilities::buildmycss();

//////////// Validacion de Usuario
//utilities::trueUser();
////////// Fin Validacion de usuario

// Establecimiento de la empresa
//$_SESSION['idpartycompany']= myUtilities::getIdPartyCompanyByIdUser($iduser);
$_SESSION['idpartycompany'] = 32681;

// Establecimiento del usuario
//$_SESSION['iduser']= myUtilities::getIdPartyUserByIdUser($iduser);
//$_SESSION['iduser']=1;
//$iduser=1;

?>

<html>

<head>
    <title>USUARIOS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./tablesCustomYg.css">
</head>

<?php
// Visualizacion de Errores
// utilities::showErrors();
// Fin de Visualizacion de Errores

// default
$id = $code = $name = "";
$suser = "";
$spwd = "";
$semail = "";
$document = "";
$active = "Y";
$deleted = "N";


//links
// sLink = Save Link
// dLink = Delete Link
// pLink = Print Link
// fLink = Find Link
// fbnLink = find by Name Link
// cLink = Clean Link
$sLink = $dLink = $pLink = $cLink = $flink = $fbnlink = "";

//actions
$action = "";
$urloper = "";

//For pagination
$pn = 0;

$id = basePL::getReq($_REQUEST, "id");
$code = basePL::getReq($_REQUEST, "code");
$name = basePL::getReq($_REQUEST, "name");
$suser = basePL::getReq($_REQUEST, "suser");
$spwd = basePL::getReq($_REQUEST, "spwd");
$semail = basePL::getReq($_REQUEST, "semail");
$document = basePL::getReq($_REQUEST, "document");
$active = basePL::getReqCheck($_REQUEST, "active");
//$deleted = basePL::getReqCheck($_REQUEST,"deleted");
$urloper = basePL::getReq($_REQUEST, "urloper");
$pn = basePL::getReq($_REQUEST, "pn");


$dbl = new userBL(
    $id,
    $code,
    $name,
    $suser,
    $spwd,
    $semail,
    $document,
    $active,
    $deleted
);
$dbl->buildLinks("userPL.php", $pn, $sLink, $dLink, $pLink, $cLink, $fLink, $fbnLink, $action);
$bpl = new basePL("document.userPL", $sLink, $dLink, $pLink, $cLink, $fLink, $fbnLink);

$oper = $urloper;
if ($urloper == "save" && $id == "") {
    $oper = "insert";
}
if ($urloper == "save" && $id != "") {
    $oper = "update";
}
if ($urloper == "clear") {
    $oper = "clear";
    $id = "";
    $code = "";
    $name = "";
    $suser = "";
    $spwd = "";
    $semail = "";
    $document = "";
    $active = "";
    //$deleted = "";
}


if ($id != "") {
    $arPar[] = $id;
}

$dbl->buildArray($arPar);

//var_dump($arPar);

$dbl->execute($oper, $arPar);

if ($oper == "find" || $oper == "findByName") {
    $id = $arPar[0];
    $code = $arPar[1];
    $name = $arPar[2];
    $suser = $arPar[3];
    $spwd = $arPar[4];
    $semail = $arPar[5];
    $document = $arPar[6];
    $active = $arPar[7];
    //$deleted = $arPar[4];
}
?>
<!-- 
<body oncontextmenu="return false;">
-->



<FORM action="<?php echo $action; ?>" method="post" name="userPL" class="italsis">

    <?php
    ?>
    <table id="example" class="customTableYg">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th class="text-center">Start date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <input class="customTableYg__check" type="checkbox">
                </td>
                <td class="customTableYg__info">
                    <div>
                        <img src="https://i.pinimg.com/originals/6e/22/56/6e2256829eadd83cd966c6ea6f807bf2.jpg" alt="agencia de viajes">
                    </div>
                    <div class="customTableYg__info__2">
                        <p class="customTableYg__schedule">14:00 16:14</p>
                        <h3 class="customTableYg__destination">MIA Miami - SDQ Aeropuerto</h3>
                    </div>
                </td>
                <td class="customTableYg__type">
                    Directo
                </td>
                <td class="customTableYg__time">61</td>
                <td class="text-center">
                    <h3 class="customTableYg__price">
                        $304
                        <small>
                            $1.215 en total
                        </small>
                    </h3>
                    <button class="btnCustom btnCustom-table">
                        Seleccionar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</form>
</body>

</html>