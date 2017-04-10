var waterwaves = document.getElementById('waterwaves');

var parallax = new Parallax(waterwaves, {
    invertX: true,
    invertY: true,
    relativeInput: true,
    originX: 0,
    calibrateX:true,
    calibrateY:true,
    originY: 0,
    scalarX: 55,
    scalarY: 45,
    limitX: 310,
    limitY: 150,
    

})
