# SalatTime-php
Salat time calculation algorithms in PHP with different conventions for European and Arab countries
------------------------------------------
- English
------------------------------------------
st.html			: simple demo version	(excute it on a web server)

stm.html		: demo version with month salat time table	(excute it on a web server)

calcst.php	: Calculation of prayer times (Salat) Lotfi BAGHLI 02/2007 - 04/2012

	Usage: "stand alone" file,
	Give Year, Month, Day, Latitude, Longitude, Convention, TimeZone, DST
	& ConventionDetails = 1 only for debug
	Example for "Tlemcen", 34.879200, -1.315300
	calcst.php?anneeinput=2012&moisinput=4&jourinput=27&latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
	To have the schedules of the day:
	calcst.php?latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
	For the conventions: 0: France UOIF, 1: Algeria, 8: Morocco ... see ReadConventions()
	for the month add:  &multiinput=m
	for the year add:  &multiinput=y

algerie.js, france.jvs: Contains the coordinates of cities (name, latitude, longitude) of the country in question, the calculation convention used, daylight saving time (DST), time zone offset (TimeZone),

------------------------------------------
- Français
------------------------------------------
st.html			:	version démo simple (à exécuter sur un serveur web)

stm.html		: version démo avec table du mois (à exécuter sur un serveur web)

calcst.php	:	Calcul des horaires de priere (Salat) Lotfi BAGHLI 02/2007 - 04/2012

	Usage : fichier "stand alone",
	Donnez l'année, le mois, le jour, latitude, longitude, Convention, TimeZone, DST
	&ConventionDetails=1 uniquement pour debug
	Exemple pour "Tlemcen ", 34.879200 , -1.315300
	calcst.php?anneeinput=2012&moisinput=4&jourinput=27&latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
	Pour avoir les horaires du jour :
	calcst.php?latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
	Pour les convention : 0 : France UOIF, 1 : Algérie, 8: Maroc... voir ReadConventions()
	pour le mois ajouter : &multiinput=m
	pour l'année ajouter : &multiinput=y
algerie.js , france.jvs : Contient les coordonnées des villes (nom, latitude, longitude) du pays considéré, la convention de calcul utilisé, l'heure d'été (DST), décallage heure (TimeZone), 
			
