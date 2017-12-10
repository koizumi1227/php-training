var foods = ["ラーメン", "寿司", "サラダ"];


// $('#output').click(function (){
//     $('#foods_list').append('<li>追加されました</li>');
// });



$('#output').on("click",function (){
      var list = "";
      for(var i=0; i<3; i++){
        list += '<li>' + foods[i] + '</li>'
      }
      $('#foods_list').append(list);
});


$("#food_select").on("change", function(){
  console.log($(this).val());
});

$("#food_select").change(function(){
  console.log($(this).text());
});

// $("#output").click(function() {
//   var $text=$(".text");
//   $text.text("ボタンがクリックされたよ");
// });
