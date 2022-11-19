// Fasi Lunari
// Eriannen
// Copyright (c) 2007 Eriannen
// L'uso di questo script è libero senza alcuna restrizione
// paolo53b@gmail.com
// 01/12/2007

var luna
var pastdate
var pastyear=2002
var pastmonth=5
var pastday=11
var nowdate
var c
var pausenormal=50
var pausenowmoon=3000
var moonday
var i_mooncycle=1
var mooncycle=29.530589
var eta="Età della Luna = giorni "
var plen=" dal Novilunio"
var picture = new Array("lune/luna0.png", "lune/luna1.png","lune/luna2.png","lune/luna3.png","lune/luna4.png","lune/luna5.png","lune/luna6.png","lune/luna7.png","lune/luna8.png", "lune/luna9.png", "lune/luna10.png", "lune/luna11.png", "lune/luna12.png", "lune/luna13.png", "lune/luna14.png", "lune/luna15.png", "lune/luna16.png", "lune/luna17.png", "lune/luna18.png", "lune/luna19.png", "lune/luna20.png", "lune/luna21.png", "lune/luna22.png", "lune/luna23.png", "lune/luna24.png", "lune/luna25.png", "lune/luna26.png", "lune/luna27.png", "lune/luna28.png", "lune/luna29.png")
var luna=" "
var imgpreload=new Array()
for (i=0;i<=picture.length;i++) {
	imgpreload[i]=new Image()
	imgpreload[i].src=picture[i]
}

pastdate=new Date(pastyear,pastmonth,pastday,0,0,0)
nowdate=new Date()
resultdays=(Date.parse(nowdate)-Date.parse(pastdate))/1000/60/60/24
moonday=resultdays/mooncycle
moonday=(resultdays/mooncycle)-(Math.floor(resultdays/mooncycle))
moonday=Math.round(mooncycle*moonday)

/* Lune: associa nome delle lune in base al "moonday" calcolato. */
var moonPhase ; // nome della fase lunare corrente

if(moonday == 0 || moonday == 1 || moonday == 28 || moonday == 29) {
    // * [0 - 1 - 28 - 29] Luna Nuova
    moonPhase = "Luna\u00a0Nuova";
} else if(moonday >= 2 && moonday <= 5) {
    // * [2 - 5] Luna Crescente 
    moonPhase = "Luna\u00a0Crescente";
} else if(moonday >= 6 && moonday <= 9) {
    // * [6 - 9] Primo Quarto
    moonPhase = "Primo\u00a0Quarto";
} else if(moonday >= 10 && moonday <= 13) {
    // * [10 - 13] Gibbosa Crescente
    moonPhase = "Gibbosa\u00a0Crescente"
} else if(moonday >= 14 && moonday <= 15) {
    // * [14 - 15] Luna Piena
    moonPhase = "Luna\u00a0Piena";
} else if(moonday >= 16 && moonday <= 19) {
    // * [16 - 19] Gibbosa Calante
    moonPhase = "Gibbosa\u00a0Calante";
} else if(moonday >= 20 && moonday <= 23) {
    // * [20 - 23] Ultimo Quarto
    moonPhase = "Ultimo\u00a0Quarto";
} else if(moonday >= 24 && moonday <= 27) {
    // * [24 - 27] Luna Calante 
    moonPhase = "Luna\u00a0Calante";
}

c="<img src='lune/luna"+moonday+".png' name='moonimg' title="+moonPhase+">"



