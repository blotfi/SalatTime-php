-----------------
- English
-----------------



-----------------
- Fran�ais
-----------------
st.html			:	version d�mo simple
stm.html		: version d�mo avec table du mois
calcst.php	:	Calcul des horaires de priere (Salat) Lotfi BAGHLI 02/2007 - 04/2012
							Usage : fichier "stand alone",
							Donnez l'ann�e, le mois, le jour, latitude, longitude, Convention, TimeZone, DST
							&ConventionDetails=1 uniquement pour debug
							Exemple pour "Tlemcen ", 34.879200 , -1.315300
							calcst.php?anneeinput=2012&moisinput=4&jourinput=27&latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
							Pour avoir les horaires du jour :
							calcst.php?latitudeinput=34.879200&longitudeinput=-1.315300&Conventioninput=1&Timezoneinput=1&DSTinput=0
							Pour les convention : 0 : France UOIF, 1 : Alg�rie, 8: Maroc... voir ReadConventions()
							pour le mois ajouter : &multiinput=m
							pour l'ann�e ajouter : &multiinput=y
algerie.js , france.jvs : Contient les coordonn�es des villes (nom, latitude, longitude) du pays consid�r�, la convention de calcul utilis�, l'heure d'�t� (DST), d�callage heure (TimeZone), 
			