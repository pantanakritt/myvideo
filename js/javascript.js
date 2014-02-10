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

		$(".login_enter").click(function(event){
			event.preventDefault();
			var userid = $(".user").val();
			var pswid = $(".psw").val();
			chk_login("login",userid,pswid);
			
		});

		var chk_login = function(type,id,pswd){
			var data = {"condition" : type , "user" : id , "pass" : pswd};
			ajax_common(data,"function.php","POST",$(".main_body"));
		};

		$(".video_link").click(function(event){
			event.preventDefault();
			var link_vdo = $(this).children(".link_tag").val();
			
			vdo_click("vdo",link_vdo);
			
		});

		var vdo_click = function(type,link_vdo){
			var data = {"condition" : type , "link_vdo" : link_vdo };
			ajax_common(data,"function.php","POST",$(".main_body"));
		};
		
		$(".gift_chk").change(function(event){
			event.preventDefault();
			var value_check = $(this).val();
			var checked_attr = $(this).is(':checked');

			gift_check("gift_check",value_check,checked_attr)
			
			});

		var gift_check = function(type,value_check,checked_attr){
			var data = {"condition" : type , "c_name" : value_check , "checked_attr" : checked_attr };
			ajax_common(data,"function.php","POST",$(".main_body"));
		};

		$(".clk_link").click(function(event){
			event.preventDefault();
			var fr_name = $(".add_fr").val();
			

			add_fr("add_friend",fr_name);
			
			});

			var add_fr = function(type,fr_name){
			var data = {"condition" : type , "fr_name" : fr_name };
			ajax_common(data,"function.php","POST",$(".main_body"));
		};


		});