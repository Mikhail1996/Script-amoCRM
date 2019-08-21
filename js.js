// Обработчик кнопки добавления сделки
$("#addbutton").click( function(event){
    event.preventDefault();
    
    var sentdata = $("#addform").serialize();
    
    $.ajax({
      url: "script2.php",
      type: "POST",
      data: sentdata,
      success: function(msg){
        alert(msg);                
      }
    });
});

// Обработчик кнопки вывода сделок
$("#getbutton").click( function(event){
    
    $.ajax({
      url: "script1.php",
      success: function(msg){
        $("#dealtable").html(msg);
      }
    });
    
});