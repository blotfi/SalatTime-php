// pour l'Arabie Saoudite :
var Conventioninput=5;
var Timezoneinput=3;
var DSTinput=0;

var NTowns=14;
	function TownData(nom, lat, lon)
	{
	this.TownName = nom;
	this.latitude = lat;
	this.longitude = lon;
	}

	var Towns=new Array(
new TownData("Abha ", 18.220200 , 42.508200 ),
new TownData("Ad Dammam ", 26.400900 , 50.146500 ),
new TownData("Al Baha ", 20.260500 , 41.641400 ),
new TownData("Al Madinah ", 24.460900 , 39.620200 ),
new TownData("Ar ar ", 30.980800 , 41.025000 ),
new TownData("Buraidah ", 26.332900 , 43.982700 ),
new TownData("Ha'il ", 27.490200 , 41.696000 ),
new TownData("Jeddah ", 21.543500 , 39.173000 ),
new TownData("Jizan ", 16.883700 , 42.564800 ),
new TownData("Mekkah ", 21.427400 , 39.814800 ),
new TownData("Najran ", 17.491700 , 44.132300 ),
new TownData("Riyadh ", 24.688000 , 46.722400 ),
new TownData("Skaka ", 29.800000 , 39.850000 ),
new TownData("Tabuk ", 28.390400 , 36.573200 )
);
