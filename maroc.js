// pour le Maroc :
var Conventioninput=8;
var Timezoneinput=0;
var DSTinput=0;

var NTowns=40;
	function TownData(nom, lat, lon)
	{
	this.TownName = nom;
	this.latitude = lat;
	this.longitude = lon;
	}

	var Towns=new Array(
new TownData("Agadir ", 30.414400 , -9.596500 ),
new TownData("Aït Baha ", 30.071500 , -9.161640 ),
new TownData("Aït Melloul ", 30.321800 , -9.514060 ),
new TownData("Al Hoceima ", 35.249300 , -3.937110 ),
new TownData("Azilal ", 31.966900 , -6.566200 ),
new TownData("Ben Slimane ", 33.623300 , -7.120640 ),
new TownData("Beni Mellal ", 32.350200 , -6.358790 ),
new TownData("Berkane ", 34.922700 , -2.327350 ),
new TownData("Boulemane ", 30.366700 , -7.933330 ),
new TownData("Casablanca ", 33.588900 , -7.608900 ),
new TownData("Chichaoua ", 31.546500 , -8.762600 ),
new TownData("El Hajeb ", 33.698100 , -5.364790 ),
new TownData("El Jadida ", 33.255900 , -8.507830 ),
new TownData("Essaouira ", 31.498400 , -9.762000 ),
new TownData("Fès ", 34.046900 , -4.996300 ),
new TownData("Figuig ", 32.101000 , -1.221400 ),
new TownData("Guelmim ", 28.981600 , -10.059900),
new TownData("Ifrane ", 34.050000 , -3.766670 ),
new TownData("Jerada ", 34.310000 , -2.160800 ),
new TownData("Kénitra ", 34.272900 , -6.576000 ),
new TownData("Khémisset ", 33.823800 , -6.063600 ),
new TownData("Khenifra ", 32.938600 , -5.668200 ),
new TownData("Khouribga ", 32.881000 , -6.911100 ),
new TownData("Larache ", 35.191800 , -6.153600 ),
new TownData("Marrakech ", 31.637300 , -8.017500 ),
new TownData("Meknès ", 33.895100 , -5.555000 ),
new TownData("Nador ", 33.616700 , -3.733330 ),
new TownData("Ouarzazate ", 30.918800 , -6.897500 ),
new TownData("Oujda ", 34.694300 , -1.918300 ),
new TownData("Rabat ", 33.990500 , -6.870400 ),
new TownData("Safi ", 32.297700 , -9.234700 ),
new TownData("Sefrou ", 33.826400 , -4.834700 ),
new TownData("Settat ", 33.006200 , -7.619300 ),
new TownData("Tan-Tan ", 28.435700 , -11.101700),
new TownData("Tanger ", 35.772800 , -5.823500 ),
new TownData("Taounate ", 34.535800 , -4.640100 ),
new TownData("Tata ", 29.742800 , -7.972600 ),
new TownData("Taza ", 34.223400 , -4.006900 ),
new TownData("Tétouan ", 35.572000 , -5.372300 ),
new TownData("Tiznit ", 29.692200 , -9.723800 )
);