var waterwaves = document.getElementById('waterwaves');

var parallax = new Parallax(waterwaves, {
    invertX: true,
    invertY: true,
    relativeInput: true,
    originX: 0,
	calibrateX:true,
	calibrateY:true,
    originY: 0,
    scalarX: 15,
    scalarY: 15,
    limitX: 210,
    limitY: 150

})