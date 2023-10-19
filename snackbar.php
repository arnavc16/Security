<style>
  #snackbar, .snackbars {
  visibility: hidden; /* Hidden by default. Visible on click */
  height:5vh;
  width:30vw;
  position: fixed;
  bottom:10vh;
  vertical-align: middle;
  left:35vw;
  border-radius: 20vh;
  backdrop-filter:blur(15px) brightness(200%) saturate(150%) opacity(80%);
  text-align: center;
  padding-top:1vh;
  z-index:9999;
 }
/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show, .snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */

  animation: fadein 0.5s, fadeout 0.5s 3.5s;
}



@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 10vh; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 10vh; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 10vh; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>
<script>
function show() {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

</script>