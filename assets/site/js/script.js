$(document).ready(function() {
//var global valus;
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




$('#ntfndmsg').delay(9999).slideUp('slow');

$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });

$(window).load(function(){
        $('#searchticketbox').modal('show');
    });

     $("#loginbar").show(300);
     $("#registerbar").hide(300);
     $("#forgotbox").hide(300);
     $(".notamember").click(function(){
        $("#loginbar").hide(300);
        $("#registerbar").show(300);
         $("#forgotbox").hide(300);
    });
     $(".memberlogin").click(function(){
        $("#loginbar").show(300);
        $("#registerbar").hide(300);
         $("#forgotbox").hide(300);
    });
     $("#forgotpassword").click(function(){
        $("#loginbar").hide(300);
        $("#registerbar").hide(300);
        $("#forgotbox").show(300);
    });

});

 $('#passengerdtls').formValidation({
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
            'fullname': {
              // The children's full name are inputs with class .fullname
                selector: '.fullname',
                validators: {
                    notEmpty: {
                        message: 'The full name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The full name can only consist of alphabet A to z'
                    }
                }
            },
             
            age: {
                selector: '.oldage',
                validators: {
					 notEmpty: {
                        message: 'Age is required'
                    },
                     stringLength: {
                        max: 3,
                        message: 'Age must be less than 3 characters'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/i,
                        message: 'Age can only consist of number'
                    },
					greaterThan: {
                        value: 18,
                        message: 'Age must be greater than or equal to 60'
                    }
                }
            },
			age: {
                selector: '.agevalid',
                validators: {
                     stringLength: {
                        max: 3,
                        message: 'Age must be less than 3 characters'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/i,
                        message: 'Age can only consist of number'
                    }
                }
            },
            cvalidity: {
                selector: '.cvalid',
                validators: {
                     notEmpty: {
                        message: 'Card validity end date is required'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'Card validity end date must be (YYYY/MM/DD)'
                    }
                }
            },

            card: {
                selector: '.idcard',
                validators: {
                    notEmpty: {
                        message: 'The student card is required'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'File mus be jpeg,jpg or png'
                    }
                }
            },

            'gender11': {
                selector: '.gender11',
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The value is not a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'The mobile no is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The mobile no can only consist of number 0 to 9'
                    },
                    stringLength: {
                        max: 10,
                        message: 'The mobile no  must be 10 characters'
                    }
                }
            },
            boarding: {
                validators: {
                    notEmpty: {
                        message: 'The boarding point is required'
                    } 
                }
            },
            dropping: {
                validators: {
                    notEmpty: {
                        message: 'The dropping point is required'
                    } 
                }
            },
			coupon: {
                validators: {
                    remote: {
                        type: 'POST',
                        url: 'http://www.databankbooking.com/home/checkcuponcode_no',
						delay: 2000,
						message: 'Invalid coupon code'
                    } 
                }
            }
        }
		
    });

    $('#searchform').formValidation({
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
            from: {
                validators: {
                    notEmpty: {
                        message: 'Please select departure place'
                    }
                }
            },
            to: {
                validators: {
                    notEmpty: {
                        message: 'Please select destination place'
                    } 
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'Please select your date of journey'
                    }
                     
                }
            }
        }
    });



    $('.seatselectForm').formValidation({
        framework: 'bootstrap',
        err: {
            container: '.messages'
        },
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
            cprice: {
              // selector: '.inputer',
                validators: {
                    greaterThan: {
                        value: 1,
                        message: 'Please select seats'
                    },
                     notEmpty: {
                        message: 'Please select seats'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Please select seats'
                    } 
                }
            }
        }
    });

    $('.select').on('click', function() {
        // Set value for fields
        $('.seatselectForm')
            .find('input[name="cprice"]').val(valus).end();

        // Revalidate the fields
        $('.seatselectForm')
            .formValidation('revalidateField', 'cprice');
    });


    $('#userloginForm').formValidation({
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
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Email is not valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is requied'
                    } 
                }
            }
        }
    });
	
	
	$('.userloginPagefrom').formValidation({
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
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Email is not valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is requied'
                    } 
                }
            }
        }
    });
	


    $('#usersignupForm').formValidation({
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
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Email is not valid'
                    },
                    remote: {
                        type: 'POST',
                        url: 'http://www.databankbooking.com/user/checkemail',
						delay: 3000,
						message: 'Email is already exist'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is requied'
                    } 
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Password and confirm password are not match'
                    }
                }
             },
            mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Mobile no is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Mobile is only number 0 to 9'
                    },
                    stringLength: {
                        max: 10,
                        message: 'Mobile no  must be 10 characters'
                    },
                    remote: {
                        type: 'POST',
                        url: 'http://www.databankbooking.com/user/checkmobile_no',
						delay: 2000,
                        message: 'Mobile no is already exist'
                    }
                }
            },
            aterms: {
                validators: {
                    notEmpty: {
                        message: 'Must agree Terms & Condition'
                    } 
                }
            }
        }
    });

    $('#forgetform').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        row: {
            valid: 'field-success',
            invalid: 'field-error',
			validating: 'fa fa-refresh'
        },
        fields: {
            frogetemail: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Email is not valid'
                    },
                    remote: {
                        type: 'POST',
                        url: 'http://www.databankbooking.com/user/checkemail',
						delay: 2000,
                        message: 'Email is not found '
                    }
                }
            }
        }
    });


    $('#ticketSearch').formValidation({
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
            pnr: {
                validators: {
                    notEmpty: {
                        message: 'PNR is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'PNR only contains number'
                    },
                    stringLength: {
                        max: 9,
                        min: 9,
                        message: 'PNR is not valid'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile no is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Mobile no only contains number'
                    },
                    stringLength: {
                        max: 10,
                        min: 10,
                        message: 'Mobile no is not valid'
                    }
                }
            }
        }
    });
	
	
	$('.pageticketearch').formValidation({
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
            pnr: {
                validators: {
                    notEmpty: {
                        message: 'PNR is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'PNR only contains number'
                    },
                    stringLength: {
                        max: 9,
                        min: 9,
                        message: 'PNR is not valid'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile no is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Mobile no only contains number'
                    },
                    stringLength: {
                        max: 10,
                        min: 10,
                        message: 'Mobile no is not valid'
                    }
                }
            }
        }
    });
	


    $('#userupdateForm').formValidation({
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
            fname: {
                validators: {
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'First name contains only alphabet'
                    }
                }
            },
             lname: {
                validators: {
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'Last name contains only alphabet'
                    }
                }
            },
             address: {
                validators: {
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'Address  contains only alphabet'
                    }
                }
            },
            mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Mobile no is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Mobile no only contains number'
                    },
                    stringLength: {
                        max: 10,
                        min: 10,
                        message: 'Mobile no is not valid'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Email is not valid'
                    }
                }
            }
        }
    });

    $('#userpasswworChange').formValidation({
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
            password: {
                 selector: '.passwords',
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    stringLength: {
                        max: 50,
                        min: 8,
                        message: 'Password must be min 8 character'
                    }
                }
            }
			
        }
    });
	
	
	$('#linkchangeasswordForm').formValidation({
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
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    stringLength: {
                        max: 50,
                        min: 8,
                        message: 'Password must be min 8 character'
                    }
                }
            },
			confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Password and confirm password are not match'
                    },
					 notEmpty: {
                        message: 'Password is required'
                    },
                    stringLength: {
                        max: 50,
                        min: 8,
                        message: 'Password must be min 8 character'
                    }
                }
             }
			
        }
    });


});
