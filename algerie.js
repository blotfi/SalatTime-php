// pour l'Algérie :
var Conventioninput=1;
var Timezoneinput=1;
var DSTinput=0;

var NTowns=56;
	function TownData(nom, lat, lon)
	{
	this.TownName = nom;
	this.latitude = lat;
	this.longitude = lon;
	}

	var Towns=new Array(
new TownData("Adrar ", 27.870100 , -0.289500 ),
new TownData("Aïn Defla ", 36.265200 , 1.970300 ),
new TownData("Aïn Témouchent ", 35.289100 , -1.142500 ),
new TownData("Aïn-Beida-Ouargla", 31.932600 , 5.404300 ),
new TownData("Aïn-Defla ", 36.265200 , 1.970300 ),
new TownData("Aïn-El-Beïda ", 31.917200 , 5.412780 ),
new TownData("Aïn-Témouchent ", 35.289100 , -1.142500 ),
new TownData("Alger ", 36.775500 , 3.059700 ),
new TownData("Annaba ", 36.900700 , 7.757100 ),
new TownData("Batna ", 35.553000 , 6.178900 ),
new TownData("Béchar ", 31.617900 , -2.214900 ),
new TownData("Béjaïa ", 36.756300 , 5.074100 ),
new TownData("Biskra ", 34.855600 , 5.728100 ),
new TownData("Blida ", 36.472900 , 2.825100 ),
new TownData("Bordj-Bou-Arreridj", 36.059100 , 4.630320 ),
new TownData("Bouira ", 36.374300 , 3.884100 ),
new TownData("Chlef ", 36.165100 , 1.327000 ),
new TownData("Constantine ", 36.362900 , 6.608700 ),
new TownData("Djelfa ", 34.675700 , 3.252000 ),
new TownData("El Bayadh ", 33.693500 , 1.015340 ),
new TownData("El-Bayadh ", 33.693500 , 1.015340 ),
new TownData("El-Golea ", 30.565800 , 2.865200 ),
new TownData("El-Oued ", 33.368300 , 6.867370 ),
new TownData("Es-Sénia ", 35.620100 , -0.606200 ),
new TownData("Ghardaïa ", 32.493700 , 3.672300 ),
new TownData("Guelma ", 36.470300 , 7.435500 ),
new TownData("Illizi ", 26.482100 , 8.478500 ),
new TownData("Jijel ", 36.824400 , 5.767600 ),
new TownData("Khenchela ", 35.431400 , 7.144200 ),
new TownData("Khenchla ", 35.431400 , 7.144200 ),
new TownData("Laghouat ", 33.810000 , 2.865800 ),
new TownData("M'Sila ", 35.702000 , 4.547100 ),
new TownData("Mascara ", 35.395200 , 0.136700 ),
new TownData("Medea ", 36.263000 , 2.758200 ),
new TownData("Mila ", 36.449000 , 6.262500 ),
new TownData("Mostaganem ", 35.933600 , 0.086800 ),
new TownData("Naâma ", 33.263100 , -0.313800 ),
new TownData("Oran ", 35.697700 , -0.635000 ),
new TownData("Ouargla ", 31.945700 , 5.325400 ),
new TownData("Oum El-Bouaghi ", 35.876900 , 7.114800 ),
new TownData("Oum-El-Bouaghi ", 35.876900 , 7.114800 ),
new TownData("Relizane ", 35.743800 , 0.558300 ),
new TownData("Saïda ", 34.830400 , 0.151800 ),
new TownData("Sétif ", 36.188600 , 5.407200 ),
new TownData("Sidi-Bel-Abbés ", 34.772900 , -0.525782 ),
new TownData("Skikda ", 36.879000 , 6.905200 ),
new TownData("Souk-Ahras ", 36.281200 , 7.963800 ),
new TownData("Taher ", 36.799000 , 5.882000 ),
new TownData("Tamanrasset ", 22.787100 , 5.520200 ),
new TownData("Tebessa ", 35.409000 , 8.121000 ),
new TownData("Tiaret ", 35.372000 , 1.320200 ),
new TownData("Tindouf ", 27.683100 , -8.157200 ),
new TownData("Tipaza ", 36.544800 , 2.263040 ),
new TownData("Tissemsilt ", 35.608700 , 1.812400 ),
new TownData("Tizi-Ouzou ", 36.712200 , 4.047900 ),
new TownData("Tlemcen ", 34.879200 , -1.315300 )
);

