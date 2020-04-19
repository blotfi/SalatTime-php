<?php  
// Calcul des horaires de priere (Salat) Lotfi BAGHLI 02/2007 - 04/2012
// Usage : Donnez l'année, le mois, le jour, latitude, longitude, Convention, TimeZone, DST
// &ConventionDetails=1 uniquement pour debug
// Exemple pour "Tlemcen ", 34.879200 , -1.315300
// calcst.php?anneeinput=2012&moisinput=4&jourinput=27&latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
// Pour avoir les horaires du jour :
// calcst.php?latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
// Pour les convention : 0 : France UOIF, 1 : Algérie, 8: Maroc... voir ReadConventions()
// pour le mois ajouter : &multiinput=m
// pour l'année ajouter : &multiinput=y

$ConventionDetails=$_GET['ConventionDetails'];
$anneeinput=$_GET['anneeinput'];
$moisinput=$_GET['moisinput'];
$jourinput=$_GET['jourinput'];
$hiddeninfo=$_GET['hiddeninfo'];
$latitudeinput=$_GET['latitudeinput'];
$longitudeinput=$_GET['longitudeinput'];
$Conventioninput=$_GET['Conventioninput'];
$Timezoneinput=$_GET['Timezoneinput'];
$DSTinput=$_GET['DSTinput'];
$multiinput=$_GET['multiinput'];

//---------------------------------------------------------------------------
// code prog Salat Tiime
define("idFajr", 0); 
define("idChourouk", 1); 
define("idZuhr", 2);
define("idAsr", 3); 
define("idMaghrib", 4); 
define("idIsha", 5); 

define("NConvention", 9);

define("deg2rd", M_PI/180.0);
define("rd2deg", 180.0/M_PI);
define("SolarSiderealCorrection", 1.002738);
//---------------------------------------------------------------------------
function SetConventions($Convention, $name, $AsrShafi, $FajrTwilightAngle, $IshaTwilightAngle, $Sunrise_setAngle, $Isha_is_Maghrib_plus, $Isha_is_Maghrib_plus_min,
	$ZuhrFixe, $ZuhrFixeHour, $Fajr, $Chourouk, $Zuhr, $Asr, $Maghrib, $Isha)
{ 
	global  $SalatTimeConfig;
	$SalatTimeConfig[$Convention]->name = $name;
	$SalatTimeConfig[$Convention]->AsrShafi = $AsrShafi;
	$SalatTimeConfig[$Convention]->FajrTwilightAngle = $FajrTwilightAngle;
	$SalatTimeConfig[$Convention]->IshaTwilightAngle= $IshaTwilightAngle;
	$SalatTimeConfig[$Convention]->Sunrise_setAngle= $Sunrise_setAngle;
	$SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus= $Isha_is_Maghrib_plus;
	$SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus_min= $Isha_is_Maghrib_plus_min;
	$SalatTimeConfig[$Convention]->ZuhrFixe= $ZuhrFixe;
	$SalatTimeConfig[$Convention]->ZuhrFixeHour= $ZuhrFixeHour;
	//8 Convention Fajr  Chourouk  Zuhr  Asr  Maghrib  Isha
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Fajr= $Fajr;
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Chourouk= $Chourouk;
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Zuhr= $Zuhr;
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Asr= $Asr;
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Maghrib= $Maghrib;
	$SalatTimeConfig[$Convention]->SalatTimeAdjust->Isha= $Isha;
}
//---------------------------------------------------------------------------
function ReadConventions()
{ 
//8 - Conventions
//8 Convention Name
//5 0          "France : UOIF"
//8 Convention AsrSahfi/Hanafi FajrTwilightAngle IshaTwilightAngle Sunrise/SetAngle Isha_is_Maghrib_plus xx mn ZuhrFixe ZuhrHour(h)
//3 0          1               12                12                0.61             0                    0     0        0              
//8 - Time (mn) to add to get Salat
//8 Convention Fajr     Chourouk Zuhr     Asr      Maghrib  Isha
//4 0          -5       0        5        0        5        5      
//8 ------------------------------------------------------------------
//8 Convention Name
//5 1          "Algérie : (Isha 17°)"
//8 Convention AsrSahfi/Hanafi FajrTwilightAngle IshaTwilightAngle Sunrise/SetAngle Isha_is_Maghrib_plus xx mn ZuhrFixe ZuhrHour(h)
//3 1          1               18                17                0.61             0                    90    0        13.3333334     
//8 - Time (mn) to add to get Salat
//8 Convention Fajr     Chourouk Zuhr     Asr      Maghrib  Isha
//4 1          0        0        0        0        5        0      
//8 ------------------------------------------------------------------
	global  $SalatTimeConfig;
	SetConventions(0, "France : UOIF",															1, 12, 12, 0.61, 0, 0, 0, 0,-5,0,5,0,5,5);
	SetConventions(1, "Algérie : (Isha 17°)",												1, 18, 17, 0.61, 0, 0, 0, 13.3333334, 0,0,0,0,5,0);
	SetConventions(2, "University of Islamic Sciences, Karachi",		1, 18, 18, 0.61, 0, 0, 0, 0, 0,0,0,0,5,5);
	SetConventions(3, "Islamic Society of North America (ISNA)",		1, 15, 15, 0.61, 0, 0, 0, 0, 0,0,0,0,0,5);
	SetConventions(4, "World Islamic League",												1, 18, 17, 0.61, 0, 0, 0, 0, 0,0,0,0,5,5);
	SetConventions(5, "Um Ul-Qura, Makkah",													1, 19, 19, 0.61, 1,90, 0, 0,-1,0,0,0,1,0);
	SetConventions(6, "Egyptian General Organisation of Surveying",	1, 19.5, 17.5, 0.61, 0, 0, 0, 0, 0,0,0,0,0,0);
	SetConventions(7,	"User defined",																1, 18, 17, 0.61, 0,75, 0, 0,-5,-5,5,0,5,0);
	SetConventions(8,	"Maroc : (18° et Isha 17°)",									1, 18, 17, 0.61, 0,75, 0, 0,-5,-5,5,0,5,0);
}
//---------------------------------------------------------------------------

