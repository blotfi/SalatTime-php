-----------------
- English
-----------------



-----------------
- Français
-----------------
st.html			:	version démo simple
stm.html		: version démo avec table du mois
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
			