var osd = "  *** "
osd +="Program Pemberdayaan Masyarakat Riau - PT Riau Andalan Pulp And Paper";
osd +="  ***  ";
var timer;
var msg = "";
function scrollMaster () {
msg = customDateSpring(new Date())
clearTimeout(timer)
msg += " " + showtime() + " " + osd
for (var i= 0; i < 100; i++){
msg = " " + msg;
}
scrollMe()
}
function scrollMe(){
window.status = msg;
msg = msg.substring(1, msg.length) + msg.substring(0,1);
timer = setTimeout("scrollMe()", 100);
}
function showtime (){
var now = new Date();
var hours= now.getHours();
var minutes= now.getMinutes();
var seconds= now.getSeconds();
var months= now.getMonth();
var dates= now.getDate();
var years= now.getYear();
var timeValue = ""
timeValue += ((months >9) ? "" : " ")
timeValue += ((dates >9) ? "" : " ")
timeValue = ( months +1)
timeValue +="/"+ dates
timeValue +="/"+  years
var ap="A.M."
if (hours == 12) {
ap = "P.M."
}
if (hours == 0) {
hours = 12
}
if(hours >= 13){
hours -= 12;
ap="P.M."
}
var timeValue2 = " " + hours
timeValue2 += ((minutes < 10) ? ":0":":") + minutes + " " + ap
return timeValue2;
}
function MakeArray(n) {
this.length = n
return this
}
monthNames = new MakeArray(12)
monthNames[1] = "January"
monthNames[2] = "February"
monthNames[3] = "March"
monthNames[4] = "April"
monthNames[5] = "May"
monthNames[6] = "June"
monthNames[7] = "July"
monthNames[8] = "August"
monthNames[9] = "Sept."
monthNames[10] = "Oct."
monthNames[11] = "Nov."
monthNames[12] = "Dec."
daysNames = new MakeArray(7)
daysNames[1] = "Sunday"
daysNames[2] = "Monday"
daysNames[3] = "Tuesday"
daysNames[4] = "Wednesday"
daysNames[5] = "Thursday"
daysNames[6] = "Friday"
daysNames[7] = "Saturday"
function customDateSpring(oneDate) {
var theDay = daysNames[oneDate.getDay() +1]
var theDate =oneDate.getDate()
var theMonth = monthNames[oneDate.getMonth() +1]
var dayth="th"
if ((theDate == 1) || (theDate == 21) || (theDate == 31)) {
dayth="st";
}
if ((theDate == 2) || (theDate ==22)) {
dayth="nd";
}
if ((theDate== 3) || (theDate  == 23)) {
dayth="rd";
}
return theDay + ", " + theMonth + " " + theDate + dayth + ","
}
scrollMaster();