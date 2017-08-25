$(document).ready(function(){

 $('.category_action').change(function(){
  if($(this).val() != '') //jeżeli ten element nie jest pusty to wykonaj niżej
  {
   var action = $(this).attr("id"); //zmienna pobiera id selektor głównego
   var query = $(this).val(); //pobiera wartość value z pola select ustawioną w petli while na początku
                              //i przekaże ją do sqla w url ajaxa by dobrać wartości kategori dodatkowej

   var result = ''; //tworzymy pustą zmienną

   if(action == "category") //zrobione tak by potem rozbudować do 3 lub więcej selectow
   {
    result = 'subcategory';
   }

   $.ajax({
    url:"create_offer_fetch.php", //plik jaki pobierze dane dla subkategori
    method:"POST",
    data:{action:action, query:query}, //jakie dane ma przesłać
    success:function(data){
     $('#'+result).html(data); //wrzuca ustawioną podkategorię do # bazującą na tym co weszło w kategori głównej i pobiera dane z url
    }
   })
  }
 });
 
});
