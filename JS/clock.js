setInterval(function() {
  // Add Date object
  var date = new Date();
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var day = date.getDate();
  var month = date.getMonth();
  var year = date.getFullYear();
  var hour = date.getHours();
  var minute = date.getMinutes();
  var second = date.getSeconds()

  if(second/10 < 1) { second = "0" + second; }
  if(minute/10 < 1) { minute = "0" + minute; }
  if(hour/10 < 1) { hour = "0" + hour; }

  if(day%10 == 1 && day != 11){
    day = day + "st";
  } else if(day%10 == 2 && day != 12) {
    day = day + "nd";
  } else if(day%10 == 3 && day != 13) {
    day = day + "rd";
  } else { day = day + "th"; }

  var time = `${hour}:${minute}:${second}`
  var fullTime = `${time} <br> ${day} <br> ${months[month]} <br> ${year}`;
  // Select the Clock div
  document.querySelector(".clock").innerHTML = fullTime;
}, 100);