class Astre  { var $az; var $h;      // coord. horizontal
								var $delta; var $au; // coord equatorial
                var $RA;                // ascension droite
								var $L;                //longitude réele
							};
class SalatTimeStruct  { var $Fajr; var $Chourouk; var $Zuhr; var $Asr; var $Maghrib; var $Isha;};
class DateUT  { var $j; var $m; var $a; var $h;}; // jour/mois/année/heure.xxx
							
class Heure  { var $s; var $m; var $h;};  // milisec, secondes/, minutes, heures
							
class TownData {	var $CountryName; var $TownName;
									var $longitude; var $latitude;
									var $TimeZoneTown; var $DST; var $Convention;
							};

class SalatTimeConfigStruct {
					var $Name;
					var $SalatTimeAdjust;
					var $FajrTwilightAngle; var $IshaTwilightAngle; var $Sunrise_setAngle;
					var $AsrShafi;
					var $Isha_is_Maghrib_plus;
					var $Isha_is_Maghrib_plus_min;
					var $ZuhrFixe;
					var $ZuhrFixeHour;
					function SalatTimeConfigStruct()
						{
						$this->SalatTimeAdjust=new SalatTimeStruct();
						}
					};

		$SalatTime=new SalatTimeStruct();
		$SalatTimeC=new SalatTimeStruct();
//		var $JD; var $T;						// Jour Julien, Julien Century : T,
//		var $theta0; var $theta;	 // theta0 : temps sideral à Greenwich
		$longitude=0; $latitude=0;
	$date=new DateUT(); // date en jours
	$heure=new Heure();
//	$TimeZone=0;  $TimeZoneTown, NTowns, TownSelected, $Verbose, Convention;
//	$DST=0;
		for ($i=0; $i<NConvention; $i++)
			$SalatTimeConfig[$i]=new SalatTimeConfigStruct();

	$Mounths=array(	"Janvier", "Fevrier", "Mars", "Avril",
									"Mai", "Juin", "Juillet", "Aout",
									"Septembre", "Octobre", "Novembre", "Decembre");
	$Days=array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
//---------------------------------------------------------------------------
// Algorithms from 	http://www.jgiesen.de/SME/details/basics/meeus.htm#solar
//								 	http://www.jgiesen.de/SME/details/basics/index.htm
//  								http://stjarnhimlen.se/comp/riset.html#3
//									http://www.ummah.net/astronomy/saltime/
// modified by Lotfi BAGHLI on 15/01/2006 et 10/06/2006
//---------------------------------------------------------------------------

