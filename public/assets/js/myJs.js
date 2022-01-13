$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});


var burger = document.getElementById('burger-menu')
var search = document.getElementById('formSearch')
var etat = burger.getAttribute('aria-expanded');
var myCollapsible = document.getElementById('navbarSupportedContent');
    
myCollapsible.addEventListener('show.bs.collapse', function () {
    burger.classList.remove('order-5');
    search.classList.remove('order-3');
    burger.classList.add('order-1');
    search.classList.add('order-1');
  })
myCollapsible.addEventListener('hidden.bs.collapse', function () {
    burger.classList.remove('order-1');
    search.classList.remove('order-1');
    burger.classList.add('order-5');
    search.classList.add('order-3');
  })
