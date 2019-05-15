
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}


function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}

function openPage(pageName, elmnt) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";
  evt.currentTarget.className += " active";    

  // Add the specific color to the button used to open the tab content
  //elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

//open form window - for profile page
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
function openForm1() {
  document.getElementById("myForm1").style.display = "block";
}
function closeForm1() {
  document.getElementById("myForm1").style.display = "none";
} 
function openForm2() {
  document.getElementById("myForm2").style.display = "block";
}
function closeForm2() {
  document.getElementById("myForm2").style.display = "none";
}
function openForm3() {
  document.getElementById("myForm3").style.display = "block";
}
function closeForm3() {
  document.getElementById("myForm3").style.display = "none";
}
function openForm4() {
  document.getElementById("myForm4").style.display = "block";
}
function closeForm4() {
  document.getElementById("myForm4").style.display = "none";
}
function openForm5() {
  document.getElementById("myForm5").style.display = "block";
}
function closeForm5() {
  document.getElementById("myForm5").style.display = "none";
}