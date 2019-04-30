function $$($data){
    var firstchar = $data.charAt(0);
    if(firstchar == '%'){
      var data = $data.slice(1);
      var ol = $("textarea[name="+data+"]");
      return ol;
    }
    else{
    var ol = $("input[name="+$data+"]");
    return ol;}
  }
function simpleAjax($data,url,handle){
    $.ajax({
        url: url,
        method: "POST",
        data: $data,
        success: function(data){
           return handle(data);
        }
    })
}
function jsonAjax($data,url,handle){
  $.ajax({
      url: url,
      method: "POST",
      dataType: "json",
      data: $data,
      success: function(data){
         return handle(data);
      }
  })
}
function formAjax($data,url,handle){
  $.ajax({
      url: url,
      method: "POST",
      data: $data,
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      success: function(data){
         return handle(data);
         
      }
  })
}
function formAjaxNoJson($data,url,handle){
  $.ajax({
      url: url,
      method: "POST",
      data: $data,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data){
         return handle(data);
         
      }
  })
}
var result = [];
  $.fn.checkempty = function() {
      var value = this.val();
      var str = this.attr('name');
      var write = str.replace('_',' ');
      if(value==''){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Please Enter<span>");
        result.push('false')
      }  
       return this; 
  }
  $.fn.checkemail = function() {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      var value = this.val();
      var str = this.attr('name');
      var write = str.replace('_',' ');
      if(value==''){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Please Enter<span>");
       result.push('false')
      }  
      else if(!value.match(emailReg)){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Invalid Email<span>");
       result.push('false')
      } 
      return this;      
  } 
  $.fn.checknumber = function() {
      var numReg = /^[0-9]+(\.[0-9]+)?$/; 
      var value = this.val();
      var str = this.attr('name');
      var write = str.replace('_',' ');
      if(value==''){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Please Enter "+write+"<span>");
       result.push('false')
      }  
      else if(!value.match(numReg)){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Please Input Only Numbers<span>");
        result.push('false')
      } 
      return this;      
  } 
  $.fn.numberonly = function() {
    var numReg = /^[0-9]+(\.[0-9]+)?$/; 
    var value = this.val();
    var str = this.attr('name');
    var write = str.replace('_',' ');
    if(value==''){
      this.val('0');
    }
    else if(!value.match(numReg)){
        this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Only Numbers<span>");
        result.push('false')
       
    } 
      
    return this;      
} 
  $.fn.checkphone = function() {
    var numReg = /^[+-]?\d+$/ ;
    var value = this.val();
    var str = this.attr('name');
      var write = str.replace('_',' ');
    if(value==''){
      this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Please Enter "+write+"<span>");
     result.push('false')
    }  
    else if(!value.match(numReg)){
      this.parent().siblings(".error").html("<span class='badge bg-red text-capitalize'>Invalid Phone Numbers<span>");
      result.push('false')
    } 
    return this;      
 } 
 

/*
$('#new-post-submit').on('submit',function(event){
  event.preventDefault();
  $('.error').html(''); //set error to empty
  var data = new FormData(this); //get form data
  $$('title').checkempty() //check empth with name
  $$('category').checkempty()
  _('body').checkempty()  //used for textarea
  if(result.length != 0){ //set error to empty
      result = [];
  }
  else{ //check no error
       ajax(data,'action.php',function(output){  //ajax function ajax(data, url , output)
          //other additional will be here//
       });
       
  }

})*/