$(document).ready(function(){
		
		var ajax_common = function(data,url,type,obj){
			$.ajax({
				url : url,
				data : data,
				type : type,
				success : function(response){
					$(obj).html(response);
				}
			});
		};

		//----------------------------------- Search class ----------------------

		$(".search_from_day").click(function(event){
			event.preventDefault();
			var dayID = $(this).children(".dayID").val();
			function_search_class("from_day",dayID);
		});
		
		$(".search_from_room").click(function(event){
			event.preventDefault();
			var roomID = $(this).children(".roomID").val();
			function_search_class("from_room",roomID);
		});

		$(".search_from_teacher").click(function(event){
			event.preventDefault();
			var teacherID = $(this).children(".teacherID").val();
			function_search_class("from_teacher",teacherID);
		});

		$(".search_from_group").click(function(event){
			event.preventDefault();
			var groupID = $(this).children(".groupID").val();
			function_search_class("from_group",groupID);
		});

		var function_search_class = function(type,data_send){
			var data = {"data_send" : data_send,"type_view" : type};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};
		//------------------ Login -----------------------------------------
		$(".loginuser").click(function(event){
			event.preventDefault();
			var user = $('#userlogin').val();
		    var password = $('#passwordlogin').val();
			function_login("check_login",user,password);
			
		});

		var function_login = function(type,user,password){
			var data = {"user" : user,"password" : password,"type_view" : type};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updatelogin"));
		};
		
		//--------------------------- Log Out -------------------------------
		//$(".logout").click(function(event){
		//	event.preventDefault();
		//	function_logout("check_logout");
			
		//});

		//var function_logout = function(type){
		//	var data = {"type_view" : type};
		//	ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		//};

		//------------------------ Status User ------------------------------

		$(".status_user").click(function(event){
			event.preventDefault();
			function_status_user("status_users");
			
		});

		var function_status_user = function(type){
			var data = {"type_view" : type};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		//----------------------Status ID ----------------------------------

		$(".activateID").click(function(event){
			event.preventDefault();
			
		    var stsid = $(this).children(".statid").val();
		    var stnid = $(this).children(".statname").val();

			function_status_ID("ActivateID",stsid,stnid);
			
		});

		var function_status_ID = function(type,stsid,stnid){
			var data = {"type_view" : type,"userSTSid" : stnid,	"StatID" : stsid};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		//------------------------ Add User --------------------------------

		$(".add_user").click(function(event){
			event.preventDefault();
			function_add_user("add_user");
			
		});

		var function_add_user = function(type){
			var data = {"add_user" : type};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		//-------------------------- User form ------------------------------

		$(".confirmPWD").change(function(){

			var pwd1 = $('.add_userPWD').val();
			var pwd2 = $('.confirmPWD').val();

			if (pwd1==pwd2){
					$(this).parents('.control-group').addClass("error");
					$(this).parents('.control-group').addClass("success");
					$('#pwd_error').html("");

			}
			else {
					$(this).parents('.control-group').removeClass("success");
					$(this).parents('.control-group').addClass("error");
					$('#pwd_error').html("รหัสผ่านไม่ตรงกันกรุณาตรวจสอบ");
			}
		});

		$(".add_userID").change(function(){

			var usr1 = $('.add_userID').val();
			function_chk_usr("chk_usr",usr1);
		});

		$(".add_userbtn").click(function(event){
			event.preventDefault();
			var form_data1 = $('.add_userID').val()+","+$('.add_userPWD').val()+","+$('.add_userFSTN').val()+","+$('.add_userLSTN').val()+","+$("input[name='optionsRadios']:checked").val();
			var form_data2 = $('.adduser_email').val()+","+$('.adduser_phone').val()+","+$("input[name='permiss1']:checked").val()+","+$("input[name='active1']:checked").val();

			var form_send = form_data1+","+form_data2;

			//alert(form_send);
			function_add_userform("form_adduser",form_send);
		});

		var function_add_userform = function(type,data_form){
			var data = {"add_user" : type, "data_user" : data_form};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		var function_chk_usr = function(type,usr1){
			var data = {"type_view" : type,	"usrn" : usr1};
			ajax_common(data,"function/AjaxUpdate.php","POST",$("#user_error"));
		};

		//-------------------------- Delete User ------------------------------

		$(".del_userbtn").click(function(event){
			event.preventDefault();
			var del_user = $(this).children(".statname").val();
			if(confirm('คุณต้องการลบผู้ใช้ '+del_user)==true){
			function_delete_user("del_user",del_user);
		}
		else {
			function_status_user("status_users");
		}

		});

		var function_delete_user = function(type,del_user){
			var data = {"type_view" : type,	"del_user" : del_user};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		//---------------------------- search user link ------------------------
		
		$(".search_ulink").click(function(event){
			event.preventDefault();
			function_search_ulink("search_ulink");
		});

		$(".s_btn").click(function(event){
			event.preventDefault();
			
			var s_data = $('#s_user').val()+","+$('#s_name').val()+","+$('#s_lname').val()+","+$('#s_email').val()+","+$('#s_tel').val();
			function_search_user1("search_user1",s_data)
		});

		var function_search_ulink = function(type){

			var data = {"type_view" : type};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		var function_search_user1 = function(type,s_data1){
			var data = {"type_view" : type,	"search_data" : s_data1};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};
		//------------------------------- User Edit ---------------------------------

		$(".edit_userbtn").click(function(event){
			event.preventDefault();
			var edit_user = $(this).children(".statname").val();
			function_user_edit("edit_user",edit_user);
		});

		$(".edit_profile").click(function(event){
			event.preventDefault();
			var edit_user = $(this).children(".statname").val();
			function_user_edit("edit_user",edit_user,"edit_profile");
		});

		var function_user_edit = function(type,edit_id,hchk){
			var data = {"type_view" : type,	"edit_id" : edit_id, "header_chk" : hchk};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};
		//------------------------------ Update User ---------------------------------

		$(".update_userbtn").click(function(event){
			event.preventDefault();

			var usrupdate_data = $('.add_userID').val()+","+$('.add_userPWD').val()+","+$('.add_userFSTN').val()+","+$('.add_userLSTN').val()+","+$("input[name='optionsRadios']:checked").val();
			var usrupdate_data2 = $('.adduser_email').val()+","+$('.adduser_phone').val()+","+$("input[name='permiss1']:checked").val()+","+$("input[name='active1']:checked").val();

			var usrdata_send = usrupdate_data+","+usrupdate_data2;

			//alert(form_send);
			function_update_user("update_user",usrdata_send);
		});

		var function_update_user = function(type,user_data){
			var data = {"type_view" : type,	"usr_data" : user_data};
			ajax_common(data,"function/AjaxUpdate.php","POST",$(".updates"));
		};

		//------------------------------- Import CSV --------------------------

		$(".csv_link").click(function(event){
			event.preventDefault();
			function_csv_form("csv_form");
		});

		

		var function_csv_form = function(type){
			var data = {"type_view" : type};
			ajax_common(data,"function/schedule.php?func=0","POST",$(".updates"));
		};

		
		//--------------------------------LOg file ------------------------------

		$(".view_log").click(function(event){
			event.preventDefault();
			function_view_log("show_log");
		});

		$(".page_dvide").click(function(event){
			event.preventDefault();
			var num_page = $(this).html();
			var max_p2 = $(".next_page").children(".max_page").val();
			if(num_page<=1){
				$(".previous").addClass("disabled");
			}
			else {
				$(".previous").removeClass("disabled");
			}
			if(parseInt(num_page)>=parseInt(max_p2)){

				$(".next").addClass("disabled");
			}
			else {
				$(".next").removeClass("disabled");
			}
			$(".prev_page").children(".prev_val").attr('value',parseInt(num_page)-1);
			$(".next_page").children(".next_val").attr('value',parseInt(num_page)+1);
			$(".this_page").html("Page "+num_page);
			function_get_pagelog("getpage",num_page);
		});

		$(".next_page").click(function(event){
			event.preventDefault();
			var num_page = $(this).children(".next_val").val();
			var max_p = $(this).children(".max_page").val();
			if(num_page==max_p){
				$(this).parents(".next").addClass("disabled");
				if(num_page!=1){
					$(".previous").removeClass("disabled");
				}

			}
			else {
				if(num_page!=1){
					$(".previous").removeClass("disabled");
				}
				$(this).parents(".next").removeClass("disabled");
			}
			$(".prev_page").children(".prev_val").attr('value',parseInt(num_page)-1);
			$(".next_page").children(".next_val").attr('value',parseInt(num_page)+1);
			$(".this_page").html("Page "+num_page);
			function_get_pagelog("getpage",num_page);
		});

		$(".prev_page").click(function(event){
			event.preventDefault();
			var num_page = $(this).children(".prev_val").val();
			var max_p3 = $(this).children(".max_page").val();
			if(num_page==1){
				if(num_page!=max_p3){
					$(".next").removeClass("disabled");
				}
				$(this).parents(".previous").addClass("disabled");
			}
			else {
				if(num_page!=max_p3){
					$(".next").removeClass("disabled");
				}
				$(this).parents(".previous").removeClass("disabled");
			}
			$(".prev_page").children(".prev_val").attr('value',parseInt(num_page)-1);
			$(".next_page").children(".next_val").attr('value',parseInt(num_page)+1);
			$(".this_page").html("Page "+num_page);
			function_get_pagelog("getpage",num_page);
		});


		var function_view_log = function(type){
			var data = {"type_view" : type};
			ajax_common(data,"function/Ajaxupdate.php","POST",$(".updates"));
		};

		var function_get_pagelog = function(type,npage){
			var data = {"type_view" : type, "num_lim" : npage };
			ajax_common(data,"function/Ajaxupdate.php","POST",$(".show_log_page"));
		};
		
	//------------------------------------------------- CSV save / unsave -------------------------------
		$(".csv_clear").click(function(event){
			event.preventDefault();
			function_csv_clear("clear_csv");
		});

		$(".csv_ok").click(function(event){
			event.preventDefault();
			function_csv_clear("csv_ok");
		});

		$(".csv_clear_cache").click(function(event){
			event.preventDefault();
			function_csv_clear("csv_clear_cache");
		});

		var function_csv_clear = function(type){
			var data = {"type_view" : type};
			ajax_common(data,"function/csv_function.php","POST",$(".updates"));
		};

	});

