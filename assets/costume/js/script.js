
/* ------------------------------------------------------- 

* Filename:     AngularJS Dynamic Form Fields
* Description:  Utshab AngularJS blog
* Author:       Utshab utshabluitel.utshab@gmail.com  

---------------------------------------------------------*/
var app = angular.module('utshabApp', []);

  app.controller('MainCtrl', function($scope) {

  $scope.choices = [];
 // $scope.choices = [{id: 'choice1'}, {id: 'choice2'}];
  
  $scope.addNewBoarding = function() {
    var newItemNo = $scope.choices.length+1;
    $scope.choices.push({'id':'choice'+newItemNo});
  };
    
  $scope.removeBoarding = function() {
    var lastItem = $scope.choices.length-1;
    $scope.choices.splice(lastItem);
  };
  
});

app.directive("removeMe", function($rootScope) {
      return {
            link:function(scope,element,attrs)
            {
                element.bind("click",function() {
                    element.remove();
                });
            }
      }
});

app.controller('MultipleAddCtrl', function($scope) {
  $scope.va1 = '123';
});

app.directive('datetimez', function() {
    return {
        restrict: 'A',
        require : 'ngModel',
		scope: false,
        link: function(scope, element, attrs, ngModelCtrl) {
          element.timepicker({
            dateFormat:'hh:mm:ss',
          }).on('changeDate', function(e) {
            ngModelCtrl.$setViewValue(e.date);
            scope.$apply();
          });
        }
    };
});

app.directive('select2s', function() {
    return {
        restrict: 'A',
        require : 'ngModel',
        link: function(scope, element, attrs, ngModelCtrl) {
          element.select2({
              placeholder: "Select an option",
              allowClear: true
          }).on('changeDate', function(e) {
            ngModelCtrl.$setViewValue(e.selectp);
            scope.$apply();
          });
        }
    };
});

function ValidationCtrl($scope) {
  $pristine  = true;
  $scope.emailFormat = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
}



$(document).ready(function() {


 $(".select").on("click", function () {
    var price = $(this).attr('price');
    schid = $(this).attr('title');
     var selecteddiv = $('#multiselect .active').length;
   
  if(selecteddiv<6){
      $(this).toggleClass("active");
      ids = $(this).attr('id');
      sid = $(this).attr('title');

      var alreadyExist =  $(".seatinfo"+sid+" span[id='"+ids+"']").length;
       if(alreadyExist>0)
       {
        var newVal  = selecteddiv-1;
         $(".seatinfo"+sid+" span[id='"+ids+"']").remove();
         $(".seatinfo"+sid+" input[id='"+ids+"']").remove();
       }else{
          var newVal  = selecteddiv+1;
            $(".seatinfo"+sid).append("<span class='infobox' id='"+ids+"'>"+ids+"</span>");
            $(".seatinfo"+sid).append("<input name='seats[]' type='hidden' required id='"+ids+"' value='"+ids+"'/>");
          }
      }else{
       $(this).removeClass("active");
       ids = $(this).attr('id');
       sid = $(this).attr('title');
       var newVal  = selecteddiv;
        var alreadyExist =  $(".seatinfo"+sid+" span[id='"+ids+"']").length;
       if(alreadyExist>0)
       {
        var newVal  = selecteddiv-1;
         $(".seatinfo"+sid+" span[id='"+ids+"']").remove();
         $(".seatinfo"+sid+" input[id='"+ids+"']").remove();
       }
     }
     var total = document.getElementById("pricebox"+sid).innerHTML = price*newVal;
      $(".seatinfo"+sid).append("<input name='total' type='hidden' id='"+total+"' value='"+total+"'/>");
      $(".seatinfo"+sid).append("<input name='sid' type='hidden' id='"+schid+"' value='"+schid+"'/>");
       valus = document.getElementById("pricebox"+sid).innerHTML = price*newVal;
      $("#pri"+sid).attr("value", valus);


  });
  

  //Booked seats click  disable function 
  $('.disconnect').off('click');

  $('.select').on('click', function() {
      // Set value for fields
      $('#protectForm')
           // .find('input[name="cprice[]"]').val(valus).end();
  });

  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".terms").wysihtml5();
  });
});

$(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".termsandcondition").wysihtml5();
    $(".bookingpolicy").wysihtml5();
    $(".privacypolicy").wysihtml5();
  });
  
  
  $('#formvalidatoniForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        row: {
            valid: 'field-success',
            invalid: 'field-error'
        },
        fields: {
			title: {
                validators: {
                    notEmpty: {
                        message: 'Title is requied'
                    } 
                }
            }
        }
    });
	
	
  
 
  



 