// Julian day: 86400 s, Julian year: 365.25 d, Julian Century: 36525 d
// Julian Day (valid from 1900/3/1 to 2100/2/28)
function JulianDay ($date, $month, $year, $UT)
{
	if ($month<=2) {$month=$month+12; $year=$year-1;}
	return (int)(365.25*$year) + (int)(30.6001*($month+1)) - 15 + 1720996.5 + $date + $UT/24.0;
}
//---------------------------------------------------------------------------
// Julian century depuis 01/01/2000 à 12h UT
function JulianCentury  ($date, $month, $year, $UT)
{
	if ($month<=2) {$month=$month+12; $year=$year-1;}
  return ((int)(365.25*$year) + (int)(30.6001*($month+1)) - 15 + 1720996.5 + $date + $UT/24.0 - 2451545.0)/36525.0;
} 
//---------------------------------------------------------------------------
//Solar Coordinates (according to: Jean Meeus: Astronomical Algorithms), accuracy of 0.01 degree 
function SoleilLongitude( $T)   // L
{
	$M = 357.52910 + 35999.05030*$T - 0.0001559*$T*$T - 0.00000048*$T*$T*$T; // mean anomaly, degree
	$L0 = 280.46645 + 36000.76983*$T + 0.0003032*$T*$T; // mean longitude, degree 
	$DL = (1.914600 - 0.004817*$T - 0.000014*$T*$T)*sin(deg2rd*$M)
				+ (0.019993 - 0.000101*$T)*sin(deg2rd*2*$M) + 0.000290*sin(deg2rd*3*$M); 
	$L=$L0 + $DL; // true longitude, deg sans modulo
	$Lm=$L-360*(int)($L/360);
	if ($Lm<0)	$Lm+=360;
	return $Lm*deg2rd; // true longitude, rd 
}
//---------------------------------------------------------------------------
// convert ecliptic longitude L (rd) to right ascension RA and declination delta
function eclipticL2RA_delta( $T, $L, & $RA, & $delta)
{
// old approxim  $eps = deg2rd*23.43999; // obliquity of ecliptic
	$eps = deg2rd*(23.4393 -0.013*$T);	// obliquity of ecliptic
	$X = cos($L); $Y = cos($eps)*sin($L); $Z = sin($eps)*sin($L); $R = sqrt(1.0-$Z*$Z); 
	$delta = atan2($Z, $R); // in rd 
	$RA = 2*atan2($Y, $X+$R); //  in rd 
}
//---------------------------------------------------------------------------
//compute sidereal time at Greenwich (according to: Jean Meeus: Astronomical Algorithms ) 
function TempsSideral( $T)   // theta0
{
//	T siecle julien depuis 2000
	$theta0=280.46061837 + 360.98564736629*$T*36525 + 0.000387933*$T*$T - $T*$T*$T/38710000.0;
	$theta0m=$theta0-360*(int)($theta0/360);
	if ($theta0m<0)	$theta0m+=360;
	return $theta0m*deg2rd;    // TempsSideralen rd
}
//---------------------------------------------------------------------------
//convert tau, delta to horizon coordinates of the observer (altitude h, azimuth az) , needs latitude : beta
function equatorial2horizontal( $beta, $tau, $delta, & $h, & $az)
{
	$h=asin( sin($beta)*sin($delta) + cos($beta)*cos($delta)*cos($tau));	// h en rd
	$az =atan2( -sin($tau), cos($beta)*tan($delta) - sin($beta)*cos($tau))-M_PI;	// az en rd du SUD
	if ($az<0)	$az+=2*M_PI;
}
//---------------------------------------------------------------------------
//convert rad en heure
function rd2heure( $angle)
{
	return ($angle*12.0/M_PI);
}
//---------------------------------------------------------------------------
// check DST applies ou non
function CalcTimeZone( $a, $m, $j, $DST, $TimeZoneTown)
{      // ici on approxime TimeZoneTown avec TimeZone puisque ça n'a pas d'importance
	if ($DST==2)	{$JourToSwitch=4; $mmdebut=4; $mmfin=9;} // dernier vendredi d'avril / septembre
			else			{$JourToSwitch=6; $mmdebut=3; $mmfin=10;}// dernier dimanche de mars / octobre
// recherchedernier dimanche de mars et dernier dimanche d'octobre
// DST applys 26-Mar, 02:00h  à  29-Oct, 03:00h   pour 2006
	for ($ji=31; $ji>24; $ji--)
		{
		$T=JulianCentury ($ji, $mmdebut, $a, 12);    // pour 12h
		$jour=CalculeJour($T+($TimeZoneTown+12)/24.0/36525.0);
		if ($jour==$JourToSwitch) 	{	$jjdebut=$ji; $ji=0; // dimanche  et on sort de la for
																}
		}
	for ($ji=31; $ji>24; $ji--)
		{
		$T=JulianCentury ($ji, $mmfin, $a, 12);    // pour 12h
		$jour=CalculeJour($T+($TimeZoneTown+12)/24.0/36525.0);
		if ($jour==$JourToSwitch) 	{	$jjfin=$ji; $ji=0; // dimanche  et on sort de la for
																}
		}
	if ($m>$mmdebut && $m<$mmfin)	return true;
	if ($m==$mmdebut && $j>=$jjdebut)	return true;
	if ($m==$mmfin && $j<$jjfin)	return true;
	return false;
}
//---------------------------------------------------------------------------
//convert heure en rad
function heure2rd( $heure)
{
	return ($heure*M_PI/12.0);
}
//---------------------------------------------------------------------------
//convert rad en deg min sec
function rd2degminsec( $angle)
{
	$h=$angle*rd2deg;
	$hi=(int)($h);
	$m=($h-$hi)*60;
	$mi=(int)(($h-$hi)*60);
	$s=($m-$mi)*60;
	return sprintf ("%3.0f°%02.0f'%02.0f\"", $hi, $mi, $s);
}
//---------------------------------------------------------------------------
//convert rad en h min sec
function rd2hminsec( $angle)
{
	$h=rd2heure($angle);
	$hi=(int)($h);
	$m=($h-$hi)*60;
	$mi=(int)(($h-$hi)*60);
	$s=($m-$mi)*60;
	return sprintf ("%02.0fh%02.0f'%02.0f\"", $hi, $mi, $s);
}
//---------------------------------------------------------------------------
//convert h en h min sec
function h2hminsec( $h)
{
	$hi=(int)($h);
	$m=($h-$hi)*60;
	$mi=(int)(($h-$hi)*60);
	$s=($m-$mi)*60;
	return sprintf ("%02.0fh%02.0f'%02.0f\"", $hi, $mi, $s);
}
//---------------------------------------------------------------------------
//convert h en h min 
function h2hmin( $h)
{
	$hi=(int)($h);
	$m=($h-$hi)*60;
	$mi=(int)(($h-$hi)*60);
	return sprintf ("%02.0fh%02.0f", $hi, $mi);
}
//---------------------------------------------------------------------------
//convert h en h min arondie
function h2hmiarrondie( $h)
{
	$hi=(int)$h;
	$m=($h-$hi)*60;
	$mi=(int)(($h-$hi)*60);
	$s=($m-$mi)*60;
	if ($s>=30)	{
							$mi++;
							if ($mi==60)	{ $mi=0; $hi++; if ($hi==24) echo "erreur : arrondi au jour suivant<br />";}
							// si hi==24 alrs pb . on passe au jour suivant.. qui n'arrive jamais
							}
	return sprintf("%02d:%02d", $hi, $mi);
}
//---------------------------------------------------------------------------
 function init()
{
	global $Verbose, $date,  $heure, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, $Towns, $TownSelected, $SalatTimeConfig;
	ReadConventions();	// codé en hard
//debug
//	$Verbose=true;
	$Verbose=false;
}
//---------------------------------------------------------------------------
function ComputeZuhrHour()
{
	global $Verbose, $date, $longitude, $SalatTime, $TimeZone, $T; // pour avoir le jour de la semaine ds calendrier et verbose
	$Soleil=new Astre();
	$T=JulianCentury ($date->j, $date->m, $date->a, 12);    // pour 12h
//	if ($Verbose)	printf("T=%f  JC à 12h GMT<br />", $T);
	$Soleil->L=SoleilLongitude($T);
	eclipticL2RA_delta( $T, $Soleil->L, $Soleil->RA, $Soleil->delta);
	$theta0=TempsSideral( $T);
	$GMST0=$theta0-heure2rd(12);
	$Z_GMT=rd2heure($Soleil->RA-$GMST0-$longitude);
// iteration bis
	if ($Z_GMT<0) 	{// si négatif, on se place à j-1
								$Z_GMT+=24;
								$T=JulianCentury ($date->j-1, $date->m, $date->a, $Z_GMT+24);    // pour LA vraie heure à GWT
								}
		else				$T=JulianCentury ($date->j, $date->m, $date->a, $Z_GMT);    // pour LA vraie heure à GWT
	// if ($Verbose)	printf("T=%f JC à %s<br />",$T, h2hminsec($Z_GMT));
	$Soleil->L=SoleilLongitude($T);
	eclipticL2RA_delta( $T, $Soleil->L, $Soleil->RA, $Soleil->delta);
	$theta0=TempsSideral( $T);
	$GMST0=$theta0-heure2rd($Z_GMT);
	$SalatTime->Zuhr=$TimeZone+rd2heure($Soleil->RA-$GMST0-$longitude);    // on le prend avec TimeZone
	if ($SalatTime->Zuhr<0) $SalatTime->Zuhr+=24;
}
//---------------------------------------------------------------------------
//compute pour une des 5 prieres
function ComputeTwilightHour( $TypeSalat, & $SalatHour)
{
	global $Verbose, $date, $longitude, $latitude, $TimeZone, $SalatTime, $SalatTimeConfig, $Convention;
	$Soleil=new Astre();
	$SalatHour=0;
	switch ($TypeSalat)
		{
		case idFajr : $Soleil->h=-$SalatTimeConfig[$Convention]->FajrTwilightAngle*deg2rd;
									$Offset=-1;
									break;
		case idIsha : $Soleil->h=-$SalatTimeConfig[$Convention]->IshaTwilightAngle*deg2rd;
									$Offset=+1;
									break;
		case idChourouk : $Soleil->h=-$SalatTimeConfig[$Convention]->Sunrise_setAngle*deg2rd;
									$Offset=-1;
									break;
		case idMaghrib : $Soleil->h=-$SalatTimeConfig[$Convention]->Sunrise_setAngle*deg2rd;
									$Offset=+1;
									break;
		}
	// commence par calculer au milieur de la journée le T et declinaison du soleil
	// iteration 1
	// if ($Verbose)	printf(" 1st iter %s<br />", h2hminsec($SalatTime->Zuhr-$TimeZone));
	$T=JulianCentury ($date->j, $date->m, $date->a, $SalatTime->Zuhr-$TimeZone);    // pour LA vraie heure à GWT
	// if ($Verbose)		printf("T=%f JC à %s<br />", $T, h2hminsec($SalatTime->Zuhr-$TimeZone));
	$Soleil->L=SoleilLongitude($T);
	eclipticL2RA_delta( $T, $Soleil->L, $Soleil->RA, $Soleil->delta);
	if ($TypeSalat==idAsr)		{
													if ($SalatTimeConfig[$Convention]->AsrShafi)		$Soleil->h=atan(1.0/(1.0+tan($latitude-$Soleil->delta)));   // Asr Shafi : length of shadow = length of object + noon shadow
																else			$Soleil->h=atan(1.0/(2.0+tan($latitude-$Soleil->delta)));   // Asr Hanafi : length of shadow =2x length of object + noon shadow
													$Offset=+1;
													}
	$costau =(sin($Soleil->h)- sin($latitude)*sin($Soleil->delta))/cos($latitude)/cos($Soleil->delta);
	// if ($Verbose)	printf(" costau=%f<br />",$costau);
	if ($costau>1.0)		{// if ($Verbose)	printf("ERROR : then the Sun is always above our altitude limit. If we were computing rise\/set times, the Sun is then aboute the horizon continuously; we have Midnight Sun.<br />");
										return 1;}
	if ($costau<-1.0)	{// if ($Verbose)	printf("ERROR : then the Sun is always below our altitude limit. One example is midwinter in the arctics, when the Sun never gets above the horizon.<br />");
										return -1;}
	if ($costau>=-1.0 && $costau<=1.0)
			{
			$Soleil->tau=acos($costau)/SolarSiderealCorrection; 
			$SalatHour=$SalatTime->Zuhr + $Offset*rd2heure($Soleil->tau);
			// if ($Verbose)	printf(" SalatHour=%fh ie : %s<br />", $SalatHour, h2hminsec($SalatHour));
			}
// corrected values, avec iterations
	// if ($Verbose)	printf("** corrected values ** :<br />");
	// iteration 2
	// if ($Verbose)	printf(" 2nd iter à %s<br />", h2hminsec($SalatHour-$TimeZone));
	$T=JulianCentury ($date->j, $date->m, $date->a, $SalatHour-$TimeZone);    // pour LA vraie heure à GWT
	// if ($Verbose)	printf("T=%f JC à %s<br />", $T, h2hminsec($SalatHour-$TimeZone));
	$Soleil->L=SoleilLongitude($T);
	eclipticL2RA_delta( $T, $Soleil->L, $Soleil->RA, $Soleil->delta);
	if ($TypeSalat==idAsr)		{
													if ($SalatTimeConfig[$Convention]->AsrShafi)		$Soleil->h=atan(1.0/(1.0+tan($latitude-$Soleil->delta)));   // Asr Shafi : length of shadow = length of object + noon shadow
																else			$Soleil->h=atan(1.0/(2.0+tan($latitude-$Soleil->delta)));   // Asr Hanafi : length of shadow =2x length of object + noon shadow
													}

	$costau =(sin($Soleil->h)- sin($latitude)*sin($Soleil->delta))/cos($latitude)/cos($Soleil->delta);
	// if ($Verbose)	printf(" costau=%f<br />",$costau);
	if ($costau>1.0)		{// if ($Verbose)	printf("ERROR : then the Sun is always above our altitude limit. If we were computing rise\/set times, the Sun is then aboute the horizon continuously; we have Midnight Sun.<br />");
										return 1;}
	if ($costau<-1.0)	{// if ($Verbose)	printf("ERROR : then the Sun is always below our altitude limit. One example is midwinter in the arctics, when the Sun never gets above the horizon.<br />");
										return -1;}
	if ($costau>=-1.0 && $costau<=1.0)
			{
			$Soleil->tau=acos($costau); ///SolarSiderealCorrection; pas pour les suivants
			$SalatHour=$SalatTime->Zuhr + $Offset*rd2heure($Soleil->tau);
			// if ($Verbose)	printf(" SalatHour=%fh ie : %s<br />", $SalatHour, h2hminsec($SalatHour));
			}
	// iteration 3
	// if ($Verbose)	printf(" 3rd iter à %s<br />", h2hminsec($SalatHour-$TimeZone));
	$T=JulianCentury ($date->j, $date->m, $date->a, $SalatHour-$TimeZone);    // pour LA vraie heure à GWT
	// if ($Verbose)	printf("T=%f JC à %s<br />", $T, h2hminsec($SalatHour-$TimeZone));
	$Soleil->L=SoleilLongitude($T);
	eclipticL2RA_delta( $T, $Soleil->L, $Soleil->RA, $Soleil->delta);
	if ($TypeSalat==idAsr)		{
													if ($SalatTimeConfig[$Convention]->AsrShafi)		$Soleil->h=atan(1.0/(1.0+tan($latitude-$Soleil->delta)));   // Asr Shafi : length of shadow = length of object + noon shadow
																else			$Soleil->h=atan(1.0/(2.0+tan($latitude-$Soleil->delta)));   // Asr Hanafi : length of shadow =2x length of object + noon shadow
													// if ($Verbose)	printf("h=%f°  ie altitude %f<br />", $Soleil->h*rd2deg, rd2degminsec($Soleil->h));
													}

	$costau =(sin($Soleil->h)- sin($latitude)*sin($Soleil->delta))/cos($latitude)/cos($Soleil->delta);
	// if ($Verbose)	printf(" costau=%f<br />",$costau);
	if ($costau>1.0)		{// if ($Verbose)	printf("ERROR : then the Sun is always above our altitude limit. If we were computing rise\/set times, the Sun is then aboute the horizon continuously; we have Midnight Sun.<br />");
										return 1;}
	if ($costau<-1.0)	{// if ($Verbose)	printf("ERROR : then the Sun is always below our altitude limit. One example is midwinter in the arctics, when the Sun never gets above the horizon.<br />");
										return -1;}
	if ($costau>=-1.0 && $costau<=1.0)
			{
			$Soleil->tau=acos($costau); ///SolarSiderealCorrection; pas pour les suivants
			$SalatHour=$SalatTime->Zuhr + $Offset*rd2heure($Soleil->tau);
			// if ($Verbose)	printf(" SalatHour=%fh ie : %s<br />", $SalatHour, h2hminsec($SalatHour));
			}
	return 0;
}
//---------------------------------------------------------------------------
//Appelle les 2 methodes précédentes pour calculer ttes les prieres
function ComputeSalatTime()
{
// debug date
	global $Verbose, $date, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, 
				$SalatTime, $SalatTimeC, $SalatTimeConfig, $Convention, $CountryName, $TownName;
//	$date=GetMyDate();
	$DSTApplies=(bool)(($DST !=0) && CalcTimeZone( $date->a, $date->m, $date->j, $DST, $TimeZoneTown));
	if ($DSTApplies)	$TimeZone=1+$TimeZoneTown;
						else		$TimeZone=$TimeZoneTown;
	// if ($Verbose)	printf("_____________________________________________________________<br />");
	// if ($Verbose) 	printf("Lieu : %s, %s<br />",$CountryName, $TownName);
	// if ($Verbose) 	printf("latitude=%s   longitude=%s<br />", rd2degminsec($latitude),rd2degminsec($longitude));
	// if ($Verbose) 	printf(($DSTApplies ? "DST Applies": "DST does not apply"));
	// if ($Verbose) 	printf("  Convention %d<br />", $Convention);
	// if ($Verbose)	printf("____ Mawakit Salat _____<br />");
	// if ($Verbose)	printf(" at Date=: %d/%d/%d   TZ=%d<br />", $date->j, $date->m, $date->a, $TimeZone);
	// Calcul Zuhr
	ComputeZuhrHour();
	// if ($Verbose)	printf("Passage au méridien (Zuhr)=%fh ie : %s<br />", $SalatTime->Zuhr, h2hminsec($SalatTime->Zuhr));
	// if ($Verbose)	printf("<br />");
	// lever / coucher
	// if ($Verbose)	printf("Sunrise / Sunset at -%f", $SalatTimeConfig[$Convention]->Sunrise_setAngle);
	// Calcul Chourouk (lever)
	$erreur=ComputeTwilightHour( idChourouk, $SalatTime->Chourouk);
	// if ($Verbose)	printf("Chourouk (Sunrise) at %fh ie : %s<br />", $SalatTime->Chourouk, h2hminsec($SalatTime->Chourouk));
	// if ($Verbose)	printf("<br />");
	// Calcul Maghrib (coucher)
	$erreur=ComputeTwilightHour( idMaghrib, $SalatTime->Maghrib);
	// if ($Verbose)	printf("Maghrib (Sunset) at %fh ie : %s<br />", $SalatTime->Maghrib, h2hminsec($SalatTime->Maghrib));
	// if ($Verbose)	printf("<br />");
	// Calcul Fajr (Twilight)
	$erreur=ComputeTwilightHour( idFajr, $SalatTime->Fajr);
	// if ($Verbose)	printf("Fajr (Twilight) at %fh ie : %s<br />", $SalatTime->Fajr, h2hminsec($SalatTime->Fajr));
	// if ($Verbose)	printf("<br />");
	// Calcul Isha (Twilight) or Maghrib+
	if ($SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus)
						$SalatTime->Isha=$SalatTime->Maghrib + $SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus_min/60.0;
			else	$erreur=ComputeTwilightHour( idIsha, $SalatTime->Isha);
//	if ($Verbose)	{
//								if ($SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus)
//											printf("Isha (Maghrib_plus %dmn) at %fh ie : %s<br />", $SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus_min, $SalatTime->Isha, h2hminsec($SalatTime->Isha));
//											else printf("Isha (Twilight) at %fh ie : %s<br />", $SalatTime->Isha, h2hminsec($SalatTime->Isha));
//								}
	// if ($Verbose)	printf("<br />");
	// Calcul Asr (arccot(1+tan(B-D)))
	$erreur=ComputeTwilightHour( idAsr, $SalatTime->Asr);
	// if ($Verbose)	printf("Asr (%s) at %fh ie : %s<br />", $SalatTimeConfig[$Convention]->AsrShafi>=0 ? "Shafi":"Hanafi", $SalatTime->Asr, h2hminsec($SalatTime->Asr));
	// if ($Verbose)	printf("<br />");

	// calcule les vraies heures de prière
	$SalatTimeC->Fajr=$SalatTime->Fajr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Fajr/60.0;
	$SalatTimeC->Chourouk=$SalatTime->Chourouk +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Chourouk/60.0;
	if ($SalatTimeConfig[$Convention]->ZuhrFixe)	$SalatTimeC->Zuhr=$SalatTimeConfig[$Convention]->ZuhrFixeHour;
			else $SalatTimeC->Zuhr=$SalatTime->Zuhr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Zuhr/60.0;
	$SalatTimeC->Asr=$SalatTime->Asr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Asr/60.0;
	$SalatTimeC->Maghrib=$SalatTime->Maghrib +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Maghrib/60.0;
	$SalatTimeC->Isha=$SalatTime->Isha  +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Isha/60.0;
	// if ($Verbose)	printf("_______ Mawakit Salat Exactes _______<br />");
	// if ($Verbose)	printf("Fajr    =%s%s%fmn  %s<br />", h2hminsec($SalatTime->Fajr), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Fajr>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Fajr, h2hminsec($SalatTimeC->Fajr));
	// if ($Verbose)	printf("Chourouk=%s%s%fmn  %s<br />", h2hminsec($SalatTime->Chourouk), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Chourouk>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Chourouk, h2hminsec($SalatTimeC->Chourouk));
	// if ($Verbose)	{
	//								if ($SalatTimeConfig[$Convention]->ZuhrFixe)	printf("Zuhr Fixed = %s<br />", h2hminsec($SalatTimeC->Zuhr));
	//									else printf("Zuhr    =%s%s%fmn  %s<br />", h2hminsec($SalatTime->Zuhr), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Zuhr>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Zuhr, h2hminsec($SalatTimeC->Zuhr));
	//								}
	// if ($Verbose)	printf("Asr     =%s%s%fmn  %s<br />", h2hminsec($SalatTime->Asr), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Asr>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Asr, h2hminsec($SalatTimeC->Asr));
	// if ($Verbose)	printf("Maghrib =%s%s%fmn  %s<br />", h2hminsec($SalatTime->Maghrib), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Maghrib>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Maghrib, h2hminsec($SalatTimeC->Maghrib));
	// if ($Verbose)	printf("Isha    =%s%s%fmn  %s<br />", h2hminsec($SalatTime->Isha), $SalatTimeConfig[$Convention]->SalatTimeAdjust->Isha>=0 ? " +":" ", $SalatTimeConfig[$Convention]->SalatTimeAdjust->Isha, h2hminsec($SalatTimeC->Isha));
	// if ($Verbose)	printf("_______ Mawakit Salat arrondi _______<br />");

	// if ($Verbose) 	printf("Lieu : %s, %s<br />",$CountryName, $TownName);
	// if ($Verbose) 	printf("latitude=%s   longitude=%s Convention %d<br />", rd2degminsec($latitude), rd2degminsec($longitude), $Convention);
	// if ($Verbose)	printf("__ Date : %s %d/%d/%d   %s  TZ (include DST)=%d<br />",
	//												$Days[CalculeJour($T+($TimeZone+12)/24.0/36525.0)],
	//												$date->j, $date->m, $date->a, $DSTApplies ? "DST Applies": "DST does not apply", $TimeZone);
	// if ($Verbose)	printf("Fajr    =%s<br />", h2hmiarrondie($SalatTimeC->Fajr));
	// if ($Verbose)	printf("Chourouk=%s<br />", h2hmiarrondie($SalatTimeC->Chourouk));
	// if ($Verbose)	printf("Zuhr    =%s<br />", h2hmiarrondie($SalatTimeC->Zuhr));
	// if ($Verbose)	printf("Asr     =%s<br />", h2hmiarrondie($SalatTimeC->Asr));
	// if ($Verbose)	printf("Maghrib =%s<br />", h2hmiarrondie($SalatTimeC->Maghrib));
	// if ($Verbose)	printf("Isha    =%s<br />", h2hmiarrondie($SalatTimeC->Isha));
	// if ($Verbose)	printf("_____________________________________<br />");
}

