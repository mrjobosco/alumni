  
  var max_fields  = 20;
  var wrapper   = $(".input_fields_wrap");
  var add_button  = $(".add_field_button");

  var x = Number($('#count').val());
  var j = Number($('#count').val());
  j = j+1;
  $(add_button).click(function(e){
    e.preventDefault();
    if(x < max_fields)
    {
      x++;
      $(wrapper).append('<div class="form-group">\
                      <label for="inputPassword3" class="col-sm-1 control-label">Q '+ j +':</label>\
                      <div class="col-sm-7">\
                        <textarea class="form-control" required name="questions[]"></textarea>\
                      </div>\
                    <div class="col-sm-4">\
                      <div class="radio radio-info radio-inline">\
                        <input type="radio" id="inlineRadio1'+j+'" value="True" name="radioInline'+j+'">\
                        <label for="inlineRadio1'+j+'"> True </label>\
                    </div>\
                    <div class="radio radio-inline">\
                        <input type="radio" id="inlineRadio2'+j+'" value="False" name="radioInline'+j+'">\
                        <label for="inlineRadio2'+j+'"> False </label>\
                    </div>\
                    <div class="radio radio-inline">\
                        <input type="radio" checked id="inlineRadio3'+j+'" value="null" name="radioInline'+j+'">\
                        <label for="inlineRadio3'+j+'"> Not Applicable </label>\
                    </div>\
                    </div>\
                    </div>');
    j++;
    }
  });

$(wrapper).on("click",".remove_field",function(e){
  e.preventDefault();$(this).parent('div').remove(); x--;
})


$('#student_result_button').click(function() {
  window.location = "view_child_result.php";
});

