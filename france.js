// pour la France :
var Conventioninput=0;
var Timezoneinput=1;
var DSTinput=1;

var NTowns=183;
	function TownData(nom, lat, lon)
	{
	this.TownName = nom;
	this.latitude = lat;
	this.longitude = lon;
	}

	var Towns=new Array(
new TownData("Aix-en-Provence", 43.524900 , 5.454140 ),
new TownData("Ajaccio ", 50.430700 , 2.937920 ),
new TownData("Albi ", 43.927400 , 2.148260 ),
new TownData("Al�s ", 44.127400 , 4.079030 ),
new TownData("Alfortville ", 48.798800 , 2.423440 ),
new TownData("Amiens ", 49.893900 , 2.294240 ),
new TownData("Angers ", 47.469400 , -0.549000 ),
new TownData("Angoul�me ", 45.648300 , 0.160924 ),
new TownData("Annecy ", 45.899600 , 6.128460 ),
new TownData("Antibes ", 43.580700 , 7.120870 ),
new TownData("Antony ", 48.753700 , 2.297110 ),
new TownData("Argenteuil ", 48.941600 , 2.247060 ),
new TownData("Arles ", 43.676700 , 4.627800 ),
new TownData("Arras ", 50.292900 , 2.782500 ),
new TownData("Asni�res-sur-Seine", 48.918200 , 2.283550 ),
new TownData("Aubagne ", 43.293300 , 5.570280 ),
new TownData("Aubervilliers ", 48.914800 , 2.381210 ),
new TownData("Aulnay-sous-Bois", 48.940200 , 2.502250 ),
new TownData("Auxerre ", 47.798300 , 3.574400 ),
new TownData("Avignon ", 43.948600 , 4.805970 ),
new TownData("Bagneux ", 48.797900 , 2.313700 ),
new TownData("Bastia ", 43.477300 , -0.126200 ),
new TownData("Bayonne ", 43.493400 , -1.474540 ),
new TownData("Beauvais ", 49.429300 , 2.081070 ),
new TownData("Belfort ", 47.638800 , 6.862220 ),
new TownData("Besan�on ", 47.241200 , 6.025570 ),
new TownData("B�ziers ", 43.341600 , 3.217820 ),
new TownData("Blanc-Mesnil ", 48.938300 , 2.460490 ),
new TownData("Blois ", 47.585900 , 1.330100 ),
new TownData("Bobigny ", 48.906400 , 2.440490 ),
new TownData("Bondy ", 48.902200 , 2.482650 ),
new TownData("Bordeaux ", 44.837400 , -0.576144 ),
new TownData("Boulogne-Billancourt", 48.833800 , 2.243440 ),
new TownData("Boulogne-sur-Mer", 50.725600 , 1.614880 ),
new TownData("Bourg-en-Bresse", 46.204800 , 5.225500 ),
new TownData("Bourges ", 47.082900 , 2.396580 ),
new TownData("Brest ", 48.390600 , -4.486900 ),
new TownData("Brive-la-Gaillarde", 45.158600 , 1.532630 ),
new TownData("Bron ", 45.733600 , 4.908610 ),
new TownData("Caen ", 49.184800 , -0.360161 ),
new TownData("Cagnes-sur-Mer ", 43.662500 , 7.149480 ),
new TownData("Calais ", 50.957900 , 1.852140 ),
new TownData("Caluire-et-Cuire", 45.796300 , 4.842380 ),
new TownData("Cannes ", 43.550900 , 7.010590 ),
new TownData("Cannet ", 43.576200 , 7.019580 ),
new TownData("Carcassonne ", 43.212600 , 2.356100 ),
new TownData("Castres ", 43.605300 , 2.241010 ),
new TownData("Cergy ", 49.052500 , 2.038830 ),
new TownData("Chalon-sur-Sa�ne", 46.784200 , 4.852950 ),
new TownData("Ch�lons-en-Champagne", 48.955200 , 4.363640 ),
new TownData("Chamb�ry ", 45.566700 , 5.920990 ),
new TownData("Champigny-sur-Marne", 48.817300 , 2.497390 ),
new TownData("Charleville-M�zi�res", 49.773600 , 4.720210 ),
new TownData("Chartres ", 48.444400 , 1.484170 ),
new TownData("Ch�teauroux ", 46.808200 , 1.691820 ),
new TownData("Chelles ", 48.880700 , 2.593840 ),
new TownData("Cholet ", 47.057900 , -0.879121 ),
new TownData("Clamart ", 48.799100 , 2.262480 ),
new TownData("Clermont-Ferrand", 45.777200 , 3.082420 ),
new TownData("Clichy ", 48.902700 , 2.304080 ),
new TownData("Colmar ", 48.080700 , 7.359970 ),
new TownData("Colombes ", 48.923000 , 2.255000 ),
new TownData("Compi�gne ", 49.415800 , 2.822480 ),
new TownData("Corbeil-Essonnes", 48.615800 , 2.462900 ),
new TownData("Courbevoie ", 48.896800 , 2.256520 ),
new TownData("Cr�teil ", 48.788900 , 2.452030 ),
new TownData("Dieppe ", 49.927500 , 1.087870 ),
new TownData("Dijon ", 47.327200 , 5.043990 ),
new TownData("Douai ", 50.367500 , 3.082490 ),
new TownData("Drancy ", 48.919800 , 2.451480 ),
new TownData("Dreux ", 48.738300 , 1.361130 ),
new TownData("Dunkerque ", 51.034300 , 2.376820 ),
new TownData("Epinal ", 48.174800 , 6.449980 ),
new TownData("Epinay-sur-Seine", 48.953200 , 2.312720 ),
new TownData("Evreux ", 49.024500 , 1.151160 ),
new TownData("Evry ", 48.624700 , 2.430840 ),
new TownData("Fontenay-sous-Bois", 48.851200 , 2.474340 ),
new TownData("Fr�jus ", 43.432500 , 6.735180 ),
new TownData("Gagny ", 48.882800 , 2.534870 ),
new TownData("Garges-l�s-Gonesse", 48.972600 , 2.389230 ),
new TownData("Gennevilliers ", 48.933500 , 2.299270 ),
new TownData("Grasse ", 43.658600 , 6.923550 ),
new TownData("Grenoble ", 45.194300 , 5.731610 ),
new TownData("Havre ", 49.492600 , 0.106503 ),
new TownData("Hy�res ", 43.119900 , 6.128580 ),
new TownData("Issy-les-Moulineaux", 48.823100 , 2.273380 ),
new TownData("Ivry-sur-Seine ", 48.807800 , 2.374670 ),
new TownData("Jou�-l�s-Tours ", 47.344100 , 0.660914 ),
new TownData("Laval ", 48.070400 , -0.773564 ),
new TownData("Levallois-Perret", 48.894300 , 2.288340 ),
new TownData("Lille ", 50.637200 , 3.063020 ),
new TownData("Limoges ", 45.828500 , 1.261750 ),
new TownData("Livry-Gargan ", 48.916500 , 2.531590 ),
new TownData("Lorient ", 47.750100 , -3.366290 ),
new TownData("Lyon ", 45.757800 , 4.835100 ),
new TownData("M�con ", 46.306300 , 4.829190 ),
new TownData("Maisons-Alfort ", 48.805700 , 2.440860 ),
new TownData("Mans ", 47.869200 , -0.128695 ),
new TownData("Mantes-la-Jolie", 48.990400 , 1.719360 ),
new TownData("Marcq-en-Baroeul", 50.665500 , 3.104470 ),
new TownData("Marseille ", 43.353000 , 5.427670 ),
new TownData("Martigues ", 43.407400 , 5.054840 ),
new TownData("Massy ", 48.730300 , 2.272870 ),
new TownData("Meaux ", 48.957700 , 2.881820 ),
new TownData("Melun ", 48.541500 , 2.660290 ),
new TownData("M�rignac ", 44.841800 , -0.647795 ),
new TownData("Metz ", 49.116100 , 6.172700 ),
new TownData("Meudon ", 48.812200 , 2.238310 ),
new TownData("Montauban ", 44.017600 , 1.358910 ),
new TownData("Montlu�on ", 46.342400 , 2.607570 ),
new TownData("Montpellier ", 43.608500 , 3.879210 ),
new TownData("Montreuil ", 48.858200 , 2.436870 ),
new TownData("Montrouge ", 48.818500 , 2.319930 ),
new TownData("Mulhouse ", 47.749500 , 7.339780 ),
new TownData("Nancy ", 48.690800 , 6.182500 ),
new TownData("Nanterre ", 48.890000 , 2.197050 ),
new TownData("Nantes ", 47.216800 , -1.556740 ),
new TownData("Narbonne ", 43.183600 , 3.004190 ),
new TownData("Neuilly-sur-Seine", 48.883600 , 2.272510 ),
new TownData("Nevers ", 46.987200 , 3.161840 ),
new TownData("Nice ", 43.703400 , 7.266200 ),
new TownData("N�mes ", 43.834600 , 4.360860 ),
new TownData("Niort ", 46.323900 , -0.457584 ),
new TownData("Noisy-le-Grand ", 48.847800 , 2.552810 ),
new TownData("Noisy-le-Sec ", 48.890100 , 2.452870 ),
new TownData("Orl�ans ", 47.901400 , 1.903980 ),
new TownData("Pantin ", 48.893100 , 2.412720 ),
new TownData("Paris ", 48.858900 , 2.347000 ),
new TownData("Pau ", 43.297500 , -0.374362 ),
new TownData("Perpignan ", 42.701600 , 2.894150 ),
new TownData("Pessac ", 44.803700 , -0.631678 ),
new TownData("Poissy ", 48.928600 , 2.041800 ),
new TownData("Poitiers ", 46.587000 , 0.342648 ),
new TownData("Puteaux ", 48.883300 , 2.237680 ),
new TownData("Quimper ", 47.995900 , -4.099780 ),
new TownData("Reims ", 49.256600 , 4.033090 ),
new TownData("Rennes ", 48.111800 , -1.680260 ),
new TownData("Roanne ", 46.039200 , 4.071870 ),
new TownData("Roche-sur-Yon ", 46.669400 , -1.418720 ),
new TownData("Rochelle ", 46.158100 , -1.153640 ),
new TownData("Rosny-sous-Bois", 48.874300 , 2.482550 ),
new TownData("Roubaix ", 50.691300 , 3.173200 ),
new TownData("Rouen ", 49.442400 , 1.098490 ),
new TownData("Rueil-Malmaison", 48.877400 , 2.179130 ),
new TownData("Sarcelles ", 48.996300 , 2.379460 ),
new TownData("Sartrouville ", 48.945800 , 2.172280 ),
new TownData("S�te ", 43.401700 , 3.696610 ),
new TownData("Sevran ", 48.937900 , 2.529770 ),
new TownData("Seyne-sur-Mer ", 43.094500 , 5.882860 ),
new TownData("St-Brieuc ", 48.513800 , -2.762640 ),
new TownData("St-Chamond ", 45.483200 , 4.510290 ),
new TownData("St-Denis ", 48.936100 , 2.364880 ),
new TownData("St-Etienne ", 45.439600 , 4.387830 ),
new TownData("St-Germain-en-Laye", 48.898700 , 2.093600 ),
new TownData("St-Herblain ", 47.214400 , -1.638880 ),
new TownData("St-Malo ", 48.648200 , -2.026090 ),
new TownData("St-Maur-des-Foss�s", 48.797900 , 2.502960 ),
new TownData("St-Nazaire ", 47.274300 , -2.213610 ),
new TownData("St-Ouen ", 48.906100 , 2.331830 ),
new TownData("St-Priest ", 45.694200 , 4.935040 ),
new TownData("St-Quentin ", 49.848200 , 3.288220 ),
new TownData("Strasbourg ", 48.582900 , 7.743750 ),
new TownData("Suresnes ", 48.870100 , 2.222140 ),
new TownData("Tarbes ", 43.232900 , 0.074121 ),
new TownData("Thionville ", 49.357100 , 6.168450 ),
new TownData("Toulon ", 43.125200 , 5.931110 ),
new TownData("Toulouse ", 43.604400 , 1.442950 ),
new TownData("Tourcoing ", 50.722500 , 3.159540 ),
new TownData("Tours ", 47.390300 , 0.688851 ),
new TownData("Troyes ", 48.297500 , 4.074800 ),
new TownData("Valence ", 44.930500 , 4.890250 ),
new TownData("Valenciennes ", 50.357600 , 3.523490 ),
new TownData("Vannes ", 47.654700 , -2.759510 ),
new TownData("Vaulx-en-Velin ", 45.777600 , 4.918800 ),
new TownData("V�nissieux ", 45.696400 , 4.883810 ),
new TownData("Versailles ", 48.802300 , 2.129820 ),
new TownData("Villejuif ", 48.795100 , 2.366530 ),
new TownData("Villeneuve-d'Ascq", 50.620700 , 3.131500 ),
new TownData("Villeurbanne ", 45.764800 , 4.880370 ),
new TownData("Vincennes ", 48.845000 , 2.434590 ),
new TownData("Vitrolles ", 43.460400 , 5.248530 ),
new TownData("Vitry-sur-Seine", 48.789400 , 2.389320 ),
new TownData("Wattrelos ", 50.701300 , 3.215650 )
);