//---------------------------------------------------------------------------
function CalculeNjdumois($m, $annee)
{
	$Nonbissextile=(int)(($annee-4*(int)($annee/4)+2)/3);  // 1 pour une année commune et  0 pour une bissextile)
	if ($m==1 || $m==3 || $m==5 || $m==7
	 || $m==8 || $m==10 || $m==12) 	return 31;
			else	{
						if ($m==2) {if ($Nonbissextile) return 28;
															else				return 29;
											}
								else  return 30;
				}
}
//---------------------------------------------------------------------------
function CalculeJour( $T) // à pertir du siecle Julien
{
	$jour=$T*36525+5;   
	return (int)($jour-7*(int)($jour/7));
}
//---------------------------------------------------------------------------
function OnemounthCalculate( & $CalMensuel, & $daysMensuel, $Nj)
{
	global $Verbose, $T, $date, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, 
				$SalatTime, $SalatTimeC, $SalatTimeConfig, $Convention, $CountryName, $TownName;
		for ($date->j=1; $date->j<=$Nj; $date->j++)
			{
			// début du calcul des SalatTime pour un jour
		$DSTApplies=(bool)(($DST !=0) && CalcTimeZone( $date->a, $date->m, $date->j, $DST, $TimeZoneTown));
		if ($DSTApplies)	$TimeZone=1+$TimeZoneTown;
							else		$TimeZone=$TimeZoneTown;
			// Calcul salat hour of the Day $date->j
			ComputeZuhrHour();
			$daysMensuel[$date->j-1]=CalculeJour($T+($TimeZone+12)/24.0/36525.0);  // juste pour le jour (Lundi, mardi...)
			$erreur=ComputeTwilightHour( idChourouk, $SalatTime->Chourouk);
			$erreur=ComputeTwilightHour( idMaghrib, $SalatTime->Maghrib);
			$erreur=ComputeTwilightHour( idFajr, $SalatTime->Fajr);
			// Calcul Isha (Twilight) or Maghrib+
			if ($SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus)
								$SalatTime->Isha=$SalatTime->Maghrib + $SalatTimeConfig[$Convention]->Isha_is_Maghrib_plus_min/60.0;
					else	$erreur=ComputeTwilightHour( idIsha, $SalatTime->Isha);
			// Calcul Asr (arccot(1+tan(B-D)))
			$erreur=ComputeTwilightHour( idAsr, $SalatTime->Asr);

			// calcule les vraies heures de prière
			$SalatTimeC->Fajr=$SalatTime->Fajr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Fajr/60.0;
			$SalatTimeC->Chourouk=$SalatTime->Chourouk +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Chourouk/60.0;
			if ($SalatTimeConfig[$Convention]->ZuhrFixe)	$SalatTimeC->Zuhr=$SalatTimeConfig[$Convention]->ZuhrFixeHour;
					else $SalatTimeC->Zuhr=$SalatTime->Zuhr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Zuhr/60.0;
			$SalatTimeC->Asr=$SalatTime->Asr +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Asr/60.0;
			$SalatTimeC->Maghrib=$SalatTime->Maghrib +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Maghrib/60.0;
			$SalatTimeC->Isha=$SalatTime->Isha  +$SalatTimeConfig[$Convention]->SalatTimeAdjust->Isha/60.0;
			// fin du calcul pour un jour
			$CalMensuel[$date->j-1]->Fajr=$SalatTimeC->Fajr;
			$CalMensuel[$date->j-1]->Chourouk=$SalatTimeC->Chourouk;
			$CalMensuel[$date->j-1]->Zuhr=$SalatTimeC->Zuhr;
			$CalMensuel[$date->j-1]->Asr=$SalatTimeC->Asr;
			$CalMensuel[$date->j-1]->Maghrib=$SalatTimeC->Maghrib;
			$CalMensuel[$date->j-1]->Isha=$SalatTimeC->Isha;
			}
}
//---------------------------------------------------------------------------
function OneDayXML()
{
	global $date, $Days, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, 
				$SalatTime, $SalatTimeC, $SalatTimeConfig, $Convention;
	$T=JulianCentury ($date->j, $date->m, $date->a, 12);    // pour 12h
	$jour=CalculeJour($T+0.5/36525.0); 
	$Nj=CalculeNjdumois( $date->m, $date->a);
	ComputeSalatTime();
// Start XML file, create parent node
	header("Content-type: text/xml"); 
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("jours");
	$parnode = $dom->appendChild($node); 
	if (($latitude!=0) && ($longitude!=0))	  $parnode->setAttribute("erreurformatage", "");
					else														  $parnode->setAttribute("erreurformatage", "error");

  $node = $dom->createElement("day");  
  $newnode = $parnode->appendChild($node);
	$newnode->setAttribute("date_j_text",$Days[$jour]);
	$newnode->setAttribute("date",$date->j."/".$date->m."/".$date->a);
	$newnode->setAttribute("fajr",h2hmiarrondie($SalatTimeC->Fajr));
	$newnode->setAttribute("chourouk",h2hmiarrondie($SalatTimeC->Chourouk));
	$newnode->setAttribute("zuhr",h2hmiarrondie($SalatTimeC->Zuhr));
	$newnode->setAttribute("asr",h2hmiarrondie($SalatTimeC->Asr));
	$newnode->setAttribute("maghrib",h2hmiarrondie($SalatTimeC->Maghrib));
	$newnode->setAttribute("isha",h2hmiarrondie($SalatTimeC->Isha));

	echo $dom->saveXML();
}
//---------------------------------------------------------------------------
function OneMounthXML()
{
	global $Verbose, $date, $Days, $Mounths, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, 
				$SalatTime, $SalatTimeC, $SalatTimeConfig, $Convention, $CountryName, $TownName;
	$Nj=CalculeNjdumois( $date->m, $date->a);
	for($i=0; $i<$Nj; $i++)
		$CalMensuel[$i]=new SalatTimeStruct();		// inutile mais bon, j'initialise la classe !!!
	OnemounthCalculate( $CalMensuel , $daysMensuel, $Nj);  // calcul les heures et le stocke

// Start XML file, create parent node
	header("Content-type: text/xml"); 
	$dom = new DOMDocument("1.0");
	$nodem = $dom->createElement("mounth");
	$parnodem = $dom->appendChild($nodem); 
	if (($latitude!=0) && ($longitude!=0))	  $parnodem->setAttribute("erreurformatage", "");
					else														  $parnodem->setAttribute("erreurformatage", "error");
	$parnodem->setAttribute("date_m", $date->m);
	$parnodem->setAttribute("date_m_text", $Mounths[$date->m-1]);
	$parnodem->setAttribute("date_a", $date->a);

	for ($date->j=1; $date->j<=$Nj; $date->j++)
		{
		$node = $dom->createElement("day");  
		$newnode = $parnodem->appendChild($node);
		$newnode->setAttribute("date_j_text",$Days[$daysMensuel[$date->j-1]]);
		$newnode->setAttribute("date_j",$date->j);
		$newnode->setAttribute("fajr",h2hmiarrondie($CalMensuel[$date->j-1]->Fajr));
		$newnode->setAttribute("chourouk",h2hmiarrondie($CalMensuel[$date->j-1]->Chourouk));
		$newnode->setAttribute("zuhr",h2hmiarrondie($CalMensuel[$date->j-1]->Zuhr));
		$newnode->setAttribute("asr",h2hmiarrondie($CalMensuel[$date->j-1]->Asr));
		$newnode->setAttribute("maghrib",h2hmiarrondie($CalMensuel[$date->j-1]->Maghrib));
		$newnode->setAttribute("isha",h2hmiarrondie($CalMensuel[$date->j-1]->Isha));
		}

	echo $dom->saveXML();
}
//---------------------------------------------------------------------------
function OneYearXML()
{
	global $Verbose, $date, $Days, $Mounths, $longitude, $latitude, $TimeZoneTown, $TimeZone, $DST, $DSTApplies, 
				$SalatTime, $SalatTimeC, $SalatTimeConfig, $Convention, $CountryName, $TownName;
// Start XML file, create parent node
	header("Content-type: text/xml"); 
	$dom = new DOMDocument("1.0");
	$nodey = $dom->createElement("year");
	$parnodey = $dom->appendChild($nodey); 
	if (($latitude!=0) && ($longitude!=0))	  $parnodey->setAttribute("erreurformatage", "");
					else														  $parnodey->setAttribute("erreurformatage", "error");
	$parnodey->setAttribute("date_a", $date->a);
	for ($date->m=1; $date->m<=12; $date->m++)
		{
		$Nj=CalculeNjdumois( $date->m, $date->a);
		for($i=0; $i<$Nj; $i++)
			$CalMensuel[$i]=new SalatTimeStruct();		// inutile mais bon, j'initialise la classe !!!
		OnemounthCalculate( $CalMensuel , $daysMensuel, $Nj);  // calcul les heures et le stocke

		$nodem = $dom->createElement("mounth");
		$parnodem = $parnodey->appendChild($nodem); 
		$parnodem->setAttribute("date_m", $date->m);
		$parnodem->setAttribute("date_m_text", $Mounths[$date->m-1]);

		for ($date->j=1; $date->j<=$Nj; $date->j++)
			{
			$node = $dom->createElement("day");  
			$newnode = $parnodem->appendChild($node);
			$newnode->setAttribute("date_j_text",$Days[$daysMensuel[$date->j-1]]);
			$newnode->setAttribute("date_j",$date->j);
			$newnode->setAttribute("fajr",h2hmiarrondie($CalMensuel[$date->j-1]->Fajr));
			$newnode->setAttribute("chourouk",h2hmiarrondie($CalMensuel[$date->j-1]->Chourouk));
			$newnode->setAttribute("zuhr",h2hmiarrondie($CalMensuel[$date->j-1]->Zuhr));
			$newnode->setAttribute("asr",h2hmiarrondie($CalMensuel[$date->j-1]->Asr));
			$newnode->setAttribute("maghrib",h2hmiarrondie($CalMensuel[$date->j-1]->Maghrib));
			$newnode->setAttribute("isha",h2hmiarrondie($CalMensuel[$date->j-1]->Isha));
			}

		}
	echo $dom->saveXML();
}
//---------------------------------------------------------------------------
// programme principal :
//---------------------------------------------------------------------------
	$latitudeselected=$latitudeinput;
	$longitudeselected=$longitudeinput;
	$TimeZoneTown=$Timezoneinput;
	$DST=$DSTinput;
	$Convention=$Conventioninput;
	$longitude=deg2rd*$longitudeselected;
	$latitude=deg2rd*$latitudeselected;

	if ($anneeinput == "")	$anneeinput=date("Y");
	if ($moisinput == "")		$moisinput=date("n");
	if ($jourinput == "")		$jourinput=date("j");

	init();		// call ReadConfigFile() "data.cfg"
	$date->a=$anneeinput; $date->m=$moisinput; $date->j=$jourinput; 

	if ($multiinput=="y") OneYearXML();
		else	if ($multiinput=="m")	OneMounthXML();
			else	OneDayXML();
?>
