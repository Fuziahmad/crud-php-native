function change() {
  var x = document.getElementById('pass').type;

  if (x == 'password') {
      //form input password menjadi text
      document.getElementById('pass').type = 'text';
      
      //icon mata terbuka menjadi tertutup
      document.getElementById('showHide').innerHTML = `<i class="fa-sharp fa-solid fa-eye-slash"></i>`;
  }
  else {

      //form input password menjadi text
      document.getElementById('pass').type = 'password';

      //icon mata terbuka menjadi tertutup
      document.getElementById('showHide').innerHTML = `<i class="fa-sharp fa-solid fa-eye"></i>`;
  }
}